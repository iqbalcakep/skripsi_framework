<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $table = "article";
    public $timestamps = false;
    
    protected $appends = ['slug'];
    
    public function getSlugAttribute()
    {
        return $this->attributes['slug'] = config('app.url').strtolower(str_replace(' ','-', $this->title));
    }
    
    public function dice()
    {
        return $this->hasOne('App\Similarity','article_id','id');
    }
    
    public function jaccard()
    {
        return $this->hasOne('App\SimilarityOther','article_id','id');
    }

    
}
