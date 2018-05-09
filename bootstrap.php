<?php

/*
 * This file is part fixer\flarum-frontpage flarum extension.
 *
 * (c) Abubakar Lawal <abula3003@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use fixer112\frontpage\Listener;
use Illuminate\Contracts\Events\Dispatcher;

return function (Dispatcher $events) {
	$events->subscribe(Listener\AddApiAttributes::class);
    $events->subscribe(Listener\AddClientAssets::class);
    $events->subscribe(Listener\SaveFrontToDatabase::class);
    $events->subscribe(Listener\AddFrontpage::class);
    $events->subscribe(Listener\FilterFrontpage::class);
};
