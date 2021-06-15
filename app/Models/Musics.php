<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Musics extends Model
{
    protected $table = 'musics';
    /**
     * The attributes that are mass assignable.
     *
     * @param array
     */
    protected $fillable = [
        'url', 'title', 'type', 'album', 'artist', 'artwork'
    ]; 
    
}
