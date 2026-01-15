<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <style>
        .page-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 800;
            letter-spacing: -0.02em;
        }
        .icon-box {
            width: 35px;
            height: 35px;
            background: rgba(78, 115, 223, 0.1);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
        }
        /* Memperbaiki spasi DataTables agar tidak mepet ke pinggir */
        .dataTables_wrapper .row:first-child, 
        .dataTables_wrapper .row:last-child {
            padding: 1.25rem 1.5rem;
        }
        .dataTables_filter input {
            border-radius: 8px;
            border: 1px solid #e3e6f0;
            padding: 0.3rem 0.75rem;
        }
    </style>

    <div class="d-sm-flex align-items-center justify-content-between mb-4 animate__animated animate__fadeIn">
        <div class="d-flex align-items-center">
            <div class="icon-box">
                <i class="fas fa-user-shield text-primary"></i>
            </div>
            <div>
                <h1 class="h4 mb-0 text-gray-800 page-title">Daftar <span class="text-primary">Pengelola</span></h1>
                <p class="text-muted small mb-0 font-weight-medium">Manajemen hak akses administrator sistem.</p>
            </div>
        </div>

        <a href="#" class="btn btn-primary btn-sm px-3 shadow-sm font-weight-bold animate__animated animate__fadeInRight" 
           data-toggle="modal" data-target="#addAdminModal" 
           style="border-radius: 10px; height: fit-content;">
            <i class="fas fa-plus fa-sm mr-2"></i> TAMBAH ADMIN
        </a>
    </div>

    <div class="animate__animated animate__fadeIn">
        @include('components.alerts')
    </div>

    <div class="card shadow-sm border-0 animate__animated animate__fadeInUp" style="border-radius: 15px;">
        <div class="card-header bg-white py-3 border-0" style="border-radius: 15px 15px 0 0;">
            <h6 class="m-0 font-weight-bold text-gray-800">
                <i class="fas fa-table text-primary mr-2"></i>Data Administrator
            </h6>
        </div>
        <div class="card-body p-0">
            @include('admin.components.table')
        </div>
    </div>

</x-layout>