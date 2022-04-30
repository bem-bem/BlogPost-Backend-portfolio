<?php

namespace App\Models;

use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogPost extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new LatestScope);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //child table of image in OneToOne polymorphic
    public function image()
    {
        return $this->morphOne(Image::class, 'imageble');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
