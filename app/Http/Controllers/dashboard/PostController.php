<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display the list of posts.
     */
    public function index()
    {
        // Obtener todos los posts paginados
        $posts = Post::paginate(5);

        // Pasar los posts a la vista
        return view('dashboard.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new post.
     */
    public function create()
    {
        // Obtener todas las categorías para pasarlas a la vista como objetos completos
        $categories = Category::all();
        return view('dashboard.post.create', compact('categories'));
    }

    /**
     * Store a newly created post in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts,slug',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id', // Validar que la categoría exista
            'description' => 'nullable|string',
            'posted' => 'required|in:not,yes',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validación para la imagen
        ]);

        // Manejar la imagen si se sube
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName); // Guardar la imagen en la carpeta 'public/images'
        } else {
            $imageName = null; // Si no se ha subido una imagen
        }

        // Crear el post
        Post::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'posted' => $request->posted,
            'image' => $imageName, // Guardar el nombre de la imagen en la base de datos
        ]);

        // Redirigir con un mensaje de éxito
        return to_route('post.index')->with('status', 'Post creado correctamente');
    }

    /**
     * Display the specified post.
     */
    public function show($id)
    {
        // Obtener el post por su ID
        $post = Post::findOrFail($id); // Si no se encuentra el post, lanzará un error 404
        
        // Retornar la vista con el post
        return view('dashboard.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified post.
     */
    public function edit($id)
    {
        // Obtener el post a editar
        $post = Post::findOrFail($id);

        // Obtener todas las categorías para pasarlas a la vista
        $categories = Category::pluck('title', 'id');

        // Pasar el post y las categorías a la vista de edición
        return view('dashboard.post.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified post in storage.
     */
    public function update(Request $request, $id)
    {
        // Validar los datos
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts,slug,' . $id,
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id', // Validar que la categoría exista
            'description' => 'nullable|string',
            'posted' => 'required|in:not,yes',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validación para la imagen
        ]);

        // Obtener el post a editar
        $post = Post::findOrFail($id);

        // Manejar la imagen si se sube
        if ($request->hasFile('image')) {
            // Eliminar la imagen anterior si existe
            if ($post->image && file_exists(public_path('images/' . $post->image))) {
                unlink(public_path('images/' . $post->image));
            }

            // Guardar la nueva imagen
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = $post->image; // Mantener la imagen existente si no se sube una nueva
        }

        // Actualizar los datos del post
        $post->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'posted' => $request->posted,
            'image' => $imageName, // Guardar el nombre de la imagen en la base de datos
        ]);

        // Redirigir con un mensaje de éxito
        return to_route('post.index')->with('status', 'Post actualizado correctamente');
    }

    /**
     * Remove the specified post from storage.
     */
    public function destroy($id)
    {
        // Encontrar el post por su ID
        $post = Post::findOrFail($id);

        // Eliminar la imagen si existe
        if ($post->image) {
            $imagePath = public_path('images/' . $post->image);
            if (file_exists($imagePath)) {
                unlink($imagePath); // Eliminar la imagen del servidor
            }
        }

        // Eliminar el post de la base de datos
        $post->delete();

        // Redirigir a la lista de posts con un mensaje de éxito
        return to_route('post.index')->with('status', 'Post eliminado correctamente');
    }
}
