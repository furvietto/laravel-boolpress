<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Post;
use Illuminate\Http\Request;

class PostControllerApi extends Controller
{
    public function index()
    {
        $posts = Post::paginate(10);

        return response()->json([
            'response' => true,
            'results' =>  $posts,
        ]);
    }
}
