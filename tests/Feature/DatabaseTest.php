<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use RolesTableSeeder;
use Tests\TestCase;

class DatabaseTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRolesTable()
    {
        $this->seed(RolesTableSeeder::class);

        $this->assertDatabaseHas('roles', [
            'name'        => 'walk-up',
            'description' => 'Walk-up account.',
            'type'        => 'walk-up',
        ]);
    }
}
