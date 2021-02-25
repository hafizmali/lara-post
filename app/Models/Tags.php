<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    protected $table = 'tags';

    public function threads()
    {
        return $this->belongsToMany(Thread::class);
    }
}
