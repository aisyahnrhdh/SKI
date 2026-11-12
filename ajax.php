<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/functions.php';

checkAndUpdateLockStatus();

$action = $_GET['action'] ?? $_POST['action'] ?? '';
$db = getDB();

// 1. LOGIN
if ($action === 'login') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $demoRole = trim($_POST['demo_role'] ?? '');

    if ($demoRole !== '') {
        if ($demoRole === 'pic-keu') {
            $stmt = $db->prepare("SELECT u.*, r.nama_role, un.nama_unit FROM users u JOIN roles r ON u.id_role = r.id_role LEFT JOIN units un ON u.id_unit = un.id_unit WHERE u.id_role = 'pic' AND (u.id_unit = 'u-keu' OR u.nip_username = 'budi.keu') AND u.status_aktif = 1 LIMIT 1");
            $stmt->execute();
        } elseif ($demoRole === 'pic-peg') {
            $stmt = $db->prepare("SELECT u.*, r.nama_role, un.nama_unit FROM users u JOIN roles r ON u.id_role = r.id_role LEFT JOIN units un ON u.id_unit = un.id_unit WHERE u.id_role = 'pic' AND (u.id_unit = 'u-peg' OR u.nip_username = 'dewi.peg') AND u.status_aktif = 1 LIMIT 1");
            $stmt->execute();
        } elseif ($demoRole === 'pic-ren') {
            $stmt = $db->prepare("SELECT u.*, r.nama_role, un.nama_unit FROM users u JOIN roles r ON u.id_role = r.id_role LEFT JOIN units un ON u.id_unit = un.id_unit WHERE u.id_role = 'pic' AND (u.id_unit = 'u-ren' OR u.nip_username = 'agus.ren') AND u.status_aktif = 1 LIMIT 1");
            $stmt->execute();
        } elseif ($demoRole === 'pic') {
            $stmt = $db->prepare("SELECT u.*, r.nama_role, un.nama_unit FROM users u JOIN roles r ON u.id_role = r.id_role LEFT JOIN units un ON u.id_unit = un.id_unit WHERE u.id_role = 'pic' AND u.status_aktif = 1 LIMIT 1");
            $stmt->execute();
        } else {
            $stmt = $db->prepare("SELECT u.*, r.nama_role, un.nama_unit FROM users u JOIN roles r ON u.id_role = r.id_role LEFT JOIN units un ON u.id_unit = un.id_unit WHERE u.id_role = ? AND u.status_aktif = 1 LIMIT 1");
            $stmt->execute([$demoRole]);
        }
        $user = $stmt->fetch();
    } else {
        $stmt = $db->prepare("SELECT u.*, r.nama_role, un.nama_unit FROM users u JOIN roles r ON u.id_role = r.id_role LEFT JOIN units un ON u.id_unit = un.id_unit WHERE u.nip_username = ? AND u.status_aktif = 1 LIMIT 1");
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        if (!$user || !password_verify($password, $user['password_hash'])) {
            echo json_encode(['success' => false, 'message' => 'NIP/Username atau kata sandi salah.']);
            exit;
        }
    }

    if ($user) {
        $_SESSION['user_id']     = $user['id_user'];
        $_SESSION['username']    = $user['nip_username'];
        $_SESSION['nama_lengkap']= $user['nama_lengkap'];
        $_SESSION['id_role']     = $user['id_role'];
        $_SESSION['nama_role']   = $user['nama_role'];
        $_SESSION['id_unit']     = $user['id_unit'];
        $_SESSION['nama_unit']   = $user['nama_unit'];

        writeAuditLog('Login', 'Sistem Monev SKI');
        echo json_encode(['success' => true, 'role' => $user['id_role'], 'user' => getCurrentUser()]);
        exit;
    }
    echo json_encode(['success' => false, 'message' => 'Pengguna tidak ditemukan atau berstatus nonaktif.']);
    exit;
}

if (!isLoggedIn()) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Sesi kedaluwarsa. Silakan masuk kembali.']);
    exit;
}

$currentUser = getCurrentUser();

// 2. READ ALL INITIAL DATA
if ($action === 'init_data') {
    if ($currentUser['role'] === 'adm') {
        $allMenus = ['dash', 'mod', 'jdw', 'upl', 'mon', 'rep', 'rev', 'apm', 'exp', 'aud', 'usr', 'hak'];
        $perms = [];
        foreach ($allMenus as $m) {
            $perms[$m] = 'ltuhds';
        }
    } else {
        $stmt = $db->prepare("SELECT menu_fitur, can_view, can_create, can_edit, can_delete, can_download, can_approve FROM role_permissions WHERE id_role = ?");
        $stmt->execute([$currentUser['role']]);
        $permsRaw = $stmt->fetchAll();
        $perms = [];
        foreach ($permsRaw as $pr) {
            $actions = '';
            if ($pr['can_view']) $actions .= 'l';
            if ($pr['can_create']) $actions .= 't';
            if ($pr['can_edit']) $actions .= 'u';
            if ($pr['can_delete']) $actions .= 'h';
            if ($pr['can_download']) $actions .= 'd';
            if ($pr['can_approve']) $actions .= 's';
            $perms[$pr['menu_fitur']] = $actions;
        }
    }

    if ($currentUser['role'] === 'pic') {
        $picUnit = $currentUser['unit'] ?? '';
        if ($picUnit !== '') {
            $stmtMod = $db->prepare("
                SELECT m.*, u.nama_unit, j.id_jadwal, j.tenggat_unggah, j.mulai_penilaian, j.is_locked,
                       (SELECT COUNT(*) FROM indikators WHERE id_modul = m.id_modul) as total_indikator
                FROM moduls m
                JOIN units u ON m.id_unit_pic = u.id_unit
                JOIN jadwal_moduls j ON m.id_modul = j.id_modul
                WHERE m.status_template = 'terbit' AND m.id_unit_pic = ?
                ORDER BY m.nama_modul ASC
            ");
            $stmtMod->execute([$picUnit]);
            $moduls = $stmtMod->fetchAll();

            $stmtInd = $db->prepare("
                SELECT i.* FROM indikators i
                JOIN moduls m ON i.id_modul = m.id_modul
                JOIN jadwal_moduls j ON m.id_modul = j.id_modul
                WHERE m.status_template = 'terbit' AND m.id_unit_pic = ?
                ORDER BY i.id_modul, i.nomor_urut ASC
            ");
            $stmtInd->execute([$picUnit]);
            $indikators = $stmtInd->fetchAll();

            $stmtEv = $db->prepare("
                SELECT e.*, u.nama_lengkap as nama_pic, un.nama_unit, m.id_modul, m.nama_modul, i.deskripsi_indikator,
                       r.catatan_temuan, r.status_kesesuaian, rev_u.nama_lengkap as nama_reviewer
                FROM evidens e
                JOIN users u ON e.id_user_pic = u.id_user
                LEFT JOIN units un ON u.id_unit = un.id_unit
                JOIN indikators i ON e.id_indikator = i.id_indikator
                JOIN moduls m ON i.id_modul = m.id_modul
                JOIN jadwal_moduls j ON m.id_modul = j.id_modul
                LEFT JOIN reviews r ON e.id_eviden = r.id_eviden
                LEFT JOIN users rev_u ON r.id_user_reviewer = rev_u.id_user
                WHERE m.status_template = 'terbit' AND (m.id_unit_pic = ? OR e.id_user_pic = ?)
                ORDER BY e.waktu_unggah DESC
            ");
            $stmtEv->execute([$picUnit, $currentUser['id']]);
            $evidens = $stmtEv->fetchAll();
        } else {
            $stmtMod = $db->query("
                SELECT m.*, u.nama_unit, j.id_jadwal, j.tenggat_unggah, j.mulai_penilaian, j.is_locked,
                       (SELECT COUNT(*) FROM indikators WHERE id_modul = m.id_modul) as total_indikator
                FROM moduls m
                JOIN units u ON m.id_unit_pic = u.id_unit
                JOIN jadwal_moduls j ON m.id_modul = j.id_modul
                WHERE m.status_template = 'terbit'
                ORDER BY m.nama_modul ASC
            ");
            $moduls = $stmtMod->fetchAll();

            $stmtInd = $db->query("
                SELECT i.* FROM indikators i
                JOIN moduls m ON i.id_modul = m.id_modul
                JOIN jadwal_moduls j ON m.id_modul = j.id_modul
                WHERE m.status_template = 'terbit'
                ORDER BY i.id_modul, i.nomor_urut ASC
            ");
            $indikators = $stmtInd->fetchAll();

            $stmtEv = $db->prepare("
                SELECT e.*, u.nama_lengkap as nama_pic, un.nama_unit, m.id_modul, m.nama_modul, i.deskripsi_indikator,
                       r.catatan_temuan, r.status_kesesuaian, rev_u.nama_lengkap as nama_reviewer
                FROM evidens e
                JOIN users u ON e.id_user_pic = u.id_user
                LEFT JOIN units un ON u.id_unit = un.id_unit
                JOIN indikators i ON e.id_indikator = i.id_indikator
                JOIN moduls m ON i.id_modul = m.id_modul
                JOIN jadwal_moduls j ON m.id_modul = j.id_modul
                LEFT JOIN reviews r ON e.id_eviden = r.id_eviden
                LEFT JOIN users rev_u ON r.id_user_reviewer = rev_u.id_user
                WHERE m.status_template = 'terbit' AND e.id_user_pic = ?
                ORDER BY e.waktu_unggah DESC
            ");
            $stmtEv->execute([$currentUser['id']]);
            $evidens = $stmtEv->fetchAll();
        }
    } else {
        $stmtMod = $db->query("
            SELECT m.*, u.nama_unit, j.id_jadwal, j.tenggat_unggah, j.mulai_penilaian, j.is_locked,
                   (SELECT COUNT(*) FROM indikators WHERE id_modul = m.id_modul) as total_indikator
            FROM moduls m
            JOIN units u ON m.id_unit_pic = u.id_unit
            LEFT JOIN (
                SELECT j1.*
                FROM jadwal_moduls j1
                INNER JOIN (
                    SELECT id_modul, MAX(tenggat_unggah) as max_tenggat
                    FROM jadwal_moduls
                    GROUP BY id_modul
                ) j2 ON j1.id_modul = j2.id_modul AND j1.tenggat_unggah = j2.max_tenggat
            ) j ON m.id_modul = j.id_modul AND m.status_template = 'terbit'
            ORDER BY m.nama_modul ASC
        ");
        $moduls = $stmtMod->fetchAll();

        $stmtInd = $db->query("SELECT * FROM indikators ORDER BY id_modul, nomor_urut ASC");
        $indikators = $stmtInd->fetchAll();

        $stmtEv = $db->query("
            SELECT e.*, u.nama_lengkap as nama_pic, un.nama_unit, m.id_modul, m.nama_modul, i.deskripsi_indikator,
                   r.catatan_temuan, r.status_kesesuaian, rev_u.nama_lengkap as nama_reviewer
            FROM evidens e
            JOIN users u ON e.id_user_pic = u.id_user
            LEFT JOIN units un ON u.id_unit = un.id_unit
            JOIN indikators i ON e.id_indikator = i.id_indikator
            JOIN moduls m ON i.id_modul = m.id_modul
            LEFT JOIN reviews r ON e.id_eviden = r.id_eviden
            LEFT JOIN users rev_u ON r.id_user_reviewer = rev_u.id_user
            ORDER BY e.waktu_unggah DESC
        ");
        $evidens = $stmtEv->fetchAll();
    }

    $stmtRec = $db->query("
        SELECT r.*, m.nama_modul, u.nama_lengkap as nama_ketua, p.nama_lengkap as nama_pimpinan
        FROM rekomendasi_approvals r
        JOIN moduls m ON r.id_modul = m.id_modul
        JOIN users u ON r.id_ketua_ski = u.id_user
        LEFT JOIN users p ON r.id_pimpinan = p.id_user
        ORDER BY r.id_rekomendasi DESC
    ");
    $rekomendasi = $stmtRec->fetchAll();

    $stmtAud = $db->query("
        SELECT a.*, u.nama_lengkap FROM audit_logs a
        JOIN users u ON a.id_user = u.id_user
        ORDER BY a.timestamp_aktivitas DESC LIMIT 300
    ");
    $auditLogs = $stmtAud->fetchAll();

    $stmtUsr = $db->query("
        SELECT u.id_user, u.nip_username, u.nama_lengkap, u.id_role, u.id_unit, u.status_aktif, r.nama_role, un.nama_unit
        FROM users u
        JOIN roles r ON u.id_role = r.id_role
        LEFT JOIN units un ON u.id_unit = un.id_unit
        ORDER BY u.nama_lengkap ASC
    ");
    $usersList = $stmtUsr->fetchAll();

    $stmtUnits = $db->query("SELECT * FROM units ORDER BY nama_unit ASC");
    $units = $stmtUnits->fetchAll();

    $stmtRoles = $db->query("SELECT * FROM roles ORDER BY nama_role ASC");
    $roles = $stmtRoles->fetchAll();

    // Matriks izin seluruh peran untuk konfigurasi RBAC oleh Admin
    $stmtAllPerms = $db->query("SELECT id_role, menu_fitur, can_view, can_create, can_edit, can_delete, can_download, can_approve FROM role_permissions");
    $allPermsRaw = $stmtAllPerms->fetchAll();
    $rolePermissions = [];
    foreach ($allPermsRaw as $pr) {
        $rId = $pr['id_role'];
        if (!isset($rolePermissions[$rId])) {
            $rolePermissions[$rId] = [];
        }
        $actions = '';
        if ($pr['can_view']) $actions .= 'l';
        if ($pr['can_create']) $actions .= 't';
        if ($pr['can_edit']) $actions .= 'u';
        if ($pr['can_delete']) $actions .= 'h';
        if ($pr['can_download']) $actions .= 'd';
        if ($pr['can_approve']) $actions .= 's';
        $rolePermissions[$rId][$pr['menu_fitur']] = $actions;
    }

    echo json_encode([
        'success'          => true,
        'user'             => $currentUser,
        'permissions'      => $perms,
        'role_permissions' => $rolePermissions,
        'moduls'           => $moduls,
        'indikators'       => $indikators,
        'evidens'          => $evidens,
        'rekomendasi'      => $rekomendasi,
        'audit'            => $auditLogs,
        'users'            => $usersList,
        'units'            => $units,
        'roles'            => $roles
    ]);
    exit;
}

// --- TEMPLATE BUILDER SKI ACTIONS (RF-05, RF-06, RF-07, RNF-07) ---
if ($action === 'update_module_status') {
    $allowedRoles = ['adm', 'ang', 'ket'];
    if (!in_array($currentUser['role'], $allowedRoles, true)) {
        echo json_encode([
            'success' => false,
            'message' => 'Akses ditolak: Hanya Tim SKI atau Administrator yang dapat mengubah status modul.',
            'data'    => null
        ]);
        exit;
    }

    $moduleId = trim($_POST['module_id'] ?? $_POST['id'] ?? '');
    $newStatus = trim($_POST['status'] ?? '');

    if (!in_array($newStatus, ['draf', 'terbit'], true)) {
        echo json_encode([
            'success' => false,
            'message' => 'Status tidak valid. Pilihan hanya "draf" atau "terbit".',
            'data'    => null
        ]);
        exit;
    }

    if ($moduleId === '') {
        echo json_encode([
            'success' => false,
            'message' => 'ID Modul tidak boleh kosong.',
            'data'    => null
        ]);
        exit;
    }

    // Update table modules
    $stmt = $db->prepare("UPDATE modules SET status = ? WHERE id = ?");
    $stmt->execute([$newStatus, $moduleId]);

    // Sinkronisasi ke table moduls
    $stmtSync = $db->prepare("UPDATE moduls SET status_template = ?, status = ? WHERE id_modul = ?");
    $stmtSync->execute([$newStatus, $newStatus, $moduleId]);

    writeAuditLog('Update Status Modul', "Modul {$moduleId} status: {$newStatus}");

    echo json_encode([
        'success' => true,
        'message' => "Status modul berhasil diubah menjadi {$newStatus}.",
        'data'    => [
            'module_id' => $moduleId,
            'status'    => $newStatus
        ]
    ]);
    exit;
}

if ($action === 'save_indicator_config') {
    $allowedRoles = ['adm', 'ang', 'ket'];
    if (!in_array($currentUser['role'], $allowedRoles, true)) {
        echo json_encode([
            'success' => false,
            'message' => 'Akses ditolak: Hanya Tim SKI atau Administrator yang dapat mengonfigurasi indikator.',
            'data'    => null
        ]);
        exit;
    }

    $id = trim($_POST['id'] ?? $_POST['indicator_id'] ?? '');
    $moduleId = trim($_POST['module_id'] ?? '');
    $indicatorText = trim($_POST['indicator_text'] ?? $_POST['text'] ?? '');
    $inputType = trim($_POST['input_type'] ?? 'file');
    $guideNotes = trim($_POST['guide_notes'] ?? '');
    $isMandatory = isset($_POST['is_mandatory']) ? (int)$_POST['is_mandatory'] : 1;

    $allowedTypes = ['file'];
    $inputType = 'file';

    if ($indicatorText === '') {
        echo json_encode([
            'success' => false,
            'message' => 'Teks butir indikator tidak boleh kosong.',
            'data'    => null
        ]);
        exit;
    }

    if ($moduleId === '' && $id !== '') {
        $stmtM = $db->prepare("SELECT id_modul FROM indikators WHERE id_indikator = ? LIMIT 1");
        $stmtM->execute([$id]);
        $moduleId = (string)$stmtM->fetchColumn();
    }

    $isUpdate = false;
    if ($id !== '') {
        $stmtChk = $db->prepare("SELECT COUNT(*) FROM indikators WHERE id_indikator = ?");
        $stmtChk->execute([$id]);
        $isUpdate = ((int)$stmtChk->fetchColumn() > 0);
    }

    if ($isUpdate) {
        $stmtSync = $db->prepare("UPDATE indikators SET deskripsi_indikator = ?, input_type = ?, guide_notes = ?, is_mandatory = ? WHERE id_indikator = ?");
        $stmtSync->execute([$indicatorText, $inputType, $guideNotes !== '' ? $guideNotes : null, $isMandatory, $id]);

        try {
            $stmt = $db->prepare("UPDATE indicators SET indicator_text = ?, input_type = ?, guide_notes = ?, is_mandatory = ? WHERE id = ?");
            $stmt->execute([$indicatorText, $inputType, $guideNotes !== '' ? $guideNotes : null, $isMandatory, $id]);
        } catch (Exception $e) {}

        $message = "Konfigurasi butir indikator berhasil diperbarui.";
    } else {
        if ($id === '') {
            $id = generateUUID();
        }
        $stmtSeq = $db->prepare("SELECT COALESCE(MAX(nomor_urut), 0) + 1 FROM indikators WHERE id_modul = ?");
        $stmtSeq->execute([$moduleId]);
        $nextSeq = (int)$stmtSeq->fetchColumn();

        $stmtSync = $db->prepare("INSERT INTO indikators (id_indikator, id_modul, deskripsi_indikator, input_type, guide_notes, is_mandatory, nomor_urut) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmtSync->execute([$id, $moduleId, $indicatorText, $inputType, $guideNotes !== '' ? $guideNotes : null, $isMandatory, $nextSeq]);

        try {
            $stmt = $db->prepare("INSERT INTO indicators (id, module_id, indicator_text, input_type, guide_notes, is_mandatory, nomor_urut) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$id, $moduleId, $indicatorText, $inputType, $guideNotes !== '' ? $guideNotes : null, $isMandatory, $nextSeq]);
        } catch (Exception $e) {}

        $message = "Butir indikator baru berhasil ditambahkan.";
    }

    writeAuditLog('Konfigurasi Indikator Modul', "Indikator {$id} pada modul {$moduleId}");

    echo json_encode([
        'success' => true,
        'message' => $message,
        'data'    => [
            'id'             => $id,
            'module_id'      => $moduleId,
            'indicator_text' => $indicatorText,
            'input_type'     => $inputType,
            'guide_notes'    => $guideNotes,
            'is_mandatory'   => $isMandatory
        ]
    ]);
    exit;
}

if ($action === 'delete_indicator') {
    $allowedRoles = ['adm', 'ang', 'ket'];
    if (!in_array($currentUser['role'], $allowedRoles, true)) {
        echo json_encode([
            'success' => false,
            'message' => 'Akses ditolak: Hanya Tim SKI atau Administrator yang dapat menghapus indikator.',
            'data'    => null
        ]);
        exit;
    }

    $id = trim($_POST['id'] ?? $_POST['indicator_id'] ?? '');
    if ($id === '') {
        echo json_encode([
            'success' => false,
            'message' => 'ID Indikator wajib disertakan.',
            'data'    => null
        ]);
        exit;
    }

    $stmt = $db->prepare("DELETE FROM indicators WHERE id = ?");
    $stmt->execute([$id]);

    $stmtSync = $db->prepare("DELETE FROM indikators WHERE id_indikator = ?");
    $stmtSync->execute([$id]);

    writeAuditLog('Hapus Indikator', "ID: {$id}");

    echo json_encode([
        'success' => true,
        'message' => 'Butir indikator berhasil dihapus.',
        'data'    => ['id' => $id]
    ]);
    exit;
}

// 3. CRUD: MASTER MODUL & TEMPLATE
if ($action === 'create_modul') {
    if (!hasPermission('mod', 't')) {
        echo json_encode(['success' => false, 'message' => 'Akses ditolak: Anda tidak memiliki izin menambah modul.']);
        exit;
    }
    $nama = trim($_POST['nama_modul'] ?? '');
    $jenis = trim($_POST['jenis_template'] ?? 'ind');
    $idUnit = trim($_POST['id_unit_pic'] ?? '');
    if ($nama === '' || $idUnit === '') {
        echo json_encode(['success' => false, 'message' => 'Nama modul dan unit PIC wajib diisi.']);
        exit;
    }
    $idModul = 'mod-' . substr(md5((string)microtime(true)), 0, 8);
    $savedFile = null;

    if (!empty($_FILES['template_file']) && $_FILES['template_file']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['template_file'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowedExt = ['xlsx', 'xls', 'docx', 'doc', 'pdf', 'csv', 'zip', 'pptx'];
        if (in_array($ext, $allowedExt, true) && $file['size'] <= 35 * 1024 * 1024) {
            $uploadDir = __DIR__ . '/uploads/templates/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
            $cleanName = preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $file['name']);
            $savedFile = time() . '_' . $cleanName;
            move_uploaded_file($file['tmp_name'], $uploadDir . $savedFile);
            if (in_array($ext, ['xlsx', 'xls', 'csv'], true)) $jenis = 'xls';
        }
    }

    $moduleType = trim($_POST['module_type'] ?? 'checklist');
    if (!in_array($moduleType, ['checklist', 'metrics_data', 'document_verification'], true)) {
        $moduleType = 'checklist';
    }
    $scoringThreshold = isset($_POST['scoring_threshold']) && $_POST['scoring_threshold'] !== '' ? (float)$_POST['scoring_threshold'] : null;

    $stmt = $db->prepare("INSERT INTO moduls (id_modul, nama_modul, jenis_template, file_referensi, status_template, id_unit_pic, module_type, scoring_threshold) VALUES (?, ?, ?, ?, 'draf', ?, ?, ?)");
    $stmt->execute([$idModul, $nama, $jenis, $savedFile, $idUnit, $moduleType, $scoringThreshold]);
    writeAuditLog('Tambah Modul Pengawasan', $nama . ($savedFile ? " (Template: $savedFile)" : ''));
    echo json_encode(['success' => true, 'message' => 'Modul berhasil ditambahkan sebagai draf.', 'id_modul' => $idModul]);
    exit;
}

if ($action === 'update_modul') {
    if (!hasPermission('mod', 'u')) {
        echo json_encode(['success' => false, 'message' => 'Akses ditolak: Anda tidak memiliki izin mengubah modul.']);
        exit;
    }
    $idModul = trim($_POST['id_modul'] ?? '');
    $nama = trim($_POST['nama_modul'] ?? '');
    $jenis = trim($_POST['jenis_template'] ?? 'ind');
    $idUnit = trim($_POST['id_unit_pic'] ?? '');
    $status = trim($_POST['status_template'] ?? 'draf');

    $stmtOld = $db->prepare("SELECT * FROM moduls WHERE id_modul = ? LIMIT 1");
    $stmtOld->execute([$idModul]);
    $oldMod = $stmtOld->fetch();
    $savedFile = $oldMod ? $oldMod['file_referensi'] : null;

    $moduleType = trim($_POST['module_type'] ?? ($oldMod['module_type'] ?? 'checklist'));
    if (!in_array($moduleType, ['checklist', 'metrics_data', 'document_verification'], true)) {
        $moduleType = 'checklist';
    }
    $scoringThreshold = isset($_POST['scoring_threshold']) && $_POST['scoring_threshold'] !== '' ? (float)$_POST['scoring_threshold'] : ($oldMod['scoring_threshold'] ?? null);

    if (!empty($_FILES['template_file']) && $_FILES['template_file']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['template_file'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowedExt = ['xlsx', 'xls', 'docx', 'doc', 'pdf', 'csv', 'zip', 'pptx'];
        if (in_array($ext, $allowedExt, true) && $file['size'] <= 35 * 1024 * 1024) {
            $uploadDir = __DIR__ . '/uploads/templates/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
            $cleanName = preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $file['name']);
            $newFileName = time() . '_' . $cleanName;
            if (move_uploaded_file($file['tmp_name'], $uploadDir . $newFileName)) {
                if ($savedFile && file_exists($uploadDir . $savedFile) && is_file($uploadDir . $savedFile)) {
                    @unlink($uploadDir . $savedFile);
                }
                $savedFile = $newFileName;
                if (in_array($ext, ['xlsx', 'xls', 'csv'], true)) $jenis = 'xls';
            }
        }
    }

    $stmt = $db->prepare("UPDATE moduls SET nama_modul = ?, jenis_template = ?, file_referensi = ?, id_unit_pic = ?, status_template = ?, status = ?, module_type = ?, scoring_threshold = ? WHERE id_modul = ?");
    $stmt->execute([$nama, $jenis, $savedFile, $idUnit, $status, $status, $moduleType, $scoringThreshold, $idModul]);
    try {
        $stmtSyncMod = $db->prepare("UPDATE modules SET status = ? WHERE id = ?");
        $stmtSyncMod->execute([$status, $idModul]);
    } catch (Exception $e) {}
    writeAuditLog('Ubah Modul Pengawasan', "$nama (Status: $status)");
    echo json_encode(['success' => true, 'message' => 'Data modul berhasil diperbarui.']);
    exit;
}

// 3.1 DEDICATED TEMPLATE UPLOAD & DELETE (Ketua / Anggota SKI)
if ($action === 'upload_template') {
    if (!hasPermission('mod', 'u') && !hasPermission('mod', 't')) {
        echo json_encode(['success' => false, 'message' => 'Akses ditolak: Anda tidak memiliki izin mengunggah template.']);
        exit;
    }
    $idModul = trim($_POST['id_modul'] ?? '');
    if ($idModul === '' || empty($_FILES['template_file']) || $_FILES['template_file']['error'] !== UPLOAD_ERR_OK) {
        echo json_encode(['success' => false, 'message' => 'Pilih berkas template yang valid terlebih dahulu.']);
        exit;
    }

    $file = $_FILES['template_file'];
    $maxBytes = 35 * 1024 * 1024; // 35MB
    if ($file['size'] > $maxBytes) {
        echo json_encode(['success' => false, 'message' => 'Ukuran berkas melebihi batas maksimal 35 MB.']);
        exit;
    }

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $allowedExt = ['xlsx', 'xls', 'docx', 'doc', 'pdf', 'csv', 'zip', 'pptx'];
    if (!in_array($ext, $allowedExt, true)) {
        echo json_encode(['success' => false, 'message' => 'Format berkas tidak didukung. Gunakan Excel, Word, PDF, CSV, atau ZIP.']);
        exit;
    }

    $stmtM = $db->prepare("SELECT * FROM moduls WHERE id_modul = ? LIMIT 1");
    $stmtM->execute([$idModul]);
    $mod = $stmtM->fetch();
    if (!$mod) {
        echo json_encode(['success' => false, 'message' => 'Modul pengawasan tidak ditemukan.']);
        exit;
    }

    $uploadDir = __DIR__ . '/uploads/templates/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

    $cleanOrigName = preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $file['name']);
    $newFileName = time() . '_' . $cleanOrigName;
    $targetPath = $uploadDir . $newFileName;

    if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
        echo json_encode(['success' => false, 'message' => 'Gagal menyimpan berkas template ke server storage.']);
        exit;
    }

    if (!empty($mod['file_referensi'])) {
        $oldFilePath = $uploadDir . $mod['file_referensi'];
        if (file_exists($oldFilePath) && is_file($oldFilePath)) {
            @unlink($oldFilePath);
        }
    }

    $jenisTemplate = in_array($ext, ['xlsx', 'xls', 'csv'], true) ? 'xls' : 'ind';
    $stmtUp = $db->prepare("UPDATE moduls SET file_referensi = ?, jenis_template = ? WHERE id_modul = ?");
    $stmtUp->execute([$newFileName, $jenisTemplate, $idModul]);

    writeAuditLog('Upload Template Modul', $mod['nama_modul'] . ' (' . $file['name'] . ')');

    echo json_encode([
        'success' => true,
        'message' => 'Berkas template acuan berhasil diunggah.',
        'file_referensi' => $newFileName,
        'nama_file_asli' => $file['name']
    ]);
    exit;
}

if ($action === 'delete_template') {
    if (!hasPermission('mod', 'u') && !hasPermission('mod', 'h')) {
        echo json_encode(['success' => false, 'message' => 'Akses ditolak: Anda tidak memiliki izin menghapus template.']);
        exit;
    }
    $idModul = trim($_POST['id_modul'] ?? '');
    $stmtM = $db->prepare("SELECT * FROM moduls WHERE id_modul = ? LIMIT 1");
    $stmtM->execute([$idModul]);
    $mod = $stmtM->fetch();
    if (!$mod) {
        echo json_encode(['success' => false, 'message' => 'Modul tidak ditemukan.']);
        exit;
    }

    if (!empty($mod['file_referensi'])) {
        $uploadDir = __DIR__ . '/uploads/templates/';
        $oldFilePath = $uploadDir . $mod['file_referensi'];
        if (file_exists($oldFilePath) && is_file($oldFilePath)) {
            @unlink($oldFilePath);
        }
    }

    $stmtUp = $db->prepare("UPDATE moduls SET file_referensi = NULL WHERE id_modul = ?");
    $stmtUp->execute([$idModul]);

    writeAuditLog('Hapus Template Modul', $mod['nama_modul']);

    echo json_encode(['success' => true, 'message' => 'Berkas template berhasil dihapus dari modul.']);
    exit;
}

if ($action === 'delete_modul') {
    if (!hasPermission('mod', 'h') && !in_array($currentUser['role'], ['adm', 'ket', 'ang'], true)) {
        echo json_encode(['success' => false, 'message' => 'Akses ditolak: Anda tidak memiliki izin menghapus modul.']);
        exit;
    }
    $idModul = trim($_POST['id_modul'] ?? '');
    if ($idModul === '') {
        echo json_encode(['success' => false, 'message' => 'ID Modul tidak boleh kosong.']);
        exit;
    }

    $stmtOld = $db->prepare("SELECT nama_modul, file_referensi FROM moduls WHERE id_modul = ?");
    $stmtOld->execute([$idModul]);
    $modInfo = $stmtOld->fetch();
    $modName = $modInfo ? $modInfo['nama_modul'] : $idModul;
    $oldRef = $modInfo ? $modInfo['file_referensi'] : null;

    $db->beginTransaction();
    try {
        $stmt1 = $db->prepare("DELETE FROM reviews WHERE id_eviden IN (SELECT id_eviden FROM evidens WHERE id_indikator IN (SELECT id_indikator FROM indikators WHERE id_modul = ?))");
        $stmt1->execute([$idModul]);
        $stmt2 = $db->prepare("DELETE FROM evidens WHERE id_indikator IN (SELECT id_indikator FROM indikators WHERE id_modul = ?)");
        $stmt2->execute([$idModul]);
        $stmt3 = $db->prepare("DELETE FROM indikators WHERE id_modul = ?");
        $stmt3->execute([$idModul]);
        try {
            $stmtSyncInd = $db->prepare("DELETE FROM indicators WHERE module_id = ?");
            $stmtSyncInd->execute([$idModul]);
        } catch (Exception $e) {}

        $stmt4 = $db->prepare("DELETE FROM jadwal_moduls WHERE id_modul = ?");
        $stmt4->execute([$idModul]);
        $stmt5 = $db->prepare("DELETE FROM rekomendasi_approvals WHERE id_modul = ?");
        $stmt5->execute([$idModul]);
        $stmt6 = $db->prepare("DELETE FROM moduls WHERE id_modul = ?");
        $stmt6->execute([$idModul]);
        try {
            $stmtSyncMod = $db->prepare("DELETE FROM modules WHERE id = ?");
            $stmtSyncMod->execute([$idModul]);
        } catch (Exception $e) {}
        $db->commit();

        if ($oldRef) {
            $tPath = __DIR__ . '/uploads/templates/' . $oldRef;
            if (file_exists($tPath) && is_file($tPath)) @unlink($tPath);
        }

        writeAuditLog('Hapus Modul Pengawasan', "Modul: {$modName} (ID: {$idModul})");
        echo json_encode(['success' => true, 'message' => "Modul '{$modName}' dan seluruh relasi berkas berhasil dihapus."]);
    } catch (Exception $e) {
        $db->rollBack();
        echo json_encode(['success' => false, 'message' => 'Gagal menghapus modul: ' . $e->getMessage()]);
    }
    exit;
}

if ($action === 'clear_module_indicators') {
    if (!hasPermission('mod', 'h') && !hasPermission('mod', 'u') && !in_array($currentUser['role'], ['adm', 'ket', 'ang'], true)) {
        echo json_encode(['success' => false, 'message' => 'Akses ditolak: Anda tidak memiliki izin mengosongkan isi modul.']);
        exit;
    }
    $idModul = trim($_POST['id_modul'] ?? '');
    if ($idModul === '') {
        echo json_encode(['success' => false, 'message' => 'ID Modul tidak boleh kosong.']);
        exit;
    }

    $db->beginTransaction();
    try {
        $stmt1 = $db->prepare("DELETE FROM reviews WHERE id_eviden IN (SELECT id_eviden FROM evidens WHERE id_indikator IN (SELECT id_indikator FROM indikators WHERE id_modul = ?))");
        $stmt1->execute([$idModul]);
        $stmt2 = $db->prepare("DELETE FROM evidens WHERE id_indikator IN (SELECT id_indikator FROM indikators WHERE id_modul = ?)");
        $stmt2->execute([$idModul]);
        $stmt3 = $db->prepare("DELETE FROM indikators WHERE id_modul = ?");
        $stmt3->execute([$idModul]);
        try {
            $stmtSync = $db->prepare("DELETE FROM indicators WHERE module_id = ?");
            $stmtSync->execute([$idModul]);
        } catch (Exception $e) {}
        $db->commit();

        writeAuditLog('Kosongkan Isi Modul', "Seluruh butir tagihan modul {$idModul} dikosongkan.");
        echo json_encode(['success' => true, 'message' => 'Seluruh butir indikator (isi modul) berhasil dikosongkan.']);
    } catch (Exception $e) {
        $db->rollBack();
        echo json_encode(['success' => false, 'message' => 'Gagal mengosongkan isi modul: ' . $e->getMessage()]);
    }
    exit;
}

// 4. CRUD: INDIKATOR PENILAIAN
if ($action === 'create_indikator') {
    if (!hasPermission('mod', 'u') && !hasPermission('mod', 't')) {
        echo json_encode(['success' => false, 'message' => 'Akses ditolak.']);
        exit;
    }
    $idModul = trim($_POST['id_modul'] ?? '');
    $deskripsi = trim($_POST['deskripsi_indikator'] ?? '');
    $inputType = trim($_POST['input_type'] ?? 'file');
    $guideNotes = trim($_POST['guide_notes'] ?? '');
    $isMandatory = isset($_POST['is_mandatory']) ? (int)$_POST['is_mandatory'] : 1;

    $inputType = 'file';

    if ($idModul === '' || $deskripsi === '') {
        echo json_encode(['success' => false, 'message' => 'Uraian indikator wajib diisi.']);
        exit;
    }
    $stmtC = $db->prepare("SELECT IFNULL(MAX(nomor_urut), 0) + 1 AS next_seq FROM indikators WHERE id_modul = ?");
    $stmtC->execute([$idModul]);
    $nextSeq = (int)$stmtC->fetchColumn();

    $idInd = generateUUID();
    $stmt = $db->prepare("INSERT INTO indikators (id_indikator, id_modul, deskripsi_indikator, nomor_urut, input_type, guide_notes, is_mandatory) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$idInd, $idModul, $deskripsi, $nextSeq, $inputType, $guideNotes !== '' ? $guideNotes : null, $isMandatory]);

    try {
        $stmtSync = $db->prepare("INSERT INTO indicators (id, module_id, indicator_text, input_type, guide_notes, is_mandatory, nomor_urut) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmtSync->execute([$idInd, $idModul, $deskripsi, $inputType, $guideNotes !== '' ? $guideNotes : null, $isMandatory, $nextSeq]);
    } catch (Exception $e) {}

    writeAuditLog('Tambah Indikator Modul', "Modul: $idModul - $deskripsi [Tipe: $inputType]");
    echo json_encode(['success' => true, 'message' => 'Butir indikator berhasil ditambahkan.', 'id_indikator' => $idInd]);
    exit;
}

if ($action === 'update_indikator') {
    if (!hasPermission('mod', 'u')) {
        echo json_encode(['success' => false, 'message' => 'Akses ditolak.']);
        exit;
    }
    $idInd = trim($_POST['id_indikator'] ?? '');
    $deskripsi = trim($_POST['deskripsi_indikator'] ?? '');
    $inputType = trim($_POST['input_type'] ?? '');
    $guideNotes = isset($_POST['guide_notes']) ? trim($_POST['guide_notes']) : null;
    $isMandatory = isset($_POST['is_mandatory']) ? (int)$_POST['is_mandatory'] : null;

    $allowedTypes = ['file'];
    if ($inputType !== '' && in_array($inputType, $allowedTypes, true)) {
        $stmt = $db->prepare("UPDATE indikators SET deskripsi_indikator = ?, input_type = 'file', guide_notes = ?, is_mandatory = ? WHERE id_indikator = ?");
        $stmt->execute([$deskripsi, $guideNotes !== '' ? $guideNotes : null, $isMandatory ?? 1, $idInd]);

        try {
            $stmtSync = $db->prepare("UPDATE indicators SET indicator_text = ?, input_type = 'file', guide_notes = ?, is_mandatory = ? WHERE id = ?");
            $stmtSync->execute([$deskripsi, $guideNotes !== '' ? $guideNotes : null, $isMandatory ?? 1, $idInd]);
        } catch (Exception $e) {}
    } else {
        $stmt = $db->prepare("UPDATE indikators SET deskripsi_indikator = ? WHERE id_indikator = ?");
        $stmt->execute([$deskripsi, $idInd]);

        try {
            $stmtSync = $db->prepare("UPDATE indicators SET indicator_text = ? WHERE id = ?");
            $stmtSync->execute([$deskripsi, $idInd]);
        } catch (Exception $e) {}
    }

    writeAuditLog('Ubah Indikator Modul', "ID: $idInd - $deskripsi");
    echo json_encode(['success' => true, 'message' => 'Indikator berhasil diperbarui.']);
    exit;
}

if ($action === 'delete_indikator') {
    if (!hasPermission('mod', 'h') && !hasPermission('mod', 'u') && !in_array($currentUser['role'], ['adm', 'ket', 'ang'], true)) {
        echo json_encode(['success' => false, 'message' => 'Akses ditolak: Anda tidak memiliki izin menghapus butir indikator.']);
        exit;
    }
    $idInd = trim($_POST['id_indikator'] ?? '');
    if ($idInd === '') {
        echo json_encode(['success' => false, 'message' => 'ID Indikator wajib disertakan.']);
        exit;
    }

    $db->beginTransaction();
    try {
        $stmt1 = $db->prepare("DELETE FROM reviews WHERE id_eviden IN (SELECT id_eviden FROM evidens WHERE id_indikator = ?)");
        $stmt1->execute([$idInd]);
        $stmt2 = $db->prepare("DELETE FROM evidens WHERE id_indikator = ?");
        $stmt2->execute([$idInd]);
        $stmt3 = $db->prepare("DELETE FROM indikators WHERE id_indikator = ?");
        $stmt3->execute([$idInd]);
        try {
            $stmtSync = $db->prepare("DELETE FROM indicators WHERE id = ?");
            $stmtSync->execute([$idInd]);
        } catch (Exception $e) {}
        $db->commit();

        writeAuditLog('Hapus Indikator Modul', "ID: $idInd");
        echo json_encode(['success' => true, 'message' => 'Butir indikator berhasil dihapus.']);
    } catch (Exception $e) {
        $db->rollBack();
        echo json_encode(['success' => false, 'message' => 'Gagal menghapus butir indikator: ' . $e->getMessage()]);
    }
    exit;
}

// 5. CRUD: JADWAL & PERIODE PENGAWASAN
if ($action === 'publish_jadwal') {
    if (!hasPermission('jdw', 't')) {
        echo json_encode(['success' => false, 'message' => 'Akses ditolak untuk menerbitkan jadwal.']);
        exit;
    }
    $siklus = trim($_POST['siklus'] ?? 'Bulanan');
    $periode = trim($_POST['periode'] ?? 'Oktober 2026');
    $tenggat = trim($_POST['tenggat_unggah'] ?? '');
    $mulaiPenilaian = trim($_POST['mulai_penilaian'] ?? '');
    $modulIds = json_decode($_POST['modul_ids'] ?? '[]', true);

    if (!is_array($modulIds) || empty($modulIds) || $tenggat === '' || $mulaiPenilaian === '') {
        echo json_encode(['success' => false, 'message' => 'Lengkapi form penjadwalan dan pilih minimal satu modul.']);
        exit;
    }

    // Filter array ID modul yang valid
    $modulIds = array_values(array_filter(array_map('trim', $modulIds)));
    if (empty($modulIds)) {
        echo json_encode(['success' => false, 'message' => 'Pilih minimal satu modul untuk diterbitkan.']);
        exit;
    }

    $idPeriode = 'per-' . substr(md5($periode), 0, 10);
    $stmtP = $db->prepare("INSERT INTO periodes (id_periode, nama_periode, siklus, tahun) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE nama_periode = VALUES(nama_periode), siklus = VALUES(siklus), tahun = VALUES(tahun)");
    $stmtP->execute([$idPeriode, $periode, $siklus, (int)date('Y')]);

    $db->beginTransaction();
    try {
        // 1. Modul yang DIPILIH: Jadwal dibuat/diperbarui dan status diset TERBIT
        foreach ($modulIds as $mId) {
            $idJadwal = 'jdw-' . substr(md5($idPeriode . $mId), 0, 12);
            $stmtJ = $db->prepare("
                INSERT INTO jadwal_moduls (id_jadwal, id_periode, id_modul, tenggat_unggah, mulai_penilaian, is_locked)
                VALUES (?, ?, ?, ?, ?, 0)
                ON DUPLICATE KEY UPDATE tenggat_unggah = VALUES(tenggat_unggah), mulai_penilaian = VALUES(mulai_penilaian), is_locked = 0
            ");
            $stmtJ->execute([$idJadwal, $idPeriode, $mId, $tenggat . ' 23:59:59', $mulaiPenilaian . ' 08:00:00']);

            // Modul yang dijadwalkan secara aktif otomatis dipromosikan ke status terbit
            $stmtUpSt = $db->prepare("UPDATE moduls SET status_template = 'terbit', status = 'terbit' WHERE id_modul = ?");
            $stmtUpSt->execute([$mId]);

            try {
                $stmtSyncMod = $db->prepare("UPDATE modules SET status = 'terbit' WHERE id = ?");
                $stmtSyncMod->execute([$mId]);
            } catch (Exception $e) {}
        }

        // 2. Modul yang TIDAK DIPILIH: Otomatis diset menjadi DRAF (Nonaktif) sesuai kemauan user
        $placeholders = implode(',', array_fill(0, count($modulIds), '?'));
        $stmtDraf = $db->prepare("UPDATE moduls SET status_template = 'draf', status = 'draf' WHERE id_modul NOT IN ($placeholders)");
        $stmtDraf->execute($modulIds);

        try {
            $stmtSyncDraf = $db->prepare("UPDATE modules SET status = 'draf' WHERE id NOT IN ($placeholders)");
            $stmtSyncDraf->execute($modulIds);
        } catch (Exception $e) {}

        // Bersihkan jadwal lama untuk modul yang dinonaktifkan (hanya jika belum memiliki relasi di evidens/rekomendasi_approvals)
        try {
            $stmtDelOldJdw = $db->prepare("
                DELETE FROM jadwal_moduls 
                WHERE id_modul NOT IN ($placeholders)
                  AND id_jadwal NOT IN (SELECT DISTINCT id_jadwal FROM evidens WHERE id_jadwal IS NOT NULL)
                  AND id_jadwal NOT IN (SELECT DISTINCT id_jadwal FROM rekomendasi_approvals WHERE id_jadwal IS NOT NULL)
            ");
            $stmtDelOldJdw->execute($modulIds);
        } catch (Exception $e) {}

        $db->commit();
        writeAuditLog('Terbitkan Jadwal Pengawasan', "$periode (" . count($modulIds) . " modul aktif diterbitkan)");
        echo json_encode([
            'success' => true, 
            'message' => 'Jadwal pengawasan aktif berhasil diterbitkan (' . count($modulIds) . ' modul aktif). Modul lainnya otomatis dijadikan draf.'
        ]);
    } catch (Exception $e) {
        $db->rollBack();
        echo json_encode(['success' => false, 'message' => 'Gagal menerbitkan jadwal: ' . $e->getMessage()]);
    }
    exit;
}

// 6. CRUD: MANAJEMEN PENGGUNA (Admin Only)
if ($action === 'create_user') {
    if (!hasPermission('usr', 't')) {
        echo json_encode(['success' => false, 'message' => 'Akses ditolak: Hanya Admin yang dapat menambah pengguna.']);
        exit;
    }
    $nama = trim($_POST['nama_lengkap'] ?? '');
    $nip = trim($_POST['nip_username'] ?? '');
    $role = trim($_POST['id_role'] ?? '');
    $unit = trim($_POST['id_unit'] ?? '');
    $pass = trim($_POST['password'] ?? 'password123');
    $statusAktif = isset($_POST['status_aktif']) ? (int)$_POST['status_aktif'] : 1;

    if ($nama === '' || $nip === '' || $role === '') {
        echo json_encode(['success' => false, 'message' => 'Nama lengkap, NIP/Username, dan Peran wajib diisi.']);
        exit;
    }
    $stmtCheck = $db->prepare("SELECT COUNT(*) FROM users WHERE nip_username = ?");
    $stmtCheck->execute([$nip]);
    if ($stmtCheck->fetchColumn() > 0) {
        echo json_encode(['success' => false, 'message' => 'NIP/Username telah terdaftar sebelumnya. Gunakan NIP/Username unik lain.']);
        exit;
    }

    $idUser = generateUUID();
    $hash = password_hash($pass !== '' ? $pass : 'password123', PASSWORD_BCRYPT);
    $unitVal = ($role === 'pic' && $unit !== '') ? $unit : null;

    $stmt = $db->prepare("INSERT INTO users (id_user, nip_username, password_hash, nama_lengkap, id_role, id_unit, status_aktif) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$idUser, $nip, $hash, $nama, $role, $unitVal, $statusAktif]);
    writeAuditLog('Tambah Pengguna Baru', "$nama ($nip) - Role: $role");
    echo json_encode(['success' => true, 'message' => "Akun pegawai {$nama} berhasil didaftarkan ke dalam sistem."]);
    exit;
}

if ($action === 'update_user') {
    if (!hasPermission('usr', 'u')) {
        echo json_encode(['success' => false, 'message' => 'Akses ditolak: Hanya Admin yang berwenang memperbarui akun pegawai.']);
        exit;
    }
    $idUser = trim($_POST['id_user'] ?? '');
    $nama = trim($_POST['nama_lengkap'] ?? '');
    $nip = trim($_POST['nip_username'] ?? '');
    $role = trim($_POST['id_role'] ?? '');
    $unit = isset($_POST['id_unit']) ? trim($_POST['id_unit']) : null;
    $pass = trim($_POST['password'] ?? '');
    $statusAktif = isset($_POST['status_aktif']) ? (int)$_POST['status_aktif'] : 1;

    if ($idUser === '' || $nama === '' || $nip === '' || $role === '') {
        echo json_encode(['success' => false, 'message' => 'Data tidak lengkap: ID, Nama lengkap, NIP/Username, dan Peran wajib diisi.']);
        exit;
    }

    $stmtOld = $db->prepare("SELECT u.*, r.nama_role, un.nama_unit FROM users u JOIN roles r ON u.id_role = r.id_role LEFT JOIN units un ON u.id_unit = un.id_unit WHERE u.id_user = ?");
    $stmtOld->execute([$idUser]);
    $oldUser = $stmtOld->fetch();
    if (!$oldUser) {
        echo json_encode(['success' => false, 'message' => 'Akun pengguna tidak ditemukan.']);
        exit;
    }

    // Validasi keunikan NIP/Username terhadap pengguna lain
    $stmtDup = $db->prepare("SELECT COUNT(*) FROM users WHERE nip_username = ? AND id_user != ?");
    $stmtDup->execute([$nip, $idUser]);
    if ($stmtDup->fetchColumn() > 0) {
        echo json_encode(['success' => false, 'message' => 'NIP/Username telah digunakan oleh akun pegawai lain. Harap gunakan yang unik.']);
        exit;
    }

    // Role selain PIC tidak terikat unit kerja bidang
    $unitVal = ($role === 'pic' && $unit !== '') ? $unit : null;

    if ($pass !== '') {
        $hash = password_hash($pass, PASSWORD_BCRYPT);
        $stmt = $db->prepare("UPDATE users SET nama_lengkap = ?, nip_username = ?, password_hash = ?, id_role = ?, id_unit = ?, status_aktif = ? WHERE id_user = ?");
        $stmt->execute([$nama, $nip, $hash, $role, $unitVal, $statusAktif, $idUser]);
    } else {
        $stmt = $db->prepare("UPDATE users SET nama_lengkap = ?, nip_username = ?, id_role = ?, id_unit = ?, status_aktif = ? WHERE id_user = ?");
        $stmt->execute([$nama, $nip, $role, $unitVal, $statusAktif, $idUser]);
    }

    $stmtR = $db->prepare("SELECT nama_role FROM roles WHERE id_role = ?");
    $stmtR->execute([$role]);
    $newRoleName = $stmtR->fetchColumn() ?: $role;

    $stmtUn = $db->prepare("SELECT nama_unit FROM units WHERE id_unit = ?");
    $stmtUn->execute([$unitVal]);
    $newUnitName = $stmtUn->fetchColumn() ?: 'Internal SKI / Pimpinan';

    // Jika yang diupdate adalah akun admin yang sedang login, update sesi auth
    if ($idUser === $currentUser['id']) {
        $_SESSION['username']     = $nip;
        $_SESSION['nama_lengkap'] = $nama;
        $_SESSION['id_role']     = $role;
        $_SESSION['nama_role']   = $newRoleName;
        $_SESSION['id_unit']     = $unitVal;
        $_SESSION['nama_unit']   = $newUnitName;
    }

    $passLog = ($pass !== '') ? ' [Kata sandi direset/diperbarui]' : '';
    writeAuditLog('Perbarui Akun Pegawai', "{$nama} ({$nip}) - Peran: {$newRoleName}, Unit: {$newUnitName}, Status: " . ($statusAktif === 1 ? 'Aktif' : 'Nonaktif') . $passLog);

    echo json_encode([
        'success' => true,
        'message' => "Data akun pegawai {$nama} berhasil diperbarui."
    ]);
    exit;
}

if ($action === 'update_user_role') {
    if (!hasPermission('usr', 'u')) {
        echo json_encode(['success' => false, 'message' => 'Akses ditolak: Hanya Admin yang berwenang mengubah peran pengguna.']);
        exit;
    }
    $idUser = trim($_POST['id_user'] ?? '');
    $role = trim($_POST['id_role'] ?? '');
    $unit = isset($_POST['id_unit']) ? trim($_POST['id_unit']) : null;

    if ($idUser === '' || $role === '') {
        echo json_encode(['success' => false, 'message' => 'ID pengguna dan peran baru wajib ditentukan.']);
        exit;
    }

    $stmtOld = $db->prepare("SELECT u.*, r.nama_role, un.nama_unit FROM users u JOIN roles r ON u.id_role = r.id_role LEFT JOIN units un ON u.id_unit = un.id_unit WHERE u.id_user = ?");
    $stmtOld->execute([$idUser]);
    $oldUser = $stmtOld->fetch();
    if (!$oldUser) {
        echo json_encode(['success' => false, 'message' => 'Pengguna tidak ditemukan.']);
        exit;
    }

    $unitVal = $unit;
    if ($role !== 'pic') {
        $unitVal = null; // Non-PIC (Pimpinan, Ketua SKI, Anggota SKI, Itjen, Admin) tidak terikat unit operasional
    }

    if ($unit !== null) {
        $stmt = $db->prepare("UPDATE users SET id_role = ?, id_unit = ? WHERE id_user = ?");
        $stmt->execute([$role, $unitVal, $idUser]);
    } else {
        $stmt = $db->prepare("UPDATE users SET id_role = ? WHERE id_user = ?");
        $stmt->execute([$role, $idUser]);
    }

    $stmtR = $db->prepare("SELECT nama_role FROM roles WHERE id_role = ?");
    $stmtR->execute([$role]);
    $newRoleName = $stmtR->fetchColumn() ?: $role;

    $stmtUn = $db->prepare("SELECT nama_unit FROM units WHERE id_unit = ?");
    $stmtUn->execute([$unitVal]);
    $newUnitName = $stmtUn->fetchColumn() ?: 'Internal SKI / Pimpinan';

    writeAuditLog('Ubah Peran & Akses Pengguna', "{$oldUser['nama_lengkap']} dialihkan dari {$oldUser['nama_role']} ke {$newRoleName} (Penempatan: {$newUnitName})");
    echo json_encode([
        'success' => true,
        'message' => "Peran {$oldUser['nama_lengkap']} berhasil diperbarui menjadi {$newRoleName}."
    ]);
    exit;
}

if ($action === 'toggle_user_status') {
    if (!hasPermission('usr', 'u')) {
        echo json_encode(['success' => false, 'message' => 'Akses ditolak.']);
        exit;
    }
    $idUser = trim($_POST['id_user'] ?? '');
    $stmt = $db->prepare("UPDATE users SET status_aktif = CASE WHEN status_aktif = 1 THEN 0 ELSE 1 END WHERE id_user = ?");
    $stmt->execute([$idUser]);
    writeAuditLog('Ubah Status Akun Pengguna', "User ID: $idUser");
    echo json_encode(['success' => true, 'message' => 'Status aktif pengguna berhasil dialihkan.']);
    exit;
}

if ($action === 'delete_user') {
    if (!hasPermission('usr', 'h')) {
        echo json_encode(['success' => false, 'message' => 'Akses ditolak: Hanya Admin yang dapat menghapus akun pegawai.']);
        exit;
    }
    $idUser = trim($_POST['id_user'] ?? '');
    if ($idUser === '') {
        echo json_encode(['success' => false, 'message' => 'ID pengguna tidak valid.']);
        exit;
    }
    if ($idUser === $currentUser['id']) {
        echo json_encode(['success' => false, 'message' => 'Anda tidak dapat menghapus akun Anda sendiri yang sedang aktif digunakan.']);
        exit;
    }

    // Cek keterkaitan dengan audit log atau berkas eviden
    $stmtCheckEv = $db->prepare("SELECT COUNT(*) FROM evidens WHERE id_user_pic = ?");
    $stmtCheckEv->execute([$idUser]);
    $hasEv = $stmtCheckEv->fetchColumn() > 0;

    $stmtCheckRev = $db->prepare("SELECT COUNT(*) FROM reviews WHERE id_user_reviewer = ?");
    $stmtCheckRev->execute([$idUser]);
    $hasRev = $stmtCheckRev->fetchColumn() > 0;

    $stmtCheckAud = $db->prepare("SELECT COUNT(*) FROM audit_logs WHERE id_user = ?");
    $stmtCheckAud->execute([$idUser]);
    $hasAud = $stmtCheckAud->fetchColumn() > 0;

    if ($hasEv || $hasRev || $hasAud) {
        // Demi menjaga integritas data pengawasan dan audit trail, akun dinonaktifkan
        $stmtU = $db->prepare("UPDATE users SET status_aktif = 0 WHERE id_user = ?");
        $stmtU->execute([$idUser]);
        writeAuditLog('Nonaktifkan Akun (Proteksi Audit)', "User ID: $idUser");
        echo json_encode([
            'success' => true,
            'message' => 'Akun pegawai memiliki riwayat aktivitas pengawasan/audit. Status akun berhasil dinonaktifkan untuk menjaga keutuhan jejak audit.'
        ]);
        exit;
    }

    $stmtDel = $db->prepare("DELETE FROM users WHERE id_user = ?");
    $stmtDel->execute([$idUser]);
    writeAuditLog('Hapus Akun Pengguna Permanen', "User ID: $idUser");
    echo json_encode(['success' => true, 'message' => 'Akun pegawai berhasil dihapus permanen dari sistem.']);
    exit;
}

// 6.b PROFIL AKUN PENGGUNA MANDIRI
if ($action === 'update_profile') {
    if (!$currentUser) {
        echo json_encode(['success' => false, 'message' => 'Sesi login telah berakhir. Silakan muat ulang halaman dan masuk kembali.']);
        exit;
    }

    $idUser = $currentUser['id'];
    $nama = trim($_POST['nama_lengkap'] ?? '');
    $nip = trim($_POST['nip_username'] ?? '');
    $currentPass = (string)($_POST['current_password'] ?? '');
    $newPass = (string)($_POST['new_password'] ?? '');
    $confirmPass = (string)($_POST['confirm_password'] ?? '');

    if ($nama === '') {
        echo json_encode(['success' => false, 'message' => 'Nama lengkap wajib diisi.']);
        exit;
    }

    // Ambil data terkini pengguna dari database
    $stmtU = $db->prepare("SELECT * FROM users WHERE id_user = ?");
    $stmtU->execute([$idUser]);
    $dbUser = $stmtU->fetch();
    if (!$dbUser) {
        echo json_encode(['success' => false, 'message' => 'Data pengguna tidak ditemukan di database.']);
        exit;
    }

    // Pengaturan NIP/Username: Hanya role Admin ('adm') yang berhak mengubah
    $isAdmin = ($currentUser['role'] === 'adm');
    $finalNip = $dbUser['nip_username'];
    if ($isAdmin && $nip !== '') {
        if ($nip !== $dbUser['nip_username']) {
            // Cek keunikan NIP/username baru
            $stmtDup = $db->prepare("SELECT COUNT(*) FROM users WHERE nip_username = ? AND id_user != ?");
            $stmtDup->execute([$nip, $idUser]);
            if ($stmtDup->fetchColumn() > 0) {
                echo json_encode(['success' => false, 'message' => 'NIP / Username telah digunakan oleh akun lain. Harap gunakan NIP/Username unik.']);
                exit;
            }
            $finalNip = $nip;
        }
    }

    // Pengaturan Kata Sandi
    $isChangingPassword = ($newPass !== '' || $currentPass !== '' || $confirmPass !== '');
    $newPasswordHash = null;

    if ($isChangingPassword) {
        if ($currentPass === '') {
            echo json_encode(['success' => false, 'message' => 'Silakan masukkan kata sandi saat ini untuk memverifikasi penggantian kata sandi.']);
            exit;
        }

        if (!password_verify($currentPass, $dbUser['password_hash'])) {
            echo json_encode(['success' => false, 'message' => 'Kata sandi saat ini yang Anda masukkan salah.']);
            exit;
        }

        if (strlen($newPass) < 5) {
            echo json_encode(['success' => false, 'message' => 'Kata sandi baru minimal 5 karakter demi keamanan akun Anda.']);
            exit;
        }

        if ($newPass !== $confirmPass) {
            echo json_encode(['success' => false, 'message' => 'Konfirmasi kata sandi baru tidak cocok dengan kata sandi baru.']);
            exit;
        }

        $newPasswordHash = password_hash($newPass, PASSWORD_BCRYPT);
    }

    // Eksekusi Update ke Database
    if ($newPasswordHash !== null) {
        $stmtUp = $db->prepare("UPDATE users SET nama_lengkap = ?, nip_username = ?, password_hash = ? WHERE id_user = ?");
        $stmtUp->execute([$nama, $finalNip, $newPasswordHash, $idUser]);
    } else {
        $stmtUp = $db->prepare("UPDATE users SET nama_lengkap = ?, nip_username = ? WHERE id_user = ?");
        $stmtUp->execute([$nama, $finalNip, $idUser]);
    }

    // Perbarui Sesi Pengguna
    $_SESSION['nama_lengkap'] = $nama;
    if ($isAdmin) {
        $_SESSION['username'] = $finalNip;
    }

    $passInfo = $isChangingPassword ? ' (dengan pembaruan kata sandi)' : '';
    writeAuditLog('Perbarui Profil Akun', "Pengguna '{$nama}' ({$finalNip}) memperbarui profil akun mandiri{$passInfo}");

    echo json_encode([
        'success' => true,
        'message' => 'Profil dan data akun Anda berhasil diperbarui' . ($isChangingPassword ? ' serta kata sandi baru berhasil disimpan.' : '.'),
        'user'    => getCurrentUser()
    ]);
    exit;
}

// 7. OPERASI TRANSAKSIONAL (Upload, Review, Approval, Matriks RBAC)
if ($action === 'upload_eviden') {
    if (!hasPermission('upl', 't')) {
        echo json_encode(['success' => false, 'message' => 'Anda tidak memiliki hak akses mengunggah eviden.']);
        exit;
    }
    $idJadwal = $_POST['id_jadwal'] ?? '';
    $idIndikator = $_POST['id_indikator'] ?? '';

    $stmtJ = $db->prepare("SELECT is_locked, tenggat_unggah FROM jadwal_moduls WHERE id_jadwal = ?");
    $stmtJ->execute([$idJadwal]);
    $jadwal = $stmtJ->fetch();

    if (!$jadwal || (int)$jadwal['is_locked'] === 1 || strtotime($jadwal['tenggat_unggah']) < time()) {
        echo json_encode(['success' => false, 'message' => 'Tenggat unggah terlewati atau jadwal belum aktif. Berkas tidak dapat diunggah.']);
        exit;
    }

    // Validasi modul pengawasan harus berstatus terbit dan aktif
    $stmtModCheck = $db->prepare("
        SELECT m.id_modul, m.nama_modul, m.status_template 
        FROM indikators i 
        JOIN moduls m ON i.id_modul = m.id_modul 
        WHERE i.id_indikator = ?
    ");
    $stmtModCheck->execute([$idIndikator]);
    $modCheck = $stmtModCheck->fetch();
    if (!$modCheck || $modCheck['status_template'] !== 'terbit') {
        echo json_encode(['success' => false, 'message' => 'Modul pengawasan ini masih berstatus draf internal SKI dan belum dapat diisi oleh PIC.']);
        exit;
    }

    $tipeEviden = trim($_POST['tipe_eviden'] ?? 'file');
    $metaSummary = trim($_POST['meta_summary'] ?? '');

    // 1. Tipe Khusus / Angka / Biner: numeric, binary_score, risk_scale, pbj_matrix
    if (in_array($tipeEviden, ['numeric', 'binary_score', 'risk_scale', 'pbj_matrix'], true)) {
        $nilaiIsian = trim($_POST['nilai_isian'] ?? '');
        $displayTitle = trim($_POST['display_title'] ?? $_POST['nama_file'] ?? '');
        if ($displayTitle === '') {
            if ($tipeEviden === 'numeric') $displayTitle = 'Data Isian Kuantitatif / Angka';
            elseif ($tipeEviden === 'binary_score') $displayTitle = 'Checklist Pemenuhan Biner KKR';
            elseif ($tipeEviden === 'pbj_matrix') $displayTitle = 'Matriks 4 Tepat Kepatuhan PBJ';
            elseif ($tipeEviden === 'risk_scale') $displayTitle = 'Penetapan Skala Level Risiko';
        }
        if ($metaSummary !== '') {
            $displayTitle = $metaSummary . ' - ' . $displayTitle;
        }
        if (mb_strlen($displayTitle) > 250) {
            $displayTitle = mb_substr($displayTitle, 0, 247) . '...';
        }

        $savedPath = '#';
        $sizeMb = 0.00;
        $formatFile = $tipeEviden;

        // Berkas dokumen pendukung opsional (PDF, Excel, Word)
        if (!empty($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['file'];
            if ($file['size'] <= 50 * 1024 * 1024) {
                $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                if (in_array($ext, ['pdf', 'xlsx', 'xls', 'docx', 'doc', 'zip', 'csv'], true)) {
                    $uploadDir = __DIR__ . '/uploads/evidens/';
                    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
                    $cleanName = preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $file['name']);
                    $newFileName = time() . '_' . $cleanName;
                    if (move_uploaded_file($file['tmp_name'], $uploadDir . $newFileName)) {
                        $savedPath = 'uploads/evidens/' . $newFileName;
                        $sizeMb = round($file['size'] / (1024 * 1024), 2);
                        $formatFile = $ext;
                    }
                }
            }
        } elseif (!empty($_POST['link_url'])) {
            $linkUrl = trim($_POST['link_url']);
            if (preg_match('/^https?:\/\//i', $linkUrl)) {
                $savedPath = $linkUrl;
                $formatFile = 'link';
            }
        }

        $stmtOld = $db->prepare("SELECT * FROM evidens WHERE id_jadwal = ? AND id_indikator = ? LIMIT 1");
        $stmtOld->execute([$idJadwal, $idIndikator]);
        $oldEv = $stmtOld->fetch();

        if ($oldEv) {
            if (!empty($oldEv['path_file']) && !preg_match('/^https?:\/\//i', $oldEv['path_file']) && $oldEv['path_file'] !== '#' && file_exists(__DIR__ . '/' . $oldEv['path_file'])) {
                @unlink(__DIR__ . '/' . $oldEv['path_file']);
            }
            $newVer = (int)$oldEv['versi'] + 1;
            $stmtUp = $db->prepare("UPDATE evidens SET nama_file = ?, path_file = ?, ukuran_file_mb = ?, format_file = ?, versi = ?, status_eviden = 'u', waktu_unggah = NOW(), nilai_isian = ? WHERE id_eviden = ?");
            $stmtUp->execute([$displayTitle, $savedPath, $sizeMb, $formatFile, $newVer, $nilaiIsian !== '' ? $nilaiIsian : null, $oldEv['id_eviden']]);
            writeAuditLog('Perbaikan Isian Tagihan', ($modCheck['nama_modul'] ?? 'Modul') . ' - ' . $displayTitle . ' (v' . $newVer . ')');
        } else {
            $idEviden = generateUUID();
            $stmtIns = $db->prepare("INSERT INTO evidens (id_eviden, id_jadwal, id_indikator, id_user_pic, nama_file, path_file, ukuran_file_mb, format_file, versi, status_eviden, waktu_unggah, nilai_isian) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 1, 'u', NOW(), ?)");
            $stmtIns->execute([$idEviden, $idJadwal, $idIndikator, $currentUser['id'], $displayTitle, $savedPath, $sizeMb, $formatFile, $nilaiIsian !== '' ? $nilaiIsian : null]);
            writeAuditLog('Input Isian Tagihan Baru', ($modCheck['nama_modul'] ?? 'Modul') . ' - ' . $displayTitle);
        }

        echo json_encode(['success' => true, 'message' => 'Data tagihan berhasil disimpan dan diajukan ke SKI.']);
        exit;
    }

    if ($tipeEviden === 'link') {
        $linkUrl = trim($_POST['link_url'] ?? '');
        if ($linkUrl === '') {
            echo json_encode(['success' => false, 'message' => 'Masukkan alamat tautan (link) eviden terlebih dahulu.']);
            exit;
        }
        if (!preg_match('/^https?:\/\//i', $linkUrl)) {
            $linkUrl = 'https://' . $linkUrl;
        }
        if (!filter_var($linkUrl, FILTER_VALIDATE_URL)) {
            echo json_encode(['success' => false, 'message' => 'Format tautan/URL tidak valid. Pastikan alamat URL lengkap dan benar (contoh: https://drive.google.com/...)']);
            exit;
        }

        $formatFile = 'link';
        $lowerUrl = strtolower($linkUrl);
        if (str_contains($lowerUrl, 'drive.google.com') || str_contains($lowerUrl, 'docs.google.com')) {
            $formatFile = 'gdrive';
        } elseif (str_contains($lowerUrl, 'onedrive') || str_contains($lowerUrl, 'sharepoint.com') || str_contains($lowerUrl, '1drv.ms')) {
            $formatFile = 'onedrive';
        } elseif (str_contains($lowerUrl, 'dropbox.com')) {
            $formatFile = 'dropbox';
        }

        $linkTitle = trim($_POST['link_title'] ?? '');
        if ($linkTitle === '') {
            if ($formatFile === 'gdrive') {
                $linkTitle = 'Tautan Google Drive';
            } elseif ($formatFile === 'onedrive') {
                $linkTitle = 'Tautan Microsoft OneDrive';
            } elseif ($formatFile === 'dropbox') {
                $linkTitle = 'Tautan Dropbox';
            } else {
                $linkTitle = 'Tautan Dokumen Eksternal';
            }
        }
        if ($metaSummary !== '') {
            $linkTitle = $metaSummary . ' - ' . $linkTitle;
        }
        if (mb_strlen($linkTitle) > 250) {
            $linkTitle = mb_substr($linkTitle, 0, 247) . '...';
        }

        $stmtOld = $db->prepare("SELECT * FROM evidens WHERE id_jadwal = ? AND id_indikator = ? LIMIT 1");
        $stmtOld->execute([$idJadwal, $idIndikator]);
        $oldEv = $stmtOld->fetch();

        if ($oldEv) {
            // Hapus berkas fisik lama jika sebelumnya berupa file lokal
            if (!empty($oldEv['path_file']) && !preg_match('/^https?:\/\//i', $oldEv['path_file']) && $oldEv['path_file'] !== '#') {
                $oldPath = __DIR__ . '/' . $oldEv['path_file'];
                if (file_exists($oldPath) && is_file($oldPath)) {
                    @unlink($oldPath);
                }
            }
            $newVer = (int)$oldEv['versi'] + 1;
            $stmtUp = $db->prepare("UPDATE evidens SET nama_file = ?, path_file = ?, ukuran_file_mb = 0, format_file = ?, versi = ?, status_eviden = 'u', waktu_unggah = NOW(), nilai_isian = NULL WHERE id_eviden = ?");
            $stmtUp->execute([$linkTitle, $linkUrl, $formatFile, $newVer, $oldEv['id_eviden']]);
            writeAuditLog('Upload perbaikan tautan eviden', ($modCheck['nama_modul'] ?? 'Modul') . ' - ' . $linkTitle . ' (v' . $newVer . ')');
        } else {
            $idEviden = generateUUID();
            $stmtIns = $db->prepare("INSERT INTO evidens (id_eviden, id_jadwal, id_indikator, id_user_pic, nama_file, path_file, ukuran_file_mb, format_file, versi, status_eviden, waktu_unggah, nilai_isian) VALUES (?, ?, ?, ?, ?, ?, 0, ?, 1, 'u', NOW(), NULL)");
            $stmtIns->execute([$idEviden, $idJadwal, $idIndikator, $currentUser['id'], $linkTitle, $linkUrl, $formatFile]);
            writeAuditLog('Upload tautan eviden baru', ($modCheck['nama_modul'] ?? 'Modul') . ' - ' . $linkTitle);
        }

        echo json_encode(['success' => true, 'message' => 'Tautan eviden berhasil disimpan dan diajukan ke SKI.']);
        exit;
    }

    // Default: Unggah berkas fisik (PDF, Excel, Word)
    if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
        echo json_encode(['success' => false, 'message' => 'Gagal mengunggah berkas atau berkas kosong.']);
        exit;
    }

    $file = $_FILES['file'];
    if ($file['size'] > 50 * 1024 * 1024) {
        echo json_encode(['success' => false, 'message' => 'Ukuran berkas melebihi batas 50 MB (RNF-05).']);
        exit;
    }

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, ['pdf', 'xlsx', 'xls', 'docx', 'doc'], true)) {
        echo json_encode(['success' => false, 'message' => 'Format ekstensi tidak diizinkan. Gunakan PDF, Excel, atau Word.']);
        exit;
    }

    $uploadDir = __DIR__ . '/uploads/evidens/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

    $cleanName = preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $file['name']);
    $newFileName = time() . '_' . $cleanName;
    $targetPath = $uploadDir . $newFileName;

    if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
        echo json_encode(['success' => false, 'message' => 'Gagal menyimpan berkas di server storage.']);
        exit;
    }

    $finalDisplayName = $file['name'];
    if ($metaSummary !== '') {
        $finalDisplayName = $metaSummary . ' - ' . $file['name'];
    }
    if (mb_strlen($finalDisplayName) > 250) {
        $finalDisplayName = mb_substr($finalDisplayName, 0, 247) . '...';
    }

    $sizeMb = round($file['size'] / (1024 * 1024), 2);
    $stmtOld = $db->prepare("SELECT * FROM evidens WHERE id_jadwal = ? AND id_indikator = ? LIMIT 1");
    $stmtOld->execute([$idJadwal, $idIndikator]);
    $oldEv = $stmtOld->fetch();

    if ($oldEv) {
        // Hapus berkas fisik lama jika sebelumnya berupa file lokal
        if (!empty($oldEv['path_file']) && !preg_match('/^https?:\/\//i', $oldEv['path_file']) && $oldEv['path_file'] !== '#') {
            $oldPath = __DIR__ . '/' . $oldEv['path_file'];
            if (file_exists($oldPath) && is_file($oldPath)) {
                @unlink($oldPath);
            }
        }
        $newVer = (int)$oldEv['versi'] + 1;
        $stmtUp = $db->prepare("UPDATE evidens SET nama_file = ?, path_file = ?, ukuran_file_mb = ?, format_file = ?, versi = ?, status_eviden = 'u', waktu_unggah = NOW(), nilai_isian = NULL WHERE id_eviden = ?");
        $stmtUp->execute([$finalDisplayName, 'uploads/evidens/' . $newFileName, $sizeMb, $ext, $newVer, $oldEv['id_eviden']]);
        writeAuditLog('Upload perbaikan eviden', ($modCheck['nama_modul'] ?? 'Modul') . ' - ' . $finalDisplayName . ' (v' . $newVer . ')');
    } else {
        $idEviden = generateUUID();
        $stmtIns = $db->prepare("INSERT INTO evidens (id_eviden, id_jadwal, id_indikator, id_user_pic, nama_file, path_file, ukuran_file_mb, format_file, versi, status_eviden, waktu_unggah, nilai_isian) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 1, 'u', NOW(), NULL)");
        $stmtIns->execute([$idEviden, $idJadwal, $idIndikator, $currentUser['id'], $finalDisplayName, 'uploads/evidens/' . $newFileName, $sizeMb, $ext]);
        writeAuditLog('Upload eviden baru', ($modCheck['nama_modul'] ?? 'Modul') . ' - ' . $finalDisplayName);
    }

    echo json_encode(['success' => true, 'message' => 'Berkas eviden berhasil diunggah.']);
    exit;
}

if ($action === 'delete_eviden') {
    if (!hasPermission('upl', 'h') && !hasPermission('upl', 'u') && !hasPermission('upl', 't')) {
        echo json_encode(['success' => false, 'message' => 'Anda tidak memiliki hak akses menghapus eviden.']);
        exit;
    }
    $idEviden = trim($_POST['id_eviden'] ?? '');
    $stmt = $db->prepare("
        SELECT e.*, m.nama_modul 
        FROM evidens e 
        JOIN indikators i ON e.id_indikator = i.id_indikator 
        JOIN moduls m ON i.id_modul = m.id_modul 
        WHERE e.id_eviden = ? LIMIT 1
    ");
    $stmt->execute([$idEviden]);
    $ev = $stmt->fetch();
    if (!$ev) {
        echo json_encode(['success' => false, 'message' => 'Berkas eviden tidak ditemukan.']);
        exit;
    }
    if (!empty($ev['path_file']) && !preg_match('/^https?:\/\//i', $ev['path_file']) && file_exists(__DIR__ . '/' . $ev['path_file'])) {
        @unlink(__DIR__ . '/' . $ev['path_file']);
    }
    $stmtRev = $db->prepare("DELETE FROM reviews WHERE id_eviden = ?");
    $stmtRev->execute([$idEviden]);
    $stmtDel = $db->prepare("DELETE FROM evidens WHERE id_eviden = ?");
    $stmtDel->execute([$idEviden]);
    writeAuditLog('Hapus berkas eviden', ($ev['nama_modul'] ?? 'Modul') . ' - ' . $ev['nama_file']);
    echo json_encode(['success' => true, 'message' => 'Berkas eviden berhasil dihapus.']);
    exit;
}

if ($action === 'log_view_eviden') {
    $targetName = trim($_POST['modul_name'] ?? $_POST['target_name'] ?? 'Modul Eviden');
    $jenisAksi = trim($_POST['jenis_aksi'] ?? 'Membaca & Melihat Modul');
    if ($currentUser) {
        $stmtRecent = $db->prepare("SELECT COUNT(*) FROM audit_logs WHERE id_user = ? AND jenis_aksi = ? AND objek_target = ? AND timestamp_aktivitas >= DATE_SUB(NOW(), INTERVAL 2 MINUTE)");
        $stmtRecent->execute([$currentUser['id'], $jenisAksi, $targetName]);
        if ((int)$stmtRecent->fetchColumn() === 0) {
            writeAuditLog($jenisAksi, $targetName);
        }
    }
    echo json_encode(['success' => true]);
    exit;
}

if ($action === 'log_download_template') {
    $tplName = trim($_POST['template_name'] ?? 'Template Acuan');
    $modName = trim($_POST['modul_name'] ?? '');
    $target = $modName !== '' ? ($modName . ' - Template: ' . $tplName) : $tplName;
    writeAuditLog('Unduh Template Acuan', $target);
    echo json_encode(['success' => true]);
    exit;
}

if ($action === 'submit_review') {
    if (!hasPermission('rev', 'u') && !hasPermission('rev', 's')) {
        echo json_encode(['success' => false, 'message' => 'Akses ditolak.']);
        exit;
    }
    $reviews = json_decode($_POST['reviews'] ?? '[]', true);
    if (!is_array($reviews) || empty($reviews)) {
        echo json_encode(['success' => false, 'message' => 'Data review kosong.']);
        exit;
    }
    $db->beginTransaction();
    try {
        $lastStatus = '';
        foreach ($reviews as $rev) {
            $idEviden = $rev['id_eviden'];
            $status   = $rev['status'];
            $lastStatus = $status;
            $catatan  = trim($rev['catatan'] ?? '');
            $formulaScore = trim($rev['formula_score'] ?? '');
            if ($formulaScore !== '') {
                $catatan = $formulaScore . ($catatan !== '' ? "\nCatatan: " . $catatan : '');
            }

            if ($status === 'final' || $status === 'ok_final' || $status === 'selesai') {
                $statusEviden = 'f';
                $statusKesesuaian = 'sesuai';
            } elseif ($status === 'no' || $status === 'revisi') {
                $statusEviden = 'r';
                $statusKesesuaian = 'tidak_sesuai';
            } else {
                // Default: SKI review & approve -> status 'a' (lanjut ke Meja Pimpinan)
                $statusEviden = 'a';
                $statusKesesuaian = 'sesuai';
            }

            $stmtU = $db->prepare("UPDATE evidens SET status_eviden = ? WHERE id_eviden = ?");
            $stmtU->execute([$statusEviden, $idEviden]);

            $stmtDel = $db->prepare("DELETE FROM reviews WHERE id_eviden = ?");
            $stmtDel->execute([$idEviden]);

            $stmtR = $db->prepare("INSERT INTO reviews (id_review, id_eviden, id_user_reviewer, status_kesesuaian, catatan_temuan, waktu_review) VALUES (?, ?, ?, ?, ?, NOW())");
            $stmtR->execute([generateUUID(), $idEviden, $currentUser['id'], $statusKesesuaian, $catatan]);
        }
        $db->commit();
        if ($lastStatus === 'final' || $lastStatus === 'ok_final') {
            writeAuditLog('Ketua SKI menyatakan Selesai (Sesuai)', count($reviews) . ' butir eviden diselesaikan');
            $msg = 'Berkas eviden telah dinyatakan Sesuai & Selesai secara keseluruhan.';
        } elseif ($lastStatus === 'no' || $lastStatus === 'revisi') {
            writeAuditLog('Pengembalian berkas ke PIC untuk perbaikan', count($reviews) . ' butir eviden dikembalikan');
            $msg = 'Berkas berhasil dikembalikan ke PIC untuk perbaikan.';
        } else {
            writeAuditLog('Ajukan berkas ke Meja Pimpinan', count($reviews) . ' butir eviden disetujui & diajukan');
            $msg = 'Berkas eviden berhasil disetujui SKI dan diajukan ke Meja Pimpinan.';
        }
        echo json_encode(['success' => true, 'message' => $msg]);
    } catch (Exception $e) {
        $db->rollBack();
        echo json_encode(['success' => false, 'message' => 'Gagal memproses review: ' . $e->getMessage()]);
    }
    exit;
}

if ($action === 'approve_ketua') {
    if (!hasPermission('rev', 'u') && !hasPermission('rev', 's') && !hasPermission('apr', 's')) {
        echo json_encode(['success' => false, 'message' => 'Akses approval/rekomendasi Ketua SKI ditolak.']);
        exit;
    }
    $ids = json_decode($_POST['ids'] ?? '[]', true);
    $tipe = $_POST['tipe'] ?? 'single';
    $rekomendasi = trim($_POST['rekomendasi'] ?? '');
    $idModul = $_POST['id_modul'] ?? '';
    $idJadwal = $_POST['id_jadwal'] ?? '';

    if (empty($ids) && $tipe !== 'send_recom' && $tipe !== 'finalize_modul') {
        echo json_encode(['success' => false, 'message' => 'Pilih berkas terlebih dahulu.']);
        exit;
    }

    if ($tipe === 'return') {
        $inQuery = implode(',', array_fill(0, count($ids), '?'));
        $stmt = $db->prepare("UPDATE evidens SET status_eviden = 'r' WHERE id_eviden IN ($inQuery)");
        $stmt->execute($ids);
        writeAuditLog('Kembalikan berkas ke PIC', count($ids) . ' berkas');
        echo json_encode(['success' => true, 'message' => 'Berkas dikembalikan ke PIC untuk perbaikan.']);
        exit;
    }

    if ($tipe === 'single' || $tipe === 'bulk' || $tipe === 'finalize_sesuai') {
        $inQuery = implode(',', array_fill(0, count($ids), '?'));
        $stmt = $db->prepare("UPDATE evidens SET status_eviden = 'f' WHERE id_eviden IN ($inQuery)");
        $stmt->execute($ids);
        writeAuditLog('Ketua SKI menyatakan Selesai (Sesuai)', count($ids) . ' berkas diselesaikan');
        echo json_encode(['success' => true, 'message' => count($ids) . ' berkas dinyatakan Sesuai & Selesai secara keseluruhan.']);
        exit;
    }

    if ($tipe === 'finalize_modul') {
        if ($idModul === '') {
            echo json_encode(['success' => false, 'message' => 'Modul tidak valid.']);
            exit;
        }
        $stmt = $db->prepare("UPDATE evidens SET status_eviden = 'f' WHERE id_indikator IN (SELECT id_indikator FROM indikators WHERE id_modul = ?)");
        $stmt->execute([$idModul]);
        writeAuditLog('Ketua SKI menyelesaikan seluruh berkas modul', 'ID Modul: ' . $idModul);
        echo json_encode(['success' => true, 'message' => 'Seluruh berkas modul telah dinyatakan Sesuai & Selesai secara keseluruhan.']);
        exit;
    }

    if ($tipe === 'send_recom') {
        if ($rekomendasi === '') {
            echo json_encode(['success' => false, 'message' => 'Poin rekomendasi resmi wajib diisi.']);
            exit;
        }
        $stmtCheck = $db->prepare("SELECT id_rekomendasi, keputusan_pimpinan FROM rekomendasi_approvals WHERE id_modul = ?");
        $stmtCheck->execute([$idModul]);
        $existingRec = $stmtCheck->fetch();

        if ($existingRec) {
            $kp = $existingRec['keputusan_pimpinan'];
            if ($kp === 'Disetujui') {
                echo json_encode(['success' => false, 'message' => 'Rekomendasi resmi untuk modul ini telah disetujui Pimpinan. Silakan selesaikan seluruh berkas modul.']);
                exit;
            } else {
                // Status 'Menunggu', 'Ditolak', atau 'Revisi' (Disposisi): Boleh kirim ulang / perbarui rekomendasi versi terbaru
                $stmtRec = $db->prepare("UPDATE rekomendasi_approvals SET poin_rekomendasi = ?, status_approval_ketua = 'Disetujui', is_dilihat_pimpinan = 0, waktu_dilihat_pimpinan = NULL, keputusan_pimpinan = 'Menunggu', catatan_disposisi = NULL, id_pimpinan = NULL, waktu_keputusan = NULL WHERE id_rekomendasi = ?");
                $stmtRec->execute([$rekomendasi, $existingRec['id_rekomendasi']]);
            }
        } else {
            $stmtRec = $db->prepare("INSERT INTO rekomendasi_approvals (id_rekomendasi, id_jadwal, id_modul, id_ketua_ski, poin_rekomendasi, status_approval_ketua, is_dilihat_pimpinan, keputusan_pimpinan) VALUES (?, ?, ?, ?, ?, 'Disetujui', 0, 'Menunggu')");
            $stmtRec->execute([generateUUID(), $idJadwal, $idModul, $currentUser['id'], $rekomendasi]);
        }

        // Majukan status eviden yang masih 'u' menjadi 'a' (menunggu persetujuan pimpinan)
        $stmtEv = $db->prepare("UPDATE evidens SET status_eviden = 'a' WHERE id_indikator IN (SELECT id_indikator FROM indikators WHERE id_modul = ?) AND status_eviden = 'u'");
        $stmtEv->execute([$idModul]);
        writeAuditLog('Kirim rekomendasi ke Pimpinan', 'Modul ID: ' . $idModul);
        echo json_encode(['success' => true, 'message' => 'Rekomendasi resmi pengawasan berhasil dikirim ke Meja Pimpinan.']);
        exit;
    }
}

if ($action === 'bulk_approve_pic_to_pimpinan') {
    if (!hasPermission('rev', 'u') && !hasPermission('rev', 's') && !hasPermission('apr', 's') && !hasPermission('upl', 'u') && !hasPermission('upl', 't')) {
        echo json_encode(['success' => false, 'message' => 'Akses approval massal ke Pimpinan ditolak.']);
        exit;
    }

    $idModul = trim($_POST['id_modul'] ?? '');
    if ($idModul === '') {
        echo json_encode(['success' => false, 'message' => 'Parameter modul tidak valid.']);
        exit;
    }

    $stmtMod = $db->prepare("SELECT id_modul, nama_modul, id_jadwal FROM moduls WHERE id_modul = ? LIMIT 1");
    $stmtMod->execute([$idModul]);
    $mod = $stmtMod->fetch();
    if (!$mod) {
        echo json_encode(['success' => false, 'message' => 'Data modul tidak ditemukan.']);
        exit;
    }

    $idJadwal = trim($_POST['id_jadwal'] ?? '') ?: ($mod['id_jadwal'] ?? '');
    $ids = json_decode($_POST['ids'] ?? '[]', true);

    $db->beginTransaction();
    try {
        if (!empty($ids) && is_array($ids)) {
            $inQuery = implode(',', array_fill(0, count($ids), '?'));
            $stmtUp = $db->prepare("UPDATE evidens SET status_eviden = 'a' WHERE id_eviden IN ($inQuery)");
            $stmtUp->execute($ids);
            $totalUpdated = count($ids);
        } else {
            $stmtUp = $db->prepare("
                UPDATE evidens SET status_eviden = 'a' 
                WHERE id_indikator IN (SELECT id_indikator FROM indikators WHERE id_modul = ?) 
                AND status_eviden IN ('u', 'o', 'r', 'n')
            ");
            $stmtUp->execute([$idModul]);
            $totalUpdated = $stmtUp->rowCount();
        }

        // Pastikan ada rekomendasi resmi ke Meja Pimpinan
        $poinRekomendasi = trim($_POST['rekomendasi'] ?? '') ?: ('Seluruh berkas eviden modul ' . $mod['nama_modul'] . ' telah diverifikasi dan diserahkan untuk pengesahan Kepala BBPK.');
        $stmtCheckRec = $db->prepare("SELECT id_rekomendasi FROM rekomendasi_approvals WHERE id_modul = ?");
        $stmtCheckRec->execute([$idModul]);
        $existingRecId = $stmtCheckRec->fetchColumn();

        if ($existingRecId) {
            $stmtRec = $db->prepare("UPDATE rekomendasi_approvals SET poin_rekomendasi = ?, status_approval_ketua = 'Disetujui', is_dilihat_pimpinan = 0, waktu_dilihat_pimpinan = NULL, keputusan_pimpinan = 'Menunggu', catatan_disposisi = NULL, id_pimpinan = NULL, waktu_keputusan = NULL WHERE id_rekomendasi = ?");
            $stmtRec->execute([$poinRekomendasi, $existingRecId]);
        } else {
            $stmtKet = $db->query("SELECT id_user FROM users WHERE id_role = 'ket' AND status_aktif = 1 LIMIT 1");
            $idKetua = $stmtKet->fetchColumn() ?: $currentUser['id'];
            $stmtRec = $db->prepare("INSERT INTO rekomendasi_approvals (id_rekomendasi, id_jadwal, id_modul, id_ketua_ski, poin_rekomendasi, status_approval_ketua, is_dilihat_pimpinan, keputusan_pimpinan) VALUES (?, ?, ?, ?, ?, 'Disetujui', 0, 'Menunggu')");
            $stmtRec->execute([generateUUID(), $idJadwal, $idModul, $idKetua, $poinRekomendasi]);
        }

        $db->commit();
        writeAuditLog('Bulk Approval Eviden PIC ke Pimpinan', $mod['nama_modul'] . ' - Seluruh eviden disetujui & diserahkan ke Meja Pimpinan');
        echo json_encode(['success' => true, 'message' => 'Seluruh berkas eviden PIC pada modul ' . $mod['nama_modul'] . ' berhasil disetujui dan diserahkan ke Meja Pimpinan.']);
        exit;
    } catch (Exception $e) {
        $db->rollBack();
        echo json_encode(['success' => false, 'message' => 'Gagal memproses approval massal: ' . $e->getMessage()]);
        exit;
    }
}

if ($action === 'approval_pimpinan') {
    if (!hasPermission('apm', 's')) {
        echo json_encode(['success' => false, 'message' => 'Akses pimpinan ditolak.']);
        exit;
    }
    $subAction = $_POST['sub_action'] ?? '';
    $idRekomendasi = trim($_POST['id_rekomendasi'] ?? '');
    $idEviden = trim($_POST['id_eviden'] ?? '');
    $idModul = trim($_POST['id_modul'] ?? '');
    $keputusan = $_POST['keputusan'] ?? '';
    $catatan = trim($_POST['catatan_disposisi'] ?? '');

    if ($subAction === 'mark_seen') {
        if ($idRekomendasi !== '') {
            $stmt = $db->prepare("UPDATE rekomendasi_approvals SET is_dilihat_pimpinan = 1, waktu_dilihat_pimpinan = IFNULL(waktu_dilihat_pimpinan, NOW()) WHERE id_rekomendasi = ?");
            $stmt->execute([$idRekomendasi]);
            writeAuditLog('Pimpinan melihat rekomendasi', 'ID Rek: ' . $idRekomendasi);
        }
        echo json_encode(['success' => true]);
        exit;
    }

    $db->beginTransaction();
    try {
        if ($idEviden !== '') {
            // Evaluasi berkas eviden / revisi spesifik
            $stmtE = $db->prepare("SELECT e.*, m.nama_modul, i.deskripsi_indikator FROM evidens e JOIN indikators i ON e.id_indikator = i.id_indikator JOIN moduls m ON i.id_modul = m.id_modul WHERE e.id_eviden = ?");
            $stmtE->execute([$idEviden]);
            $ev = $stmtE->fetch();
            if (!$ev) {
                $db->rollBack();
                echo json_encode(['success' => false, 'message' => 'Berkas eviden tidak ditemukan.']);
                exit;
            }

            if ($keputusan === 'Setuju' || $keputusan === 'Disetujui') {
                // Ketika Pimpinan menyetujui, berkas kembali ke SKI dengan status 'p' (Disetujui Pimpinan)
                $stmtU = $db->prepare("UPDATE evidens SET status_eviden = 'p' WHERE id_eviden = ?");
                $stmtU->execute([$idEviden]);
                if ($catatan !== '') {
                    $stmtRev = $db->prepare("UPDATE reviews SET catatan_temuan = CONCAT(IFNULL(catatan_temuan, ''), '\n[Disposisi Pimpinan]: ', ?) WHERE id_eviden = ?");
                    $stmtRev->execute([$catatan, $idEviden]);
                }
                writeAuditLog('Pimpinan menyetujui berkas eviden (kembali ke SKI)', $ev['nama_file'] . ' (' . $ev['nama_modul'] . ') - Versi ' . $ev['versi']);
            } elseif ($keputusan === 'Ditolak') {
                if ($catatan === '') {
                    $db->rollBack();
                    echo json_encode(['success' => false, 'message' => 'Catatan penolakan wajib diisi untuk dikembalikan ke Tim SKI.']);
                    exit;
                }
                // Opsi Ditolak: Kembali lagi ke antrean SKI (status_eviden = 'u')
                $stmtU = $db->prepare("UPDATE evidens SET status_eviden = 'u' WHERE id_eviden = ?");
                $stmtU->execute([$idEviden]);

                $stmtRev = $db->prepare("DELETE FROM reviews WHERE id_eviden = ?");
                $stmtRev->execute([$idEviden]);
                $stmtIns = $db->prepare("INSERT INTO reviews (id_review, id_eviden, id_user_reviewer, status_kesesuaian, catatan_temuan, waktu_review) VALUES (?, ?, ?, 'tidak_sesuai', ?, NOW())");
                $stmtIns->execute([generateUUID(), $idEviden, $currentUser['id'], 'Penolakan Pimpinan (Kembali ke SKI): ' . $catatan]);
                writeAuditLog('Pimpinan menolak berkas eviden (kembali ke SKI)', $ev['nama_file'] . ' (v' . $ev['versi'] . '): ' . $catatan);
            } elseif ($keputusan === 'Revisi' || $keputusan === 'Disposisi') {
                if ($catatan === '') {
                    $db->rollBack();
                    echo json_encode(['success' => false, 'message' => 'Catatan instruksi revisi wajib diisi untuk perbaikan oleh PIC.']);
                    exit;
                }
                // Opsi Revisi: Kembali ke PIC laporan modulnya (status_eviden = 'r')
                $stmtU = $db->prepare("UPDATE evidens SET status_eviden = 'r' WHERE id_eviden = ?");
                $stmtU->execute([$idEviden]);

                $stmtRev = $db->prepare("DELETE FROM reviews WHERE id_eviden = ?");
                $stmtRev->execute([$idEviden]);
                $stmtIns = $db->prepare("INSERT INTO reviews (id_review, id_eviden, id_user_reviewer, status_kesesuaian, catatan_temuan, waktu_review) VALUES (?, ?, ?, 'tidak_sesuai', ?, NOW())");
                $stmtIns->execute([generateUUID(), $idEviden, $currentUser['id'], 'Instruksi Revisi Pimpinan (Kembali ke PIC): ' . $catatan]);
                writeAuditLog('Pimpinan meminta revisi berkas eviden ke PIC', $ev['nama_file'] . ' (v' . $ev['versi'] . '): ' . $catatan);
            } else {
                $db->rollBack();
                echo json_encode(['success' => false, 'message' => 'Opsi keputusan pimpinan tidak valid.']);
                exit;
            }
        } elseif ($idRekomendasi !== '') {
            $stmtR = $db->prepare("SELECT * FROM rekomendasi_approvals WHERE id_rekomendasi = ?");
            $stmtR->execute([$idRekomendasi]);
            $rec = $stmtR->fetch();

            if (!$rec) {
                $db->rollBack();
                echo json_encode(['success' => false, 'message' => 'Data rekomendasi tidak ditemukan.']);
                exit;
            }

            if ($keputusan === 'Setuju' || $keputusan === 'Disetujui') {
                $stmtUp = $db->prepare("UPDATE rekomendasi_approvals SET keputusan_pimpinan = 'Disetujui', id_pimpinan = ?, waktu_keputusan = NOW() WHERE id_rekomendasi = ?");
                $stmtUp->execute([$currentUser['id'], $idRekomendasi]);

                // Berkas di modul disiapkan di 'p' (Disetujui Pimpinan) agar kembali ke SKI untuk penyelesaian akhir secara keseluruhan
                $stmtEv = $db->prepare("UPDATE evidens SET status_eviden = 'p' WHERE id_indikator IN (SELECT id_indikator FROM indikators WHERE id_modul = ?) AND status_eviden != 'f'");
                $stmtEv->execute([$rec['id_modul']]);
                writeAuditLog('Pimpinan menyetujui evaluasi modul (kembali ke SKI)', 'Modul ID: ' . $rec['id_modul']);
            } elseif ($keputusan === 'Ditolak') {
                if ($catatan === '') {
                    $db->rollBack();
                    echo json_encode(['success' => false, 'message' => 'Catatan penolakan wajib diisi untuk dikembalikan ke Tim SKI.']);
                    exit;
                }
                // Opsi Ditolak: Modul kembali ke antrean SKI (status_eviden = 'u')
                $stmtUp = $db->prepare("UPDATE rekomendasi_approvals SET keputusan_pimpinan = 'Ditolak', catatan_disposisi = ?, id_pimpinan = ?, waktu_keputusan = NOW() WHERE id_rekomendasi = ?");
                $stmtUp->execute([$catatan, $currentUser['id'], $idRekomendasi]);

                $stmtEv = $db->prepare("UPDATE evidens SET status_eviden = 'u' WHERE id_indikator IN (SELECT id_indikator FROM indikators WHERE id_modul = ?)");
                $stmtEv->execute([$rec['id_modul']]);
                writeAuditLog('Pimpinan menolak rekomendasi modul (kembali ke SKI)', $catatan);
            } elseif ($keputusan === 'Revisi' || $keputusan === 'Disposisi') {
                if ($catatan === '') {
                    $db->rollBack();
                    echo json_encode(['success' => false, 'message' => 'Catatan instruksi revisi wajib diisi untuk perbaikan oleh PIC.']);
                    exit;
                }
                // Opsi Revisi: Modul kembali ke PIC untuk perbaikan laporan (status_eviden = 'r')
                $stmtUp = $db->prepare("UPDATE rekomendasi_approvals SET keputusan_pimpinan = 'Revisi', catatan_disposisi = ?, id_pimpinan = ?, waktu_keputusan = NOW() WHERE id_rekomendasi = ?");
                $stmtUp->execute([$catatan, $currentUser['id'], $idRekomendasi]);

                $stmtEv = $db->prepare("UPDATE evidens SET status_eviden = 'r' WHERE id_indikator IN (SELECT id_indikator FROM indikators WHERE id_modul = ?)");
                $stmtEv->execute([$rec['id_modul']]);
                writeAuditLog('Pimpinan meminta revisi modul ke PIC', $catatan);
            } else {
                $db->rollBack();
                echo json_encode(['success' => false, 'message' => 'Opsi keputusan pimpinan tidak valid.']);
                exit;
            }
        } elseif ($idModul !== '') {
            $stmtCheckRec = $db->prepare("SELECT id_rekomendasi FROM rekomendasi_approvals WHERE id_modul = ? LIMIT 1");
            $stmtCheckRec->execute([$idModul]);
            $recRow = $stmtCheckRec->fetch();

            if ($keputusan === 'Setuju' || $keputusan === 'Disetujui') {
                if ($recRow) {
                    $stmtUpRec = $db->prepare("UPDATE rekomendasi_approvals SET keputusan_pimpinan = 'Disetujui', id_pimpinan = ?, waktu_keputusan = NOW() WHERE id_rekomendasi = ?");
                    $stmtUpRec->execute([$currentUser['id'], $recRow['id_rekomendasi']]);
                }
                // Ketika Pimpinan menyetujui modul, berkas kembali ke SKI dengan status 'p' (Disetujui Pimpinan)
                $stmtEv = $db->prepare("UPDATE evidens SET status_eviden = 'p' WHERE id_indikator IN (SELECT id_indikator FROM indikators WHERE id_modul = ?) AND status_eviden != 'f'");
                $stmtEv->execute([$idModul]);
                writeAuditLog('Pimpinan menyetujui berkas modul (kembali ke SKI)', 'Modul ID: ' . $idModul);
            } elseif ($keputusan === 'Ditolak') {
                if ($catatan === '') {
                    $db->rollBack();
                    echo json_encode(['success' => false, 'message' => 'Catatan penolakan wajib diisi untuk dikembalikan ke Tim SKI.']);
                    exit;
                }
                if ($recRow) {
                    $stmtUpRec = $db->prepare("UPDATE rekomendasi_approvals SET keputusan_pimpinan = 'Ditolak', catatan_disposisi = ?, id_pimpinan = ?, waktu_keputusan = NOW() WHERE id_rekomendasi = ?");
                    $stmtUpRec->execute([$catatan, $currentUser['id'], $recRow['id_rekomendasi']]);
                }
                $stmtEv = $db->prepare("UPDATE evidens SET status_eviden = 'u' WHERE id_indikator IN (SELECT id_indikator FROM indikators WHERE id_modul = ?)");
                $stmtEv->execute([$idModul]);
                writeAuditLog('Pimpinan menolak berkas modul (kembali ke SKI)', $catatan);
            } elseif ($keputusan === 'Revisi' || $keputusan === 'Disposisi') {
                if ($catatan === '') {
                    $db->rollBack();
                    echo json_encode(['success' => false, 'message' => 'Catatan instruksi revisi wajib diisi untuk perbaikan oleh PIC.']);
                    exit;
                }
                if ($recRow) {
                    $stmtUpRec = $db->prepare("UPDATE rekomendasi_approvals SET keputusan_pimpinan = 'Revisi', catatan_disposisi = ?, id_pimpinan = ?, waktu_keputusan = NOW() WHERE id_rekomendasi = ?");
                    $stmtUpRec->execute([$catatan, $currentUser['id'], $recRow['id_rekomendasi']]);
                }
                $stmtEv = $db->prepare("UPDATE evidens SET status_eviden = 'r' WHERE id_indikator IN (SELECT id_indikator FROM indikators WHERE id_modul = ?)");
                $stmtEv->execute([$idModul]);
                writeAuditLog('Pimpinan meminta revisi berkas modul ke PIC', $catatan);
            } else {
                $db->rollBack();
                echo json_encode(['success' => false, 'message' => 'Opsi keputusan pimpinan tidak valid.']);
                exit;
            }
        } else {
            $db->rollBack();
            echo json_encode(['success' => false, 'message' => 'Parameter evaluasi tidak lengkap.']);
            exit;
        }

        $db->commit();
        $msg = 'Keputusan evaluasi Pimpinan berhasil dicatat.';
        if ($keputusan === 'Setuju' || $keputusan === 'Disetujui') {
            $msg = 'Persetujuan Pimpinan berhasil diberikan. Modul dikembalikan ke Tim SKI dengan status Disetujui Pimpinan untuk penyelesaian akhir secara keseluruhan.';
        } elseif ($keputusan === 'Ditolak') {
            $msg = 'Rekomendasi berhasil ditolak dan dikembalikan ke Tim SKI untuk ditinjau ulang.';
        } elseif ($keputusan === 'Revisi' || $keputusan === 'Disposisi') {
            $msg = 'Instruksi revisi berhasil dikirim dan dikembalikan ke PIC modul untuk perbaikan.';
        }
        echo json_encode(['success' => true, 'message' => $msg]);
    } catch (Exception $e) {
        $db->rollBack();
        echo json_encode(['success' => false, 'message' => 'Gagal memproses keputusan: ' . $e->getMessage()]);
    }
    exit;
}

if ($action === 'update_permission') {
    if (!hasPermission('hak', 'u')) {
        echo json_encode(['success' => false, 'message' => 'Hanya Admin yang berwenang mengatur hak akses.']);
        exit;
    }
    $idRole = $_POST['id_role'] ?? '';
    $menu = $_POST['menu'] ?? '';
    $actionKey = $_POST['action_key'] ?? '';
    $checked = (int)($_POST['checked'] ?? 0);

    $colMap = ['l' => 'can_view', 't' => 'can_create', 'u' => 'can_edit', 'h' => 'can_delete', 'd' => 'can_download', 's' => 'can_approve'];
    if (!isset($colMap[$actionKey])) {
        echo json_encode(['success' => false, 'message' => 'Kunci aksi tidak valid.']);
        exit;
    }
    $col = $colMap[$actionKey];

    $stmtCheck = $db->prepare("SELECT id_permission FROM role_permissions WHERE id_role = ? AND menu_fitur = ?");
    $stmtCheck->execute([$idRole, $menu]);
    $exist = $stmtCheck->fetch();

    if ($exist) {
        $stmtU = $db->prepare("UPDATE role_permissions SET $col = ? WHERE id_permission = ?");
        $stmtU->execute([$checked, $exist['id_permission']]);
    } else {
        $stmtI = $db->prepare("INSERT INTO role_permissions (id_permission, id_role, menu_fitur, $col) VALUES (?, ?, ?, ?)");
        $stmtI->execute([generateUUID(), $idRole, $menu, $checked]);
    }

    writeAuditLog('Perubahan RBAC Granular', "Role: $idRole, Menu: $menu, Aksi: $actionKey -> $checked");
    echo json_encode(['success' => true, 'message' => 'Hak akses berhasil diperbarui.']);
    exit;
}

// 8. EKSPOR PAKET MODUL AKHIR UNTUK GFORM ITJEN (Ketua SKI / Pimpinan)
if ($action === 'export_modul_itjen') {
    if (!hasPermission('exp', 'l') && !hasPermission('exp', 'd') && !hasPermission('apr', 's') && !hasPermission('apm', 's')) {
        echo json_encode(['success' => false, 'message' => 'Akses ditolak: Anda tidak memiliki izin ekspor modul.']);
        exit;
    }
    $idModul = trim($_POST['id_modul'] ?? $_GET['id_modul'] ?? '');
    if ($idModul === '') {
        echo json_encode(['success' => false, 'message' => 'ID Modul pengawasan wajib disertakan.']);
        exit;
    }

    $stmtM = $db->prepare("
        SELECT m.*, u.nama_unit, j.id_jadwal, j.tenggat_unggah, j.mulai_penilaian
        FROM moduls m
        LEFT JOIN units u ON m.id_unit_pic = u.id_unit
        LEFT JOIN jadwal_moduls j ON m.id_modul = j.id_modul
        WHERE m.id_modul = ? LIMIT 1
    ");
    $stmtM->execute([$idModul]);
    $modul = $stmtM->fetch();

    if (!$modul) {
        echo json_encode(['success' => false, 'message' => 'Modul pengawasan tidak ditemukan.']);
        exit;
    }

    $stmtInd = $db->prepare("
        SELECT i.*, e.id_eviden, e.nama_file, e.path_file, e.status_eviden, e.versi, e.waktu_unggah,
               r.status_kesesuaian, r.catatan_temuan, rev_u.nama_lengkap as nama_reviewer
        FROM indikators i
        LEFT JOIN evidens e ON i.id_indikator = e.id_indikator
        LEFT JOIN reviews r ON e.id_eviden = r.id_eviden
        LEFT JOIN users rev_u ON r.id_user_reviewer = rev_u.id_user
        WHERE i.id_modul = ?
        ORDER BY i.nomor_urut ASC
    ");
    $stmtInd->execute([$idModul]);
    $indikators = $stmtInd->fetchAll();

    $stmtRec = $db->prepare("
        SELECT r.*, ket.nama_lengkap as nama_ketua, pim.nama_lengkap as nama_pimpinan
        FROM rekomendasi_approvals r
        LEFT JOIN users ket ON r.id_ketua_ski = ket.id_user
        LEFT JOIN users pim ON r.id_pimpinan = pim.id_user
        WHERE r.id_modul = ?
        ORDER BY r.id_rekomendasi DESC LIMIT 1
    ");
    $stmtRec->execute([$idModul]);
    $rekomendasi = $stmtRec->fetch();

    writeAuditLog('Ekspor Modul Akhir GForm Itjen', "Modul: {$modul['nama_modul']}");

    echo json_encode([
        'success'     => true,
        'modul'       => $modul,
        'indikators'  => $indikators,
        'rekomendasi' => $rekomendasi,
        'gform_url'   => 'https://forms.gle/ItjenKemenkesBBPKMonev2026',
        'export_time' => date('d/m/Y H:i:s')
    ]);
    exit;
}

// 8B. STREAMING UNDUH CSV MODUL AKHIR (Ketua SKI / Pimpinan / Admin)
if ($action === 'export_modul_csv') {
    if (!hasPermission('exp', 'l') && !hasPermission('exp', 'd') && !hasPermission('apr', 's') && !hasPermission('apm', 's')) {
        header('Content-Type: text/plain; charset=utf-8');
        echo 'Akses ditolak: Anda tidak memiliki izin ekspor modul.';
        exit;
    }
    $idModul = trim($_GET['id_modul'] ?? $_POST['id_modul'] ?? '');
    if ($idModul === '') {
        header('Content-Type: text/plain; charset=utf-8');
        echo 'ID Modul pengawasan wajib disertakan.';
        exit;
    }

    $stmtM = $db->prepare("
        SELECT m.*, u.nama_unit, j.id_jadwal, j.tenggat_unggah, j.mulai_penilaian
        FROM moduls m
        LEFT JOIN units u ON m.id_unit_pic = u.id_unit
        LEFT JOIN jadwal_moduls j ON m.id_modul = j.id_modul
        WHERE m.id_modul = ? LIMIT 1
    ");
    $stmtM->execute([$idModul]);
    $modul = $stmtM->fetch();

    if (!$modul) {
        header('Content-Type: text/plain; charset=utf-8');
        echo 'Modul pengawasan tidak ditemukan.';
        exit;
    }

    $stmtInd = $db->prepare("
        SELECT i.*, e.id_eviden, e.nama_file, e.path_file, e.status_eviden, e.versi, e.waktu_unggah,
               r.status_kesesuaian, r.catatan_temuan, rev_u.nama_lengkap as nama_reviewer
        FROM indikators i
        LEFT JOIN evidens e ON i.id_indikator = e.id_indikator
        LEFT JOIN reviews r ON e.id_eviden = r.id_eviden
        LEFT JOIN users rev_u ON r.id_user_reviewer = rev_u.id_user
        WHERE i.id_modul = ?
        ORDER BY i.nomor_urut ASC
    ");
    $stmtInd->execute([$idModul]);
    $indikators = $stmtInd->fetchAll();

    $stmtRec = $db->prepare("
        SELECT r.*, ket.nama_lengkap as nama_ketua, pim.nama_lengkap as nama_pimpinan
        FROM rekomendasi_approvals r
        LEFT JOIN users ket ON r.id_ketua_ski = ket.id_user
        LEFT JOIN users pim ON r.id_pimpinan = pim.id_user
        WHERE r.id_modul = ?
        ORDER BY r.id_rekomendasi DESC LIMIT 1
    ");
    $stmtRec->execute([$idModul]);
    $rekomendasi = $stmtRec->fetch();

    writeAuditLog('Ekspor Modul Akhir GForm Itjen', "Modul: {$modul['nama_modul']} (Format CSV)");

    $safeModulName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $modul['nama_modul']);
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="Laporan_Akhir_Modul_' . $safeModulName . '_BBPK_Jakarta.csv"');

    $out = fopen('php://output', 'w');
    // UTF-8 BOM
    fprintf($out, chr(0xEF).chr(0xBB).chr(0xBF));

    fputcsv($out, ['KEMENTERIAN KESEHATAN REPUBLIK INDONESIA']);
    fputcsv($out, ['BALAI BESAR PELATIHAN KESEHATAN (BBPK) JAKARTA']);
    fputcsv($out, ['LAPORAN AKHIR HASIL PENGAWASAN KEPATUHAN INTERNAL (SKI)']);
    fputcsv($out, ['FORMAT PELAPORAN RESMI INSPEKTORAT JENDERAL KEMENKES RI']);
    fputcsv($out, []);

    fputcsv($out, ['Nama Modul Pengawasan', $modul['nama_modul']]);
    fputcsv($out, ['Kode Modul', $modul['kode_modul'] ?? '-']);
    fputcsv($out, ['Unit Kerja Pelaksana (PIC)', $modul['nama_unit'] ?? '-']);
    fputcsv($out, ['Kategori Pengawasan', $modul['kategori'] ?? 'Pengawasan Rutin']);
    fputcsv($out, ['Tanggal Unduh', date('d/m/Y H:i:s')]);
    fputcsv($out, []);

    fputcsv($out, ['=== LEGALISASI DAN DISPOSISI RESMI ===']);
    fputcsv($out, ['Ketua Tim SKI (Penyusun & Validator)', $rekomendasi['nama_ketua'] ?? 'Ketua SKI BBPK Jakarta']);
    fputcsv($out, ['Poin Rekomendasi Resmi SKI', $rekomendasi['poin_rekomendasi'] ?? '-']);
    fputcsv($out, ['Kepala BBPK Jakarta (Pimpinan)', $rekomendasi['nama_pimpinan'] ?? 'Kepala BBPK Jakarta']);
    fputcsv($out, ['Keputusan Pimpinan', $rekomendasi['keputusan_pimpinan'] ?? 'Disetujui']);
    fputcsv($out, ['Catatan Disposisi Pimpinan', $rekomendasi['catatan_disposisi'] ?? '-']);
    fputcsv($out, []);

    fputcsv($out, ['=== MATRIKS RINCIAN BUTIR INDIKATOR & BUKTI DUKUNG EVIDEN ===']);
    fputcsv($out, [
        'No',
        'Nomor Indikator',
        'Uraian Butir Indikator',
        'Target / Bobot',
        'File Eviden Terakhir',
        'Versi',
        'Waktu Unggah',
        'Status Eviden',
        'Hasil Review Kesesuaian',
        'Catatan Reviewer SKI'
    ]);

    $no = 1;
    foreach ($indikators as $ind) {
        $stEv = match ($ind['status_eviden'] ?? '') {
            'f' => 'Disetujui Pimpinan (Final)',
            'a' => 'Disetujui Ketua SKI',
            'o' => 'Sesuai / Menunggu Approval',
            'r' => 'Perlu Revisi PIC',
            default => 'Belum Diunggah / Proses',
        };
        fputcsv($out, [
            $no++,
            $ind['nomor_indikator'] ?? $ind['nomor_urut'],
            $ind['deskripsi_indikator'],
            ($ind['target_bobot'] ?? '-') . ' ' . ($ind['satuan'] ?? ''),
            $ind['nama_file'] ?? '(Belum ada eviden)',
            isset($ind['versi']) ? 'v' . $ind['versi'] : '-',
            $ind['waktu_unggah'] ?? '-',
            $stEv,
            $ind['status_kesesuaian'] ?? '-',
            $ind['catatan_temuan'] ?? '-'
        ]);
    }

    fputcsv($out, []);
    fputcsv($out, ['Dokumen ini dihasilkan secara otomatis oleh Sistem Monev SKI BBPK Jakarta untuk Pelaporan ke Inspektorat Jenderal Kemenkes RI.']);
    fclose($out);
    exit;
}

// 8C. EKSPOR PAKET BERKAS EVIDEN ASLI (MURNI TANPA DOKUMEN BARU) DALAM ARSIP ZIP
if ($action === 'export_evidens_zip') {
    if (!hasPermission('exp', 'l') && !hasPermission('exp', 'd') && !hasPermission('rep', 'd') && !hasPermission('apr', 's') && !hasPermission('apm', 's') && ($_SESSION['id_role'] ?? '') !== 'itj' && ($_SESSION['id_role'] ?? '') !== 'adm') {
        header('Content-Type: text/plain; charset=utf-8');
        echo 'Akses ditolak: Anda tidak memiliki izin ekspor berkas eviden.';
        exit;
    }
    $idModul = trim($_GET['id_modul'] ?? $_POST['id_modul'] ?? '');
    if ($idModul === '') {
        header('Content-Type: text/plain; charset=utf-8');
        echo 'ID Modul pengawasan wajib disertakan.';
        exit;
    }

    $stmtM = $db->prepare("
        SELECT m.*, u.nama_unit
        FROM moduls m
        LEFT JOIN units u ON m.id_unit_pic = u.id_unit
        WHERE m.id_modul = ? LIMIT 1
    ");
    $stmtM->execute([$idModul]);
    $modul = $stmtM->fetch();

    if (!$modul) {
        header('Content-Type: text/plain; charset=utf-8');
        echo 'Modul pengawasan tidak ditemukan.';
        exit;
    }

    // Ambil seluruh butir yang sudah memiliki bukti dukung eviden terunggah
    $stmtInd = $db->prepare("
        SELECT i.*, e.id_eviden, e.nama_file, e.path_file, e.status_eviden, e.versi, e.waktu_unggah, e.format_file
        FROM indikators i
        INNER JOIN evidens e ON i.id_indikator = e.id_indikator
        WHERE i.id_modul = ?
        ORDER BY i.nomor_urut ASC, e.versi DESC
    ");
    $stmtInd->execute([$idModul]);
    $rawEvidens = $stmtInd->fetchAll();

    // Pastikan ambil versi eviden terbaru per indikator
    $indikators = [];
    $seenInd = [];
    foreach ($rawEvidens as $row) {
        if (!isset($seenInd[$row['id_indikator']])) {
            $seenInd[$row['id_indikator']] = true;
            $indikators[] = $row;
        }
    }

    if (empty($indikators)) {
        header('Content-Type: text/plain; charset=utf-8');
        echo 'Belum ada berkas eviden yang diunggah untuk modul pengawasan ini.';
        exit;
    }

    $safeModulName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $modul['nama_modul']);
    $wordToPdf = isset($_GET['word_to_pdf']) && ($_GET['word_to_pdf'] == '1' || $_GET['word_to_pdf'] === 'true');
    $zipFiles = [];
    $num = 1;

    foreach ($indikators as $ind) {
        $indNo = $ind['nomor_indikator'] ?? $ind['nomor_urut'] ?? $num;
        $indDesc = $ind['deskripsi_indikator'];
        $evName = trim($ind['nama_file'] ?? "Eviden_{$num}");
        $path = $ind['path_file'] ?? '';
        $isUrl = preg_match('/^https?:\/\//i', $path);
        $cleanInd = preg_replace('/[^a-zA-Z0-9_-]/', '_', mb_substr($indDesc, 0, 35));
        $cleanEv = preg_replace('/[^a-zA-Z0-9_-]/', '_', pathinfo($evName, PATHINFO_FILENAME));
        $prefix = sprintf("%02d", $num);

        if ($isUrl) {
            $gInfo = parseGoogleDriveInfo($path);
            if ($gInfo) {
                if ($gInfo['type'] === 'docs') {
                    // Google Docs -> Unduh berkas Word (.docx)
                    $dRes = fetchGoogleDriveFile($path, 'docx');
                    if ($dRes && !empty($dRes['data'])) {
                        $zipFiles["{$prefix}_{$cleanInd}_{$cleanEv}.docx"] = $dRes['data'];
                    }
                    // Jika diminta sertakan versi PDF juga
                    if ($wordToPdf) {
                        $pRes = fetchGoogleDriveFile($path, 'pdf');
                        if ($pRes && !empty($pRes['data'])) {
                            $zipFiles["{$prefix}_{$cleanInd}_{$cleanEv}.pdf"] = $pRes['data'];
                        }
                    }
                } elseif ($gInfo['type'] === 'sheets') {
                    // Google Sheets -> Unduh berkas Excel (.xlsx)
                    $sRes = fetchGoogleDriveFile($path, 'xlsx');
                    if ($sRes && !empty($sRes['data'])) {
                        $zipFiles["{$prefix}_{$cleanInd}_{$cleanEv}.xlsx"] = $sRes['data'];
                    }
                    if ($wordToPdf) {
                        $pRes = fetchGoogleDriveFile($path, 'pdf');
                        if ($pRes && !empty($pRes['data'])) {
                            $zipFiles["{$prefix}_{$cleanInd}_{$cleanEv}.pdf"] = $pRes['data'];
                        }
                    }
                } elseif ($gInfo['type'] === 'slides') {
                    $pRes = fetchGoogleDriveFile($path, 'pptx');
                    if ($pRes && !empty($pRes['data'])) {
                        $zipFiles["{$prefix}_{$cleanInd}_{$cleanEv}.pptx"] = $pRes['data'];
                    }
                    if ($wordToPdf) {
                        $pdfRes = fetchGoogleDriveFile($path, 'pdf');
                        if ($pdfRes && !empty($pdfRes['data'])) {
                            $zipFiles["{$prefix}_{$cleanInd}_{$cleanEv}.pdf"] = $pdfRes['data'];
                        }
                    }
                } elseif ($gInfo['type'] === 'file') {
                    $fRes = fetchGoogleDriveFile($path);
                    if ($fRes && !empty($fRes['data'])) {
                        $ext = $fRes['ext'] ?: 'bin';
                        $zipFiles["{$prefix}_{$cleanInd}_{$cleanEv}.{$ext}"] = $fRes['data'];
                    }
                }
            }
        } else {
            // Berkas fisik tersimpan di server
            $localFile = __DIR__ . '/' . ltrim($path, '/');
            if ($path !== '' && $path !== '#' && file_exists($localFile) && is_file($localFile)) {
                $ext = strtolower(pathinfo($localFile, PATHINFO_EXTENSION));
                $origBaseName = basename($path);
                $zipFiles["{$prefix}_{$cleanInd}_{$origBaseName}"] = ['file' => $localFile];
            }
        }
        $num++;
    }

    if (empty($zipFiles)) {
        header('Content-Type: text/plain; charset=utf-8');
        echo 'Tidak ada berkas fisik dokumen (Word, PDF, Excel) yang dapat dikemas ke arsip ZIP untuk modul ini. Bukti dukung berupa tautan Google Drive dapat diakses langsung pada antarmuka sistem.';
        exit;
    }

    $tempZipPath = sys_get_temp_dir() . '/paket_eviden_' . $idModul . '_' . time() . '.zip';
    createSimpleZip($zipFiles, $tempZipPath);

    writeAuditLog('Ekspor Paket Eviden Asli ZIP', "Modul: {$modul['nama_modul']}");

    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename="Paket_Eviden_' . $safeModulName . '.zip"');
    header('Content-Length: ' . filesize($tempZipPath));
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');

    readfile($tempZipPath);
    @unlink($tempZipPath);
    exit;
}

// 8D. UNDUH SATUAN BERKAS EVIDEN FISIK ATAU DOKUMEN GOOGLE DRIVE
if ($action === 'download_eviden') {
    if (!isLoggedIn()) {
        header('Content-Type: text/plain; charset=utf-8');
        echo 'Akses ditolak: Silakan login terlebih dahulu.';
        exit;
    }
    $idEviden = trim($_GET['id_eviden'] ?? '');
    if ($idEviden === '') {
        header('Content-Type: text/plain; charset=utf-8');
        echo 'ID Eviden wajib disertakan.';
        exit;
    }
    $stmt = $db->prepare("SELECT * FROM evidens WHERE id_eviden = ? LIMIT 1");
    $stmt->execute([$idEviden]);
    $ev = $stmt->fetch();
    if (!$ev) {
        header('Content-Type: text/plain; charset=utf-8');
        echo 'Berkas eviden tidak ditemukan.';
        exit;
    }

    $reqFormat = strtolower(trim($_GET['format'] ?? 'default'));
    $isUrl = preg_match('/^https?:\/\//i', $ev['path_file']);

    if ($isUrl) {
        $gInfo = parseGoogleDriveInfo($ev['path_file']);
        if ($gInfo) {
            // Unduh file dokumen dari Google Drive secara langsung
            $res = fetchGoogleDriveFile($ev['path_file'], $reqFormat);
            if ($res && !empty($res['data'])) {
                writeAuditLog('Unduh Berkas Eviden GDrive', $ev['nama_file'] . " ({$res['ext']})");
                $cleanTitle = preg_replace('/[^a-zA-Z0-9_\.-]/', '_', pathinfo($ev['nama_file'], PATHINFO_FILENAME));
                $finalName = "{$cleanTitle}.{$res['ext']}";
                header('Content-Type: ' . $res['mime']);
                header('Content-Disposition: attachment; filename="' . $finalName . '"');
                header('Content-Length: ' . strlen($res['data']));
                echo $res['data'];
                exit;
            }
        }
        // Fallback jika berupa folder atau akses dibatasi
        header('Location: ' . $ev['path_file']);
        exit;
    }

    $localPath = __DIR__ . '/' . ltrim($ev['path_file'], '/');
    if ($ev['path_file'] !== '' && $ev['path_file'] !== '#' && file_exists($localPath) && is_file($localPath)) {
        writeAuditLog('Unduh Berkas Eviden', $ev['nama_file']);
        $ext = strtolower(pathinfo($localPath, PATHINFO_EXTENSION));

        // Jika berkas Word lokal diminta diekspor sebagai PDF
        if (($ext === 'docx' || $ext === 'doc') && ($reqFormat === 'pdf' || isset($_GET['as_pdf']))) {
            renderDocxAsPrintablePdf($localPath, $ev['nama_file']);
            exit;
        }

        $mime = match($ext) {
            'pdf' => 'application/pdf',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'xls' => 'application/vnd.ms-excel',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'doc' => 'application/msword',
            'zip' => 'application/zip',
            default => 'application/octet-stream'
        };
        $cleanFileName = basename($ev['nama_file']);
        if (!str_ends_with(strtolower($cleanFileName), '.' . $ext)) {
            $cleanFileName .= '.' . $ext;
        }
        header('Content-Type: ' . $mime);
        header('Content-Disposition: attachment; filename="' . $cleanFileName . '"');
        header('Content-Length: ' . filesize($localPath));
        readfile($localPath);
        exit;
    } else {
        header('Content-Type: text/plain; charset=utf-8');
        echo 'Berkas fisik tidak ditemukan di penyimpanan server.';
        exit;
    }
}

echo json_encode(['success' => false, 'message' => 'Permintaan aksi tidak dikenal.']);