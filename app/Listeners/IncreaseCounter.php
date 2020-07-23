<?php

namespace App\Listeners;

use App\Events\VideoViewer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncreaseCounter
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle(VideoViewer $event)
    {
        if (!session()->has('VideoIsVisted')) {
            $this->updateviews($event->video);
        } else {
            return false;
        }
    }

    function updateviews($video)
    {
        $video->viewers = $video->viewers + 1;
          $video->save();
        session()-> put('VideoIsVisted', $video->id);
    }
}
