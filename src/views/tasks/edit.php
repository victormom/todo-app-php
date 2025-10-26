<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container">
    <div class="form-container">
        <div class="form-header">
            <h1>Editar Tarea</h1>
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
        
        <form method="POST" action="/index.php?action=edit-task&id=<?= $task['id'] ?>" class="task-form">
            <div class="form-group">
                <label for="title">Título *</label>
                <input type="text" id="title" name="title" required value="<?= htmlspecialchars($task['title']) ?>">
            </div>
            
            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea id="description" name="description" rows="4"><?= htmlspecialchars($task['description']) ?></textarea>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="status">Estado</label>
                    <select id="status" name="status">
                        <option value="pending" <?= $task['status'] === 'pending' ? 'selected' : '' ?>>Pendiente</option>
                        <option value="in_progress" <?= $task['status'] === 'in_progress' ? 'selected' : '' ?>>En Progreso</option>
                        <option value="completed" <?= $task['status'] === 'completed' ? 'selected' : '' ?>>Completada</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="priority">Prioridad</label>
                    <select id="priority" name="priority">
                        <option value="low" <?= $task['priority'] === 'low' ? 'selected' : '' ?>>Baja</option>
                        <option value="medium" <?= $task['priority'] === 'medium' ? 'selected' : '' ?>>Media</option>
                        <option value="high" <?= $task['priority'] === 'high' ? 'selected' : '' ?>>Alta</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="due_date">Fecha de Vencimiento</label>
                <input type="date" id="due_date" name="due_date" value="<?= $task['due_date'] ?>">
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Actualizar Tarea</button>
                <a href="/index.php?action=tasks" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
