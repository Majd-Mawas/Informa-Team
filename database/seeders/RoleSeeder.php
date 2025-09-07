<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'مدير',
                'description' => 'مدير النظام مع صلاحيات كاملة',
            ],
            [
                'name' => 'مشرف',
                'description' => 'مشرف مع صلاحيات إدارية محدودة',
            ],
            [
                'name' => 'مستخدم',
                'description' => 'مستخدم عادي مع صلاحيات محدودة',
            ],
            [
                'name' => 'فني',
                'description' => 'فني دعم تقني مع صلاحيات خاصة بالصيانة',
            ],
            [
                'name' => 'مدرس',
                'description' => 'مدرس مع صلاحيات خاصة بالمواد التعليمية',
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}