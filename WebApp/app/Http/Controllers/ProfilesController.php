<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function index($user)
    {
        $user = User::findOrFail($user);
        return view('profile', [
            'user' => $user,
        ]);
    }

    public function update($user)
    {
        $user = User::findOrFail($user);
        return view('edit', [
            'user' => $user,
        ]);
    }    

    public function update_profile_picture(\App\Models\Profile $user)
    {
        $data = request()->validate([
            'picture' => 'image'
        ]);
        
        if(request('picture') != NULL) {
            $image_to_replace = $user->picture;
            $image_replaced = Image::make(public_path("storage/{$image_to_replace}"));
            $image_replaced->destroy();

            $image_path = request('image')->store('profile pictures', 'public');
            $image = Image::make(public_path("storage/{$image_path}"))->fit(1080, 1080);
            $image->save();

            DB::table('users')->where('id', $user->id)->update([
                'picture' => $image_path,    
            ]);  
        } else {
            $image_path = request('image')->store('profile pictures', 'public');
            $image = Image::make(public_path("storage/{$image_path}"))->fit(1080, 1080);
            $image->save();

            DB::table('profiles')->where('id', $user->id)->update([
                'picture' => $image_path,    
            ]);  
        }

        auth()->user()->profile()->update($data);
        
        return redirect('/resume/'.auth()->user()->id."/edit");
    }

}
