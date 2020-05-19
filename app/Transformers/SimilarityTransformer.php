<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Article;

class SimilarityTransformer extends TransformerAbstract
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
    public function transform(Article $article)
    {
        return [
            'id' => $article->id,
            'title' => $article->title,
            'dice' => $article->dice,
            'jaccard' => $article->jaccard,
        ];
    }
}
