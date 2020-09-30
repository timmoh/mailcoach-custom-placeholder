<?php

namespace Timmoh\MailcoachCustomPlaceholder\Tests;

use CreateJobBatchesTable;
use CreateMailcoachPlaceholderTables;
use CreateMailcoachTables;
use CreateMediaTable;
use CreateUsersTable;
use CreateWebhookCallsTable;
use Illuminate\Foundation\Testing\WithFaker;
use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\TestTime\TestTime;

abstract class TestCase extends Orchestra {

    use WithFaker;

    public function setUp(): void {
        parent::setUp();

        $this->withFactories(__DIR__ . '/../database/factories');
        $this->withoutExceptionHandling();
        TestTime::freeze();
    }

    public function assertHtmlWithoutWhitespace(string $expected, string $actual) {
        $expected = $this->stripWhitespace($expected);
        $actual   = $this->stripWhitespace($actual);

        $this->assertEquals($expected, $actual);
    }

    private function stripWhitespace(string $text) {
        $contentWithoutWhitespace = preg_replace('/\s/', '', $text);
        $contentWithoutWhitespace = str_replace(PHP_EOL, '', $contentWithoutWhitespace);

        return $contentWithoutWhitespace;
    }

    public function assertMatchesHtmlSnapshotWithoutWhitespace(string $content) {
        $contentWithoutWhitespace = preg_replace('/\s/', '', $content);

        $contentWithoutWhitespace = str_replace(PHP_EOL, '', $contentWithoutWhitespace);

        $this->assertMatchesHtmlSnapshot($contentWithoutWhitespace);
    }

    protected function getEnvironmentSetUp($app) {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set(
            'database.connections.sqlite',
            [
                'driver'   => 'sqlite',
                'database' => ':memory:',
                'prefix'   => '',
            ]
        );

        include_once __DIR__ . '/../vendor/spatie/laravel-mailcoach/database/migrations/create_mailcoach_tables.php.stub';
        (new CreateMailcoachTables())->up();

        include_once __DIR__ . '/../database/migrations/create_mailcoach_placeholder_tables.php.stub';
        (new CreateMailcoachPlaceholderTables())->up();
    }
}
