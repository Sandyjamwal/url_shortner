<div class="container" style="max-width: 450px; margin-top: 60px;">
    <h3 class="mb-4">Complete Registration</h3>

    <form method="POST" action="{{ route('invitation.store', $invitation->token) }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" value="{{ $invitation->name }}" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" value="{{ $invitation->email }}" readonly>
        </div>

        @if(!$invitation->company_id)
            <div class="mb-3">
                <label class="form-label">Company Name</label>
                <input type="text" name="company_name"
                       class="form-control @error('company_name') is-invalid @enderror"
                       value="{{ old('company_name') }}">
                @error('company_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        @endif

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password"
                   class="form-control @error('password') is-invalid @enderror">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary w-100">Register</button>
    </form>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
</div>