<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ZahranKopiTest extends TestCase
{
    use RefreshDatabase;

    private function createAdmin(): User
    {
        return User::create([
            'name' => 'Admin Test',
            'email' => 'admin@zahrankopi.id',
            'password' => Hash::make('AdminZahranKopi123!'),
            'is_admin' => true,
        ]);
    }

    public function test_public_pages_render_successfully_with_seeded_data(): void
    {
        $category = Category::create([
            'name' => 'Kuliner & Minuman',
            'slug' => 'kuliner-minuman',
            'description' => 'Produk kuliner khas Nusantara.',
            'icon' => 'utensils',
        ]);

        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Kopi Arabika Gayo',
            'slug' => 'kopi-arabika-gayo',
            'description' => 'Kopi arabika pilihan dari dataran tinggi Gayo.',
            'price' => 85000,
            'stock' => 25,
            'is_featured' => true,
            'seller_name' => 'Zahran Kopi Roastery',
            'seller_whatsapp' => '6281234567890',
        ]);

        $this->get('/')->assertOk()->assertSee('Zahran')->assertSee($product->name);
        $this->get('/produk')->assertOk()->assertSee($product->name);
        $this->get('/produk?q=Gayo&kategori=kuliner-minuman')->assertOk()->assertSee($product->name);
        $this->get('/produk?q=TidakAdaProdukXYZ')->assertOk()->assertSee('Produk Tidak Ditemukan');
        $this->get('/produk/' . $product->slug)->assertOk()->assertSee('Hubungi Penjual via WhatsApp');
        $this->get('/kategori')->assertOk()->assertSee($category->name);
        $this->get('/kategori/' . $category->slug)->assertOk()->assertSee($product->name);
        $this->get('/tentang-kami')->assertOk()->assertSee('Visi Kami');
        $this->get('/kontak')->assertOk()->assertSee('Kirim Pesan Kepada Kami');
    }

    public function test_eloquent_relationships_between_category_and_product(): void
    {
        $category = Category::create([
            'name' => 'Kerajinan Tangan',
            'slug' => 'kerajinan-tangan',
        ]);

        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Tas Anyaman Pandan',
            'slug' => 'tas-anyaman-pandan',
            'description' => 'Tas anyaman buatan pengrajin lokal.',
            'price' => 175000,
            'stock' => 10,
        ]);

        $this->assertTrue($category->products->contains($product));
        $this->assertSame($category->id, $product->category->id);
    }

    public function test_contact_form_validation_and_submission(): void
    {
        $invalid = $this->post('/kontak', []);
        $invalid->assertSessionHasErrors(['name', 'email', 'subject', 'message']);

        $valid = $this->post('/kontak', [
            'name' => 'Siti Aminah',
            'email' => 'siti@example.com',
            'phone' => '081234567890',
            'subject' => 'Mitra UMKM',
            'message' => 'Saya ingin mendaftarkan produk kerajinan rotan ke Zahran Kopi.',
        ]);

        $valid->assertRedirect(route('contact.index'));
        $valid->assertSessionHas('success');
        $this->assertDatabaseHas('contact_messages', [
            'email' => 'siti@example.com',
            'subject' => 'Mitra UMKM',
        ]);
    }

    public function test_admin_authentication_and_route_protection(): void
    {
        $this->get('/admin')->assertRedirect(route('admin.login'));
        $this->get('/admin/produk')->assertRedirect(route('admin.login'));

        $regularUser = User::create([
            'name' => 'Pembeli Biasa',
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
            'is_admin' => false,
        ]);

        $this->actingAs($regularUser)
            ->get('/admin')
            ->assertRedirect(route('admin.login'));

        $admin = $this->createAdmin();

        $this->post('/admin/login', [
            'email' => $admin->email,
            'password' => 'AdminZahranKopi123!',
        ])->assertRedirect(route('admin.dashboard'));

        $this->actingAs($admin)
            ->get('/admin')
            ->assertOk()
            ->assertSee('Ringkasan Dashboard');

        $this->actingAs($admin)
            ->post('/admin/logout')
            ->assertRedirect(route('admin.login'));
    }

    public function test_admin_crud_category_with_validation(): void
    {
        $admin = $this->createAdmin();
        $this->actingAs($admin);

        // Validasi wajib diisi
        $this->post(route('admin.categories.store'), ['name' => ''])
            ->assertSessionHasErrors(['name']);

        // Create
        $this->post(route('admin.categories.store'), [
            'name' => 'Dekorasi Rumah',
            'description' => 'Produk dekorasi ruang estetik.',
            'icon' => 'home',
        ])->assertRedirect(route('admin.categories.index'));

        $category = Category::where('slug', 'dekorasi-rumah')->firstOrFail();

        // Update
        $this->put(route('admin.categories.update', $category), [
            'name' => 'Dekorasi Interior',
            'slug' => 'dekorasi-interior',
            'description' => 'Produk dekorasi interior modern.',
            'icon' => 'home',
        ])->assertRedirect(route('admin.categories.index'));

        $this->assertDatabaseHas('categories', ['slug' => 'dekorasi-interior']);

        // Delete
        $this->delete(route('admin.categories.destroy', $category))
            ->assertRedirect(route('admin.categories.index'));

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

    public function test_admin_crud_product_with_image_upload_replacement_and_cleanup(): void
    {
        Storage::fake('public');
        $admin = $this->createAdmin();
        $this->actingAs($admin);

        $category = Category::create([
            'name' => 'Fashion & Batik',
            'slug' => 'fashion-batik',
            'icon' => 'shirt',
        ]);

        // Validasi form produk
        $this->post(route('admin.products.store'), [
            'name' => '',
            'price' => 'bukan-angka',
        ])->assertSessionHasErrors(['category_id', 'name', 'description', 'price', 'image']);

        // Create produk + upload gambar
        $firstImage = UploadedFile::fake()->image('batik.jpg', 800, 600);
        $this->post(route('admin.products.store'), [
            'category_id' => $category->id,
            'name' => 'Batik Tulis Sekar Jagad',
            'description' => 'Batik tulis asli Solo berbahan katun primisima.',
            'price' => 325000,
            'stock' => 15,
            'image' => $firstImage,
            'is_featured' => '1',
            'seller_name' => 'Griya Batik',
            'seller_whatsapp' => '6281234567890',
        ])->assertRedirect(route('admin.products.index'));

        $product = Product::where('slug', 'batik-tulis-sekar-jagad')->firstOrFail();
        $oldImagePath = $product->image;
        Storage::disk('public')->assertExists($oldImagePath);

        // Update produk + ganti gambar -> gambar lama harus terhapus
        $secondImage = UploadedFile::fake()->image('batik-baru.png', 800, 600);
        $this->put(route('admin.products.update', $product), [
            'category_id' => $category->id,
            'name' => 'Batik Tulis Sekar Jagad Edisi Baru',
            'slug' => 'batik-tulis-sekar-jagad-edisi-baru',
            'description' => 'Batik tulis asli Solo dengan pewarna alam.',
            'price' => 350000,
            'stock' => 12,
            'image' => $secondImage,
        ])->assertRedirect(route('admin.products.index'));

        $product->refresh();
        Storage::disk('public')->assertMissing($oldImagePath);
        Storage::disk('public')->assertExists($product->image);

        // Hapus produk -> gambar harus terhapus
        $currentImagePath = $product->image;
        $this->delete(route('admin.products.destroy', $product))
            ->assertRedirect(route('admin.products.index'));

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
        Storage::disk('public')->assertMissing($currentImagePath);
    }
}
