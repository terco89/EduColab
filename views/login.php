<link rel="stylesheet" href="css/login.css">
<style>
    .login-image{
        display: block;
        margin: 0 auto;
        max-width: 50%;
        height: auto;
    }
</style>
<div class="login-container-wrapper">
        <div class="alert-container">
            <?php if (!empty($errors)): ?>
                <?php foreach ($errors as $error): ?>
                    <div class="alert3">
                        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                        <?php echo $error; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="login-container">
        <img src ="img/fondos/confesuiza.png" alt = "logo" class = "login-image">
            <h2>Inicia Sesión</h2>
            <form method="POST" action="login.php">
                <div class="row">
                    <input type="text" placeholder="Nombre de usuario" name="name" >
                </div>
                <div class="row">
                    <input type="password" placeholder="Contraseña" name="password" >
                </div>
                <div class="row button">
                    <input type="submit" value="Iniciar Sesión">
                </div>
                <p class="message">¿No tienes cuenta? <a href="register.php">Regístrate</a></p>
            </form>
        </div>
    </div>