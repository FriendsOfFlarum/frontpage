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

class AddFrontPage
{
    /**
     * @param WillGetData $event
     */
    public function handle(WillGetData $event)
    {
        $event->addSortField('frontdate');
    }
}
