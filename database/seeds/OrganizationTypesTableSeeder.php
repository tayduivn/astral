<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Carbon;

class OrganizationTypesTableSeeder extends Seeder
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

        DB::table('organization_types')->insert([
          'name'        => 'System',
          'description' => 'System category time.',
          'taxable'     => false,
          'creator_id'  => 1,
          'created_at'  => $date,
        ]);

        DB::table('organization_types')->insert([
          'name'        => 'Non Profit',
          'description' => 'All non profit organizations should fall under this category.',
          'taxable'     => false,
          'creator_id'  => 1,
          'created_at'  => $date,
        ]);

        DB::table('organization_types')->insert([
          'name'        => 'Community College',
          'description' => 'All 2 year colleges should fall under this category.',
          'taxable'     => false,
          'creator_id'  => 1,
          'created_at'  => $date,
        ]);

        DB::table('organization_types')->insert([
          'name'        => 'Public School',
          'description' => 'All public schools should be under this category',
          'taxable'     => false,
          'creator_id'  => 1,
          'created_at'  => $date,
        ]);
    }
}
