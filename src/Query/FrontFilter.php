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

use Flarum\Search\Filter\FilterInterface;
use Flarum\Search\SearchState;
use Flarum\Search\AbstractQueryState;
use Illuminate\Database\Query\Builder;

class FrontFilter implements FilterInterface
{
    /**
     * @return string
     */

    /**
     * @return string
     */
    public function getFilterKey(): string
    {
        return 'frontpage';
    }

    public function conditions(AbstractQueryState $search, array $matches, $negate)
    {
        $this->constrain($search->getQuery(), $negate);
    }

    public function filter(SearchState $state, array|string $value, bool $negate): void
    {
        $this->constrain($state->getQuery(), $negate);
    }

    protected function constrain(\Illuminate\Database\Eloquent\Builder $query, bool $actor): void
    {
        $query->where('frontpage', !$actor);
    }
}
