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

use DateTime;
use Flarum\Core\Access\AssertPermissionTrait;
use Flarum\Event\DiscussionWillBeSaved;
use Illuminate\Contracts\Events\Dispatcher;

class SaveFrontToDatabase
{
    use AssertPermissionTrait;

    /**
     * @param Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(DiscussionWillBeSaved::class, [$this, 'whenDiscussionWillBeSaved']);
    }

    /**
     * @param DiscussionWillBeSaved $event
     */
    public function whenDiscussionWillBeSaved(DiscussionWillBeSaved $event)
    {
        if (isset($event->data['attributes']['frontpage'])) {
            $front = (bool) $event->data['attributes']['frontpage'];
            $discussion = $event->discussion;
            $actor = $event->actor;

            $this->assertCan($actor, 'front', $discussion);

            if ((bool) $discussion->frontpage === $front) {
                return;
            }

            $attributes = array_get($event->data, 'attributes', []);
           

            $discussion->frontdate = new DateTime();
       

            $discussion->frontpage = $front;
        }
    }
}
