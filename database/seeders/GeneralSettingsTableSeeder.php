<?php

namespace Database\Seeders;

use App\Models\Admin\GeneralSettings;
use Illuminate\Database\Seeder;

class GeneralSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GeneralSettings::create([
            'Title' => 'Elegent Pet Care - Ecommerce',
            'Logo' => 'Elegent Pet Care.png',
            'Favicon' =>'favicon.png',
            'MetaDescription' => 'Elegent Pet Care - Ecommerce',
            'MetaKeywords' => 'business,eCommerce, Ecommerce, ecommerce, shop, shopify, shopify ecommerce, creative, woocommerce, design, gallery, minimal, modern, html, html5, responsive',
            'MetaAuthor'=> 'Elegent Pet Care',
        ]);
    }
}
