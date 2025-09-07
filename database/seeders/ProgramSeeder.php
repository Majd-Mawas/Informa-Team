<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programs = [
            [
                'Name' => 'برنامج الدعم الفني لأجهزة الحاسوب',
                'Released_at' => '2024-01-01',
                'categories_id' => 1,
                'description' => 'برنامج متخصص لتقديم الدعم الفني لأجهزة الحاسوب في كلية هندسة المعلوماتية بجامعة حلب. يشمل البرنامج تشخيص وإصلاح مشاكل الأجهزة والبرمجيات، وتحديث النظام، وتركيب البرامج الضرورية للطلاب.',
                'path' => $this->createFakeImage('برنامج الدعم الفني لأجهزة الحاسوب'),
            ],
            [
                'Name' => 'برنامج تدريب مهارات البرمجة',
                'Released_at' => '2024-02-15',
                'categories_id' => 2,
                'description' => 'برنامج تدريبي لتطوير مهارات البرمجة لدى طلاب هندسة المعلوماتية. يغطي البرنامج لغات البرمجة الأساسية مثل Java وPython وC++، ويتضمن مشاريع عملية لتعزيز المهارات المكتسبة.',
                'path' => $this->createFakeImage('برنامج تدريب مهارات البرمجة'),
            ],
            [
                'Name' => 'برنامج إدارة شبكات الجامعة',
                'Released_at' => '2024-03-10',
                'categories_id' => 3,
                'description' => 'برنامج متخصص في إدارة وصيانة شبكات الحاسوب في جامعة حلب. يشمل البرنامج تكوين أجهزة الشبكة، وحل مشاكل الاتصال، وتأمين الشبكة ضد الهجمات الإلكترونية.',
                'path' => $this->createFakeImage('برنامج إدارة شبكات الجامعة'),
            ],
            [
                'Name' => 'برنامج أمن المعلومات والحماية الإلكترونية',
                'Released_at' => '2024-04-20',
                'categories_id' => 4,
                'description' => 'برنامج متخصص في أمن المعلومات وحماية البيانات الإلكترونية. يتضمن البرنامج تدريباً على تقنيات التشفير، وكشف الثغرات الأمنية، والاستجابة للحوادث الأمنية، وحماية الخصوصية الرقمية.',
                'path' => $this->createFakeImage('برنامج أمن المعلومات والحماية الإلكترونية'),
            ],
            [
                'Name' => 'برنامج إدارة قواعد البيانات',
                'Released_at' => '2024-05-05',
                'categories_id' => 5,
                'description' => 'برنامج متخصص في إدارة وتصميم قواعد البيانات. يشمل البرنامج تدريباً على نظم إدارة قواعد البيانات مثل MySQL وSQL Server وOracle، وتصميم قواعد البيانات، وتحسين أداء الاستعلامات.',
                'path' => $this->createFakeImage('برنامج إدارة قواعد البيانات'),
            ],
            [
                'Name' => 'برنامج تطوير تطبيقات الويب',
                'Released_at' => '2024-06-15',
                'categories_id' => 6,
                'description' => 'برنامج متخصص في تطوير تطبيقات الويب. يتضمن البرنامج تدريباً على تقنيات الواجهة الأمامية مثل HTML وCSS وJavaScript، وتقنيات الخادم مثل PHP وNode.js، وأطر العمل مثل Laravel وReact.',
                'path' => $this->createFakeImage('برنامج تطوير تطبيقات الويب'),
            ],
        ];

        foreach ($programs as $program) {
            Program::create($program);
        }
    }
}