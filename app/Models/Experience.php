<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'user_id',
        'job_title',
        'company_details',
        'description',
    ];

    protected $casts = [
        // Removed date casts since we're storing as string now
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
