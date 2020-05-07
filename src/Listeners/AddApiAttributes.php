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

use Flarum\Api\Serializer\DiscussionSerializer;
use Flarum\Api\Event\Serializing;

class AddApiAttributes
{
    /**
     * @param Serializing $event
     */
    public function handle(Serializing $event)
    {
        if ($event->isSerializer(DiscussionSerializer::class)) {
            $event->attributes['frontpage'] = (bool)$event->model->frontpage;
            $event->attributes['frontdate'] = $event->formatDate($event->model->frontdate);
            $event->attributes['front'] = (bool)$event->actor->can('front', $event->model);
        }
    }
}
