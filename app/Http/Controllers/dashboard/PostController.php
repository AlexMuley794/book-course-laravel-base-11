<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App;
use Illuminate\Http\Request;
use App\Http\Requests\Post\StoreRequest;
use Illuminate\Auth\Events\Validated;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // Obtén los posts con sus categorías
    $posts = App\Models\Post::with('category')->paginate(10);
    
    // Pasa los posts a la vista
    return view('dashboard.post.index', compact('posts'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::pluck('title', 'id'); // Primero 'title', luego 'id'
        return view('dashboard.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {

        Post::create($request->validated());
        return to_route('post.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Obtén el post con la categoría asociada
        $post = Post::with('category')->find($id);
    
        // Verifica si el post existe
        if (!$post) {
            return redirect()->route('post.index')->with('error', 'Post no encontrado');
        }
    
        // Devuelve la vista con el post
        return view('dashboard.post.show', compact('post'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::pluck('title', 'id'); // Primero 'title', luego 'id'
        return view('dashboard.post.edit', compact('categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts,slug,' . $post->id,
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id', // Verifica que exista en la BD
            'description' => 'nullable|string',
            'posted' => 'required|in:not,yes',
        ]);
    
        $post->update($request->all());
    
        return redirect()->route('post.index')->with('success', 'Post actualizado correctamente.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
{
    $post->delete();
    return redirect()->route('post.index')->with('success', 'Post eliminado correctamente.');
}
}
