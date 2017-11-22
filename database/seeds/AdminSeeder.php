<?php

class AdminSeeder extends DatabaseSeeder {

	public function run()
	{
		DB::table('users')->truncate(); // Using truncate function so all info will be cleared when re-seeding.
		DB::table('roles')->truncate();
		DB::table('role_users')->truncate();
		DB::table('activations')->truncate();

		$admin = Sentinel::registerAndActivate(array(
			'email'       => 'admin@admin.com',
			'password'    => "admin",
			'first_name'  => 'John',
			'last_name'   => 'Doe',
		));

		$adminRole = Sentinel::getRoleRepository()->createModel()->create([
			'name' => 'Admin',
			'slug' => 'admin',
			'permissions' => array('admin' => 1),
		]);

		Sentinel::getRoleRepository()->createModel()->create([
			'name'  => 'User',
			'slug'  => 'user',
		]);

		$admin->roles()->attach($adminRole);

		$this->command->info('Admin User created with username admin@admin.com and password admin');

        $superadmin = Sentinel::registerAndActivate(array(
            'email'       => 'superadmin@admin.com',
            'password'    => "pa55word65",
            'first_name'  => 'Super',
            'last_name'   => 'Admin',
        ));

        $adminRole = Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Super Admin',
            'slug' => 'superadmin',
            'permissions' => array('superadmin' => 1),
        ]);
        $superadmin->roles()->attach($adminRole);
        $this->command->info('Super Admin User created with username superadmin@admin.com and password pa55word65');
	}

}