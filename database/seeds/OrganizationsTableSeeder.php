<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Carbon;

class OrganizationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::createFromTimestampUTC(0)
        ->toDateTimeString();

        DB::table('organizations')->insert([
          'name'        => 'No Organization',
          'address'     => '6200 W Central Texas Expwy',
          'city'        => 'Killeen',
          'state'       => 'Texas',
          'zip'         => '76549',
          'country'     => 'United States',
          'phone'       => '(254) 526-7161',
          'email'       => 'astral@astral',
          'type_id'     => 1,
          'creator_id'  => 1,
          'created_at'  => $date,
        ]);

        DB::table('organizations')->insert([
          'name'        => 'Mayborn Science Theater',
          'address'     => '6200 W Central Texas Expwy',
          'city'        => 'Killeen',
          'state'       => 'Texas',
          'zip'         => '76549',
          'country'     => 'United States',
          'phone'       => '(254) 526-7161',
          'email'       => 'planetarium@ctcd.edu',
          'type_id'     => 2,
          'creator_id'  => 1,
          'created_at'  => now(config('app.timezone'))->toDateTimeString(),
        ]);

        DB::table('organizations')->insert([
          'name'        => 'Central Texas College',
          'address'     => '6200 W Central Texas Expwy',
          'city'        => 'Killeen',
          'state'       => 'Texas',
          'zip'         => '76549',
          'country'     => 'United States',
          'phone'       => '(254) 526-7161',
          'email'       => 'admissions@ctcd.edu',
          'type_id'     => 3,
          'creator_id'  => 1,
          'created_at'  => now(config('app.timezone'))->toDateTimeString(),
        ]);
    }
}
