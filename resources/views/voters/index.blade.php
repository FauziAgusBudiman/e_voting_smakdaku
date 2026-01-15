<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <style>
        .page-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 800;
            letter-spacing: -0.02em;
        }
        .btn-modern {
            border-radius: 10px;
            padding: 0.5rem 1rem;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            transition: all 0.3s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .icon-box {
            width: 32px;
            height: 32px;
            background: rgba(78, 115, 223, 0.1);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
        }
    </style>

    <div class="d-sm-flex align-items-center justify-content-between mb-4 animate__animated animate__fadeIn">
        <div class="d-flex align-items-center">
            <div class="icon-box">
                <i class="fas fa-users text-primary"></i>
            </div>
            <div>
                <h1 class="h4 mb-0 text-gray-800 page-title">Kelola <span class="text-primary">Pemilih</span></h1>
                <p class="text-muted small mb-0 font-weight-medium">Kelola data pemilih dan hak akses suara.</p>
            </div>
        </div>

        <div class="d-flex flex-wrap mt-3 mt-sm-0 shadow-sm rounded-lg overflow-hidden border">
            <button class="btn btn-white btn-sm border-0 text-info font-weight-bold px-3 py-2 border-right" 
                    data-toggle="modal" data-target="#importVotersModal" style="border-radius: 0;">
                <i class="fas fa-file-import mr-1"></i> Import
            </button>
            
            <!-- <a href="{{ route('voters.export.excel') }}" target="_blank"
               class="btn btn-white btn-sm border-0 text-success font-weight-bold px-3 py-2 border-right" style="border-radius: 0;">
                <i class="fas fa-file-excel mr-1"></i> Excel
            </a> -->

            <a href="{{ route('voters.export.pdf') }}" target="_blank"
               class="btn btn-white btn-sm border-0 text-danger font-weight-bold px-3 py-2 border-right" style="border-radius: 0;">
                <i class="fas fa-file-pdf mr-1"></i> PDF
            </a>

            <button class="btn btn-primary btn-sm border-0 font-weight-bold px-3 py-2" 
                    data-toggle="modal" data-target="#addVotersModal" style="border-radius: 0;">
                <i class="fas fa-plus mr-1"></i> Tambah
            </button>
        </div>
    </div>

    <div class="animate__animated animate__fadeIn">
        @include('components.alerts')
    </div>

    <div class="card shadow-sm border-0 animate__animated animate__fadeInUp" style="border-radius: 15px;">
        <div class="card-body p-0">
            @include('voters.components.table')
        </div>
    </div>

    <style>
        .modal-content {
            border: none;
            border-radius: 15px;
        }
        .modal-header {
            border-bottom: 1px solid #f8f9fc;
            padding: 1.5rem;
        }
        .modal-footer {
            border-top: 1px solid #f8f9fc;
        }
    </style>

</x-layout>