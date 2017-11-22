<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Film extends Model {

    protected $fillable = ['name', 'description', 'release_date', 'rating', 'ticket_price', 'country', 'genre', 'photo'];

    protected $table = 'films';

}
