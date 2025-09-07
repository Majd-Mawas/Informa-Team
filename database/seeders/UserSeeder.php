<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'د. محمد أحمد',
                'email' => 'mohammad.ahmad@example.com',
                'password' => Hash::make('password123'),
                'role_id' => 1, // مدير
                'training_id' => null, // سنقوم بتحديثه لاحقاً
                'phone' => '0912345678',
                'education' => 'دكتوراه في هندسة الحاسوب',
            ],
            [
                'name' => 'م. سارة خالد',
                'email' => 'sara.khalid@example.com',
                'password' => Hash::make('password123'),
                'role_id' => 5, // مدرس
                'training_id' => null, // سنقوم بتحديثه لاحقاً
                'phone' => '0923456789',
                'education' => 'ماجستير في هندسة البرمجيات',
            ],
            [
                'name' => 'د. عمر محمود',
                'email' => 'omar.mahmoud@example.com',
                'password' => Hash::make('password123'),
                'role_id' => 5, // مدرس
                'training_id' => null, // سنقوم بتحديثه لاحقاً
                'phone' => '0934567890',
                'education' => 'دكتوراه في أمن المعلومات',
            ],
            [
                'name' => 'م. ليلى حسن',
                'email' => 'layla.hassan@example.com',
                'password' => Hash::make('password123'),
                'role_id' => 4, // فني
                'training_id' => null, // سنقوم بتحديثه لاحقاً
                'phone' => '0945678901',
                'education' => 'بكالوريوس في هندسة المعلوماتية',
            ],
            [
                'name' => 'د. رنا علي',
                'email' => 'rana.ali@example.com',
                'password' => Hash::make('password123'),
                'role_id' => 5, // مدرس
                'training_id' => null, // سنقوم بتحديثه لاحقاً
                'phone' => '0956789012',
                'education' => 'دكتوراه في علوم الحاسوب',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}