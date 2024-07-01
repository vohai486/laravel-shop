<?php

namespace App\Jobs;

use App\Mail\Ordered;
use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class NotifyUserCreatedOrdered implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Order $order, public User $user)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user)->send(new Ordered($this->order));
    }
}
