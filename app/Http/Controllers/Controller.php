<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct() {


        $categories = Category::All();
        $poularpost = Post::orderBy('view_count','DESC')->where('status','=','PUBLISHED')->take(3)->get();

        \View::share('allcategories', $categories);

        \View::share('poularpost', $poularpost);

    }
}
