@extends('layouts.app')

@section('title', 'Dashboard')

@section('body-class', 'hold-transition sidebar-mini')

@section('content')
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
    </nav>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="/" class="brand-link text-center">
            <span class="brand-text font-weight-light">STS</span>
        </a>
        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <span class="d-block text-bold text-white">{{ Auth::user()->name }}</span>
                </div>
            </div>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <router-link to="/dashboard" class="nav-link">
                            <i class="fa fa-tachometer-alt nav-icon" aria-hidden="true"></i>
                            <p>Dashboard</p>
                        </router-link>
                    </li>
                    @if (Auth::user()->user_type == "Admin")
                        <li class="nav-item">
                        <router-link to="/data-krani" class="nav-link">
                            <i class="fas fa-users nav-icon" aria-hidden="true"></i>
                            <p>Data Krani</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/data-kendaraan" class="nav-link">
                            <i class="fas fa-truck nav-icon" aria-hidden="true"></i>
                            <p>Data Kendaraan</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/data-supir" class="nav-link">
                            <i class="fas fa-users nav-icon" aria-hidden="true"></i>
                            <p>Data Supir</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/bongkar-muat" class="nav-link">
                            <i class="fas fa-tasks nav-icon" aria-hidden="true"></i>
                            <p>Input Bongkar Muat</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/laporan-bongkar-muat" class="nav-link">
                            <i class="fas fa-file-alt nav-icon" aria-hidden="true"></i>
                            <p>Laporan Bongkar dan Muat Kontainer</p>
                        </router-link>
                    </li>
                    @endif
                    @if (Auth::user()->user_type == "Krani")
                        <li class="nav-item">
                        <router-link to="/data-bongkar-muat" class="nav-link">
                            <i class="fas fa-tasks nav-icon" aria-hidden="true"></i>
                            <p>Data Bongkar dan Muat Kontainer</p>
                        </router-link>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();" data-toggle="tooltip" data-placement="bottom"
                            title="Logout">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>
                                Log Out
                            </p>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
    <router-view></router-view>
    <footer class="main-footer">
        <strong>Copyright &copy; 2022.</strong> All rights reserved.
    </footer>
</div>
@endsection
