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

use Flarum\Api\Controller\ListDiscussionsController;
use Flarum\Api\Serializer\DiscussionSerializer;
use Flarum\Core\Discussion;
use Flarum\Event\ConfigureModelDates;
use Flarum\Event\ConfigureApiController;
use Flarum\Event\PrepareApiAttributes;
use Illuminate\Contracts\Events\Dispatcher;

class AddApiAttributes
{
    /**
     * @param Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(PrepareApiAttributes::class, [$this, 'prepareApiAttributes']);
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
     * @param PrepareApiAttributes $event
     */
    public function prepareApiAttributes(PrepareApiAttributes $event)
    {
        if ($event->isSerializer(DiscussionSerializer::class)) {
            $event->attributes['frontpage'] = (bool) $event->model->frontpage;
            $event->attributes['frontdate'] = $event->formatDate($event->model->frontdate);
            $event->attributes['front'] = (bool) $event->actor->can('front', $event->model);
        }
    }
}
