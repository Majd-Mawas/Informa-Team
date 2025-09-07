<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'title' => 'حاسوب مكتبي Dell OptiPlex',
                'description' => 'حاسوب مكتبي Dell OptiPlex مع معالج Intel Core i7، وذاكرة 16GB، وقرص صلب SSD سعة 512GB. مثالي للاستخدام في مختبرات الكلية ومكاتب أعضاء هيئة التدريس.',
                'price' => 1200.00,
                'category_id' => 1,
                'path' => $this->createFakeImage('حاسوب مكتبي Dell OptiPlex'),
            ],
            [
                'title' => 'حاسوب محمول HP ProBook',
                'description' => 'حاسوب محمول HP ProBook مع معالج Intel Core i5، وذاكرة 8GB، وقرص صلب SSD سعة 256GB. خفيف الوزن ومناسب للطلاب وأعضاء هيئة التدريس.',
                'price' => 900.00,
                'category_id' => 2,
                'path' => $this->createFakeImage('حاسوب محمول HP ProBook'),
            ],
            [
                'title' => 'جهاز توجيه Cisco',
                'description' => 'جهاز توجيه Cisco للشبكات المتوسطة والكبيرة. يدعم تقنيات الشبكات المتقدمة ويوفر أداءً عالياً وأماناً متميزاً.',
                'price' => 350.00,
                'category_id' => 3,
                'path' => $this->createFakeImage('جهاز توجيه Cisco'),
            ],
            [
                'title' => 'جهاز تبديل TP-Link',
                'description' => 'جهاز تبديل TP-Link بسرعة 1Gbps و24 منفذاً. مناسب للاستخدام في مختبرات الكلية وقاعات المحاضرات.',
                'price' => 120.00,
                'category_id' => 3,
                'path' => $this->createFakeImage('جهاز تبديل TP-Link'),
            ],
            [
                'title' => 'طابعة HP LaserJet Pro',
                'description' => 'طابعة HP LaserJet Pro أحادية اللون بسرعة 30 صفحة في الدقيقة. مناسبة للاستخدام في مكاتب أعضاء هيئة التدريس والإدارة.',
                'price' => 250.00,
                'category_id' => 4,
                'path' => $this->createFakeImage('طابعة HP LaserJet Pro'),
            ],
            [
                'title' => 'ماسح ضوئي Epson',
                'description' => 'ماسح ضوئي Epson بدقة 4800×9600 نقطة في البوصة. مناسب لمسح المستندات والصور بجودة عالية.',
                'price' => 180.00,
                'category_id' => 4,
                'path' => $this->createFakeImage('ماسح ضوئي Epson'),
            ],
            [
                'title' => 'برنامج MATLAB',
                'description' => 'برنامج MATLAB للحوسبة العددية والتحليل الرياضي. يتضمن رخصة استخدام لمدة سنة واحدة.',
                'price' => 500.00,
                'category_id' => 5,
                'path' => $this->createFakeImage('برنامج MATLAB'),
            ],
            [
                'title' => 'برنامج Visual Studio',
                'description' => 'برنامج Visual Studio لتطوير البرمجيات. يدعم العديد من لغات البرمجة ويتضمن أدوات متقدمة للتطوير والتصحيح.',
                'price' => 300.00,
                'category_id' => 5,
                'path' => $this->createFakeImage('برنامج Visual Studio'),
            ],
            [
                'title' => 'ذاكرة RAM DDR4',
                'description' => 'ذاكرة RAM DDR4 بسعة 8GB وتردد 3200MHz. متوافقة مع معظم أجهزة الحاسوب الحديثة.',
                'price' => 60.00,
                'category_id' => 6,
                'path' => $this->createFakeImage('ذاكرة RAM DDR4'),
            ],
            [
                'title' => 'قرص صلب SSD',
                'description' => 'قرص صلب SSD بسعة 1TB وسرعة قراءة تصل إلى 550MB/s. يوفر أداءً سريعاً ويحسن استجابة النظام.',
                'price' => 120.00,
                'category_id' => 6,
                'path' => $this->createFakeImage('قرص صلب SSD'),
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
