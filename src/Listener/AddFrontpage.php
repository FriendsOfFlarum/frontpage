<?php
namespace fixer112\frontpage\Listener;
use Illuminate\Contracts\Events\Dispatcher;
use Flarum\Event\ConfigureApiController;

class AddFrontpage
{
    /**
     * @param Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(ConfigureApiController::class, [$this, 'confApi']);
    }
    /**
     * @param ConfigureApiController $event
     */
    public function confApi(ConfigureApiController $event)
    {
        $event->addSortField('frontdate');
    }
}