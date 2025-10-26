<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container">
    <div class="form-container">
        <div class="form-header">
            <h1>Nueva Tarea</h1>
            <a href="/index.php?action=tasks" class="btn btn-secondary">← Volver</a>
        </div>
        
        <?php if(isset($_SESSION['errors'])): ?>
            <div class="alert alert-error">
                <?php foreach($_SESSION['errors'] as $error): ?>
                    <p><?= $error ?></p>
                <?php endforeach; ?>
                <?php unset($_SESSION['errors']); ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="/index.php?action=create-task" class="task-form">
            <div class="form-group">
                <label for="title">Título *</label>
                <input type="text" id="title" name="title" required placeholder="Ej: Completar proyecto PHP">
            </div>
            
            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea id="description" name="description" rows="4" placeholder="Describe los detalles de la tarea..."></textarea>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="status">Estado</label>
                    <select id="status" name="status">
                        <option value="pending">Pendiente</option>
                        <option value="in_progress">En Progreso</option>
                        <option value="completed">Completada</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="priority">Prioridad</label>
                    <select id="priority" name="priority">
                        <option value="low">Baja</option>
                        <option value="medium" selected>Media</option>
                        <option value="high">Alta</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="due_date">Fecha de Vencimiento</label>
                <input type="date" id="due_date" name="due_date">
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Crear Tarea</button>
                <a href="/index.php?action=tasks" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
