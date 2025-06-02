<?php
class mainView
{
    public function showNavbar($page)
    {
        // Verifica sessão
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (($page != 'login' && $page != 'register') && !isset($_SESSION['user_id'])) {
            header('Location: ./../pages/loginPage.php');
            exit();
        }
        echo '
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Rei da Garapa</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                        <a class="nav-link ' . ($page == 'insertProduct' ? 'active' : '') . '" aria-current="page" href="./../pages/createProductPage.php">Cadastrar Produto</a>
                        </li>

                        <li class="nav-item">
                        <a class="nav-link ' . ($page == 'products' ? 'active' : '') . '" aria-current="page" href="./../pages/productsPage.php">Produtos</a>
                        </li>
                        
                        <li class="nav-item">
                        <a class="nav-link ' . ($page == 'salesReport' ? 'active' : '') . '" aria-current="page" href="./../pages/salesReportPage.php">Vendas</a>
                        </li>
                        
                    </ul>
                    ' . (
            isset($_SESSION['user_id']) ?
            '<form class="d-flex" role="search">
                            <button class="btn btn-outline-danger" type="button" onclick="window.location.href=\'./../controller/logoutController.php\'">Sair</button>
                        </form>' :
            '<form class="d-flex" role="search">
                            <button class="btn btn-outline-success" type="button" onclick="window.location.href=\'./../pages/loginPage.php\'">Entrar</button>
                        </form>'
        ) . '
                    </div>
                </div>
            </nav>
        
        ';
    }

    public function showAllert($message)
    {
        echo '<script>
            alert("' . htmlspecialchars($message) . '");
        </script>';
    }
}
