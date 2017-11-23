<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @author Andsalves
 */
class User extends Model {

    protected $fillable = ['id', 'name', 'email', 'username', 'password', 'type', 'status'];

}
