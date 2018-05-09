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

use Flarum\Event\ConfigureWebApp;
use Illuminate\Contracts\Events\Dispatcher;
use Flarum\Event\ConfigureLocales;

class AddClientAssets
{
    /**
     * @param Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(ConfigureWebApp::class, [$this, 'addAssets']);
        $events->listen(ConfigureLocales::class, [$this, 'configLocales']);
    }

    /**
     * @param ConfigureClientView $event
     */
    public function addAssets(ConfigureWebApp $event)
    {
        if ($event->isForum()) {
            $event->addAssets([
                __DIR__.'/../../js/forum/dist/extension.js',
                __DIR__.'/../../less/forum/extension.less'
            ]);
            $event->addBootstrapper('fixer112/frontpage/main');
        }

        if ($event->isAdmin()) {
            $event->addAssets([
                __DIR__.'/../../js/admin/dist/extension.js'
            ]);
            $event->addBootstrapper('fixer112/frontpage/main');
        }
    }

    public function configLocales(ConfigureLocales $event)
    {
        $event->locales->addTranslations('en', __DIR__.'/../../locale/en.yml');
    }
}
