<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'videos';
    protected $fillable=['name','user_id' , 'thread_id'];
    public function videoDetails()
    {
        return $this->hasMany(VideoDetails::class);
    }
}
