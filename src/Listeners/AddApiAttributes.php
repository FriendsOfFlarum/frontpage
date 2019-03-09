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
use Flarum\Discussion\Discussion;
use Flarum\Event\ConfigureModelDates;
use Flarum\Api\Event\Serializing;
use Illuminate\Contracts\Events\Dispatcher;

class AddApiAttributes
{
    /**
     * @param Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(Serializing::class, [$this, 'prepareApiAttributes']);
        $events->listen(ConfigureModelDates::class, [$this, 'addDates']);
    }

    /**
     * @param ConfigureModelDates $event
     */
    public function addDates(ConfigureModelDates $event)
    {
        if ($event->isModel(Discussion::class)) {
            $event->dates[] = 'frontdate';
        }
    }

    /**
     * @param Serializing $event
     */
    public function prepareApiAttributes(Serializing $event)
    {
        if ($event->isSerializer(DiscussionSerializer::class)) {
            $event->attributes['frontpage'] = (bool)$event->model->frontpage;
            $event->attributes['frontdate'] = $event->formatDate($event->model->frontdate);
            $event->attributes['front'] = (bool)$event->actor->can('front', $event->model);
        }
    }
}
