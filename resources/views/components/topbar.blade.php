<nav class="navbar navbar-expand navbar-dark topbar mb-4 static-top shadow" style="background-color: #2C3E50; border-bottom: 2px solid #E74C3C;">
    
    @cannot('is-voter')
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3" aria-label="Toggle Sidebar" style="color: #E74C3C;">
            <i class="fa fa-bars"></i>
        </button>
    @endcannot

    <div class="d-none d-sm-block ml-3">
        <span style="color: #E74C3C; font-weight: 900; font-style: italic; letter-spacing: 1px; font-size: 0.8rem; text-transform: uppercase;">
            E-Voting <span class="text-white">SMAKDAKU</span>
        </span>
    </div>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <div style="display: grid; grid-template-columns: 1fr auto; max-width: 300px; align-items: center;">
                    <div class="text-right mr-3 mt-1">
                        <span class="d-none d-lg-inline text-white small font-weight-bold"
                            style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; display: block; line-height: 1.2;">
                            {{ \Str::limit(auth()->user()->name, 15) }}
                        </span>
                        <small style="color: #E74C3C; font-weight: 800; text-transform: uppercase; font-size: 0.65rem; letter-spacing: 0.5px;">
                            {{ ['admin' => 'Administrator', 'voter' => 'Voter Digital'][auth()->user()->role] ?? 'Voter Digital' }}
                        </small>
                    </div>
                    <div class="profile-img-container" style="border: 2px solid #E74C3C; border-radius: 50%; padding: 2px;">
                        <img class="img-profile rounded-circle" alt="profile icon"
                            src="{{ asset('template/img/undraw_profile.svg') }}" style="width: 32px; height: 32px;">
                    </div>
                </div>
            </a>

            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" 
                 aria-labelledby="userDropdown" 
                 style="background-color: #1A252F; border: 1px solid #2C3E50; border-top: 3px solid #E74C3C;">
                <a class="dropdown-item py-3" href="#" data-toggle="modal" data-target="#logoutModal" style="color: #ECF0F1;">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-3" style="color: #E74C3C;"></i>
                    <span class="font-weight-bold uppercase" style="font-size: 0.75rem; letter-spacing: 1px;">KELUAR SESI</span>
                </a>
            </div>
        </li>
    </ul>
</nav>

<a class="scroll-to-top rounded" href="#page-top" style="background-color: #E74C3C; color: white;">
    <i class="fas fa-angle-up"></i>
</a>

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #2C3E50; border: none; border-radius: 15px; overflow: hidden;">
            <div class="modal-header text-white" style="border-bottom: 2px solid #1A252F;">
                <h5 class="modal-title font-weight-black italic" id="exampleModalLabel" style="font-style: italic; font-weight: 900; letter-spacing: -0.5px;">
                    KONFIRMASI <span style="color: #E74C3C;">LOGOUT</span>
                </h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body py-4 text-center" style="color: #bdc3c7;">
                <i class="fas fa-exclamation-circle fa-3x mb-3" style="color: #E74C3C;"></i>
                <p class="mb-0 font-weight-bold">Pilih tombol "Keluar" jika anda ingin mengakhiri sesi pemungutan suara ini.</p>
            </div>
            <div class="modal-footer px-4 pb-4" style="border-top: none;">
                <button class="btn btn-link text-decoration-none font-weight-bold" type="button" data-dismiss="modal" style="color: #bdc3c7;">Batal</button>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn px-4 font-weight-black" 
                            style="background-color: #E74C3C; color: white; border-radius: 8px; text-transform: uppercase; letter-spacing: 1px; font-size: 0.8rem;">
                        Keluar Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .dropdown-item:hover {
        background-color: #2C3E50 !important;
        color: #E74C3C !important;
    }
</style>