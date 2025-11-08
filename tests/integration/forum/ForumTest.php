<?php

namespace FoF\FrontPage\Tests\integration\forum;

use Flarum\Testing\integration\RetrievesAuthorizedUsers;
use Flarum\Testing\integration\TestCase;
use FoF\FrontPage\Tests\integration\ExtensionDepsTrait;
use PHPUnit\Framework\Attributes\Test;

class ForumTest extends TestCase
{
    use RetrievesAuthorizedUsers;
    use ExtensionDepsTrait;

    public function setUp(): void
    {
        parent::setUp();

        $this->extensionDeps();
    }

    #[Test]
    public function testExtensionBootsAndSerializesCorrectly()
    {
        $response = $this->send($this->request('GET', '/'));

        $this->assertEquals(200, $response->getStatusCode());

        $body = (string) $response->getBody();

        $this->assertStringStartsWith('<!doctype html>', $body);
        $this->assertStringContainsString('</html>', $body);
    }
}