<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;

class PostController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'post'  => 'required',
            'type'  => 'required',
            'image' => 'required'
        ]);
        $today = date("H:i:s");
        $today = $today . date("Ymd");
        $url = Storage::url("images/" . $today  . $request->image->getClientOriginalName());

        $post = new Post([
            'title' => $request->title,
            'post' => $request->post,
            'type' => $request->type,
            'image' => $request->getSchemeAndHttpHost() . $url,
        ]);
        $request->image->storeAs('/public/images', $today . $request->image->getClientOriginalName()  ); 

        return $post->save();
    }
}
