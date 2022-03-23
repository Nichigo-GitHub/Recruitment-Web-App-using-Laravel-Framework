<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function index($user, \App\Models\Language $languages)
    {
        $user = User::findOrFail($user);
        return view('profile', [
            'user' => $user,
            'languages' => $languages,
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
            $image_to_replace = $user->image;
            $image_replaced = public_path("storage/{$image_to_replace}");
            unlink($image_replaced);

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

    public function additional($user)
    {
        $user = User::findOrFail($user);
        return view('add_info', [
            'user' => $user,
        ]);
    }

    public function update_info(\App\Models\Profile $user)
    {
        $data = request()->validate([
            'expected_salary' => '',
            'preferred_work_location' => '',
            'other_info' => '',
        ]);

        DB::table('profiles')->where('id', $user->id)->update([
            'expected_salary' => request('expected_salary'),
            'preferred_work_location' => request('preferred_work_location'),
            'other_info' => request('other_info'),    
        ]);         
        
        return redirect('/resume/'.auth()->user()->id."/add_info");
    }

    public function languages($user)
    {
        $user = User::findOrFail($user);

        $languages = DB::table('languages')->where('user_id', $user->id)->get();

        return view('languages', [
            'user' => $user,
            'languages' => $languages,
        ]);
    }

    public function update_languages(\App\Models\Profile $user, Request $request)
    {
        $i = 0;

        do {
            $i++;

            DB::table('languages')->where('id', $request->id)->update([     
                'language' => request('language_'.$request->id),
                'proficiency' => request('proficiency_'.$request->id),
            ]);        
        } while ( $i <= 5);

        echo 'bruh';
        
        return redirect('/resume/'.auth()->user()->id."/languages");
    }

}
