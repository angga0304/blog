<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
use App\Models\User;
use App\Models\Comment;
use App\Models\File;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;
    use Sluggable;
    use SluggableScopeHelpers;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'tag_id',
        'active',
        'file_id',
    ];

    public function tag() {
        return $this->belongsTo(Tag::class, 'tag_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments() {
        return $this->hasMany(Comment::class, 'post_id');
    }

    public function getListcommentAttribute() {
        return $this->comments()->whereNull('comment_id')->get();
    }

    public function getStatusAttribute() {
        return $this->active? 'aktif' : 'Arsip';
    }

    public function image() {
        return $this->belongsTo(File::class, 'file_id');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }
}
