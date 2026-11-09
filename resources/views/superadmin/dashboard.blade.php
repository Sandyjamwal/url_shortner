<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="container mt-5">
        <div class="heading d-flex justify-content-between align-items-center">
         <h3 class="mb-0 fw-bold">Clients</h3>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#invite_clients">Invite</button>
        </div>
        <div class="list mt-2">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($invitations as $invitation)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $invitation->name }}</td>
                        <td>{{ $invitation->email }}</td>
                        <td>
                            @if($invitation->accepted_at)
                                <span class="badge bg-success">Accepted</span>
                            @elseif($invitation->expires_at->isPast())
                                <span class="badge bg-secondary">Expired</span>
                            @else
                                <span class="badge bg-warning text-dark">Pending</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No Data Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        </div>
        <div>
            <h3 class="mb-0 fw-bold">Genrated Urls</h3>
            <table class="table mt-4">
            <tr>
                <th>#</th>
                <th>Orignal</th>
                <th>Short Url</th>
                <th>User</th>
                <th>Company</th>
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
                    <td>{{ $url->company->name }}</td>
                </tr>
            @empty
                    <tr>
                        <td colspan="5" class="text-center">No Data Found</td>
                    </tr>
            @endforelse
        </table>
        </div>
    </div>

    {{-- invite clients modal --}}
    <!-- Modal -->
    <div class="modal fade" id="invite_clients" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="invite_clients" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="invite_clients">Invite New Clients</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form method="POST" action="{{ route('invitations.store') }}">
                 @csrf
                 <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name ='email' required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Invite</button>
                </form>
            </div>
            </div>
        </div>
    </div>
    @if($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new bootstrap.Modal(document.getElementById('invite_clients')).show();
        });
    </script>
    @endif
</x-app-layout>
