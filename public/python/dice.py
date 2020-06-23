from __future__ import division
import re,math
from collections import Counter
import mysql.connector
from datetime import datetime, timedelta
import numpy as np
import sys
import operator
from sklearn.feature_extraction.text import TfidfVectorizer
import pandas as pd
import string
import time

metode = sys.argv[1]

mydb = mysql.connector.connect(
      host="localhost",
      port="3306",
      user="root",
      passwd="",
      database="skripsi_fix"
)

#TF IDF
class AllSimilarity(dict): 
    def __init__(self): 
        self = dict() 
    def add(self, key, value): 
        self[key] = value 

# DICE COEFF
def dice_coeff(query, doc, intersect):
    # print intersect
    return (2.0 * intersect + 1.0) / ((doc**2)+(query**2) + 1.0)

cursor = mydb.cursor(buffered=True,dictionary=True)

# GET ARTICLE
today = datetime.today().strftime('%Y-%m-%d')
last_seven_days = (datetime.now() - timedelta(days=7)).strftime('%Y-%m-%d')
# cursor.execute("select id,term,title_term from article where id < 23 ")
cursor.execute("select id,term,title_term from article where date between '"+last_seven_days+"' and '"+today+"' ")
get_articles = cursor.fetchall()
total = len(get_articles)

a = get_articles
features = AllSimilarity()
tfidfs = AllSimilarity()

def tokens(x):
 return x.split(',')

for i in range(0,total) :
    for j in range(0,total) :
        if i == j :
            continue
        else :
            tfidf = TfidfVectorizer(tokenizer=tokens,use_idf=True)
            texts = [a[i]['term'],a[j]['term']]
            feature = tfidf.fit_transform(texts)
            tfidfs.add(str(a[i]['id'])+'-'+str(a[j]['id']),tfidf)
            # print pd.DataFrame(feature.toarray(),columns=tfidf.get_feature_names())
            features.add(str(a[i]['id'])+'-'+str(a[j]['id']),feature)

def count_dice(query,doc):
    materials = features[str(query['id'])+'-'+str(doc['id'])]
    query_weight = materials[0].sum()
    doc_weight = materials[1].sum()
    
    # print(str(query['id'])+'-'+str(doc['id']))

    intersect_term = list(set(query['term'].split(',')) & set(doc['term'].split(',')))
    # print('=======================================')
    # print(intersect_term)
    # print('== HASIL ==')
    # print(tfidfs[str(query['id'])+'-'+str(doc['id'])].get_feature_names())
    # print('=======================================')
    intersecting = [tfidfs[str(query['id'])+'-'+str(doc['id'])].get_feature_names().index(i) for i in intersect_term]
    
    intersect_weight1 = 0
    intersect_weight2 = 0
    for i in intersecting :
        intersect_weight1 += float(materials[0][0,i])
        intersect_weight2 += float(materials[1][0,i])
    intersect_weight = intersect_weight1 * intersect_weight2    
    
    dice = dice_coeff(query_weight, doc_weight, intersect_weight)    
    return format(float(str(dice)), '.7f')
    
def count_jaccard(query,doc):
    materials = features[str(query['id'])+'-'+str(doc['id'])]
    list1 = query['term'].split(',')
    list2 = doc['term'].split(',')
    
    # intersect = list(set(query['term'].split(','))&set(doc['term'].split(',')))
    # jaccard_in = len(intersect)  / (s1 + s2);
    s1 = set(list1)
    s2 = set(list2)
    return len(s1.intersection(s2)) / len(s1.union(s2))
    
    # return jaccard_similarity_score()
    # return jaccard_in
print("start similarity")
start_time_similarity = time.time()  
    
similarity = AllSimilarity()
for i in range(0,total):
    similarity_result = ''
    similarity_result = AllSimilarity()
    for j in range(0,total):
        if i == j :
            continue
        else :
           if(metode=='similarity'):
              dice = count_dice(a[i],a[j])
           else :
              dice = count_jaccard(a[i],a[j])  
        #    if(dice > 0.0001) : ?? should i set the rule?? OMG im confused 
        #    if str(a[j]['id']) not in similarity_result:
           similarity_result.add(str(a[j]['id']),dice)
           cursor.execute("select * from "+metode+" where article_id = '"+str(a[i]['id'])+"' ")
           counted = cursor.fetchone()
           if counted:
               counted_similarity = counted['similarity'].split(',')
               counted_recom =  counted['recomendation_id'].split(',')
               for k in range(0,len(counted_recom)) :
                  if str(counted_recom[k]) not in similarity_result: 
                     similarity_result.add(str(counted_recom[k]),counted_similarity[k])

    similarity.add(a[i]['id'],similarity_result)
      
for i in similarity :
    similarity_id = []
    similarity_val = []
    similarity_percent = []
    for elem in sorted(similarity[i].items(), reverse=True, key=lambda x: x[1]) :
        similarity_id.append(str(elem[0]))  
        similarity_val.append(str(elem[1]))
        percent = float(elem[1])*100
        similarity_percent.append(str(percent))
        if(len(similarity_id) == len(similarity_val) == len(similarity_percent) == 5):
            break
    recom_id = ','.join(similarity_id)
    recom_val = ','.join(similarity_val)
    recom_percent = ','.join(similarity_percent)
    # print recom_val
    # print recom_id
    # print i
    # # print "======="
    insert_query = "insert into "+metode+" set article_id = '"+str(i)+"', recomendation_id = '"+recom_id+"', similarity='"+recom_val+"', percent ='"+recom_percent+"'"
    update_query = "update "+metode+" set recomendation_id = '"+recom_id+"', similarity='"+recom_val+"', percent ='"+recom_percent+"' where article_id = '"+str(i)+"'"
    try :
        cursor.execute(insert_query)
        mydb.commit()
        print(i)
        print(recom_val)
    except :
        print(i)
        print(recom_val)
        cursor.execute(update_query)
        mydb.commit()
        # print "updated with new result with weekly articles"
        continue

print("finish crawl detail")
print("--- %s seconds ---" % (time.time() - start_time_similarity))