<?php

namespace Database\Seeders;

use App\Models\Workshop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkshopSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $workshops = [
            [
                'Date' => '2024-01-15',
                'title' => 'ورشة عمل صيانة الحاسوب',
                'description' => 'ورشة عمل تدريبية حول أساسيات صيانة أجهزة الحاسوب وإصلاح المشاكل الشائعة',
                'path' => $this->createFakeImage('ورشة عمل صيانة الحاسوب'),
                'ended_at' => '2024-01-30',
            ],
            [
                'Date' => '2024-06-20',
                'title' => 'ورشة عمل برمجة تطبيقات الويب',
                'description' => 'ورشة عمل متقدمة في تطوير تطبيقات الويب باستخدام إطار العمل Laravel',
                'path' => $this->createFakeImage('ورشة عمل برمجة تطبيقات الويب'),
                'ended_at' => '2024-07-05',
            ],
        ];

        foreach ($workshops as $workshop) {
            Workshop::create($workshop);
        }
    }
}