@extends('layouts.app')
@section('title', 'API Monitoring')
@section('page-title', 'API Monitoring')

@section('content')

{{-- Stats row --}}
@php
    $apiStats = [
        ['label'=>'Total Request',  'val'=>'14,892', 'sub'=>'Hari ini',  'icon_color'=>'bg-blue-50 text-blue-600'],
        ['label'=>'Success (2xx)',  'val'=>'14,205', 'sub'=>'95.4%',     'icon_color'=>'bg-emerald-50 text-emerald-600'],
        ['label'=>'Error (4xx/5xx)','val'=>'687',    'sub'=>'4.6%',      'icon_color'=>'bg-red-50 text-red-600'],
        ['label'=>'Avg. Response',  'val'=>'142ms',  'sub'=>'Latency',   'icon_color'=>'bg-amber-50 text-amber-600'],
    ];
@endphp
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    @foreach ($apiStats as $s)
    <div class="bg-white rounded-xl border border-gray-100 p-4 shadow-sm">
        <p class="text-xs font-medium text-gray-500">{{ $s['label'] }}</p>
        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $s['val'] }}</p>
        <p class="text-xs text-gray-400 mt-1">{{ $s['sub'] }}</p>
    </div>
    @endforeach
</div>

{{-- Filter --}}
<div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4 mb-5">
    <div class="flex flex-col sm:flex-row gap-3">
        <div class="relative flex-1">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </span>
            <input type="text" placeholder="Filter endpoint..."
                   class="w-full pl-10 pr-4 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
        </div>
        <select class="py-2.5 px-3 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 appearance-none sm:w-36">
            <option>Semua Method</option><option>GET</option><option>POST</option><option>PUT</option><option>DELETE</option>
        </select>
        <select class="py-2.5 px-3 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 appearance-none sm:w-36">
            <option>Semua Status</option><option>200</option><option>201</option><option>400</option><option>404</option><option>500</option>
        </select>
        <button class="px-4 py-2.5 text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
            </svg>
            Export
        </button>
    </div>
</div>

{{-- Log Table --}}
<div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
        <h2 class="text-sm font-semibold text-gray-700">Log Request API</h2>
        <span class="text-xs text-gray-400">Real-time • Auto refresh 30s</span>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Timestamp</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Method</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Endpoint</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">IP</th>
                    <th class="px-5 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-5 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Resp. Time</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 font-mono text-xs">
                @php
                    $logs = [
                        ['time'=>'04:02:11','method'=>'GET',   'endpoint'=>'/api/v1/students',          'ip'=>'192.168.1.5', 'status'=>200,'ms'=>98],
                        ['time'=>'04:02:08','method'=>'POST',  'endpoint'=>'/api/v1/students',          'ip'=>'192.168.1.5', 'status'=>201,'ms'=>213],
                        ['time'=>'04:01:55','method'=>'GET',   'endpoint'=>'/api/v1/teachers',          'ip'=>'10.0.0.12',   'status'=>200,'ms'=>76],
                        ['time'=>'04:01:43','method'=>'PUT',   'endpoint'=>'/api/v1/students/42',       'ip'=>'192.168.1.5', 'status'=>200,'ms'=>145],
                        ['time'=>'04:01:30','method'=>'DELETE','endpoint'=>'/api/v1/users/8',           'ip'=>'192.168.1.2', 'status'=>403,'ms'=>34],
                        ['time'=>'04:01:10','method'=>'POST',  'endpoint'=>'/api/v1/auth/login',        'ip'=>'203.0.113.5', 'status'=>401,'ms'=>55],
                        ['time'=>'04:00:58','method'=>'GET',   'endpoint'=>'/api/v1/roles',             'ip'=>'10.0.0.12',   'status'=>200,'ms'=>88],
                        ['time'=>'04:00:45','method'=>'GET',   'endpoint'=>'/api/v1/students?page=2',   'ip'=>'192.168.1.5', 'status'=>500,'ms'=>1205],
                        ['time'=>'04:00:30','method'=>'POST',  'endpoint'=>'/api/v1/teachers',          'ip'=>'192.168.1.5', 'status'=>422,'ms'=>67],
                        ['time'=>'04:00:12','method'=>'GET',   'endpoint'=>'/api/v1/dashboard/stats',   'ip'=>'10.0.0.1',    'status'=>200,'ms'=>102],
                    ];
                    $methodColor = ['GET'=>'bg-blue-100 text-blue-700','POST'=>'bg-emerald-100 text-emerald-700','PUT'=>'bg-amber-100 text-amber-700','DELETE'=>'bg-red-100 text-red-700'];
                    $statusColor = fn($s) => $s<300 ? 'bg-emerald-50 text-emerald-700' : ($s<500 ? 'bg-amber-50 text-amber-700' : 'bg-red-50 text-red-700');
                @endphp
                @foreach ($logs as $log)
                <tr class="hover:bg-gray-50/70 transition-colors">
                    <td class="px-5 py-3.5 text-gray-400">{{ $log['time'] }}</td>
                    <td class="px-5 py-3.5">
                        <span class="inline-flex px-2 py-0.5 rounded text-xs font-bold {{ $methodColor[$log['method']] ?? 'bg-gray-100 text-gray-600' }}">
                            {{ $log['method'] }}
                        </span>
                    </td>
                    <td class="px-5 py-3.5 text-gray-600">{{ $log['endpoint'] }}</td>
                    <td class="px-5 py-3.5 text-gray-400">{{ $log['ip'] }}</td>
                    <td class="px-5 py-3.5 text-center">
                        <span class="inline-flex px-2 py-0.5 rounded text-xs font-bold {{ $statusColor($log['status']) }}">
                            {{ $log['status'] }}
                        </span>
                    </td>
                    <td class="px-5 py-3.5 text-right {{ $log['ms']>500 ? 'text-red-500 font-semibold' : 'text-gray-500' }}">
                        {{ $log['ms'] }}ms
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="px-5 py-4 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-3">
        <p class="text-xs text-gray-400">Menampilkan 10 dari 14,892 log hari ini</p>
        <div class="flex items-center gap-1">
            <button class="px-3 py-1.5 text-xs font-medium text-gray-500 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">‹</button>
            <button class="px-3 py-1.5 text-xs font-semibold text-white bg-emerald-600 rounded-lg">1</button>
            <button class="px-3 py-1.5 text-xs font-medium text-gray-500 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">2</button>
            <button class="px-3 py-1.5 text-xs font-medium text-gray-500 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">›</button>
        </div>
    </div>
</div>

@endsection
