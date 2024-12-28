<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Whiteboard extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_id',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }
    
    public function participants()
    {
        return $this->belongsToMany(User::class, 'whiteboard_user')
        ->withTimestamps();
    }
}
