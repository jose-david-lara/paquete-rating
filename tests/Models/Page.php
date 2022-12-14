<?php

namespace Laraveles\Rating\Tests\Models;

use Laraveles\Contracts\Rating;
use Laraveles\Traits\CanBeRated;
use Laraveles\Traits\CanRate;

class Page extends Model implements Rating
{

    use CanRate, CanBeRated;

    protected $fillable = [
      'name',
    ];

    public function name(): string
    {
        return $this->name;
    }

    public function getkey()
    {
        // TODO: Implement getkey() method.
    }
}
