<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function sendMessage(Request $request)
    {
        return response()->json([
            'response' => true,
            'results' =>  $request->all(),
        ]);
    }
}
