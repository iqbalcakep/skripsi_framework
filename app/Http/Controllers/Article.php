<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Article as ArticleModel;
use App\Similarity;
use App\SimilarityOther;
use App\Transformers\ArticleTransformer;
use App\Transformers\SimilarityTransformer;
use App\Transformers\PreprocessingTransformer;
use App\Transformers\HistoryTransformer;
use Illuminate\Database\Eloquent\Collection;
use Artisan;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;


class Article extends Controller
{
    //
    public function index(Request $request) 
    {
       if($request->action == "history")
       {
           $request->limit = !empty($request->limit) ? $request->limit : 10;
           $aritcles = ArticleModel::orderBy('engage','desc')
                        ->limit($request->limit)
                        ->paginate($request->limit);

           return response(fractal($aritcles, new HistoryTransformer())->toArray());
       }

       $aritcles = ArticleModel::paginate();
       return response(fractal($aritcles, new ArticleTransformer)->toArray());
    }
    
    public function lasthistory(Request $request)
    {
        $data = [];
        $request->limit = !empty($request->limit) ? $request->limit : 10;
        $aritcles = ArticleModel::orderBy('engage','desc')
                     ->limit($request->limit)
                     ->get();
        foreach($aritcles as $i => $aritcle)
        {
            $data['labels'][$i] = $aritcle->id;
            $data['values'][$i] = $aritcle->engage;
            $color = '#FF0000';

            if($i==0){
                $color = '#008000';
            }else if($i==1) {
                $color = '#00FF00';
            }else if($i==2) {
                $color = '#FFFF00';
            }
            
            $data['colors'][$i] = $color;

        }

        return response()->json($data);
    }

    public function preprocessing() 
    {
       $aritcles = ArticleModel::paginate();
       
       return response(fractal($aritcles, new PreprocessingTransformer)->toArray());
    }
    
    public function crawl()
    {
        Artisan::call('start:crawl --command="/usr/local/bin/python3.7 python/scrap.py 5"');
        return response(json_encode(Artisan::output()));
    }
    
        
    public function dice()
    {
        Artisan::call('start:crawl --command="python python/dice.py similarity"');
        return response(json_encode(Artisan::output()));
    }

    public function jaccard()
    {
        Artisan::call('start:crawl --command="python python/dice.py similarity_other"');
        return response(json_encode(Artisan::output()));
    }
    
    
    public function similarity()
    {
        $aritcles = ArticleModel::with(['dice','jaccard'])->paginate();
        return response(fractal($aritcles, new SimilarityTransformer)->toArray());
    }

    public function compare(Request $request)
    {
        $total = ArticleModel::with(['dice','jaccard'])->count();
        $dice = Similarity::select('article_id','recomendation_id')
                ->orderBy('article_id','asc')
                ->get()->pluck('recomendation_id')
                ->toArray();
        $jaccard = SimilarityOther::select('article_id','recomendation_id')
                ->orderBy('article_id','asc')
                ->get()
                ->pluck('recomendation_id')
                ->toArray();
        $max = intval($request->total) > 0 && intval($request->total) <= 5 ? intval($request->total) : 5;  
        
        if(count($dice)==count($jaccard)) 
        {
            foreach($dice as $i => $v) {
                $dice[$i] = $this->cut_max($dice[$i], $max);
                $jaccard[$i] = $this->cut_max($jaccard[$i], $max);
            }
        }
        
        $same = count(array_intersect($dice,$jaccard));
        $not_same = $total - $same;

        $same_percent = round(($same/$total)*100,0);
        $not_same_percent = round(($not_same/$total)*100,0);

        $data = [
            'chart' => ['datasets' => [[
                            'data' => [$same_percent,$not_same_percent],
                            'backgroundColor' => ['#008000','#FF0000']
                         ]],
                       'labels' => ['Sama','Tidak Sama']],
            'detail' => [
                'total' => $total,
                'same' => $same,
                'not_same' => $not_same,
                'max_recom' => $max,
            ]
        ];

        return response()->json($data);

    }

    public function cut_max($data,$max)
    {
        $recoms = explode(',', $data);
        $recoms = array_slice($recoms,0,$max);
        return implode(',',$recoms);
    }
    

    public function engage(Request $request)
    {
        $id = $request->id;
        ArticleModel::where('id', $id)->increment('engage', 1);
        return response()->json('success');
    }

    public function getRecomendation(Request $request)
    {
        $result = [];
        $recomendations = [];

        $title = $request->title ?? 'NULL';
        $article = ArticleModel::where('title', $title)->first();
        
        if($article != null){
            $similarity = Similarity::where('article_id', $article->id)->first();
            $ids = explode(',',$similarity->recomendation_id);
            $recomendations = ArticleModel::select('id','title','url','thumbnail','date')->whereIn('id',$ids)->get();

            $result = [
                'article' => $article->title,
                'recomendations' => $recomendations,
            ];
        }else {
            $result = [
                'message' => 'Artikel tidak ada atau belum memiliki rekomendasi'
            ];
        }
                
        return response()->json($result);
    }
}  


