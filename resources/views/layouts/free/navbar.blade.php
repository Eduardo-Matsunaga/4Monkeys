<div id="content-wrapper" class="d-flex flex-column">
    <!-- Banner de Assinatura Premium -->
    <div class="bg-purple-500 text-white py-2 px-4 text-center fixed w-full top-0 z-50">
        <span class="text-lg font-semibold">Assine a versão Premium e tenha acesso a recursos exclusivos!</span>
        <!-- Atualizado para o novo formato do Bootstrap 5 -->
        <a href="{{url('register')}}" class="ml-4 text-yellow-400 hover:text-yellow-300" >Assinar</a>
        <a href="{{url('login')}}" class="ml-4 text-yellow-400 hover:text-yellow-300" >Ja possui uma conta?</a>
    </div>

    <nav class="bg-white shadow navbar navbar-expand navbar-light topbar static-top mt-11">
        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="mr-3 btn btn-link d-md-none rounded-circle">
            <i class="fa fa-bars"></i>
        </button>
        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Topbar Search -->
        <div class="my-2 mr-auto d-none d-sm-inline-block form-inline ml-md-3 my-md-0 mw-100 navbar-search">
            <i class="fa-sharp fa-regular fa-monkey"></i>
            <div class="input-group">
                <img src="http://127.0.0.1:8000/images/logoEsc.jpg" class="w-40 " alt="Logo Login">
            </div>
        </div>
        <i class="fa-sharp fa-regular fa-monkey"></i>

        <!-- Topbar Navbar -->
        <ul class="ml-auto navbar-nav">
            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow d-sm-none">
                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-search fa-fw"></i>
                </a>

                <div class="p-3 shadow dropdown-menu dropdown-menu-right animated--grow-in"
                    aria-labelledby="searchDropdown">
                    <form class="mr-auto form-inline w-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="border-0 form-control bg-light small"
                                placeholder="Search for..." aria-label="Search"
                                aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
            <div class="topbar-divider d-none d-sm-block"></div>
        </ul>
    </nav>

    <!-- Modal de Informações do Usuário Premium -->
    <div class="modal fade" id="premiumModal" tabindex="-1" role="dialog" aria-labelledby="premiumModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="premiumModalLabel">Informações do Usuário Premium</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Conteúdo da Modal -->
                    <p>Informações detalhadas sobre o usuário premium aparecerão aqui.</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Scripts do Bootstrap 5 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
