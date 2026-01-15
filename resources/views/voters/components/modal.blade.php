<div class="modal fade" id="addVotersModal" tabindex="-1" aria-labelledby="addVotersModalLabel" aria-hidden="true"
    data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-header border-0 pt-4 px-4">
                <div class="d-flex align-items-center">
                    <div class="bg-success-soft p-2 rounded-lg mr-3">
                        <i class="fas fa-user-plus text-success"></i>
                    </div>
                    <h5 class="modal-title font-weight-bold text-gray-800" id="addVotersModalLabel">Tambah Pemilih Baru</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('voters.store') }}" method="post" id="addVotersForm">
                @csrf
                <div class="modal-body px-4">
                    <div class="form-group mb-4">
                        <label class="text-[11px] font-weight-bold text-uppercase tracking-wider text-gray-500">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control form-modern" placeholder="Masukkan nama siswa..." required>
                    </div>
                    <div class="form-group mb-4">
                        <label class="text-[11px] font-weight-bold text-uppercase tracking-wider text-gray-500">Alamat Email</label>
                        <input type="email" name="email" class="form-control form-modern" placeholder="email@smakdaku.sch.id" required>
                    </div>
                    <div class="form-group mb-4">
                        <label class="text-[11px] font-weight-bold text-uppercase tracking-wider text-gray-500">NISN</label>
                        <input type="text" name="nisn" class="form-control form-modern" placeholder="9 digit" required>
                    </div>
                    <div class="form-group mb-4">
                        <label class="text-[11px] font-weight-bold text-uppercase tracking-wider text-gray-500">Password Akses</label>
                        <input type="text" name="password" class="form-control form-modern" placeholder="Buat password unik..." required>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="button" class="btn btn-light px-4 font-weight-bold text-gray-600" data-dismiss="modal" style="border-radius: 10px;">Batal</button>
                    <button type="submit" class="btn btn-success px-4 font-weight-bold shadow-sm" style="border-radius: 10px;">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editVotersModal" tabindex="-1" aria-labelledby="editVotersModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-header border-0 pt-4 px-4">
                <div class="d-flex align-items-center">
                    <div class="bg-warning-soft p-2 rounded-lg mr-3">
                        <i class="fas fa-edit text-warning"></i>
                    </div>
                    <h5 class="modal-title font-weight-bold text-gray-800" id="editVotersModalLabel">Edit Data Pemilih</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editVotersForm" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="modal-body px-4">
                    <div class="form-group mb-4">
                        <label class="text-[11px] font-weight-bold text-uppercase tracking-wider text-gray-500">Nama Lengkap</label>
                        <input type="text" name="name" id="editname" class="form-control form-modern" required>
                    </div>
                    <div class="form-group mb-4">
                        <label class="text-[11px] font-weight-bold text-uppercase tracking-wider text-gray-500">Alamat Email</label>
                        <input type="email" name="email" id="editEmail" class="form-control form-modern" required>
                    </div>
                    <div class="form-group mb-4">
                        <label class="text-[11px] font-weight-bold text-uppercase tracking-wider text-gray-500">NISN</label>
                        <input type="text" name="nisn" class="form-control form-modern" placeholder="9 digit" required>
                    </div>
                    <div class="form-group mb-2">
                        <label class="text-[11px] font-weight-bold text-uppercase tracking-wider text-gray-500">Password Baru</label>
                        <input type="password" name="password" id="editPassword" class="form-control form-modern" placeholder="••••••••">
                    </div>
                    <small class="text-muted italic"><i class="fas fa-info-circle mr-1"></i> Kosongkan jika tidak ingin mengubah password.</small>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="button" class="btn btn-light px-4 font-weight-bold text-gray-600" data-dismiss="modal" style="border-radius: 10px;">Batal</button>
                    <button type="submit" class="btn btn-warning px-4 font-weight-bold text-white shadow-sm" style="border-radius: 10px;">Perbarui Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="importVotersModal" tabindex="-1" aria-labelledby="importVotersModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-header border-0 pt-4 px-4">
                <div class="d-flex align-items-center">
                    <div class="bg-primary-soft p-2 rounded-lg mr-3">
                        <i class="fas fa-file-excel text-primary"></i>
                    </div>
                    <h5 class="modal-title font-weight-bold text-gray-800" id="importVotersModalLabel">Import via Excel</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('voters.import.excel') }}" method="post" id="importVotersForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body px-4 text-center">
                    <div class="bg-light p-4 rounded-xl border-dashed border-2 mb-4">
                        <i class="fas fa-cloud-upload-alt text-primary fa-3x mb-3"></i>
                        <p class="small text-gray-600 mb-0">Pastikan file mengikuti format:<br><strong>Baris 2 Kolom A (Nama, Email, NISN, Password)</strong></p>
                    </div>
                    <div class="form-group text-left">
                        <input type="file" class="form-control-file" id="file" name="file" accept=".xls,.xlsx,.csv" required>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="button" class="btn btn-light px-4 font-weight-bold text-gray-600" data-dismiss="modal" style="border-radius: 10px;">Batal</button>
                    <button type="submit" class="btn btn-primary px-4 font-weight-bold shadow-sm" style="border-radius: 10px;">Mulai Import</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Custom Styling untuk menyamakan dengan tema */
    .form-modern {
        border-radius: 10px;
        border: 1px solid #e3e6f0;
        padding: 0.75rem 1rem;
        transition: all 0.2s;
    }
    .form-modern:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.1);
    }
    .bg-success-soft { background-color: rgba(28, 200, 138, 0.1); }
    .bg-warning-soft { background-color: rgba(246, 194, 62, 0.1); }
    .bg-primary-soft { background-color: rgba(78, 115, 223, 0.1); }
    .rounded-xl { border-radius: 15px; }
    .border-dashed { border-style: dashed !important; }
    .text-[11px] { font-size: 11px; }
</style>

    <script>
       $(document).ready(function() {
    // Edit Modal Logic
    $('#editVotersModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); 
        var id = button.data('id'); 
        var modal = $(this);

        $('#editVotersForm').attr('action', '/voters/' + id);
        $('#editPassword').val(''); 

        $.ajax({
            url: '/voters/' + id + '/edit',
            type: 'GET',
            dataType: 'json',
            beforeSend: function() {
                $('#editname').val('Memuat data...');
            },
            success: function(data) {
                $('#editname').val(data.name);
                $('#editEmail').val(data.email);
            },
            error: function() {
                Swal.fire('Error', 'Gagal mengambil data pemilih.', 'error');
                modal.modal('hide');
            }
        });
    });

    // Realtime Fetching Status
    function fetchData() {
        $.ajax({
            url: '{{ route('voters.index') }}',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                data.forEach(function(voter) {
                    var statusElement = $('#status-' + voter.id);
                    // Sesuaikan badge agar tetap "Soft Style"
                    var statusHtml = voter.status === 'Voted' ?
                        '<span class="badge badge-soft-success px-3 py-2"><i class="fas fa-check-circle mr-1"></i> Sudah Memilih</span>' :
                        '<span class="badge badge-soft-danger px-3 py-2"><i class="fas fa-clock mr-1"></i> Belum Memilih</span>';
                    statusElement.html(statusHtml);
                });
            }
        });
    }

    // Jalankan polling setiap 5 detik
    setInterval(fetchData, 5000);
});
        $(document).ready(function() {
            fetchData();

            function fetchData() {
                $.ajax({
                    url: '{{ route('voters.index') }}',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        data.forEach(function(voter) {
                            var statusElement = $('#status-' + voter.id);
                            var statusHtml = voter.status === 'Voted' ?
                                '<span class="badge badge-success"><i class="fas fa-check-circle"></i> Sudah Memilih</span>' :
                                '<span class="badge badge-danger"><i class="fas fa-times-circle"></i> Belum Memilih</span>';
                            statusElement.html(statusHtml);
                        });
                    },
                    error: function() {
                        console.log('Error fetching voter status.');
                    }
                });
            }

            setInterval(fetchData, 5000);
        });
    </script>
