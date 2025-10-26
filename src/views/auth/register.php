<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="auth-container">
    <div class="auth-card">
        <h1>Registro</h1>
        
        <?php if(isset($_SESSION['errors'])): ?>
            <div class="alert alert-error">
                <?php foreach($_SESSION['errors'] as $error): ?>
                    <p><?= $error ?></p>
                <?php endforeach; ?>
                <?php unset($_SESSION['errors']); ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="/index.php?action=register">
            <div class="form-group">
                <label for="username">Nombre de Usuario</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Confirmar Contraseña</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Registrarse</button>
        </form>
		<p class="auth-link">
    			¿Ya tienes cuenta? <a href="/index.php?action=login">Inicia Sesión</a>
		</p>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
