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

use DateTime;
use Flarum\Discussion\Event\Saving;
use Flarum\User\AssertPermissionTrait;
use Illuminate\Contracts\Events\Dispatcher;

class SaveFrontToDatabase
{
    use AssertPermissionTrait;

    /**
     * @param Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(Saving::class, [$this, 'whenDiscussionWillBeSaved']);
    }

    /**
     * @param Saving $event
     * @throws \Flarum\User\Exception\PermissionDeniedException
     */
    public function whenDiscussionWillBeSaved(Saving $event)
    {
        if (isset($event->data['attributes']['frontpage'])) {
            $front = (bool) $event->data['attributes']['frontpage'];
            $discussion = $event->discussion;
            $actor = $event->actor;
            $this->assertCan($actor, 'front', $discussion);
            if ((bool) $discussion->frontpage === $front) {
                return;
            }

            $discussion->frontdate = $front ? new DateTime() : null;

            $discussion->frontpage = $front;
        }
    }
}