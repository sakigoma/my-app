<?php

namespace App\Http\Controllers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;

class PostController extends Controller
{
    public function create() {
        return view('post.create');
    }

    public function store(Request $request) {
        // Gate::authorize('test');

        $validated = $request->validate([
            'title' => 'required|max:20',
            'body' => 'required|max:400',
        ]);

        $validated['user_id'] = auth()->id();

        $post = Post::create($validated);

        $request->session()->flash('message', '保存しました');
        return back();
    }

    public function index() {
        // $posts = Post::all();
        $posts = Post::paginate(10);
        $like = Like::where('post_id', $post->id)->where('user_id', auth()->user()->id)->first();
        return view('post.index', compact('posts', 'like'));
    }

    public function show(Post $post) {
        $like = Like::where('post_id', $post->id)->where('user_id', auth()->user()->id)->first();
        return view('post.show', compact('post', 'like'));
    }

    public function edit(Post $post) {
        return view('post.edit', compact('post'));
    }

    public function update(Request $request, Post $post) {
        $validated = $request->validate([
            'title' => 'required|max:20',
            'body' => 'required|max:400',
        ]);

        $validated['user_id'] = auth()->id();

        $post->update($validated);

        $request->session()->flash('message', '更新しました');
        return back();
    }

    public function destroy(Request $request, Post $post) {
        $post->delete();
        $request->session()->flash('message', '削除しました');
        return redirect()->route('post.index');
    }
}


