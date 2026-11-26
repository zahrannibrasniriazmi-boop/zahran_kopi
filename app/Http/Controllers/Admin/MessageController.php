<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MessageController extends Controller
{
    /**
     * Menampilkan pesan masuk dari formulir kontak publik.
     */
    public function index(): View
    {
        $messages = ContactMessage::latest()->paginate(10);

        return view('admin.messages.index', compact('messages'));
    }

    /**
     * Menandai pesan sebagai sudah dibaca.
     */
    public function markRead(ContactMessage $message): RedirectResponse
    {
        $message->update(['is_read' => true]);

        return redirect()
            ->route('admin.messages.index')
            ->with('success', 'Pesan telah ditandai sebagai sudah dibaca.');
    }

    /**
     * Menghapus pesan masuk.
     */
    public function destroy(ContactMessage $message): RedirectResponse
    {
        $message->delete();

        return redirect()
            ->route('admin.messages.index')
            ->with('success', 'Pesan berhasil dihapus.');
    }
}
