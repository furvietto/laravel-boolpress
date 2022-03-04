<?php

namespace App\Http\Controllers\Admin;
use App\Model\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Post;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(20);

        return view('admin.categories.index', compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.categories.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            "name" => "required"
        ]);
        $data = $request->all();
        $newCategory = new Category();
        $newCategory->fill($data);
        $newCategory->slug = $newCategory->createSlug($data['name']);
        $newCategory->save();
        return redirect()->route("admin.categories.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact("category"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view("admin.categories.edit",compact("category"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validate = $request->validate([
            "name" => "required"
        ]);
        $data = $request->all();

        if ($data['name'] != $category->title) {
            $category->name = $data['name'];
            $category->slug = $category->createSlug($data['name']);
        }
        $update = $category->update($data);

        if(!$update) {
            dd("save non riuscito");
        }

        return redirect()->route("admin.categories.show", $category);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
       $category->delete();

        $posts = Post::whereNull("category_id")->get();

        foreach ($posts as $post) {
            $post->category_id = Category::inRandomOrder()->first()->id;
            $post->update();
        }

       return redirect()->route("admin.categories.index")
       ->with("status", "$category->name eliminato correttamente");
       ;
    }
}
