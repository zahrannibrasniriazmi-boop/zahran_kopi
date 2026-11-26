<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

class DemoImageGenerator
{
    /**
     * Membuat gambar produk PNG ke storage publik jika belum tersedia.
     */
    public static function generate(
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

        for ($y = 0; $y < $height; $y++) {
            $ratio = $y / $height;
            $r = (int) round($r1 + ($r2 - $r1) * $ratio);
            $g = (int) round($g1 + ($g2 - $g1) * $ratio);
            $b = (int) round($b1 + ($b2 - $b1) * $ratio);
            $lineColor = imagecolorallocate($img, $r, $g, $b);
            imageline($img, 0, $y, $width, $y, $lineColor);
        }

        $circleLight = imagecolorallocatealpha($img, 255, 255, 255, 112);
        $circleAccent = imagecolorallocatealpha($img, $ar, $ag, $ab, 95);
        imagefilledellipse($img, 650, 130, 320, 320, $circleLight);
        imagefilledellipse($img, 140, 480, 260, 260, $circleAccent);

        $cardWhite = imagecolorallocatealpha($img, 255, 255, 255, 12);
        $cardShadow = imagecolorallocatealpha($img, 18, 20, 36, 95);
        imagefilledrectangle($img, 88, 108, 728, 508, $cardShadow);
        imagefilledrectangle($img, 80, 100, 720, 500, $cardWhite);

        $accentColor = imagecolorallocate($img, $ar, $ag, $ab);
        $primaryColor = imagecolorallocate($img, 108, 74, 182);
        $navyColor = imagecolorallocate($img, 32, 36, 58);
        $mutedColor = imagecolorallocate($img, 100, 107, 130);
        $whiteColor = imagecolorallocate($img, 255, 255, 255);

        imagefilledrectangle($img, 80, 100, 720, 112, $accentColor);
        imagefilledrectangle($img, 120, 148, 310, 186, $primaryColor);

        $softBg = imagecolorallocate($img, 248, 249, 252);
        imagefilledellipse($img, 585, 305, 180, 180, $softBg);
        imagefilledellipse($img, 585, 305, 130, 130, imagecolorallocatealpha($img, $r1, $g1, $b1, 35));
        imagefilledellipse($img, 585, 305, 72, 72, $accentColor);

        $fontBold = self::resolveFont(true);
        $fontRegular = self::resolveFont(false);

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

    private static function resolveFont(bool $bold): ?string
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
