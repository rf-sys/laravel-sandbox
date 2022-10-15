<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    public function index(): View
    {
        return view('admin.posts.index', [
            'posts' => Post::paginate(50)
        ]);
    }

    public function create(): View
    {
        return view('admin.posts.create');
    }

    public function store(): RedirectResponse
    {
        $attributes = array_merge($this->validatePost(), [
            'user_id' => auth()->id(),
            'thumbnail' => request()->file('thumbnail')->store('thumbnails')
        ]);

        Post::create($attributes);

        return redirect('/');
    }

    public function edit(Post $post): View
    {
        return view('admin.posts.edit', [
            'post' => $post
        ]);
    }

    public function update(Post $post): RedirectResponse
    {
        $attributes = $this->validatePost($post);

        if (request()->hasFile('thumbnail')) {
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }

        $post->update($attributes);

        return back()->with('success', 'Post Updated!');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return back()->with('success', 'Post Deleted!');
    }

    /**
     * @param Post|null $post
     * @return array<string, mixed>
     */
    protected function validatePost(?Post $post = null): array
    {
        $post ??= new Post();

        return request()->validate([
            'title' => 'required',
            'thumbnail' => $post->exists() ? ['image'] : ['required', 'image'],
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post)],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);
    }


}
