<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        //! Administrator
        $adminRole    = Role::create(['name' => 'admin']);
        $employeeRole = Role::create(['name' => 'employee']);

        $adminAcc = User::create([
            'user_id'  => rand(),
            'name'     => 'Administrator',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make(123),
        ])->assignRole($adminRole);

        for ($i = 0; $i < 10; $i++) {
            //! Employee
            $fakerName = $faker->name();
            $birthdate = $faker->dateTimeBetween('-30 years', 'now')->format('Y-m-d');
            $employeeAcc = Employee::create([
                'employee_id' => 'EMPLOYEE' . rand(),
                'name'        => $fakerName,
                'email'       => str_replace(' ', '', strtolower($fakerName) . rand(100, 999) . '@test.com'),
                'birth_date'  => $birthdate,
                'gender'      => $faker->randomElement([0, 1]),
                'address'     => $faker->address(),
                'division'    => $faker->randomElement(['HRD', 'Marketing', 'Finance', 'IT', 'Creative']),
                'level'       => $faker->randomElement(['Manager', 'Staf']),
                'position'    => $faker->randomElement(['HR Manager', 'Digital Marketing', 'Finance Manager', 'Full Stack Web Developer', 'Designer']),
                'salary'      => $faker->numberBetween(4750000, 20000000),
            ]);
        }
    }
}
