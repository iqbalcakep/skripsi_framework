<?php

namespace App\Transformers;
use App\Article as ArticleModel;
use League\Fractal\TransformerAbstract;

class PreprocessingTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(ArticleModel $article)
    {
        return [
            'id' => $article->id,
            'title' => $article->title,
            'filter' => $article->filter,
            'real_content' => $article->real_content,
            'tokenize' =>  $article->tokenize,
            'content' => $article->content,
        ];
    }
}
