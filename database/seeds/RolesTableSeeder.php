<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\Customer;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Role::truncate();
        DB::table('role_user')->truncate();

        $role1 = new Role;
        $role1->name = 'admin';
        $role1->display_name = 'Administration';
        $role1->description = 'Can access all modules';
        $role1->save();

        $role2 = new Role;
        $role2->name = 'user';
        $role2->display_name = 'Registed User';
        $role2->description = 'Can access what desserve';
        $role2->save();

		//add user
        $users = [
            [
                'name' => 'admin1',
                'email' => 'admin1@local.local',
                'password' => bcrypt('admin1'),
            ],
            [
                'name' => 'user1',
                'email' => 'user1@local.local',
                'password' => bcrypt('user1'),
            ],
        ];

        $n = 1;

        foreach ($users as $key => $value) {
            
            $user = User::create($value);

            $customer = new Customer;
            $customer->picture = Gravatar::get($value['email']);
            $user->cust()->save($customer);

            $user->attachRole($n);
            $n++;
        }
    }
}
