<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Similarity extends Controller
{
    //
    public function index()
    {
        return View('components/admin/similarity');
    }
}
