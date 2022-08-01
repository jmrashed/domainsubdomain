<?php

namespace Jmrashed\DomainSubdomain\Tests;

use Jmrashed\DomainSubdomain\DomainSubdomainServiceProvider;

class TestCase extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        // additional setup
    }

    protected function getPackageProviders($app)
    {
        return [
            DomainSubdomainServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }
}
