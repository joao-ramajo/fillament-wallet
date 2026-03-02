<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config([
            'database.default' => 'sqlite',
            'database.connections.sqlite.database' => ':memory:',
            'logging.default' => 'errorlog',
            'logging.channels.auth.driver' => 'errorlog',
            'logging.channels.dashboard.driver' => 'errorlog',
            'logging.channels.expense.driver' => 'errorlog',
            'logging.channels.category.driver' => 'errorlog',
            'logging.channels.source.driver' => 'errorlog',
            'logging.channels.xlsx.driver' => 'errorlog',
            'logging.channels.import.driver' => 'errorlog',
            'logging.channels.export.driver' => 'errorlog',
            'logging.channels.mail.driver' => 'errorlog',
        ]);

        $this->artisan('migrate');
    }
}
