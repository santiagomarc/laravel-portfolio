<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'full_name',
        'title',
        'phone',
        'location',
        'website',
        'linkedin',
        'github',
        'bio',
        'profile_image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
