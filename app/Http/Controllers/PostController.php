<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'ASC')->paginate(5);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(StoreUpdatePost $request)
    {
        $data = $request->all();
        if ($request->image->isValid()){

            $nameFile = Str::of($request->title)->slug('-') . '.' .$request->image->getClientOriginalExtension();

            $image = $request->image->storeAs('public/posts', $nameFile);
            $image = str_replace('public/', '', $image);
            $data['image'] = $image;
        }

        $post = Post::create($data);
        return redirect()
                ->route('posts.index')
                ->with('message', 'Post criado com sucesso!');
    }

    public function show($id)
    {
        $post = Post::where('id', $id)->first();
        if (!$post) {
            return redirect()->route('posts.index');
        }
        return view('admin.posts.show', compact('post'));
    }

    public function delete($id)
    {
        $post = Post::where('id', $id)->first();
        if (!$post)
            return redirect()->route('posts.index');

        if (Storage::exists("public/{$post->image}"))
            Storage::delete("public/{$post->image}");

        $post->delete();
        return redirect()
                ->route('posts.index')
                ->with('message', 'Post deletado com sucesso!');
    }

    public function edit($id)
    {
        $post = Post::where('id', $id)->first();
        if (!$post)
            return redirect()->route('posts.index');
        
        return view('admin.posts.edit', compact('post'));
    }

    public function update(StoreUpdatePost $request, $id)
    {
        $post = Post::where('id', $id)->first();
        if (!$post)
            return redirect()->route('posts.index');
        
        $data = $request->all();
        if ($request->image && $request->image->isValid()){

            if (Storage::exists("public/{$post->image}"))
                Storage::delete("public/{$post->image}");

            $nameFile = Str::of($request->title)->slug('-') . '.' .$request->image->getClientOriginalExtension();

            $image = $request->image->storeAs('public/posts', $nameFile);
            $image = str_replace('public/', '', $image);
            $data['image'] = $image;
        }

        $post->update($data);

        return redirect()
                ->route('posts.index')
                ->with('message', 'Post atualizado com sucesso!');
    }

    public function search(Request $request)
    {
        // dd("Pesquisando por {$request->search}");
        $filters = $request->except('_token');
        $posts = Post::where('title', 'LIKE', "%{$request->search}%")
                        ->orWhere('content', 'LIKE', "%{$request->search}%")
                        ->paginate(1);

        return view('admin.posts.index', compact('posts', 'filters'));
    }
}
