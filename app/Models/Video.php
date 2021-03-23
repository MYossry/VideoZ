<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Video extends Model
{
    use HasFactory;
    protected $table = 'videos';
    
    protected $filable =[
        'body',
        'video'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
