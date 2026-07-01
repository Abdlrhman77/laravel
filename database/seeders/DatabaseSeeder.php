<?php

namespace Database\Seeders;

use App\Models\Vendor;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $superAdmin = \App\Models\User::create([
            'name' => 'مدير النظام',
            'phone' => '777000000',
            'password' => bcrypt('password'),
            'role' => 'super_admin'
        ]);

        $user1 = \App\Models\User::create([
            'name' => 'شركة النور للتجارة والتوريد',
            'phone' => '777111111',
            'password' => bcrypt('password'),
            'role' => 'vendor'
        ]);

        $vendor1 = Vendor::create([
            'user_id' => $user1->id,
            'name' => 'شركة النور للتجارة والتوريد',
            'phone' => '777111111',
            'category' => 'مواد بناء',
            'location' => 'صنعاء',
            'status' => 'active',
        ]);

        Product::create([
            'vendor_id' => $vendor1->id,
            'name' => 'أسمنت عمران',
            'description' => 'أفضل جودة أسمنت في اليمن',
            'price_sar' => 15.00,
            'currency' => 'SAR',
        ]);
        
        $user2 = \App\Models\User::create([
            'name' => 'معرض السيارات الحديثة',
            'phone' => '777222222',
            'password' => bcrypt('password'),
            'role' => 'vendor'
        ]);

        $vendor2 = Vendor::create([
            'user_id' => $user2->id,
            'name' => 'معرض السيارات الحديثة',
            'phone' => '777222222',
            'category' => 'سيارات',
            'location' => 'عدن',
            'status' => 'active',
        ]);

        Product::create([
            'vendor_id' => $vendor2->id,
            'name' => 'تويوتا هيلوكس 2024',
            'description' => 'سيارة بيك أب قوية وعملية',
            'price_usd' => 35000.00,
            'currency' => 'USD',
        ]);
    }
}
