<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Mengisi data awal kategori produk UMKM @difMarket.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Kuliner & Minuman',
                'slug' => 'kuliner-minuman',
                'description' => 'Aneka makanan ringan, kopi lokal, sambal khas daerah, dan minuman olahan buatan UMKM Nusantara.',
                'icon' => 'utensils',
            ],
            [
                'name' => 'Fashion & Batik',
                'slug' => 'fashion-batik',
                'description' => 'Busana batik tulis, tenun ikat, pakaian kasual lokal, dan aksesoris fesyen karya pengrajin daerah.',
                'icon' => 'shirt',
            ],
            [
                'name' => 'Kerajinan Tangan',
                'slug' => 'kerajinan-tangan',
                'description' => 'Produk kriya autentik seperti anyaman pandan, tas rotan, ukiran kayu, dan suvenir ramah lingkungan.',
                'icon' => 'sparkles',
            ],
            [
                'name' => 'Kesehatan & Herbal',
                'slug' => 'kesehatan-herbal',
                'description' => 'Produk alami berbahan rempah pilihan seperti madu hutan murni, jamu tradisional, dan minyak atsiri.',
                'icon' => 'leaf',
            ],
            [
                'name' => 'Dekorasi Rumah',
                'slug' => 'dekorasi-rumah',
                'description' => 'Lilin aromaterapi, keramik hias, serta perlengkapan interior estetik hasil karya UMKM kreatif.',
                'icon' => 'home',
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
