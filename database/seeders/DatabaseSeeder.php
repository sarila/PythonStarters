<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\NewsType;
use App\Models\Social;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Admin::insert([
            'name' => "Sushan Paudyal",
            'email' => "sushan.paudyal@gmail.com",
            'address' => "Shantinagar Gate",
            'password' => bcrypt("password"),
            'phone' => "9843276470",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Theme::insert([
            'site_title' => "Janata Ko Online",
            'site_subtitle' => "Best Online Newsportal in Town",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Social::insert([
            'facebook' => "https://www.facebook.com/JanatakoOnlinecom-103862514732250/",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        NewsType::insert([
            'title' => "प्रदेश १",
            'slug' => "pradesh-1",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        NewsType::insert([
            'title' => "प्रदेश २",
            'slug' => "pradesh-2",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        NewsType::insert([
            'title' => "प्रदेश ३",
            'slug' => "pradesh-3",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        NewsType::insert([
            'title' => "गण्डकी प्रदेश",
            'slug' => "pradesh-4",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        NewsType::insert([
            'title' => "प्रदेश ५",
            'slug' => "pradesh-5",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        NewsType::insert([
            'title' => "कर्णाली प्रदेश",
            'slug' => "karnali-pradesh",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        NewsType::insert([
            'title' => "सुदुरपश्चिम प्रदेश",
            'slug' => "sudurupaschhim-pradesh",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::insert([
            'name' => "Sushan Paudyal",
            'email' => "sushan.paudyal@gmail.com",
            'address' => "Shantinagar Gate",
            'password' => bcrypt("password"),
            'phone' => "9843276470",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
