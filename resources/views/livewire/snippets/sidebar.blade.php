<div class="sidebar close">
    <div class="logo-details">
        <img src="{{ asset($profile->takeImage) }}" class="w-10 mx-3" alt="">
        <span class="logo_name hover:text-emerald-400"><a
                href="{{ route('profile-koperasi') }}">{{ $profile->nama_koperasi }}</a></span>
    </div>
    <ul class="nav-links">
        <li>
            <a href="{{ route('dashboard') }}">
                <i class='bx bx-grid-alt'></i>
                <span class="link_name">Dashboard</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="#">Dashboard</a></li>
            </ul>
        </li>
        <li>
            <div class="iocn-link">
                <a href="#">
                    <i class='bx bx-collection'></i>
                    <span class="link_name">Master Data</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Master Data</a></li>
                <li><a href="{{ route('data-pinjaman') }}">Data Pinjaman</a></li>
                @can('lihat anggota')
                    <li><a href="{{ route('anggota-koperasi') }}">Anggota Koperasi</a></li>
                @endcan
                @can('lihat akun petugas')
                    <li><a href="{{ route('petugas') }}">Petugas</a></li>
                @endcan
            </ul>
        </li>

        <li>
            <div class="iocn-link">
                <a href="#">
                    <i class="bi bi-wallet"></i>
                    <span class="link_name">Transaksi</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Transaksi</a></li>
                <li><a href="{{ route('pinjaman-anggota') }}">Pinjaman Anggota</a></li>
                <li><a href="{{ route('simpanan-anggota') }}">Simpanan Anggota</a></li>
            </ul>
        </li>
        <li>
            <div class="iocn-link">
                <a href="#">
                    <i class='bx bx-history'></i>
                    <span class="link_name">History</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">History</a></li>
                <li><a href="{{ route('histori-penarikan-simpanan') }}">Penarikan Simpanan</a></li>
                <li><a href="{{ route('histori-pembayaran-pinjaman') }}">Pembayaran Pinjaman</a></li>
            </ul>
        </li>
        @if ($checkRole == 'petugas' or $checkRole == 'super admin')
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class='bx bx-cog'></i>
                        <span class="link_name">Setting</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Setting</a></li>
                    <li><a href="{{ route('home-setting') }}">Home Setting</a></li>
                    <li><a href="{{ route('about-setting') }}">About Setting</a></li>
                    <li><a href="{{ route('galery-setting') }}">Galery Setting</a></li>
                    <li><a href="{{ route('iklan-setting') }}">Iklan Setting</a></li>
                    <li><a href="{{ route('pekerjaan') }}">Jenis Pekerjaan</a></li>

                </ul>
            </li>
        @endif
        {{-- <li>
            <div class="iocn-link">
                <a href="#">
                    <i class='bx bx-user'></i>
                    <span class="link_name">Jabatan</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Jabatan</a></li>
                @if ($checkRole == 'petugas' or $checkRole == 'super admin')
                    <li><a href="{{ route('jabatan') }}">Setting Jabatan</a></li>
                @endif
                <li><a href="{{ route('about-setting') }}">Jabatan Anggota</a></li>

            </ul>
        </li> --}}
        @if ($checkRole == 'petugas' or $checkRole == 'super admin')
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class='bx bx-compass'></i>
                        <span class="link_name">Artikel</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Artikel</a></li>
                    <li><a href="{{ route('admin-artikel') }}">Artikel</a></li>
                    <li><a href="">Kategori</a></li>

                </ul>
            </li>
        @endif
        <li>
            <div class="iocn-link">
                <a href="#">
                    <i class='bx bx-message'></i>
                    <span class="link_name">Pesan</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Pesan</a></li>
                @if (auth()->user()->hasRole('petugas') or
                    auth()->user()->hasRole('super admin'))
                    <li><a href="{{ route('manage-komentar') }}">Komentar</a></li>
                    <li><a href="{{ route('manage-kontak-kami') }}">Kontak Kami</a></li>
                @endif
                <li><a href="{{ route('manage-testimoni') }}">Testimoni</a></li>

            </ul>
        </li>
        {{-- <li>
            <a href="#">
                <i class='bx bx-compass'></i>
                <span class="link_name">Explore</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="#">Explore</a></li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-history'></i>
                <span class="link_name">History</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="#">History</a></li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-cog'></i>
                <span class="link_name">Setting</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="#">Setting</a></li>
            </ul>
        </li>
        <li> --}}
        <div class="profile-details">
            <div class="profile-content">
                <!--<img src="image/profile.jpg" alt="profileImg">-->
            </div>
            <div class="name-job">
                <div class="profile_name">{{ auth()->user()->username }}</div>
                <div class="job"><a href="{{ route('profile-user') }}">Setting</a></div>
            </div>
            <i class='bx bx-log-out'></i>
        </div>
        </li>
    </ul>
</div>
