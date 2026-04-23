<x-layout title="Liên kết của tôi">
    <div class="max-w-5xl mx-auto space-y-6">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <h1 class="card-title">Liên kết của tôi</h1>
                <p class="text-sm opacity-70">Danh sách link bạn đã tạo và số lượt click.</p>

                @if($urls->isEmpty())
                    <div class="alert alert-info mt-4">
                        Bạn chưa có liên kết nào. Tạo mới trên trang Home.
                    </div>
                @else
                    <div class="overflow-x-auto mt-4">
                        <table class="table table-zebra w-full">
                            <thead>
                                <tr>
                                    <th>Short URL</th>
                                    <th>URL gốc</th>
                                    <th class="text-right">Lượt click</th>
                                    <th class="text-center">Lịch sử</th> </tr>
                            </thead>
                            <tbody>
                                @foreach($urls as $url)
                                    <tr>
                                        <td>
                                            <a href="{{ url($url->short_code) }}" target="_blank" class="link link-primary font-mono">
                                                {{ url($url->short_code) }}
                                            </a>
                                        </td>
                                        <td class="max-w-[300px] truncate" title="{{ $url->original_url }}">
                                            {{ $url->original_url }}
                                        </td>
                                        <td class="text-right font-semibold">{{ $url->visits }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('urls.history', $url->id) }}" class="btn btn-ghost btn-xs text-info">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Xem chi tiết
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>