<?php

namespace Laraveles\Rating\Tests\Models;

use Illuminate\Database\Eloquent\Model;

class SimplePage extends Model
{
    protected $table = 'pages';

    protected $fillable = [
        'name',
    ];
}
