<div class="card shadow-sm border-0 animate__animated animate__fadeInUp" style="border-radius: 15px;">
    
    
    <div class="card-body p-0"> <div class="table-responsive">
            <table class="table table-hover mb-0 w-100" id="dataTable" cellspacing="0">
                <thead class="bg-light">
                    <tr class="text-gray-500 uppercase font-weight-bold" style="font-size: 0.65rem; letter-spacing: 0.05em;">
                        <th class="px-4 py-3 border-0">Nama Pengelola</th>
                        <th class="px-4 py-3 border-0">Alamat Email</th>
                        <th class="px-4 py-3 border-0 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700" style="font-size: 0.85rem;">
                    @foreach ($admin as $row)
                        <tr class="table-row-hover transition-all">
                            <td class="px-4 py-3 align-middle border-top-0">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm mr-3 bg-primary-soft text-primary d-flex align-items-center justify-content-center rounded-circle" style="width: 35px; height: 35px; background: rgba(78, 115, 223, 0.1);">
                                        <i class="fas fa-user fa-sm"></i>
                                    </div>
                                    <span class="font-weight-bold">{{ $row->name }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3 align-middle border-top-0 text-muted">
                                {{ $row->email }}
                            </td>
                            <td class="px-4 py-3 align-middle border-top-0 text-center">
                                <div class="btn-group" role="group">
                                    <button class="btn btn-outline-warning btn-sm border-0 mr-1" 
                                            data-toggle="modal" data-target="#editAdminModal" 
                                            data-id="{{ $row->id }}"
                                            data-name="{{ $row->name }}" 
                                            data-email="{{ $row->email }}"
                                            style="border-radius: 8px; background: rgba(246, 194, 62, 0.1);">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <form action="{{ route('admin.destroy', $row->id) }}" method="post" class="d-inline admin-delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-outline-danger btn-sm border-0 btn-delete-confirm"
                                                style="border-radius: 8px; background: rgba(231, 74, 59, 0.1);">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    /* Hover effect pada baris tabel */
    .table-row-hover:hover {
        background-color: #f8f9fc;
    }

    /* Memastikan tombol aksi tidak terlalu besar */
    .btn-sm {
        padding: 0.4rem 0.6rem;
    }

    /* Penyesuaian khusus DataTables (Show & Search) agar tidak mepet */
    .dataTables_wrapper .row:first-child, 
    .dataTables_wrapper .row:last-child {
        padding: 1.25rem 1.5rem;
    }

    /* Style input search DataTables */
    .dataTables_filter input {
        border-radius: 10px;
        border: 1px solid #e3e6f0;
        padding: 0.5rem;
    }
</style>

<script>
    // Integrasi SweetAlert2 untuk konfirmasi hapus (agar senada dengan halaman Pemilih)
    document.querySelectorAll('.btn-delete-confirm').forEach(button => {
        button.addEventListener('click', function(e) {
            const form = this.closest('.admin-delete-form');
            Swal.fire({
                title: 'Hapus Admin?',
                text: "Akses pengelola ini akan dicabut secara permanen.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e74a3b',
                cancelButtonColor: '#858796',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>

@include('admin.components.modal')