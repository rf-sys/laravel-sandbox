<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::latest()
            ->filter(request(['search', 'category', 'author']))
            ->paginate(6)
            ->withQueryString();

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    public function show(Post $post): View
    {
        return view('posts.show', [
            'post' => $post,
        ]);
    }

    public function create(): View
    {
        return view('posts.create');
    }

    public function store(): RedirectResponse
    {
        $attributes = request()->validate([
            'title' => 'required',
            'slug' => ['required', Rule::unique('posts', 'slug')],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);

        $attributes['user_id'] = auth()->id();

        Post::create($attributes);

        return redirect('/');
    }

}
