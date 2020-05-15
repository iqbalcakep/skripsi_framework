<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Article as ArticleModel;
use App\Transformers\ArticleTransformer;
use App\Transformers\PreprocessingTransformer;
use Illuminate\Database\Eloquent\Collection;
use Artisan;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;


class Article extends Controller
{
    //
    public function index() 
    {
       $aritcles = ArticleModel::paginate();
       
       return response(fractal($aritcles, new ArticleTransformer)->toArray());
    }
    
    public function preprocessing() 
    {
       $aritcles = ArticleModel::paginate();
       
       return response(fractal($aritcles, new PreprocessingTransformer)->toArray());
    }
    
    public function crawl()
    {
        Artisan::call('start:crawl --path=python/scrap.py --total=15');
        return response(json_encode(Artisan::output()));
    }
    
        
    public function dice()
    {
        Artisan::call('start:crawl --path=python/dice.py');
        return response(json_encode(Artisan::output()));
    }
    
}  
