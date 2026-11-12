<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/auth.php';

function generateUUID(): string {
    $data = random_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

function writeAuditLog(string $jenisAksi, string $objekTarget): void {
    if (!isLoggedIn()) return;
    $db = getDB();
    $user = getCurrentUser();
    $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
    
    $stmt = $db->prepare("INSERT INTO audit_logs (id_log, id_user, role_saat_aksi, jenis_aksi, objek_target, ip_address, timestamp_aktivitas) VALUES (?, ?, ?, ?, ?, ?, NOW())");
    $stmt->execute([
        generateUUID(),
        $user['id'],
        $user['nama_role'],
        $jenisAksi,
        $objekTarget,
        $ip
    ]);
}

function checkAndUpdateLockStatus(): void {
    $db = getDB();
    // Auto-lock jika sekarang sudah melewati tenggat_unggah
    $db->query("UPDATE jadwal_moduls SET is_locked = 1 WHERE tenggat_unggah < NOW() AND is_locked = 0");
}

/**
 * Menghasilkan markup HTML preview komponen form sesuai tipe input indikator.
 */
function render_indicator_preview(string $inputType, string $title, ?string $guideNotes = null): string {
    $safeTitle = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
    $guideHtml = $guideNotes ? '<p style="color:var(--mut,#64748b);font-size:12px;margin:3px 0 8px;">' . htmlspecialchars($guideNotes, ENT_QUOTES, 'UTF-8') . '</p>' : '';
    
    $component = '';
    switch ($inputType) {
        case 'binary_score':
            $component = '
            <div style="display:flex;gap:16px;align-items:center;padding:10px 14px;background:#fff;border:1px solid var(--bd,#e2e8f0);border-radius:10px;">
                <label style="display:inline-flex;align-items:center;gap:6px;cursor:pointer;font-weight:600;color:var(--ok,#16a34a);font-size:13px;">
                    <input type="radio" name="preview_bin_' . md5($title) . '" value="1" checked style="accent-color:var(--pri,#0a8f83);"> Ya (1 - Memenuhi)
                </label>
                <label style="display:inline-flex;align-items:center;gap:6px;cursor:pointer;font-weight:600;color:var(--er,#dc2626);font-size:13px;">
                    <input type="radio" name="preview_bin_' . md5($title) . '" value="0" style="accent-color:var(--pri,#0a8f83);"> Tidak (0 - Belum)
                </label>
            </div>';
            break;

        case 'numeric':
            $component = '
            <div style="display:flex;align-items:center;gap:10px;">
                <input type="number" class="fl" style="width:100%;max-width:240px;padding:8px 12px;border:1px solid var(--bd,#e2e8f0);border-radius:10px;font-size:13px;" placeholder="0" min="0" step="any">
                <span class="tag t-in" style="font-size:11.5px;padding:4px 8px;">Input Numerik / Nominal</span>
            </div>';
            break;

        case 'pbj_matrix':
            $component = '
            <div style="background:#fff;border:1px solid var(--bd,#e2e8f0);border-radius:10px;padding:10px 12px;display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:8px;font-size:12px;">
                <label style="display:flex;align-items:center;gap:6px;cursor:pointer;">
                    <input type="checkbox" checked style="accent-color:var(--pri,#0a8f83);"> <span>1. Tepat Kualitas (Spesifikasi)</span>
                </label>
                <label style="display:flex;align-items:center;gap:6px;cursor:pointer;">
                    <input type="checkbox" checked style="accent-color:var(--pri,#0a8f83);"> <span>2. Tepat Jumlah (Kuantitas)</span>
                </label>
                <label style="display:flex;align-items:center;gap:6px;cursor:pointer;">
                    <input type="checkbox" checked style="accent-color:var(--pri,#0a8f83);"> <span>3. Tepat Harga (HPS/Kontrak)</span>
                </label>
                <label style="display:flex;align-items:center;gap:6px;cursor:pointer;">
                    <input type="checkbox" checked style="accent-color:var(--pri,#0a8f83);"> <span>4. Tepat Penyedia & Waktu</span>
                </label>
            </div>';
            break;

        case 'risk_scale':
            $component = '
            <select class="fl" style="width:100%;max-width:240px;padding:8px 12px;border:1px solid var(--bd,#e2e8f0);border-radius:10px;font-size:13px;">
                <option value="rendah">Rendah (Low Risk)</option>
                <option value="sedang" selected>Sedang (Medium Risk)</option>
                <option value="tinggi">Tinggi (High Risk)</option>
            </select>';
            break;

        case 'file':
        default:
            $component = '
            <div style="border:2px dashed var(--bd,#e2e8f0);background:#fff;padding:14px;border-radius:12px;text-align:center;cursor:pointer;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--pri,#0a8f83)" stroke-width="2" style="margin-bottom:4px;"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12"/></svg>
                <div style="font-weight:600;font-size:13px;color:var(--dk,#075e57);">Unggah Berkas PDF Hasil Akhir / Tautan Cloud</div>
                <div style="font-size:11px;color:var(--mut,#64748b);">Format yang didukung: PDF, Excel, Word (Maks. 50 MB)</div>
            </div>';
            break;
    }

    return '
    <div class="indicator-preview-box" style="margin-bottom:12px;padding:12px 14px;background:#f8fafc;border:1px solid var(--bd,#e2e8f0);border-radius:12px;">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:4px;">
            <b style="font-size:13.5px;color:var(--tx,#1b2333);">' . $safeTitle . '</b>
            <span class="tag t-in" style="font-size:10.5px;text-transform:uppercase;">' . htmlspecialchars($inputType, ENT_QUOTES, 'UTF-8') . '</span>
        </div>
        ' . $guideHtml . '
        ' . $component . '
    </div>';
}

/**
 * Menghitung total skor dan menghasilkan status 'Sesuai' jika total >= threshold, atau 'Tidak Sesuai'.
 */
function calculate_kkr_compliance(array $scoresArray, float $threshold): string {
    $totalScore = (float)array_sum($scoresArray);
    return ($totalScore >= $threshold) ? 'Sesuai' : 'Tidak Sesuai';
}

/**
 * Query ke tabel modules dengan filter WHERE status = 'terbit' AND unit_pic = ?
 */
function get_active_modules_for_pic(string $unitPic): array {
    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM modules WHERE status = 'terbit' AND unit_pic = ? ORDER BY id ASC");
    $stmt->execute([$unitPic]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Pure PHP ZIP archive generator (zero-dependency, does not require php_zip.dll).
 * $files array format: [ 'path/in/zip.ext' => 'string content' | ['file' => '/absolute/path/on/disk'] ]
 */
function createSimpleZip(array $files, string $zipPath): bool {
    $datasec = [];
    $ctrl_dir = [];
    $offset = 0;

    foreach ($files as $nameInZip => $src) {
        $nameInZip = str_replace('\\', '/', $nameInZip);
        if (is_array($src) && isset($src['file'])) {
            $data = @file_get_contents($src['file']);
            if ($data === false) continue;
        } else {
            $data = (string)$src;
        }

        $unc_len = strlen($data);
        $crc = crc32($data);
        $zdata = gzdeflate($data);
        if ($zdata === false || strlen($zdata) >= $unc_len) {
            $zdata = $data;
            $c_len = $unc_len;
            $method = 0; // Stored (uncompressed)
        } else {
            $c_len = strlen($zdata);
            $method = 8; // Deflated
        }

        $fr = "\x50\x4b\x03\x04";
        $fr .= "\x14\x00"; // version needed to extract (2.0)
        $fr .= "\x00\x00"; // gen purpose bit flag
        $fr .= pack('v', $method);
        $fr .= pack('V', 0); // time dos
        $fr .= pack('V', $crc);
        $fr .= pack('V', $c_len);
        $fr .= pack('V', $unc_len);
        $fr .= pack('v', strlen($nameInZip));
        $fr .= pack('v', 0); // extra field length
        $fr .= $nameInZip;
        $fr .= $zdata;

        $datasec[] = $fr;

        $cdrec = "\x50\x4b\x01\x02";
        $cdrec .= "\x00\x00"; // version made by
        $cdrec .= "\x14\x00"; // version needed to extract
        $cdrec .= "\x00\x00"; // gen purpose bit flag
        $cdrec .= pack('v', $method);
        $cdrec .= pack('V', 0); // time dos
        $cdrec .= pack('V', $crc);
        $cdrec .= pack('V', $c_len);
        $cdrec .= pack('V', $unc_len);
        $cdrec .= pack('v', strlen($nameInZip));
        $cdrec .= pack('v', 0); // extra field length
        $cdrec .= pack('v', 0); // file comment length
        $cdrec .= pack('v', 0); // disk number start
        $cdrec .= pack('v', 0); // internal file attributes
        $cdrec .= pack('V', 32); // external file attributes (archive)
        $cdrec .= pack('V', $offset);
        $cdrec .= $nameInZip;

        $ctrl_dir[] = $cdrec;
        $offset += strlen($fr);
    }

    $dirstr = implode('', $ctrl_dir);
    $data_sec = implode('', $datasec);

    $footer = "\x50\x4b\x05\x06";
    $footer .= "\x00\x00"; // number of this disk
    $footer .= "\x00\x00"; // disk where central directory starts
    $footer .= pack('v', count($ctrl_dir)); // total entries in central dir on this disk
    $footer .= pack('v', count($ctrl_dir)); // total entries in central dir
    $footer .= pack('V', strlen($dirstr)); // size of central directory
    $footer .= pack('V', strlen($data_sec)); // offset of start of central directory
    $footer .= "\x00\x00"; // zipfile comment length

    $zipContent = $data_sec . $dirstr . $footer;
    return file_put_contents($zipPath, $zipContent) !== false;
}

/**
 * Mendeteksi tipe dan URL unduh/ekspor resmi dari tautan Google Drive / Google Docs / Sheets / Slides.
 */
function parseGoogleDriveInfo(string $url): ?array {
    $url = trim($url);
    if (!preg_match('/^https?:\/\//i', $url)) return null;

    // 1. Google Docs (Word-like)
    if (preg_match('#docs\.google\.com/document/d/([a-zA-Z0-9_-]+)#i', $url, $m)) {
        $id = $m[1];
        return [
            'type'        => 'docs',
            'id'          => $id,
            'name_type'   => 'Google Docs',
            'export_docx' => "https://docs.google.com/document/d/{$id}/export?format=docx",
            'export_pdf'  => "https://docs.google.com/document/d/{$id}/export?format=pdf",
            'default_ext' => 'docx',
            'can_pdf'     => true,
            'orig_url'    => $url
        ];
    }

    // 2. Google Spreadsheets (Excel-like)
    if (preg_match('#docs\.google\.com/spreadsheets/d/([a-zA-Z0-9_-]+)#i', $url, $m)) {
        $id = $m[1];
        return [
            'type'        => 'sheets',
            'id'          => $id,
            'name_type'   => 'Google Sheets',
            'export_xlsx' => "https://docs.google.com/spreadsheets/d/{$id}/export?format=xlsx",
            'export_pdf'  => "https://docs.google.com/spreadsheets/d/{$id}/export?format=pdf",
            'default_ext' => 'xlsx',
            'can_pdf'     => true,
            'orig_url'    => $url
        ];
    }

    // 3. Google Presentations / Slides
    if (preg_match('#docs\.google\.com/presentation/d/([a-zA-Z0-9_-]+)#i', $url, $m)) {
        $id = $m[1];
        return [
            'type'        => 'slides',
            'id'          => $id,
            'name_type'   => 'Google Slides',
            'export_pptx' => "https://docs.google.com/presentation/d/{$id}/export?format=pptx",
            'export_pdf'  => "https://docs.google.com/presentation/d/{$id}/export?format=pdf",
            'default_ext' => 'pptx',
            'can_pdf'     => true,
            'orig_url'    => $url
        ];
    }

    // 4. Google Drive uploaded File (PDF, Word, Excel, Gambar di Drive)
    if (preg_match('#drive\.google\.com/file/d/([a-zA-Z0-9_-]+)#i', $url, $m) ||
        preg_match('#drive\.google\.com/open\?.*id=([a-zA-Z0-9_-]+)#i', $url, $m) ||
        preg_match('#drive\.google\.com/uc\?.*id=([a-zA-Z0-9_-]+)#i', $url, $m)) {
        $id = $m[1];
        return [
            'type'        => 'file',
            'id'          => $id,
            'name_type'   => 'Berkas Google Drive',
            'download_url'=> "https://drive.usercontent.google.com/download?id={$id}&export=download&confirm=t",
            'fallback_url'=> "https://drive.google.com/uc?export=download&id={$id}",
            'default_ext' => 'bin',
            'can_pdf'     => false,
            'orig_url'    => $url
        ];
    }

    // 5. Google Drive Folder
    if (preg_match('#drive\.google\.com/drive/folders/([a-zA-Z0-9_-]+)#i', $url, $m)) {
        $id = $m[1];
        return [
            'type'        => 'folder',
            'id'          => $id,
            'name_type'   => 'Folder Google Drive',
            'can_pdf'     => false,
            'orig_url'    => $url
        ];
    }

    return null;
}

/**
 * Mengunduh konten biner berkas dari URL jarak jauh (dengan cURL & SSL bypass).
 */
function fetchRemoteFileContent(string $url, int $timeout = 15): ?array {
    if (!function_exists('curl_init')) return null;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 8);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36');
    $content = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE) ?: '';
    $effectiveUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL) ?: '';
    curl_close($ch);

    if ($httpCode === 200 && $content !== false && strlen($content) > 0) {
        // Cek jika response adalah halaman html login/private Google Drive
        if (str_contains($contentType, 'text/html') && (str_contains($content, 'accounts.google.com') || str_contains($content, 'ServiceLogin') || str_contains($content, 'Google Drive - Access Denied'))) {
            return null;
        }
        return [
            'data'         => $content,
            'content_type' => $contentType,
            'size'         => strlen($content),
            'effective_url'=> $effectiveUrl
        ];
    }
    return null;
}

/**
 * Mengunduh berkas Google Drive sesuai format target (docs->docx/pdf, sheets->xlsx/pdf, slides->pptx/pdf, file->binary).
 */
function fetchGoogleDriveFile(string $url, string $format = 'default'): ?array {
    $info = parseGoogleDriveInfo($url);
    if (!$info) return null;

    $fetchUrl = '';
    $ext = '';
    $mime = '';

    if ($info['type'] === 'docs') {
        if ($format === 'pdf') {
            $fetchUrl = $info['export_pdf'];
            $ext = 'pdf';
            $mime = 'application/pdf';
        } else {
            $fetchUrl = $info['export_docx'];
            $ext = 'docx';
            $mime = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
        }
    } elseif ($info['type'] === 'sheets') {
        if ($format === 'pdf') {
            $fetchUrl = $info['export_pdf'];
            $ext = 'pdf';
            $mime = 'application/pdf';
        } else {
            $fetchUrl = $info['export_xlsx'];
            $ext = 'xlsx';
            $mime = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
        }
    } elseif ($info['type'] === 'slides') {
        if ($format === 'pdf') {
            $fetchUrl = $info['export_pdf'];
            $ext = 'pdf';
            $mime = 'application/pdf';
        } else {
            $fetchUrl = $info['export_pptx'];
            $ext = 'pptx';
            $mime = 'application/vnd.openxmlformats-officedocument.presentationml.presentation';
        }
    } elseif ($info['type'] === 'file') {
        $res = fetchRemoteFileContent($info['download_url'], 25);
        if (!$res && !empty($info['fallback_url'])) {
            $res = fetchRemoteFileContent($info['fallback_url'], 25);
        }
        if ($res) {
            $ct = strtolower($res['content_type']);
            if (str_contains($ct, 'pdf') || str_starts_with($res['data'], '%PDF')) $ext = 'pdf';
            elseif (str_contains($ct, 'spreadsheet') || str_contains($ct, 'excel')) $ext = 'xlsx';
            elseif (str_contains($ct, 'wordprocessing') || str_contains($ct, 'msword')) $ext = 'docx';
            else $ext = 'bin';
            return [
                'data' => $res['data'],
                'ext'  => $ext,
                'mime' => $res['content_type'],
                'size' => $res['size']
            ];
        }
        return null;
    } else {
        return null;
    }

    if ($fetchUrl !== '') {
        $res = fetchRemoteFileContent($fetchUrl, 25);
        if ($res) {
            return [
                'data' => $res['data'],
                'ext'  => $ext,
                'mime' => $mime,
                'size' => $res['size']
            ];
        }
    }

    return null;
}

/**
 * Membaca konten file di dalam arsip ZIP tanpa ketergantungan ekstensi eksternal.
 */
function getZipEntryContent(string $zipPath, string $entryName): ?string {
    try {
        if (class_exists('PharData')) {
            $phar = new PharData($zipPath);
            if (isset($phar[$entryName])) {
                return $phar[$entryName]->getContent();
            }
        }
    } catch (Throwable $e) {}

    $data = @file_get_contents($zipPath);
    if ($data === false) return null;
    $offset = 0;
    $len = strlen($data);
    while ($offset + 30 <= $len) {
        $sig = substr($data, $offset, 4);
        if ($sig !== "\x50\x4b\x03\x04") break;
        $compMethod = unpack('v', substr($data, $offset + 8, 2))[1];
        $cSize = unpack('V', substr($data, $offset + 18, 4))[1];
        $fnLen = unpack('v', substr($data, $offset + 26, 2))[1];
        $extraLen = unpack('v', substr($data, $offset + 28, 2))[1];
        $fn = substr($data, $offset + 30, $fnLen);
        $dataOffset = $offset + 30 + $fnLen + $extraLen;
        if ($dataOffset + $cSize > $len) break;
        $cData = substr($data, $dataOffset, $cSize);
        if (strcasecmp(str_replace('\\', '/', $fn), str_replace('\\', '/', $entryName)) === 0) {
            if ($compMethod === 0) return $cData;
            if ($compMethod === 8) {
                $uncomp = @gzinflate($cData);
                if ($uncomp !== false) return $uncomp;
            }
        }
        $offset = $dataOffset + $cSize;
    }
    return null;
}

/**
 * Mengonversi berkas dokumen Word (.docx) menjadi HTML bersih yang siap cetak atau disimpan sebagai PDF.
 */
function convertDocxToHtml(string $docxPath): string {
    $xmlContent = getZipEntryContent($docxPath, 'word/document.xml');
    if (!$xmlContent) {
        return '<p style="color:#64748b;font-style:italic">Dokumen Word tidak berisi teks yang dapat diekstrak atau menggunakan format lama.</p>';
    }

    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $loaded = $dom->loadXML($xmlContent);
    libxml_clear_errors();
    if (!$loaded) {
        return '<p style="color:#ef4444">Format struktur XML dokumen Word tidak dapat dibaca.</p>';
    }

    $xpath = new DOMXPath($dom);
    $xpath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');

    $html = '';
    $bodyNodes = $xpath->query('//w:body/*');
    if ($bodyNodes) {
        foreach ($bodyNodes as $node) {
            if ($node->nodeName === 'w:p') {
                $pText = '';
                $isHeading = false;
                $headingLevel = 1;
                $styleNodes = $xpath->query('.//w:pStyle/@w:val', $node);
                if ($styleNodes && $styleNodes->length > 0) {
                    $sVal = strtolower($styleNodes->item(0)->nodeValue);
                    if (preg_match('/heading(\d)/i', $sVal, $hm)) {
                        $isHeading = true;
                        $headingLevel = min(4, (int)$hm[1]);
                    } elseif (str_contains($sVal, 'title')) {
                        $isHeading = true;
                        $headingLevel = 1;
                    }
                }

                $rNodes = $xpath->query('.//w:r', $node);
                if ($rNodes) {
                    foreach ($rNodes as $r) {
                        $isBold = $xpath->query('.//w:b', $r)->length > 0;
                        $isItalic = $xpath->query('.//w:i', $r)->length > 0;
                        $isUnderline = $xpath->query('.//w:u', $r)->length > 0;
                        $tNodes = $xpath->query('.//w:t', $r);
                        $rTxt = '';
                        foreach ($tNodes as $t) {
                            $rTxt .= $t->nodeValue;
                        }
                        if ($rTxt !== '') {
                            $part = htmlspecialchars($rTxt, ENT_QUOTES, 'UTF-8');
                            if ($isBold) $part = '<b>' . $part . '</b>';
                            if ($isItalic) $part = '<i>' . $part . '</i>';
                            if ($isUnderline) $part = '<u>' . $part . '</u>';
                            $pText .= $part;
                        }
                    }
                }

                if (trim($pText) === '') {
                    $html .= '<p style="margin:4px 0;min-height:1em;">&nbsp;</p>';
                } elseif ($isHeading) {
                    $html .= "<h{$headingLevel} style='margin:16px 0 8px;color:#0f172a;'>" . $pText . "</h{$headingLevel}>";
                } else {
                    $html .= '<p style="margin:6px 0;line-height:1.6;color:#1e293b;">' . $pText . '</p>';
                }
            } elseif ($node->nodeName === 'w:tbl') {
                $html .= '<table style="width:100%;border-collapse:collapse;margin:14px 0;font-size:10pt;">';
                $rowNodes = $xpath->query('.//w:tr', $node);
                $isHeader = true;
                foreach ($rowNodes as $tr) {
                    $html .= '<tr>';
                    $cellNodes = $xpath->query('.//w:tc', $tr);
                    foreach ($cellNodes as $tc) {
                        $cellText = '';
                        $tcPs = $xpath->query('.//w:p', $tc);
                        foreach ($tcPs as $tcp) {
                            $tNodes = $xpath->query('.//w:t', $tcp);
                            $line = '';
                            foreach ($tNodes as $t) {
                                $line .= $t->nodeValue;
                            }
                            if ($line !== '') {
                                $cellText .= ($cellText !== '' ? '<br>' : '') . htmlspecialchars($line, ENT_QUOTES, 'UTF-8');
                            }
                        }
                        $tag = $isHeader ? 'th' : 'td';
                        $bg = $isHeader ? 'background:#f1f5f9;font-weight:700;' : '';
                        $html .= "<{$tag} style='border:1px solid #cbd5e1;padding:6px 10px;{$bg}text-align:left;vertical-align:top;'>" . ($cellText !== '' ? $cellText : '&nbsp;') . "</{$tag}>";
                    }
                    $html .= '</tr>';
                    $isHeader = false;
                }
                $html .= '</table>';
            }
        }
    }
    return $html;
}

/**
 * Menghasilkan halaman pratinjau cetak / ekspor PDF untuk dokumen Word lokal.
 */
function renderDocxAsPrintablePdf(string $docxPath, string $docTitle): void {
    $safeTitle = htmlspecialchars($docTitle, ENT_QUOTES, 'UTF-8');
    $bodyContent = convertDocxToHtml($docxPath);

    header('Content-Type: text/html; charset=utf-8');
    echo '<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>' . $safeTitle . ' - Ekspor PDF</title>
<style>
  @page { size: A4 portrait; margin: 20mm 15mm 20mm 15mm; }
  body { font-family: "Segoe UI", Arial, Helvetica, sans-serif; font-size: 11pt; color: #1e293b; background: #fff; margin: 0; padding: 24px; }
  .no-print { position: sticky; top: 0; z-index: 999; background: #0f172a; color: #fff; padding: 12px 20px; border-radius: 10px; margin-bottom: 24px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 4px 16px rgba(0,0,0,.25); }
  .btn-print { background: #0d9488; color: #fff; border: none; padding: 8px 18px; border-radius: 6px; font-weight: 700; cursor: pointer; font-size: 13px; display: inline-flex; align-items: center; gap: 6px; }
  .btn-close { background: #475569; color: #fff; border: none; padding: 8px 14px; border-radius: 6px; cursor: pointer; font-size: 13px; }
  .doc-container { max-width: 820px; margin: auto; background: #fff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 36px 40px; box-shadow: 0 2px 8px rgba(0,0,0,.05); }
  @media print {
    .no-print { display: none !important; }
    body { padding: 0 !important; background: #fff !important; }
    .doc-container { max-width: 100% !important; margin: 0 !important; padding: 0 !important; border: none !important; box-shadow: none !important; }
  }
</style>
</head>
<body>
<div class="no-print">
  <div>
    <b>Ekspor Dokumen Word ke PDF: ' . $safeTitle . '</b><br>
    <small style="opacity:.85">Gunakan tombol Cetak di samping lalu pilih opsi <b>"Simpan sebagai PDF" / "Save as PDF"</b>.</small>
  </div>
  <div style="display:flex;gap:8px;">
    <button class="btn-print" onclick="window.print()">🖨️ Cetak / Simpan sebagai PDF</button>
    <button class="btn-close" onclick="window.close()">✕ Tutup</button>
  </div>
</div>
<div class="doc-container">
  <div style="border-bottom:2px solid #0d9488;padding-bottom:12px;margin-bottom:20px;">
    <h2 style="margin:0;font-size:16pt;color:#0f172a;">' . $safeTitle . '</h2>
    <div style="font-size:10pt;color:#64748b;margin-top:4px;">Berkas Bukti Dukung (Eviden) Monev SKI BBPK Jakarta</div>
  </div>
  ' . $bodyContent . '
</div>
<script>
  window.addEventListener("load", function(){
    setTimeout(function(){ window.print(); }, 400);
  });
</script>
</body>
</html>';
    exit;
}