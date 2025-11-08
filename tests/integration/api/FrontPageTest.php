<?php

namespace FoF\FrontPage\Tests\integration\forum;

use Carbon\Carbon;
use Flarum\Discussion\Discussion;
use Flarum\Post\Post;
use Flarum\Testing\integration\RetrievesAuthorizedUsers;
use Flarum\Testing\integration\TestCase;
use Flarum\User\User;
use Flarum\Group\Group;
use Flarum\Tags\Tag;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\DataProvider;
use FoF\FrontPage\Tests\integration\ExtensionDepsTrait;

class FrontPageTest extends TestCase
{
    use RetrievesAuthorizedUsers;
    use ExtensionDepsTrait;

    public function setUp(): void
    {
        parent::setUp();

        $this->extensionDeps();

        $this->prepareDatabase([
            User::class => [
                $this->normalUser(),
                ['id' => 3, 'username' => 'moderator', 'email' => 'moderator@machine.local', 'is_email_confirmed' => 1],
            ],
            'group_user' => [
                ['user_id' => 3, 'group_id' => Group::MODERATOR_ID],
            ],
            'group_permission' => [
                ['group_id' => Group::MODERATOR_ID, 'permission' => 'tag2.viewForum'],
                ['group_id' => Group::MODERATOR_ID, 'permission' => 'tag2.discussion.front'],
            ],
            Discussion::class => [
                ['id' => 1, 'title' => 'Admin Testing Discussion 1', 'user_id' => 1, 'created_at' => Carbon::now(), 'comment_count' => 2],
                ['id' => 2, 'title' => 'Moderator Discussion 1', 'user_id' => 3, 'created_at' => Carbon::now(), 'comment_count' => 2],
                ['id' => 3, 'title' => 'Regular Testing Discussion 1', 'user_id' => 2, 'created_at' => Carbon::now(), 'comment_count' => 2],
            ],
            Post::class => [
                ['id' => 1, 'discussion_id' => 1, 'user_id' => 1, 'type' => 'comment', 'content' => 'post 1', 'created_at' => Carbon::now()],
                ['id' => 2, 'discussion_id' => 1, 'user_id' => 1, 'type' => 'comment', 'content' => 'post 2', 'created_at' => Carbon::now()],
                ['id' => 3, 'discussion_id' => 2, 'user_id' => 2, 'type' => 'comment', 'content' => 'post 1', 'created_at' => Carbon::now()],
                ['id' => 4, 'discussion_id' => 2, 'user_id' => 1, 'type' => 'comment', 'content' => 'post 2', 'created_at' => Carbon::now()],
                ['id' => 5, 'discussion_id' => 3, 'user_id' => 2, 'type' => 'comment', 'content' => 'post 1', 'created_at' => Carbon::now()],
                ['id' => 6, 'discussion_id' => 3, 'user_id' => 3, 'type' => 'comment', 'content' => 'post 2', 'created_at' => Carbon::now()],
            ],
            Tag::class => [
                ['id' => 1, 'name' => 'Admin Lounge', 'slug' => 'admin-lounge', 'description' => 'Admin Lounge Tag description', 'color' => '#FF0000', 'is_primary' => 1, 'position' => 0, 'parent_id' => null, 'is_restricted' => true, 'is_hidden' => false],
                ['id' => 2, 'name' => 'Moderator Lounge', 'slug' => 'moderator-lounge', 'description' => 'Moderator Lounge Tag description', 'color' => '#FF0000', 'is_primary' => 1, 'position' => 1, 'parent_id' => null, 'is_restricted' => true, 'is_hidden' => false],
                ['id' => 3, 'name' => 'Public', 'slug' => 'public', 'description' => 'Public tag', 'color' => '#00AA00', 'is_primary' => 1, 'position' => 2, 'parent_id' => null, 'is_restricted' => false, 'is_hidden' => false],
            ],
            'discussion_tag' => [
                ['discussion_id' => 1, 'tag_id' => 1],
                ['discussion_id' => 2, 'tag_id' => 2],
                ['discussion_id' => 3, 'tag_id' => 3],
            ],
        ]);
    }

    #[DataProvider('actorResponseProvider')]
    public static function actorResponseProvider(): array
    {
        return [
            // Admin (1): allowed everywhere
            'admin marking discussion 1 as frontpage' => [1, 1, 200],
            'admin marking discussion 2 as frontpage' => [1, 2, 200],
            'admin marking discussion 3 as frontpage' => [1, 3, 200],

            // Moderator (3): allowed on discussion 2 and 3
            'moderator marking discussion 1 as frontpage' => [3, 1, 404],
            'moderator marking discussion 2 as frontpage' => [3, 2, 200],
            'moderator marking discussion 3 as frontpage' => [3, 3, 200],

            // Member (2): never allowed
            'member marking discussion 1 as frontpage' => [2, 1, 404],
            'member marking discussion 2 as frontpage' => [2, 2, 404],
            'member marking discussion 3 as frontpage' => [2, 3, 403],
        ];
    }

    #[Test]
    #[DataProvider('actorResponseProvider')]
    public function testActorReceivesExpectedResponse(int $userId, int $discussionId, int $expectedStatus): void
    {
        $response = $this->send(
            $this->request('PATCH', '/api/discussions/' . $discussionId, [
                'authenticatedAs' => $userId,
                'json' => [
                    'data' => [
                        'type' => 'discussions',
                        'attributes' => [
                            'frontpage' => true,
                        ],
                    ],
                ],
            ])
        );

        $this->assertSame($expectedStatus, $response->getStatusCode());
    }
}