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

use FoF\FrontPage\Gambits\FrontGambit;
use Flarum\Event\ConfigureDiscussionGambits;
use Illuminate\Contracts\Events\Dispatcher;

class FilterFrontPage
{
    /**
     * @param Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(ConfigureDiscussionGambits::class, [$this, 'addStickyGambit']);
    }

    /**
     * @param ConfigureDiscussionGambits $event
     */
    public function addStickyGambit(ConfigureDiscussionGambits $event)
    {
        $event->gambits->add(FrontGambit::class);
    }
}
