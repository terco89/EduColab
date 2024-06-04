<link rel="stylesheet" href="css/login.css">
<form method="POST">
    <div class="login-container">
        <h2>Inicia Sesión</h2>
        <form action="#">
            <div class="row">
                <input type="text" placeholder="Nombre de usuario" name="name" required>
            </div>
            <div class="row">
                <input type="password" placeholder="Contraseña" name="password" required>
            </div>
            <div class="row button">
                <input type="submit" value="Iniciar Sesión">
            </div>
            <p class="message">No tienes cuenta? <a href="register.php">Registrate</a></p>
        </form>
    </div>