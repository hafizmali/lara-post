<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Nicolaslopezj\Searchable\SearchableTrait;

class Thread extends Model
{

    protected $fillable=['subject','thread','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tags::class,'tag_thread');
    }

    public function video()
    {
        return $this->hasOne(Video::class,'thread_id');
    }


}
