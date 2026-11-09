<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>
    <div class="container mt-5">
        <h3 class="mb-0 fw-bold">Invite Members</h3>
        <form method="POST" action="{{ route('admininvitations.store') }}">
            @csrf
            <input type="text" name="name" class="form-control mb-2" placeholder="Name" value="{{ old('name') }}">
            <input type="email" name="email" class="form-control mb-2" placeholder="Email" value="{{ old('email') }}">
            <select name="role" class="form-select mb-2">
                <option value="member">Member</option>
                <option value="admin">Admin</option>
            </select>
            @if($errors->any())
                <div class="text-danger">{{ $errors->first() }}</div>
            @endif
            <button type="submit" class="btn btn-primary">Invite</button>
        </form>

        <div class="mt-5">
            <table class="table">
                <h3 class="mb-0 fw-bold">Lis Of Members</h3>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                </tr>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->getRoleNames()->first() }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No Data Found</td>
                    </tr>
                @endforelse 
            </table>
        </div>
        <div class= 'mt-5'>
            <h3 class="mb-0 fw-bold">Genrate Url</h3>
            @include('common.short-url-form')
        </div>
        <div>
            <div class="mt-5">
                <h3 class="mb-0 fw-bold">List Of Urls</h3>
            <table class="table mt-4">
            <tr>
                <th>#</th>
                <th>Orignal</th>
                <th>Short Url</th>
                <th>User</th>
            </tr>
            @forelse($shortUrl as $url)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $url->original_url }}</td>
                    <td> <a href="{{ route('short.redirect', $url->short_url) }}" target="_blank">
                            {{ route('short.redirect', $url->short_url) }}
                        </a>
                    </td>
                    <td>{{ $url->user->name }}</td>
                </tr>
             @empty
                    <tr>
                        <td colspan="4" class="text-center">No Data Found</td>
                    </tr>
            @endforelse
        </table>
            </div>
        </div>
    </div>
</x-app-layout>
