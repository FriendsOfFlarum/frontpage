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

use Flarum\Api\Event\WillGetData;
use Illuminate\Contracts\Events\Dispatcher;

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

        $sort = isset($_GET['sort']);
        if (!$sort) {
            $event->setSort(['frontdate' => 'asc']);
        }

    }
}