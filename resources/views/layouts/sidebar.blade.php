<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">


    {{-- Brand --}}
    <div class="sidebar-brand">

        <a href="{{ url('/') }}" class="brand-link">

            <i class="bi bi-folder-fill brand-image"></i>

            <span class="brand-text fw-light">
                Gecamine
            </span>

        </a>

    </div>



    {{-- Sidebar Menu --}}
    <div class="sidebar-wrapper">

        <nav class="mt-2">

            <ul class="nav sidebar-menu flex-column">



                {{-- Dashboard --}}
                <li class="nav-item">

                    <a href="{{ url('/') }}"
                       class="nav-link {{ request()->is('/') ? 'active' : '' }}">

                        <i class="nav-icon bi bi-speedometer2"></i>

                        <p>
                            Dashboard
                        </p>

                    </a>

                </li>



                {{-- Dossiers --}}
                <li class="nav-item">

                    <a href="{{ route('folder.index') }}"
                       class="nav-link {{ request()->is('folders*') ? 'active' : '' }}">

                        <i class="nav-icon bi bi-folder-fill"></i>

                        <p>
                            Dossiers
                        </p>

                    </a>

                </li>



                {{-- Employés --}}
                <li class="nav-item">

                    <a href="{{ route('employee.index') }}"
                       class="nav-link {{ request()->is('employees*') ? 'active' : '' }}">

                        <i class="nav-icon bi bi-people-fill"></i>

                        <p>
                            Employés
                        </p>

                    </a>

                </li>



                {{-- Paramètres --}}
                <li class="nav-item">

                    <a href="#"
                       class="nav-link">

                        <i class="nav-icon bi bi-gear-fill"></i>

                        <p>
                            Paramètres
                        </p>

                    </a>

                </li>



                <li class="nav-header">
                    SYSTEME
                </li>



                {{-- Info --}}
                <li class="nav-item">

                    <a href="#"
                       class="nav-link">

                        <i class="nav-icon bi bi-info-circle-fill"></i>

                        <p>
                            À propos
                        </p>

                    </a>

                </li>


            </ul>

        </nav>

    </div>


</aside>
