<link rel="stylesheet" href="css/login.css">
<form method="POST">

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
            <h2>Registrate</h2>
            <form method="POST" action="register.php">
                <div class="row">
                    <input type="text" placeholder="Usuario" name="name">
                </div>
                <div class="row">
                    <input type="email" placeholder="Correo Electrónico" name="email">
                </div>
                <div class="row">
                    <input type="password" placeholder="Contraseña" name="password">
                </div>
                <div class="row">
                    <input type="text" placeholder="Nombre" name="nombre">
                </div>
                <div class="row">
                    <input type="text" placeholder="Apellido" name="apellido">
                </div>
                <div class="row">
                    <input type="text" placeholder="Edad" name="edad">
                </div>
                <div class="row">
                    <input type="text" placeholder="Escuela" name="escuela">
                </div>
                <div class="row button">
                    <input type="submit" value="Registrarse">
                </div>
                <p class="message">¿Ya estás registrado? <a href="login.php">Inicia Sesión</a></p>
            </form>
        </div>
    </div>