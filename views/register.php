<link rel="stylesheet" href="css/login.css">
<form method="POST">
    <div class="login-container">
        <h2>Registrate</h2>
        <form action="#">
            <div class="row">
                <input type="text" placeholder="Nombre" name="name" required>
            </div>
            <div class="row">
                <input type="text" placeholder="Correo Electrónico" name="email" required>
            </div>
            <div class="row">
                <input type="password" placeholder="Contraseña" name="password" required>
            </div>
            <div class="row button">
                <input type="submit" value="Registrarse">
            </div>
            <p class="message">Ya estas registrado? <a href="login.php">Inicia Sesión</a></p>
        </form>
    </div>