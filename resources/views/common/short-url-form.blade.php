@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('short-urls.store') }}">
    @csrf
    <input type="url" name="original_url" class="form-control mb-2"
           placeholder="please enter original url" value="">
    @error('original_url') <div class="text-danger">{{ $message }}</div> @enderror
    <button class="btn btn-primary">Genrate Url</button>
</form>