<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class WhenTheProductIsCreatedListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        logger("Start listener " . __METHOD__);

        // Simulate an execution of a Listener to see the Job in operation
        sleep(20);

        logger("Stop listener " . __METHOD__);

    }
}