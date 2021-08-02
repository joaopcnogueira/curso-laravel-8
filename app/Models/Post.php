<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // indica a tabela que o model representa
    protected $table = 'posts';

    protected $fillable = ['title', 'image', 'content'];
}
