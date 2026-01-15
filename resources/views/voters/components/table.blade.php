<form id="massDeleteForm" action="{{ route('voters.massDelete') }}" method="post">
    @csrf
    <div class="card shadow-sm border-0 animate__animated animate__fadeInUp" style="border-radius: 15px;">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-0">
            <h6 class="m-0 font-weight-bold text-gray-800">
                <i class="fas fa-list text-primary mr-2"></i>Tabel Pemilih
            </h6>
            <button type="button" id="deleteSelectedBtn" class="btn btn-danger btn-sm px-3 shadow-sm font-weight-bold" disabled>
                <i class="fas fa-trash-alt mr-1"></i> HAPUS PILIHAN
            </button>
        </div>
        
        <div class="card-body p-0"> 
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="dataTable" width="100%">
                    <thead class="bg-light">
                        <tr>
                            <th width="5%">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="selectAll">
                                    <label class="custom-control-label" for="selectAll"></label>
                                </div>
                            </th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">NISN</th>
                            <th class="text-center">Aksi</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($voters as $voter)
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="selected_ids[]" value="{{ $voter->id }}" 
                                           class="custom-control-input voter-checkbox" id="check-{{ $voter->id }}">
                                    <label class="custom-control-label" for="check-{{ $voter->id }}"></label>
                                </div>
                            </td>
                            <td>{{ $voter->name }}</td>
                            <td>{{ $voter->email }}</td>
                            
                            <td class="text-center">
                                <span class="badge {{ $voter->status === 'Voted' ? 'badge-soft-success' : 'badge-soft-danger' }}">
                                    {{ $voter->status === 'Voted' ? 'Sudah Memilih' : 'Belum Memilih' }}
                                </span>
                            </td>
                            <td class="text-center">{{ $voter->nisn }}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#editVotersModal" data-id="{{ $voter->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>

                        
                                
                                <button type="button" class="btn btn-sm btn-outline-danger btn-delete-single" 
                                        data-id="{{ $voter->id }}" data-name="{{ $voter->name }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</form>

<form id="singleDeleteForm" action="" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>

<style>

    /* Memberikan jarak agar tidak mepet ke pinggir kartu */
.dataTables_wrapper .row:first-child, 
.dataTables_wrapper .row:last-child {
    padding: 1.25rem 1.5rem; /* Menyeimbangkan spasi dengan header tabel */
}

/* Mempercantik input search */
.dataTables_filter input {
    border-radius: 8px;
    border: 1px solid #e3e6f0;
    padding: 0.25rem 0.5rem;
}

/* Mempercantik select show entries */
.dataTables_length select {
    border-radius: 8px;
    border: 1px solid #e3e6f0;
}
    /* Styling khusus untuk menyelaraskan dengan tema sebelumnya */
    .table-row-hover:hover {
        background-color: #f8f9fc;
    }

    /* Badge dengan warna lembut (Pastel) */
    .badge-soft-success {
        background-color: rgba(28, 200, 138, 0.1);
        color: #1cc88a;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.7rem;
    }
    
    .badge-soft-danger {
        background-color: rgba(231, 74, 59, 0.1);
        color: #e74a3b;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.7rem;
    }

    /* Mempercantik checkbox bawaan Bootstrap */
    .custom-control-input:checked ~ .custom-control-label::before {
        background-color: #4e73df;
        border-color: #4e73df;
    }

    .table thead th {
        border-bottom: 1px solid #e3e6f0 !important;
    }
</style>

@include('voters.components.modal')

<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAllCheckbox = document.getElementById('selectAll');
    const deleteSelectedBtn = document.getElementById('deleteSelectedBtn');
    const massDeleteForm = document.getElementById('massDeleteForm');

    // Fungsi untuk update status tombol hapus
    function updateDeleteButtonState() {
        const checkedCount = document.querySelectorAll('.voter-checkbox:checked').length;
        deleteSelectedBtn.disabled = checkedCount === 0;
        
        // Opsional: Ubah teks tombol untuk menunjukkan jumlah terpilih
        if(checkedCount > 0) {
            deleteSelectedBtn.innerHTML = `<i class="fas fa-trash-alt mr-1"></i> HAPUS (${checkedCount}) DATA`;
        } else {
            deleteSelectedBtn.innerHTML = `<i class="fas fa-trash-alt mr-1"></i> HAPUS PILIHAN`;
        }
    }

    // Event saat "Select All" diklik
    selectAllCheckbox.addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.voter-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        updateDeleteButtonState();
    });

    // Event delegasi untuk checkbox individual (agar tetap jalan meski ada pagination DataTable)
    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('voter-checkbox')) {
            const allCheckboxes = document.querySelectorAll('.voter-checkbox');
            const checkedCheckboxes = document.querySelectorAll('.voter-checkbox:checked');
            
            selectAllCheckbox.checked = allCheckboxes.length === checkedCheckboxes.length;
            selectAllCheckbox.indeterminate = checkedCheckboxes.length > 0 && checkedCheckboxes.length < allCheckboxes.length;
            
            updateDeleteButtonState();
        }
    });

    // Handle klik tombol hapus massal
    // Logika SweetAlert untuk Mass Delete
document.getElementById('deleteSelectedBtn').addEventListener('click', function() {
    const checkedCount = document.querySelectorAll('.voter-checkbox:checked').length;
    
    Swal.fire({
        title: 'Hapus ' + checkedCount + ' Data?',
        text: "Data yang dipilih akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e74a3b',
        confirmButtonText: 'YA, HAPUS SEMUA',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Submit form massDeleteForm
            document.getElementById('massDeleteForm').submit();
        }
    });
});

// Logika Single Delete
document.querySelectorAll('.btn-delete-single').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.dataset.id;
        const name = this.dataset.name;
        const singleForm = document.getElementById('singleDeleteForm');
        
        Swal.fire({
            title: 'Hapus Pemilih?',
            text: `Hapus ${name}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'YA, HAPUS'
        }).then((result) => {
            if (result.isConfirmed) {
                // Set action URL secara dinamis sesuai route Anda
                singleForm.action = `/voters/${id}`; 
                singleForm.submit();
            }
        });
    });
});
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Menangani Klik Tombol Hapus Satuan
    const deleteButtons = document.querySelectorAll('.btn-delete-single');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const voterId = this.getAttribute('data-id');
            const voterName = this.getAttribute('data-name');

            Swal.fire({
                title: 'Hapus Pemilih?',
                text: `Apakah Anda yakin ingin menghapus "${voterName}"? Data yang dihapus tidak bisa dikembalikan.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e74a3b', // Warna merah accent
                cancelButtonColor: '#858796',
                confirmButtonText: 'YA, HAPUS',
                cancelButtonText: 'BATAL',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jalankan form delete yang sesuai dengan ID
                    document.getElementById(`delete-form-${voterId}`).submit();
                }
            });
        });
    });
});
</script>

<script>
// JavaScript Select All
document.getElementById('selectAll').onclick = function() {
    // Saran: Gunakan class spesifik agar checkbox lain di luar tabel tidak ikut tercentang
    var checkboxes = document.querySelectorAll('.child-checkbox');
    for (var checkbox of checkboxes) {
        checkbox.checked = this.checked;
    }
}
</script>