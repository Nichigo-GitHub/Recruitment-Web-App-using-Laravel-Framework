<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create($user)
    {
        $user = User::findOrFail($user);
        return view('posts.create', [
            'user' => $user,
        ]);
    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'required',
            'image' => ['required', 'image']
        ]);

        $image_path = request('image')->store('uploads', 'public');

        $image = Image::make(public_path("storage/{$image_path}"))->fit(1080, 810);
        $image->save();

        auth()->user()->posts()->create([
            'title' => $data['title'],
            'image' => $image_path,
        ]);

        return redirect('/resume/'.auth()->user()->id);
    }

    public function update(\App\Models\User $user, \App\Models\Post $post)
    {
        return view('posts.update', compact('user', 'post'));
    }

    public function updated(\App\Models\Post $post)
    {
        $data = request()->validate([
            'image' => 'image'
        ]);

        if(request('image') != NULL) {
            $image_to_replace = $post->image;
            $image_replaced = public_path("storage/{$image_to_replace}");
            unlink($image_replaced);

            $image_path = request('image')->store('uploads', 'public');
            $image = Image::make(public_path("storage/{$image_path}"))->fit(1080, 810);
            $image->save();

            DB::table('posts')->where('id', $post->id)->update([
                'image' => $image_path,    
            ]);  
        } else {

        }
        
        if (request('title') != NULL) {
            DB::table('posts')->where('id', $post->id)->update([
                'title' => request('title'),    
            ]);            
        } else {
            
        }                

        return redirect('/resume/'.auth()->user()->id."/portfolio/create");
    }

    public function show(\App\Models\User $user, \App\Models\Post $post)
    {
        return view('posts.show', compact('user', 'post'));
    }

    public function delete(\App\Models\Post $post)
    {
        DB::table('posts')->where('id', '=', $post->id)->delete();

        $image_to_delete = $post->image;
        $image_deleted = public_path("storage/{$image_to_delete}");
        unlink($image_deleted);

        return redirect('/resume/'.auth()->user()->id."/portfolio/create");
    }
}
