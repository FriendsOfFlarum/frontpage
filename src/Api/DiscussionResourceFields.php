<?php

namespace FoF\FrontPage\Api;

use Flarum\Api\Context;
use Flarum\Api\Endpoint\Update;
use Flarum\Api\Schema\Boolean;
use Flarum\Api\Schema\Date;
use Flarum\Discussion\Discussion;

class DiscussionResourceFields
{
    public function __invoke(): array
    {
        return [
            Boolean::make('frontpage')
                ->writable(function (Discussion $discussion, Context $context) {
                    return $context->endpoint instanceof Update
                        && $context->getActor()->can('front', $discussion);
                }),

            Date::make('frontdate')
                ->get(fn (Discussion $discussion) => $discussion->frontdate),

            Boolean::make('front')
                ->get(fn (Discussion $discussion, Context $context) => $context->getActor()->can('front', $discussion)),
        ];
    }
}
