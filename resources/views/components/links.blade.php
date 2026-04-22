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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($urls as $url)
                                    <tr>
                                        <td>
                                            <a href="{{ url($url->short_code) }}" target="_blank" class="link link-primary font-mono">
                                                {{ url($url->short_code) }}
                                            </a>
                                        </td>
                                        <td class="max-w-[420px] truncate" title="{{ $url->original_url }}">
                                            {{ $url->original_url }}
                                        </td>
                                        <td class="text-right font-semibold">{{ $url->visits }}</td>
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