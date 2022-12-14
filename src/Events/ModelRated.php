<?php

namespace Laraveles\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Laraveles\Contracts\Qualifier;
use Laraveles\Contracts\Rateable;

class ModelRated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private Qualifier $qualifier;
    private Rateable $ratable;
    private float $score;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Qualifier $qualifier, Rateable $ratable, float $score)
    {
        //
        $this->qualifier = $qualifier;
        $this->ratable = $ratable;
        $this->score = $score;
    }

    /**
     * @return Model
     */
    public function getQualifier(): Qualifier
    {
        return $this->qualifier;
    }

    /**
     * @return Model
     */
    public function getRateable(): Rateable
    {
        return $this->ratable;
    }

    /**
     * @return float
     */
    public function getScore(): float
    {
        return $this->score;
    }




    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
