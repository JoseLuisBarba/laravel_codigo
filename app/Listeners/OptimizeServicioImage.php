<?php

namespace App\Listeners;

use App\Events\ServicioSaved;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OptimizeServicioImage implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ServicioSaved  $event
     * @return void
     */
    public function handle(ServicioSaved $event)
    {
        //
        $image = Image::make(Storage::get($event->servicio->image))
            ->widen(600)
            ->limitColors(255)
            ->encode();
        Storage::put($event->servicio->image, (string) $image);
    }
}
