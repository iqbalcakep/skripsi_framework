<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Article;
use App\Similarity;

class Detail extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request,string $slug)
    {
        $title = str_replace('-',' ',$slug);
        $article = Article::where('title',$title)->first();
        
        if($article)
            $similarity = Similarity::where('article_id', $article->id)->first();
            $ids = explode(',',$similarity->recomendation_id);
            $recomendations = Article::whereIn('id',$ids)->get();
            
        // dd($recomendations);
        return View('components/user/detail', compact('article','recomendations'));
    }
}
