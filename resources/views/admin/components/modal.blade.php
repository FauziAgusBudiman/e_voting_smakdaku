<div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true"
    data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-header border-0 pt-4 px-4">
                <div class="d-flex align-items-center">
                    <div class="bg-success-soft p-2 rounded-lg mr-3" style="background: rgba(28, 200, 138, 0.1);">
                        <i class="fas fa-user-shield text-success"></i>
                    </div>
                    <h5 class="modal-title font-weight-bold text-gray-800" id="addAdminModalLabel">Tambah Pengelola</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.store') }}" method="post" id="addAdminForm">
                @csrf
                <div class="modal-body px-4">
                    <div class="form-group mb-4">
                        <label class="text-xs font-weight-bold text-uppercase tracking-wider text-gray-500" style="font-size: 11px;">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control form-modern" placeholder="Nama admin..." required>
                    </div>
                    <div class="form-group mb-4">
                        <label class="text-xs font-weight-bold text-uppercase tracking-wider text-gray-500" style="font-size: 11px;">Alamat Email</label>
                        <input type="email" name="email" class="form-control form-modern" placeholder="admin@example.com" required>
                    </div>
                    <div class="form-group mb-4">
                        <label class="text-xs font-weight-bold text-uppercase tracking-wider text-gray-500" style="font-size: 11px;">KODE UNIK</label>
                        <input type="text" name="nisn" class="form-control form-modern" placeholder="123456781" required>
                    <div class="form-group mb-4">
                        <label class="text-xs font-weight-bold text-uppercase tracking-wider text-gray-500" style="font-size: 11px;">Password Akses</label>
                        <input type="password" name="password" class="form-control form-modern" placeholder="Buat password..." required>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="button" class="btn btn-light px-4 font-weight-bold text-gray-600" data-dismiss="modal" style="border-radius: 10px;">Batal</button>
                    <button type="submit" class="btn btn-success px-4 font-weight-bold shadow-sm" style="border-radius: 10px;">Simpan Admin</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editAdminModal" tabindex="-1" aria-labelledby="editAdminModalLabel" aria-hidden="true"
    data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-header border-0 pt-4 px-4">
                <div class="d-flex align-items-center">
                    <div class="bg-warning-soft p-2 rounded-lg mr-3" style="background: rgba(246, 194, 62, 0.1);">
                        <i class="fas fa-user-edit text-warning"></i>
                    </div>
                    <h5 class="modal-title font-weight-bold text-gray-800" id="editAdminModalLabel">Edit Data Pengelola</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editAdminForm" method="post" action="">
                @csrf
                @method('PUT')
                <div class="modal-body px-4">
                    <div class="form-group mb-4">
                        <label class="text-xs font-weight-bold text-uppercase tracking-wider text-gray-500" style="font-size: 11px;">Nama Lengkap</label>
                        <input type="text" name="name" id="editName" class="form-control form-modern" required>
                    </div>
                    <div class="form-group mb-4">
                        <label class="text-xs font-weight-bold text-uppercase tracking-wider text-gray-500" style="font-size: 11px;">Alamat Email</label>
                        <input type="email" name="email" id="editEmail" class="form-control form-modern" required>
                    </div>
                    <div class="form-group mb-4">
                        <label class="text-xs font-weight-bold text-uppercase tracking-wider text-gray-500" style="font-size: 11px;">NISN</label>
                        <input type="text" name="nisn" id="editNisn" class="form-control form-modern" placeholder="123456781" required>
                    </div>
                    <div class="form-group mb-2">
                        <label class="text-xs font-weight-bold text-uppercase tracking-wider text-gray-500" style="font-size: 11px;">Password Baru</label>
                        <input type="password" name="password" id="editPassword" class="form-control form-modern" placeholder="••••••••"required>
                    </div>
                    <small class="text-muted italic"><i class="fas fa-info-circle mr-1"></i> Gunakan Password Baru.</small>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="button" class="btn btn-light px-4 font-weight-bold text-gray-600" data-dismiss="modal" style="border-radius: 10px;">Batal</button>
                    <button type="submit" class="btn btn-warning px-4 font-weight-bold text-white shadow-sm" style="border-radius: 10px;">Perbarui Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
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
</style>

    <script>
        $(document).ready(function() {
    $('#editAdminModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var modal = $(this);

        // Reset password field everytime modal opens
        $('#editPassword').val('');

        $.ajax({
            url: '/admin/' + id + '/edit',
            type: 'GET',
            beforeSend: function() {
                $('#editName').val('Sedang memuat...');
            },
            success: function(data) {
                $('#editName').val(data.name);
                $('#editEmail').val(data.email);
                $('#editEmail').val(data.email);
                
                // Update dynamic URL action
                $('#editAdminForm').attr('action', '/admin/' + id);
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Gagal mengambil data pengelola.',
                });
                modal.modal('hide');
            }
        });
    });
});
    </script>
