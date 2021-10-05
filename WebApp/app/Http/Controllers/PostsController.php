<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'required',
            'image' => ['required', 'image']
        ]);

        $image_path = request('image')->store('uploads', 'public');

        auth()->user()->posts()->create([
            'title' => $data['title'],
            'image' => $image_path,
        ]);

        return redirect('/profile/'.auth()->user()->id);
    }
}
