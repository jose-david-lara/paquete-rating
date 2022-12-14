<?php

namespace Laraveles\Rating\Traits;

use Laraveles\Rating\Contracts\Rateable;
use Laraveles\Rating\Events\ModelRated;
use Laraveles\Rating\Exceptions\InvalidScore;

trait CanRate
{
    public function ratings($model = null)
    {
        $modelClass = $model ? $model : $this->getMorphClass();

        $morphoToMany = $this->morphToMany(
            $modelClass,
            'qualifier',
            'ratings',
            'qualifier_id',
            'rateable_id'
        );

        $morphoToMany
            ->as('rating')
            ->withTimestamps()
            ->withPivot('score', 'rateable_type')
            ->wherePivot('rateable_type', $modelClass)
            ->wherePivot('qualifier_type', $this->getMorphClass());

        return $morphoToMany;
    }

    /**
     * @throws InvalidScore
     */
    public function rate(Rateable $model, float $score, string $comments = null): bool
    {
        if ($this->hasRated($model)) {
            return false;
        }

        $from = config('rating.from');
        $to = config('rating.to');

        if ($score < $from || $score > $to) {
            throw new InvalidScore($from, $to);
        }

        $this->ratings($model)->attach($model->getKey(), [
            'score' => $score,
            'comments' => $comments,
            'rateable_type' => get_class($model),
        ]);

        event(new ModelRated($this, $model, $score));

        return true;
    }

    public function unrate(Rateable $model): bool
    {
        if (! $this->hasRated($model)) {
            return false;
        }

        $this->ratings($model->getMorphClass())->detach($model->getKey());

        return true;
    }

    public function hasRated(Rateable $model): bool
    {
        return ! is_null($this->ratings($model->getMorphClass())->find($model->getKey()));
    }
}
