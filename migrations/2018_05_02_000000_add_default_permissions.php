<?php

use Flarum\Group\Group;
use Flarum\Database\Migration;

return Migration::addPermissions([
    'discussion.front' => Group::MODERATOR_ID
]);
