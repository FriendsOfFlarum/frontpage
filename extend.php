<?php

/*
 * This file is part of fof/frontpage.
 *
 * Copyright (c) 2019 FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\FrontPage;

use Flarum\Api\Event\Serializing;
use Flarum\Api\Event\WillGetData;
use Flarum\Discussion\Discussion;
use Flarum\Discussion\Event\Saving;
use Flarum\Event\ConfigureDiscussionGambits;
use Flarum\Extend;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__ . '/js/dist/forum.js')
        ->css(__DIR__ . '/resources/less/forum.less'),
    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js'),
    new Extend\Locales(__DIR__ . '/resources/locale'),
    (new Extend\Event)
        ->listen(Serializing::class, Listeners\AddApiAttributes::class)
        ->listen(Saving::class, Listeners\SaveFrontToDatabase::class)
        ->listen(WillGetData::class, Listeners\AddFrontPage::class)
        ->listen(ConfigureDiscussionGambits::class, Listeners\FilterFrontPage::class),
    (new Extend\Model(Discussion::class))
        ->dateAttribute('frontdate')
];
