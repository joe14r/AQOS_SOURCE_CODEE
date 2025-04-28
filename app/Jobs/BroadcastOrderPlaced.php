<?php
namespace App\Jobs;

use App\Events\OrderPlaced;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class BroadcastOrderPlaced implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $order;

    /**
     * Create a new job instance.
     *
     * @param Order $order
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            // Broadcasting the event
            broadcast(new OrderPlaced($this->order));
        } catch (\Exception $e) {
            // Log the error if broadcasting fails
            Log::error('Error broadcasting OrderPlaced event', [
                'error' => $e->getMessage(),
                'order_id' => $this->order->id,
            ]);
        }
    }
}