<?php

namespace Tests;

use Devinci\LaravelEssentials\LoginCoreServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use PHPUnit\Framework\TestCase;

class LoginCoreServiceProviderTest extends TestCase
{
    public function testRegisterMethod()
    {
        $app = $this->createMock(Application::class);
        $provider = new LoginCoreServiceProvider($app);
        $this->assertNull($provider->register());
    }

    public function testBootMethod()
    {
        $app = $this->createMock(Application::class);
        $provider = new LoginCoreServiceProvider($app);
        $this->assertNull($provider->boot());
    }
}
