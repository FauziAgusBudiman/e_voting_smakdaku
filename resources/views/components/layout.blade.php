<!DOCTYPE html>
<html lang="en">

<x-header>{{ $title }}</x-header>

<head>
    <style>
        /* Sidebar Styling */
        #accordionSidebar {
            background: linear-gradient(180deg, #1A252F 0%, #2C3E50 100%) !important;
            border-right: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* Sidebar Brand */
        .sidebar-brand {
            background-color: #1A252F;
            border-bottom: 2px solid #E74C3C;
            margin-bottom: 1rem;
        }

        .sidebar-brand-text {
            font-weight: 900 !important;
            font-style: italic;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        /* Nav Items Custom Styling */
        .nav-item .nav-link {
            transition: all 0.3s ease;
            margin: 5px 15px;
            border-radius: 10px;
            padding: 0.8rem 1rem !important;
        }

        /* Active State */
        .nav-item.active .nav-link {
            background-color: #E74C3C !important;
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.4);
        }

        .nav-item.active .nav-link i,
        .nav-item.active .nav-link span {
            color: white !important;
            font-weight: 800 !important;
        }

        /* Hover State */
        .nav-item .nav-link:hover {
            background-color: rgba(231, 76, 60, 0.1);
        }

        .nav-item .nav-link:hover i {
            color: #E74C3C !important;
            transform: scale(1.1);
        }

        /* Divider & Heading */
        .sidebar-divider {
            border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
        }

        .sidebar-heading {
            font-weight: 800 !important;
            color: #E74C3C !important;
            opacity: 0.8;
            letter-spacing: 2px;
            font-size: 0.65rem !important;
            text-transform: uppercase;
        }

        /* Content Wrapper Background */
        #content-wrapper {
            background-color: #1A252F !important;
        }

        /* Sidebar Toggle Button */
        #sidebarToggle {
            background-color: #2C3E50;
            border: 1px solid #E74C3C !important;
        }

        #sidebarToggle:hover {
            background-color: #E74C3C;
        }
    </style>
</head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-vote-yea fa-2x" style="color: #E74C3C;"></i>
                </div>
                <div class="sidebar-brand-text mx-3">E-Voting</div>
            </a>

            <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="/dashboard">
                    <i class="fas fa-fw fa-chart-area fa-lg"></i>
                    <span class="sidebar-text">Dashboard</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                User Data
            </div>

            <li class="nav-item {{ request()->is('candidate') ? 'active' : '' }}">
                <a class="nav-link" href="/candidate">
                    <i class="fas fa-users fa-lg"></i>
                    <span class="sidebar-text">Kandidat</span>
                </a>
            </li>

            <li class="nav-item {{ request()->is('voters') ? 'active' : '' }}">
                <a class="nav-link" href="/voters">
                    <i class="fas fa-person-booth fa-lg"></i>
                    <span class="sidebar-text">Pemilih</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Kelola
            </div>

            <li class="nav-item {{ request()->is('admin') ? 'active' : '' }}">
                <a class="nav-link" href="/admin">
                    <i class="fas fa-user-lock fa-lg"></i>
                    <span class="sidebar-text">Admin</span>
                </a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <x-topbar></x-topbar>

                <div class="container-fluid">
                    {{ $slot }}
                </div>
                </div>
            <x-footer></x-footer>

        </div>
        </div>
    </body>
</html>