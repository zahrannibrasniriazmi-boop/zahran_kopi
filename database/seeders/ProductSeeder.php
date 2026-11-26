<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Support\DemoImageGenerator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Mengisi data contoh produk UMKM Zahran Kopi beserta gambar di storage/app/public/products.
     */
    public function run(): void
    {
        Storage::disk('public')->makeDirectory('products');

        $products = [
            [
                'category_slug' => 'kuliner-minuman',
                'name' => 'Kopi Arabika Gayo Sangrai Medium 250g',
                'slug' => 'kopi-arabika-gayo-sangrai-medium-250g',
                'description' => "Kopi Arabika single-origin dari dataran tinggi Gayo, Aceh Tengah, diproses secara semi-washed oleh kelompok tani UMKM binaan.\n\nMemiliki profil rasa karamel lembut, cokelat hitam, dan sedikit aroma jeruk dengan tingkat keasaman seimbang.",
                'price' => 85000,
                'stock' => 34,
                'image' => 'products/kopi-arabika-gayo.png',
                'is_featured' => true,
                'seller_name' => 'Zahran Kopi Roastery',
                'seller_whatsapp' => '6281234567001',
                'palette' => [[108, 74, 182], [63, 43, 117], [255, 159, 67]],
                'badge' => 'KULINER',
            ],
            [
                'category_slug' => 'kuliner-minuman',
                'name' => 'Keripik Tempe Renyah Daun Jeruk 200g',
                'slug' => 'keripik-tempe-renyah-daun-jeruk-200g',
                'description' => "Camilan gurih khas Malang dari kedelai pilihan dengan balutan tepung berbumbu ketumbar dan irisan daun jeruk segar.\n\nDigoreng tanpa bahan pengawet sehingga tipis, renyah, dan tidak berminyak.",
                'price' => 24000,
                'stock' => 60,
                'image' => 'products/keripik-tempe-daun-jeruk.png',
                'is_featured' => false,
                'seller_name' => 'Dapur Sari Kedelai',
                'seller_whatsapp' => '6281234567002',
                'palette' => [[245, 130, 32], [189, 86, 15], [108, 74, 182]],
                'badge' => 'CAMILAN',
            ],
            [
                'category_slug' => 'fashion-batik',
                'name' => 'Kemeja Batik Tulis Sekar Jagad Katun Primisima',
                'slug' => 'kemeja-batik-tulis-sekar-jagad-katun-primisima',
                'description' => "Kemeja batik tulis autentik karya pembatik Solo menggunakan kain katun primisima 100% yang adem dan nyaman dipakai seharian.",
                'price' => 325000,
                'stock' => 12,
                'image' => 'products/batik-sekar-jagad.png',
                'is_featured' => true,
                'seller_name' => 'Griya Batik Larasati',
                'seller_whatsapp' => '6281234567003',
                'palette' => [[78, 54, 148], [32, 36, 58], [255, 159, 67]],
                'badge' => 'BATIK TULIS',
            ],
            [
                'category_slug' => 'fashion-batik',
                'name' => 'Syal Tenun Ikat Nusantara Pewarna Alam',
                'slug' => 'syal-tenun-ikat-nusantara-pewarna-alam',
                'description' => "Syal tenun ikat manual ATBM dengan benang katun lembut dan pewarna alami dari akar mengkudu serta daun indigo.",
                'price' => 145000,
                'stock' => 18,
                'image' => 'products/syal-tenun-ikat.png',
                'is_featured' => false,
                'seller_name' => 'Tenun Karya Timur',
                'seller_whatsapp' => '6281234567004',
                'palette' => [[108, 74, 182], [141, 102, 214], [255, 183, 107]],
                'badge' => 'TENUN ATBM',
            ],
            [
                'category_slug' => 'kerajinan-tangan',
                'name' => 'Tas Anyaman Pandan Etnik Kulit Sintetis',
                'slug' => 'tas-anyaman-pandan-etnik-kulit-sintetis',
                'description' => "Tas selempang wanita berbahan anyaman daun pandan kering pilihan dengan tali kulit sintetis premium dan lapisan kain batik.",
                'price' => 175000,
                'stock' => 20,
                'image' => 'products/tas-anyaman-pandan.png',
                'is_featured' => true,
                'seller_name' => 'Kriya Pandan Mandiri',
                'seller_whatsapp' => '6281234567005',
                'palette' => [[214, 126, 48], [139, 86, 41], [108, 74, 182]],
                'badge' => 'KRIYA LOKAL',
            ],
            [
                'category_slug' => 'kesehatan-herbal',
                'name' => 'Madu Hutan Murni Nusantara 500ml',
                'slug' => 'madu-hutan-murni-nusantara-500ml',
                'description' => "Madu murni hasil panen lestari dari lebah hutan Apis dorsata tanpa campuran gula, dikemas higienis dalam botol kaca tebal.",
                'price' => 135000,
                'stock' => 25,
                'image' => 'products/madu-hutan-murni.png',
                'is_featured' => true,
                'seller_name' => 'Rimbo Lestari Honey',
                'seller_whatsapp' => '6281234567006',
                'palette' => [[255, 159, 67], [184, 101, 20], [32, 36, 58]],
                'badge' => 'HERBAL ALAMI',
            ],
            [
                'category_slug' => 'dekorasi-rumah',
                'name' => 'Lilin Aromaterapi Soy Wax Sereh & Lavender',
                'slug' => 'lilin-aromaterapi-soy-wax-sereh-lavender',
                'description' => "Lilin aromaterapi berbahan 100% soy wax ramah lingkungan dengan minyak atsiri sereh wangi dan lavender.",
                'price' => 79000,
                'stock' => 28,
                'image' => 'products/lilin-aromaterapi-sereh.png',
                'is_featured' => false,
                'seller_name' => 'Studio Wangi Lokal',
                'seller_whatsapp' => '6281234567007',
                'palette' => [[125, 92, 198], [88, 60, 156], [255, 159, 67]],
                'badge' => 'DEKORASI',
            ],
            [
                'category_slug' => 'kuliner-minuman',
                'name' => 'Sambal Roa Asap Khas Manado 180g',
                'slug' => 'sambal-roa-asap-khas-manado-180g',
                'description' => "Sambal rumahan berbahan ikan roa asap asli Sulawesi Utara yang dimasak perlahan bersama cabai rawit pilihan dan bawang merah segar.",
                'price' => 45000,
                'stock' => 42,
                'image' => 'products/sambal-roa-manado.png',
                'is_featured' => false,
                'seller_name' => 'Dapur Minahasa Sejati',
                'seller_whatsapp' => '6281234567008',
                'palette' => [[224, 92, 62], [148, 43, 35], [255, 159, 67]],
                'badge' => 'KULINER KHAS',
            ],
        ];

        foreach ($products as $item) {
            $category = Category::where('slug', $item['category_slug'])->first();

            if (! $category) {
                continue;
            }

            DemoImageGenerator::generate(
                $item['image'],
                $item['name'],
                $item['badge'],
                $item['seller_name'],
                $item['palette']
            );

            Product::updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'category_id' => $category->id,
                    'name' => $item['name'],
                    'description' => $item['description'],
                    'price' => $item['price'],
                    'stock' => $item['stock'],
                    'image' => $item['image'],
                    'is_featured' => $item['is_featured'],
                    'seller_name' => $item['seller_name'],
                    'seller_whatsapp' => $item['seller_whatsapp'],
                ]
            );
        }
    }
}
