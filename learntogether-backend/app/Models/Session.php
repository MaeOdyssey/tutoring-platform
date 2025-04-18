<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Session extends Model
{
    use HasFactory;

    // This tells Laravel which fields are mass assignable (safely fillable from forms/API)
    protected $fillable = [
        'user_id',
        'date',
        'time',
        'status',
    ];

    // If you want: define relationship to User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
