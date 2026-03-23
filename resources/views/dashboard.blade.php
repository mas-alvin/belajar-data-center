@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Overview')
@section('page-subtitle', 'Selamat datang di Data Center Sekolah')

@section('content')

{{-- ============================================================ --}}
{{-- STAT CARDS                                                    --}}
{{-- ============================================================ --}}
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-6">

    {{-- Card: Total Siswa --}}
    <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-sm hover:shadow-md transition-shadow duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Total Siswa</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">1,248</p>
            </div>
            <div class="w-12 h-12 flex items-center justify-center bg-blue-50 text-blue-600 rounded-xl flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center gap-1.5 text-sm">
            <span class="inline-flex items-center gap-0.5 text-green-600 font-semibold">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                </svg>
                2.5%
            </span>
            <span class="text-gray-400">dari bulan lalu</span>
        </div>
    </div>

    {{-- Card: Total Guru --}}
    <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-sm hover:shadow-md transition-shadow duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Total Guru</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">84</p>
            </div>
            <div class="w-12 h-12 flex items-center justify-center bg-indigo-50 text-indigo-600 rounded-xl flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center gap-1.5 text-sm">
            <span class="inline-flex items-center gap-0.5 text-green-600 font-semibold">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                </svg>
                1.2%
            </span>
            <span class="text-gray-400">dari bulan lalu</span>
        </div>
    </div>

    {{-- Card: Kelas Aktif --}}
    <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-sm hover:shadow-md transition-shadow duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Kelas Aktif</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">36</p>
            </div>
            <div class="w-12 h-12 flex items-center justify-center bg-amber-50 text-amber-600 rounded-xl flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center gap-1.5 text-sm">
            <span class="inline-flex items-center gap-0.5 text-gray-500 font-semibold">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 12H4"/>
                </svg>
                0%
            </span>
            <span class="text-gray-400">stabil</span>
        </div>
    </div>

    {{-- Card: Total User --}}
    <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-sm hover:shadow-md transition-shadow duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Total User</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">12</p>
            </div>
            <div class="w-12 h-12 flex items-center justify-center bg-emerald-50 text-emerald-600 rounded-xl flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center gap-1.5 text-sm">
            <span class="inline-flex items-center gap-0.5 text-emerald-600 font-semibold">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                </svg>
                +3
            </span>
            <span class="text-gray-400">user baru bulan ini</span>
        </div>
    </div>
</div>

{{-- ============================================================ --}}
{{-- CHART + DISTRIBUSI                                            --}}
{{-- ============================================================ --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-6">

    {{-- Bar Chart (dummy SVG) --}}
    <div class="lg:col-span-2 bg-white rounded-xl border border-gray-100 p-5 shadow-sm">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h2 class="text-base font-semibold text-gray-800">Perkembangan Siswa</h2>
                <p class="text-xs text-gray-400 mt-0.5">6 bulan terakhir</p>
            </div>
            <span class="text-xs font-medium bg-blue-50 text-blue-600 px-2.5 py-1 rounded-full">2025</span>
        </div>

        {{-- Simple pure-CSS bar chart --}}
        <div class="flex items-end justify-between gap-3 h-40">
            @php
                $months = [
                    ['label' => 'Okt', 'pct' => 60],
                    ['label' => 'Nov', 'pct' => 72],
                    ['label' => 'Des', 'pct' => 65],
                    ['label' => 'Jan', 'pct' => 80],
                    ['label' => 'Feb', 'pct' => 88],
                    ['label' => 'Mar', 'pct' => 95],
                ];
            @endphp
            @foreach ($months as $m)
            <div class="flex flex-col items-center gap-1.5 flex-1">
                <span class="text-xs font-semibold text-gray-600">{{ round($m['pct'] * 1248 / 100) }}</span>
                <div class="w-full rounded-t-md bg-blue-100 relative overflow-hidden" style="height: 120px;">
                    <div class="absolute bottom-0 left-0 right-0 bg-blue-500 rounded-t-md transition-all duration-700 hover:bg-blue-600"
                         style="height: {{ $m['pct'] }}%;"></div>
                </div>
                <span class="text-xs text-gray-400">{{ $m['label'] }}</span>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Distribusi Siswa (donut dummy) --}}
    <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-sm">
        <h2 class="text-base font-semibold text-gray-800 mb-1">Distribusi Kelas</h2>
        <p class="text-xs text-gray-400 mb-5">Berdasarkan tingkat</p>

        {{-- Donut SVG --}}
        <div class="flex items-center justify-center mb-5">
            <svg viewBox="0 0 36 36" class="w-28 h-28 -rotate-90">
                {{-- Total: 1248 — Kelas X: 430 (34%), XI: 410 (33%), XII: 408 (33%) --}}
                <circle cx="18" cy="18" r="15.9155" fill="none" stroke="#e0e7ff" stroke-width="3.5"/>
                {{-- XII: 33% → offset 0 --}}
                <circle cx="18" cy="18" r="15.9155" fill="none" stroke="#6366f1" stroke-width="3.5"
                        stroke-dasharray="33 67" stroke-dashoffset="0"/>
                {{-- XI: 33% → offset -33 --}}
                <circle cx="18" cy="18" r="15.9155" fill="none" stroke="#3b82f6" stroke-width="3.5"
                        stroke-dasharray="33 67" stroke-dashoffset="-33"/>
                {{-- X: 34% → offset -66 --}}
                <circle cx="18" cy="18" r="15.9155" fill="none" stroke="#60a5fa" stroke-width="3.5"
                        stroke-dasharray="34 66" stroke-dashoffset="-66"/>
            </svg>
        </div>

        <div class="space-y-2.5">
            @php
                $levels = [
                    ['label' => 'Kelas X',   'color' => 'bg-blue-300',  'count' => 430, 'pct' => 34],
                    ['label' => 'Kelas XI',  'color' => 'bg-blue-500',  'count' => 410, 'pct' => 33],
                    ['label' => 'Kelas XII', 'color' => 'bg-indigo-500','count' => 408, 'pct' => 33],
                ];
            @endphp
            @foreach ($levels as $l)
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full {{ $l['color'] }}"></span>
                    <span class="text-sm text-gray-600">{{ $l['label'] }}</span>
                </div>
                <div class="flex items-center gap-2 text-sm">
                    <span class="font-semibold text-gray-800">{{ $l['count'] }}</span>
                    <span class="text-gray-400 text-xs">{{ $l['pct'] }}%</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- ============================================================ --}}
{{-- RECENT ACTIVITY TABLE                                         --}}
{{-- ============================================================ --}}
<div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
        <div>
            <h2 class="text-base font-semibold text-gray-800">Aktivitas Terbaru</h2>
            <p class="text-xs text-gray-400 mt-0.5">Log aktivitas sistem hari ini</p>
        </div>
        <a href="#" class="text-sm text-blue-600 hover:text-blue-700 font-medium transition-colors">
            Lihat semua →
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Waktu</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Pengguna</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Target</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @php
                    $activities = [
                        ['time'=>'23:35','user'=>'Admin Utama',   'action'=>'Tambah Siswa','target'=>'Ahmad Fauzi — XII IPA 1',  'status'=>'success'],
                        ['time'=>'22:10','user'=>'Operator 1',    'action'=>'Edit Data',   'target'=>'Siti Rahma — XI IPS 2',    'status'=>'success'],
                        ['time'=>'21:58','user'=>'Admin Utama',   'action'=>'Hapus User',  'target'=>'user.lama@school.id',      'status'=>'danger'],
                        ['time'=>'20:30','user'=>'Operator 2',    'action'=>'Tambah Guru', 'target'=>'Budi Santoso — Mat Fisika','status'=>'success'],
                        ['time'=>'19:12','user'=>'Admin Utama',   'action'=>'Export Data', 'target'=>'Data Siswa Kelas X (PDF)', 'status'=>'info'],
                        ['time'=>'18:05','user'=>'Operator 1',    'action'=>'Import Data', 'target'=>'58 record siswa baru',     'status'=>'warning'],
                    ];
                    $badge = [
                        'success' => 'bg-emerald-50 text-emerald-700',
                        'danger'  => 'bg-red-50 text-red-700',
                        'info'    => 'bg-blue-50 text-blue-700',
                        'warning' => 'bg-amber-50 text-amber-700',
                    ];
                    $label = [
                        'success' => 'Berhasil',
                        'danger'  => 'Dihapus',
                        'info'    => 'Info',
                        'warning' => 'Proses',
                    ];
                @endphp

                @foreach ($activities as $act)
                <tr class="hover:bg-gray-50/70 transition-colors">
                    <td class="px-5 py-3.5 text-gray-400 font-mono text-xs whitespace-nowrap">{{ $act['time'] }}</td>
                    <td class="px-5 py-3.5">
                        <div class="flex items-center gap-2.5">
                            <img class="w-6 h-6 rounded-full flex-shrink-0"
                                 src="https://ui-avatars.com/api/?name={{ urlencode($act['user']) }}&background=dbeafe&color=2563eb&size=32"
                                 alt="{{ $act['user'] }}">
                            <span class="font-medium text-gray-700">{{ $act['user'] }}</span>
                        </div>
                    </td>
                    <td class="px-5 py-3.5 font-medium text-gray-800">{{ $act['action'] }}</td>
                    <td class="px-5 py-3.5 text-gray-500 max-w-xs truncate">{{ $act['target'] }}</td>
                    <td class="px-5 py-3.5">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badge[$act['status']] }}">
                            {{ $label[$act['status']] }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="px-5 py-3 border-t border-gray-100 bg-gray-50/50">
        <p class="text-xs text-gray-400">Menampilkan 6 dari 48 aktivitas hari ini</p>
    </div>
</div>

@endsection
