<?php

namespace Laraveles\Rating\Exceptions;

use Exception;

class InvalidScore extends Exception
{
    //

    private $from;

    private $to;

    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function rendered()
    {
        return response()->json([
            trans('rating.invalidScore', [
                'from' => $this->from,
                'to' => $this->to,
            ]),
        ]);
    }
}
