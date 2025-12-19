<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Pizza;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_loads(): void
    {
        Pizza::factory()->count(3)->create();

        $this->get('/')
            ->assertStatus(200)
            ->assertSeeText('PizzaPlanet'); // mas safe kesa 'Pizza'
    }
}
