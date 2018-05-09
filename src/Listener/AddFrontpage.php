<?php

/*
 * This file is part fixer\flarum-frontpage flarum extension.
 *
 * (c) Abubakar Lawal <abula3003@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
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