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

use Flarum\Extend;
use Illuminate\Events\Dispatcher;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__ . '/js/dist/forum.js')
        ->css(__DIR__ . '/resources/less/forum.less'),
    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js'),
    new Extend\Locales(__DIR__ . '/resources/locale'),
    function (Dispatcher $events) {
        $events->subscribe(Listeners\AddApiAttributes::class);
        $events->subscribe(Listeners\SaveFrontToDatabase::class);
        $events->subscribe(Listeners\AddFrontpage::class);
        $events->subscribe(Listeners\FilterFrontPage::class);
    },
];
