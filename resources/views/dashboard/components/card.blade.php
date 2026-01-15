<div class="row animate__animated animate__fadeIn">

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card shadow-lg border-0 h-100 py-2 hover-card card-custom">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-accent text-uppercase mb-1 tracking-wider">
                            Total Pemilih
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-white">{{ $totalVoters }}</div>
                        <div class="mt-2 mb-0 text-muted small">
                            <span class="text-nowrap opacity-75">Terdaftar dalam sistem</span>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="icon-circle-custom">
                            <i class="fas fa-users fa-2x text-accent"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card shadow-lg border-0 h-100 py-2 hover-card card-custom">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-accent text-uppercase mb-1 tracking-wider">
                            Partisipasi Pemilih
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-white">{{ $votersWhoVoted }}</div>
                        <div class="mt-2 mb-0 text-success-custom small">
                            <i class="fas fa-check-circle mr-1"></i> Sudah Memilih
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="icon-circle-custom">
                            <i class="fas fa-vote-yea fa-2x text-accent"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card shadow-lg border-0 h-100 py-2 hover-card card-custom">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-accent text-uppercase mb-1 tracking-wider">
                            Sisa Pemilih
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-white">{{ $votersNotVoted }}</div>
                        <div class="mt-2 mb-0 text-muted small">
                            <i class="fas fa-clock mr-1 text-warning"></i> Menunggu Memilih
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="icon-circle-custom">
                            <i class="fas fa-user-clock fa-2x text-accent"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
    /* Custom Theme Colors */
    :root {
        --midnight-blue: #2C3E50;
        --darker-midnight: #1A252F;
        --accent-red: #E74C3C;
    }

    .card-custom {
        background-color: var(--midnight-blue) !important;
        border-radius: 20px !important;
        border-left: 4px solid var(--accent-red) !important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3) !important;
    }

    .text-accent {
        color: var(--accent-red) !important;
    }

    .tracking-wider {
        letter-spacing: 1.5px;
    }

    .icon-circle-custom {
        height: 60px;
        width: 60px;
        background-color: var(--darker-midnight);
        border-radius: 15px; /* Boxy-round look */
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: inset 0 0 10px rgba(0,0,0,0.2);
    }

    .text-success-custom {
        color: #2ECC71 !important; /* Green for success but kept subtle */
        font-weight: 600;
    }

    .hover-card {
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .hover-card:hover {
        transform: translateY(-8px);
        background-color: #34495E !important; /* Slightly lighter on hover */
        box-shadow: 0 15px 35px rgba(231, 76, 60, 0.2) !important;
    }

    .text-xs {
        font-size: 0.7rem;
    }
</style>