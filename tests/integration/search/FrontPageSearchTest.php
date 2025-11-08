<?php

namespace FoF\FrontPage\Tests\integration\forum;

use Carbon\Carbon;
use Flarum\Discussion\Discussion;
use Flarum\Group\Group;
use Flarum\Post\Post;
use Flarum\Tags\Tag;
use Flarum\Testing\integration\RetrievesAuthorizedUsers;
use Flarum\Testing\integration\TestCase;
use Flarum\User\User;
use FoF\FrontPage\Tests\integration\ExtensionDepsTrait;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

class FrontPageSearchTest extends TestCase
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
            ],
            Discussion::class => [
                ['id' => 1, 'title' => 'Admin Testing Discussion 1', 'user_id' => 1, 'created_at' => Carbon::now(), 'comment_count' => 2, 'frontpage' => 0],
                ['id' => 2, 'title' => 'Moderator Discussion 1', 'user_id' => 3, 'created_at' => Carbon::now(), 'comment_count' => 2, 'frontpage' => 1],
                ['id' => 3, 'title' => 'Regular Testing Discussion 1', 'user_id' => 2, 'created_at' => Carbon::now(), 'comment_count' => 2, 'frontpage' => 1],
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

    #[DataProvider('frontpageCounts')]
    public static function frontpageCounts(): array
    {
        return [
            'admin sees 2 discussions with the frontpage filter'     => [1, 2],
            'moderator sees 2 discussions with the frontpage filter' => [3, 2],
            'member sees 1 discussion with the frontpage filter'    => [2, 1],
        ];
    }

    #[Test]
    #[DataProvider('frontpageCounts')]
    public function test_frontpage_filter_count_only(int $userId, int $expectedCount): void
    {
        $response = $this->send(
            $this->request('GET', '/api/discussions', [
                'authenticatedAs' => $userId,
            ])->withQueryParams([
                'filter' => ['frontpage' => 1],
            ])
        );

        $this->assertSame(200, $response->getStatusCode());

        $data = json_decode($response->getBody()->getContents(), true);
        $this->assertArrayHasKey('data', $data);
        $this->assertCount($expectedCount, $data['data']);
    }
}
