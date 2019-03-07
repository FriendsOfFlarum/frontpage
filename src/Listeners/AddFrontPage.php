<?php

/*
 * This file is part of fof/frontpage.
 *
 * Copyright (c) 2019 FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\FrontPage\Listeners;

use Illuminate\Contracts\Events\Dispatcher;
use Flarum\Api\Event\WillGetData;

class AddFrontPage
{
    /**
     * @param Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(WillGetData::class, [$this, 'confApi']);
    }

    /**
     * @param WillGetData $event
     */
    public function confApi(WillGetData $event)
    {
        $event->addSortField('frontdate');
    }
}
