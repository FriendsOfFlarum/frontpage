<?php

use Flarum\Database\Migration;
use Flarum\Group\Group;

return Migration::addPermissions([
    'discussion.front' => Group::MODERATOR_ID,
]);
