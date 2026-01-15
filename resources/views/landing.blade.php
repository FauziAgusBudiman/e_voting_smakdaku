<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>E-Voting Ketua OSIS | Bold Edition</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        midnight: '#2C3E50',
                        darker: '#1A252F',
                        accent: '#E74C3C', // Alizarin Red
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background-color: #1A252F;
            color: #ECF0F1;
        }
        .bg-midnight-gradient {
            background: linear-gradient(135deg, #2C3E50 0%, #1A252F 100%);
        }
        .card-midnight {
            background: #2C3E50;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .selection-red::selection {
            background: #E74C3C;
            color: white;
        }
    </style>
</head>
<body class="overflow-x-hidden font-sans selection-red">

    <nav class="fixed w-full z-50 bg-[#2C3E50]/95 backdrop-blur-md border-b border-white/5 shadow-2xl">
    <div class="max-w-7xl mx-auto px-6 py-3 flex justify-between items-center">
        
        <div class="flex items-center gap-4">
            <div class="relative group">
                <div class="absolute -inset-1 bg-accent rounded-full blur opacity-25 group-hover:opacity-50 transition duration-300"></div>
                <div class="relative bg-white p-1.5 rounded-full shadow-lg">
                    <img src="{{ Vite::asset('resources/assets/images/logo1.png') }}" 
                         alt="Logo SMAKDAKU"
                         class="w-10 h-10 object-contain">
                </div>
            </div>
            
            <div class="flex flex-col">
                <h3 class="text-white text-lg md:text-xl font-black tracking-tighter leading-none mb-1 uppercase italic">
                    E-Voting <span class="text-accent">SMAKDAKU</span>
                </h3>
                <small class="text-slate-400 text-[10px] md:text-xs uppercase tracking-[0.2em] font-bold leading-none">
                    Pemilihan OSIS Digital
                </small>
            </div>
        </div>
        
        <div class="hidden md:flex items-center space-x-10">
            <a href="#kualifikasi" class="text-xs font-bold uppercase tracking-widest text-slate-300 hover:text-accent transition-colors">Kualifikasi</a>
            <a href="{{ route('login') }}"
               class="bg-accent hover:bg-[#c0392b] text-white px-8 py-2.5 rounded-sm font-black text-xs tracking-widest transition-all shadow-[0_4px_20px_rgba(231,76,60,0.4)] hover:-translate-y-0.5 active:translate-y-0">
                MASUK
            </a>
        </div>
    </div>
</nav>

    <section class="relative pt-32 pb-20 md:pt-48 md:pb-32 bg-midnight-gradient overflow-hidden">
        <div class="absolute top-0 right-0 -mt-20 -mr-20 w-96 h-96 bg-accent/10 rounded-full blur-3xl"></div>
        
        <div class="max-w-7xl mx-auto px-6 text-center relative z-10">
            <div data-aos="fade-up">
                <h1 class="text-5xl md:text-8xl font-black mb-6 leading-none uppercase italic tracking-tighter">
                    Tentukan <br> <span class="text-accent">Pemimpinmu.</span>
                </h1>
                <p class="max-w-xl mx-auto text-lg text-slate-300 mb-10 font-medium">
                    Platform pemilihan Ketua OSIS masa depan. Gunakan hak suaramu dengan bijak dan berani.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('login') }}" class="bg-accent hover:bg-[#c0392b] text-white px-12 py-5 rounded-sm font-black text-lg transition-all flex items-center justify-center gap-3 shadow-2xl group">
                        LOGIN SEKARANG
                        <i data-lucide="zap" class="fill-current group-hover:animate-pulse"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="kualifikasi" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col mb-16" data-aos="fade-up">
            <span class="text-accent font-black tracking-[0.3em] text-sm mb-2 uppercase italic">Persyaratan Calon</span>
            <h2 class="text-midnight text-4xl md:text-5xl font-black uppercase leading-none">Kualifikasi Utama</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-16">
            <div class="p-10 border-2 border-slate-100 hover:border-accent transition-all duration-300 group bg-slate-50 shadow-sm" data-aos="fade-up" data-aos-delay="100">
                <i data-lucide="history" class="text-slate-300 group-hover:text-accent w-10 h-10 mb-6 transition-colors"></i>
                <h3 class="text-midnight font-black text-xl mb-4 uppercase">Pengalaman</h3>
                <p class="text-slate-500 text-sm leading-relaxed">Wajib memiliki pengalaman aktif dalam organisasi OSIS minimal <strong>1 periode kepengurusan</strong> sebelumnya.</p>
            </div>

            <div class="p-10 border-2 border-slate-100 hover:border-accent transition-all duration-300 group bg-slate-50 shadow-sm" data-aos="fade-up" data-aos-delay="200">
                <i data-lucide="award" class="text-slate-300 group-hover:text-accent w-10 h-10 mb-6 transition-colors"></i>
                <h3 class="text-midnight font-black text-xl mb-4 uppercase">Karakter</h3>
                <p class="text-slate-500 text-sm leading-relaxed">Memiliki integritas moral yang tidak tergoyahkan dan menjadi teladan bagi siswa lainnya.</p>
            </div>

            <div class="p-10 border-2 border-slate-100 hover:border-accent transition-all duration-300 group bg-slate-50 shadow-sm" data-aos="fade-up" data-aos-delay="300">
                <i data-lucide="trending-up" class="text-slate-300 group-hover:text-accent w-10 h-10 mb-6 transition-colors"></i>
                <h3 class="text-midnight font-black text-xl mb-4 uppercase">Visi</h3>
                <p class="text-slate-500 text-sm leading-relaxed">Mampu merumuskan program kerja inovatif yang relevan dengan perkembangan zaman digital.</p>
            </div>
            
            <div class="p-10 border-2 border-slate-100 hover:border-accent transition-all duration-300 group bg-slate-50 shadow-sm" data-aos="fade-up" data-aos-delay="400">
                <i data-lucide="command" class="text-slate-300 group-hover:text-accent w-10 h-10 mb-6 transition-colors"></i>
                <h3 class="text-midnight font-black text-xl mb-4 uppercase">Kepemimpinan</h3>
                <p class="text-slate-500 text-sm leading-relaxed">Memiliki kemampuan manajerial tim dan komunikasi publik yang persuasif serta efektif.</p>
            </div>

            <div class="p-10 border-2 border-slate-100 hover:border-accent transition-all duration-300 group bg-slate-50 shadow-sm" data-aos="fade-up" data-aos-delay="500">
                <i data-lucide="graduation-cap" class="text-slate-300 group-hover:text-accent w-10 h-10 mb-6 transition-colors"></i>
                <h3 class="text-midnight font-black text-xl mb-4 uppercase">Akademik</h3>
                <p class="text-slate-500 text-sm leading-relaxed">Mempertahankan standar nilai akademik yang baik sebagai prioritas utama siswa.</p>
            </div>

            <div class="p-10 border-2 border-accent bg-accent flex flex-col justify-center items-center text-center shadow-xl transform hover:scale-105 transition-all duration-300" data-aos="fade-up" data-aos-delay="600">
                <i data-lucide="check-circle" class="text-white w-12 h-12 mb-4"></i>
                <h3 class="text-white font-black text-xl mb-2 uppercase italic">Siap Memimpin?</h3>
                <p class="text-white/90 text-xs mb-6 uppercase tracking-widest">Wujudkan perubahan nyata</p>
                <a href="{{ route('register.kandidat') }}" class="w-full bg-midnight text-white py-3 font-black text-xs tracking-[0.2em] uppercase hover:bg-darker transition-colors shadow-lg">
                    Daftar Sekarang
                </a>
            </div>
        </div>

        <div class="flex justify-center" data-aos="zoom-in">
             <div class="bg-slate-100 p-8 rounded-sm border-l-8 border-accent flex flex-col md:flex-row items-center gap-8 max-w-4xl w-full">
                <div class="flex-1">
                    <h4 class="text-midnight font-black text-xl uppercase tracking-tighter italic">Ingin menjadi bagian dari sejarah SMAKDAKU?</h4>
                    <p class="text-slate-500 text-sm">Pendaftaran kandidat dibuka mulai tanggal 15 Januari hingga 25 Januari 2026.</p>
                </div>
                <a href="{{ route('register.kandidat') }}" class="bg-accent hover:bg-[#c0392b] text-white px-10 py-4 rounded-sm font-black text-sm tracking-widest transition-all shadow-xl whitespace-nowrap">
                    DAFTAR KANDIDAT
                </a>
             </div>
        </div>
    </div>
</section>


    <footer class="bg-midnight py-16 border-t-4 border-accent">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <div class="flex flex-col items-center gap-6">
                <div class="bg-accent px-4 py-2 rotate-2">
                    <span class="text-2xl font-black tracking-tighter italic">VOTE<span class="text-white">OSIS</span></span>
                </div>
                <p class="text-slate-500 text-xs font-bold uppercase tracking-[0.4em]">© 2026 E-Voting SMAKDAKU. Hak Cipta Dilindungi.</p>
                <div class="flex gap-8 mt-4">
                    <a href="#" class="text-slate-400 hover:text-accent transition-colors"><i data-lucide="instagram"></i></a>
                    <a href="#" class="text-slate-400 hover:text-accent transition-colors"><i data-lucide="twitter"></i></a>
                    <a href="#" class="text-slate-400 hover:text-accent transition-colors"><i data-lucide="github"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        lucide.createIcons();
        AOS.init({
            duration: 800,
            once: true,
            easing: 'ease-in-out'
        });
    </script>
</body>

</html>

