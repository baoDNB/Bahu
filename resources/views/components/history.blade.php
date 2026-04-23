<x-layout title="Lịch sử liên kết">
    <div class="max-w-5xl mx-auto space-y-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-secondary">Lịch sử click</h1>
                <p class="text-sm opacity-70">Mã link: <span class="badge badge-outline font-mono">{{ $url->short_code }}</span></p>
            </div>
            <a href="{{ route('links') }}" class="btn btn-outline btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Quay lại danh sách
            </a>
        </div>

        <div class="stats shadow w-full bg-base-100">
            <div class="stat">
                <div class="stat-title">Tổng lượt click</div>
                <div class="stat-value text-primary">{{ $url->visits }}</div>
                <div class="stat-desc">Tính từ ngày tạo: {{ $url->created_at->format('d/m/Y') }}</div>
            </div>
            
            <div class="stat">
                <div class="stat-title">Nguồn chủ yếu</div>
                <div class="stat-value text-secondary text-2xl">
                    {{ $url->histories->groupBy('platform')->map->count()->sortDesc()->keys()->first() ?? 'N/A' }}
                </div>
                <div class="stat-desc">Dựa trên dữ liệu đã lưu</div>
            </div>
        </div>

        <div class="card bg-base-100 shadow-xl">
            <div class="card-body p-0 md:p-6">
                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead class="bg-base-200">
                            <tr>
                                <th>Thời gian</th>
                                <th>Nền tảng (Source)</th>
                                <th>Địa chỉ IP</th>
                                <th>Thiết bị / Trình duyệt</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($url->histories as $history)
                                <tr>
                                    <td class="whitespace-nowrap font-medium">
                                        {{ $history->created_at->format('H:i:s d/m/Y') }}
                                    </td>
                                    <td>
                                        @php
                                            $badgeClass = match($history->platform) {
                                                'facebook' => 'badge-info',
                                                'zalo' => 'badge-primary',
                                                'tiktok' => 'badge-secondary',
                                                'direct' => 'badge-ghost',
                                                default => 'badge-outline'
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }} font-semibold italic">
                                            {{ ucfirst($history->platform) }}
                                        </span>
                                    </td>
                                    <td class="font-mono text-xs">{{ $history->ip_address }}</td>
                                    <td class="text-xs opacity-60">
                                        <div class="max-w-xs truncate" title="{{ $history->user_agent }}">
                                            {{ $history->user_agent }}
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-10 opacity-50 italic">
                                        Chưa có lượt click chi tiết nào được ghi nhận.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layout>