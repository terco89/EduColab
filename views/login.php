<link rel="stylesheet" href="css/login.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
<form method="POST">
    <div class="container">
        <div class="wrapper">
            <div class="title"><span>Inicia Sesión</span></div>
            <form action="#">
                <div class="row">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="Nombre de usuario" name="name" required>
                </div>
                <div class="row">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Contraseña" name="password"required>
                </div>
                <div class="row button">
                    <input type="submit" value="Iniciar Sesion">
                </div>
                <div class="signup-link"><a href="register.php">Registrate</a></div>
            </form>
        </div>
    </div>