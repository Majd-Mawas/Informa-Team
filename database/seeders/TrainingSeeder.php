<?php

namespace Database\Seeders;

use App\Models\Training;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrainingSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // نحتاج إلى إنشاء سجل تدريب واحد على الأقل للمستخدمين
        // ملاحظة: هذا يتطلب وجود مستخدم وورشة عمل مسبقاً
        // سنستخدم ID = 1 للمستخدم وورشة العمل
        // يمكن تعديل هذا لاحقاً بعد إنشاء ورش العمل
        
        $trainings = [
            [
                'Coach_id' => 1, // المستخدم الأول كمدرب
                'Workshop_id' => 1, // ورشة العمل الأولى
            ],
        ];

        foreach ($trainings as $training) {
            Training::create($training);
        }
    }
}