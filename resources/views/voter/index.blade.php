<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title }}</title>
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
                        accent: '#E74C3C',
                    }
                }
            }
        }
    </script>
    <style>
        body { background-color: #1A252F; color: #ECF0F1; }
        .bg-midnight-gradient { background: linear-gradient(135deg, #2C3E50 0%, #1A252F 100%); }
        .candidate-card { background: #2C3E50; border: 1px solid rgba(255, 255, 255, 0.05); transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
        .candidate-card:hover { transform: translateY(-10px); border-color: #E74C3C; box-shadow: 0 20px 40px rgba(0,0,0,0.4); }
        .img-container::after { content: ""; position: absolute; inset: 0; background: linear-gradient(to top, #2C3E50, transparent); opacity: 0.6; }
    </style>
</head>

<body class="overflow-x-hidden font-sans">

    <nav class="fixed w-full z-50 bg-[#2C3E50]/95 backdrop-blur-md border-b border-white/5">
        <div class="max-w-7xl mx-auto px-6 py-3 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <div class="bg-white p-1 rounded-full shadow-lg">
                    <img src="{{ asset('assets/storage/logo1.png') }}" class="w-8 h-8 object-contain" alt="Logo">
                </div>
                <div class="flex flex-col">
                    <h3 class="text-white text-lg font-black italic uppercase leading-none">E-Voting <span class="text-accent">SMAKDAKU</span></h3>
                </div>
            </div>
            <div class="flex items-center gap-6">
                <span class="text-xs font-bold text-slate-400 hidden md:block">Halo, {{ auth()->user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="text-xs font-black uppercase tracking-widest text-accent hover:text-white transition-colors">Keluar</button>
                </form>
            </div>
        </div>
    </nav>

    <section class="pt-32 pb-12 bg-midnight-gradient">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6" data-aos="fade-up">
                <div>
                    <span class="text-accent font-black tracking-[0.3em] text-xs mb-2 uppercase italic">Daftar Kandidat 2026</span>
                    <h1 class="text-4xl md:text-6xl font-black uppercase italic tracking-tighter">Tentukan <span class="text-accent">Pilihanmu.</span></h1>
                </div>
                <p class="text-slate-400 text-sm max-w-xs font-medium border-l-2 border-accent pl-4 uppercase">
                    Pilih satu kandidat terbaik untuk memimpin SMAKDAKU satu periode kedepan.
                </p>
            </div>
        </div>
    </section>

    <section class="py-12 pb-32">
        <div class="max-w-7xl mx-auto px-6">
            @if ($candidates->whereNotNull('election_number')->isEmpty())
                <div class="text-center py-20 bg-midnight rounded-sm border-2 border-dashed border-white/10">
                    <i data-lucide="user-x" class="w-16 h-16 text-slate-500 mx-auto mb-4"></i>
                    <p class="text-slate-400 font-bold uppercase tracking-widest">Belum ada kandidat terdaftar</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($candidates->whereNotNull('election_number') as $candidate)
                        <div class="candidate-card relative group rounded-sm overflow-hidden" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                            
                            <div class="absolute top-6 left-6 z-20 bg-accent text-white w-12 h-12 flex items-center justify-center font-black text-2xl italic shadow-xl">
                                {{ str_pad($candidate->election_number, 2, '0', STR_PAD_LEFT) }}
                            </div>

                            <div class="relative h-[400px] overflow-hidden img-container">
                                <img src="{{ asset('storage/' . $candidate->picture) }}" 
                                     class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700"
                                     alt="{{ $candidate->name }}"
                                     onerror="this.src='https://via.placeholder.com/400x600?text=Kandidat'">
                            </div>

                            <div class="p-8 relative z-10">
                                <h3 class="text-2xl font-black uppercase italic tracking-tighter mb-1">{{ $candidate->name }}</h3>
                                <p class="text-accent text-xs font-bold uppercase tracking-[0.2em] mb-6">Calon Ketua OSIS</p>
                                
                                <div class="flex gap-3 mt-4">
                                    <a href="{{ asset('storage/' . $candidate->resume) }}" target="_blank"
                                       class="flex-1 border-2 border-white/10 hover:border-white text-white py-3 text-center font-black text-xs tracking-widest uppercase transition-all">
                                        Visi Misi
                                    </a>
                                    
                                    <button type="button" 
                                            onclick="openModal('modal{{ $candidate->id }}')"
                                            class="flex-1 bg-accent hover:bg-white hover:text-darker text-white py-3 text-center font-black text-xs tracking-widest uppercase transition-all shadow-lg shadow-accent/20">
                                        PILIH
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div id="modal{{ $candidate->id }}" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-6">
                            <div class="absolute inset-0 bg-darker/90 backdrop-blur-sm" onclick="closeModal('modal{{ $candidate->id }}')"></div>
                            <div class="relative bg-midnight border-t-4 border-accent w-full max-w-md p-10 shadow-2xl">
                                <div class="text-center">
                                    <div class="w-20 h-20 bg-accent/10 rounded-full flex items-center justify-center mx-auto mb-6">
                                        <i data-lucide="check-circle" class="text-accent w-10 h-10"></i>
                                    </div>
                                    <h3 class="text-2xl font-black uppercase italic italic tracking-tighter mb-2">Konfirmasi Pilihan</h3>
                                    <p class="text-slate-400 text-sm mb-8">Apakah Anda yakin memberikan suara kepada <span class="text-white font-bold">{{ $candidate->name }}</span>? Tindakan ini tidak dapat diubah.</p>
                                    
                                    <form id="voteForm{{ $candidate->id }}" action="{{ route('voter.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="candidate_id" value="{{ $candidate->id }}">
                                        <div class="flex flex-col gap-3">
                                            <button type="button" 
                                                    onclick="submitVote(this, 'voteForm{{ $candidate->id }}')"
                                                    class="w-full bg-accent hover:bg-[#c0392b] text-white py-4 font-black text-sm tracking-[0.2em] uppercase transition-all">
                                                YA, SAYA YAKIN
                                            </button>
                                            <button type="button" 
                                                    onclick="closeModal('modal{{ $candidate->id }}')"
                                                    class="w-full bg-transparent hover:text-white text-slate-500 py-2 font-bold text-xs tracking-widest uppercase transition-all">
                                                BATAL
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <footer class="bg-midnight py-16 border-t-4 border-accent">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <div class="bg-accent px-4 py-2 rotate-2 inline-block mb-6">
                <span class="text-2xl font-black tracking-tighter italic uppercase text-darker">VOTE<span class="text-white">OSIS</span></span>
            </div>
            <p class="text-slate-500 text-[10px] font-bold uppercase tracking-[0.4em]">© 2026 E-Voting SMAKDAKU. Digital Identity.</p>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        lucide.createIcons();
        AOS.init({ duration: 800, once: true });

        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function submitVote(btn, formId) {
            btn.disabled = true;
            btn.innerHTML = `<span class="flex items-center justify-center gap-2"><i data-lucide="loader-2" class="animate-spin w-4 h-4"></i> MEMPROSES...</span>`;
            lucide.createIcons();
            document.getElementById(formId).submit();
        }
    </script>
</body>
</html>