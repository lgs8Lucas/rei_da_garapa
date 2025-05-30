<?php
class userView
{
    public function showRegisterForm()
    {
        echo '
        <div class="container mt-3">
            <h1>Cadastro de Usuário</h1>
            <form method="post">
            <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="mb-3">
                    <label for="pass" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="pass" name="pass">
                </div>
                <div class="mb-3">
                    <label for="confirmPass" class="form-label">Confirmar Senha</label>
                    <input type="password" class="form-control" id="confirmPass" name="confirmPass">
                </div>
                <button type="submit" class="btn btn-primary">Criar Conta</button>
                <p class="mt-2">Já tem uma conta? <a href="./../pages/loginPage.php">Faça login</a></p>
            </form>
        </div>
    ';
    }

    public function showLoginForm()
    {
        echo '
        <div class="container mt-3">
            <h1>Login</h1>
            <form method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="mb-3">
                    <label for="pass" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="pass" name="pass">
                </div>
                <button type="submit" class="btn btn-primary">Entrar</button>
                <p class="mt-2">Ainda não tem uma conta?<a href="./../pages/registerPage.php">Registre-se</a></p>
            </form>
        </div>
    ';
    }
}
