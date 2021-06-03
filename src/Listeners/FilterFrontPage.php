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

class FilterFrontPage
{

    /**
     * @param ConfigureDiscussionGambits $event
     *
     * @return [type]
     */
    public function handle(ConfigureDiscussionGambits $event)
    {
        $event->gambits->add(FrontGambit::class);
    }
}
