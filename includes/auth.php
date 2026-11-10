<?php
declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/database.php';

function isLoggedIn(): bool {
    return isset($_SESSION['user_id'], $_SESSION['id_role']);
}

function requireAuth(): void {
    if (!isLoggedIn()) {
        header('Location: index.php');
        exit;
    }
}

function getCurrentUser(): ?array {
    if (!isLoggedIn()) {
        return null;
    }
    return [
        'id'          => $_SESSION['user_id'],
        'username'    => $_SESSION['username'],
        'nama'        => $_SESSION['nama_lengkap'],
        'role'        => $_SESSION['id_role'],
        'nama_role'   => $_SESSION['nama_role'],
        'unit'        => $_SESSION['id_unit'] ?? null,
        'nama_unit'   => $_SESSION['nama_unit'] ?? null,
    ];
}

function hasPermission(string $menu, string $action): bool {
    if (!isLoggedIn()) {
        return false;
    }
    $role = $_SESSION['id_role'];
    
    // Peran Admin adalah Superadmin sejati dengan akses penuh ke seluruh fitur dan menu
    if ($role === 'adm') {
        return true;
    }

    $db = getDB();
    $stmt = $db->prepare("SELECT can_view, can_create, can_edit, can_delete, can_download, can_approve FROM role_permissions WHERE id_role = ? AND menu_fitur = ?");
    $stmt->execute([$role, $menu]);
    $p = $stmt->fetch();

    if (!$p) {
        return false;
    }

    return match ($action) {
        'l' => (bool)$p['can_view'],
        't' => (bool)$p['can_create'],
        'u' => (bool)$p['can_edit'],
        'h' => (bool)$p['can_delete'],
        'd' => (bool)$p['can_download'],
        's' => (bool)$p['can_approve'],
        default => false,
    };
}   