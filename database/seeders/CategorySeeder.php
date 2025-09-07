<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'أجهزة الحاسوب',
                'path' => $this->createFakeImage('أجهزة الحاسوب'),
            ],
            [
                'name' => 'البرمجيات',
                'path' => $this->createFakeImage('البرمجيات'),
            ],
            [
                'name' => 'الشبكات',
                'path' => $this->createFakeImage('الشبكات'),
            ],
            [
                'name' => 'أمن المعلومات',
                'path' => $this->createFakeImage('أمن المعلومات'),
            ],
            [
                'name' => 'قواعد البيانات',
                'path' => $this->createFakeImage('قواعد البيانات'),
            ],
            [
                'name' => 'تطوير الويب',
                'path' => $this->createFakeImage('تطوير الويب'),
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}