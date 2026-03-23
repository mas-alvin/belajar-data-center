@extends('layouts.app')
@section('title', 'Pengaturan')
@section('page-title', 'Pengaturan Sistem')

@section('content')

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Left column --}}
    <div class="lg:col-span-2 space-y-6">

        {{-- Informasi Aplikasi --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="text-sm font-bold text-gray-800">Informasi Aplikasi</h2>
                <p class="text-xs text-gray-400 mt-0.5">Konfigurasi identitas dan tampilan sistem</p>
            </div>
            <div class="p-6 space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Aplikasi <span class="text-red-500">*</span></label>
                    <input type="text" value="DataCenter SMS"
                           class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Tagline / Deskripsi Singkat</label>
                    <input type="text" value="School Management System — Data Center"
                           class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">URL Aplikasi</label>
                    <input type="url" value="http://localhost/data-center/public"
                           class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all font-mono">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Timezone</label>
                    <select class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all appearance-none">
                        <option selected>Asia/Jakarta (WIB, UTC+7)</option>
                        <option>Asia/Makassar (WITA, UTC+8)</option>
                        <option>Asia/Jayapura (WIT, UTC+9)</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Upload Logo --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="text-sm font-bold text-gray-800">Logo Aplikasi</h2>
                <p class="text-xs text-gray-400 mt-0.5">Logo akan tampil di sidebar dan halaman login</p>
            </div>
            <div class="p-6">
                <div class="flex items-start gap-6">
                    {{-- Preview --}}
                    <div class="flex-shrink-0 w-20 h-20 rounded-xl bg-emerald-100 flex items-center justify-center border-2 border-dashed border-emerald-300">
                        <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    {{-- Upload area --}}
                    <div class="flex-1">
                        <div class="border-2 border-dashed border-gray-200 rounded-xl p-5 text-center hover:border-emerald-400 hover:bg-emerald-50/30 transition-colors cursor-pointer">
                            <svg class="w-8 h-8 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                            <p class="text-sm font-medium text-gray-600">Klik untuk upload logo</p>
                            <p class="text-xs text-gray-400 mt-1">PNG, JPG, SVG · Maks. 2MB · Rekomendasi 256×256px</p>
                            <input type="file" accept="image/*" class="hidden">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- API Configuration --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="text-sm font-bold text-gray-800">Konfigurasi API</h2>
                <p class="text-xs text-gray-400 mt-0.5">Pengaturan koneksi client aplikasi ke Data Center</p>
            </div>
            <div class="p-6 space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">API Base URL</label>
                    <input type="url" value="http://localhost/data-center/public/api/v1"
                           class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all font-mono">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">API Secret Key</label>
                    <div class="relative">
                        <input type="password" value="sk_live_xxxxxxxxxxxxxxxxxxx"
                               id="apiKeyInput"
                               class="w-full px-4 py-2.5 pr-12 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all font-mono">
                        <button type="button" onclick="toggleKey()"
                                class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-gray-600">
                            <svg id="eyeIcon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">API Token Lifetime <span class="text-gray-400 text-xs">(menit)</span></label>
                    <input type="number" value="120" min="5"
                           class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
                </div>
            </div>
        </div>

    </div>

    {{-- Right column --}}
    <div class="space-y-6">

        {{-- Preferensi --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="text-sm font-bold text-gray-800">Preferensi Sistem</h2>
            </div>
            <div class="p-6 space-y-4">
                @php
                    $prefs = [
                        ['label'=>'Mode Maintenance',    'desc'=>'Matikan akses publik',          'on'=>false],
                        ['label'=>'Debug Mode',          'desc'=>'Tampilkan error detail',        'on'=>false],
                        ['label'=>'Email Notifikasi',    'desc'=>'Kirim notif ke admin',          'on'=>true],
                        ['label'=>'Log Aktivitas',       'desc'=>'Rekam semua aktivitas user',    'on'=>true],
                        ['label'=>'Rate Limiter API',    'desc'=>'Batasi request per menit',      'on'=>true],
                    ];
                @endphp
                @foreach ($prefs as $p)
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <p class="text-sm font-medium text-gray-700">{{ $p['label'] }}</p>
                        <p class="text-xs text-gray-400">{{ $p['desc'] }}</p>
                    </div>
                    <button class="relative inline-flex h-5 w-9 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none
                                   {{ $p['on'] ? 'bg-emerald-500' : 'bg-gray-200' }}"
                            onclick="this.classList.toggle('bg-emerald-500'); this.classList.toggle('bg-gray-200'); this.querySelector('span').classList.toggle('translate-x-4'); this.querySelector('span').classList.toggle('translate-x-0');">
                        <span class="pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out
                                     {{ $p['on'] ? 'translate-x-4' : 'translate-x-0' }}"></span>
                    </button>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Save button card --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
            <button class="w-full px-4 py-3 text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl transition-colors flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Simpan Semua Perubahan
            </button>
            <p class="text-xs text-gray-400 text-center mt-3">Terakhir disimpan: Hari ini, 03:00 WIB</p>
        </div>

        {{-- Info versi --}}
        <div class="bg-gradient-to-br from-emerald-900 to-emerald-800 rounded-xl p-5 text-white">
            <p class="text-xs font-semibold text-emerald-300 uppercase tracking-wider mb-2">Versi Sistem</p>
            <p class="text-2xl font-bold">v1.0.0</p>
            <p class="text-xs text-emerald-300 mt-1">Laravel 12 · PHP 8.3 · TailwindCSS v4</p>
            <div class="mt-4 pt-4 border-t border-emerald-700">
                <p class="text-xs text-emerald-400">Build: 2026-03-20 · Stable</p>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function toggleKey() {
        const input = document.getElementById('apiKeyInput');
        input.type = input.type === 'password' ? 'text' : 'password';
    }
</script>
@endpush
