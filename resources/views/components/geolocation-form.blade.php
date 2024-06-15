<form action="/" method="POST">
    @csrf
    <div class="form-group">
        <label for="ip">IP Address</label>
        <input type="text" id="ip" name="ip" class="form-control @error('ip') is-invalid @enderror"
            value="{{ $ipAddress ?? '' }}">
        @error('ip')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit">Get Location Info</button>
</form>
