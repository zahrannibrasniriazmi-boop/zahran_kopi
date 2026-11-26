<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image',
        'is_featured',
        'seller_name',
        'seller_whatsapp',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'integer',
            'stock' => 'integer',
            'is_featured' => 'boolean',
        ];
    }

    /**
     * Setiap produk dimiliki oleh satu kategori.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Mengembalikan harga dalam format Rupiah.
     */
    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    /**
     * Mengembalikan URL gambar dari storage publik atau placeholder jika belum ada.
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image && Storage::disk('public')->exists($this->image)) {
            return asset('storage/' . $this->image);
        }

        return asset('images/product-placeholder.svg');
    }

    /**
     * Membangun tautan WhatsApp untuk menghubungi penjual produk.
     */
    public function getWhatsappUrlAttribute(): string
    {
        $rawPhone = $this->seller_whatsapp ?: '6281234567890';
        $phone = preg_replace('/[^0-9]/', '', $rawPhone);

        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }

        $message = sprintf(
            "Halo %s, saya tertarik dengan produk *%s* (%s) di @difMarket. Apakah stok masih tersedia?",
            $this->seller_name ?: 'Penjual UMKM',
            $this->name,
            $this->formatted_price
        );

        return 'https://wa.me/' . $phone . '?text=' . rawurlencode($message);
    }
}
