<?php

namespace Tests;

use Devinci\LaravelEssentials\EssentialServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use PHPUnit\Framework\TestCase;

class EssentialServiceProviderTest extends TestCase
{
    public function testRegisterMethod()
    {
        $app = $this->createMock(Application::class);
        $provider = new EssentialServiceProvider($app);
        $this->assertNull($provider->register());
    }

    public function testBootMethod()
    {
        $app = $this->createMock(Application::class);
        $provider = new EssentialServiceProvider($app);
        $this->assertNull($provider->boot());
    }
}
