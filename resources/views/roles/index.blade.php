@extends('layouts.app')
@section('title', 'Role & Permission')
@section('page-title', 'Role & Permission')

@section('content')

<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h2 class="text-xl font-bold text-gray-800">Role & Permission</h2>
        <p class="text-sm text-gray-500 mt-0.5">Kelola hak akses per role dalam sistem</p>
    </div>
    <button onclick="openModal('modal-tambah-role')"
            class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl shadow-sm transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Role
    </button>
</div>

{{-- Permission Matrix --}}
@php
    $roles = [
        ['name' => 'Superadmin', 'color' => 'bg-purple-100 text-purple-800',  'users' => 1,  'perms' => ['siswa'=>[1,1,1,1], 'guru'=>[1,1,1,1], 'user'=>[1,1,1,1], 'role'=>[1,1,1,1], 'report'=>[1,1,1,1]]],
        ['name' => 'Admin',      'color' => 'bg-emerald-100 text-emerald-800','users' => 2,  'perms' => ['siswa'=>[1,1,1,1], 'guru'=>[1,1,1,1], 'user'=>[1,1,0,0], 'role'=>[0,1,0,0], 'report'=>[1,1,0,0]]],
        ['name' => 'Operator',   'color' => 'bg-blue-100 text-blue-800',      'users' => 6,  'perms' => ['siswa'=>[1,1,1,0], 'guru'=>[1,1,1,0], 'user'=>[0,1,0,0], 'role'=>[0,1,0,0], 'report'=>[0,1,0,0]]],
        ['name' => 'Viewer',     'color' => 'bg-gray-100 text-gray-700',      'users' => 3,  'perms' => ['siswa'=>[0,1,0,0], 'guru'=>[0,1,0,0], 'user'=>[0,0,0,0], 'role'=>[0,0,0,0], 'report'=>[0,1,0,0]]],
    ];
    $modules = ['siswa' => 'Data Siswa', 'guru' => 'Data Guru', 'user' => 'User', 'role' => 'Role', 'report' => 'Report'];
    $crudLabels = ['C', 'R', 'U', 'D'];
@endphp

{{-- Cards per role --}}
<div class="space-y-5">
    @foreach ($roles as $role)
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        {{-- Role Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 px-6 py-4 bg-gray-50 border-b border-gray-100">
            <div class="flex items-center gap-3">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $role['color'] }}">
                    {{ $role['name'] }}
                </span>
                <span class="text-xs text-gray-400">{{ $role['users'] }} pengguna aktif</span>
            </div>
            <div class="flex gap-2">
                <button onclick="openModal('modal-edit-role')"
                        class="px-3 py-1.5 text-xs font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors">Edit Role</button>
                @if($role['name'] !== 'Superadmin')
                <button class="px-3 py-1.5 text-xs font-medium text-red-500 bg-red-50 hover:bg-red-100 rounded-lg transition-colors">Hapus</button>
                @endif
            </div>
        </div>

        {{-- Permission Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-50">
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-40">Modul</th>
                        @foreach ($crudLabels as $crud)
                        <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider w-20">
                            @if($crud==='C') Create
                            @elseif($crud==='R') Read
                            @elseif($crud==='U') Update
                            @else Delete
                            @endif
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach ($modules as $key => $label)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-5 py-3.5 text-sm font-medium text-gray-700">{{ $label }}</td>
                        @foreach ($role['perms'][$key] as $i => $val)
                        <td class="px-4 py-3.5 text-center">
                            <input type="checkbox"
                                   class="w-4 h-4 rounded text-emerald-600 border-gray-300 focus:ring-emerald-500 cursor-pointer"
                                   {{ $val ? 'checked' : '' }}>
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Save button per card --}}
        <div class="px-6 py-3 border-t border-gray-50 flex justify-end">
            <button class="px-4 py-2 text-xs font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg transition-colors">
                Simpan Perubahan
            </button>
        </div>
    </div>
    @endforeach
</div>

{{-- Modal Tambah Role --}}
<x-modal id="modal-tambah-role" title="Tambah Role Baru">
    <form class="space-y-4">
        <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Role <span class="text-red-500">*</span></label>
        <input type="text" placeholder="Contoh: Editor, Kepala Sekolah" class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 transition-all"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi</label>
        <textarea rows="2" placeholder="Deskripsi singkat role ini..." class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 transition-all resize-none"></textarea></div>
    </form>
    <x-slot name="footer">
        <button onclick="closeModal('modal-tambah-role')" class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors">Batal</button>
        <button class="px-4 py-2 text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl transition-colors">Buat Role</button>
    </x-slot>
</x-modal>

<x-modal id="modal-edit-role" title="Edit Role">
    <form class="space-y-4">
        <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Role</label>
        <input type="text" value="Admin" class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 transition-all"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi</label>
        <textarea rows="2" class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 transition-all resize-none">Administrator dengan akses penuh kecuali manajemen role</textarea></div>
    </form>
    <x-slot name="footer">
        <button onclick="closeModal('modal-edit-role')" class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors">Batal</button>
        <button class="px-4 py-2 text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl transition-colors">Simpan</button>
    </x-slot>
</x-modal>

@endsection
