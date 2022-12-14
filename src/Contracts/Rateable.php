<?php

namespace Laraveles\Contracts;

interface Rateable
{

    public function averageRating(): float;

    public function getkey();

    public function name(): string;

    public function qualifications();

    public function hasRateBy(Qualifier $model): bool;

}
