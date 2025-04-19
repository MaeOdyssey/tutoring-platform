<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Course;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bio',
        'specialty',
        'availability',
        'profile_picture',
    ];

    // 🔗 Relationships

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
