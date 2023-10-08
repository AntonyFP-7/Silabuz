<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;
    protected $fillable = ['name','album_id', 'artist_id'];
    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }
    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}
