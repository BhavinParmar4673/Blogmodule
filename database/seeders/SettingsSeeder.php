<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Setting;

use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            [
                'name' => 'general_settings',
                'response' => '{
                    "city": "Rajkot",
                    "drift": null,
                    "email": "admin@admin.com",
                    "state": "Gujrat",
                    "title": "test-title",
                    "address": "Santkabir Road Rajkot ,\r\nRajaram Socity Street No.4\r\nRajkot 360003\r\nGujrat - India",
                    "contact": "9099102911",
                    "content": "Our company mission is to lead the",
                    "country": "India",
                    "keyword": "test-keyword",
                    "facebook": "https://eshop.test/admin/settings",
                    "linkedin": "https://eshop.test/admin/settings",
                    "whatsapp": "https://eshop.test/admin/settings",
                    "instagram": "https://eshop.test/admin/settings",
                    "offertext": "https://eshop.test/admin/settings ## https://eshop.test/admin/settings",
                    "copyrights": "Copyright © 2020 Gift Master. All rights reserved.",
                    "logo_title": "Our products are built on top",
                    "plan_title": "Pick the best plan for you",
                    "store_name": "Lara Fresh",
                    "stripe_key": "pk_test_51KPhqEFoLiiKeI5bohF2k1AMhNDUtG2eazUUwyWezIwczzISGKO94lXPQwPgnVKLPyGzwjWxgkbGiR2L3rWDLoAF00AG9wRDRT",
                    "description": "test-description",
                    "postal_code": "360003",
                    "logo_tagline": "Very nice logos here on this page, you can check more on our social profiles.",
                    "plan_tagline": "You have Free Unlimited Updates and Premium Support on each package.",
                    "about_title_first" :"Your Work With",
                    "about_title_second" :"Soft Design System",
                    "about_description" :"The time is now for it be okay to be great. People in this world shun people for being nice.",
                    "blog_heading":"Pricing Plans",
                    "blog_sub_heading":"Work with the rockets",
                    "blog_description":"Wealth creation is an evolutionarily recent positive-sum game. Status is an old zero-sum game. Those attacking wealth creation are often just seeking status." ,
                    "typed_string": [
                        "web development",
                        "mobile development",
                        "web design"
                    ],
                    "user_key":"100",
                    "partner_key":"100",
                    "direct_key":"100",
                    "client_id" :"222793597538-e5pvi0knhet2eb91dll1fuj36i45vffl.apps.googleusercontent.com",
                    "client_secret":"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",
                    "refresh_token":"1//04RlhA5SxSj6ZCgYIARAAGAQSNwF-L9IrMgat0tz_vrpmPUH57Eupnwn2WSSj1Vw2x3V0xsgZJVHkof0IkwBypSTFQs9AfrAXdqY",
                    "folder_id":"1pBdJbirjR6PpYx2MGRXRQ8VE_o0e4l4t",
                    "stripe_secret": "sk_test_51KPhqEFoLiiKeI5bqhnX9NSGrudGGGzoKT1Eh6AImiDWzOLkaaEL3BFbaTzuN5eXLCEwJJwOO0eV3DBm65arOTAN00vl7ez1I1",
                    "stripe_webhook_secret": "whsec_jIppOcXDqhMi8mlGxnRDe4EKX8ZdbFFO",
                    "captcha_secret": "6LfnGZkeAAAAAJJdhnYuSvaqL6aXzoaX9q_HH9eq",
                    "captcha_sitekey": "6LfnGZkeAAAAAPsZ376AeIX9Y6MmAC6tinrI9AOO",
                    "service_tagline": "Intuitive drag and drop Page Builder. Stunning themes. Over 100 Elements. Creating your beautiful website has never been easier.",
                    "lead_description": "The time is now for it to be okay to be great. People in this world shun people for being great. For being a bright color.",
                    "testimonial_title": "What random people <br/> Think about us",
                    "testimonial_tagline": "That is the main thing people are controlled by! Thoughts- their perception of themselves!",
                    "service_title": "We have got you covered."
                }'
            ],
            [
                'name' => 'mail',
                'response' => '{"mail_bcc": "mohit_7007@rediffmail.com", "mail_host": "smtp.hostinger.in", "mail_port": "587", "mail_password": "Admin@123", "mail_username": "support@giftmaster.in", "mail_from_name": "GiftMaster", "mail_encryption": "tls", "mail_from_email": "support@giftmaster.in"}'
            ]
        ];
        foreach ($settings as $key => $row) {
            Setting::create($row);
        }
    }
}