<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Post;
use App\Model\Tag;
use Illuminate\Support\Facades\Auth;
use App\Model\Category;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    protected $validator =[
        'title' => 'required|max:255',
        'content' => 'required',
        'category_id' => 'exists:App\Model\Category,id',
        'tags.*' => 'nullable|exists:App\Model\Tag,id',
        'image' => 'nullable|image'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.posts.index', compact('posts'));
    }

    public function indexUser()
    {
        $posts = Post::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('admin.posts.create', ['categories' => $categories, 'tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validator);
        
        $data = $request->all();
        
        $data['user_id'] = Auth::user()->id;
        $data['author'] = Auth::user()->name;


        if (!empty($data["image"])) {
            $img_path = Storage::put("uploads", $data["image"]);
            $data["image"] = $img_path;
        }

        $newPost = new Post();

        $newPost->fill($data);
        $newPost->slug = $newPost->createSlug($data['title']);
        $newPost->save();

        if (!empty($data['tags'])) {
            $newPost->tags()->attach($data['tags']);
        }
        return redirect()->route('admin.posts.show', $newPost->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view("admin.posts.show", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if (Auth::user()->id != $post->user_id) {
            abort('403');
        }
        $tags = Tag::all();
        $categories = Category::all();
       return view("admin.posts.edit", ['post' => $post, 'categories' => $categories,'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate($this->validator);
        
        if (Auth::user()->id != $post->user_id) {
            abort('403');
        }

        $data = $request->all();

        if (!empty($data['image'])) {
            Storage::delete($post->image);
            $img_path = Storage::put('uploads', $data['image']);
            $post->image = $img_path;
        }

        if ($data['title'] != $post->title) {
            $post->title = $data['title'];
            $post->slug = $post->createSlug($data['title']);
        }
        if ($data['content'] != $post->content) {
            $post->content = $data['content'];
        }
        if ($data['category_id'] != $post->category_id) {
            $post->category_id = $data['category_id'];
        }
       

        $update = $post->update();

         if (!empty($data['tags'])) {
            $post->tags()->sync($data['tags']);
        } else {
            $post->tags()->detach();
        }


        if(!$update) {
            dd("save non riuscito");
        }

        return redirect()->route("admin.posts.show", $post);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (Auth::user()->id != $post->user_id) {
            abort('403');
        }
        $post->tags()->detach();
        $delete = $post->delete();
        return redirect()->route("admin.posts.index")
        ->with("status", "hai eliminato $post->title correttamente");
    }
}
