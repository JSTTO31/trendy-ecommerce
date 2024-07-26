<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Product extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            0 => ["name" => "beauty", "color" => "#FFB6C1"],            // Light Pink
            1 => ["name" => "fragrances", "color" => "#FFF0F5"],        // Lavender Blush
            2 => ["name" => "furniture", "color" => "#F5F5DC"],         // Beige
            3 => ["name" => "groceries", "color" => "#F0FFF0"],         // Honeydew
            4 => ["name" => "home-decoration", "color" => "#FFFACD"],   // Lemon Chiffon
            5 => ["name" => "kitchen-accessories", "color" => "#E0FFFF"], // Light Cyan
            6 => ["name" => "laptops", "color" => "#E6E6FA"],           // Lavender
            7 => ["name" => "mens-shirts", "color" => "#F0E68C"],       // Khaki
            8 => ["name" => "mens-shoes", "color" => "#F5F5F5"],        // White Smoke
            9 => ["name" => "mens-watches", "color" => "#D3D3D3"],      // Light Grey
            10 => ["name" => "mobile-accessories", "color" => "#ADD8E6"], // Light Blue
            11 => ["name" => "motorcycle", "color" => "#D8BFD8"],       // Thistle
            12 => ["name" => "skin-care", "color" => "#FAFAD2"],        // Light Goldenrod Yellow
            13 => ["name" => "smartphones", "color" => "#E0FFFF"],      // Light Cyan
            14 => ["name" => "sports-accessories", "color" => "#FFB6C1"], // Light Pink
            15 => ["name" => "sunglasses", "color" => "#FFE4E1"],       // Misty Rose
            16 => ["name" => "tablets", "color" => "#AFEEEE"],          // Pale Turquoise
            17 => ["name" => "tops", "color" => "#F5F5DC"],             // Beige
            18 => ["name" => "vehicle", "color" => "#F0F8FF"],          // Alice Blue
            19 => ["name" => "womens-bags", "color" => "#FFDEAD"],      // Navajo White
            20 => ["name" => "womens-dresses", "color" => "#FFEBCD"],   // Blanched Almond
            21 => ["name" => "womens-jewellery", "color" => "#FFE4C4"], // Bisque
            22 => ["name" => "womens-shoes", "color" => "#FAF0E6"],     // Linen
            23 => ["name" => "womens-watches", "color" => "#FDF5E6"]    // Old Lace
          ];

        $categories = collect($categories)->map(fn($item) => [
            'name' => $item['name'],
            'color' => $item['color'],
            'image' => 'categories/'.$item['name'].'.png',
        ]);


        foreach ($categories as $category) {
            Category::create($category);
        }


    }
}
