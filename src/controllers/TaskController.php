<?php
// src/controllers/TaskController.php

class TaskController {
    private $db;
    private $task;

    public function __construct($db) {
        $this->db = $db;
        $this->task = new Task($db);
    }

    public function index() {
        $this->requireAuth();
        
        $tasks = $this->task->getAll($_SESSION['user_id']);
        $stats = $this->task->getStats($_SESSION['user_id']);
        
        include __DIR__ . '/../views/tasks/index.php';
    }

    public function create() {
        $this->requireAuth();
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];

            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $status = $_POST['status'] ?? 'pending';
            $priority = $_POST['priority'] ?? 'medium';
            $due_date = $_POST['due_date'] ?? null;

            // Validaciones
            if(empty($title)) {
                $errors[] = "El título es requerido";
            }

            if(empty($errors)) {
                $this->task->user_id = $_SESSION['user_id'];
                $this->task->title = $title;
                $this->task->description = $description;
                $this->task->status = $status;
                $this->task->priority = $priority;
                $this->task->due_date = $due_date;

                if($this->task->create()) {
                    $_SESSION['success'] = "Tarea creada exitosamente";
                    header('Location: /index.php?action=tasks');
                    exit();
                } else {
                    $errors[] = "Error al crear la tarea";
                }
            }

            $_SESSION['errors'] = $errors;
        }

        include __DIR__ . '/../views/tasks/create.php';
    }

    public function edit() {
        $this->requireAuth();
        
        $id = $_GET['id'] ?? null;
        
        if(!$id) {
            header('Location: /index.php?action=tasks');
            exit();
        }

        $task = $this->task->getById($id, $_SESSION['user_id']);

        if(!$task) {
            $_SESSION['errors'] = ["Tarea no encontrada"];
            header('Location: /index.php?action=tasks');
            exit();
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];

            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $status = $_POST['status'] ?? 'pending';
            $priority = $_POST['priority'] ?? 'medium';
            $due_date = $_POST['due_date'] ?? null;

            if(empty($title)) {
                $errors[] = "El título es requerido";
            }

            if(empty($errors)) {
                $this->task->id = $id;
                $this->task->user_id = $_SESSION['user_id'];
                $this->task->title = $title;
                $this->task->description = $description;
                $this->task->status = $status;
                $this->task->priority = $priority;
                $this->task->due_date = $due_date;

                if($this->task->update()) {
                    $_SESSION['success'] = "Tarea actualizada exitosamente";
                    header('Location: /index.php?action=tasks');
                    exit();
                } else {
                    $errors[] = "Error al actualizar la tarea";
                }
            }

            $_SESSION['errors'] = $errors;
        }

        include __DIR__ . '/../views/tasks/edit.php';
    }

    public function delete() {
        $this->requireAuth();
        
        $id = $_GET['id'] ?? null;

        if($id) {
            if($this->task->delete($id, $_SESSION['user_id'])) {
                $_SESSION['success'] = "Tarea eliminada exitosamente";
            } else {
                $_SESSION['errors'] = ["Error al eliminar la tarea"];
            }
        }

        header('Location: /index.php?action=tasks');
        exit();
    }

    private function requireAuth() {
        if(!isset($_SESSION['user_id'])) {
            header('Location: /index.php?action=login');
            exit();
        }
    }
}
