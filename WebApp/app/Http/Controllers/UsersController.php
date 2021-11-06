<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update_identity(\App\Models\User $user)
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required',
            'contact_number' => '',
        ]);

        DB::table('users')->where('id', $user->id)->update([
            'name' => request('name'),
            'email' => request('email'),
            'contact_number' => request('contact_number'),    
        ]);         
        
        return redirect('/resume/'.auth()->user()->id."/edit");
    }
}
