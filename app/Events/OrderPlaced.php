<?php
namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Events\Dispatchable;

class OrderPlaced implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;

    public function __construct(Order $order)
        {
            $this->order = $order;
            Log::info('OrderPlaced event triggered', ['order_id' => $order->id]);
        }
    public function broadcastWith()
        {
            Log::info('Broadcasting OrderPlaced event', ['order_id' => $this->order->id]);
            return [
                'order_id' => $this->order->id,
                'order_details' => $this->order, // or any other data you want to send
            ];
        }
    public function broadcastOn()
        {
            return new Channel('order-channel');
        }

    // public function broadcastOn()
    // {
    //     return new PrivateChannel('my-channel');
    // }

    public function broadcastAs()
    {
        return 'order-event';
    }
}
