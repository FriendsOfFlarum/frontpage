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

use Flarum\Search\Database\DatabaseSearchState;
use Flarum\Search\Filter\FilterInterface;
use Flarum\Search\SearchState;
use Illuminate\Database\Eloquent\Builder;

/**
 * @implements FilterInterface<DatabaseSearchState>
 */
class FrontFilter implements FilterInterface
{
    public function getFilterKey(): string
    {
        return 'frontpage';
    }

    public function filter(SearchState $state, string|array $value, bool $negate): void
    {
        $this->constrain($state->getQuery(), $negate);
    }

    protected function constrain(Builder $query, bool $negate): void
    {
        $query->where('frontpage', !$negate);
    }
}
