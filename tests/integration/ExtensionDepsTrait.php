<?php

namespace FoF\FrontPage\Tests\integration;

trait ExtensionDepsTrait
{
    public function extensionDeps(): void
    {
        $this->extension('flarum-tags');
        $this->extension('fof-frontpage');
    }
}
