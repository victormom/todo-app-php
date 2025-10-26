<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container">
    <div class="header-section">
        <div>
            <h1>Mis Tareas</h1>
            <p>Bienvenido, <strong><?= $_SESSION['username'] ?></strong></p>
        </div>
        <div class="header-actions">
            <a href="/index.php?action=create-task" class="btn btn-primary">+ Nueva Tarea</a>
            <a href="/index.php?action=logout" class="btn btn-secondary">Cerrar Sesión</a>
        </div>
    </div>
    
    <?php if(isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>
    
    <?php if(isset($_SESSION['errors'])): ?>
        <div class="alert alert-error">
            <?php foreach($_SESSION['errors'] as $error): ?>
                <p><?= $error ?></p>
            <?php endforeach; ?>
            <?php unset($_SESSION['errors']); ?>
        </div>
    <?php endif; ?>
    
    <!-- Estadísticas -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-value"><?= $stats['total'] ?? 0 ?></div>
            <div class="stat-label">Total</div>
        </div>
        <div class="stat-card pending">
            <div class="stat-value"><?= $stats['pending'] ?? 0 ?></div>
            <div class="stat-label">Pendientes</div>
        </div>
        <div class="stat-card progress">
            <div class="stat-value"><?= $stats['in_progress'] ?? 0 ?></div>
            <div class="stat-label">En Progreso</div>
        </div>
        <div class="stat-card completed">
            <div class="stat-value"><?= $stats['completed'] ?? 0 ?></div>
            <div class="stat-label">Completadas</div>
        </div>
    </div>
    
    <!-- Lista de Tareas -->
    <div class="tasks-section">
        <?php if(empty($tasks)): ?>
            <div class="empty-state">
                <h3>No tienes tareas</h3>
                <p>Comienza creando tu primera tarea</p>
                <a href="/index.php?action=create-task" class="btn btn-primary">Crear Tarea</a>
            </div>
        <?php else: ?>
            <div class="tasks-grid">
                <?php foreach($tasks as $task): ?>
                    <div class="task-card priority-<?= $task['priority'] ?> status-<?= $task['status'] ?>">
                        <div class="task-header">
                            <span class="task-priority"><?= ucfirst($task['priority']) ?></span>
                            <span class="task-status"><?= str_replace('_', ' ', ucfirst($task['status'])) ?></span>
                        </div>
                        
                        <h3><?= htmlspecialchars($task['title']) ?></h3>
                        
                        <?php if($task['description']): ?>
                            <p class="task-description"><?= nl2br(htmlspecialchars($task['description'])) ?></p>
                        <?php endif; ?>
                        
                        <?php if($task['due_date']): ?>
                            <div class="task-date">
                                <span>📅 Vence: <?= date('d/m/Y', strtotime($task['due_date'])) ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <div class="task-actions">
                            <a href="/index.php?action=edit-task&id=<?= $task['id'] ?>" class="btn btn-small btn-primary">Editar</a>
                            <a href="/index.php?action=delete-task&id=<?= $task['id'] ?>" 
                               class="btn btn-small btn-danger" 
                               onclick="return confirm('¿Estás seguro de eliminar esta tarea?')">Eliminar</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
