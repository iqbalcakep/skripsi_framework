from bs4 import BeautifulSoup
import urllib.request
import nltk
from nltk.corpus import stopwords
from Sastrawi.StopWordRemover.StopWordRemoverFactory import StopWordRemoverFactory, StopWordRemover, ArrayDictionary
from Sastrawi.Stemmer.StemmerFactory import StemmerFactory
import re,math
from collections import Counter
import mysql.connector
import sys
import time
import datetime

limit_crawl = sys.argv[1]

mydb = mysql.connector.connect(
      host="localhost",
      port="3306",
      user="root",
      passwd="",
      database="skripsi_fix"
)

# ## PREPROCESSING ##
#filtering
def filtering(kalimat) :
    removed_number = re.sub(r"\d+", "",kalimat)
    removed_unused_char = re.sub(r'[^\w\s]',' ',removed_number)
    ready_to_tokenize = removed_unused_char.lower().strip()
    return ready_to_tokenize

# Tokenization
def tokenize(ready_to_tokenize): 
    stop_factory = StopWordRemoverFactory().get_stop_words() #load defaul stopword
    more_stopword = ['brilio','net','com','foto'] #menambahkan stopword
    data = stop_factory + more_stopword
    dictionary = ArrayDictionary(data)
    str = StopWordRemover(dictionary)
    ready_to_stem = nltk.tokenize.word_tokenize(str.remove(ready_to_tokenize))
    return ready_to_stem

# STEMMING
def stem(ready_to_stem):
    factory = StemmerFactory()
    stemmer = factory.create_stemmer()
    hasil = stemmer.stem(" ".join(ready_to_stem))
    return hasil
    
#TF IDF
class Weighting(str): 
    def __init__(self,hasil): 
        words = hasil.split(' ')
        count = Counter(words)
        res = dict(count)
        term = list(res.keys())
        common = dict(count.most_common(10))
        term_common = list(common.keys())
        self.term_common = term_common
        self.term = term
        self.res = res

def timeConvert(date) :
    try :
        remove = date.split(' ', 5)[5]
        need_convert = date.replace(remove, '').replace(" ", "")
        reformat = datetime.datetime.strptime(need_convert, '%d/%m/%Y').strftime("%Y-%m-%d")
    except:
        return datetime.datetime.today().strftime('%Y-%m-%d')
    return reformat
    
    
# CRAWLING 
print("start crawl")
start_time_crawl = time.time()


url = "https://brilio.net"

content = urllib.request.urlopen(url).read()
soup = BeautifulSoup(content, 'html.parser')

articles = soup.find_all('p',class_='text-article')
links = []
for article in articles :
    url = ''
    el = article.a.attrs['href']
    if 'http' in el :
        url = el 
    else :
        url = 'https://brilio.net' + el
    links.append(url)
    if(len(links) > int(limit_crawl) ):
        break

cursor = mydb.cursor()
for link in links:
    cursor.execute('select count(url) from article where url ="'+link+'" ')
    total=cursor.fetchone()
    if(total[0] > 0):
        links.remove(link)
cursor.close ()
# sys.exit()

print("finish crawl")

titles = []
contents = []
title_term = []
dates=[]
thumbnails=[]
urls = []

print(len(links))
urut = 0
for link in links :
    try:
        if (link[0:10] != "https://s." and link[0:19] != "https://brilicious." and link[0:19] != "https://brilistyle."):
         print(link)
         content = urllib.request.urlopen(link).read()
         soup = BeautifulSoup(content, 'html.parser')
         konten = soup.find('div', class_='main-content').find_all('p')
         # GET DETAIL
         titles.append(soup.find('title').get_text())
         # DATE
         try :
            time_convert = timeConvert(soup.find('p', class_='index-date').get_text())
         except :
            time_convert = datetime.datetime.today().strftime('%Y-%m-%d')
         dates.append(time_convert)
         temp_img = soup.find('figure', class_='headline-index').find('img')
         thumbnails.append(temp_img.attrs['src'])
         urls.append(link)
         text_temp = ""
         for p in konten :
             if(p.find('div', class_='detail-box')):
                continue
             else :
                 text_temp += ' '+p.get_text()
     
    
         contents.append(text_temp)
         print("crawled "+ str(urut))
        #  time.sleep(1)
         urut+= 1
    except urllib.request.URLError as e:
         links.remove(link)
         print("gagal crawl")
    	#  time.sleep(1)
         continue

print("finish crawl detail")
print("--- %s seconds ---" % (time.time() - start_time_crawl))

print("Start Preprocessing")        
start_time_preproses = time.time()
# Preprocessing Process
fix_contents = []
fix_titles = []
all_filters = []
all_tokens = []
for i in range(0, len(contents)):
    hasil_filter = filtering(titles[i]+contents[i])
    hasil_tokens = tokenize(hasil_filter)
    hasil_title = stem(tokenize(filtering(titles[i])))
    hasil = stem(hasil_tokens)
    all_filters.append(hasil_filter)
    all_tokens.append(hasil_tokens)
    fix_titles.append(hasil_title)
    fix_contents.append(hasil)
    print("processed article "+ str(i))

#TF IDF PROCESS
terms = []
for fix_content in fix_contents :
    weight = Weighting(fix_content)
    terms.append(weight.term)
    
for fix_title in fix_titles :
    weight = Weighting(fix_title)
    title_term.append(weight.term_common)   

print("Finish Preprocessing") 
print("--- %s seconds ---" % (time.time() - start_time_preproses))


if len(titles) == len(dates) == len(thumbnails) == len(terms) == len(fix_contents) == len(urls) :
    print("all same")
    cursor = mydb.cursor()
    for i in range(0, len(urls)) :
        try :
            cursor.execute("insert into article set thumbnail = '"+thumbnails[i]+"', title = '"+titles[i]+"', real_content = '"+contents[i]+"', content = '"+fix_contents[i]+"'," \
                         "date='"+dates[i]+"', url = '"+urls[i]+"', term = '"+','.join(terms[i])+"',filter = '"+''.join(all_filters[i])+"',tokenize = '"+', '.join(all_tokens[i])+"', title_term = '"+', '.join(title_term[i])+"' ")
            mydb.commit()
            print("insert success")
        except: 
            print("insert error")
            continue
    cursor.close()
        
