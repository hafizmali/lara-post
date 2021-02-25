<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tagable extends Model
{
    protected $table = 'tag_thread';
    public function threadsTag()
    {
        return $this->belongsToMany(Tags::class);
    }
}
