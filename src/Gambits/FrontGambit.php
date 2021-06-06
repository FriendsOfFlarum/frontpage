<?php

/*
 * This file is part of fof/frontpage.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\FrontPage\Gambits;

use Flarum\Query\AbstractQueryState;
use Flarum\Search\AbstractRegexGambit;

class FrontGambit extends AbstractRegexGambit
{
    /**
     * @return [type]
     */
    public function getGambitPattern()
    {
        return 'is:frontpage';
    }

    /**
     * @param AbstractQueryState $search
     * @param array              $matches
     * @param mixed              $negate
     *
     * @return [type]
     */
    public function conditions(AbstractQueryState $search, array $matches, $negate)
    {
        $search->getQuery()->where('frontpage', !$negate);
    }
}
