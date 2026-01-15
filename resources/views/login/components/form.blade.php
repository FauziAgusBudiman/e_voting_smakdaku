<h4 class="text-center mb-4">Masuk E-Voting</h4>
                    
<form method="POST" action="{{ route('authenticate') }}">
    @csrf
    <div class="mb-4">
        <label for="email" class="form-label">Email</label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="fas fa-envelope text-secondary"></i>
            </span>
            <input type="email" name="email" class="form-control" id="email" placeholder="Masukan email" value="{{ old('email') }}" required>
        </div>
    </div>
    <div class="mb-4">
        <label for="nisn" class="form-label">NISN</label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="fas fa-id-card text-secondary"></i>
            </span>
            <input type="text"
                   name="nisn"
                   class="form-control @error('nisn') is-invalid @enderror"
                   id="nisn"
                   placeholder="Masukkan NISN"
                   value="{{ old('nisn') }}"
                   required>
        </div>
        @error('nisn')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="mb-4">
        <label for="password" class="form-label">Password</label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="fas fa-lock text-secondary"></i>
            </span>
            <input type="password" name="password" class="form-control" id="password" placeholder="Masukan password" required>
        </div>
    </div>
    
    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-sign-in-alt me-2"></i> Masuk
        </button>
        <a href="/" class="block text-center mt-6 text-xs font-bold text-slate-500 hover:text-accent font-black transition-colors ">
                    Kembali ke Beranda
        </a>
    </div>
    
    <hr class="my-4">
    
    <div class="text-center display:hidden>
        <p>Bermasalah Login? Hubungi Panitia.</p>
    </div>
</form>


