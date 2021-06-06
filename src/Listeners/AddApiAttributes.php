<?php

/*
 * This file is part of fof/frontpage.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\FrontPage\Listeners;

use Flarum\Api\Serializer\DiscussionSerializer;
use Flarum\Discussion\Discussion;

class AddApiAttributes
{
    /**
     * @param DiscussionSerializer $serializer
     * @param Discussion           $discussion
     * @param array                $attributes
     *
     * @return array
     */
    public function __invoke(DiscussionSerializer $serializer, Discussion $discussion, array $attributes): array
    {
        $attributes['frontpage'] = (bool) $discussion->frontpage;
        $attributes['frontdate'] = $serializer->formatDate($discussion->frontdate);
        $attributes['front'] = (bool) $serializer->getActor()->can('front', $discussion);

        return $attributes;
    }
}
