<?php declare(strict_types=1);

namespace App\Transformers;

use App\Article as ArticleModel;
use League\Fractal\TransformerAbstract;

class HistoryTransformer extends TransformerAbstract
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
            'title' => $article->title,
            'engage' => $article->engage,
        ];
    }
}
