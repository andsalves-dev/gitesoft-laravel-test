<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @author Andsalves
 */
class Film extends Model {

    protected $fillable = ['name', 'description', 'release_date', 'rating', 'ticket_price', 'country', 'photo', 'slug'];

    protected $table = 'films';

    public function genres() {
        return $this->belongsToMany(Genre::class, 'film_genre', 'film_slug', 'genre_slug', 'slug', 'slug');
    }

    public function toArray() {
        $data = parent::toArray();

        $data['genres'] = [];
        $data['genres_names'] = [];

        /** @var Genre $genre */
        foreach ($this->genres()->get()->toArray() as $key => $genre) {
            $data['genres'][$key] = ['name' => $genre['name'], 'slug' => $genre['slug'], 'id' => $genre['id']];
            $data['genres_names'][$key] = $genre['name'];
        }

        return $data;
    }
}
