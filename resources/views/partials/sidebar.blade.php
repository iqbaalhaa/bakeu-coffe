<nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
    <div class="sidebar-inner px-4 pt-3">

        {{-- User section untuk mobile --}}
        <div class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
            <div class="d-flex align-items-center">
                <div class="avatar-lg me-4">
                    <img src="{{ asset('backend/assets/img/team/profile-picture-3.jpg') }}"
                         class="card-img-top rounded-circle border-white"
                         alt="Admin">
                </div>
                <div class="d-block">
                    <h2 class="h5 mb-3">Hi, {{ auth()->user()->name ?? 'Admin' }}</h2>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-secondary btn-sm d-inline-flex align-items-center">
                            <svg class="icon icon-xxs me-1" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Sign Out
                        </button>
                    </form>
                </div>
            </div>
            <div class="collapse-close d-md-none">
                <a href="#sidebarMenu" data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
                   aria-controls="sidebarMenu" aria-expanded="true" aria-label="Toggle navigation">
                    <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
                    </svg>
                </a>
            </div>
        </div>

        <ul class="nav flex-column pt-3 pt-md-0">
            <li class="nav-item mb-3">
                <a href="{{ route('admin.dashboard') }}" class="nav-link d-flex align-items-center">
                    <span class="sidebar-icon">
                        <img src="{{ asset('backend/assets/img/brand/light.svg') }}" height="20" width="20" alt="Logo">
                    </span>
                    <span class="mt-1 ms-1 sidebar-text">Bakeu Coffee Admin</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <span class="sidebar-icon">
                        <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                            <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                        </svg>
                    </span>
                    <span class="sidebar-text">Dashboard</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('admin.profil_usaha.*') ? 'active' : '' }}">
                <a href="{{ route('admin.profil_usaha.edit') }}" class="nav-link">
                    <span class="sidebar-icon">
                        <i class="bi bi-shop"></i>
                    </span>
                    <span class="sidebar-text">Profil Usaha</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('admin.produk.*') ? 'active' : '' }}">
                <a href="{{ route('admin.produk.index') }}" class="nav-link">
                    <span class="sidebar-icon">
                        <i class="bi bi-cup-hot"></i>
                    </span>
                    <span class="sidebar-text">Produk</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('admin.media-sosial.*') ? 'active' : '' }}">
                <a href="{{ route('admin.media-sosial.index') }}" class="nav-link {{ request()->routeIs('admin.media-sosial.*') ? 'active' : '' }}">
                    <span class="sidebar-icon">
                        <i class="bi bi-share"></i>
                    </span>
                    <span class="sidebar-text">Media Sosial</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('admin.highlight.*') ? 'active' : '' }}">
                <a href="{{ route('admin.highlight.index') }}" class="nav-link {{ request()->routeIs('admin.highlight.*') ? 'active' : '' }}">
                    <span class="sidebar-icon">
                        <i class="bi bi-lightning-charge"></i>
                    </span>
                    <span class="sidebar-text">Highlight</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('admin.pesan-pengunjung.*') ? 'active' : '' }}">
                <a href="{{ route('admin.pesan-pengunjung.index') }}"
                    class="nav-link {{ request()->routeIs('admin.pesan-pengunjung.*') ? 'active' : '' }}">
                    <span class="sidebar-icon">
                        <i class="bi bi-envelope"></i>
                    </span>
                    <span class="sidebar-text">Pesan Pengunjung</span>
                </a>
            </li>

            {{-- Opsional: Highlight & Testimonial --}}
            <li class="nav-item {{ request()->routeIs('admin.highlight.*') ? 'active' : '' }}">
                <a href="{{ route('admin.highlight.index') }}" class="nav-link">
                    <span class="sidebar-icon">
                        <i class="bi bi-stars"></i>
                    </span>
                    <span class="sidebar-text">Highlight</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('admin.testimoni.*') ? 'active' : '' }}">
                <a href="{{ route('admin.testimoni.index') }}" class="nav-link">
                    <span class="sidebar-icon">
                        <i class="bi bi-chat-quote"></i>
                    </span>
                    <span class="sidebar-text">Testimoni</span>
                </a>
            </li>

            <li role="separator" class="dropdown-divider mt-4 mb-3 border-gray-700"></li>

            <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST" class="w-100">
                    @csrf
                    <button type="submit" class="btn btn-secondary d-flex align-items-center justify-content-center w-100">
                        <span class="sidebar-icon d-inline-flex align-items-center justify-content-center">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        </span>
                        <span>Logout</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>
