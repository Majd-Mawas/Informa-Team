<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productCategories = [
            [
                'name' => 'أجهزة الحاسوب المكتبية',
                'description' => 'أجهزة الحاسوب المكتبية المناسبة للاستخدام في مختبرات الكلية والمكاتب الإدارية',
                'path' => $this->createFakeImage('أجهزة الحاسوب المكتبية'),
            ],
            [
                'name' => 'أجهزة الحاسوب المحمولة',
                'description' => 'أجهزة الحاسوب المحمولة للطلاب وأعضاء هيئة التدريس',
                'path' => $this->createFakeImage('أجهزة الحاسوب المحمولة'),
            ],
            [
                'name' => 'أجهزة الشبكات',
                'description' => 'أجهزة الشبكات مثل أجهزة التوجيه والتبديل ونقاط الوصول اللاسلكية',
                'path' => $this->createFakeImage('أجهزة الشبكات'),
            ],
            [
                'name' => 'طابعات وماسحات ضوئية',
                'description' => 'طابعات وماسحات ضوئية للاستخدام في مختبرات الكلية والمكاتب الإدارية',
                'path' => $this->createFakeImage('طابعات وماسحات ضوئية'),
            ],
            [
                'name' => 'برمجيات تعليمية',
                'description' => 'برمجيات تعليمية متخصصة لطلاب هندسة المعلوماتية',
                'path' => $this->createFakeImage('برمجيات تعليمية'),
            ],
            [
                'name' => 'قطع غيار وملحقات',
                'description' => 'قطع غيار وملحقات لأجهزة الحاسوب والشبكات',
                'path' => $this->createFakeImage('قطع غيار وملحقات'),
            ],
        ];

        foreach ($productCategories as $category) {
            ProductCategory::create($category);
        }
    }
}
