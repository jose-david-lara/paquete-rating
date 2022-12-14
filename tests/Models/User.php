<?php

namespace Laraveles\Rating\Tests\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laraveles\Contracts\Rating;
use Laraveles\Traits\CanBeRated;
use Laraveles\Traits\CanRate;

class User extends Authenticatable implements Rating
{

    use CanRate, CanBeRated;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function name(): string
    {
        return $this->name;
    }

}
