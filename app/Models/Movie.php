<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = 'movies';
    protected $fillable = [
        'title', 'description', 'duration', 
        'release_date','poster_url', 'bg_url',
        'status', 'category', 'actor','diretor',
        'country','trailer_url'
    ];
    protected $guarded = ['movie_id'];
    protected $primaryKey = 'movie_id';
    protected $dates = ['created_at', 'updated_at'];
    protected $dateFormat = 'Y-m-d H:i:s';

    // Một phim có nhiều suất chiếu
    public function showtimes() {
        return $this->hasMany(ShowTime::class, 'movie_id', 'movie_id');
    }

}
