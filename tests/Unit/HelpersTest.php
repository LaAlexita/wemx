<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class HelpersTest extends TestCase
{
    public function test_helpers_file_is_autoloaded(): void
    {
        $this->assertFileExists(__DIR__.'/../../app/helpers.php',
            'app/helpers.php must exist — it is composer-autoloaded.');
    }

    public function test_composer_autoloads_helpers(): void
    {
        $composer = json_decode(file_get_contents(__DIR__.'/../../composer.json'), true);
        $files = $composer['autoload']['files'] ?? [];

        $this->assertContains('app/helpers.php', $files,
            'composer.json must autoload app/helpers.php via autoload.files.');
    }
}
