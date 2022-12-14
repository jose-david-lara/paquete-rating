<?php

namespace Laraveles\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Rating extends Pivot
{
    protected $table = 'ratings';
    protected $guarded = [];
    protected $casts = [
        'rating' => 'float',
    ];
    protected $dates = [
        'approved_at',
    ];

    public function rateable()
    {
        return $this->morphTo();
    }

    public function qualifier()
    {
        return $this->morphTo();
    }

    public function approve()
    {
        $this->approved_at = Carbon::now();
    }

    public function scopeApproved(Builder $builder): Builder
    {
        return $builder->whereNotNull('approved_at');
    }

    public function scopeNotApproved(Builder $builder): Builder
    {
        return $builder->whereNull('approved_at');
    }
}
