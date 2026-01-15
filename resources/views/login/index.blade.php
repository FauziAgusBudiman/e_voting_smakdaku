<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title }} | Login</title>
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
        body { background-color: #1A252F; color: #ECF0F1; font-family: 'Inter', sans-serif; }
        .bg-midnight-gradient { background: linear-gradient(135deg, #2C3E50 0%, #1A252F 100%); }
        
        /* Animasi Kotak Suara Custom */
        .ballot-box-container {
            perspective: 1000px;
        }
        .box-body {
            background: #E74C3C;
            width: 120px;
            height: 90px;
            border-radius: 8px;
            position: relative;
            box-shadow: 0 10px 25px rgba(231, 76, 60, 0.3);
        }
        .box-slot {
            background: #1A252F;
            height: 6px;
            width: 70%;
            margin: 0 auto;
            position: absolute;
            top: 15px;
            left: 15%;
            border-radius: 10px;
        }
        .paper {
            background: white;
            width: 45px;
            height: 55px;
            position: absolute;
            top: -40px;
            left: 37px;
            animation: dip 3s infinite ease-in-out;
            z-index: -1;
            border-radius: 2px;
        }
        @keyframes dip {
            0%, 100% { transform: translateY(0); opacity: 0; }
            20% { opacity: 1; }
            50% { transform: translateY(50px); opacity: 0; }
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4">

    <div class="fixed top-0 right-0 -mt-20 -mr-20 w-96 h-96 bg-accent/10 rounded-full blur-3xl -z-10"></div>
    <div class="fixed bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl -z-10"></div>

    <div class="max-w-5xl w-full" data-aos="zoom-in">
        <div class="bg-midnight rounded-2xl overflow-hidden shadow-[0_30px_60px_rgba(0,0,0,0.5)] border border-white/5">
            <div class="flex flex-col lg:flex-row">
                
                <div class="lg:w-5/12 bg-midnight-gradient p-10 flex flex-col items-center justify-center border-b lg:border-b-0 lg:border-r border-white/5">
                    
                    <div class="ballot-box-container mb-10">
                        <div class="relative">
                            <div class="paper"></div>
                            <div class="box-body">
                                <div class="box-slot"></div>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <i data-lucide="vote" class="text-white/20 w-10 h-10"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <h2 class="text-3xl font-black italic uppercase tracking-tighter mb-4">
                            Satu Suara <br> <span class="text-accent">Satu Perubahan.</span>
                        </h2>
                        
                        <div class="space-y-4 mt-8">
                            <div class="flex items-center gap-4 text-left group">
                                <div class="bg-accent/10 p-2 rounded-lg group-hover:bg-accent/20 transition-colors">
                                    <i data-lucide="shield-check" class="text-accent w-5 h-5"></i>
                                </div>
                                <p class="text-xs font-bold uppercase tracking-widest text-slate-400">Keamanan Terjamin</p>
                            </div>
                            <div class="flex items-center gap-4 text-left group">
                                <div class="bg-accent/10 p-2 rounded-lg group-hover:bg-accent/20 transition-colors">
                                    <i data-lucide="zap" class="text-accent w-5 h-5"></i>
                                </div>
                                <p class="text-xs font-bold uppercase tracking-widest text-slate-400">Hasil Real-Time</p>
                            </div>
                            <div class="flex items-center gap-4 text-left group">
                                <div class="bg-accent/10 p-2 rounded-lg group-hover:bg-accent/20 transition-colors">
                                    <i data-lucide="user-check" class="text-accent w-5 h-5"></i>
                                </div>
                                <p class="text-xs font-bold uppercase tracking-widest text-slate-400">Verifikasi Otomatis</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:w-7/12 bg-white p-8 lg:p-14 text-midnight">
                    
                    <div class="flex items-center gap-4 mb-10">
                        <div class="bg-midnight p-2 rounded-xl">
                            <img src="{{ Vite::asset('resources/assets/images/logo1.png') }}" alt="Logo" class="w-10 h-10 object-contain">
                        </div>
                        <div>
                            <h1 class="text-2xl font-black uppercase italic tracking-tighter leading-none">E-Voting <span class="text-accent">SMAKDAKU</span></h1>
                            <p class="text-[10px] font-bold uppercase tracking-[0.3em] text-slate-400">Pemilihan OSIS Digital</p>
                        </div>
                    </div>

                    <div class="mb-6">
                        @include('login.components.alert')
                    </div>

                    <div class="login-form">
                        @include('login.components.form')
                    </div>

                    <div class="mt-10 pt-6 border-t border-slate-100 text-center">
                        <p class="text-slate-400 text-xs font-medium uppercase tracking-widest">
                            Bermasalah login? <br>
                            <p class="text-midnight font-black transition-colors">Hubungi Administrator OSIS</p>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <p class="text-center mt-8 text-slate-500 text-[10px] font-bold uppercase tracking-[0.5em]">
            © 2026 E-Voting SMAKDAKU. Digital Identity System.
        </p>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
    <script>
        lucide.createIcons();
        AOS.init({
            duration: 1000,
            once: true
        });

        // Styling tambahan untuk input bawaan dari include form
        $(document).ready(function() {
            $('input').addClass('w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-xl focus:border-accent focus:ring-0 outline-none transition-all mb-4 font-semibold text-midnight');
            $('button[type="submit"]').addClass('w-full bg-accent hover:bg-darker text-white font-black py-4 rounded-xl uppercase tracking-widest shadow-lg shadow-accent/20 transition-all hover:-translate-y-1 active:translate-y-0');
        });
    </script>
</body>
</html>