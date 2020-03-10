<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MigrationsTest extends TestCase
{
    /**
     * Testing the migrations without seeding the database.
     *
     * @return void
     */
    public function testMigrateFresh()
    {
        $this->artisan('migrate:fresh')->assertExitCode(0);
    }

    /**
     * Testing the migrations with seed.
     *
     * @return void
     */
    public function testMigrateFreshSeed()
    {
        $this->artisan('migrate:fresh --seed')->assertExitCode(0);
    }

    /**
     * Testing the migrations refresh without seeding the database.
     *
     * @return void
     */
    public function testMigrateRefresh()
    {
        $this->artisan('migrate:refresh')->assertExitCode(0);
    }

    /**
     * Testing the migrations with seed.
     *
     * @return void
     */
    public function testMigrateRefreshSeed()
    {
        $this->artisan('migrate:refresh --seed')->assertExitCode(0);
    }
}
