<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting =

            [
                'site_title_ar' => 'ديرانونو ستور',
                'site_title_en' => 'Deeranono Store',
                'logo' => 'logo.png',
                'favicon' => 'favicon.png',
                'phone' => '01010034560',
                'email' => 'info@deeranono.com',
                'welcome_message_ar' => 'مرحباً بكم في ديرانونو ستور',
                'welcome_message_en' => 'Welcome to Deeranono store',
                'whatsapp' => '01010034560',
                'facebook' => 'https://www.facebook.com/Deeranono-DF-101574608933051',
                'instagram' => 'https://www.instagram.com/deeranono/',
                'pinterest' => 'www.pinterest.com/deeranono',
                'youtube' => 'https://www.youtube.com/channel/UC-5l5WbqFaZIIfrtvUcS_jA',
                'address_ar' => 'القاهرة - مصر',
                'address_en' => 'Cairo - Egypt',
                'about_ar' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.',
                'about_en' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,',
            ];

        Setting::create($setting);
    }
}
