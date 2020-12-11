<?php
use Carbon\Carbon;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	
    	DB::table('roles')->delete();
        DB::table('roles')->insert(
        	[
	        	[
		            'name' => 'admin',
		            'guard_name' => 'web',
		            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
		            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
	        	],
	        	[
		            'name' => 'vendor',
		            'guard_name' => 'web',
		            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
		            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
	        	],
	        	[
		            'name' => 'user',
		            'guard_name' => 'web',
		            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
		            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
	        	]
	        ]
    	);
    }
}
