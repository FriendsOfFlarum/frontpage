<?php

/*
 * This file is part of fof/frontpage.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\FrontPage\Query;

use Flarum\Filter\FilterInterface;
use Flarum\Filter\FilterState;
use Flarum\Query\AbstractQueryState;
use Flarum\Search\AbstractRegexGambit;
use Illuminate\Database\Query\Builder;

class FrontFilterGambit extends AbstractRegexGambit implements FilterInterface
{
    /**
     * @return string
     */
    public function getGambitPattern()
    {
        return 'is:frontpage';
    }

    /**
     * @return string
     */
    public function getFilterKey(): string
    {
        return 'frontpage';
    }

    /**
     * @param AbstractQueryState $search
     * @param array              $matches
     * @param mixed              $negate
     *
     * @return void
     */
    public function conditions(AbstractQueryState $search, array $matches, $negate)
    {
        $this->constrain($search->getQuery(), $negate);
    }

    /**
     * @param FilterState $search
     * @param string      $filterValue
     * @param mixed       $negate
     *
     * @return void
     */
    public function filter(FilterState $filterState, string $filterValue, bool $negate)
    {
        $this->constrain($filterState->getQuery(), $negate);
    }

    protected function constrain(Builder $query, bool $negate)
    {
        $query->where('frontpage', !$negate);
    }
}
