<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Mengisi data contoh produk UMKM beserta gambar di storage/app/public/products.
     */
    public function run(): void
    {
        Storage::disk('public')->makeDirectory('products');

        $products = [
            [
                'category_slug' => 'kuliner-minuman',
                'name' => 'Kopi Arabika Gayo Sangrai Medium 250g',
                'slug' => 'kopi-arabika-gayo-sangrai-medium-250g',
                'description' => "Kopi Arabika single-origin dari dataran tinggi Gayo, Aceh Tengah, diproses secara semi-washed oleh kelompok tani UMKM binaan.\n\nMemiliki profil rasa karamel lembut, cokelat hitam, dan sedikit aroma jeruk dengan tingkat keasaman seimbang. Cocok diseduh menggunakan V60, French Press, maupun tubruk.",
                'price' => 85000,
                'stock' => 34,
                'image' => 'products/kopi-arabika-gayo.png',
                'is_featured' => true,
                'seller_name' => 'UMKM Kopi Serambi',
                'seller_whatsapp' => '6281234567001',
                'palette' => [[108, 74, 182], [63, 43, 117], [255, 159, 67]],
                'badge' => 'KULINER',
            ],
            [
                'category_slug' => 'kuliner-minuman',
                'name' => 'Keripik Tempe Renyah Daun Jeruk 200g',
                'slug' => 'keripik-tempe-renyah-daun-jeruk-200g',
                'description' => "Camilan gurih khas Malang yang dibuat dari kedelai pilihan dengan balutan tepung berbumbu ketumbar dan irisan daun jeruk segar.\n\nDigoreng menggunakan minyak kelapa berkualitas tanpa bahan pengawet sehingga menghasilkan tekstur tipis, renyah, dan tidak berminyak.",
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
                'description' => "Kemeja batik tulis autentik karya pembatik Solo menggunakan kain katun primisima 100% yang adem dan nyaman dipakai seharian.\n\nMotif Sekar Jagad melambangkan keharmonisan dan keindahan Nusantara. Jahitan rapi dengan furing halus, cocok untuk acara formal maupun kasual modern.",
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
                'description' => "Syal tenun ikat yang ditenun manual menggunakan Alat Tenun Bukan Mesin (ATBM) dengan benang katun lembut dan pewarna alami dari akar mengkudu serta daun indigo.\n\nMemberikan sentuhan etnik yang elegan untuk melengkapi gaya busana kerja maupun santai.",
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
                'description' => "Tas selempang wanita berbahan anyaman daun pandan kering pilihan yang dipadukan dengan tali kulit sintetis premium dan lapisan kain batik di bagian dalam.\n\nRingan, kuat, dan dibuat secara teliti oleh pengrajin perempuan di Tasikmalaya.",
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
                'description' => "Madu murni hasil panen lestari dari lebah hutan Apis dorsata tanpa pemanasan berlebih dan tanpa campuran gula.\n\nKaya antioksidan alami untuk menjaga daya tahan tubuh, dikemas higienis dalam botol kaca tebal bersegel aman.",
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
                'description' => "Lilin aromaterapi berbahan 100% soy wax ramah lingkungan yang dipadukan dengan minyak atsiri sereh wangi dan lavender.\n\nMembantu menciptakan suasana ruang kerja dan kamar tidur yang tenang hingga 35 jam pembakaran.",
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
                'description' => "Sambal rumahan berbahan ikan roa asap asli Sulawesi Utara yang dihaluskan dan dimasak perlahan bersama cabai rawit pilihan dan bawang merah segar.\n\nNikmat disantap bersama nasi hangat, bubur, maupun gorengan.",
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

            $this->generateProductArtwork(
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

    /**
     * Membuat gambar produk PNG berkualitas ke storage publik jika belum tersedia.
     */
    private function generateProductArtwork(
        string $relativePath,
        string $title,
        string $badge,
        string $seller,
        array $palette
    ): void {
        $fullPath = Storage::disk('public')->path($relativePath);

        if (file_exists($fullPath) || ! extension_loaded('gd')) {
            return;
        }

        $width = 800;
        $height = 600;
        $img = imagecreatetruecolor($width, $height);
        imagealphablending($img, true);

        [$r1, $g1, $b1] = $palette[0];
        [$r2, $g2, $b2] = $palette[1];
        [$ar, $ag, $ab] = $palette[2];

        // Gradien latar vertikal halus
        for ($y = 0; $y < $height; $y++) {
            $ratio = $y / $height;
            $r = (int) round($r1 + ($r2 - $r1) * $ratio);
            $g = (int) round($g1 + ($g2 - $g1) * $ratio);
            $b = (int) round($b1 + ($b2 - $b1) * $ratio);
            $lineColor = imagecolorallocate($img, $r, $g, $b);
            imageline($img, 0, $y, $width, $y, $lineColor);
        }

        // Lingkaran dekoratif transparan
        $circleLight = imagecolorallocatealpha($img, 255, 255, 255, 112);
        $circleAccent = imagecolorallocatealpha($img, $ar, $ag, $ab, 95);
        imagefilledellipse($img, 650, 130, 320, 320, $circleLight);
        imagefilledellipse($img, 140, 480, 260, 260, $circleAccent);

        // Kartu produk tengah
        $cardWhite = imagecolorallocatealpha($img, 255, 255, 255, 12);
        $cardShadow = imagecolorallocatealpha($img, 18, 20, 36, 95);
        imagefilledrectangle($img, 88, 108, 728, 508, $cardShadow);
        imagefilledrectangle($img, 80, 100, 720, 500, $cardWhite);

        // Aksen garis atas kartu
        $accentColor = imagecolorallocate($img, $ar, $ag, $ab);
        $primaryColor = imagecolorallocate($img, 108, 74, 182);
        $navyColor = imagecolorallocate($img, 32, 36, 58);
        $mutedColor = imagecolorallocate($img, 100, 107, 130);
        $whiteColor = imagecolorallocate($img, 255, 255, 255);

        imagefilledrectangle($img, 80, 100, 720, 112, $accentColor);

        // Badge kategori di dalam kartu
        imagefilledrectangle($img, 120, 148, 310, 186, $primaryColor);

        // Ikon ilustrasi geometris produk di kanan
        $softBg = imagecolorallocate($img, 248, 249, 252);
        imagefilledellipse($img, 585, 305, 180, 180, $softBg);
        imagefilledellipse($img, 585, 305, 130, 130, imagecolorallocatealpha($img, $r1, $g1, $b1, 35));
        imagefilledellipse($img, 585, 305, 72, 72, $accentColor);

        $fontBold = $this->resolveFont(true);
        $fontRegular = $this->resolveFont(false);

        if ($fontBold && $fontRegular) {
            imagettftext($img, 12, 0, 136, 173, $whiteColor, $fontBold, $badge);

            $wrapped = wordwrap($title, 24, "\n");
            $lines = array_slice(explode("\n", $wrapped), 0, 3);
            $yPos = 245;
            foreach ($lines as $line) {
                imagettftext($img, 24, 0, 120, $yPos, $navyColor, $fontBold, $line);
                $yPos += 40;
            }

            imagettftext($img, 14, 0, 120, 415, $mutedColor, $fontRegular, 'Oleh: ' . $seller);
            imagettftext($img, 13, 0, 120, 455, $primaryColor, $fontBold, 'Zahran Kopi • Produk UMKM Asli Indonesia');
        } else {
            imagestring($img, 4, 135, 160, $badge, $whiteColor);
            $lines = array_slice(explode("\n", wordwrap($title, 34, "\n")), 0, 3);
            $yPos = 230;
            foreach ($lines as $line) {
                imagestring($img, 5, 120, $yPos, $line, $navyColor);
                $yPos += 28;
            }
            imagestring($img, 4, 120, 405, 'Oleh: ' . $seller, $mutedColor);
            imagestring($img, 3, 120, 445, 'Zahran Kopi - Marketplace UMKM', $primaryColor);
        }

        imagepng($img, $fullPath, 6);
        imagedestroy($img);
    }

    private function resolveFont(bool $bold): ?string
    {
        $candidates = $bold
            ? [
                'C:\\Windows\\Fonts\\segoeuib.ttf',
                'C:\\Windows\\Fonts\\arialbd.ttf',
                '/usr/share/fonts/truetype/dejavu/DejaVuSans-Bold.ttf',
            ]
            : [
                'C:\\Windows\\Fonts\\segoeui.ttf',
                'C:\\Windows\\Fonts\\arial.ttf',
                '/usr/share/fonts/truetype/dejavu/DejaVuSans.ttf',
            ];

        foreach ($candidates as $path) {
            if (file_exists($path)) {
                return $path;
            }
        }

        return null;
    }
}
