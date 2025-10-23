<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'category',
        'proficiency_level',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
