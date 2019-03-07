<?php

/*
 * This file is part of fof/frontpage.
 *
 * Copyright (c) 2019 FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\FrontPage\Gambits;

use Flarum\Search\AbstractRegexGambit;
use Flarum\Search\AbstractSearch;

class FrontGambit extends AbstractRegexGambit
{
    /**
     * {@inheritdoc}
     */
    protected $pattern = 'is:frontpage';

    /**
     * {@inheritdoc}
     */
    protected function conditions(AbstractSearch $search, array $matches, $negate)
    {
        $search->getQuery()->where('frontpage', !$negate);
    }
}
