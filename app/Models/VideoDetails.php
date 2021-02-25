<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoDetails extends Model
{
    protected $table = 'videos_details';
    protected $fillable=['video_id','filename'];
    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}
