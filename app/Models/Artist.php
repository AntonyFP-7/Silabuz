<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'image','gender_id'];
    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }
    public function songs()
    {
        return $this->hasMany(Song::class);
    }
}
