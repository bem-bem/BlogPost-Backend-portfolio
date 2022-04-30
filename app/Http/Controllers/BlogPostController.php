<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\BlogPostValidation;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index', ['posts' => BlogPost::withCount('comments')->with('image')->with('user')->simplePaginate(3)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogPostValidation $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = $request->user()->id;
        $blogPost = BlogPost::create($validated);

        if ($request->hasFile('postImages')) {
            $path = $request->file('postImages')->store('postImages');
            $blogPost->image()->save(
                Image::make(['path' => $path])
            );
        }

        return redirect()->back()->with('success','New post has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blogPost = BlogPost::findOrFail($id);
        return view('posts.show', ['post' => $blogPost]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blogPost = BlogPost::findOrFail($id);
        $this->authorize('update', $blogPost);
        return view('posts.edit', ['post' => $blogPost]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function update(BlogPostValidation $request, $id)
    {
        $blogPost = BlogPost::findOrFail($id);
        $this->authorize('update', $blogPost);
        $validated = $request->validated();
        $blogPost->fill($validated);

        if ($request->hasFile('postImages')) {
            $path = $request->file('postImages')->store('postImages');

            if ($blogPost->image) {
                Storage::delete($blogPost->image->path);
                $blogPost->image->path = $path;
                $blogPost->image->save();
            } else {
                $blogPost->image()->save(
                    Image::make(['path' => $path])
                );
            }
        }

        $blogPost->save();
        return redirect()->route('Blog-post.index')->with('success', 'Post Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blogPost = BlogPost::findOrFail($id);
        $this->authorize('delete', $blogPost);
        Storage::delete($blogPost->image->path);
        $blogPost->delete();
        return redirect()->route('Blog-post.index')->with('success', 'Post Deleted successfully.');
    }
}
