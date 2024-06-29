<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            [
                'name' => 'Trái cây & rau củ',
                'slug' => Str::slug('Trái cây & rau củ'),
                'thumb_image' => '/uploads/rau-cu.jpg',
                'show_at_home' => 1,
                'status' => 1
            ],
            [
                'name' => 'Trái cây',
                'slug' => Str::slug('Trái cây'),
                'show_at_home' => 1,
                'thumb_image' => '/uploads/hoa-qua.jpg',
                'status' => 1
            ],
            [
                'name' => 'Thực phẩm tiện lợi',
                'slug' => Str::slug('Thực phẩm tiện lợi'),
                'thumb_image' => '/uploads/tien-loi.jpg',
                'show_at_home' => 1,
                'status' => 1
            ],
            [
                'name' => 'Thịt tươi sống',
                'slug' => Str::slug('hịt tươi sống'),
                'show_at_home' => 1,
                'thumb_image' => '/uploads/thit.jpg',
                'status' => 1
            ]
        ]);
    }
}
