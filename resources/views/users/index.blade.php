@extends('layouts.app')
@section('title', 'Manajemen User')
@section('page-title', 'Manajemen User')

@section('content')

<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h2 class="text-xl font-bold text-gray-800">Manajemen User</h2>
        <p class="text-sm text-gray-500 mt-0.5">Kelola akun pengguna dan hak akses sistem</p>
    </div>
    <button onclick="openModal('modal-tambah-user')"
            class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl shadow-sm transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
        </svg>
        Tambah User
    </button>
</div>

{{-- Search --}}
<div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4 mb-5">
    <div class="flex flex-col sm:flex-row gap-3">
        <div class="relative flex-1">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </span>
            <input type="text" placeholder="Cari nama atau email user..."
                   class="w-full pl-10 pr-4 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
        </div>
        <select class="py-2.5 px-3 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 appearance-none sm:w-40">
            <option value="">Semua Role</option>
            <option>Superadmin</option>
            <option>Admin</option>
            <option>Operator</option>
            <option>Viewer</option>
        </select>
        <select class="py-2.5 px-3 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 appearance-none sm:w-36">
            <option value="">Semua Status</option>
            <option>Aktif</option>
            <option>Non-Aktif</option>
        </select>
    </div>
</div>

{{-- Table --}}
<div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="px-5 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">#</th>
                    <th class="px-5 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Pengguna</th>
                    <th class="px-5 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-5 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Role</th>
                    <th class="px-5 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Terakhir Login</th>
                    <th class="px-5 py-3.5 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-5 py-3.5 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @php
                    $users = [
                        ['no'=>1,'nama'=>'Admin Utama',    'email'=>'admin@datacenter.id',    'role'=>'Superadmin','login'=>'Baru saja',    'aktif'=>true,  'role_color'=>'bg-purple-100 text-purple-700'],
                        ['no'=>2,'nama'=>'Operator Satu',  'email'=>'op1@datacenter.id',      'role'=>'Operator',  'login'=>'2 jam lalu',   'aktif'=>true,  'role_color'=>'bg-blue-100 text-blue-700'],
                        ['no'=>3,'nama'=>'Operator Dua',   'email'=>'op2@datacenter.id',      'role'=>'Operator',  'login'=>'1 hari lalu',  'aktif'=>true,  'role_color'=>'bg-blue-100 text-blue-700'],
                        ['no'=>4,'nama'=>'Viewer Data',    'email'=>'viewer@datacenter.id',   'role'=>'Viewer',    'login'=>'3 hari lalu',  'aktif'=>false, 'role_color'=>'bg-gray-100 text-gray-600'],
                        ['no'=>5,'nama'=>'Admin Backup',   'email'=>'admin2@datacenter.id',   'role'=>'Admin',     'login'=>'5 hari lalu',  'aktif'=>true,  'role_color'=>'bg-emerald-100 text-emerald-700'],
                    ];
                @endphp
                @foreach ($users as $u)
                <tr class="hover:bg-gray-50/70 transition-colors">
                    <td class="px-5 py-4 text-gray-400 text-xs">{{ $u['no'] }}</td>
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-3">
                            <img class="w-8 h-8 rounded-full flex-shrink-0"
                                 src="https://ui-avatars.com/api/?name={{ urlencode($u['nama']) }}&background=f3e8ff&color=7e22ce&size=32" alt="">
                            <span class="font-semibold text-gray-800">{{ $u['nama'] }}</span>
                        </div>
                    </td>
                    <td class="px-5 py-4 text-gray-500 text-xs">{{ $u['email'] }}</td>
                    <td class="px-5 py-4">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold {{ $u['role_color'] }}">
                            {{ $u['role'] }}
                        </span>
                    </td>
                    <td class="px-5 py-4 text-gray-400 text-xs">{{ $u['login'] }}</td>
                    <td class="px-5 py-4 text-center">
                        {{-- Toggle Switch --}}
                        <button class="relative inline-flex h-5 w-9 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none
                                       {{ $u['aktif'] ? 'bg-emerald-500' : 'bg-gray-200' }}"
                                onclick="this.classList.toggle('bg-emerald-500'); this.classList.toggle('bg-gray-200'); this.querySelector('span').classList.toggle('translate-x-4'); this.querySelector('span').classList.toggle('translate-x-0');">
                            <span class="pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out
                                         {{ $u['aktif'] ? 'translate-x-4' : 'translate-x-0' }}"></span>
                        </button>
                    </td>
                    <td class="px-5 py-4">
                        <div class="flex items-center justify-center gap-1.5">
                            <button onclick="openModal('modal-edit-user')"
                                    class="p-2 rounded-lg text-blue-600 hover:bg-blue-50 transition-colors" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </button>
                            <button class="p-2 rounded-lg text-red-500 hover:bg-red-50 transition-colors" title="Hapus">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="px-5 py-4 border-t border-gray-100">
        <p class="text-xs text-gray-400">Total 5 pengguna terdaftar</p>
    </div>
</div>

{{-- Modal Tambah User --}}
<x-modal id="modal-tambah-user" title="Tambah User Baru">
    <form class="space-y-4">
        <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
        <input type="text" placeholder="Masukkan nama" class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 transition-all"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Email <span class="text-red-500">*</span></label>
        <input type="email" placeholder="email@datacenter.id" class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 transition-all"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Password <span class="text-red-500">*</span></label>
        <input type="password" placeholder="Min. 8 karakter" class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 transition-all"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Role <span class="text-red-500">*</span></label>
        <select class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 transition-all appearance-none">
            <option value="">Pilih Role</option>
            <option>Superadmin</option><option>Admin</option><option>Operator</option><option>Viewer</option>
        </select></div>
    </form>
    <x-slot name="footer">
        <button onclick="closeModal('modal-tambah-user')" class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors">Batal</button>
        <button class="px-4 py-2 text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl transition-colors">Buat User</button>
    </x-slot>
</x-modal>

<x-modal id="modal-edit-user" title="Edit User">
    <form class="space-y-4">
        <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap</label>
        <input type="text" value="Admin Utama" class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 transition-all"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
        <input type="email" value="admin@datacenter.id" class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 transition-all"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Role</label>
        <select class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 transition-all appearance-none">
            <option selected>Superadmin</option><option>Admin</option><option>Operator</option><option>Viewer</option>
        </select></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Password Baru <span class="text-gray-400 text-xs">(kosongkan jika tidak diubah)</span></label>
        <input type="password" placeholder="••••••••" class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 transition-all"></div>
    </form>
    <x-slot name="footer">
        <button onclick="closeModal('modal-edit-user')" class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors">Batal</button>
        <button class="px-4 py-2 text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl transition-colors">Simpan</button>
    </x-slot>
</x-modal>

@endsection
