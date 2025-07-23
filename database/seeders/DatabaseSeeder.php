<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
        ]);

        // Create categories with specific data
        $categories = [
            [
                'name' => 'Electronics',
                'products' => [
                    [
                        'name' => 'Smartphone X',
                        'description' => 'Latest smartphone with advanced features',
                        'price' => 5000000,
                        'image' => 'products/smartphone.jpg'
                    ],
                    [
                        'name' => 'Laptop Pro',
                        'description' => 'Professional laptop for work and gaming',
                        'price' => 15000000,
                        'image' => 'products/laptop.jpg'
                    ],
                ]
            ],
            [
                'name' => 'Fashion',
                'products' => [
                    [
                        'name' => 'Casual T-Shirt',
                        'description' => 'Comfortable cotton t-shirt',
                        'price' => 150000,
                        'image' => 'products/tshirt.jpg'
                    ],
                    [
                        'name' => 'Denim Jeans',
                        'description' => 'Classic denim jeans',
                        'price' => 450000,
                        'image' => 'products/jeans.jpg'
                    ],
                ]
            ],
            [
                'name' => 'Home & Living',
                'products' => [
                    [
                        'name' => 'Coffee Maker',
                        'description' => 'Automatic coffee maker for your home',
                        'price' => 899000,
                        'image' => 'products/coffee-maker.jpg'
                    ],
                    [
                        'name' => 'Bed Sheet Set',
                        'description' => 'Luxury cotton bed sheet set',
                        'price' => 750000,
                        'image' => 'products/bedsheet.jpg'
                    ],
                ]
            ],
            [
                'name' => 'Books',
                'products' => [
                    [
                        'name' => 'Programming Guide',
                        'description' => 'Complete guide to modern programming',
                        'price' => 250000,
                        'image' => 'products/book.jpg'
                    ],
                    [
                        'name' => 'Novel Collection',
                        'description' => 'Best-selling novel collection',
                        'price' => 180000,
                        'image' => 'products/novel.jpg'
                    ],
                ]
            ],
            [
                'name' => 'Sports',
                'products' => [
                    [
                        'name' => 'Running Shoes',
                        'description' => 'Professional running shoes',
                        'price' => 1200000,
                        'image' => 'products/shoes.jpg'
                    ],
                    [
                        'name' => 'Yoga Mat',
                        'description' => 'Premium quality yoga mat',
                        'price' => 300000,
                        'image' => 'products/yoga-mat.jpg'
                    ],
                ]
            ],
            [
                'name' => 'Health & Beauty',
                'products' => [
                    [
                        'name' => 'Face Cream',
                        'description' => 'Moisturizing face cream',
                        'price' => 150000,
                        'image' => 'products/face-cream.jpg'
                    ],
                    [
                        'name' => 'Vitamin C Serum',
                        'description' => 'Anti-aging vitamin C serum',
                        'price' => 280000,
                        'image' => 'products/serum.jpg'
                    ],
                ]
            ],
        ];

        // Generate sample product images
        $this->generateSampleImages();

        // Create categories and products
        foreach ($categories as $categoryData) {
            $category = Category::create([
                'name' => $categoryData['name'],
                'slug' => Str::slug($categoryData['name']),
                'description' => 'Collection of ' . $categoryData['name'],
                'is_active' => true,
            ]);

            foreach ($categoryData['products'] as $productData) {
                Product::create([
                    'category_id' => $category->id,
                    'name' => $productData['name'],
                    'slug' => Str::slug($productData['name']),
                    'description' => $productData['description'],
                    'price' => $productData['price'],
                    'stock' => rand(5, 100),
                    'sku' => strtoupper(Str::random(8)),
                    'is_active' => true,
                    'image' => $productData['image'],
                ]);
            }
        }
    }

    private function generateSampleImages(): void
    {
        $images = [
            'smartphone.jpg' => 'https://via.placeholder.com/800x600.jpg/2563eb/ffffff?text=Smartphone+X',
            'laptop.jpg' => 'https://via.placeholder.com/800x600.jpg/2563eb/ffffff?text=Laptop+Pro',
            'tshirt.jpg' => 'https://via.placeholder.com/800x600.jpg/dc2626/ffffff?text=Casual+T-Shirt',
            'jeans.jpg' => 'https://via.placeholder.com/800x600.jpg/dc2626/ffffff?text=Denim+Jeans',
            'coffee-maker.jpg' => 'https://via.placeholder.com/800x600.jpg/059669/ffffff?text=Coffee+Maker',
            'bedsheet.jpg' => 'https://via.placeholder.com/800x600.jpg/059669/ffffff?text=Bed+Sheet+Set',
            'book.jpg' => 'https://via.placeholder.com/800x600.jpg/7c3aed/ffffff?text=Programming+Guide',
            'novel.jpg' => 'https://via.placeholder.com/800x600.jpg/7c3aed/ffffff?text=Novel+Collection',
            'shoes.jpg' => 'https://via.placeholder.com/800x600.jpg/ea580c/ffffff?text=Running+Shoes',
            'yoga-mat.jpg' => 'https://via.placeholder.com/800x600.jpg/ea580c/ffffff?text=Yoga+Mat',
            'face-cream.jpg' => 'https://via.placeholder.com/800x600.jpg/db2777/ffffff?text=Face+Cream',
            'serum.jpg' => 'https://via.placeholder.com/800x600.jpg/db2777/ffffff?text=Vitamin+C+Serum',
        ];

        foreach ($images as $filename => $url) {
            $path = storage_path('app/public/products/' . $filename);
            
            // Create directory if it doesn't exist
            if (!File::exists(dirname($path))) {
                File::makeDirectory(dirname($path), 0755, true);
            }

            // Download and save image
            $imageContent = file_get_contents($url);
            File::put($path, $imageContent);
        }
    }
}
