<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Feature;
use App\Models\Testimonial;
use App\Models\Statistic;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Features - faqat bo'sh bo'lsa
        if (Feature::count() == 0) {
            Feature::create([
                'icon' => 'fas fa-brain',
                'title_uz' => 'НейроТрансформация',
                'description_uz' => 'Миянинг пластик хусусиятидан фойдаланиб, янги ижобий хатти-ҳаракат шаблонларини шакллантириш.',
                'order' => 1,
                'is_active' => true
            ]);
            
            Feature::create([
                'icon' => 'fas fa-bullseye',
                'title_uz' => 'Мақсадга Йўналтирилганлик',
                'description_uz' => 'SMART методологияси асосида аник мақсадлар белгилаш ва уларга эришиш стратегиялари.',
                'order' => 2,
                'is_active' => true
            ]);
            
            echo "✅ Features yaratildi\n";
        } else {
            echo "⚠️ Features allaqachon mavjud\n";
        }
        
        // 2. Testimonials
        if (Testimonial::count() == 0) {
            Testimonial::create([
                'author_name' => 'Сарвар Н.',
                'author_position' => 'IT Компания Раҳбари',
                'content_uz' => 'НЛП MindMaster дастури менинг ҳаётимни тубдан ўзгартирди. 20 йил давомидаги ишончсизлигим 3 ой ичида енгди.',
                'rating' => 5,
                'order' => 1,
                'is_active' => true
            ]);
            
            echo "✅ Testimonials yaratildi\n";
        }
        
        // 3. Statistics
        if (Statistic::count() == 0) {
            Statistic::create([
                'number' => '95%',
                'title_uz' => 'Кафолатланган Натижа',
                'icon' => 'fas fa-check-circle',
                'color' => '#10b981',
                'order' => 1,
                'is_active' => true
            ]);
            
            echo "✅ Statistics yaratildi\n";
        }
        
        // 4. Settings - update or create
        $settings = [
            ['key' => 'site_name', 'value' => 'NLP MindMaster', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_email', 'value' => 'info@nlpmindmaster.uz', 'type' => 'email', 'group' => 'general'],
            ['key' => 'site_phone', 'value' => '+998 90 123 45 67', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_address', 'value' => 'Тошкент, Ўзбекистон', 'type' => 'text', 'group' => 'general'],
            ['key' => 'hero_title', 'value' => 'Онг Ости Дастурларингизни Янгидан Яратинг', 'type' => 'text', 'group' => 'content'],
            ['key' => 'hero_description', 'value' => 'НЛП ва коучинг технологиялари орқали ҳаётингизни рақамли трансформацияга олиб келинг.', 'type' => 'textarea', 'group' => 'content'],
        ];
        
        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
        echo "✅ Settings yangilandi\n";
        
        // 5. Admin User - update or create
        $admin = User::updateOrCreate(
            ['email' => 'admin@nlpmindmaster.uz'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        
        echo "✅ Admin foydalanuvchi: admin@nlpmindmaster.uz / admin123\n";
        echo "🆔 Admin ID: " . $admin->id . "\n";
    }
}