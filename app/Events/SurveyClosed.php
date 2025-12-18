<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Survey;
use App\Models\User;

class SurveyClosed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Survey $survey;
    public string $email;
    /**
     * Create a new event instance.
     */
    public function __construct(Survey $survey)
    {
        $this->survey = $survey;
        $this->email = User::find($survey->user_id)->email;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
