<?php

namespace App\Listeners;

use App\Events\TelemetryEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TelemetryListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TelemetryEvent $event): void
    {
        $telemetry = $event->telemetry;
    }
}
