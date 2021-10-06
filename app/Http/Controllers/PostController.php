<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use Symfony\Component\VarDumper\Caster\StubCaster;

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

        return $post->save();
    }

    public function getAll(){
        return Post::get();
    }

    public function getbyid($id){
        
        return Post::where('id', $id)
                ->get();
    }

    public function update(Request $request){
        $orig = Post::find($request->id);
      
        $request->validate([
            'title' => 'required',
            'post'  => 'required',
            'type'  => 'required',
            'image' => 'required'
        ]);
        if($request->image != $orig->image)
        {
            $today = date("H:i:s");
            $today = $today . date("Ymd");
            $url = Storage::url("images/" . $today  . $request->image->getClientOriginalName());
            $request->image->storeAs('/public/images', $today . $request->image->getClientOriginalName()  ); 
            $orig->image = $request->getSchemeAndHttpHost() . $url;

        }

        $orig->title = $request->title;
        $orig->post  = $request->post;
        $orig->type  = $request->type;
     
        return $orig->update();
       
   

    }

    public function delete($id){

        $post = Post::find($id);
      return  $post->delete();
      
    }

}
