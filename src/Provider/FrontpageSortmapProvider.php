<?php

namespace FoF\FrontPage\Provider;

use Flarum\Foundation\AbstractServiceProvider;

class FrontpageSortmapProvider extends AbstractServiceProvider
{
    public function register()
    {
        $this->container->extend('flarum.forum.discussions.sortmap', function (array $options) {
            return array_merge($options, [
                'front' => '-frontdate',
            ]);
        });
    }
}
