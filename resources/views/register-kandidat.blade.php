<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Kandidat | SMAKDAKU</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { background-color: #1A252F; color: #ECF0F1; }
        .form-input { 
            background: #2C3E50; 
            border: 1px solid rgba(255,255,255,0.1);
            color: white;
        }
        .form-input:focus {
            border-color: #E74C3C;
            outline: none;
            ring: 2px;
            ring-color: #E74C3C;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center py-12 px-4">

    <div class="mb-10 text-center">
        <img src="{{ Vite::asset('resources/assets/images/logo1.png') }}" alt="Logo" class="w-16 h-16 mx-auto mb-4 bg-white p-2 rounded-full shadow-lg">
        <h1 class="text-3xl font-black uppercase tracking-tighter italic">Form <span class="text-[#E74C3C]">Kandidat</span></h1>
        <p class="text-slate-400 text-sm uppercase tracking-widest mt-2">Periode Kepengurusan 2026/2027</p>
    </div>

    <div class="max-w-2xl w-full bg-[#2C3E50] shadow-2xl rounded-sm border-t-4 border-[#E74C3C] p-8 md:p-12">
        
        @if(session('success'))
            <div class="bg-green-500/20 border border-green-500 text-green-400 p-4 mb-6 text-sm font-bold">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('register.kandidat.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Nama Lengkap</label>
                <input type="text" name="nama" class="w-full form-input px-4 py-3 rounded-sm" placeholder="Masukkan nama sesuai raport" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Kelas</label>
                    <select name="kelas" class="w-full form-input px-4 py-3 rounded-sm appearance-none" required>
                        <option value="">Pilih Kelas</option>
                        <option>XI IPA</option>
                        <option>XI IPS</option>
                        <option>XII IPA</option>
                        <option>XII IPS</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Foto Formal (JPG/PNG)</label>
                    <input type="file" name="foto" class="w-full text-xs text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-sm file:border-0 file:text-xs file:font-black file:bg-[#E74C3C] file:text-white hover:file:bg-[#c0392b] cursor-pointer" required>
                </div>
            </div>

            <div class="p-4 bg-darker/50 border border-dashed border-white/10 rounded-sm">
                <label class="block text-xs font-black uppercase tracking-widest text-[#E74C3C] mb-2">Bukti Pengalaman OSIS (PDF/JPG)</label>
                <p class="text-[10px] text-slate-500 mb-3 uppercase italic">*Wajib lampirkan sertifikat atau surat keterangan pengurus 1 periode.</p>
                <input type="file" name="bukti_organisasi" class="w-full text-xs text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-sm file:border-0 file:text-xs file:font-black file:bg-slate-700 file:text-white cursor-pointer" required>
            </div>

            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Visi</label>
                <textarea name="visi" rows="3" class="w-full form-input px-4 py-3 rounded-sm resize-none" placeholder="Apa tujuan besar Anda?" required></textarea>
            </div>

            <div>
    <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Misi</label>
    <textarea 
        name="misi" 
        rows="4" 
        class="w-full form-input px-4 py-3 rounded-sm resize-none focus:ring-2 focus:ring-blue-500" 
        placeholder="Langkah konkrit apa yang akan Anda ambil? (Gunakan poin-poin)" 
        oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"
        required></textarea>
</div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-[#E74C3C] hover:bg-[#c0392b] text-white py-4 rounded-sm font-black text-sm tracking-[0.3em] uppercase transition-all shadow-xl flex items-center justify-center gap-3">
                    KIRIM PENDAFTARAN
                    <i data-lucide="send" class="w-4 h-4"></i>
                </button>
                <a href="/" class="block text-center mt-6 text-xs font-bold text-slate-500 hover:text-white transition-colors uppercase tracking-widest">
                    &larr; Kembali ke Beranda
                </a>
            </div>
        </form>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>