<?php

namespace FoF\FrontPage\Tests\integration\forum;

use Flarum\Discussion\Discussion;
use Flarum\Post\Post;
use Flarum\Testing\integration\TestCase;
use FoF\FrontPage\Tests\integration\ExtensionDepsTrait;
use PHPUnit\Framework\Attributes\Test;

class FrontPageFulltextSearchTest extends TestCase
{
    use ExtensionDepsTrait;

    public function setUp(): void
    {
        parent::setUp();

        $this->extensionDeps();

        // MySQL and MariaDB only index FULLTEXT columns on commit, so the rows go in outside the test's transaction.
        $this->database()->rollBack();

        $this->database()->table('discussions')->insert($this->rowsThroughFactory(Discussion::class, [
            ['id' => 1, 'title' => 'lightsail off the front page', 'user_id' => 1, 'comment_count' => 1, 'frontpage' => 0],
            ['id' => 2, 'title' => 'lightsail on the front page', 'user_id' => 1, 'comment_count' => 1, 'frontpage' => 1],
            ['id' => 3, 'title' => 'something else on the front page', 'user_id' => 1, 'comment_count' => 1, 'frontpage' => 1],
        ]));

        $this->database()->table('posts')->insert($this->rowsThroughFactory(Post::class, [
            ['id' => 1, 'discussion_id' => 1, 'user_id' => 1, 'type' => 'comment', 'content' => '<t><p>first</p></t>'],
            ['id' => 2, 'discussion_id' => 2, 'user_id' => 1, 'type' => 'comment', 'content' => '<t><p>second</p></t>'],
            ['id' => 3, 'discussion_id' => 3, 'user_id' => 1, 'type' => 'comment', 'content' => '<t><p>third</p></t>'],
        ]));

        $this->database()->beginTransaction();

        $this->populateDatabase();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->database()->table('discussions')->delete();
        $this->database()->table('posts')->delete();
    }

    #[Test]
    public function the_frontpage_filter_narrows_a_search(): void
    {
        $response = $this->send(
            $this->request('GET', '/api/discussions', [
                'authenticatedAs' => 1,
            ])->withQueryParams([
                'filter' => ['q' => 'lightsail', 'frontpage' => 1],
            ])
        );

        $this->assertSame(200, $response->getStatusCode());

        $data = json_decode($response->getBody()->getContents(), true);
        $this->assertSame(['2'], array_column($data['data'], 'id'));
    }
}
