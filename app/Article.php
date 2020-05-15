<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $table = "article";
    
    protected $appends = ['slug'];
    
    public function getSlugAttribute()
    {
        return $this->attributes['slug'] = config('app.url').strtolower(str_replace(' ','-', $this->title));
    }

    
}
