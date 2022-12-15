<?php

namespace Laraveles\Rating\Events;

use Laraveles\Rating\Contracts\Qualifier;
use Laraveles\Rating\Contracts\Rateable;

class ModelUnrated
{
    private Qualifier $qualifier;

    private Rateable $rateable;

    public function __construct(Qualifier $qualifier, Rateable $rateable)
    {
        $this->qualifier = $qualifier;
        $this->rateable = $rateable;
    }

    /**
     * @return Qualifier
     */
    public function getQualifier(): Qualifier
    {
        return $this->qualifier;
    }

    /**
     * @return Rateable
     */
    public function getRateable(): Rateable
    {
        return $this->rateable;
    }
}
