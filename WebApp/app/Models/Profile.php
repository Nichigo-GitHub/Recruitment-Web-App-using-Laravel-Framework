<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function profile_picture()
    {
        $default_image = ($this->picture) ? '/storage/' . $this->picture : 'https://cdn.onlinewebfonts.com/svg/img_299586.png';
        return $default_image;
    }
}
