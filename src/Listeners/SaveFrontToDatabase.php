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
use Flarum\User\AssertPermissionTrait;
use Flarum\Discussion\Event\Saving;

class SaveFrontToDatabase
{
    use AssertPermissionTrait;

    /**
     * @param Saving $event
     * @throws \Flarum\User\Exception\PermissionDeniedException
     */
    public function handle(Saving $event)
    {
        if (isset($event->data['attributes']['frontpage'])) {
            $front = (bool)$event->data['attributes']['frontpage'];
            $discussion = $event->discussion;
            $actor = $event->actor;
            $this->assertCan($actor, 'front', $discussion);
            if ((bool)$discussion->frontpage === $front) {
                return;
            }
            $discussion->frontdate = new DateTime();

            $discussion->frontpage = $front;
        }
    }
}
