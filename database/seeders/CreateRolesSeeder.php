<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CreateRolesSeeder extends Seeder
{

    public function run(): void
    {
        $role_client = Role::create(['name' => 'client']);
        $role_business = Role::create(['name' => 'business']);

        $userClient = User::create([
            'email' => 'client@gmail.com',
            'name' => 'Client',
            'password' => Hash::make('asdasdasd'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $userClient->assignRole($role_client);

        $userBusiness = User::create([
            'email' => 'business@gmail.com',
            'name' => 'Business',
            'password' => Hash::make('asdasdasd'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $userBusiness->assignRole($role_business);
    }
}
