<?php

/*
 * This file is part of fof/frontpage.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\FrontPage;

use Flarum\Search\Database\DatabaseSearchDriver;
use Flarum\Discussion\Discussion;
use Flarum\Discussion\Search\DiscussionSearcher;
use Flarum\Extend;
use Flarum\Api\Resource;
use Flarum\Api\Sort\SortColumn;
use FoF\FrontPage\Api\DiscussionResourceFields;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/resources/less/forum.less'),

    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),
    new Extend\Locales(__DIR__.'/resources/locale'),

    (new Extend\Model(Discussion::class))
        ->cast('frontdate', 'datetime')
        ->cast('frontpage', 'bool'),

    (new Extend\ApiResource(Resource\DiscussionResource::class))
        ->fields(DiscussionResourceFields::class),

    (new Extend\ApiResource(Resource\DiscussionResource::class))
        ->sorts(fn () => [
            SortColumn::make('frontdate'),
        ]),

    (new Extend\ServiceProvider())
        ->register(Provider\FrontpageSortmapProvider::class),

    (new Extend\Middleware('forum'))
        ->add(Middleware\AddFrontpageFilter::class),

    (new Extend\SearchDriver(DatabaseSearchDriver::class))
        ->addFilter(DiscussionSearcher::class, Query\FrontFilter::class),
];
