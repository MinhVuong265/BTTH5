<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;
use Database\Factories\UserFactory;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        
        $staffMembers = Staff::all();

        User::factory()->count(5)->create([
            'staff_id' => function () use (&$staffMembers) {
                // Lấy ra một staff từ danh sách và xóa nó khỏi danh sách
                $staff = $staffMembers->shift();
                return $staff->id;
            },
            'role' => 'staff',
            'password' => Hash::make('password'), // Mật khẩu mặc định là 'password'
        ]);    
    }
}
