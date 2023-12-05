<div class="wrapper"> <!-- MENU DE LOGIN -->
        <span class="icon-close"><ion-icon name="close-outline"></ion-icon></span>

        <div class="form-box login">
            <h2>Login</h2>
            <form action="" method="post">
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                    <input type="email" name="lemail" required autocomplete= "off">
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                    <input type="password" name="lcontra" required autocomplete= "off">
                    <label>Contraseña</label>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox">Recordarme</label>
                    <a href="#" id="olvideContra">¿Olvidaste tu contraseña?</a>
                </div>
                <input type="submit" name="btnIngresar" class="btnLog" value="Login">
                <div class="login-register">
                    <p>¿No tenes una cuenta?<a href="#" class="register-link">Registrate</a></p>
                </div>

            </form>
        </div>

        <div class="form-box register">
            <h2>Registrate</h2>
            <form action="tiendaLogOut.php" method="post">
                <div class="input-box">
                    <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                    <input type="text" name="rnombre" required>
                    <label>Nombre</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                    <input type="text" name="rapellido" required>
                    <label>Apellido</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                    <input type="email" name="remail" required>
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                    <input type="password" name="rcontra" required>
                    <label>Contraseña</label>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox" required>Acepto los terminos y condiciones</label>
                </div>
                <input type="submit" name="btnReg" class="btnLog" value="Registrarse">
                <div class="login-register">
                    <p>¿Ya tenes una cuenta?<a href="#" class="login-link">Logueate</a></p>
                </div>

            </form>
        </div>

        <div class="form-box reestablecerClave">
            <h2>Reestablecer Clave</h2>
            <form method="post" action="">
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                    <input type="email" name="usuEmail" required autocomplete= "off">
                    <label for="usuEmail">Email:</label>
                </div>
                <input type="submit" value="Enviar" class="btnLog" name="reestablecerClave">
                <div class="login-register">
                    <p>¿Ya tenes una cuenta?<a href="#" id="loginOlvideContra">Logueate</a></p>
                </div>
            </form>
        </div>

     </div>