<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Carbon;

class UsersTableSeeder extends Seeder
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
        // 1
        DB::table('users')->insert([
        'firstname'       => 'Walk-up',
        'lastname'        => '',
        'email'           => 'walkup@walkup.com',
        'password'        =>  bcrypt('Mayborn152'),
        'role_id'         => 1,
        'organization_id' => 1,
        'type'            => 'walk-up',
        'membership_id'   => 1,
        'address'         => '6200 W Central Texas Expwy',
        'city'            => 'Killeen',
        'state'           => 'Texas',
        'zip'             => '76549',
        'country'         => 'United States',
        'phone'           => '(254) 526-7161',
        'active'          => false,
        'staff'           => false,
        'creator_id'      => 1,
        'created_at'      => $date,
      ]);
        // 2
        DB::table('users')->insert([
        'firstname'       => 'Mayborn Science Theater',
        'lastname'        => '',
        'email'           => 'planetarium@ctcd.edu',
        'password'        =>  bcrypt('Mayborn152'),
        'role_id'         => 6,
        'organization_id' => 2,
        'type'            => 'organization',
        'membership_id'   => 1,
        'address'         => '6200 W Central Texas Expwy',
        'city'            => 'Killeen',
        'state'           => 'Texas',
        'zip'             => '76549',
        'country'         => 'United States',
        'phone'           => '(254) 526-7161',
        'active'          => false,
        'staff'           => false,
        'creator_id'      => 1,
        'created_at'      => $date,
      ]);
        // 3
        DB::table('users')->insert([
        'firstname'       => 'Anderson',
        'lastname'        => 'Fernandes',
        'email'           => 'anderson.fernandes@ctcd.edu',
        'password'        =>  bcrypt('admin'),
        'role_id'         => 2,
        'organization_id' => 2,
        'type'            => 'individual',
        'membership_id'   => 1,
        'address'         => '6200 W Central Texas Expwy',
        'city'            => 'Killeen',
        'state'           => 'Texas',
        'zip'             => '76549',
        'country'         => 'United States',
        'phone'           => '(254) 526-7161',
        'active'          => true,
        'staff'           => true,
        'creator_id'      => 1,
        'created_at'      => $date,
      ]);
        // 4
        DB::table('users')->insert([
        'firstname'       => 'Central Texas College',
        'lastname'        => '',
        'email'           => 'contact@ctcd.edu',
        'password'        =>  bcrypt('Mayborn152'),
        'role_id'         => 6,
        'organization_id' => 3,
        'type'            => 'organization',
        'membership_id'   => 1,
        'address'         => '6200 W Central Texas Expwy',
        'city'            => 'Killeen',
        'state'           => 'Texas',
        'zip'             => '76549',
        'country'         => 'United States',
        'phone'           => '(254) 526-7161',
        'active'          => false,
        'staff'           => false,
        'creator_id'      => 1,
        'created_at'      => $date,
      ]);
    }
}
