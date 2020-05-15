<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Article;

class Homepage extends Controller
{
    //
    public function __invoke(Request $request)
    {
        
        $article = Article::select('id','title','thumbnail','date','content')
                    ->orderBy('date','desc')
                    ->limit(11)
                    ->get()
                    ->toArray();

        $headline = array_splice($article,0,1);
        $one = array_splice($article,0,1);
        $two = array_splice($article,0,2);
        $three = array_splice($article,0,3);
        $four = array_splice($article,0,4);
        
        
        return View('components/user/homepage',compact('one','two','three','four','headline'));
    }
}
