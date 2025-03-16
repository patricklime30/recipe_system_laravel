<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // cek user yang login
        $user = Auth::user()->id;
        
        // lihat daftar resep yang dibuat
        $recipe = Recipe::where('user_id', $user)->get();      
        
        return view('recipe.index', ['recipe' => $recipe]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('recipe.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // cek data apakah sesuai kriteria
        $request->validate([
            'title' => 'required|string|max:255',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // cek gambar yang diupload apabila ada ubah nama dan simpan di folder lokal storage
        if ($request->hasFile('image')) { 
            // Get the original file extension
            $extension = $request->file('image')->getClientOriginalExtension();
        
            // Create a unique filename using the recipe title and current timestamp
            $filename = Str::slug($request->title) . '-' . time() . '.' . $extension;

            // Store the image in the 'public/images' directory
            $imagePath = $request->file('image')->storeAs('images', $filename, 'public');
        }

        Recipe::create([
            'title' => $request->title,
            'ingredients' => $request->ingredients,
            'instructions' => $request->instructions,
            'image_path' => $imagePath,
            'cooking_time' => $request->cooking_time,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('recipe.index')->with('success', 'Recipe saved successfully!');
   
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // ambil resep id yang dipilih
        $recipe = Recipe::find($id);

        // Check if the recipe is favorited by the user
        $isFavorited = $recipe->favorites()->where('user_id', Auth::user()->id)->exists();

        return view('recipe.view', ['recipe'=>$recipe, 'isFavorited' => $isFavorited]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $recipe = Recipe::findOrFail($id);

        return view('recipe.edit', ['recipe' => $recipe]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'title' => $request->title,
            'ingredients' => $request->ingredients,
            'instructions' => $request->instructions,
            'cooking_time' => $request->cooking_time,
        ];

        // cek data resep yg lama
        $recipe = Recipe::findOrFail($id);
        
        if ($request->hasFile('image')) { 
             // Delete the old image if it exists
            if ($recipe->image_path) {
                Storage::delete($recipe->image_path);
            }
            // Get the original file extension
            $extension = $request->file('image')->getClientOriginalExtension();
        
            // Create a unique filename using the recipe title and current timestamp
            $filename = Str::slug($request->title) . '-' . time() . '.' . $extension;

            // Store the image in the 'public/images' directory
            $imagePath = $request->file('image')->storeAs('images', $filename, 'public');

            $data['image_path'] = $imagePath;
        }

        $recipe->update($data);

        return redirect()->route('recipe.index')->with('success', 'Recipe updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $recipe = Recipe::findOrFail($id);

        // Delete the image from storage if it exists
        if ($recipe->image_path) {
            Storage::delete($recipe->image_path);
        }

        // Delete the recipe from the database
        $recipe->delete();

        return redirect()->route('recipe.index')->with('success', 'Recipe deleted successfully.');
    }
}
