<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        if ($schema->hasColumn('discussions', 'frontpage') && $schema->hasColumn('discussions', 'frontdate')) {
            return;
        }
        $schema->table('discussions', function (Blueprint $table) {
            $table->boolean('frontpage')->default(0);
            $table->dateTime('frontdate')->nullable();
        });
    },
    'down' => function (Builder $schema) {
        $schema->table('discussions', function (Blueprint $table) {
            $table->dropColumn('frontpage');
            $table->dropColumn('frontdate');
        });
    },
];
