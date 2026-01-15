<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Kandidat | SMAKDAKU</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap');

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8f9fc; /* Warna background dashboard sebelumnya */
            color: #4e73df;
        }

        .glass-card {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            border: none;
        }

        .hover-card:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1) !important;
        }

        .table-thead {
            background-color: #f8f9fc;
            color: #858796;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #d1d3e2; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #858796; }
    </style>
</head>
<body class="min-h-screen pb-20">

    <nav class="sticky top-0 z-50 bg-white shadow-sm py-4 px-8 flex justify-between items-center border-b border-gray-100">
        <div class="flex items-center gap-3">
            <div class="bg-red-500 p-2 rounded-lg">
                <i data-lucide="shield-check" class="text-white w-5 h-5"></i>
            </div>
            <div>
                <span class="block font-bold text-gray-800 tracking-tight leading-none">Admin<span class="text-red-500">Panel</span></span>
                <span class="text-[9px] text-gray-400 font-bold uppercase tracking-widest">Verification System</span>
            </div>
        </div>
        <div class="flex items-center gap-6">
            <a href="/dashboard" class="text-xs font-bold text-gray-500 hover:text-red-500 transition-colors flex items-center gap-2">
                <i data-lucide="layout-dashboard" class="w-4 h-4"></i> DASHBOARD
            </a>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-10">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-6">
            <div class="animate__animated animate__fadeInLeft">
                <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">
                    Verifikasi <span class="text-red-500">Kandidat</span>
                </h1>
                <p class="text-gray-500 text-sm mt-1 font-medium">
                    Tinjau dan setujui visi, misi, dan dokumen kandidat.
                </p>
            </div>
            
            <div class="animate__animated animate__fadeInRight">
                <div class="bg-white px-6 py-4 rounded-xl shadow-sm border-l-4 border-red-500 flex items-center gap-4">
                    <div class="p-3 bg-red-50 rounded-full">
                        <i data-lucide="users" class="text-red-500 w-6 h-6"></i>
                    </div>
                    <div>
                        <span class="block text-[10px] uppercase font-bold text-gray-400 tracking-wider">Total Applicants</span>
                        <span class="text-2xl font-bold text-gray-800">{{ count($candidates) }} <small class="text-xs font-normal text-gray-400">Students</small></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="glass-card overflow-hidden animate__animated animate__fadeInUp mb-10">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="table-thead border-b border-gray-100">
                            <th class="px-8 py-4 font-bold">Info Kandidat</th>
                            <th class="px-8 py-4 font-bold">Content Review</th>
                            <th class="px-8 py-4 font-bold text-center">Current Status</th>
                            <th class="px-8 py-4 font-bold text-center">Documents</th>
                            <th class="px-8 py-4 font-bold text-center">Quick Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($candidates as $kandidat)
                        <tr class="hover:bg-gray-50/50 transition-all group">
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="relative">
                                        <img src="{{ asset('storage/' . $kandidat->picture) }}" 
                                             class="w-12 h-12 rounded-full border-2 border-white shadow-sm object-cover"
                                             onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($kandidat->name) }}&background=e74a3b&color=fff'">
                                        @if($kandidat->election_number)
                                            <div class="absolute -bottom-1 -right-1 bg-green-500 text-white p-1 rounded-full border-2 border-white">
                                                <i data-lucide="check" class="w-2 h-2 font-bold"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-800 group-hover:text-red-500 transition-colors">
                                            {{ $kandidat->name }}
                                        </div>
                                        <div class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">{{ $kandidat->kelas }}</div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-8 py-5">
                                <button onclick="focusVisiMisi('{{ $kandidat->name }}', '{{ e($kandidat->visi) }}', '{{ e($kandidat->misi) }}')" 
                                        class="inline-flex items-center gap-2 bg-gray-100 hover:bg-red-50 text-gray-600 hover:text-red-600 px-4 py-2 rounded-lg text-[11px] font-bold transition-all border border-transparent hover:border-red-100">
                                    <i data-lucide="eye" class="w-4 h-4"></i> View Vision & Mission
                                </button>
                            </td>

                            <td class="px-8 py-5 text-center">
                                @if($kandidat->election_number)
                                    <span class="inline-flex items-center bg-green-100 text-green-700 px-3 py-1 rounded-full text-[10px] font-bold border border-green-200 uppercase">
                                        Ballot No: {{ $kandidat->election_number }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-[10px] font-bold border border-yellow-200 uppercase">
                                        Waiting Approval
                                    </span>
                                @endif
                            </td>

                            <td class="px-8 py-5 text-center">
                                <a href="{{ asset('storage/' . $kandidat->resume) }}" target="_blank" 
                                   class="inline-flex items-center gap-2 text-gray-400 hover:text-blue-600 transition-colors">
                                    <i data-lucide="file-text" class="w-5 h-5"></i>
                                    <span class="text-[10px] font-bold uppercase tracking-tighter">CV / Resume</span>
                                </a>
                            </td>

                            <td class="px-8 py-5">
                                <div class="flex justify-center gap-2">
                                    <button onclick="confirmVerify({{ $kandidat->id }}, '{{ $kandidat->name }}')" 
                                            class="bg-white border border-gray-200 hover:bg-green-500 text-green-500 hover:text-white w-9 h-9 flex items-center justify-center rounded-lg transition-all shadow-sm hover:border-green-500"
                                            title="Verify Candidate">
                                        <i data-lucide="check-circle" class="w-4 h-4"></i>
                                    </button>
                                    
                                    <button onclick="confirmDelete({{ $kandidat->id }}, '{{ $kandidat->name }}')" 
                                            class="bg-white border border-gray-200 hover:bg-red-500 text-red-500 hover:text-white w-9 h-9 flex items-center justify-center rounded-lg transition-all shadow-sm hover:border-red-500"
                                            title="Reject Application">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>

                                    <form id="delete-form-{{ $kandidat->id }}" action="/admin/kandidat/{{ $kandidat->id }}" method="POST" class="hidden">
                                        @csrf @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-20 text-center">
                                <div class="flex flex-col items-center opacity-30">
                                    <i data-lucide="inbox" class="w-12 h-12 mb-3"></i>
                                    <p class="font-bold text-sm uppercase tracking-widest">No candidates found</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div id="visi-misi-container" class="hidden animate__animated animate__fadeIn">
            <div class="glass-card p-8 border-t-4 border-red-500">
                <div class="flex justify-between items-center mb-8 border-b border-gray-100 pb-4">
                    <div>
                        <h2 id="view-name" class="text-2xl font-bold text-gray-800 tracking-tight leading-none"></h2>
                        <span class="text-[10px] font-bold text-red-500 uppercase tracking-[0.2em] mt-2 block">Vision & Mission Preview</span>
                    </div>
                    <button onclick="document.getElementById('visi-misi-container').classList.add('hidden')" 
                            class="text-gray-400 hover:text-red-500 transition-colors">
                        <i data-lucide="x-circle" class="w-6 h-6"></i>
                    </button>
                </div>

                <div class="grid md:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <div class="flex items-center gap-2 text-gray-800">
                            <i data-lucide="target" class="w-4 h-4 text-red-500"></i>
                            <h3 class="text-xs font-bold uppercase tracking-widest">Candidate Vision</h3>
                        </div>
                        <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 min-h-[150px]">
                            <p id="view-visi" class="text-gray-600 leading-relaxed text-sm italic"></p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center gap-2 text-gray-800">
                            <i data-lucide="list-checks" class="w-4 h-4 text-red-500"></i>
                            <h3 class="text-xs font-bold uppercase tracking-widest">Candidate Mission</h3>
                        </div>
                        <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 min-h-[150px]">
                            <p id="view-misi" class="text-gray-600 leading-relaxed text-sm italic whitespace-pre-line"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        lucide.createIcons();

        function focusVisiMisi(name, visi, misi) {
            const container = document.getElementById('visi-misi-container');
            document.getElementById('view-name').innerText = name;
            document.getElementById('view-visi').innerText = visi || 'Vision not provided.';
            document.getElementById('view-misi').innerText = misi || 'Mission not provided.';

            container.classList.remove('hidden');
            container.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }

        // SWAL Toast Configuration
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            background: '#ffffff',
            color: '#4e73df'
        });

        @if(session('success'))
            Toast.fire({ icon: 'success', title: "{{ session('success') }}" });
        @endif

        async function confirmVerify(id, name) {
            const { value: number } = await Swal.fire({
                title: 'Verify Candidate',
                text: `Approve and assign a ballot number for ${name}?`,
                input: 'number',
                inputPlaceholder: 'Enter ballot number (e.g. 1, 2, 3)',
                showCancelButton: true,
                confirmButtonColor: '#1cc88a',
                cancelButtonColor: '#858796',
                confirmButtonText: 'APPROVE',
                inputValidator: (value) => {
                    if (!value) return 'You need to assign a number!'
                }
            });

            if (number) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/admin/verifikasi-kandidat/${id}/update`;
                form.innerHTML = `@csrf @method('PATCH') <input type="hidden" name="election_number" value="${number}">`;
                document.body.appendChild(form);
                form.submit();
            }
        }

        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Delete Application?',
                text: `You are about to permanently remove ${name} from the list.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e74a3b',
                cancelButtonColor: '#858796',
                confirmButtonText: 'YES, DELETE',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${id}`).submit();
                }
            });
        }
    </script>
</body>
</html>