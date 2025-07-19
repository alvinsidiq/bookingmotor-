<?php
namespace App\Events;

use App\Models\Review;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReviewCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $review;

    public function __construct(Review $review)
    {
        $this->review = $review;
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('admin'),
        ];
    }

    public function broadcastWith(): array
    {
        return [
            'review_id' => $this->review->id,
            'motorcycle_name' => $this->review->motorcycle->name,
            'user_name' => $this->review->user->name,
            'rating' => $this->review->rating,
            'comment' => $this->review->comment ?? 'No comment provided.',
        ];
    }
}