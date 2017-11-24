<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;

/**
 * @author Andsalves
 */
class User extends Model implements \Illuminate\Contracts\Auth\Authenticatable {
    use Authenticatable;

    protected $fillable = ['id', 'name', 'email', 'username', 'password', 'type', 'status'];

    // @override
    public function setAttribute($key, $value) {
        $isRememberTokenAttribute = $key == $this->getRememberTokenName();
        if (!$isRememberTokenAttribute) {
            parent::setAttribute($key, $value);
        }
    }

}
