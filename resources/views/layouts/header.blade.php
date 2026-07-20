<nav class="app-header navbar navbar-expand bg-body">

    <div class="container-fluid">


        <!-- Gauche -->
        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#">
                    <i class="bi bi-list"></i>
                </a>
            </li>


            <li class="nav-item d-none d-md-block">
                <a href="" class="nav-link">
                    Dashboard
                </a>
            </li>


            <li class="nav-item d-none d-md-block">
                <a href="{{ route('folder.index') }}" class="nav-link">
                    Dossiers
                </a>
            </li>


        </ul>



        <!-- Droite -->
        <ul class="navbar-nav ms-auto">


            <!-- Recherche -->
            <li class="nav-item">

                <a class="nav-link" href="#">
                    <i class="bi bi-search"></i>
                </a>

            </li>



            <!-- Notification -->
            <li class="nav-item dropdown">

                <a class="nav-link" data-bs-toggle="dropdown" href="#">

                    <i class="bi bi-bell-fill"></i>

                    <span class="navbar-badge badge text-bg-danger">
                        3
                    </span>

                </a>


                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">


                    <span class="dropdown-item dropdown-header">
                        3 Notifications
                    </span>


                    <div class="dropdown-divider"></div>


                    <a href="#" class="dropdown-item">

                        <i class="bi bi-folder-fill me-2"></i>
                        Nouveau dossier ajouté

                        <span class="float-end text-secondary fs-7">
                            5 min
                        </span>

                    </a>


                    <div class="dropdown-divider"></div>


                    <a href="#" class="dropdown-item">

                        <i class="bi bi-person-fill me-2"></i>
                        Nouvel employé

                        <span class="float-end text-secondary fs-7">
                            1h
                        </span>

                    </a>


                </div>

            </li>





            <!-- Profil -->
            <li class="nav-item dropdown user-menu">


                <a href="#" class="nav-link dropdown-toggle"
                   data-bs-toggle="dropdown">


                    <img
                        src="{{ asset('assets/img/user2-160x160.jpg') }}"
                        class="user-image rounded-circle shadow"
                    />


                    <span class="d-none d-md-inline">
                        Admin
                    </span>


                </a>



                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">


                    <li class="user-header text-bg-primary">


                        <img
                            src="{{ asset('assets/img/user2-160x160.jpg') }}"
                            class="rounded-circle shadow"
                        />


                        <p>
                            Administrateur

                            <small>
                                Gestion des dossiers
                            </small>

                        </p>


                    </li>



                    <li class="user-footer">

                        <a href="#" class="btn btn-default btn-flat">
                            Profil
                        </a>


                        <a href="#" class="btn btn-default btn-flat float-end">
                            Déconnexion
                        </a>


                    </li>


                </ul>


            </li>



        </ul>


    </div>

</nav>
