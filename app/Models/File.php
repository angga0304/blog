<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class File extends Model
{
    protected $fillable = [
        'original_name',
        'generated_name'
    ];

    public function Post() {
        return $this->hasMany(Post::class, 'file_id');
    }
}
