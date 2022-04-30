<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\CommentValidation;
use App\Models\BlogPost;

class CommentController extends Controller
{
    public function store(CommentValidation $request,  $id)
    {
        $blogPost = BlogPost::findOrFail($id);
        $blogPost->comments()->create([
            'content' => $request->input('content'),
            'user_id' => $request->user()->id,
        ]);
         return back()->with('success','Commented succesfully.');
    }
}
