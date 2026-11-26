<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactMessageRequest;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * Menampilkan halaman kontak Zahran Kopi.
     */
    public function index(): View
    {
        return view('pages.contact');
    }

    /**
     * Menyimpan pesan dari pengunjung melalui formulir kontak.
     */
    public function store(StoreContactMessageRequest $request): RedirectResponse
    {
        ContactMessage::create($request->validated());

        return redirect()
            ->route('contact.index')
            ->with('success', 'Terima kasih! Pesan Anda telah kami terima dan akan segera ditindaklanjuti oleh tim Zahran Kopi.');
    }
}
