@extends('layouts.app')
@section('title', 'Log Aktivitas')
@section('page-title', 'Log Aktivitas')

@section('content')

{{-- Filter --}}
<div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4 mb-6">
    <div class="flex flex-col sm:flex-row gap-3">
        <div class="relative flex-1">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </span>
            <input type="text" placeholder="Cari aktivitas atau pengguna..."
                   class="w-full pl-10 pr-4 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
        </div>
        <select class="py-2.5 px-3 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 appearance-none sm:w-40">
            <option>Semua Tipe</option><option>Create</option><option>Update</option><option>Delete</option><option>Login</option><option>Export</option>
        </select>
        <input type="date" value="{{ date('Y-m-d') }}"
               class="py-2.5 px-3 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 appearance-none sm:w-44">
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Timeline --}}
    <div class="lg:col-span-1 bg-white rounded-xl border border-gray-100 shadow-sm p-5">
        <h2 class="text-sm font-semibold text-gray-700 mb-5">Timeline Hari Ini</h2>
        @php
            $timeline = [
                ['time'=>'23:35','label'=>'Tambah Siswa',  'user'=>'Admin',    'color'=>'bg-emerald-500'],
                ['time'=>'22:10','label'=>'Edit Data Guru', 'user'=>'Operator', 'color'=>'bg-blue-500'],
                ['time'=>'21:58','label'=>'Hapus User',     'user'=>'Admin',    'color'=>'bg-red-500'],
                ['time'=>'20:30','label'=>'Export PDF',      'user'=>'Admin',    'color'=>'bg-purple-500'],
                ['time'=>'19:12','label'=>'Login',           'user'=>'Operator', 'color'=>'bg-gray-400'],
                ['time'=>'18:05','label'=>'Import Siswa',    'user'=>'Operator', 'color'=>'bg-amber-500'],
                ['time'=>'16:00','label'=>'Update Setting',  'user'=>'Admin',    'color'=>'bg-indigo-500'],
            ];
        @endphp
        <div class="relative">
            <div class="absolute left-3.5 top-0 bottom-0 w-px bg-gray-100"></div>
            <div class="space-y-5">
                @foreach ($timeline as $t)
                <div class="flex items-start gap-4 relative">
                    <div class="w-7 h-7 rounded-full {{ $t['color'] }} flex-shrink-0 flex items-center justify-center relative z-10">
                        <span class="w-2 h-2 bg-white rounded-full"></span>
                    </div>
                    <div class="min-w-0 flex-1 pt-0.5">
                        <p class="text-sm font-semibold text-gray-800">{{ $t['label'] }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $t['user'] }} · {{ $t['time'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="lg:col-span-2 bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-5 py-4 border-b border-gray-100">
            <h2 class="text-sm font-semibold text-gray-700">Detail Aktivitas</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Waktu</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Pengguna</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tipe</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Deskripsi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-xs">
                    @php
                        $activities = [
                            ['time'=>'2026-03-20 23:35','user'=>'Admin Utama',  'type'=>'Create','desc'=>'Menambahkan siswa baru: Ahmad Fauzi (XII IPA 1)',    'type_color'=>'bg-emerald-100 text-emerald-700'],
                            ['time'=>'2026-03-20 22:10','user'=>'Operator 1',   'type'=>'Update','desc'=>'Mengubah data guru: Dra. Sri Wahyuni (No. HP)',       'type_color'=>'bg-blue-100 text-blue-700'],
                            ['time'=>'2026-03-20 21:58','user'=>'Admin Utama',  'type'=>'Delete','desc'=>'Menghapus user: user.lama@datacenter.id',              'type_color'=>'bg-red-100 text-red-600'],
                            ['time'=>'2026-03-20 20:30','user'=>'Admin Utama',  'type'=>'Export','desc'=>'Export PDF data siswa kelas X (58 records)',           'type_color'=>'bg-purple-100 text-purple-700'],
                            ['time'=>'2026-03-20 19:12','user'=>'Operator 2',   'type'=>'Login', 'desc'=>'Login berhasil dari IP 192.168.1.10',                  'type_color'=>'bg-gray-100 text-gray-600'],
                            ['time'=>'2026-03-20 18:05','user'=>'Operator 1',   'type'=>'Import','desc'=>'Import 58 data siswa dari file Excel',                 'type_color'=>'bg-amber-100 text-amber-700'],
                            ['time'=>'2026-03-20 16:00','user'=>'Admin Utama',  'type'=>'Update','desc'=>'Mengubah pengaturan: Nama Aplikasi',                   'type_color'=>'bg-blue-100 text-blue-700'],
                            ['time'=>'2026-03-20 14:30','user'=>'Admin Utama',  'type'=>'Create','desc'=>'Membuat role baru: Kepala Sekolah',                    'type_color'=>'bg-emerald-100 text-emerald-700'],
                        ];
                    @endphp
                    @foreach ($activities as $act)
                    <tr class="hover:bg-gray-50/70 transition-colors">
                        <td class="px-5 py-3.5 text-gray-400 font-mono whitespace-nowrap">{{ $act['time'] }}</td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-2">
                                <img class="w-6 h-6 rounded-full flex-shrink-0"
                                     src="https://ui-avatars.com/api/?name={{ urlencode($act['user']) }}&background=d1fae5&color=065f46&size=24" alt="">
                                <span class="font-medium text-gray-700">{{ $act['user'] }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-3.5">
                            <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold {{ $act['type_color'] }}">
                                {{ $act['type'] }}
                            </span>
                        </td>
                        <td class="px-5 py-3.5 text-gray-600 max-w-xs">{{ $act['desc'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-5 py-4 border-t border-gray-100 flex items-center justify-between">
            <p class="text-xs text-gray-400">Menampilkan 8 dari 48 aktivitas</p>
            <div class="flex items-center gap-1">
                <button class="px-3 py-1.5 text-xs font-medium text-gray-500 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">‹</button>
                <button class="px-3 py-1.5 text-xs font-semibold text-white bg-emerald-600 rounded-lg">1</button>
                <button class="px-3 py-1.5 text-xs font-medium text-gray-500 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">2</button>
                <button class="px-3 py-1.5 text-xs font-medium text-gray-500 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">›</button>
            </div>
        </div>
    </div>
</div>

@endsection
