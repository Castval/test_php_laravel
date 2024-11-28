<?php

namespace Tests\Feature;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tests\TestCase;

class SecureEndpointTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testEndpointProtection(): void
    {
        $this->withoutExceptionHandling();

        try {
            $this->get('/api/breweries/list', []);
        } catch (AuthenticationException $e) {
            $this->assertEquals('Unauthenticated.', $e->getMessage());
            return;
        }
    }
}
