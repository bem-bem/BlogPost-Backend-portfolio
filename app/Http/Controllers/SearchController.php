<?php

namespace App\Http\Controllers;

use App\Http\Requests\Searchvalidation;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Searchvalidation $request)
    {
        $request->validated();

        if (isset($_GET['searchTitle'])) {
            $title = BlogPost::where('title', 'LIKE', '%' . $_GET['searchTitle'] . '%')->simplePaginate(3);
            return view('posts.index', ['posts' => $title]);
        } 
    }
}
