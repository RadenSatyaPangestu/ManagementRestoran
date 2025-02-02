<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container-fluid">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="d-none d-lg-block mx-auto">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}">Home</a>
                </li>
                @foreach ($breadcrumbs as $breadcrumb)
                    @if ($loop->last)
                        <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb['name'] }}</li>
                    @else
                        <li class="breadcrumb-item">
                            <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['name'] }}</a>
                        </li>
                    @endif
                @endforeach
            </ol>
        </nav>

        <div class="d-flex align-items-center">
            <!-- Notifikasi -->
            <div class="dropdown">
                <button class="btn btn-light position-relative me-3 dropdown-toggle" id="notificationDropdown" data-bs-toggle="dropdown">
                    <i class="fas fa-bell"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger {{ isset($lowStockCount) && $lowStockCount > 0 ? '' : 'd-none' }}">
                        {{ $lowStockCount ?? 0 }}
                    </span>
                </button>
                <ul class="dropdown-menu overflow-auto" style="max-height: 300px;" aria-labelledby="notificationDropdown">
                    <li class="dropdown-header">Notifikasi Stok Rendah</li>
                    <div id="notificationItems">
                        @if(isset($lowStockCount) && $lowStockCount > 0)
                            @foreach($lowStockItems ?? [] as $item)
                                <li class="dropdown-item">
                                    {{ $item->name }} - Stok: {{ $item->stock }}
                                </li>
                            @endforeach
                        @else
                            <li class="dropdown-item">Tidak ada barang dengan stok rendah.</li>
                        @endif
                    </div>
                </ul>
            </div>

            <!-- Profil Pengguna -->
            <div class="dropdown">
                <button class="btn btn-light d-flex align-items-center" type="button" id="profileButton" data-bs-toggle="dropdown">
                    <img src="{{ asset('/images/logo.png') }}" alt="Profil" class="rounded-circle me-2" height="30" width="30">
                    <span>Halo, User!</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" id="profileDropdown">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-user-circle me-2"></i> Profil</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Pengaturan</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">
                            @csrf
                        </form>
                        <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
