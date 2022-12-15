<?php

namespace Laraveles\Rating\Traits;

trait CanBeRated
{
    /**
     * @param  string|null  $modelType
     * @param  bool  $approved
     * @return HasMany
     */
    public function qualifications(string $modelType = null, bool $approved = false): HasMany
    {
        $hasMany = $this->hasMany(config('rating.models.rating'), 'rateable_id');

        if ($modelType) {
            $hasMany->where('qualifier_type', $modelType);
        }

        if ($approved) {
            $hasMany->whereNotNull('approved_at');
        }

        return $hasMany
            ->where('rateable_type', $this->getMorphClass());
    }

    /**
     * @param  Qualifier|Model  $model
     * @return bool
     */
    public function hasRateBy(Qualifier $model): bool
    {
        return $this->qualifications()
            ->where('qualifier_id', $model->getKey())
            ->where('qualifier_type', get_class($model))
            ->exists();
    }

    public function qualifiers(string $model = null)
    {
        $modelClass = $model ? (new $model)->getMorphClass() : $this->getMorphClass();

        return $this->morphToMany($modelClass, 'rateable', 'ratings', 'rateable_id', 'qualifier_id')
            ->withPivot('qualifier_type', 'score')
            ->wherePivot('qualifier_type', $modelClass)
            ->wherePivot('rateable_type', $this->getMorphClass());
    }

    public function averageRating(string $model = null): float
    {
        return $this->qualifiers($model)->avg('score') ?: 0.0;
    }
}
