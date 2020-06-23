<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Article;
use App\Similarity;
use App\SimilarityOther;

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
        // $title = str_replace('-',' ',$slug);
        $article = Article::whereRaw("REPLACE(`title`,' ', '-') = ?", [$slug])->first();
        $recomendations = [];
        
        if($article != null){
            $similarity = Similarity::where('article_id', $article->id)->first();
            $similarityOther = SimilarityOther::where('article_id', $article->id)->first();

            $ids = explode(',',$similarity->recomendation_id);
            $idsOther = explode(',',$similarityOther->recomendation_id);
            
            $recomendations = Article::select('id','date','url','title','thumbnail')->whereIn('id',$ids)->get();
            $recomendationsOther = Article::select('id','date','url','title','thumbnail')->whereIn('id',$idsOther)->get();

        }

        // dd($recomendations);
        return View('components/user/detail', compact('article','recomendations','recomendationsOther'));
    }
}
