<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;
    // fillable => قابل للتعبئة
    protected $fillable = ['title', 'body', 'image']; // key table
    // to permission to store in key table
    // protected $guarded = [];
    // guarded to must all keys fillable
    // protected $table = 'posts';


    public function user()
    {
        // return $this->belongsTo('App\Models\User');
        return $this->belongsTo(User::class);
    }
}