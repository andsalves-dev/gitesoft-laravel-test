<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @author Andsalves
 */
class Genre extends Model {

    protected $fillable = ['name', 'slug'];

    protected $table = 'genres';

    public function films() {
        return $this->belongsToMany(Film::class);
    }
}