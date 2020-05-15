<?php declare(strict_types=1);

namespace App\Transformers;

use App\Article as ArticleModel;
use League\Fractal\TransformerAbstract;

class ArticleTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
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
            'thumbnail' => $article->thumbnail,
            'title' => $article->title,
            'content' => substr($article->content,0,150),
            'date' => $article->date,
            'url' => $article->url,
            'term' => $article->term,
        ];
    }
}
