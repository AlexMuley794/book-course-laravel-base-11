<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);
        return view('dashboard.category.index', compact('categories'));
    }

    public function create()
    {
        return view('dashboard.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
        ]);

        Category::create($request->all());
        return to_route('category.index')->with('status', 'Categoría creada correctamente');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('dashboard.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $category->update($request->all());
        return redirect()->route('category.index')->with('status', 'Categoría actualizada correctamente');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('category.index')->with('status', 'Categoría eliminada correctamente');
    }
}

