<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\WishlistItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::updateOrCreate([
            'email' => 'admin@rural.com',
        ], [
            'name' => 'Rural Admin',
            'password' => 'Admin@12345',
            'role' => 'admin',
        ]);

        $user = User::updateOrCreate([
            'email' => 'user@rural.com',
        ], [
            'name' => 'Rural User',
            'password' => 'User@12345',
            'role' => 'user',
        ]);

        $streetwear = Category::updateOrCreate([
            'slug' => 'streetwear',
        ], [
            'name' => 'Streetwear',
        ]);

        $hoodies = Category::updateOrCreate([
            'slug' => 'hoodies',
        ], [
            'name' => 'Hoodies',
        ]);

        $products = [
            [
                'slug' => 'classic-cotton-t-shirt',
                'name' => 'Classic Cotton T-Shirt',
                'price' => 25,
                'stock' => 120,
                'category_id' => $streetwear->id,
                'image_path' => 'assets/images/product-item4.jpg',
                'is_featured' => true,
                'description' => 'Soft everyday cotton tee with a clean classic cut and durable stitching.',
            ],
            [
                'slug' => 'oversized-hoodie',
                'name' => 'Oversized Hoodie',
                'price' => 40,
                'stock' => 90,
                'category_id' => $hoodies->id,
                'image_path' => 'assets/images/product-item5.jpg',
                'is_featured' => true,
                'description' => 'Relaxed oversized hoodie built for comfort, layering, and daily wear.',
            ],
            [
                'slug' => 'vintage-graphic-tee',
                'name' => 'Vintage Graphic Tee',
                'price' => 30,
                'stock' => 70,
                'category_id' => $streetwear->id,
                'image_path' => 'assets/images/product-item3.jpg',
                'is_featured' => true,
                'description' => 'Vintage-inspired graphic tee with a soft hand feel and standout print.',
            ],
            [
                'slug' => 'minimalist-hoodie',
                'name' => 'Minimalist Hoodie',
                'price' => 45,
                'stock' => 85,
                'category_id' => $hoodies->id,
                'image_path' => 'assets/images/product-item9.jpg',
                'is_featured' => true,
                'description' => 'A clean minimal hoodie with premium fleece and a modern silhouette.',
            ],
            [
                'slug' => 'striped-long-sleeve-tee',
                'name' => 'Striped Long Sleeve Tee',
                'price' => 35,
                'stock' => 60,
                'category_id' => $streetwear->id,
                'image_path' => 'assets/images/product-item7.jpg',
                'is_featured' => true,
                'description' => 'Long sleeve striped tee designed for casual layering and all-season styling.',
            ],
            [
                'slug' => 'relaxed-fit-hoodie',
                'name' => 'Relaxed Fit Hoodie',
                'price' => 50,
                'stock' => 75,
                'category_id' => $hoodies->id,
                'image_path' => 'assets/images/product-item12.jpg',
                'is_featured' => true,
                'description' => 'Relaxed fit hoodie with roomy comfort and a substantial premium fabric weight.',
            ],
            [
                'slug' => 'classic-black-hoodie',
                'name' => 'Classic Black Hoodie',
                'price' => 40,
                'stock' => 100,
                'category_id' => $hoodies->id,
                'image_path' => 'assets/images/product-item2.jpg',
                'is_featured' => false,
                'description' => 'Classic black hoodie that pairs easily with any casual wardrobe.',
            ],
            [
                'slug' => 'graphic-print-t-shirt',
                'name' => 'Graphic Print T-shirt',
                'price' => 25,
                'stock' => 110,
                'category_id' => $streetwear->id,
                'image_path' => 'assets/images/product-item11.jpg',
                'is_featured' => false,
                'description' => 'Comfortable graphic tee with sharp print detail and breathable fabric.',
            ],
            [
                'slug' => 'oversized-hoodie-2',
                'name' => 'Oversized Hoodie',
                'price' => 50,
                'stock' => 65,
                'category_id' => $hoodies->id,
                'image_path' => 'assets/images/product-item6.jpg',
                'is_featured' => false,
                'description' => 'Alternate oversized hoodie colorway with the same loose premium fit.',
            ],
            [
                'slug' => 'minimalist-cotton-t-shirt',
                'name' => 'Minimalist Cotton T-shirt',
                'price' => 20,
                'stock' => 140,
                'category_id' => $streetwear->id,
                'image_path' => 'assets/images/product-item10.jpg',
                'is_featured' => false,
                'description' => 'Minimal cotton tee focused on clean lines, softness, and easy styling.',
            ],
            [
                'slug' => 'vintage-washed-hoodie',
                'name' => 'Vintage Washed Hoodie',
                'price' => 45,
                'stock' => 80,
                'category_id' => $hoodies->id,
                'image_path' => 'assets/images/product-item1.jpg',
                'is_featured' => false,
                'description' => 'Washed finish hoodie with a broken-in look and a soft brushed interior.',
            ],
            [
                'slug' => 'striped-casual-t-shirt',
                'name' => 'Striped Casual T-shirt',
                'price' => 22,
                'stock' => 95,
                'category_id' => $streetwear->id,
                'image_path' => 'assets/images/product-item8.jpg',
                'is_featured' => false,
                'description' => 'Lightweight striped tee for casual daily use with a relaxed finish.',
            ],
        ];

        $createdProducts = [];
        foreach ($products as $row) {
            $product = Product::updateOrCreate(
                ['slug' => $row['slug']],
                array_merge($row, ['is_active' => true]),
            );
            $createdProducts[] = $product;
        }

        $order = Order::updateOrCreate([
            'order_number' => 'ORD-DEMO-1001',
        ], [
            'user_id' => $user->id,
            'status' => 'pending',
            'payment_status' => 'pending',
            'subtotal' => 65,
            'tax' => 0,
            'shipping' => 0,
            'total' => 65,
            'customer_name' => $user->name,
            'customer_email' => $user->email,
            'customer_phone' => '9999999999',
            'shipping_address' => 'Demo street, USA',
            'notes' => 'Seed order',
        ]);

        if (count($createdProducts) >= 2) {
            $item1 = $createdProducts[0];
            $item2 = $createdProducts[1];

            OrderItem::updateOrCreate([
                'order_id' => $order->id,
                'product_name' => $item1->name,
            ], [
                'product_id' => $item1->id,
                'unit_price' => $item1->price,
                'quantity' => 1,
                'line_total' => $item1->price,
            ]);

            OrderItem::updateOrCreate([
                'order_id' => $order->id,
                'product_name' => $item2->name,
            ], [
                'product_id' => $item2->id,
                'unit_price' => $item2->price,
                'quantity' => 1,
                'line_total' => $item2->price,
            ]);

            WishlistItem::updateOrCreate([
                'user_id' => $user->id,
                'product_id' => $item1->id,
            ]);

            WishlistItem::updateOrCreate([
                'user_id' => $user->id,
                'product_id' => $item2->id,
            ]);
        }

        UserAddress::updateOrCreate([
            'user_id' => $user->id,
            'label' => 'Home',
        ], [
            'recipient_name' => $user->name,
            'phone' => '9999999999',
            'line_1' => 'Demo street 42',
            'line_2' => 'Near town square',
            'city' => 'Marinette',
            'state' => 'Wisconsin',
            'postal_code' => '54143',
            'country' => 'USA',
            'is_default' => true,
        ]);

        $blogPosts = [
            [
                'title' => 'Best T-shirts and Hoodies for Every Season',
                'slug' => 'best-t-shirts-and-hoodies-for-every-season',
                'excerpt' => 'Discover the perfect t-shirts and hoodies that combine comfort and style for every occasion.',
                'content' => "Discover the perfect t-shirts and hoodies that combine comfort and style for every occasion.\n\nFrom breathable cotton tees for warm days to heavyweight hoodies for cooler evenings, building a dependable wardrobe starts with versatile staples. Focus on fit, fabric quality, and color palettes that work across multiple outfits.\n\nA strong collection should balance comfort with durability. Neutral hoodies, statement prints, and clean minimalist tees all have a place when they are selected with everyday wear in mind.",
                'featured_image' => 'assets/images/post-item8.jpg',
            ],
            [
                'title' => 'Top T-shirt and Hoodie Trends for 2024',
                'slug' => 'top-t-shirt-and-hoodie-trends-for-2024',
                'excerpt' => 'Stay ahead in fashion with the latest t-shirt and hoodie trends, from minimal designs to bold graphics.',
                'content' => "Stay ahead in fashion with the latest t-shirt and hoodie trends, from minimal designs to bold graphics.\n\nOversized fits, faded washes, clean logo placements, and typography-led prints continue to dominate. Customers are looking for pieces that feel current without being difficult to style.\n\nThe strongest trend is versatility. Items that move easily from casual streetwear to everyday basics are performing best because they offer more value in a single purchase.",
                'featured_image' => 'assets/images/post-item2.jpg',
            ],
            [
                'title' => 'Why Minimalist T-shirt Designs Are Timeless',
                'slug' => 'why-minimalist-t-shirt-designs-are-timeless',
                'excerpt' => 'Minimalist t-shirt designs never go out of style and can elevate your everyday look.',
                'content' => "Minimalist t-shirt designs never go out of style and can elevate your everyday look.\n\nA strong silhouette, premium fabric, and restrained visual detail often outlast trend-heavy graphics. Minimal pieces are easier to pair, easier to repeat, and easier to build collections around.\n\nThat simplicity gives them staying power. Instead of relying on novelty, they rely on proportion, quality, and everyday usability.",
                'featured_image' => 'assets/images/post-item3.jpg',
            ],
            [
                'title' => 'How to Build a Smart Everyday Streetwear Rotation',
                'slug' => 'how-to-build-a-smart-everyday-streetwear-rotation',
                'excerpt' => 'Create a reliable rotation of tees, hoodies, and outer layers without overbuying.',
                'content' => "Create a reliable rotation of tees, hoodies, and outer layers without overbuying.\n\nStart with core pieces you can wear repeatedly: a black hoodie, a white tee, a washed graphic shirt, and one elevated layering option. Once those basics are covered, add variety through texture and print.\n\nA smart rotation is less about quantity and more about coordination. The best wardrobes make styling quick and consistent.",
                'featured_image' => 'assets/images/post-item4.jpg',
            ],
            [
                'title' => 'Choosing the Right Hoodie Fit for Comfort and Style',
                'slug' => 'choosing-the-right-hoodie-fit-for-comfort-and-style',
                'excerpt' => 'The right hoodie fit changes how a piece looks, layers, and feels throughout the day.',
                'content' => "The right hoodie fit changes how a piece looks, layers, and feels throughout the day.\n\nRelaxed fits create a casual silhouette and work well with streetwear styling, while standard fits are more versatile for everyday layering. Fabric weight also matters because it affects drape and structure.\n\nCustomers often keep and rebuy the pieces that feel right immediately, so fit should be treated as a core product decision, not an afterthought.",
                'featured_image' => 'assets/images/post-item5.jpg',
            ],
            [
                'title' => 'Graphic Prints That Actually Work in Daily Wear',
                'slug' => 'graphic-prints-that-actually-work-in-daily-wear',
                'excerpt' => 'The best graphic tees stand out without becoming difficult to style.',
                'content' => "The best graphic tees stand out without becoming difficult to style.\n\nStrong graphic design is about balance. Clear focal points, limited color clashes, and prints that complement the garment silhouette create pieces that feel intentional instead of noisy.\n\nFor everyday wear, the best graphics support the outfit rather than overpower it. That makes them easier to wear repeatedly and easier to sell confidently.",
                'featured_image' => 'assets/images/post-item6.jpg',
            ],
            [
                'title' => 'Layering Basics: Tees, Hoodies, and Seasonal Flexibility',
                'slug' => 'layering-basics-tees-hoodies-and-seasonal-flexibility',
                'excerpt' => 'Layering makes simple pieces work harder across changing temperatures and styles.',
                'content' => "Layering makes simple pieces work harder across changing temperatures and styles.\n\nA tee under an open shirt, a hoodie beneath a jacket, or a heavyweight long-sleeve under outerwear all extend the usefulness of basic products. Small fabric and fit decisions change the final silhouette significantly.\n\nWell-layered wardrobes feel more premium because they offer more combinations from fewer items. That is a strong selling point for any clothing brand.",
                'featured_image' => 'assets/images/post-item7.jpg',
            ],
            [
                'title' => 'Why Quality Fabric Matters More Than Trends',
                'slug' => 'why-quality-fabric-matters-more-than-trends',
                'excerpt' => 'Fabric quality drives comfort, repeat wear, and long-term customer satisfaction.',
                'content' => "Fabric quality drives comfort, repeat wear, and long-term customer satisfaction.\n\nEven a simple design can feel premium when the fabric weight, softness, and finish are right. Customers notice how a garment washes, how it holds shape, and how it feels on skin after repeated use.\n\nTrends can attract the first purchase, but quality is what brings customers back. That is why fabric should be one of the strongest selling points in any collection.",
                'featured_image' => 'assets/images/post-item1.jpg',
            ],
        ];

        foreach ($blogPosts as $index => $post) {
            BlogPost::updateOrCreate([
                'slug' => $post['slug'],
            ], array_merge($post, [
                'user_id' => $admin->id,
                'is_published' => true,
                'published_at' => now()->subDays(7 - min($index, 7)),
            ]));
        }

        Coupon::updateOrCreate([
            'code' => 'WELCOME10',
        ], [
            'type' => 'percent',
            'value' => 10,
            'min_order_amount' => 20,
            'usage_limit' => 100,
            'used_count' => 0,
            'is_active' => true,
            'starts_at' => now()->subDay(),
            'ends_at' => now()->addMonths(3),
        ]);
    }
}
