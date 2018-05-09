<?php

/*
 * This file is part fixer\flarum-frontpage flarum extension.
 *
 * (c) Abubakar Lawal <abula3003@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace fixer112\frontpage\Gambit;

use Flarum\Core\Search\AbstractRegexGambit;
use Flarum\Core\Search\AbstractSearch;

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
        $search->getQuery()->where('frontpage', ! $negate);
    }
}
