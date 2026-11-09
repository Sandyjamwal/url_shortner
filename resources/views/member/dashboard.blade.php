<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Member Dashboard') }}
        </h2>
    </x-slot>
    <div class="container mt-5">
        <div>
            @include('common.short-url-form')
        </div>
        <div>
            <h3 class="mb-0 fw-bold mt-5">Genrated Urls</h3>
                <table class="table mt-4">
                <tr>
                    <th>#</th>
                    <th>Orignal</th>
                    <th>Short Url</th>
                </tr>
                @forelse($shortUrl as $url)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $url->original_url }}</td>
                        <td> <a href="{{ route('short.redirect', $url->short_url) }}" target="_blank">
                                {{ route('short.redirect', $url->short_url) }}
                            </a>
                        </td>
                    </tr>
                 @empty
                    <tr>
                        <td colspan="3" class="text-center">No Data Found</td>
                    </tr>
                @endforelse
            </table>
        </div>
    </div>
</x-app-layout>