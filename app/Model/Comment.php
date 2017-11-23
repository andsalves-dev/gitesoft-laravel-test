<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

    protected $fillable = ['comment', 'name', 'user_id', 'film_id'];

}
