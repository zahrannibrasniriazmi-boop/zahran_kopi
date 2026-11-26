@extends('layouts.admin')

@section('title', 'Pesan Masuk — Admin @difMarket')
@section('page_title', 'Pesan Kontak Pengunjung')
@section('page_subtitle', 'Pesan dan pertanyaan yang dikirim melalui halaman Kontak publik')

@section('content')
    <div class="space-y-4">
        @forelse ($messages as $msg)
            <div class="bg-white rounded-3xl border {{ $msg->is_read ? 'border-slate-200/80' : 'border-[#6C4AB6]/40 ring-2 ring-[#F1ECFB]' }} p-6 shadow-xs">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div>
                        <div class="flex items-center gap-2.5">
                            <h3 class="text-base font-extrabold text-[#20243A]">{{ $msg->subject }}</h3>
                            @if (! $msg->is_read)
                                <span class="px-2.5 py-0.5 rounded-full bg-[#FF9F43] text-white text-[11px] font-bold">Baru</span>
                            @else
                                <span class="px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-500 text-[11px] font-semibold">Dibaca</span>
                            @endif
                        </div>
                        <p class="mt-1 text-xs text-slate-500">
                            Dari: <strong class="text-[#20243A]">{{ $msg->name }}</strong> ({{ $msg->email }})
                            @if ($msg->phone)
                                &bull; WA: {{ $msg->phone }}
                            @endif
                            &bull; {{ $msg->created_at->format('d M Y H:i') }}
                        </p>
                    </div>

                    <div class="flex items-center gap-2">
                        @if (! $msg->is_read)
                            <form action="{{ route('admin.messages.read', $msg) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-3.5 py-1.5 rounded-full bg-[#F1ECFB] hover:bg-[#6C4AB6] text-[#6C4AB6] hover:text-white text-xs font-bold transition-colors cursor-pointer">
                                    Tandai Dibaca
                                </button>
                            </form>
                        @endif
                        <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" data-delete-form>
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    data-delete-trigger
                                    data-item-name="pesan dari {{ $msg->name }}"
                                    class="px-3.5 py-1.5 rounded-full bg-rose-50 hover:bg-rose-600 text-rose-600 hover:text-white text-xs font-bold transition-colors cursor-pointer">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>

                <p class="mt-4 text-sm text-slate-600 leading-relaxed bg-[#F8F9FC] p-4 rounded-2xl border border-slate-100">
                    {{ $msg->message }}
                </p>
            </div>
        @empty
            <div class="bg-white rounded-3xl border border-slate-200/80 p-12 text-center text-slate-500">
                Belum ada pesan masuk dari formulir kontak.
            </div>
        @endforelse

        @if ($messages->hasPages())
            <div class="pt-4">
                {{ $messages->links() }}
            </div>
        @endif
    </div>
@endsection
