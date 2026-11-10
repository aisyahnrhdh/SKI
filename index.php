<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/auth.php';
$isAuth = isLoggedIn();
$user = getCurrentUser();
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover">
<title>MONEV SKI - BBPK Jakarta | Kementerian Kesehatan RI</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="icon" href="assets/images/logo-kemenkes.webp">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
:root{
  --bg:#f2f7f6;--card:#ffffff;--tx:#1b2333;--mut:#64748b;--bd:#e2e8f0;
  --pri:#0a8f83;--pri2:#e0f4f1;--pri3:#0d9488;--dk:#075e57;
  --ok:#16a34a;--ok-bg:#dcfce7;
  --wn:#d97706;--wn-bg:#fef3c7;
  --er:#dc2626;--er-bg:#fee2e2;
  --bl:#2563eb;--bl-bg:#dbeafe;
  --pu:#7c3aed;--pu-bg:#ede9fe;
  --side:#ffffff;
  box-sizing:border-box;padding-top:env(safe-area-inset-top,0px);padding-bottom:env(safe-area-inset-bottom,0px);
}
*{box-sizing:border-box}html{scroll-padding-top:env(safe-area-inset-top,0px)}
body{
  margin:0;background:#f8fafc;color:var(--tx);
  font:14px/1.5 "Plus Jakarta Sans",system-ui,-apple-system,"Segoe UI",Roboto,sans-serif;
}
.app{display:flex;min-height:100vh;align-items:flex-start}
.side{position:sticky;top:0;height:100vh;height:100dvh;align-self:flex-start;display:flex;width:284px;flex-shrink:0;z-index:10;transition:width .25s cubic-bezier(.4,0,.2,1);background:none}
.side.col{width:72px}
.rail{width:72px;height:100%;background:#d5f3ed;border-right:1px solid rgba(13,148,136,.14);display:flex;flex-direction:column;align-items:center;padding:16px 0;gap:8px;z-index:2;flex-shrink:0}
.rl{width:48px;height:48px;border-radius:14px;background:#fff;border:1px solid rgba(13,148,136,.16);box-shadow:0 4px 12px rgba(10,95,87,.08);display:grid;place-items:center;margin-bottom:10px;overflow:hidden;padding:4px}
.rl img{width:32px;height:32px;object-fit:contain}
.rb{width:46px;height:46px;border-radius:12px;border:2px solid transparent;background:transparent;color:#475569;display:grid;place-items:center;cursor:pointer;transition:all .18s ease;position:relative}
.rb:hover{color:var(--pri);background:rgba(255,255,255,.55)}
.rb.on{border-color:var(--pri);color:var(--pri);background:rgba(255,255,255,.85);box-shadow:0 2px 8px rgba(13,148,136,.12)}
.panel{width:212px;height:100%;background:#e2f7f4;border-right:1px solid rgba(13,148,136,.14);padding:18px 12px;display:flex;flex-direction:column;overflow-y:auto;position:relative;flex-shrink:0}
.side.col .panel{display:none}
.plogo{display:flex;align-items:center;gap:8px;margin-bottom:16px;padding:2px 4px 12px;border-bottom:1px solid rgba(13,148,136,.12);min-height:46px}
.plogo img{max-width:140px;height:auto;max-height:38px;object-fit:contain}
.tg{position:absolute;right:-13px;top:88px;width:26px;height:26px;border-radius:50%;border:1px solid rgba(13,148,136,.22);background:#fff;color:#475569;display:grid;place-items:center;cursor:pointer;box-shadow:0 2px 8px rgba(0,0,0,.1);z-index:12;transition:transform .2s ease,color .15s}
.tg:hover{color:var(--pri);transform:scale(1.08)}
.side.col .tg{left:59px;right:auto}
.side.col .tg svg{transform:rotate(180deg)}
.pg{display:none;flex-direction:column;gap:3px}
.pg.on{display:flex}
.panel-section-title{display:none}
.nav{display:flex;align-items:center;justify-content:space-between;width:100%;text-align:left;background:none;border:0;color:#334155;padding:10px 14px;border-radius:12px;cursor:pointer;font:inherit;font-size:13.5px;font-weight:500;margin-bottom:3px;transition:all .15s ease}
.nav:hover:not(.on){background:rgba(255,255,255,.55);color:var(--pri)}
.nav.on{background:rgba(255,255,255,.9);color:#0d9488;font-weight:700;box-shadow:0 2px 8px rgba(10,95,87,.06)}
.mw{flex:1;min-width:0;display:flex;flex-direction:column;min-height:100vh}
.hd{background:#087066;color:#fff;min-height:68px;padding:0 24px;display:flex;align-items:center;gap:14px;position:sticky;top:env(safe-area-inset-top,0px);z-index:5;box-shadow:0 2px 10px rgba(7,94,87,.2)}
.hd-brand{font-size:16px;font-weight:800;line-height:1.2;letter-spacing:-.01em;white-space:nowrap}
.hd-brand small{display:block;margin-top:2px;font-size:11.5px;font-weight:400;color:rgba(255,255,255,.78)}
.ua{margin-left:auto;display:flex;gap:16px;align-items:center}
.hl{color:rgba(255,255,255,.88);text-decoration:none;font-weight:500;display:inline-flex;align-items:center;gap:4px;font-size:12.5px}
.hl:hover{color:#fff}
.usr{display:flex;align-items:center;gap:10px;padding:4px 10px 4px 14px;border-left:1px solid rgba(255,255,255,.22);cursor:pointer;border-radius:12px;transition:all .18s ease;user-select:none}
.usr:hover{background:rgba(255,255,255,.16);box-shadow:0 2px 10px rgba(0,0,0,.08);transform:translateY(-1px)}
.usr i{width:36px;height:36px;border-radius:50%;background:rgba(255,255,255,.16);color:#fff;display:grid;place-items:center;font-weight:700;font-style:normal;font-size:12px;box-shadow:0 0 0 2px rgba(255,255,255,.25);transition:transform .18s ease}
.usr:hover i{transform:scale(1.06)}
.un{display:flex;flex-direction:column;line-height:1.25}.un b{font-size:13px;font-weight:600}.un small{font-size:11.5px;color:rgba(255,255,255,.75)}
.btn{background:var(--pri);color:#fff;border:0;border-radius:10px;padding:8px 14px;cursor:pointer;font:inherit;font-weight:600;transition:.15s;box-shadow:0 2px 6px rgba(10,143,131,.25);display:inline-flex;align-items:center;justify-content:center;gap:6px}
.btn:hover{filter:brightness(1.08);transform:translateY(-1px)}.btn.o{background:none;color:var(--pri);border:1px solid var(--pri);box-shadow:none}
.btn.o:hover{background:var(--pri2)}.btn.lo{background:none;color:#fff;border:1px solid rgba(255,255,255,.4);border-radius:8px;box-shadow:none;display:inline-flex;align-items:center;gap:7px;padding:6px 12px;font-size:12.5px}
.btn.lo:hover{background:rgba(255,255,255,.14);border-color:#fff;transform:none}
.btn.sm{padding:6px 11px;font-size:12px;border-radius:8px}
.main{flex:1;padding:20px}
.hero{background:none;color:var(--tx);padding:2px 0 6px;margin-bottom:14px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px}
.hero h1{font-size:24px;margin:0;letter-spacing:-.4px;display:flex;align-items:center;gap:10px;font-weight:700;color:#0f172a}
.hero p{color:#64748b;margin:0 0 3px;font-size:13px;font-weight:500}
.card{background:#fff;border:1px solid var(--bd);border-radius:14px;box-shadow:0 2px 8px rgba(15,23,42,.04);padding:16px}
.grid{display:grid;gap:14px}.kp{grid-template-columns:repeat(auto-fit,minmax(210px,1fr))}.dg{grid-template-columns:1.5fr 1fr}.g2{grid-template-columns:repeat(auto-fit,minmax(300px,1fr))}
.kc{display:flex;align-items:center;gap:14px;background:#fff;border:1px solid var(--bd);border-radius:14px;padding:14px 16px;box-shadow:0 2px 8px rgba(15,23,42,.04)}
.kt{width:46px;height:46px;border-radius:12px;display:grid;place-items:center;flex-shrink:0}
.kc span{display:block;font-size:12px;color:var(--mut)}.kc b{font-size:18px}.kc .dl{display:block;font-style:normal;font-size:11px;color:var(--mut);margin-top:2px}
.bar{height:9px;background:var(--bd);border-radius:6px;overflow:hidden}.bar i{display:block;height:100%;border-radius:6px}
.row{display:flex;justify-content:space-between;align-items:center;gap:8px;margin:8px 0 3px;font-size:13px}
.tag{display:inline-flex;align-items:center;padding:3px 10px;border-radius:999px;font-size:11px;font-weight:600;white-space:nowrap}
.tag:before{content:"";display:inline-block;width:6px;height:6px;border-radius:50%;background:currentColor;margin-right:6px}
.t-ok{background:var(--ok-bg);color:var(--ok)}.t-wn{background:var(--wn-bg);color:var(--wn)}.t-er{background:var(--er-bg);color:var(--er)}
.t-in{background:var(--pri2);color:var(--pri)}.t-bl{background:var(--bl-bg);color:var(--bl)}.t-pu{background:var(--pu-bg);color:var(--pu)}
.t-pk{background:#fce7f3;color:#be185d}.t-gy{background:var(--bd);color:var(--mut)}
.tw{overflow-x:auto}table{width:100%;border-collapse:collapse;min-width:600px}
th{text-align:left;font-size:11px;color:var(--mut);font-weight:700;text-transform:uppercase;letter-spacing:.04em;background:color-mix(in srgb,var(--bg) 65%,transparent);padding:10px 8px;border-bottom:1px solid var(--bd)}
td{padding:10px 8px;border-bottom:1px solid var(--bd);vertical-align:middle}
.split{display:grid;grid-template-columns:310px 1fr;gap:14px;align-items:start}
.qi{display:block;width:100%;text-align:left;background:none;border:0;border-bottom:1px solid var(--bd);padding:11px 10px;cursor:pointer;font:inherit;color:inherit;border-radius:10px;transition:.15s}
.qi:hover{background:var(--pri2)}.qi.on{background:var(--pri2);font-weight:600}.qi small{display:block;color:var(--mut);margin-top:2px}
.ring{position:relative;width:160px;height:160px;margin:6px auto 10px}.rv{position:absolute;inset:0;display:grid;place-content:center;text-align:center}.rv b{font-size:32px;letter-spacing:-1px}.rv span{font-size:11px;color:var(--mut)}
.chip{display:inline-block;padding:3px 9px;border-radius:99px;background:var(--er-bg);color:var(--er);font-size:11.5px;margin:2px 4px 2px 0}
.srch,.fl{padding:9px 12px;border:1px solid var(--bd);border-radius:10px;background:var(--card);color:var(--tx);font:inherit}
.badge{margin-left:auto;background:#e5484d;color:#fff;border-radius:99px;font-size:11px;padding:1px 7px;font-weight:700}
.toast{position:fixed;bottom:calc(20px + env(safe-area-inset-bottom,0px));left:50%;transform:translateX(-50%);background:var(--dk);color:#fff;padding:10px 18px;border-radius:10px;display:none;z-index:9999;max-width:90vw;text-align:center;box-shadow:0 8px 24px rgba(0,0,0,.25)}
.scr{display:none}.scr.on{display:block}
.mbt,.ov{display:none}


/* Banner Pemandu Langkah Kerja */
.guide-banner{background:linear-gradient(135deg,rgba(10,143,131,.12),rgba(13,148,136,.04));border-left:4px solid var(--pri);border-radius:12px;padding:12px 16px;margin-bottom:16px;display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap}
.guide-banner b{color:var(--dk);font-size:13.5px;display:flex;align-items:center;gap:6px}
.guide-banner p{margin:2px 0 0;font-size:12.5px;color:var(--tx);opacity:.9}

/* Reusable Modal Card Popup System */
.modal-backdrop{position:fixed;inset:0;background:rgba(8,20,24,.55);display:flex;align-items:center;justify-content:center;padding:20px;z-index:999;opacity:0;pointer-events:none;transition:opacity .25s ease}
.modal-backdrop.on{opacity:1;pointer-events:auto}
.modal-card{width:100%;max-width:640px;max-height:88vh;background:#fff;border:1px solid var(--bd);border-radius:16px;box-shadow:0 12px 32px rgba(15,23,42,.16);display:flex;flex-direction:column;overflow:hidden;transform:translateY(20px) scale(.97);transition:transform .25s cubic-bezier(.16,1,.3,1)}
.modal-backdrop.on .modal-card{transform:translateY(0) scale(1)}
.modal-header{padding:16px 22px;border-bottom:1px solid var(--bd);display:flex;align-items:center;justify-content:space-between;background:linear-gradient(135deg,rgba(10,143,131,.08),transparent)}
.modal-header h3{margin:0;font-size:17px;color:var(--dk);display:flex;align-items:center;gap:8px}
.modal-close{background:none;border:0;font-size:24px;line-height:1;color:var(--mut);cursor:pointer;padding:2px 8px;border-radius:8px;transition:.15s}
.modal-close:hover{background:var(--pri2);color:var(--er)}
.modal-body{padding:20px 22px;overflow-y:auto;flex:1;font-size:13.5px}
.modal-footer{padding:14px 22px;border-top:1px solid var(--bd);display:flex;justify-content:flex-end;gap:10px;background:color-mix(in srgb,var(--bg) 60%,transparent)}

/* Dropzone & File Input Box */
.drop-zone{border:2px dashed var(--pri);border-radius:14px;padding:24px;text-align:center;background:var(--pri2);cursor:pointer;transition:.2s}
.drop-zone:hover{background:#d0ede8;border-color:var(--dk)}
.drop-zone svg{color:var(--pri);margin-bottom:6px}

/* Login Page Styling */
.lv{position:relative;overflow:hidden;background:#087066;display:grid;grid-template-columns:1.1fr 1fr;min-height:100vh}
.lb{padding:40px 56px;color:#fff;display:flex;flex-direction:column;justify-content:center;gap:14px}
.lgr{display:flex;align-items:center;gap:14px;margin-bottom:34px}.lgring{width:60px;height:60px;border-radius:50%;background:#fff;color:#075e57;display:grid;place-items:center;font-weight:800;font-size:15px;box-shadow:0 0 0 8px rgba(255,255,255,.16)}
.lb h2{font-size:clamp(40px,6vw,68px);line-height:1;letter-spacing:-2px;margin:0}.ul{width:84px;height:5px;border-radius:3px;background:#5eead4;margin:18px 0 22px}
.lb p{font-size:18px;line-height:1.55;max-width:460px;margin:0}
.lf{display:flex;align-items:center;justify-content:center;padding:28px}.lf .card{width:100%;max-width:420px;padding:32px;border-radius:16px;box-shadow:0 8px 24px rgba(0,0,0,.12);background:#fff}
.inp{position:relative;margin:6px 0 14px}.inp input,.inp select{width:100%;margin:0;padding:12px 14px 12px 44px;background:var(--bg);border:1px solid var(--bd);border-radius:12px;color:var(--tx);font:inherit}
.inp .ei{position:absolute;left:14px;top:50%;transform:translateY(-50%);color:var(--pri);pointer-events:none}
.eyeb{position:absolute;right:10px;top:50%;transform:translateY(-50%);background:none;border:0;color:var(--mut);cursor:pointer;padding:6px}

.btn-google{width:100%;padding:12px 16px;font-size:14px;font-weight:600;border-radius:12px;background:#ffffff;border:1px solid #dadce0;color:#3c4043;display:inline-flex;align-items:center;justify-content:center;gap:10px;cursor:pointer;box-shadow:0 1px 3px rgba(0,0,0,.08);transition:all .18s ease;margin-bottom:10px;font-family:inherit}
.btn-google:hover{background:#f8fafc;border-color:#cbd5e1;box-shadow:0 3px 10px rgba(0,0,0,.1);transform:translateY(-1px)}
.btn-google:active{transform:translateY(0);background:#f1f5f9}

.panel-section-title{display:none}

@media(max-width:768px){
  .app{flex-direction:column}
  .mw{width:100%;min-width:0}
  .lv{grid-template-columns:1fr}.lb{padding:28px 20px;text-align:center;align-items:center}.lb h2{font-size:32px}.ul{margin:12px auto 16px}.lb p{font-size:14px}
  .lgr{margin-bottom:20px;justify-content:center}
  .lf{padding:16px 14px 32px}.lf .card{padding:22px 18px;border-radius:20px}
  .hd{padding:8px 12px;min-height:56px;gap:8px}
  .hd-brand{font-size:13.5px;max-width:54vw;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
  .hd-brand small{display:none}
  .hl{display:none}
  .ua{gap:8px}
  .usr{padding-left:8px;border-left:0}
  .usr i{width:32px;height:32px;font-size:11px}
  .btn.lo{padding:6px 9px;font-size:11.5px}
  .btn.lo span{display:none}
  .mbt{display:grid;place-items:center;width:38px;height:38px;border-radius:10px;border:1px solid rgba(255,255,255,.35);background:rgba(255,255,255,.12);color:#fff;cursor:pointer;flex-shrink:0}
  .side{position:fixed!important;left:0;top:0;bottom:0;width:284px!important;max-width:86vw!important;height:100dvh!important;z-index:60;transform:translateX(-104%);transition:transform .25s ease;display:flex!important;background:#e2f7f4!important}
  body.nav-open .side{transform:none;box-shadow:0 0 50px rgba(0,0,0,.45)}
  .ov{display:none;position:fixed;inset:0;background:rgba(8,20,24,.55);z-index:58}
  body.nav-open .ov{display:block}body.nav-open{overflow:hidden}
  .tg{display:none!important}
  .side.col{width:284px!important;max-width:86vw!important}
  .side.col .panel{display:flex!important}
  .mobile-drawer-close{display:inline-block!important}
  .un{display:none}
  .split{grid-template-columns:1fr;gap:12px}
  .main{padding:12px 10px}
  .hero{flex-direction:column;align-items:flex-start;gap:8px;margin-bottom:10px}
  .hero h1{font-size:19px}
  .hero > div:last-child{width:100%;display:flex;flex-direction:column;gap:8px}
  .hero > div:last-child .role, .hero > div:last-child .role select{width:100%}
  .hero > div:last-child #btnPageGuide{width:100%;justify-content:center}
  .card{padding:14px 12px;border-radius:14px}
  .grid.kp{grid-template-columns:1fr;gap:10px}
  .grid.dg{grid-template-columns:1fr;gap:12px}
  .grid.g2{grid-template-columns:1fr;gap:12px}
  .tw{overflow-x:auto;-webkit-overflow-scrolling:touch;border-radius:10px;margin:8px 0}
  table{min-width:560px}
  th,td{padding:8px 6px;font-size:12px}
  .modal-backdrop{padding:10px;align-items:flex-end}
  .modal-card{max-height:92vh;border-radius:20px 20px 12px 12px}
  .modal-header{padding:12px 16px}
  .modal-body{padding:14px 16px;font-size:13px}
  .modal-footer{padding:12px 16px;flex-wrap:wrap;gap:8px}
  .modal-footer .btn{flex:1 1 auto;padding:10px 14px}
}

/* ========================================================
   DASHBOARD NEW DESIGN (MATCHING MOCKUP)
   ======================================================== */
.dash-kpi-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
  gap: 16px;
  margin-bottom: 22px;
}
.dash-kpi-card {
  background: #ffffff;
  border-radius: 18px;
  border: 1px solid #eef2f6;
  box-shadow: 0 4px 18px rgba(15, 23, 42, 0.04);
  padding: 18px 20px;
  display: flex;
  align-items: center;
  gap: 16px;
  transition: transform .2s ease, box-shadow .2s ease;
}
.dash-kpi-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 24px rgba(15, 23, 42, 0.08);
}
.dash-kpi-icon {
  width: 48px;
  height: 48px;
  border-radius: 14px;
  display: grid;
  place-items: center;
  color: #fff;
  flex-shrink: 0;
}
.dash-kpi-info {
  display: flex;
  flex-direction: column;
}
.dash-kpi-label {
  font-size: 12px;
  font-weight: 500;
  color: #64748b;
  margin-bottom: 2px;
}
.dash-kpi-val {
  font-size: 26px;
  font-weight: 800;
  color: #0f172a;
  line-height: 1.15;
}
.dash-kpi-sub {
  font-size: 11.5px;
  color: #94a3b8;
  margin-top: 2px;
}

.dash-main-grid {
  display: grid;
  grid-template-columns: 1.65fr 1fr;
  gap: 20px;
  align-items: start;
}
@media (max-width: 992px) {
  .dash-main-grid {
    grid-template-columns: 1fr;
  }
}
.dash-card {
  background: #ffffff;
  border-radius: 20px;
  border: 1px solid rgba(226, 232, 240, 0.85);
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
  padding: 22px 24px;
}
.dash-card-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 20px;
}
.dash-card-title {
  margin: 0;
  font-size: 17.5px;
  font-weight: 700;
  color: #0f172a;
  letter-spacing: -0.2px;
}
.dash-badge-period {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: #e6f8f5;
  color: #0d9488;
  font-size: 12px;
  font-weight: 700;
  padding: 5px 12px;
  border-radius: 99px;
}
.dash-badge-period i {
  display: inline-block;
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #0d9488;
}
.dash-mod-row {
  margin-bottom: 16px;
}
.dash-mod-row:last-child {
  margin-bottom: 0;
}
.dash-mod-meta {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 7px;
  font-size: 13.5px;
}
.dash-mod-name {
  font-weight: 600;
  color: #1e293b;
}
.dash-mod-count {
  color: #64748b;
  font-size: 12.5px;
}
.dash-mod-count b {
  color: #0f172a;
}
.dash-mod-status {
  font-weight: 700;
  font-size: 12px;
  margin-left: 8px;
}
.dash-mod-bar {
  height: 9px;
  background: #e8ecf4;
  border-radius: 99px;
  overflow: hidden;
  width: 100%;
}
.dash-mod-fill {
  height: 100%;
  border-radius: 99px;
  transition: width 0.4s ease;
}
.dash-donut-wrap {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 10px 0 6px;
}
.dash-donut-ring {
  position: relative;
  width: 180px;
  height: 180px;
}
.dash-donut-center {
  position: absolute;
  inset: 0;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
}
.dash-donut-pct {
  font-size: 38px;
  font-weight: 800;
  color: #0f172a;
  line-height: 1;
  letter-spacing: -0.5px;
}
.dash-donut-sub {
  font-size: 12px;
  color: #64748b;
  margin-top: 5px;
}
.dash-donut-legend {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 16px;
  margin-top: 22px;
  font-size: 12.5px;
  font-weight: 600;
  color: #334155;
  flex-wrap: wrap;
}
.dash-legend-item {
  display: inline-flex;
  align-items: center;
  gap: 6px;
}
.dash-legend-dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
}
.dash-period-select {
  appearance: none;
  -webkit-appearance: none;
  background: #ffffff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%23475569' stroke-width='2.5'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E") no-repeat right 14px center;
  border: 1px solid #cbd5e1;
  border-radius: 999px;
  padding: 7px 34px 7px 16px;
  font-size: 13px;
  font-weight: 600;
  color: #334155;
  cursor: pointer;
  box-shadow: 0 1px 3px rgba(0,0,0,0.04);
  outline: none;
  transition: all .15s ease;
}
.dash-period-select:hover {
  border-color: #94a3b8;
  box-shadow: 0 2px 6px rgba(0,0,0,0.06);
}

/* ========================================================
   PIC DASHBOARD SHORTCUTS & ACTION CARDS
   ======================================================== */
.dash-pic-pills-bar {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-bottom: 16px;
  padding-bottom: 14px;
  border-bottom: 1px solid #f1f5f9;
}
.dash-pic-pill {
  appearance: none;
  background: #f8fafc;
  border: 1px solid #e2e8f0;
  border-radius: 99px;
  padding: 6px 13px;
  font-size: 12px;
  font-weight: 600;
  color: #475569;
  cursor: pointer;
  transition: all .15s ease;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  text-decoration: none;
}
.dash-pic-pill:hover {
  background: #ffffff;
  border-color: #cbd5e1;
  transform: translateY(-1px);
  box-shadow: 0 2px 6px rgba(15, 23, 42, 0.05);
}
.dash-pic-pill.revisi {
  background: #fff5f5;
  border-color: #fecaca;
  color: #dc2626;
}
.dash-pic-pill.revisi:hover {
  background: #fef2f2;
  border-color: #f87171;
}
.dash-pic-pill.belum {
  background: #fffdf0;
  border-color: #fde68a;
  color: #b45309;
}
.dash-pic-pill.belum:hover {
  background: #fffbeb;
  border-color: #fbbf24;
}
.dash-pic-pill.selesai {
  background: #f0fdf4;
  border-color: #a7f3d0;
  color: #059669;
}
.dash-pic-pill.selesai:hover {
  background: #ecfdf5;
  border-color: #34d399;
}
.dash-pic-warn-box {
  margin-top: 6px;
  font-size: 11.5px;
  padding: 6px 10px;
  border-radius: 6px;
  cursor: pointer;
  line-height: 1.4;
  transition: all .15s ease;
}
.dash-pic-warn-box.danger {
  color: #991b1b;
  background: #fef2f2;
  border: 1px solid #fecaca;
}
.dash-pic-warn-box.danger:hover {
  background: #fee2e2;
  border-color: #f87171;
}
.dash-pic-warn-box.warning {
  color: #9a3412;
  background: #fff7ed;
  border: 1px solid #fed7aa;
}
.dash-pic-warn-box.warning:hover {
  background: #ffedd5;
  border-color: #fb923c;
}
.dash-pic-warn-box.info {
  color: #1e40af;
  background: #eff6ff;
  border: 1px solid #bfdbfe;
}
.dash-pic-warn-box.info:hover {
  background: #dbeafe;
  border-color: #93c5fd;
}
.dash-pic-warn-box.success {
  color: #065f46;
  background: #ecfdf5;
  border: 1px solid #a7f3d0;
}
.dash-pic-warn-box.success:hover {
  background: #d1fae5;
  border-color: #6ee7b7;
}
.dash-tenggat-item {
  transition: background .15s ease, border-color .15s ease;
}
.dash-tenggat-item:hover {
  background: #f1f5f9 !important;
  border-color: #cbd5e1 !important;
}
.dash-pic-mod-card {
  padding: 14px 16px;
  border-radius: 14px;
  background: #f8fafc;
  border: 1px solid #eef2f6;
  margin-bottom: 12px;
  transition: border-color .15s ease, background .15s ease, box-shadow .15s ease;
}
.dash-pic-mod-card:hover {
  background: #ffffff;
  border-color: #cbd5e1;
  box-shadow: 0 4px 14px rgba(15, 23, 42, 0.04);
}
.dash-pic-mod-card:last-child {
  margin-bottom: 0;
}

/* ========================================================
   MASTER MODUL & TEMPLATE - CARD SYSTEM STYLES
   ======================================================== */
.mod-kpi-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 12px;
  margin-bottom: 16px;
}
.mod-kpi-card {
  background: color-mix(in srgb, var(--card) 68%, transparent);
  backdrop-filter: blur(16px) saturate(150%);
  border: 1px solid color-mix(in srgb, var(--card) 40%, #fff);
  border-radius: 16px;
  padding: 14px 16px;
  display: flex;
  align-items: center;
  gap: 14px;
  box-shadow: 0 4px 18px rgba(31,60,110,0.05);
  transition: transform .2s ease, box-shadow .2s ease;
}
.mod-kpi-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 24px rgba(31,60,110,0.09);
}
.mod-kpi-icon {
  width: 44px;
  height: 44px;
  border-radius: 12px;
  display: grid;
  place-items: center;
  flex-shrink: 0;
}
.mod-kpi-info span {
  display: block;
  font-size: 11.5px;
  color: var(--mut);
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: .03em;
}
.mod-kpi-info b {
  font-size: 20px;
  color: var(--tx);
  letter-spacing: -.5px;
}
.mod-kpi-info small {
  display: block;
  font-size: 11px;
  color: var(--mut);
  margin-top: 2px;
}

/* Toolbar Card */
.mod-toolbar-card {
  background: color-mix(in srgb, var(--card) 75%, transparent);
  backdrop-filter: blur(16px);
  border: 1px solid color-mix(in srgb, var(--card) 40%, #fff);
  border-radius: 16px;
  padding: 12px 16px;
  margin-bottom: 18px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  flex-wrap: wrap;
  box-shadow: 0 4px 18px rgba(31,60,110,0.04);
}
.mod-toolbar-left {
  display: flex;
  align-items: center;
  gap: 10px;
  flex-wrap: wrap;
  flex: 1;
}
.mod-search-box {
  position: relative;
  min-width: 240px;
  flex: 1 1 240px;
}
.mod-search-box svg {
  position: absolute;
  left: 12px;
  top: 50%;
  transform: translateY(-50%);
  color: var(--mut);
  pointer-events: none;
}
.mod-search-input {
  width: 100%;
  padding: 8px 12px 8px 36px;
  border: 1px solid var(--bd);
  border-radius: 10px;
  background: var(--card);
  color: var(--tx);
  font: inherit;
  font-size: 13px;
  transition: border-color .15s ease, box-shadow .15s ease;
}
.mod-search-input:focus {
  outline: none;
  border-color: var(--pri);
  box-shadow: 0 0 0 3px var(--pri2);
}
.mod-filter-tabs {
  display: inline-flex;
  background: color-mix(in srgb, var(--bg) 80%, transparent);
  padding: 3px;
  border-radius: 10px;
  border: 1px solid var(--bd);
  gap: 2px;
}
.mod-filter-btn {
  background: none;
  border: 0;
  border-radius: 8px;
  padding: 6px 12px;
  font-size: 12px;
  font-weight: 600;
  color: var(--mut);
  cursor: pointer;
  transition: .15s ease;
  display: inline-flex;
  align-items: center;
  gap: 6px;
}
.mod-filter-btn:hover {
  color: var(--pri);
}
.mod-filter-btn.on {
  background: var(--card);
  color: var(--pri);
  box-shadow: 0 2px 6px rgba(0,0,0,0.06);
}
.mod-unit-select {
  padding: 8px 12px;
  border: 1px solid var(--bd);
  border-radius: 10px;
  background: var(--card);
  color: var(--tx);
  font: inherit;
  font-size: 12.5px;
  font-weight: 500;
}

/* Modul Grid Layout */
.mod-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
  gap: 16px;
  align-items: start;
}
@media (max-width: 900px) {
  .mod-grid {
    grid-template-columns: 1fr;
  }
  .mod-toolbar-card {
    flex-direction: column;
    align-items: stretch;
  }
  .mod-toolbar-left {
    flex-direction: column;
    align-items: stretch;
  }
  .mod-search-box {
    width: 100%;
  }
}

/* Modul Card */
.mod-card {
  background: color-mix(in srgb, var(--card) 88%, transparent);
  backdrop-filter: blur(20px) saturate(150%);
  border: 1px solid color-mix(in srgb, var(--card) 40%, #fff);
  border-radius: 18px;
  box-shadow: 0 6px 22px rgba(31,60,110,0.06);
  padding: 16px 18px;
  display: flex;
  flex-direction: column;
  gap: 12px;
  transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
  position: relative;
  overflow: hidden;
}
.mod-card:hover {
  box-shadow: 0 10px 30px rgba(31,60,110,0.1);
  border-color: color-mix(in srgb, var(--pri) 35%, var(--bd));
}
.mod-card.is-terbit::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, #10b981, #0a8f83);
}
.mod-card.is-draf::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, #f59e0b, #d97706);
}

.mod-card-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 10px;
}
.mod-card-badges {
  display: flex;
  align-items: center;
  gap: 6px;
  flex-wrap: wrap;
}
.mod-card-actions {
  display: flex;
  align-items: center;
  gap: 5px;
}
.mod-btn-icon {
  background: color-mix(in srgb, var(--bg) 80%, transparent);
  border: 1px solid var(--bd);
  border-radius: 8px;
  width: 30px;
  height: 30px;
  display: grid;
  place-items: center;
  cursor: pointer;
  color: var(--mut);
  transition: .15s ease;
  padding: 0;
}
.mod-btn-icon:hover {
  background: var(--pri2);
  color: var(--pri);
  border-color: var(--pri);
}
.mod-btn-icon.danger:hover {
  background: var(--er-bg);
  color: var(--er);
  border-color: var(--er);
}

.mod-card-title-row {
  display: flex;
  flex-direction: column;
  gap: 4px;
}
.mod-card-title {
  margin: 0;
  font-size: 16px;
  font-weight: 700;
  color: var(--dk);
  line-height: 1.3;
  letter-spacing: -.3px;
}
.mod-card-meta {
  display: flex;
  align-items: center;
  gap: 12px;
  font-size: 12px;
  color: var(--mut);
  flex-wrap: wrap;
}
.mod-meta-item {
  display: inline-flex;
  align-items: center;
  gap: 5px;
}

.mod-status-note {
  font-size: 11.5px;
  color: var(--mut);
  display: flex;
  align-items: center;
  gap: 6px;
  background: color-mix(in srgb, var(--bg) 50%, transparent);
  padding: 6px 10px;
  border-radius: 8px;
  border: 1px solid var(--bd);
}

/* Template Box inside Modul Card */
.mod-template-box {
  background: color-mix(in srgb, var(--card) 95%, transparent);
  border: 1px solid rgba(13,148,136,.2);
  border-radius: 12px;
  padding: 10px 12px;
  display: flex;
  flex-direction: column;
  gap: 8px;
}
.mod-template-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 8px;
}
.mod-template-title {
  font-size: 12px;
  font-weight: 700;
  color: var(--dk);
  display: flex;
  align-items: center;
  gap: 6px;
  margin: 0;
}
.mod-template-content {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 10px;
  background: #f8fafc;
  border: 1px solid var(--bd);
  border-radius: 9px;
  padding: 7px 10px;
  flex-wrap: wrap;
}
.mod-template-fileinfo {
  display: flex;
  align-items: center;
  gap: 8px;
  min-width: 0;
  flex: 1;
}
.mod-template-filename {
  font-size: 12.5px;
  font-weight: 600;
  color: var(--tx);
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
.mod-template-actions {
  display: flex;
  align-items: center;
  gap: 6px;
  flex-wrap: wrap;
}
.mod-template-empty {
  background: #fdfefe;
  border: 1px dashed rgba(13,148,136,.32);
  border-radius: 9px;
  padding: 9px 12px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 10px;
  flex-wrap: wrap;
}
.mod-template-empty-text {
  font-size: 11.5px;
  color: var(--mut);
  line-height: 1.4;
  flex: 1;
  min-width: 200px;
}

/* Indicator Box inside Card */
.mod-ind-box {
  background: color-mix(in srgb, var(--bg) 65%, transparent);
  border: 1px solid var(--bd);
  border-radius: 12px;
  padding: 10px 12px;
  display: flex;
  flex-direction: column;
  gap: 8px;
}
.mod-ind-box-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 8px;
}
.mod-ind-title {
  font-size: 12px;
  font-weight: 700;
  color: var(--tx);
  display: flex;
  align-items: center;
  gap: 6px;
  margin: 0;
}
.mod-ind-badge {
  background: var(--pri2);
  color: var(--pri);
  padding: 1px 7px;
  border-radius: 99px;
  font-size: 11px;
  font-weight: 700;
}
.mod-ind-toggle {
  background: none;
  border: 0;
  color: var(--pri);
  font-size: 11.5px;
  font-weight: 600;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 4px;
  padding: 2px 6px;
  border-radius: 6px;
  transition: .15s ease;
}
.mod-ind-toggle:hover {
  background: var(--pri2);
}

.mod-ind-list {
  display: flex;
  flex-direction: column;
  gap: 6px;
  margin-top: 2px;
}
.mod-ind-item {
  display: flex;
  align-items: center;
  gap: 8px;
  background: var(--card);
  border: 1px solid var(--bd);
  border-radius: 9px;
  padding: 5px 8px;
  transition: border-color .15s ease, box-shadow .15s ease;
}
.mod-ind-item:focus-within {
  border-color: var(--pri);
  box-shadow: 0 0 0 2px var(--pri2);
}
.mod-ind-num {
  width: 20px;
  height: 20px;
  border-radius: 50%;
  background: var(--pri2);
  color: var(--pri);
  font-size: 10.5px;
  font-weight: 800;
  display: grid;
  place-items: center;
  flex-shrink: 0;
}
.mod-ind-input {
  flex: 1;
  border: 0;
  background: none;
  font: inherit;
  font-size: 12px;
  color: var(--tx);
  padding: 4px 0;
  min-width: 0;
}
.mod-ind-input:focus {
  outline: none;
}
.mod-ind-actions {
  display: flex;
  align-items: center;
  gap: 4px;
}

/* Quick Add Indicator Row */
.mod-quick-add-row {
  display: flex;
  align-items: center;
  gap: 6px;
  margin-top: 4px;
}
.mod-quick-add-inp {
  flex: 1;
  padding: 6px 10px;
  border: 1px dashed var(--bd);
  border-radius: 8px;
  background: var(--card);
  font: inherit;
  font-size: 12px;
  color: var(--tx);
  transition: border-color .15s ease, box-shadow .15s ease;
}
.mod-quick-add-inp:focus {
  outline: none;
  border: 1px solid var(--pri);
  box-shadow: 0 0 0 2px var(--pri2);
}

.mod-card-footer {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding-top: 10px;
  border-top: 1px solid var(--bd);
  margin-top: auto;
  gap: 8px;
  flex-wrap: wrap;
}

/* ========================================================
   MODUL MASTER - WORKSPACE & KATALOG (DESAIN BERSIH & FORMAL)
   Bebas dari ikon/emoji berlebihan, elegan dan mudah dibaca
   ======================================================== */

/* Katalog Modul - Card Redesign Matching Mockup */
.mod-card.catalog-view {
  cursor: pointer;
  padding: 20px 22px;
  gap: 14px;
  border: 1px solid #e2e8f0;
  border-radius: 18px;
  background: #ffffff;
  box-shadow: 0 4px 18px rgba(0, 0, 0, 0.03);
  transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
  position: relative;
}
.mod-card.catalog-view::before {
  display: none !important;
}
.mod-card.catalog-view:hover {
  transform: translateY(-2px);
  border-color: #cbd5e1;
  box-shadow: 0 10px 28px rgba(0, 0, 0, 0.07);
}

/* Card Top Row */
.mod-card-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 8px;
}
.mod-badge-group {
  display: flex;
  align-items: center;
  gap: 6px;
  flex-wrap: wrap;
}
.mod-badge-status {
  display: inline-flex;
  align-items: center;
  padding: 4px 10px;
  border-radius: 999px;
  font-size: 11px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.02em;
}
.mod-badge-status.terbit {
  background: #dcfce7;
  color: #166534;
}
.mod-badge-status.draf {
  background: #fef3c7;
  color: #92400e;
}
.mod-badge-type {
  display: inline-flex;
  align-items: center;
  background: #f1f5f9;
  color: #475569;
  font-size: 11.5px;
  font-weight: 600;
  padding: 4px 10px;
  border-radius: 999px;
}

/* Top Action Icon Buttons */
.mod-top-actions {
  display: flex;
  align-items: center;
  gap: 6px;
}
.mod-icon-btn {
  width: 28px;
  height: 28px;
  border-radius: 8px;
  border: 1px solid #e2e8f0;
  background: #ffffff;
  color: #64748b;
  display: grid;
  place-items: center;
  cursor: pointer;
  transition: all .15s ease;
  padding: 0;
}
.mod-icon-btn:hover {
  background: #f8fafc;
  color: #0f172a;
  border-color: #cbd5e1;
}
.mod-icon-btn.danger:hover {
  background: #fef2f2;
  color: #dc2626;
  border-color: #fca5a5;
}

/* Title & ID & Unit PIC */
.mod-title-area {
  display: flex;
  flex-direction: column;
  gap: 3px;
}
.mod-card-title-text {
  margin: 0;
  font-size: 17.5px;
  font-weight: 800;
  color: #0f172a;
  line-height: 1.3;
  letter-spacing: -0.2px;
}
.mod-card-code-text {
  font-size: 12px;
  color: #64748b;
  font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
  font-weight: 500;
  margin-bottom: 4px;
}
.mod-card-unit-badge {
  display: inline-flex;
  align-items: center;
  background: #f1f5f9;
  color: #334155;
  font-size: 12px;
  font-weight: 600;
  padding: 4px 10px;
  border-radius: 6px;
  width: fit-content;
}

/* Document Requirement Stats (Wajib & Opsional) */
.mod-req-stats {
  display: flex;
  align-items: center;
  gap: 28px;
  padding: 4px 0;
}
.mod-req-col {
  display: flex;
  align-items: center;
  gap: 10px;
}
.mod-req-icon {
  width: 20px;
  height: 20px;
  display: grid;
  place-items: center;
  flex-shrink: 0;
}
.mod-req-text {
  display: flex;
  flex-direction: column;
  line-height: 1.25;
}
.mod-req-num {
  font-size: 13.5px;
  font-weight: 700;
  color: #0f172a;
}
.mod-req-label {
  font-size: 11.5px;
  color: #64748b;
}

/* Format Acuan / Template Box */
.mod-format-box {
  background: #f8fafc;
  border: 1px solid #e2e8f0;
  border-radius: 10px;
  padding: 9px 12px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 10px;
  font-size: 12.5px;
}
.mod-format-text {
  color: #334155;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  flex: 1;
}
.mod-format-empty {
  color: #94a3b8;
  flex: 1;
}
.mod-format-btn {
  background: none;
  border: 0;
  color: #64748b;
  cursor: pointer;
  padding: 4px;
  border-radius: 6px;
  display: grid;
  place-items: center;
  transition: all .15s ease;
}
.mod-format-btn:hover {
  color: #087066;
  background: #e6f8f5;
}

/* Main Action Button - Modern Teal */
.mod-card-btn-primary {
  width: 100%;
  background: #087066;
  color: #ffffff;
  border: 0;
  border-radius: 10px;
  padding: 11px 16px;
  font-size: 13.5px;
  font-weight: 700;
  cursor: pointer;
  text-align: center;
  transition: all .18s ease;
  box-shadow: 0 2px 8px rgba(8, 112, 102, 0.2);
  display: flex;
  align-items: center;
  justify-content: center;
}
.mod-card-btn-primary:hover {
  background: #0b7b71;
  transform: translateY(-1px);
  box-shadow: 0 4px 14px rgba(8, 112, 102, 0.3);
}
.mod-card-btn-primary:active {
  background: #065951;
  transform: none;
}

/* Sub-action Buttons ("Pengaturan" & "Tarik Draf / Terbitkan") */
.mod-card-sub-actions {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-top: -4px;
}
.mod-card-btn-outline {
  flex: 1;
  background: #ffffff;
  color: #334155;
  border: 1px solid #cbd5e1;
  border-radius: 9px;
  padding: 8px 12px;
  font-size: 12.5px;
  font-weight: 600;
  cursor: pointer;
  text-align: center;
  transition: all .15s ease;
}
.mod-card-btn-outline:hover {
  background: #f8fafc;
  border-color: #94a3b8;
  color: #0f172a;
}

/* Workspace Halaman Penuh */
.mod-workspace {
  display: flex;
  flex-direction: column;
  gap: 16px;
}

/* Navigasi Bilah Atas */
.mod-workspace-nav {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  flex-wrap: wrap;
  padding: 2px 0;
}
.btn-back-catalog {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 8px 16px;
  font-size: 13.5px;
  font-weight: 600;
  color: var(--dk);
  background: var(--card);
  border: 1px solid var(--bd);
  border-radius: 8px;
  cursor: pointer;
  transition: all .15s ease;
}
.btn-back-catalog:hover {
  border-color: var(--pri);
  color: var(--pri);
  background: var(--pri2);
}
.mod-workspace-crumb {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 13px;
  color: var(--mut);
  flex-wrap: wrap;
}
.mod-workspace-crumb b {
  color: var(--dk);
  font-weight: 700;
}

/* Hero Header Modul */
.mod-workspace-hero {
  background: var(--card);
  border: 1px solid var(--bd);
  border-top: 4px solid var(--pri);
  border-radius: 14px;
  padding: 20px 22px;
  display: flex;
  flex-direction: column;
  gap: 14px;
}
.mod-hero-top-row {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  flex-wrap: wrap;
}
.mod-hero-title {
  margin: 0 0 6px;
  font-size: 21px;
  font-weight: 700;
  color: var(--dk);
  line-height: 1.35;
}
.mod-hero-meta-grid {
  display: flex;
  align-items: center;
  gap: 18px;
  flex-wrap: wrap;
  background: var(--bg);
  border: 1px solid var(--bd);
  border-radius: 8px;
  padding: 10px 14px;
  font-size: 13px;
}
.mod-hero-meta-item {
  display: flex;
  align-items: baseline;
  gap: 6px;
}
.mod-hero-meta-label {
  color: var(--mut);
  font-size: 12px;
}
.mod-hero-meta-value {
  color: var(--dk);
  font-weight: 700;
}
.mod-hero-actions {
  display: flex;
  align-items: center;
  gap: 8px;
  flex-wrap: wrap;
}

/* Template Card */
.mod-template-card-full {
  background: var(--card);
  border: 1px solid var(--bd);
  border-radius: 12px;
  padding: 14px 18px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 16px;
  flex-wrap: wrap;
}

/* Distribusi Tipe Tagihan */
.mod-stats-distribution {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
  gap: 10px;
}
.mod-dist-card {
  background: var(--card);
  border: 1px solid var(--bd);
  border-radius: 10px;
  padding: 10px 14px;
  display: flex;
  flex-direction: column;
  gap: 2px;
}
.mod-dist-label {
  font-size: 11.5px;
  color: var(--mut);
  font-weight: 600;
  text-transform: uppercase;
}
.mod-dist-val {
  font-size: 14px;
  font-weight: 700;
  color: var(--dk);
}

/* Section Header */
.mod-section-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  flex-wrap: wrap;
  margin-top: 4px;
}
.mod-section-title {
  margin: 0;
  font-size: 17px;
  font-weight: 700;
  color: var(--dk);
}

/* Daftar Butir Tagihan */
.mod-ind-full-list {
  display: flex;
  flex-direction: column;
  gap: 10px;
}
.mod-ind-full-item {
  background: var(--card);
  border: 1px solid var(--bd);
  border-radius: 12px;
  padding: 14px 18px;
  display: flex;
  align-items: flex-start;
  gap: 14px;
  transition: border-color .15s ease;
}
.mod-ind-full-item:hover {
  border-color: color-mix(in srgb, var(--pri) 50%, var(--bd));
}
.mod-ind-full-num {
  width: 28px;
  height: 28px;
  border-radius: 6px;
  background: var(--bg);
  border: 1px solid var(--bd);
  color: var(--dk);
  font-size: 13px;
  font-weight: 700;
  display: grid;
  place-items: center;
  flex-shrink: 0;
}
.mod-ind-full-body {
  flex: 1;
  min-width: 0;
  display: flex;
  flex-direction: column;
  gap: 6px;
}
.mod-ind-full-meta {
  display: flex;
  align-items: center;
  gap: 8px;
  flex-wrap: wrap;
}
.mod-ind-full-text {
  font-size: 14.5px;
  font-weight: 600;
  color: var(--dk);
  line-height: 1.45;
  word-break: break-word;
}
.mod-ind-guide-box {
  background: #f8fafc;
  border: 1px solid #e2e8f0;
  border-left: 3px solid var(--pri);
  border-radius: 6px;
  padding: 8px 12px;
  font-size: 12.5px;
  color: var(--tx);
  line-height: 1.45;
}
.mod-ind-full-actions {
  display: flex;
  align-items: center;
  gap: 6px;
  flex-shrink: 0;
  flex-wrap: wrap;
}

/* Form Studio Tambah Tagihan */
.mod-studio-add-card {
  background: var(--card);
  border: 1px solid var(--bd);
  border-radius: 14px;
  padding: 20px 22px;
  display: flex;
  flex-direction: column;
  gap: 14px;
}
.mod-studio-add-title {
  font-size: 16px;
  font-weight: 700;
  color: var(--dk);
  margin: 0;
}
.mod-type-choice-grid {
  display: flex;
  gap: 8px;
  flex-wrap: wrap;
}
.mod-type-choice-card {
  border: 1px solid var(--bd);
  background: var(--bg);
  border-radius: 8px;
  padding: 8px 14px;
  cursor: pointer;
  display: flex;
  flex-direction: column;
  gap: 2px;
  transition: all .15s ease;
  user-select: none;
  min-width: 140px;
}
.mod-type-choice-card:hover {
  border-color: var(--pri);
}
.mod-type-choice-card.selected {
  border-color: var(--pri);
  background: var(--pri2);
  color: var(--pri);
}
.mod-type-choice-label {
  font-size: 12.5px;
  font-weight: 700;
  color: inherit;
}
.mod-type-choice-sub {
  font-size: 11px;
  color: var(--mut);
}

/* ========================================================
   UPLOAD EVIDEN (PIC) - DAFTAR MODUL TUGAS EVIDEN (CATALOG)
   ======================================================== */
.upl-cat-wrap {
  display: flex;
  flex-direction: column;
  gap: 18px;
  animation: fadeIn .2s ease;
}

/* Breadcrumb & Header */
.upl-cat-header {
  display: flex;
  flex-direction: column;
  gap: 4px;
}
.upl-cat-crumb {
  font-size: 13px;
  font-weight: 500;
  color: #64748b;
  display: flex;
  align-items: center;
  gap: 6px;
}
.upl-cat-title {
  margin: 0;
  font-size: 24px;
  font-weight: 800;
  color: #0f172a;
  letter-spacing: -0.4px;
}

/* Stepper Bar */
.upl-stepper-wrap {
  display: flex;
  align-items: center;
  gap: 10px;
  width: 100%;
  overflow-x: auto;
  padding: 2px 1px 6px;
}
.upl-step-item {
  flex: 1;
  min-width: 190px;
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 10px 18px;
  background: #f1f5f9;
  border: 1px solid #e2e8f0;
  border-radius: 30px;
  color: #475569;
  font-size: 13.5px;
  font-weight: 600;
  position: relative;
  transition: all .2s ease;
}
.upl-step-item.active {
  background: #eff6ff;
  border: 1.5px solid #38bdf8;
  color: #0369a1;
  box-shadow: 0 0 0 2px rgba(56, 189, 248, 0.2);
}
.upl-step-num {
  width: 24px;
  height: 24px;
  border-radius: 50%;
  background: #cbd5e1;
  color: #ffffff;
  display: grid;
  place-items: center;
  font-size: 12px;
  font-weight: 700;
  flex-shrink: 0;
}
.upl-step-item.active .upl-step-num {
  background: #0284c7;
  color: #ffffff;
}
.upl-step-text {
  white-space: nowrap;
}
.upl-step-arrow {
  margin-left: auto;
  color: #94a3b8;
  display: inline-flex;
  align-items: center;
}

/* Toolbar: Search, Filter Tabs, Period Dropdown */
.upl-cat-toolbar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  flex-wrap: wrap;
  margin-top: 4px;
}
.upl-cat-left {
  display: flex;
  align-items: center;
  gap: 12px;
  flex-wrap: wrap;
  flex: 1;
}
.upl-cat-search-box {
  position: relative;
  width: 240px;
  min-width: 190px;
}
.upl-cat-search-icon {
  position: absolute;
  left: 11px;
  top: 50%;
  transform: translateY(-50%);
  color: #94a3b8;
  pointer-events: none;
}
.upl-cat-search-input {
  width: 100%;
  padding: 8px 12px 8px 34px;
  border: 1px solid #cbd5e1;
  border-radius: 8px;
  background: #ffffff;
  font: inherit;
  font-size: 13px;
  color: #1e293b;
  box-sizing: border-box;
  transition: border-color .15s, box-shadow .15s;
}
.upl-cat-search-input:focus {
  outline: none;
  border-color: #087066;
  box-shadow: 0 0 0 2px rgba(8, 112, 102, 0.15);
}

.upl-cat-tabs {
  display: flex;
  align-items: center;
  gap: 6px;
  flex-wrap: wrap;
}
.upl-cat-tab-btn {
  border: 1px solid transparent;
  background: transparent;
  color: #475569;
  padding: 7px 14px;
  border-radius: 8px;
  font: inherit;
  font-size: 13px;
  font-weight: 600;
  cursor: pointer;
  transition: all .15s ease;
}
.upl-cat-tab-btn:hover {
  background: #f1f5f9;
  color: #0f172a;
}
.upl-cat-tab-btn.active {
  background: #cbd5e1;
  border-color: #94a3b8;
  color: #0f172a;
  font-weight: 700;
}

.upl-cat-right {
  display: flex;
  align-items: center;
  gap: 10px;
}
.upl-cat-period-sel {
  border: 1px solid #cbd5e1;
  border-radius: 8px;
  background: #ffffff;
  padding: 7px 12px;
  font: inherit;
  font-size: 13px;
  font-weight: 600;
  color: #334155;
  cursor: pointer;
}

/* Cards Grid */
.upl-cat-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
}
@media (max-width: 1080px) {
  .upl-cat-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}
@media (max-width: 680px) {
  .upl-cat-grid {
    grid-template-columns: 1fr;
  }
}

.upl-task-card {
  background: #ffffff;
  border: 1px solid #e2e8f0;
  border-radius: 14px;
  padding: 20px 22px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  box-shadow: 0 1px 3px rgba(0,0,0,0.03);
  transition: transform .15s ease, box-shadow .15s ease;
}
.upl-task-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 18px rgba(0,0,0,0.06);
}

.upl-task-top {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 10px;
  margin-bottom: 14px;
}
.upl-task-titles {
  flex: 1;
}
.upl-task-title {
  margin: 0 0 3px;
  font-size: 16px;
  font-weight: 700;
  color: #0f172a;
  line-height: 1.35;
}
.upl-task-code {
  font-size: 12px;
  color: #64748b;
  font-weight: 500;
}

.upl-task-badge {
  font-size: 11px;
  font-weight: 700;
  padding: 3px 10px;
  border-radius: 999px;
  white-space: nowrap;
}
.upl-task-badge.revisi {
  background: #d97706;
  color: #ffffff;
}
.upl-task-badge.belum {
  background: #f1f5f9;
  color: #64748b;
}
.upl-task-badge.review {
  background: #dbeafe;
  color: #1d4ed8;
}
.upl-task-badge.selesai {
  background: #dcfce7;
  color: #15803d;
}

.upl-task-prog-sec {
  margin-bottom: 12px;
}
.upl-task-prog-labels {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 12.5px;
  font-weight: 600;
  color: #334155;
  margin-bottom: 6px;
}
.upl-task-prog-track {
  height: 7px;
  background: #e2e8f0;
  border-radius: 999px;
  overflow: hidden;
}
.upl-task-prog-fill {
  height: 100%;
  background: #087066;
  border-radius: 999px;
  transition: width .3s ease;
}

.upl-task-deadline {
  font-size: 12px;
  color: #64748b;
  margin-bottom: 16px;
}

.upl-task-btn {
  width: 100%;
  padding: 10px 16px;
  border-radius: 8px;
  border: none;
  font: inherit;
  font-size: 13.5px;
  font-weight: 600;
  cursor: pointer;
  background: #087066;
  color: #ffffff;
  transition: background .15s ease;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
}
.upl-task-btn:hover {
  background: #065951;
}
.upl-task-btn.selesai {
  background: #94a3b8;
  color: #ffffff;
}
.upl-task-btn.selesai:hover {
  background: #64748b;
}

.upl-task-rev-note {
  margin-top: 8px;
  font-size: 12px;
  color: #475569;
  line-height: 1.4;
  padding-left: 2px;
}

/* ========================================================
   UPLOAD EVIDEN (PIC) - DETAIL MODUL WORKSPACE STYLES
   ======================================================== */
.upl-container {
  display: flex;
  flex-direction: column;
  gap: 16px;
}

/* Secondary Toolbar: Breadcrumb + Search + View Switcher */
.upl-sub-bar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  flex-wrap: wrap;
  padding: 4px 2px;
}
.upl-breadcrumb {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 13.5px;
  font-weight: 600;
  color: var(--mut);
}
.upl-crumb-root {
  color: #0d9488;
  cursor: pointer;
  text-decoration: underline;
  text-underline-offset: 3px;
}
.upl-crumb-sep {
  color: #94a3b8;
  font-weight: 400;
}
.upl-crumb-curr {
  color: var(--dk);
  font-weight: 700;
}
.upl-modul-select {
  border: 1px solid var(--bd);
  border-radius: 8px;
  padding: 5px 10px;
  font: inherit;
  font-size: 13px;
  font-weight: 600;
  color: var(--dk);
  background: var(--card);
  cursor: pointer;
}

.upl-tools-right {
  display: flex;
  align-items: center;
  gap: 10px;
  flex-wrap: wrap;
}
.upl-search-wrap {
  position: relative;
  width: 250px;
}
.upl-search-input {
  width: 100%;
  padding: 7px 12px 7px 32px;
  border: 1px solid var(--bd);
  border-radius: 10px;
  background: var(--card);
  font: inherit;
  font-size: 12.5px;
  color: var(--tx);
  transition: border-color .15s, box-shadow .15s;
}
.upl-search-input:focus {
  outline: none;
  border-color: var(--pri);
  box-shadow: 0 0 0 2px var(--pri2);
}
.upl-search-icon {
  position: absolute;
  left: 10px;
  top: 50%;
  transform: translateY(-50%);
  color: var(--mut);
  pointer-events: none;
}
.upl-view-tabs {
  display: flex;
  background: color-mix(in srgb, var(--card) 80%, transparent);
  border: 1px solid var(--bd);
  border-radius: 10px;
  padding: 3px;
  gap: 2px;
}
.upl-view-btn {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  border: 0;
  background: none;
  color: var(--mut);
  padding: 5px 12px;
  border-radius: 8px;
  font: inherit;
  font-size: 12.5px;
  font-weight: 600;
  cursor: pointer;
  transition: .15s ease;
}
.upl-view-btn:hover {
  color: var(--pri);
}
.upl-view-btn.on {
  background: var(--card);
  color: var(--pri);
  box-shadow: 0 2px 6px rgba(0,0,0,.06);
}

/* Hero Progress Card */
.upl-hero-card {
  background: color-mix(in srgb, var(--card) 90%, transparent);
  backdrop-filter: blur(20px) saturate(150%);
  border: 1px solid color-mix(in srgb, var(--card) 45%, #fff);
  border-radius: 18px;
  box-shadow: 0 6px 24px rgba(31,60,110,0.06);
  padding: 20px 22px;
  display: flex;
  flex-direction: column;
  gap: 14px;
}
.upl-hero-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  flex-wrap: wrap;
}
.upl-hero-title {
  margin: 0;
  font-size: 18px;
  font-weight: 800;
  color: var(--dk);
  letter-spacing: -.3px;
}
.upl-badge-status {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 4px 12px;
  border-radius: 9999px;
  font-size: 12px;
  font-weight: 600;
}
.upl-badge-status.bebas {
  background: #dcfce7;
  color: #166534;
}
.upl-badge-status.kunci {
  background: #f1f5f9;
  color: #475569;
}
.upl-pulse-dot {
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #16a34a;
}
.upl-badge-status.kunci .upl-pulse-dot {
  background: #64748b;
}

.upl-hero-sub {
  font-size: 13px;
  color: var(--mut);
  margin-top: -6px;
}
.upl-progress-track {
  height: 9px;
  border-radius: 9999px;
  background: #e2e8f0;
  overflow: hidden;
  position: relative;
}
.upl-progress-fill {
  height: 100%;
  border-radius: 9999px;
  background: linear-gradient(90deg, #f87171, #ef4444);
  transition: width .4s cubic-bezier(.4,0,.2,1);
}
.upl-progress-fill.done {
  background: linear-gradient(90deg, #10b981, #0d9488);
}

.upl-missing-row {
  display: flex;
  align-items: center;
  gap: 8px;
  flex-wrap: wrap;
  font-size: 12.5px;
}
.upl-missing-label {
  color: var(--mut);
  font-weight: 500;
}
.upl-missing-chip {
  background: #fee2e2;
  color: #991b1b;
  padding: 3px 10px;
  border-radius: 9999px;
  font-size: 11.5px;
  font-weight: 600;
  cursor: pointer;
  transition: .15s ease;
}
.upl-missing-chip:hover {
  background: #fecaca;
  transform: translateY(-1px);
}
.upl-all-done-chip {
  background: #dcfce7;
  color: #166534;
  padding: 3px 10px;
  border-radius: 9999px;
  font-size: 11.5px;
  font-weight: 600;
}

.upl-notice-banner {
  background: #ecfdf5;
  border: 1px solid #a7f3d0;
  border-radius: 12px;
  padding: 11px 16px;
  font-size: 12.5px;
  color: #065f46;
  font-weight: 500;
  line-height: 1.45;
}

.upl-template-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  padding-top: 4px;
  font-size: 13px;
  color: var(--tx);
  flex-wrap: wrap;
}
.upl-template-info {
  display: inline-flex;
  align-items: center;
  gap: 8px;
}
.upl-btn-unduh {
  background: #fff;
  color: #0d9488;
  border: 1px solid #0d9488;
  border-radius: 9999px;
  padding: 5px 16px;
  font: inherit;
  font-size: 12px;
  font-weight: 700;
  cursor: pointer;
  transition: .15s ease;
  display: inline-flex;
  align-items: center;
  gap: 6px;
}
.upl-btn-unduh:hover {
  background: #f0fdfa;
  transform: translateY(-1px);
}

/* 4-Column Indicator Grid (Folder View) */
.upl-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 16px;
}
@media (max-width: 1200px) {
  .upl-grid { grid-template-columns: repeat(3, 1fr); }
}
@media (max-width: 900px) {
  .upl-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 600px) {
  .upl-grid { grid-template-columns: 1fr; }
}

.upl-card {
  background: color-mix(in srgb, var(--card) 95%, transparent);
  backdrop-filter: blur(16px);
  border: 1px solid color-mix(in srgb, var(--card) 45%, #fff);
  border-radius: 16px;
  padding: 16px;
  display: flex;
  flex-direction: column;
  gap: 12px;
  box-shadow: 0 4px 18px rgba(31,60,110,0.04);
  transition: transform .18s ease, box-shadow .18s ease;
}
.upl-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 24px rgba(31,60,110,0.08);
}
.upl-card-header {
  font-size: 13.5px;
  font-weight: 700;
  color: var(--dk);
  line-height: 1.35;
  min-height: 20px;
}

.upl-file-area {
  min-height: 72px;
  display: flex;
  align-items: center;
}
.upl-empty-box {
  width: 100%;
  height: 68px;
  border: 1.5px dashed #cbd5e1;
  background: #f8fafc;
  border-radius: 12px;
  display: grid;
  place-items: center;
  color: #94a3b8;
  font-size: 12.5px;
  font-weight: 500;
}
.upl-file-box {
  width: 100%;
  min-height: 68px;
  background: #f8fafc;
  border: 1px solid #e2e8f0;
  border-radius: 12px;
  padding: 10px 12px;
  display: flex;
  align-items: flex-start;
  gap: 10px;
}
.upl-file-icon {
  flex-shrink: 0;
  margin-top: 2px;
}
.upl-file-meta {
  flex: 1;
  min-width: 0;
  display: flex;
  flex-direction: column;
  gap: 3px;
}
.upl-file-name {
  font-size: 12.5px;
  font-weight: 700;
  color: var(--dk);
  text-decoration: none;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  display: block;
}
.upl-file-name:hover {
  color: var(--pri);
  text-decoration: underline;
}
.upl-file-sub {
  font-size: 11px;
  color: var(--mut);
  line-height: 1.25;
}

.upl-finding-box {
  background: #fee2e2;
  color: #991b1b;
  border-left: 3px solid #dc2626;
  border-radius: 6px;
  padding: 6px 10px;
  font-size: 11.5px;
  line-height: 1.35;
}

.upl-status-row {
  display: flex;
  flex-direction: column;
  gap: 6px;
  margin-top: auto;
}
.upl-status-tag {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-size: 11.5px;
  font-weight: 600;
  width: fit-content;
  padding: 3px 8px;
  border-radius: 9999px;
}
.upl-st-empty {
  background: #f1f5f9;
  color: #64748b;
}
.upl-st-revisi {
  background: #fee2e2;
  color: #991b1b;
}
.upl-st-wait {
  background: #e0f2fe;
  color: #0369a1;
}
.upl-st-done {
  background: #dcfce7;
  color: #166534;
}
.upl-dot {
  width: 6px;
  height: 6px;
  border-radius: 50%;
  display: inline-block;
}
.upl-st-empty .upl-dot { background: #94a3b8; }
.upl-st-revisi .upl-dot { background: #dc2626; }
.upl-st-wait .upl-dot { background: #0284c7; }
.upl-st-done .upl-dot { background: #16a34a; }

.upl-mini-prog {
  height: 4px;
  border-radius: 9999px;
  background: #e2e8f0;
  overflow: hidden;
}
.upl-mini-fill {
  height: 100%;
  border-radius: 9999px;
}
.upl-mini-fill.red {
  background: #ef4444;
}
.upl-mini-fill.teal {
  background: #0d9488;
}
.upl-mini-fill.gray {
  background: #cbd5e1;
}

.upl-card-actions {
  display: flex;
  align-items: center;
  gap: 8px;
  padding-top: 4px;
}
.upl-btn-action {
  border-radius: 8px;
  padding: 6px 14px;
  font: inherit;
  font-size: 12px;
  font-weight: 700;
  cursor: pointer;
  transition: .15s ease;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  border: 1px solid transparent;
}
.upl-btn-unggah {
  background: #fff;
  border-color: #0d9488;
  color: #0d9488;
}
.upl-btn-unggah:hover {
  background: #f0fdfa;
}
.upl-btn-tindaklanjut {
  background: #0d9488;
  color: #fff;
}
.upl-btn-tindaklanjut:hover {
  filter: brightness(1.1);
}
.upl-actions-split {
  display: flex;
  align-items: center;
  gap: 12px;
}
.upl-btn-ganti {
  background: #fff;
  border-color: #0d9488;
  color: #0d9488;
}
.upl-btn-ganti:hover {
  background: #f0fdfa;
}
.upl-btn-hapus {
  background: none;
  border: 0;
  color: #ef4444;
  padding: 6px 4px;
}
.upl-btn-hapus:hover {
  text-decoration: underline;
}

/* Type Switcher Tab (File vs Link GDrive) */
.upl-type-switcher {
  display: flex;
  background: #f1f5f9;
  border-radius: 12px;
  padding: 4px;
  gap: 4px;
  margin-bottom: 16px;
  border: 1px solid var(--bd);
}
.upl-type-tab {
  flex: 1;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  padding: 9px 12px;
  border: 0;
  background: transparent;
  border-radius: 9px;
  font: inherit;
  font-size: 13px;
  font-weight: 600;
  color: var(--mut);
  cursor: pointer;
  transition: all .2s ease;
}
.upl-type-tab:hover {
  color: var(--dk);
}
.upl-type-tab.on {
  background: #fff;
  color: #0d9488;
  font-weight: 700;
  box-shadow: 0 2px 8px rgba(0,0,0,.08);
}
.upl-tab-badge {
  background: #0d9488;
  color: #fff;
  font-size: 10px;
  padding: 1px 6px;
  border-radius: 20px;
  font-weight: 700;
  letter-spacing: .3px;
}
.upl-link-input {
  width: 100%;
  padding: 10px 14px;
  border: 1px solid var(--bd);
  border-radius: 10px;
  background: #fff;
  font: inherit;
  font-size: 13px;
  color: var(--tx);
  transition: border-color .15s, box-shadow .15s;
  box-sizing: border-box;
}
.upl-link-input:focus {
  outline: none;
  border-color: #0d9488;
  box-shadow: 0 0 0 3px rgba(13,148,136,.12);
}
.upl-btn-test-link {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  background: #f0fdfa;
  border: 1px solid #99f6e4;
  color: #0d9488;
  padding: 4px 10px;
  border-radius: 8px;
  font: inherit;
  font-size: 11.5px;
  font-weight: 600;
  cursor: pointer;
  text-decoration: none;
  transition: .15s;
}
.upl-btn-test-link:hover {
  background: #ccfbf1;
  border-color: #0d9488;
}
.upl-link-tip {
  background: #f8fafc;
  border: 1px solid #e2e8f0;
  border-left: 3px solid #0d9488;
  border-radius: 10px;
  padding: 10px 14px;
}
.upl-file-box.is-link {
  border-color: rgba(13,148,136,.25);
  background: linear-gradient(135deg, rgba(13,148,136,.04), transparent);
}

/* ========================================================
   DYNAMIC TAGIHAN / INDIKATOR INPUT TYPES (SRS v1.0)
   ======================================================== */
.ind-type-badge {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  padding: 3px 7px;
  border-radius: 6px;
  font-size: 10.5px;
  font-weight: 700;
  letter-spacing: .2px;
  white-space: nowrap;
}
.ind-type-badge.file {
  background: #e0f2fe;
  color: #0369a1;
  border: 1px solid #bae6fd;
}
.ind-type-badge.numeric {
  background: #f0fdf4;
  color: #15803d;
  border: 1px solid #bbf7d0;
}
.ind-type-badge.binary_score {
  background: #f5f3ff;
  color: #6d28d9;
  border: 1px solid #ddd6fe;
}
.ind-type-badge.pbj_matrix {
  background: #fffbeb;
  color: #b45309;
  border: 1px solid #fde68a;
}
.ind-type-badge.risk_scale {
  background: #fef2f2;
  color: #b91c1c;
  border: 1px solid #fecaca;
}

/* KKR Threshold Calculation Banner */
.upl-kkr-banner {
  border-radius: 14px;
  padding: 14px 18px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  flex-wrap: wrap;
  box-shadow: 0 3px 12px rgba(0,0,0,0.03);
  transition: all .2s ease;
}
.upl-kkr-banner.pass {
  background: linear-gradient(135deg, #f0fdf4, #dcfce7);
  border: 1.5px solid #86efac;
}
.upl-kkr-banner.fail {
  background: linear-gradient(135deg, #fffbeb, #fef3c7);
  border: 1.5px solid #fde047;
}

/* Structured Value Preview Box in Cards */
.upl-structured-box {
  width: 100%;
  border-radius: 12px;
  padding: 10px 14px;
  background: #ffffff;
  border: 1px solid var(--bd);
  display: flex;
  flex-direction: column;
  gap: 6px;
  box-shadow: 0 1px 4px rgba(0,0,0,0.02);
}
.upl-structured-box.is-numeric {
  border-left: 3.5px solid #10b981;
}
.upl-structured-box.is-binary {
  border-left: 3.5px solid #8b5cf6;
}
.upl-structured-box.is-pbj {
  border-left: 3.5px solid #f59e0b;
}
.upl-structured-box.is-risk {
  border-left: 3.5px solid #ef4444;
}

/* Interactive Radio Cards for Binary Score */
.upl-choice-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 10px;
  margin: 10px 0;
}
.upl-choice-card {
  border: 1.5px solid var(--bd);
  background: #f8fafc;
  border-radius: 12px;
  padding: 12px 14px;
  display: flex;
  align-items: center;
  gap: 10px;
  cursor: pointer;
  transition: all .15s ease;
}
.upl-choice-card:hover {
  background: #f1f5f9;
}
.upl-choice-card.selected-yes {
  border-color: #10b981;
  background: #ecfdf5;
  box-shadow: 0 0 0 2px rgba(16,185,129,.15);
}
.upl-choice-card.selected-no {
  border-color: #ef4444;
  background: #fef2f2;
  box-shadow: 0 0 0 2px rgba(239,68,68,.15);
}

/* 4 Tepat PBJ Matrix Items */
.upl-pbj-grid {
  display: flex;
  flex-direction: column;
  gap: 8px;
  margin: 10px 0;
}
.upl-pbj-item {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 10px 12px;
  border-radius: 10px;
  background: #f8fafc;
  border: 1px solid var(--bd);
  gap: 10px;
}
.upl-pbj-item.active {
  background: #fffbeb;
  border-color: #fde68a;
}

/* Risk Heat Matrix Level Box */
.upl-risk-meter {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 12px;
  background: #f8fafc;
  border: 1px solid var(--bd);
  border-radius: 12px;
  padding: 12px 14px;
  margin: 10px 0;
}
.upl-risk-score-badge {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
  padding: 6px 14px;
  border-radius: 10px;
  font-weight: 800;
  font-size: 13.5px;
}

/* ========================================================
   APPROVAL KETUA SKI - REDESIGN SYSTEM STYLES
   ======================================================== */
.apr-container {
  display: flex;
  flex-direction: column;
  gap: 16px;
}

/* Hero Card: Approval per Modul */
.apr-hero-card {
  background: #e2f7f4;
  border: 1px solid rgba(13,148,136,.18);
  border-radius: 16px;
  padding: 20px 22px;
  box-shadow: 0 4px 18px rgba(10,95,87,0.04);
  display: flex;
  flex-direction: column;
  gap: 10px;
}
.apr-hero-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
}
.apr-hero-title {
  margin: 0;
  font-size: 17px;
  font-weight: 800;
  color: var(--dk);
  letter-spacing: -.3px;
}
.apr-modul-badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 4px 12px;
  border-radius: 9999px;
  background: #ecfdf5;
  color: #065f46;
  font-size: 12px;
  font-weight: 700;
}
.apr-hero-desc {
  font-size: 13px;
  color: var(--mut);
  margin: 0 0 6px;
  line-height: 1.45;
}
.apr-btn-bulk-approve {
  background: #0d9488;
  color: #fff;
  border: 0;
  border-radius: 8px;
  padding: 8px 18px;
  font: inherit;
  font-size: 13px;
  font-weight: 700;
  cursor: pointer;
  transition: all .15s ease;
  width: fit-content;
  box-shadow: 0 2px 6px rgba(13,148,136,0.25);
}
.apr-btn-bulk-approve:hover:not(:disabled) {
  filter: brightness(1.1);
  transform: translateY(-1px);
}
.apr-btn-bulk-approve:disabled {
  opacity: .5;
  cursor: not-allowed;
  box-shadow: none;
}

/* Modul Group Cards */
.apr-modul-card {
  background: #ffffff;
  border: 1px solid rgba(13,148,136,.14);
  border-radius: 16px;
  padding: 18px 20px;
  box-shadow: 0 4px 16px rgba(10,95,87,0.03);
  display: flex;
  flex-direction: column;
  gap: 14px;
}
.apr-modul-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  flex-wrap: wrap;
}
.apr-modul-title {
  margin: 0;
  font-size: 15.5px;
  font-weight: 700;
  color: var(--dk);
}
.apr-tags-wrap {
  display: flex;
  align-items: center;
  gap: 8px;
  flex-wrap: wrap;
}
.apr-tag {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 3px 10px;
  border-radius: 9999px;
  font-size: 11.5px;
  font-weight: 600;
}
.apr-tag-none {
  background: #dcfce7;
  color: #166534;
}
.apr-tag-disetujui {
  background: #fce7f3;
  color: #9d174d;
}
.apr-tag-rekom {
  background: #ccfbf1;
  color: #0f766e;
}
.apr-tag-pending {
  background: #ede9fe;
  color: #6d28d9;
}
.apr-tag-sesuai {
  background: #dcfce7;
  color: #166534;
}
.apr-dot {
  width: 6px;
  height: 6px;
  border-radius: 50%;
  display: inline-block;
}
.apr-dot.green { background: #16a34a; }
.apr-dot.pink { background: #db2777; }
.apr-dot.teal { background: #0d9488; }
.apr-dot.purple { background: #7c3aed; }

/* In-Card Toolbar */
.apr-card-toolbar {
  display: flex;
  align-items: center;
  gap: 8px;
}
.apr-btn-tool {
  border-radius: 8px;
  padding: 5px 14px;
  font: inherit;
  font-size: 12px;
  font-weight: 700;
  cursor: pointer;
  transition: all .15s ease;
}
.apr-btn-pilih-semua {
  background: #fff;
  border: 1px solid #0d9488;
  color: #0d9488;
}
.apr-btn-pilih-semua:hover {
  background: #f0fdfa;
}
.apr-btn-setujui-semua {
  background: #0d9488;
  color: #fff;
  border: 0;
  box-shadow: 0 2px 6px rgba(13,148,136,0.2);
}
.apr-btn-setujui-semua:hover {
  filter: brightness(1.1);
}

/* Modul Table */
.apr-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 4px;
}
.apr-table th {
  text-align: left;
  font-size: 11px;
  font-weight: 700;
  color: #64748b;
  text-transform: uppercase;
  letter-spacing: .04em;
  padding: 10px 12px;
  border-bottom: 1px solid var(--bd);
  background: none;
}
.apr-table td {
  padding: 12px;
  border-bottom: 1px solid var(--bd);
  font-size: 13px;
  vertical-align: middle;
}
.apr-table tr:last-child td {
  border-bottom: 0;
}
.apr-file-link {
  color: var(--tx);
  text-decoration: none;
  font-weight: 600;
  display: inline-flex;
  align-items: center;
  gap: 6px;
}
.apr-file-link:hover {
  color: var(--pri);
  text-decoration: underline;
}
.apr-btn-action {
  border-radius: 6px;
  padding: 5px 12px;
  font: inherit;
  font-size: 12px;
  font-weight: 700;
  cursor: pointer;
  transition: all .15s ease;
}
.apr-btn-setujui {
  background: #0d9488;
  color: #fff;
  border: 0;
}
.apr-btn-setujui:hover {
  filter: brightness(1.1);
}
.apr-btn-kembalikan {
  background: #fff;
  border: 1px solid #0d9488;
  color: #0d9488;
  margin-left: 6px;
}
.apr-btn-kembalikan:hover {
  background: #f0fdfa;
}

/* REVIEW & CROSS-CHECK REDESIGN (ANGGOTA SKI) */
.rev-hero {
  background: #ffffff;
  border: 1px solid rgba(13,148,136,.14);
  border-radius: 16px;
  padding: 18px 22px;
  box-shadow: 0 4px 16px rgba(10,95,87,.03);
  margin-bottom: 14px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 16px;
  flex-wrap: wrap;
}
.rev-hero-left {
  max-width: 620px;
}
.rev-hero-title {
  margin: 0 0 4px;
  font-size: 18px;
  font-weight: 800;
  color: var(--dk);
  letter-spacing: -.3px;
  display: flex;
  align-items: center;
  gap: 8px;
}
.rev-hero-desc {
  margin: 0;
  font-size: 13px;
  color: var(--mut);
  line-height: 1.45;
}
.rev-stats-bar {
  display: flex;
  gap: 8px;
  align-items: center;
  flex-wrap: wrap;
}
.rev-stat-pill {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 6px 14px;
  border-radius: 9999px;
  font-size: 12px;
  font-weight: 700;
}
.rev-stat-pill.active {
  background: #ede9fe;
  color: #6d28d9;
}
.rev-stat-pill.success {
  background: #ecfdf5;
  color: #065f46;
}
.rev-stat-pill.warning {
  background: #fef2f2;
  color: #991b1b;
}

.rev-guide-box {
  background: #f0fdfa;
  border: 1px solid #ccfbf1;
  border-left: 4px solid #0d9488;
  border-radius: 12px;
  padding: 12px 18px;
  margin-bottom: 14px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  flex-wrap: wrap;
}
.rev-guide-text {
  font-size: 12.5px;
  color: #0f766e;
  line-height: 1.45;
}
.rev-guide-text b {
  color: #075e57;
}

.rev-toolbar {
  background: #ffffff;
  border: 1px solid rgba(13,148,136,.14);
  border-radius: 14px;
  padding: 12px 16px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  flex-wrap: wrap;
  margin-bottom: 14px;
  box-shadow: 0 2px 8px rgba(10,95,87,.02);
}
.rev-search-box {
  display: flex;
  align-items: center;
  gap: 8px;
  background: #f8fafc;
  border: 1px solid var(--bd);
  border-radius: 10px;
  padding: 6px 12px;
  flex: 1;
  min-width: 240px;
  max-width: 380px;
}
.rev-search-box input {
  border: 0;
  outline: 0;
  background: transparent;
  font: inherit;
  font-size: 13px;
  width: 100%;
}
.rev-filter-group {
  display: flex;
  align-items: center;
  gap: 8px;
  flex-wrap: wrap;
}
.rev-tabs {
  display: flex;
  gap: 4px;
  background: #f1f5f9;
  padding: 3px;
  border-radius: 10px;
}
.rev-tab-btn {
  border: 0;
  background: none;
  font: inherit;
  font-size: 12px;
  font-weight: 600;
  color: #64748b;
  padding: 6px 13px;
  border-radius: 8px;
  cursor: pointer;
  transition: all .15s ease;
}
.rev-tab-btn.on {
  background: #ffffff;
  color: #0d9488;
  font-weight: 700;
  box-shadow: 0 2px 6px rgba(0,0,0,.06);
}
.rev-select {
  border: 1px solid var(--bd);
  border-radius: 10px;
  padding: 7px 12px;
  font: inherit;
  font-size: 12.5px;
  background: #fff;
  color: var(--tx);
  outline: 0;
}
.rev-btn-bulk {
  background: #0d9488;
  color: #fff;
  border: 0;
  border-radius: 8px;
  padding: 7px 15px;
  font: inherit;
  font-size: 12.5px;
  font-weight: 700;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  transition: all .15s ease;
}
.rev-btn-bulk:hover:not(:disabled) {
  filter: brightness(1.1);
}
.rev-btn-bulk:disabled {
  opacity: .5;
  cursor: not-allowed;
}

.rev-table-card {
  background: #ffffff;
  border: 1px solid rgba(13,148,136,.14);
  border-radius: 16px;
  box-shadow: 0 4px 16px rgba(10,95,87,.03);
  overflow: hidden;
}
.rev-table {
  width: 100%;
  border-collapse: collapse;
}
.rev-table th {
  text-align: left;
  font-size: 11px;
  font-weight: 700;
  color: #64748b;
  text-transform: uppercase;
  letter-spacing: .04em;
  padding: 12px 16px;
  background: #f8fafc;
  border-bottom: 1px solid var(--bd);
}
.rev-table td {
  padding: 14px 16px;
  border-bottom: 1px solid var(--bd);
  font-size: 13px;
  vertical-align: middle;
}
.rev-table tr:last-child td {
  border-bottom: 0;
}
.rev-table tr:hover td {
  background: rgba(240,253,250,.35);
}
.rev-file-link {
  color: var(--tx);
  text-decoration: none;
  font-weight: 600;
  display: inline-flex;
  align-items: center;
  gap: 6px;
}
.rev-file-link:hover {
  color: var(--pri);
  text-decoration: underline;
}
.rev-actions-wrap {
  display: flex;
  align-items: center;
  gap: 6px;
  flex-wrap: wrap;
}
.rev-btn-eval {
  background: #0d9488;
  color: #fff;
  border: 0;
  border-radius: 8px;
  padding: 6px 14px;
  font: inherit;
  font-size: 12px;
  font-weight: 700;
  cursor: pointer;
  transition: all .15s ease;
  display: inline-flex;
  align-items: center;
  gap: 5px;
}
.rev-btn-eval:hover {
  filter: brightness(1.1);
  transform: translateY(-1px);
}
.rev-btn-quick-ok {
  background: #dcfce7;
  color: #166534;
  border: 1px solid #bbf7d0;
  border-radius: 8px;
  padding: 6px 11px;
  font: inherit;
  font-size: 12px;
  font-weight: 700;
  cursor: pointer;
  transition: all .15s ease;
}
.rev-btn-quick-ok:hover {
  background: #bbf7d0;
}

.rev-choice-card {
  border: 2px solid var(--bd);
  border-radius: 12px;
  padding: 12px 16px;
  cursor: pointer;
  display: flex;
  align-items: flex-start;
  gap: 12px;
  transition: all .15s ease;
  margin-bottom: 10px;
}
.rev-choice-card.selected-ok {
  border-color: #16a34a;
  background: #f0fdf4;
}
.rev-choice-card.selected-no {
  border-color: #dc2626;
  background: #fef2f2;
}
</style>
</head>
<body>

<div id="toast" class="toast" role="status"></div>

<!-- UNIVERSAL CARD POPUP / MODAL -->
<div id="modalContainer" class="modal-backdrop" role="dialog" aria-modal="true">
  <div class="modal-card" id="modalCard">
    <div class="modal-header">
      <h3 id="modalTitle">Judul Popup</h3>
      <button class="modal-close" id="modalClose" aria-label="Tutup Popup">&times;</button>
    </div>
    <div class="modal-body" id="modalBody">
      Konten popup...
    </div>
    <div class="modal-footer" id="modalFooter">
      <button class="btn o sm" id="modalBtnCancel">Tutup</button>
      <button class="btn sm" id="modalBtnOk">Simpan</button>
    </div>
  </div>
</div>

<!-- 1. LOGIN SCREEN -->
<div id="loginView" class="lv" style="<?= $isAuth ? 'display:none;' : '' ?>">
  <div class="lb">
    <div class="lgr">
      <div class="lgring">BBPK</div>
      <div><b style="font-size:20px">BBPK Jakarta</b><br><span style="opacity:.85">Balai Besar Pelatihan Kesehatan</span></div>
    </div>
    <h2>MONEV SKI</h2>
    <div class="ul"></div>
    <p>Monitoring kepatuhan internal BBPK Jakarta.</p>
    <div style="height:1px;background:rgba(255,255,255,.25);max-width:520px;margin:18px 0 14px"></div>
    <small style="opacity:.85">Sekretariat Jenderal, Kementerian Kesehatan RI · (021) 7657625</small>
  </div>
  <div class="lf">
    <div class="card">
      <h1 style="font-size:28px;margin-bottom:4px;color:var(--dk)">Masuk Sistem</h1>
      <p style="color:var(--mut);margin:0 0 18px">Masuk dengan akun BBPK Jakarta.</p>
      
      <label style="font-size:12px;color:var(--mut);font-weight:600">Username / NIP</label>
      <div class="inp">
        <svg class="ei" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/></svg>
        <input id="lu" placeholder="Username atau NIP">
      </div>
      
      <label style="font-size:12px;color:var(--mut);font-weight:600">Kata Sandi</label>
      <div class="inp">
        <svg class="ei" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="4" y="11" width="16" height="10" rx="2"/><path d="M8 11V7a4 4 0 0 1 8 0v4"/></svg>
        <input id="lp" type="password" placeholder="••••••••">
        <button type="button" class="eyeb" id="eye" aria-label="Lihat kata sandi"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg></button>
      </div>

      <label style="font-size:12px;color:var(--mut);font-weight:600">Peran Demo</label>
      <div class="inp">
        <svg class="ei" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>
        <select id="lr">
          <option value="">-- Gunakan Akun Manual di Atas --</option>
          <optgroup label="PIC Unit Kerja">
            <option value="pic-keu">PIC Keuangan </option>
            <option value="pic-peg">PIC Kepegawaian </option>
            <option value="pic-ren">PIC Perencanaan</option>
          </optgroup>
          <optgroup label="Tim SKI &amp; Pimpinan">
            <option value="ang" selected>Anggota SKI</option>
            <option value="ket">Ketua SKI</option>
            <option value="pim">Kepala BBPK (Pimpinan)</option>
            <option value="itj">Auditor Itjen Kemenkes</option>
          </optgroup>
          <optgroup label="Administrator">
            <option value="adm">Administrator Sistem</option>
          </optgroup>
        </select>
      </div>
      
      <button type="button" class="btn-google" id="btnGoogleMasuk">
        <svg width="18" height="18" viewBox="0 0 48 48">
          <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
          <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
          <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/>
          <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
          <path fill="none" d="M0 0h48v48H0z"/>
        </svg>
        <span>Lanjutkan dengan Google</span>
      </button>

      <button class="btn" id="btnMasuk" style="width:100%;padding:13px;font-size:15px;border-radius:12px">Masuk ke Sistem</button>
      
      <div style="height:1px;background:var(--bd);margin:16px 0 12px"></div>
      <p style="font-size:12px;color:var(--mut);margin:0">Bantuan: <a href="https://portal.bbpkjakarta.or.id" target="_blank" rel="noopener" style="color:var(--pri)">Portal BBPK</a></p>
    </div>
  </div>
</div>

<!-- 2. MAIN APPLICATION -->
<div id="appView" style="<?= $isAuth ? '' : 'display:none;' ?>">
  <div class="ov" id="ov"></div>
  <div class="app">
    <aside class="side" id="sidebar">
      <button class="tg" id="sbt" aria-label="Toggle Menu"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="m15 18-6-6 6-6"/></svg></button>
      <div class="rail">
        <div class="rl" title="Kementerian Kesehatan RI">
          <img src="assets/images/logo-kemenkes.webp" alt="Kemenkes" onerror="this.onerror=null;this.src='assets/images/logo-kemenkes-icon.svg';">
        </div>
        <button class="rb on" data-g="dash" title="Dashboard">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
        </button>
        <button class="rb" data-g="awas" title="Tahap Pengawasan">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></svg>
        </button>
        <button class="rb" data-g="verif" title="Verifikasi &amp; Approval">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>
        </button>
        <button class="rb" data-g="lap" title="Pelaporan">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
        </button>
        <button class="rb" data-g="sis" title="Pengaturan Sistem">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
        </button>
      </div>
      <div class="panel">
        <div class="plogo">
          <img src="assets/images/logo-kemenkes-bbpk.png" alt="Kemenkes BBPK Jakarta" onerror="this.onerror=null;this.src='assets/images/logo-kemenkes-bbpk.svg';">
          <button class="modal-close mobile-drawer-close" id="mdc" aria-label="Tutup Menu" style="margin-left:auto;display:none;font-size:22px">&times;</button>
        </div>
        <div class="pg on" data-g="dash">
          <button class="nav on" data-s="dash">Dashboard</button>
        </div>
        <div class="pg" data-g="awas">
          <button class="nav" data-s="mod" style="display:none">Master Modul &amp; Template</button>
          <button class="nav" data-s="jdw" style="display:none">Jadwal &amp; Periode</button>
          <button class="nav" data-s="upl" style="display:none">Upload Eviden</button>
          <button class="nav" data-s="mon" style="display:none">Monitoring Upload</button>
          <button class="nav" data-s="rep" style="display:none">Repositori Eviden</button>
        </div>
        <div class="pg" data-g="verif">
          <button class="nav" data-s="rev" style="display:none">Review &amp; Cross-check</button>
          <button class="nav" data-s="apr" style="display:none">Approval Ketua SKI</button>
          <button class="nav" data-s="apm" style="display:none">Approval Pimpinan <span class="badge" id="bdg" hidden>0</span></button>
        </div>
        <div class="pg" data-g="lap">
          <button class="nav" data-s="exp" style="display:none">Ekspor Laporan</button>
        </div>
        <div class="pg" data-g="sis">
          <button class="nav" data-s="aud" style="display:none">Audit Trail</button>
          <button class="nav" data-s="usr" style="display:none">Pengguna &amp; Peran</button>
          <button class="nav" data-s="hak" style="display:none">Hak Akses</button>
        </div>
      </div>
    </aside>

    <div class="mw">
      <header class="hd">
        <button class="mbt" id="mbt"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 7h16M4 12h16M4 17h16"/></svg></button>
        <div class="hd-brand">Monev SKI<small>Satuan Kepatuhan Internal · BBPK Jakarta</small></div>
        <div class="ua">
          <a class="hl" href="https://portal.bbpkjakarta.or.id" target="_blank" rel="noopener">Portal BBPK <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 17 17 7M8 7h9v9"/></svg></a>
          <span class="usr" id="btnUserAccount" title="Klik untuk membuka Profil Akun Saya" onclick="showScreen('prof')">
            <i id="uav"><?= $isAuth ? strtoupper(substr($user['nama'], 0, 2)) : 'AK' ?></i>
            <span class="un"><b id="unm"><?= $isAuth ? htmlspecialchars($user['nama']) : '' ?></b><small id="urn"><?= $isAuth ? htmlspecialchars($user['nama_role']) : '' ?></small></span>
          </span>
          <a href="logout.php" class="btn lo" style="text-decoration:none"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/></svg><span>Keluar</span></a>
        </div>
      </header>

      <main class="main">
        <!-- HERO & ACTION GUIDANCE BAR -->
        <div class="hero">
          <div>
            <p id="gr">Monitoring Kepatuhan Internal</p>
            <h1 id="ttl">
              <span>Dashboard</span>
            </h1>
          </div>
          <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap">
            <button class="btn o sm" id="btnPageGuide" title="Buka petunjuk alur kerja halaman ini" style="background:#fff;border-color:var(--pri);font-weight:700">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
              <span>Petunjuk</span>
            </button>
            <select class="dash-period-select" id="dashPeriodSelect" aria-label="Pilih Periode Pengawasan">
              <option>Oktober 2026 · Bulanan</option>
              <option>Triwulan IV 2026</option>
              <option>Semester II 2026</option>
            </select>
          </div>
        </div>


        <!-- SCREEN SECTIONS -->
        <section class="scr on" id="dash"><div id="dashC"></div></section>
        <section class="scr" id="mod"><div id="modRoot"></div><input type="file" id="finModTemplate" hidden accept=".xlsx,.xls,.docx,.doc,.pdf,.csv,.zip,.pptx"></section>
        <section class="scr" id="jdw"><div class="card" id="jdwC"></div></section>
        <section class="scr" id="upl"><div id="uplC"></div><input type="file" id="fin" hidden accept=".pdf,.xlsx,.xls,.docx,.doc"></section>
        <section class="scr" id="mon"><div class="card" id="monC"></div></section>
        <section class="scr" id="rep"><div class="card" id="repC"></div></section>
        <section class="scr" id="rev"><div id="revC"></div></section>
        <section class="scr" id="apr"><div id="aprC"></div></section>
        <section class="scr" id="apm"><div class="card" id="apmL" style="width:100%"></div></section>
        <section class="scr" id="exp"><div class="card" id="expC"></div></section>
        <section class="scr" id="aud"><div class="card" id="audC"></div></section>
        <section class="scr" id="usr"><div id="usrC"></div></section>
        <section class="scr" id="hak"><div id="hakC"></div></section>
        <section class="scr" id="prof"><div id="profC"></div></section>
      </main>
    </div>
  </div>
</div>

<script>
(function(){
  "use strict";

  var STATE = {
    user: null, perms: {}, moduls: [], indikators: [], evidens: [],
    rekomendasi: [], audit: [], users: [], units: [], roles: [],
    rolePermissions: {}
  };

  var ACTIVE_SCREEN = 'dash';
  var currentModulId = null;
  var currentUploadInd = null;
  var currentUploadJadwal = null;
  var modSearchQuery = '';
  var modStatusFilter = 'all';
  var modUnitFilter = 'all';
  var modExpandedCards = {};

  var uplActiveView = 'folder'; // 'folder' (grid) or 'daftar' (table)
  var uplSearchQuery = '';
  var uplSelectedModulId = null;
  var uplCatTab = 'all'; // 'all' | 'revisi' | 'belum_selesai' | 'selesai'
  var uplCatSearchQuery = '';
  var uplCatPeriod = '2026-10';

  var revFilterTab = 'pending'; // 'pending' | 'history' | 'all'
  var revSearchQuery = '';
  var revModFilter = 'all';
  var revUnitFilter = 'all';

  function formatDateIndo(dateStr) {
    if (!dateStr) return "-";
    var parts = dateStr.split(" ")[0].split("-");
    if (parts.length === 3) {
      var y = parts[0], m = parseInt(parts[1], 10), d = parseInt(parts[2], 10);
      var shortMonths = ["","Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des"];
      return d + " " + (shortMonths[m] || parts[1]) + " " + y;
    }
    return dateStr;
  }

  function getGreetingText(name) {
    var date = new Date();
    var h = date.getHours();
    var salam = "Selamat pagi";
    if (h >= 11 && h < 15) salam = "Selamat siang";
    else if (h >= 15 && h < 18) salam = "Selamat sore";
    else if (h >= 18 || h < 4) salam = "Selamat malam";
    var userFirstName = (name || "Pengguna").split(" ")[0];
    return salam + ", " + userFirstName;
  }

  function isEvidenUrl(path) {
    return /^https?:\/\//i.test(path || '');
  }

  function getFileIconSvg(filename, format_file, path_file) {
    var fmt = (format_file || '').toLowerCase();
    var p = (path_file || '').toLowerCase();
    var fn = (filename || '').toLowerCase();

    // 1. Google Drive / Docs / Sheets / Slides
    if (fmt === 'gdrive' || p.indexOf('drive.google.com') > -1 || p.indexOf('docs.google.com') > -1 || fn.indexOf('google drive') > -1 || fn.indexOf('gdrive') > -1) {
      return '<svg width="24" height="24" viewBox="0 0 87.3 78" style="vertical-align:middle"><path d="m6.6 66.85 3.85 6.65c.8 1.4 1.95 2.5 3.3 3.3l13.75-23.8h-27.5c0 1.55.4 3.1 1.2 4.5z" fill="#0066da"/><path d="m43.65 25-13.75-23.8c-1.35.8-2.5 1.9-3.3 3.3l-25.4 44c-.8 1.4-1.2 2.95-1.2 4.5h27.5z" fill="#00ac47"/><path d="m73.55 76.8c1.35-.8 2.5-1.9 3.3-3.3l1.6-2.75 7.65-13.25c.8-1.4 1.2-2.95 1.2-4.5h-27.502l5.852 11.5z" fill="#ea4335"/><path d="m43.65 25 13.75-23.8c-1.35-.8-2.9-1.2-4.5-1.2h-18.5c-1.6 0-3.15.45-4.5 1.2z" fill="#00832d"/><path d="m59.8 53h-32.3l-13.75 23.8c1.35.8 2.9 1.2 4.5 1.2h50.8c1.6 0 3.15-.45 4.5-1.2z" fill="#2684fc"/><path d="m73.4 26.5-12.7-22c-.8-1.4-1.95-2.5-3.3-3.3l-13.75 23.8 16.15 28h27.45c0-1.55-.4-3.1-1.2-4.5z" fill="#ffba00"/></svg>';
    }
    // 2. OneDrive / SharePoint
    if (fmt === 'onedrive' || p.indexOf('onedrive') > -1 || p.indexOf('sharepoint') > -1 || p.indexOf('1drv.ms') > -1 || fn.indexOf('onedrive') > -1) {
      return '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#0284c7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:middle"><path d="M18 10h-1.26A8 8 0 1 0 9 20h9a5 5 0 0 0 0-10z"/></svg>';
    }
    // 3. Dropbox
    if (fmt === 'dropbox' || p.indexOf('dropbox.com') > -1) {
      return '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:middle"><path d="m6 4 6 4-6 4-6-4zm12 0 6 4-6 4-6-4zM0 12l6 4 6-4-6-4zm18 4 6-4-6-4-6 4zm-6 1-6 4-6-4 6-4zm0 0 6 4 6-4-6-4z"/></svg>';
    }
    // 4. General Web / Cloud Link
    if (fmt === 'link' || isEvidenUrl(p) || isEvidenUrl(fn)) {
      return '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#0d9488" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:middle"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>';
    }

    // 5. Structured Data Types (Numeric, Binary, PBJ Matrix, Risk Scale)
    if (fmt === 'numeric' || ext === 'numeric') {
      return '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2" style="vertical-align:middle"><rect x="4" y="2" width="16" height="20" rx="2"/><line x1="8" y1="6" x2="16" y2="6"/><line x1="16" y1="14" x2="16" y2="18"/><path d="M16 10h.01M12 10h.01M8 10h.01M12 14h.01M8 14h.01M12 18h.01M8 18h.01"/></svg>';
    }
    if (fmt === 'binary_score' || ext === 'binary_score') {
      return '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#8b5cf6" stroke-width="2" style="vertical-align:middle"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>';
    }
    if (fmt === 'pbj_matrix' || ext === 'pbj_matrix') {
      return '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2" style="vertical-align:middle"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>';
    }
    if (fmt === 'risk_scale' || ext === 'risk_scale') {
      return '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2" style="vertical-align:middle"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>';
    }

    var ext = (filename || "").split('.').pop().toLowerCase();
    if (ext === 'pdf') {
      return '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="9" y1="15" x2="15" y2="15"/></svg>';
    } else if (ext === 'xlsx' || ext === 'xls') {
      return '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="8" y1="13" x2="16" y2="17"/><line x1="16" y1="13" x2="8" y2="17"/></svg>';
    } else if (ext === 'docx' || ext === 'doc') {
      return '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>';
    }
    return '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>';
  }

  // --- 4 TIPE TAGIHAN / INDIKATOR SESUAI SRS v1.0 ---
  var INPUT_TYPE_META = {
    file: {
      id: 'file',
      type: 'file',
      label: 'Tipe Dokumen (Upload Berkas / Tautan Cloud)',
      shortLabel: 'Dokumen',
      icon: '',
      badgeClass: 'file',
      desc: 'Slot upload berkas fisik (PDF, Word, Excel) atau tautan Google Drive / Cloud Link.',
      hint: 'Slot upload berkas fisik (PDF, Word, Excel) atau tautan Google Drive / Cloud Link.'
    },
    numeric: {
      id: 'numeric',
      type: 'numeric',
      label: 'Tipe Angka (Nominal / Kuantitatif)',
      shortLabel: 'Angka',
      icon: '',
      badgeClass: 'numeric',
      desc: 'Input nilai nominal / kuantitatif (pagu, realisasi anggaran, persentase capaian, atau rekap pegawai).',
      hint: 'Input nilai nominal / kuantitatif (pagu, realisasi anggaran, persentase capaian, atau rekap pegawai).'
    },
    binary_score: {
      id: 'binary_score',
      type: 'binary_score',
      label: 'Tipe Skor Biner (Checklist KKR)',
      shortLabel: 'Skor Biner',
      icon: '',
      badgeClass: 'binary_score',
      desc: 'Checklist Ya (1) / Tidak (0) dengan kalkulasi otomatis threshold kelulusan KKR modul.',
      hint: 'Checklist Ya (1) / Tidak (0) dengan kalkulasi otomatis threshold kelulusan KKR modul.'
    },
    pbj_matrix: {
      id: 'pbj_matrix',
      type: 'pbj_matrix',
      label: 'Tipe Khusus: Matriks 4 Tepat PBJ',
      shortLabel: 'Matriks PBJ',
      icon: '',
      badgeClass: 'pbj_matrix',
      desc: 'Parameter verifikasi 4 aspek kepatuhan PBJ: Kualitas, Kuantitas, Harga, dan Penyedia / Waktu.',
      hint: 'Parameter verifikasi 4 aspek kepatuhan PBJ: Kualitas, Kuantitas, Harga, dan Penyedia / Waktu.'
    },
    risk_scale: {
      id: 'risk_scale',
      type: 'risk_scale',
      label: 'Tipe Khusus: Skala Level Risiko',
      shortLabel: 'Level Risiko',
      icon: '',
      badgeClass: 'risk_scale',
      desc: 'Penetapan tingkat risiko Kemenkes: Dampak (1-5) x Kemungkinan (1-5) & matriks mitigasi.',
      hint: 'Penetapan tingkat risiko Kemenkes: Dampak (1-5) x Kemungkinan (1-5) & matriks mitigasi.'
    }
  };

  function getInputTypeMeta(type) {
    return INPUT_TYPE_META[type] || INPUT_TYPE_META.file;
  }

  function formatRupiah(num) {
    if (num === null || num === undefined || num === '') return 'Rp 0';
    var clean = String(num).replace(/[^0-9.-]/g, '');
    var val = parseFloat(clean) || 0;
    return 'Rp ' + Math.round(val).toLocaleString('id-ID');
  }

  function parseEvidenNilai(ev) {
    if (!ev || !ev.nilai_isian) return null;
    if (typeof ev.nilai_isian === 'object') return ev.nilai_isian;
    try {
      return JSON.parse(ev.nilai_isian);
    } catch(err) {
      return null;
    }
  }

  function calculateModuleKKR(modulId) {
    var m = STATE.moduls.find(function(x){ return x.id_modul === modulId; });
    var threshold = (m && m.scoring_threshold !== null && m.scoring_threshold !== undefined && m.scoring_threshold !== '') ? parseFloat(m.scoring_threshold) : 80;
    var bInds = STATE.indikators.filter(function(i){ return i.id_modul === modulId && i.input_type === 'binary_score'; });
    if (bInds.length === 0) return null;

    var yesCount = 0;
    var filledCount = 0;
    bInds.forEach(function(bi){
      var ev = STATE.evidens.find(function(e){ return e.id_indikator === bi.id_indikator; });
      if (ev && ev.status_eviden !== 'n') {
        var parsed = parseEvidenNilai(ev);
        filledCount++;
        if (parsed && parsed.score !== undefined) {
          if (parseInt(parsed.score) === 1) yesCount++;
        } else if (ev.nama_file && ev.nama_file.toLowerCase().indexOf('ya (1)') > -1) {
          yesCount++;
        }
      }
    });

    var pct = bInds.length > 0 ? (yesCount / bInds.length) * 100 : 0;
    var isPass = pct >= threshold;

    return {
      total: bInds.length,
      filled: filledCount,
      yes: yesCount,
      percentage: Math.round(pct),
      threshold: threshold,
      isPass: isPass
    };
  }

  var SS = {
    n: ["Belum diunggah", "t-gy", 0],
    u: ["Menunggu review SKI", "t-bl", 25],
    o: ["Menunggu Ketua SKI", "t-pu", 50],
    r: ["Perlu tindak lanjut", "t-er", 25],
    a: ["Menunggu evaluasi Pimpinan", "t-pk", 75],
    f: ["Selesai (Disetujui)", "t-ok", 100]
  };

  // --- MODAL CARD POPUP MANAGER ---
  function openModal(opt) {
    var c = document.getElementById("modalContainer");
    var t = document.getElementById("modalTitle");
    var b = document.getElementById("modalBody");
    var f = document.getElementById("modalFooter");
    var mc = document.getElementById("modalCard");

    t.innerHTML = opt.title || "Informasi";
    b.innerHTML = opt.body || "";
    mc.style.maxWidth = opt.width || "620px";

    if (opt.footerHtml) {
      f.innerHTML = opt.footerHtml;
      f.style.display = "flex";
    } else if (opt.hideFooter) {
      f.style.display = "none";
    } else {
      f.style.display = "flex";
      f.innerHTML = '<button class="btn o sm" id="mCancel">' + (opt.cancelText || 'Tutup') + '</button>' +
                    (opt.okText ? '<button class="btn sm" id="mOk">' + opt.okText + '</button>' : '');
      document.getElementById("mCancel").onclick = closeModal;
      if (opt.onOk && opt.okText) {
        document.getElementById("mOk").onclick = function(){ opt.onOk(); };
      }
    }
    c.classList.add("on");
  }

  function closeModal() {
    var c = document.getElementById("modalContainer");
    c.classList.remove("on");
  }

  document.getElementById("modalClose").onclick = closeModal;
  document.getElementById("modalContainer").onclick = function(e){
    if (e.target === this) closeModal();
  };
  document.addEventListener("keydown", function(e){
    if (e.key === "Escape") closeModal();
  });

  function escapeAttr(s) {
    if (s === null || s === undefined) return '';
    return String(s).replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/'/g, '&#39;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
  }

  function escapeHtml(s) {
    if (s === null || s === undefined) return '';
    return String(s).replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/'/g, '&#39;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
  }

  function toast(msg) {
    var t = document.getElementById("toast");
    t.textContent = msg; t.style.display = "block";
    setTimeout(function(){ t.style.display = "none"; }, 3200);
  }

  function fetchInit(callback) {
    fetch('ajax.php?action=init_data')
      .then(function(r){ return r.json(); })
      .then(function(res){
        if (!res.success) {
          document.getElementById("loginView").style.display = "grid";
          document.getElementById("appView").style.display = "none";
          return;
        }
        STATE.user = res.user;
        STATE.perms = res.permissions;
        STATE.moduls = res.moduls;
        STATE.indikators = res.indikators;
        STATE.evidens = res.evidens;
        STATE.rekomendasi = res.rekomendasi;
        STATE.audit = res.audit;
        STATE.users = res.users;
        STATE.units = res.units || [];
        STATE.roles = res.roles || [];
        STATE.rolePermissions = res.role_permissions || {};

        document.getElementById("loginView").style.display = "none";
        document.getElementById("appView").style.display = "block";
        document.getElementById("unm").textContent = STATE.user.nama;
        document.getElementById("urn").textContent = STATE.user.nama_role;
        document.getElementById("uav").textContent = STATE.user.nama.substr(0, 2).toUpperCase();

        syncNav();
        if (callback) callback();
      });
  }

  function can(menu, act) {
    if (STATE.user && STATE.user.role === 'adm') return true;
    return (STATE.perms[menu] || "").indexOf(act) > -1;
  }

  function syncNav() {
    document.querySelectorAll(".nav").forEach(function(b){
      b.style.display = can(b.dataset.s, "l") ? "" : "none";
    });
    document.querySelectorAll(".rb[data-g]").forEach(function(rb){
      var g = rb.dataset.g;
      var pg = document.querySelector('.pg[data-g="' + g + '"]');
      var hasVisible = pg && [].some.call(pg.querySelectorAll(".nav"), function(n){ return n.style.display !== "none"; });
      rb.style.display = hasVisible ? "" : "none";
    });
    var unseen = STATE.rekomendasi.filter(function(r){ return parseInt(r.is_dilihat_pimpinan) === 0; }).length;
    var pendingEv = STATE.evidens.filter(function(e){ return e.status_eviden === 'a'; }).length;
    var totalPending = unseen + pendingEv;
    var bdg = document.getElementById("bdg");
    if (bdg) {
      if (totalPending > 0 && can('apm', 'l')) {
        bdg.hidden = false; bdg.textContent = totalPending;
      } else {
        bdg.hidden = true;
      }
    }
  }

  function showScreen(s) {
    if (s !== 'dash' && s !== 'prof' && !can(s, 'l')) {
      s = 'dash';
    }
    ACTIVE_SCREEN = s;
    document.body.classList.remove("nav-open");
    document.querySelectorAll(".scr").forEach(function(x){ x.classList.toggle("on", x.id === s); });
    document.querySelectorAll(".nav").forEach(function(b){ b.classList.toggle("on", b.dataset.s === s); });
    
    // Toggle page guide button visibility (hidden on dash to match mockup cleanly, visible on other screens)
    var btnGuide = document.getElementById("btnPageGuide");
    if (btnGuide) {
      btnGuide.style.display = (s === 'dash') ? 'none' : 'inline-flex';
    }

    var nb = document.querySelector('.nav[data-s="' + s + '"]');
    if (nb) {
      var navTitle = nb.querySelector('.nav-txt') ? nb.querySelector('.nav-txt').textContent : nb.textContent;
      document.getElementById("ttl").innerHTML = '<span>' + navTitle.replace(/[0-9]/g, '').trim() + '</span>';
      var activePg = nb.closest('.pg');
      if (activePg) {
        var g = activePg.dataset.g;
        document.querySelectorAll(".pg").forEach(function(p){ p.classList.toggle("on", p === activePg); });
        document.querySelectorAll(".rb[data-g]").forEach(function(rb){ rb.classList.toggle("on", rb.dataset.g === g); });
      }
    } else if (s === 'prof') {
      document.getElementById("ttl").innerHTML = '<span>Profil Akun Saya</span>';
      document.querySelectorAll(".pg").forEach(function(p){ p.classList.remove("on"); });
      document.querySelectorAll(".rb[data-g]").forEach(function(rb){ rb.classList.remove("on"); });
    }
    var grEl = document.getElementById("gr");
    if (grEl && STATE.user) {
      if (s === 'prof') {
        grEl.textContent = 'Kelola data identitas profil, informasi akun, dan perbarui kata sandi Anda.';
      } else {
        grEl.textContent = getGreetingText(STATE.user.nama);
      }
    }
    renderActiveScreen();
    window.scrollTo(0,0);
  }

  function goToUploadWithTab(tab) {
    uplSelectedModulId = null;
    uplCatTab = tab || 'all';
    uplCatSearchQuery = '';
    showScreen('upl');
  }
  window.goToUploadWithTab = goToUploadWithTab;

  function goToUploadModul(modId) {
    uplSelectedModulId = modId;
    showScreen('upl');
  }
  window.goToUploadModul = goToUploadModul;

  // --- CARD POPUP: PANDUAN ALUR SETIAP HALAMAN ---
  var PAGE_GUIDES = {
    dash: {
      step: "Dashboard",
      role: "Semua Pengguna (PIC, Anggota SKI, Ketua SKI, Pimpinan, Itjen)",
      desc: "Menampilkan ringkasan menyeluruh kepatuhan internal, statistik pengumpulan berkas per unit kerja, dan tenggat waktu aktif.",
      actions: [
        "Lihat <b>Kartu Ringkasan Kepatuhan</b> untuk mengetahui total butir indikator yang telah terpenuhi.",
        "Pantau <b>Status Kunci Otomatis (Auto-Lock)</b> agar tidak terlambat menyampaikan berkas bukti.",
        "Gunakan menu di sisi kiri untuk menjalankan peran kerja Anda masing-masing."
      ],
      next: "Lanjutkan ke menu sesuai tugas Anda (Upload Eviden bagi PIC, Review bagi SKI, Disposisi bagi Pimpinan)."
    },
    jdw: {
      step: "Tahap 2: Jadwal",
      role: "Ketua SKI & Admin",
      desc: "Menentukan siklus pengawasan (Bulanan/Triwulan), tanggal jatuh tempo pengumpulan berkas, serta tanggal mulai penilaian SKI.",
      actions: [
        "Tentukan <b>Tenggat Unggah</b>. Ingat: Setelah tanggal ini terlewati, sistem mengunci berkas secara otomatis!",
        "Pilih modul-modul yang sudah siap diterbitkan pada periode berjalan.",
        "Klik tombol <b>Terbitkan Jadwal Aktif</b> untuk mengumumkan tagihan ke PIC."
      ],
      next: "PIC unit kerja sekarang dapat mulai mengunggah dokumen di menu <b>Upload Eviden</b>."
    },
    upl: {
      step: "Tahap 3: Unggah bukti",
      role: "PIC Unit Kerja",
      desc: "PIC mengunggah berkas eviden (PDF, Excel, Word maks 50 MB) atau tautan Google Drive / Cloud Storage sebelum batas waktu.",
      actions: [
        "Periksa daftar butir indikator yang ditagihkan untuk unit kerja Anda.",
        "Klik tombol <b>Unggah</b> pada butir bersangkutan. Pilih tab <b>Unggah Berkas File</b> (maks 50 MB) atau <b>Tautan GDrive / Cloud</b>.",
        "Jika memilih opsi tautan Google Drive / Cloud, pastikan setelan berbagi tautan sudah diset ke 'Siapa saja yang memiliki tautan dapat melihat' (Viewer).",
        "Sebelum tenggat waktu, Anda bebas mengganti berkas, memperbarui tautan, atau memperbaiki dokumen.",
        "Jika ada catatan perbaikan dari SKI, klik <b>Tindak Lanjut</b> untuk mengunggah dokumen/tautan revisi."
      ],
      next: "Dokumen bukti atau tautan yang diserahkan akan langsung masuk ke antrean <b>Review & Cross-check</b> Anggota SKI."
    },
    mon: {
      step: "Monitoring",
      role: "Ketua SKI & Manajemen",
      desc: "Memantau seluruh dokumen yang masuk dari masing-masing departemen secara terpusat dan transparan.",
      actions: [
        "Gunakan filter modul atau unit kerja untuk mencari dokumen secara spesifik.",
        "Klik nama berkas untuk melakukan pratinjau dokumen dan memeriksa versinya."
      ],
      next: "Pantau kelengkapan dokumen hingga seluruh departemen selesai 100%."
    },
    rep: {
      step: "Repositori",
      role: "Auditor Itjen Kemenkes & Tim SKI",
      desc: "Akses penelusuran seluruh dokumen bukti kepatuhan internal yang telah terkumpul dalam mode baca aman.",
      actions: [
        "Pilih modul pengawasan untuk melihat dokumen yang tersimpan.",
        "Gunakan tombol <b>Pratinjau / Unduh</b> untuk mengecek keaslian bukti audit."
      ],
      next: "Digunakan sebagai bahan audit tahunan dan pembuktian pemenuhan standar kepatuhan."
    },
    rev: {
      step: "Tahap 4: Review",
      role: "Anggota SKI",
      desc: "Anggota SKI memverifikasi kesesuaian dokumen bukti terhadap butir indikator pengawasan.",
      actions: [
        "Pilih berkas dari antrean di bawah, klik tombol <b>Tinjau Berkas</b>.",
        "Periksa isi dokumen. Tentukan status: <b>Sesuai Indikator</b> atau <b>Tidak Sesuai</b>.",
        "Jika tidak sesuai, wajib tuliskan catatan temuan agar PIC mengetahui bagian yang perlu diperbaiki.",
        "Klik <b>Simpan Hasil Review</b>."
      ],
      next: "Berkas yang sesuai akan otomatis diteruskan ke meja <b>Approval Ketua SKI</b>. Berkas yang tidak sesuai dikembalikan ke PIC."
    },
    apr: {
      step: "Tahap 5: Persetujuan Ketua",
      role: "Ketua SKI",
      desc: "Ketua SKI melakukan validasi akhir atas hasil review dan merumuskan poin rekomendasi resmi ke Meja Pimpinan.",
      actions: [
        "Tinjau berkas yang telah dinyatakan sesuai oleh Anggota SKI.",
        "Klik tombol <b>Setujui</b> per berkas atau secara massal.",
        "Tuliskan poin rekomendasi resmi pengawasan pada formulir yang disediakan.",
        "Klik <b>Kirim Rekomendasi</b>."
      ],
      next: "Rekomendasi langsung muncul di meja evaluasi <b>Kepala BBPK Jakarta</b>."
    },
    apm: {
      step: "Tahap 6: Persetujuan Pimpinan",
      role: "Pimpinan / Kepala BBPK Jakarta",
      desc: "Pimpinan mengevaluasi rekomendasi dari Ketua SKI dan menetapkan persetujuan atau instruksi disposisi.",
      actions: [
        "Pilih berkas rekomendasi di sisi kiri (status 'Belum Dilihat' otomatis terupdate).",
        "Klik <b>Setuju (Tugas Selesai)</b> jika hasil pengawasan telah memenuhi standar.",
        "Klik <b>Beri Disposisi</b> disertai catatan instruksi jika dokumen memerlukan perbaikan ulang dari SKI/PIC."
      ],
      next: "Modul yang disetujui penuh siap untuk diekspor pada menu <b>Ekspor Laporan</b>."
    },
    exp: {
      step: "Ekspor laporan PDF",
      role: "Semua Peran Terkait / SKI & Pimpinan",
      desc: "Membuat laporan hasil pengawasan modul dalam format PDF.",
      actions: [
        "Pilih modul yang ingin diekspor.",
        "Klik <b>Ekspor PDF</b>, lalu simpan sebagai PDF dari jendela cetak."
      ],
      next: "Laporan PDF siap disimpan."
    },
    aud: {
      step: "Audit aktivitas",
      role: "Semua Pengguna (Read-Only Mutlak)",
      desc: "Merekam setiap aktivitas mutasi data secara objektif (waktu, nama, peran, jenis aksi, objek target, dan IP address) tanpa dapat diubah atau dihapus oleh siapa pun, termasuk Admin.",
      actions: [
        "Gunakan filter jenis aksi untuk melacak jejak perubahan data.",
        "Gunakan kotak pencarian untuk mencari nama pegawai atau objek tertentu."
      ],
      next: "Menjamin akuntabilitas dan integritas data pengawasan internal BBPK Jakarta."
    },
    usr: {
      step: "Kelola pengguna",
      role: "Administrator Sistem",
      desc: "Admin mengelola akun pegawai, penempatan unit kerja, dan peran operasional.",
      actions: [
        "Gunakan tombol <b>+ Tambah Pengguna</b> untuk mendaftarkan akun pegawai baru.",
        "Atur penempatan peran (PIC, Anggota SKI, Ketua SKI, Pimpinan, Itjen).",
        "Gunakan tombol Aktif/Nonaktif jika pegawai berpindah tugas."
      ],
      next: "Pengguna yang didaftarkan dapat langsung masuk ke sistem menggunakan username dan kata sandi."
    },
    hak: {
      step: "Hak akses",
      role: "Administrator Sistem (Prinsip RNF-01)",
      desc: "Mengatur izin dinamis per peran dan aksi (Lihat, Tambah, Ubah, Hapus, Unduh, Setujui).",
      actions: [
        "Pilih peran yang ingin diatur.",
        "Centang atau hilangkan tanda centang pada menu dan aksi yang diizinkan.",
        "Perhatian RNF-01: Hak melihat isi berkas eviden dan memberikan persetujuan terkunci mutlak dari Admin."
      ],
      next: "Perubahan hak akses berlaku secara langsung ke basis data."
    },
    prof: {
      step: "Profil akun",
      role: "Semua Pengguna Terdaftar",
      desc: "Halaman personal untuk memperbarui nama lengkap kedinasan, memantau NIP/Username, dan memperbarui kata sandi akun.",
      actions: [
        "Perbarui <b>Nama Lengkap</b> apabila terdapat koreksi penulisan nama atau gelar kedinasan.",
        "Pantau <b>NIP / Username</b> terdaftar (khusus Administrator yang berwenang mengubah NIP/Username).",
        "Gunakan formulir <b>Ubah Kata Sandi</b> secara berkala untuk menjaga keamanan akun Anda."
      ],
      next: "Setelah selesai memperbarui profil, Anda dapat kembali ke Dashboard atau menu tugas lainnya."
    }
  };

  document.getElementById("btnPageGuide").onclick = function(){
    var g = PAGE_GUIDES[ACTIVE_SCREEN] || PAGE_GUIDES.dash;
    var actList = g.actions.map(function(action){
      return "<li style='margin-bottom:6px'>" + action + "</li>";
    }).join("");

    var bodyHtml = '<div style="margin-bottom:10px;font-size:13px;font-weight:600;color:var(--dk)">' + g.step + '</div>' +
                   '<ol style="margin:0;padding-left:18px;font-size:12.5px;line-height:1.5">' + actList + '</ol>';

    openModal({
      title: "Petunjuk",
      body: bodyHtml,
      cancelText: "Tutup",
      width: "600px"
    });
  };

  function renderActiveScreen() {
    if (ACTIVE_SCREEN === 'dash') renderDash();
    else if (ACTIVE_SCREEN === 'mod') renderModul();
    else if (ACTIVE_SCREEN === 'jdw') renderJadwal();
    else if (ACTIVE_SCREEN === 'upl') renderUpload();
    else if (ACTIVE_SCREEN === 'mon') renderMonitoring();
    else if (ACTIVE_SCREEN === 'rep') renderRepositori();
    else if (ACTIVE_SCREEN === 'rev') renderReview();
    else if (ACTIVE_SCREEN === 'apr') renderApprovalKetua();
    else if (ACTIVE_SCREEN === 'apm') renderApprovalPimpinan();
    else if (ACTIVE_SCREEN === 'exp') renderEkspor();
    else if (ACTIVE_SCREEN === 'aud') renderAudit();
    else if (ACTIVE_SCREEN === 'usr') renderUsers();
    else if (ACTIVE_SCREEN === 'hak') renderHakAkses();
    else if (ACTIVE_SCREEN === 'prof') renderProfile();
  }

  // --- 1. DASHBOARD ---
  // Helper dashboard: ikon SVG standar
  var dashIconFolder = '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 20h16a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.93a2 2 0 0 1-1.66-.9l-.82-1.2A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13c0 1.1.9 2 2 2Z"/></svg>';
  var dashIconCheck = '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>';
  var dashIconAlert = '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>';
  var dashIconClock = '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>';
  var dashIconFile = '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>';
  var dashIconBuilding = '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="4" y="2" width="16" height="20" rx="2" ry="2"/><line x1="9" y1="22" x2="9" y2="22.01"/><line x1="15" y1="22" x2="15" y2="22.01"/><line x1="9" y1="6" x2="9" y2="6.01"/><line x1="15" y1="6" x2="15" y2="6.01"/><line x1="9" y1="10" x2="9" y2="10.01"/><line x1="15" y1="10" x2="15" y2="10.01"/><line x1="9" y1="14" x2="9" y2="14.01"/><line x1="15" y1="14" x2="15" y2="14.01"/><line x1="9" y1="18" x2="9" y2="18.01"/><line x1="15" y1="18" x2="15" y2="18.01"/></svg>';
  var dashIconUpload = '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>';

  // Helper dashboard: hitung selisih hari dari tenggat
  function dashDaysLeft(dateStr) {
    if (!dateStr) return null;
    var clean = dateStr.replace(' ', 'T');
    var d = new Date(clean);
    if (isNaN(d.getTime())) return null;
    var now = new Date();
    var dDate = new Date(d.getFullYear(), d.getMonth(), d.getDate());
    var nDate = new Date(now.getFullYear(), now.getMonth(), now.getDate());
    return Math.round((dDate - nDate) / (1000 * 60 * 60 * 24));
  }

  // Helper dashboard: cari tenggat terdekat dan daftar modul berjadwal terurut
  function dashEarliestTenggatInfo(modList) {
    var scheduled = (modList || []).filter(function(m){
      return !!m.tenggat_unggah;
    });
    if (scheduled.length === 0) {
      return { val: '-', sub: 'belum ada jadwal', sorted: [] };
    }
    scheduled.sort(function(a, b){
      var da = new Date(a.tenggat_unggah.replace(' ', 'T')).getTime() || 0;
      var db = new Date(b.tenggat_unggah.replace(' ', 'T')).getTime() || 0;
      return da - db;
    });

    var earliest = scheduled[0];
    var days = dashDaysLeft(earliest.tenggat_unggah);
    var val = '-';
    if (days !== null) {
      if (days < 0) val = 'Lewat ' + Math.abs(days) + ' hr';
      else if (days === 0) val = 'Hari ini';
      else if (days === 1) val = 'Besok';
      else val = days + ' hari lagi';
    }
    var sub = earliest.nama_modul ? earliest.nama_modul : formatDateIndo(earliest.tenggat_unggah);
    return { val: val, sub: sub, earliest: earliest, sorted: scheduled };
  }

  // Helper dashboard: kartu KPI
  function dashKpi(label, val, sub, svgIcon, bgCol, onClickStr) {
    var clickAttr = onClickStr ? ' onclick="' + onClickStr + '" role="button" tabindex="0" style="cursor:pointer;" title="Klik untuk membuka shortcut"' : '';
    return '<div class="dash-kpi-card"' + clickAttr + '>' +
             '<div class="dash-kpi-icon" style="background:' + bgCol + ';box-shadow:0 6px 16px ' + bgCol + '44">' +
               svgIcon +
             '</div>' +
             '<div class="dash-kpi-info">' +
               '<span class="dash-kpi-label">' + escapeHtml(label) + '</span>' +
               '<span class="dash-kpi-val">' + escapeHtml(String(val)) + '</span>' +
               '<span class="dash-kpi-sub">' + escapeHtml(sub || '') + '</span>' +
             '</div>' +
           '</div>';
  }

  // Helper dashboard: donut ring capaian
  function dashRing(pct, subLabel, legendHtml) {
    var r = 62;
    var c = 2 * Math.PI * r;
    var strokeDash = (pct / 100) * c;
    var strokeOffset = c - strokeDash;

    return '<div class="dash-donut-wrap">' +
             '<div class="dash-donut-ring">' +
               '<svg width="180" height="180" viewBox="0 0 160 160" style="transform:rotate(-90deg);transform-origin:center">' +
                 '<circle cx="80" cy="80" r="' + r + '" fill="none" stroke="#e8ecf4" stroke-width="18" />' +
                 '<circle cx="80" cy="80" r="' + r + '" fill="none" stroke="#087066" stroke-width="18" stroke-linecap="round" ' +
                   'stroke-dasharray="' + c.toFixed(1) + '" stroke-dashoffset="' + strokeOffset.toFixed(1) + '" ' +
                   'style="transition:stroke-dashoffset 0.8s ease" />' +
               '</svg>' +
               '<div class="dash-donut-center">' +
                 '<span class="dash-donut-pct">' + pct + '%</span>' +
                 '<span class="dash-donut-sub">' + escapeHtml(subLabel || 'tercapai') + '</span>' +
               '</div>' +
             '</div>' +
             (legendHtml ? '<div class="dash-donut-legend">' + legendHtml + '</div>' : '') +
           '</div>';
  }

  // Helper dashboard: kartu kontainer utama
  function dashCard(title, extraHeaderHtml, bodyHtml, cardStyle) {
    return '<div class="dash-card"' + (cardStyle ? ' style="' + cardStyle + '"' : '') + '>' +
             (title ? (
               '<div class="dash-card-header">' +
                 '<h2 class="dash-card-title">' + escapeHtml(title) + '</h2>' +
                 (extraHeaderHtml || '') +
               '</div>'
             ) : '') +
             bodyHtml +
           '</div>';
  }

  // Helper dashboard: legenda ring
  function dashLegend(items) {
    return (items || []).map(function(item){
      return '<span class="dash-legend-item">' +
               '<i class="dash-legend-dot" style="background:' + item.color + '"></i> ' +
               escapeHtml(item.label) + ' <b>' + escapeHtml(String(item.count)) + '</b>' +
             '</span>';
    }).join('');
  }

  // Helper dashboard: baris progres modul
  function dashModRows(itemList, getCountsFn) {
    if (!itemList || itemList.length === 0) {
      return '<div style="text-align:center;padding:36px 16px;color:#64748b;font-size:13px">' +
               '<svg width="38" height="38" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.6" style="margin-bottom:8px;display:inline-block"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>' +
               '<p style="margin:0;font-weight:600;color:#334155">Belum ada data pengawasan.</p>' +
             '</div>';
    }

    return itemList.map(function(item){
      var c = getCountsFn(item);
      var p = c.total > 0 ? Math.round((c.done / c.total) * 100) : 0;
      var st = "Kritis";
      var col = "#ef4444";
      if (c.total === 0) {
        st = "Belum ada butir";
        col = "#94a3b8";
      } else if (p >= 80) {
        st = "Baik";
        col = "#10b981";
      } else if (p >= 60) {
        st = "Cukup";
        col = "#0d9488";
      } else if (p >= 40) {
        st = "Perlu perhatian";
        col = "#f59e0b";
      } else {
        st = "Kritis";
        col = "#ef4444";
      }

      var nameLabel = item.nama_modul || item.nama_unit || '-';
      var unitSub = (item.nama_unit && item.nama_modul) ? ' <small style="color:#64748b;font-weight:400">(' + escapeHtml(item.nama_unit) + ')</small>' : '';

      return '<div class="dash-mod-row">' +
               '<div class="dash-mod-meta">' +
                 '<span class="dash-mod-name">' + escapeHtml(nameLabel) + unitSub + '</span>' +
                 '<span class="dash-mod-count">' +
                   '<b>' + escapeHtml(String(c.done)) + '</b> dari ' + escapeHtml(String(c.total)) + ' ' + (c.unitLabel || 'item') + ' ' +
                   '<span class="dash-mod-status" style="color:' + col + '">' + st + '</span>' +
                 '</span>' +
               '</div>' +
               '<div class="dash-mod-bar">' +
                 '<div class="dash-mod-fill" style="width:' + p + '%;background:' + col + '"></div>' +
               '</div>' +
             '</div>';
    }).join('');
  }

  // Helper dashboard: 4 tenggat mendatang
  function dashTenggat(tenggatList) {
    if (!tenggatList || tenggatList.length === 0) {
      return '<div style="margin-top:20px;border-top:1px solid #f1f5f9;padding-top:16px;font-size:12px;color:#94a3b8;text-align:center">Tidak ada jadwal tenggat mendatang.</div>';
    }

    var h = '<div style="margin-top:20px;border-top:1px solid #f1f5f9;padding-top:16px">' +
              '<div style="font-size:13px;font-weight:700;color:#0f172a;margin-bottom:12px;display:flex;align-items:center;justify-content:space-between">' +
                '<span style="display:inline-flex;align-items:center;gap:6px">' +
                  '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#087066" stroke-width="2.2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>' +
                  '4 Tenggat Mendatang' +
                '</span>' +
                '<span style="font-size:11px;color:#64748b;font-weight:500">Batas Submit</span>' +
              '</div>' +
              '<div style="display:flex;flex-direction:column;gap:9px">';

    tenggatList.slice(0, 4).forEach(function(m){
      var days = dashDaysLeft(m.tenggat_unggah);
      var badgeCol = '#0d9488';
      var badgeBg = '#e6f8f5';
      var badgeTxt = days !== null ? (days + ' hari lagi') : '-';

      if (days !== null) {
        if (days < 0) {
          badgeCol = '#dc2626';
          badgeBg = '#fef2f2';
          badgeTxt = 'Lewat ' + Math.abs(days) + ' hr';
        } else if (days === 0) {
          badgeCol = '#ea580c';
          badgeBg = '#fff7ed';
          badgeTxt = 'Hari ini';
        } else if (days === 1) {
          badgeCol = '#ea580c';
          badgeBg = '#fff7ed';
          badgeTxt = 'Besok';
        }
      }

      var clickAttr = (typeof can === 'function' && can('upl', 'l')) ? ' onclick="goToUploadModul(\'' + m.id_modul + '\')" style="cursor:pointer;" title="Klik untuk langsung buka modul ini di menu Upload Eviden"' : '';
      h += '<div class="dash-tenggat-item"' + clickAttr + ' style="display:flex;align-items:center;justify-content:space-between;gap:10px;padding:8px 10px;border-radius:10px;background:#f8fafc;border:1px solid #eef2f6">' +
             '<div style="min-width:0;flex:1">' +
               '<div style="font-size:12.5px;font-weight:600;color:#1e293b;white-space:nowrap;overflow:hidden;text-overflow:ellipsis" title="' + escapeAttr(m.nama_modul) + '">' +
                 escapeHtml(m.nama_modul) +
               '</div>' +
               '<div style="font-size:11px;color:#64748b">' +
                 escapeHtml(m.nama_unit || '') + (m.nama_unit ? ' &bull; ' : '') + formatDateIndo(m.tenggat_unggah) +
               '</div>' +
             '</div>' +
             '<span style="font-size:11px;font-weight:700;padding:3px 8px;border-radius:99px;background:' + badgeBg + ';color:' + badgeCol + ';white-space:nowrap">' +
               escapeHtml(badgeTxt) +
             '</span>' +
           '</div>';
    });

    h += '</div></div>';
    return h;
  }

  // Tampilan Dashboard: PIC (Penanggung Jawab Modul Unit Kerja)
  function dashPIC() {
    var myUnitId = STATE.user.unit;
    var myModuls = STATE.moduls.filter(function(m){
      return (!myUnitId || m.id_unit_pic === myUnitId) && m.status_template === 'terbit' && !!m.id_jadwal;
    });
    var myInds = STATE.indikators.filter(function(i){
      return myModuls.some(function(m){ return m.id_modul === i.id_modul; });
    });
    var myEvs = STATE.evidens.filter(function(e){
      return myModuls.some(function(m){ return m.id_modul === e.id_modul; });
    });

    // Indikator terpenuhi = indikator yang punya eviden dengan status selain 'n' dan 'r'
    var terpenuhiCount = myInds.filter(function(i){
      var e = STATE.evidens.find(function(ev){ return ev.id_indikator === i.id_indikator; });
      return e && e.status_eviden !== 'n' && e.status_eviden !== 'r';
    }).length;
    var totalInd = myInds.length;
    var pctTerpenuhi = totalInd > 0 ? Math.round((terpenuhiCount / totalInd) * 100) : 0;
    var revisiCount = myEvs.filter(function(e){ return e.status_eviden === 'r'; }).length;
    var tenggatInfo = dashEarliestTenggatInfo(myModuls);
    var myMissing = Math.max(0, totalInd - terpenuhiCount);
    var unitName = STATE.user.nama_unit || 'Unit Kerja PIC';

    // Klasifikasi status modul untuk PIC
    var modStatsMap = {};
    var modRevisiList = [];
    var modBelumSelesaiList = [];
    var modSelesaiList = [];
    var modBelumUploadList = [];

    myModuls.forEach(function(m){
      var st = getModulEvidenStats(m);
      modStatsMap[m.id_modul] = st;
      if (st.statusKey === 'revisi') modRevisiList.push(m);
      if (st.statusKey !== 'selesai') modBelumSelesaiList.push(m);
      if (st.statusKey === 'selesai') modSelesaiList.push(m);
      if (st.statusKey === 'belum') modBelumUploadList.push(m);
    });

    var h = '';

    // 4 KPI Cards di bagian atas dengan shortcut klik langsung
    h += '<div class="dash-kpi-grid">' +
           dashKpi("Modul Unit Saya", myModuls.length, "modul aktif terjadwal", dashIconFolder, "#2563eb", "goToUploadWithTab('all')") +
           dashKpi("Indikator Terpenuhi", terpenuhiCount + " / " + totalInd, pctTerpenuhi + "% selesai", dashIconCheck, "#10b981", "goToUploadWithTab('selesai')") +
           dashKpi("Perlu Tindak Lanjut", revisiCount, "berkas dikembalikan", dashIconAlert, "#dc2626", "goToUploadWithTab('revisi')") +
           dashKpi("Tenggat Terdekat", tenggatInfo.val, tenggatInfo.sub, dashIconClock, "#7c3aed", tenggatInfo.earliest ? "goToUploadModul('" + tenggatInfo.earliest.id_modul + "')" : "goToUploadWithTab('belum_selesai')") +
         '</div>';

    // Main 2-Column Grid
    h += '<div class="dash-main-grid">';

    // Left Column: Progres Pengisian per Modul (Disatukan dengan shortcut status dan peringatan-peringatan tanpa icon)
    var leftBody = '';

    // Shortcut Status Filter Bar di dalam kartu Progres
    leftBody += '<div class="dash-pic-pills-bar">' +
                  '<button class="dash-pic-pill" onclick="goToUploadWithTab(\'all\')" title="Semua modul">' +
                    'Semua <b>' + myModuls.length + '</b>' +
                  '</button>' +
                  '<button class="dash-pic-pill revisi" onclick="goToUploadWithTab(\'revisi\')" title="Modul perlu revisi">' +
                    'Revisi <b>' + modRevisiList.length + '</b>' +
                  '</button>' +
                  '<button class="dash-pic-pill belum" onclick="goToUploadWithTab(\'belum_selesai\')" title="Modul belum selesai">' +
                    'Belum Selesai <b>' + modBelumSelesaiList.length + '</b>' +
                  '</button>' +
                  '<button class="dash-pic-pill selesai" onclick="goToUploadWithTab(\'selesai\')" title="Modul sudah selesai">' +
                    'Selesai <b>' + modSelesaiList.length + '</b>' +
                  '</button>' +
                '</div>';

    if (myModuls.length === 0) {
      leftBody += '<div style="text-align:center;padding:36px 16px;color:#64748b;font-size:13px">' +
                    '<svg width="38" height="38" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.6" style="margin-bottom:8px;display:inline-block"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>' +
                    '<p style="margin:0;font-weight:600;color:#334155">Belum ada modul pengawasan aktif untuk unit kerja ini.</p>' +
                  '</div>';
    } else {
      leftBody += '<div style="display:flex;flex-direction:column;gap:12px">';
      myModuls.forEach(function(m){
        var st = modStatsMap[m.id_modul] || getModulEvidenStats(m);
        var mInds = STATE.indikators.filter(function(i){ return i.id_modul === m.id_modul; });
        var mTerpenuhi = mInds.filter(function(i){
          var e = STATE.evidens.find(function(ev){ return ev.id_indikator === i.id_indikator; });
          return e && e.status_eviden !== 'n' && e.status_eviden !== 'r';
        }).length;
        var p = mInds.length > 0 ? Math.round((mTerpenuhi / mInds.length) * 100) : 0;
        var mMissing = Math.max(0, mInds.length - mTerpenuhi);
        var days = dashDaysLeft(m.tenggat_unggah);

        var modEvs = STATE.evidens.filter(function(e){ return e.id_modul === m.id_modul; });
        var hasRevisi = modEvs.some(function(e){ return e.status_eviden === 'r'; }) || st.statusKey === 'revisi';
        var hasDitolak = modEvs.some(function(e){ return e.status_kesesuaian === 'tidak_sesuai' && e.status_eviden !== 's'; });
        var isDeadlineOver = (days !== null && days < 0 && p < 100);
        var isDeadlineToday = (days === 0 && p < 100);

        var barCol = '#087066';
        if (hasRevisi || hasDitolak || isDeadlineOver) barCol = '#dc2626';
        else if (p >= 80) barCol = '#10b981';
        else if (p >= 40) barCol = '#0d9488';
        else if (p > 0) barCol = '#f59e0b';
        else barCol = '#94a3b8';

        leftBody += '<div class="dash-pic-mod-card">' +
                      '<div style="display:flex;align-items:flex-start;justify-content:space-between;gap:12px;margin-bottom:8px">' +
                        '<div style="min-width:0;flex:1">' +
                          '<div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;margin-bottom:2px">' +
                            '<span style="font-size:13.5px;font-weight:700;color:#1e293b">' + escapeHtml(m.nama_modul) + '</span>' +
                            '<span class="upl-task-badge ' + st.badgeClass + '" style="font-size:10.5px;padding:2px 8px">' + st.badgeText + '</span>' +
                          '</div>' +
                          '<div style="font-size:11.5px;color:#64748b">' +
                            mTerpenuhi + '/' + mInds.length + ' indikator (' + p + '%)' +
                            (m.tenggat_unggah ? ' &bull; Tenggat: ' + formatDateIndo(m.tenggat_unggah) : '') +
                          '</div>' +
                        '</div>' +
                        '<button class="btn sm" onclick="goToUploadModul(\'' + m.id_modul + '\')" style="background:#087066;padding:5px 12px;font-size:11.5px;border-radius:8px;display:inline-flex;align-items:center;gap:4px;flex-shrink:0">' +
                          'Unggah Eviden &rarr;' +
                        '</button>' +
                      '</div>' +
                      '<div class="dash-mod-bar">' +
                        '<div class="dash-mod-fill" style="width:' + p + '%;background:' + barCol + '"></div>' +
                      '</div>';

        // Peringatan status ringkas (TANPA ICON, langsung ke inti, clickable)
        if (hasDitolak) {
          leftBody += '<div class="dash-pic-warn-box danger" onclick="goToUploadModul(\'' + m.id_modul + '\')">' +
                        '<b>Ditolak:</b> Berkas tidak sesuai — klik untuk ganti.' +
                      '</div>';
        }

        if (hasRevisi) {
          var revMsg = st.revisiNote ? (escapeHtml(st.revisiNote) + ' — ') : '';
          leftBody += '<div class="dash-pic-warn-box danger" onclick="goToUploadModul(\'' + m.id_modul + '\')">' +
                        '<b>Revisi:</b> ' + revMsg + 'klik untuk perbaiki.' +
                      '</div>';
        }

        if (isDeadlineOver) {
          leftBody += '<div class="dash-pic-warn-box danger" onclick="goToUploadModul(\'' + m.id_modul + '\')">' +
                        '<b>Telat ' + Math.abs(days) + ' Hari:</b> Melewati batas — klik untuk unggah.' +
                      '</div>';
        } else if (isDeadlineToday) {
          leftBody += '<div class="dash-pic-warn-box warning" onclick="goToUploadModul(\'' + m.id_modul + '\')">' +
                        '<b>Deadline Hari Ini:</b> Batas akhir — klik untuk unggah.' +
                      '</div>';
        }

        if (p === 0 && mInds.length > 0) {
          leftBody += '<div class="dash-pic-warn-box info" onclick="goToUploadModul(\'' + m.id_modul + '\')">' +
                        '<b>Belum Diunggah:</b> 0/' + mInds.length + ' indikator — klik untuk unggah eviden.' +
                      '</div>';
        } else if (p > 0 && p < 100 && !hasRevisi && !hasDitolak && !isDeadlineOver && !isDeadlineToday) {
          leftBody += '<div class="dash-pic-warn-box info" onclick="goToUploadModul(\'' + m.id_modul + '\')">' +
                        '<b>Belum Selesai:</b> Kurang ' + mMissing + ' indikator — klik untuk lengkapi.' +
                      '</div>';
        } else if (p === 100 && !hasRevisi && !hasDitolak) {
          leftBody += '<div class="dash-pic-warn-box success" onclick="goToUploadModul(\'' + m.id_modul + '\')">' +
                        '<b>Selesai:</b> Lengkap ' + mInds.length + '/' + mInds.length + ' indikator — klik untuk tinjau.' +
                      '</div>';
        }

        leftBody += '</div>';
      });
      leftBody += '</div>';
    }

    var cardHeaderExtra = '<div style="display:flex;align-items:center;gap:8px">' +
                            '<span class="dash-badge-period"><i></i> ' + escapeHtml(unitName) + '</span>' +
                            '<button class="btn sm o" onclick="goToUploadWithTab(\'all\')" style="padding:4px 10px;font-size:11.5px;border-radius:8px">Katalog Lengkap &rarr;</button>' +
                          '</div>';

    h += dashCard("Progres Pengisian per Modul", cardHeaderExtra, leftBody);

    // Right Column: Ring capaian keseluruhan + 4 tenggat mendatang
    var legendHtml = dashLegend([
      { label: 'Terpenuhi', count: terpenuhiCount, color: '#10b981' },
      { label: 'Belum Lengkap', count: Math.max(0, totalInd - terpenuhiCount), color: '#94a3b8' }
    ]);
    var ringHtml = dashRing(pctTerpenuhi, 'indikator terpenuhi', legendHtml);
    var tenggatHtml = dashTenggat(tenggatInfo.sorted);
    h += dashCard("Capaian Keseluruhan", '', ringHtml + tenggatHtml);

    h += '</div>';
    return h;
  }

  // Tampilan Dashboard: Anggota SKI
  function dashAnggota() {
    var valAntrean = STATE.evidens.filter(function(e){ return e.status_eviden === 'u'; }).length;
    var valRevisi = STATE.evidens.filter(function(e){ return e.status_eviden === 'r'; }).length;
    var valLolos = STATE.evidens.filter(function(e){ return ['o', 'a', 'f'].indexOf(e.status_eviden) > -1; }).length;
    var modAntreanCount = STATE.moduls.filter(function(m){
      return STATE.evidens.some(function(e){ return e.id_modul === m.id_modul && e.status_eviden === 'u'; });
    }).length;

    var h = '<div class="dash-kpi-grid">' +
              dashKpi("Antrean Review", valAntrean, "berkas menunggu review", dashIconFile, "#2563eb") +
              dashKpi("Dikembalikan ke PIC", valRevisi, "perlu tindak lanjut", dashIconAlert, "#dc2626") +
              dashKpi("Lolos Review", valLolos, "berkas sesuai indikator", dashIconCheck, "#10b981") +
              dashKpi("Modul Ada Antrean", modAntreanCount, "dari " + STATE.moduls.length + " modul", dashIconFolder, "#7c3aed") +
            '</div>';

    h += '<div class="dash-main-grid">';

    // Left Column: Progres review per modul (hanya modul yang punya berkas)
    var modsWithEv = STATE.moduls.filter(function(m){
      return STATE.evidens.some(function(e){ return e.id_modul === m.id_modul; });
    });
    var leftBody = dashModRows(modsWithEv, function(m){
      var evs = STATE.evidens.filter(function(e){ return e.id_modul === m.id_modul; });
      var lolos = evs.filter(function(e){ return ['o', 'a', 'f'].indexOf(e.status_eviden) > -1; }).length;
      return { done: lolos, total: evs.length, unitLabel: 'berkas lolos' };
    });
    h += dashCard("Progres Review per Modul", '<span class="dash-badge-period"><i></i> Antrean Aktif</span>', leftBody);

    // Right Column: Ring review selesai
    var totalSample = valLolos + valAntrean + valRevisi;
    var pct = totalSample > 0 ? Math.round((valLolos / totalSample) * 100) : 0;
    var legendHtml = dashLegend([
      { label: 'Lolos', count: valLolos, color: '#10b981' },
      { label: 'Antre', count: valAntrean, color: '#2563eb' },
      { label: 'Dikembalikan', count: valRevisi, color: '#dc2626' }
    ]);
    var ringHtml = dashRing(pct, 'berkas lolos review', legendHtml);
    h += dashCard("Review Selesai", '', ringHtml);

    h += '</div>';
    return h;
  }

  // Tampilan Dashboard: Ketua SKI (juga dipakai sebagai default untuk Admin)
  function dashKetua() {
    var terbitMod = STATE.moduls.filter(function(m){ return m.status_template === 'terbit'; }).length;
    var totalMod = STATE.moduls.length;
    var totalInd = STATE.indikators.length;
    var lolosCount = STATE.evidens.filter(function(e){ return ['o', 'a', 'f'].indexOf(e.status_eviden) > -1; }).length;
    var avgKelengkapan = totalInd > 0 ? Math.round((lolosCount / totalInd) * 100) : 0;
    var revisiCount = STATE.evidens.filter(function(e){ return e.status_eviden === 'r'; }).length;
    var tenggatInfo = dashEarliestTenggatInfo(STATE.moduls);

    var h = '<div class="dash-kpi-grid">' +
              dashKpi("Modul Terbit", terbitMod + " / " + totalMod, "modul pengawasan aktif", dashIconFolder, "#2563eb") +
              dashKpi("Kelengkapan Rata-rata", avgKelengkapan + "%", lolosCount + " dari " + totalInd + " indikator", dashIconCheck, "#10b981") +
              dashKpi("Perlu Tindak Lanjut", revisiCount, "berkas revisi di PIC", dashIconAlert, "#dc2626") +
              dashKpi("Tenggat Terdekat", tenggatInfo.val, tenggatInfo.sub, dashIconClock, "#7c3aed") +
            '</div>';

    h += '<div class="dash-main-grid">';

    // Left Column: Progres per modul
    var leftBody = dashModRows(STATE.moduls, function(m){
      var mInds = STATE.indikators.filter(function(i){ return i.id_modul === m.id_modul; });
      var mEvs = STATE.evidens.filter(function(e){ return e.id_modul === m.id_modul; });
      var mLolos = mEvs.filter(function(e){ return ['o', 'a', 'f'].indexOf(e.status_eviden) > -1; }).length;
      return { done: mLolos, total: mInds.length, unitLabel: 'indikator' };
    });
    h += dashCard("Progres per Modul", '<span class="dash-badge-period"><i></i> Pengawasan Internal</span>', leftBody);

    // Right Column: Ring capaian keseluruhan + 4 tenggat mendatang
    // Modul selesai = semua berkasnya berstatus 'f'
    var modSelesai = 0;
    STATE.moduls.forEach(function(m){
      var mInds = STATE.indikators.filter(function(i){ return i.id_modul === m.id_modul; });
      var mEvs = STATE.evidens.filter(function(e){ return e.id_modul === m.id_modul; });
      if (mInds.length > 0 && mEvs.length >= mInds.length && mEvs.every(function(e){ return e.status_eviden === 'f'; })) {
        modSelesai++;
      }
    });
    var modBerjalan = Math.max(0, STATE.moduls.length - modSelesai);
    var legendHtml = dashLegend([
      { label: 'Modul Selesai', count: modSelesai, color: '#10b981' },
      { label: 'Modul Berjalan', count: modBerjalan, color: '#0d9488' }
    ]);
    var ringHtml = dashRing(avgKelengkapan, 'kelengkapan rata-rata', legendHtml);
    var tenggatHtml = dashTenggat(tenggatInfo.sorted);
    h += dashCard("Capaian Keseluruhan", '', ringHtml + tenggatHtml);

    h += '</div>';
    return h;
  }

  // Tampilan Dashboard: Pimpinan
  function dashPimpinan() {
    var totalDepts = STATE.units ? STATE.units.length : 0;
    var totalInd = STATE.indikators.length;
    var lolosCount = STATE.evidens.filter(function(e){ return ['o', 'a', 'f'].indexOf(e.status_eviden) > -1; }).length;
    var avgKelengkapan = totalInd > 0 ? Math.round((lolosCount / totalInd) * 100) : 0;

    var now = new Date();
    var overdueIncomplete = STATE.moduls.filter(function(m){
      if (!m.tenggat_unggah) return false;
      var d = new Date(m.tenggat_unggah.replace(' ', 'T'));
      if (isNaN(d.getTime())) return false;
      var isOverdue = d < now;
      var mInds = STATE.indikators.filter(function(i){ return i.id_modul === m.id_modul; });
      var mEvs = STATE.evidens.filter(function(e){ return e.id_modul === m.id_modul; });
      var mLolos = mEvs.filter(function(e){ return ['o', 'a', 'f'].indexOf(e.status_eviden) > -1; }).length;
      var isComplete = mInds.length > 0 && mLolos >= mInds.length;
      return isOverdue && !isComplete;
    }).length;

    var tenggatInfo = dashEarliestTenggatInfo(STATE.moduls);

    var h = '<div class="dash-kpi-grid">' +
              dashKpi("Departemen", totalDepts, "unit kerja BBPK", dashIconBuilding, "#2563eb") +
              dashKpi("Kelengkapan Rata-rata", avgKelengkapan + "%", lolosCount + " dari " + totalInd + " indikator", dashIconCheck, "#10b981") +
              dashKpi("Lewat Tenggat", overdueIncomplete, "modul belum lengkap", dashIconAlert, "#dc2626") +
              dashKpi("Tenggat Terdekat", tenggatInfo.val, tenggatInfo.sub, dashIconClock, "#7c3aed") +
            '</div>';

    h += '<div class="dash-main-grid">';

    // Left Column: Progres per departemen, lalu progres per modul
    var deptRows = dashModRows(STATE.units, function(u){
      var uMods = STATE.moduls.filter(function(m){ return m.id_unit_pic === u.id_unit; });
      var uInds = STATE.indikators.filter(function(i){
        return uMods.some(function(m){ return m.id_modul === i.id_modul; });
      });
      var uLolos = STATE.evidens.filter(function(e){
        return uMods.some(function(m){ return m.id_modul === e.id_modul; }) && ['o', 'a', 'f'].indexOf(e.status_eviden) > -1;
      }).length;
      return { done: uLolos, total: uInds.length, unitLabel: 'indikator' };
    });

    var modRows = dashModRows(STATE.moduls, function(m){
      var mInds = STATE.indikators.filter(function(i){ return i.id_modul === m.id_modul; });
      var mEvs = STATE.evidens.filter(function(e){ return e.id_modul === m.id_modul; });
      var mLolos = mEvs.filter(function(e){ return ['o', 'a', 'f'].indexOf(e.status_eviden) > -1; }).length;
      return { done: mLolos, total: mInds.length, unitLabel: 'indikator' };
    });

    var leftBody = '<div style="margin-bottom:24px">' +
                     '<div style="font-size:12px;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:12px;letter-spacing:0.04em">Progres per Departemen</div>' +
                     deptRows +
                   '</div>' +
                   '<div>' +
                     '<div style="font-size:12px;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:12px;letter-spacing:0.04em">Rincian per Modul Pengawasan</div>' +
                     modRows +
                   '</div>';
    h += dashCard("Evaluasi Kepatuhan Organisasi", '<span class="dash-badge-period"><i></i> Meja Pimpinan</span>', leftBody);

    // Right Column: Ring capaian keseluruhan + 4 tenggat mendatang
    var legendHtml = dashLegend([
      { label: 'Selesai', count: lolosCount, color: '#10b981' },
      { label: 'Belum Selesai', count: Math.max(0, totalInd - lolosCount), color: '#94a3b8' }
    ]);
    var ringHtml = dashRing(avgKelengkapan, 'kelengkapan rata-rata', legendHtml);
    var tenggatHtml = dashTenggat(tenggatInfo.sorted);
    h += dashCard("Capaian Keseluruhan", '', ringHtml + tenggatHtml);

    h += '</div>';
    return h;
  }

  // Tampilan Dashboard: Itjen (Inspektorat Jenderal)
  function dashItjen() {
    var totalEv = STATE.evidens.length;
    var modWithEv = STATE.moduls.filter(function(m){
      return STATE.evidens.some(function(e){ return e.id_modul === m.id_modul; });
    }).length;

    var lastUploadDate = null;
    STATE.evidens.forEach(function(e){
      if (e.waktu_unggah && (!lastUploadDate || e.waktu_unggah > lastUploadDate)) {
        lastUploadDate = e.waktu_unggah;
      }
    });
    var lastUploadStr = lastUploadDate ? formatDateIndo(lastUploadDate) : '-';

    // KPI (3 cards, no progress, no percentage)
    var h = '<div class="dash-kpi-grid">' +
              dashKpi("Total Berkas Eviden", totalEv, "dokumen terunggah", dashIconFile, "#2563eb") +
              dashKpi("Modul Berisi Berkas", modWithEv, "dari " + STATE.moduls.length + " modul", dashIconFolder, "#10b981") +
              dashKpi("Unggahan Terakhir", lastUploadStr, "aktivitas terbaru", dashIconClock, "#087066") +
            '</div>';

    // Konten Itjen
    var noteHtml = '<div style="background:#f0fdfa;border:1px solid #ccfbf1;border-left:4px solid #087066;border-radius:12px;padding:14px 18px;margin-bottom:20px;display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap">' +
                     '<div>' +
                       '<b style="font-size:13.5px;color:#0f172a">Akses Audit &amp; Pengawasan Independen (Inspektorat Jenderal)</b>' +
                       '<p style="margin:3px 0 0;font-size:12.5px;color:#475569">Untuk memeriksa isi fisik dokumen, mengunduh berkas, atau melihat pratinjau bukti eviden, silakan buka menu <b>Repositori Eviden</b>.</p>' +
                     '</div>' +
                     '<button class="btn sm" onclick="showScreen(\'rep\')" style="background:#087066;padding:8px 16px">Buka Repositori Eviden &rarr;</button>' +
                   '</div>';

    var listHtml = '<div style="display:flex;flex-direction:column;gap:10px">';
    if (STATE.moduls.length === 0) {
      listHtml += '<div style="text-align:center;padding:30px;color:#64748b">Belum ada modul terdaftar.</div>';
    } else {
      STATE.moduls.forEach(function(m){
        var mEvs = STATE.evidens.filter(function(e){ return e.id_modul === m.id_modul; });
        var lastModDate = null;
        mEvs.forEach(function(e){
          if (e.waktu_unggah && (!lastModDate || e.waktu_unggah > lastModDate)) {
            lastModDate = e.waktu_unggah;
          }
        });
        var lastModDateStr = lastModDate ? formatDateIndo(lastModDate) : 'Belum ada berkas';

        listHtml += '<div style="display:flex;align-items:center;justify-content:space-between;gap:14px;padding:12px 16px;background:#f8fafc;border:1px solid #eef2f6;border-radius:12px;flex-wrap:wrap">' +
                      '<div style="min-width:200px;flex:1">' +
                        '<div style="font-size:14px;font-weight:700;color:#0f172a">' + escapeHtml(m.nama_modul) + '</div>' +
                        '<div style="font-size:12px;color:#64748b;margin-top:2px">' +
                          'Unit PIC: <b>' + escapeHtml(m.nama_unit || '-') + '</b> &bull; Status: <span class="tag ' + (m.status_template === 'terbit' ? 't-ok' : 't-wn') + '" style="font-size:10px;padding:1px 6px">' + (m.status_template === 'terbit' ? 'TERBIT' : 'DRAF') + '</span>' +
                        '</div>' +
                      '</div>' +
                      '<div style="text-align:right">' +
                        '<div style="font-weight:700;color:#0f172a">' + mEvs.length + ' Berkas Eviden</div>' +
                        '<div style="font-size:11.5px;color:#64748b">Unggahan Terakhir: ' + escapeHtml(lastModDateStr) + '</div>' +
                      '</div>' +
                    '</div>';
      });
    }
    listHtml += '</div>';

    h += dashCard("Daftar Modul &amp; Riwayat Berkas", '<span class="dash-badge-period"><i></i> Repositori Pengawasan</span>', noteHtml + listHtml);
    return h;
  }

  // Router Dashboard
  function renderDash() {
    var role = (STATE.user && STATE.user.role) ? STATE.user.role : 'ket';
    var h = '';

    if (role === 'pic') {
      h = dashPIC();
    } else if (role === 'ang') {
      h = dashAnggota();
    } else if (role === 'ket') {
      h = dashKetua();
    } else if (role === 'pim') {
      h = dashPimpinan();
    } else if (role === 'itj') {
      h = dashItjen();
    } else if (role === 'adm') {
      h = dashKetua(); // Admin default to Ketua SKI
    } else {
      h = dashKetua();
    }

    document.getElementById("dashC").innerHTML = h;
  }

  // --- 2. MASTER MODUL & TEMPLATE (STUDIO & WORKSPACE ARCHITECTURE) ---
  function renderModul() {
    if (!can('mod', 'l')) {
      showScreen('dash');
      return;
    }
    var canCreate = can('mod', 't') || ['adm', 'ang', 'ket'].indexOf(STATE.user.role) > -1;
    var canEdit = can('mod', 'u') || ['adm', 'ang', 'ket'].indexOf(STATE.user.role) > -1;
    var canDelete = can('mod', 'h') || ['adm', 'ang', 'ket'].indexOf(STATE.user.role) > -1;

    // 1. JIKA ADA MODUL YANG DIPILIH -> TAMPILKAN WORKSPACE HALAMAN PENUH
    if (currentModulId) {
      var curMod = STATE.moduls.find(function(m){ return String(m.id_modul) === String(currentModulId); });
      if (curMod) {
        renderModulWorkspace(curMod, canCreate, canEdit, canDelete);
        return;
      } else {
        currentModulId = null;
      }
    }

    // 2. DEFAULT: TAMPILKAN KATALOG SEMUA MODUL (OVERVIEW LEGA & BERSIH)
    renderModulCatalog(canCreate, canEdit, canDelete);
  }

  // --- 2A. KATALOG DAFTAR MODUL PENGAWASAN ---
  function renderModulCatalog(canCreate, canEdit, canDelete) {
    var totalMod = STATE.moduls.length;
    var terbitMod = STATE.moduls.filter(function(m){ return m.status_template === 'terbit'; }).length;
    var drafMod = STATE.moduls.filter(function(m){ return m.status_template === 'draf'; }).length;

    var h = '';

    
    // 2. Toolbar (Filter, Search & Action)
    h += '<div class="mod-toolbar-card">' +
           '<div class="mod-toolbar-left">' +
             '<div class="mod-search-box">' +
               '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>' +
               '<input type="text" class="mod-search-input" id="modSearchInp" placeholder="Cari modul pengawasan, unit kerja PIC, atau uraian tagihan..." value="' + (modSearchQuery ? escapeAttr(modSearchQuery) : '') + '">' +
             '</div>' +
             '<div class="mod-filter-tabs">' +
               '<button class="mod-filter-btn ' + (modStatusFilter === 'all' ? 'on' : '') + '" data-status="all">Semua Modul (' + totalMod + ')</button>' +
               '<button class="mod-filter-btn ' + (modStatusFilter === 'terbit' ? 'on' : '') + '" data-status="terbit">Terbit (' + terbitMod + ')</button>' +
               '<button class="mod-filter-btn ' + (modStatusFilter === 'draf' ? 'on' : '') + '" data-status="draf">Draf (' + drafMod + ')</button>' +
             '</div>' +
             '<select class="mod-unit-select" id="modUnitFilterSel">' +
               '<option value="all">Semua Unit Kerja PIC</option>' +
               STATE.units.map(function(u){ return '<option value="' + u.id_unit + '" ' + (String(modUnitFilter) === String(u.id_unit) ? 'selected' : '') + '>' + u.nama_unit + '</option>'; }).join('') +
             '</select>' +
           '</div>' +
           '<div>' +
             (canCreate ? '<button class="btn" id="btnPopupCreateMod" style="padding:9px 18px;font-size:13.5px;font-weight:700">+ Tambah Modul Baru</button>' : '') +
           '</div>' +
         '</div>';

    // 3. Modul Cards Grid
    h += '<div class="mod-grid" id="modCardsContainer">';

    STATE.moduls.forEach(function(m){
      var modInds = STATE.indikators.filter(function(i){ return i.id_modul === m.id_modul; });
      var mandCount = modInds.filter(function(i){ return parseInt(i.is_mandatory) === 1; }).length;
      var optCount = modInds.length - mandCount;

      var indsText = modInds.map(function(i){ return i.deskripsi_indikator; }).join(' ');
      var mTypeLabel = 'Dokumen Eviden';

      h += '<div class="mod-card catalog-view is-' + m.status_template + '" ' +
           'data-id="' + m.id_modul + '" ' +
           'data-name="' + escapeAttr(m.nama_modul) + '" ' +
           'data-unit="' + escapeAttr(m.nama_unit) + '" ' +
           'data-unit-id="' + m.id_unit_pic + '" ' +
           'data-status="' + m.status_template + '" ' +
           'data-indicators="' + escapeAttr(indsText) + '">';

      // 1. Top Badges & Actions Row (Matching Mockup)
      h += '<div class="mod-card-top">' +
             '<div class="mod-badge-group">' +
               '<span class="mod-badge-status ' + (m.status_template === 'terbit' ? 'terbit' : 'draf') + '">' +
                 (m.status_template === 'terbit' ? 'TERBIT' : 'DRAF') +
               '</span>' +
               '<span class="mod-badge-type">' + mTypeLabel + '</span>' +
             '</div>' +
             '<div class="mod-top-actions" onclick="event.stopPropagation()">';
      if (canEdit) {
        h += '<button class="mod-icon-btn btnEditModModal" data-id="' + m.id_modul + '" title="Edit Nama &amp; Unit Modul">' +
               '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>' +
             '</button>' +
             '<button class="mod-icon-btn btnUploadTemplate" data-id="' + m.id_modul + '" title="Unggah / Tautkan Template Acuan">' +
               '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>' +
             '</button>';
      }
      if (canDelete) {
        h += '<button class="mod-icon-btn danger btnQuickDeleteMod" data-id="' + m.id_modul + '" title="Hapus Modul">' +
               '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M3 6h18M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>' +
             '</button>';
      }
      h += '</div></div>';

      // 2. Title & ID & Unit PIC
      h += '<div class="mod-title-area">' +
             '<h3 class="mod-card-title-text">' + escapeHtml(m.nama_modul) + '</h3>' +
             '<div class="mod-card-code-text">#mod-' + escapeHtml(m.id_modul) + '</div>' +
             '<div class="mod-card-unit-badge">Unit PIC: ' + escapeHtml(m.nama_unit) + '</div>' +
           '</div>';

      // 3. Document Requirements Stats Row (Wajib & Opsional)
      h += '<div class="mod-req-stats">' +
             '<div class="mod-req-col">' +
               (mandCount > 0 ?
                 '<div class="mod-req-icon" style="color:#16a34a">' +
                   '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/></svg>' +
                 '</div>' +
                 '<div class="mod-req-text">' +
                   '<span class="mod-req-num">' + mandCount + ' Dokumen</span>' +
                   '<span class="mod-req-label">Wajib</span>' +
                 '</div>' :
                 '<div class="mod-req-icon" style="color:#ef4444">' +
                   '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm3.75 10.5a.75.75 0 000-1.5h-7.5a.75.75 0 000 1.5h7.5z" clip-rule="evenodd"/></svg>' +
                 '</div>' +
                 '<div class="mod-req-text">' +
                   '<span class="mod-req-num" style="color:#ef4444">' + mandCount + ' Dokumen</span>' +
                   '<span class="mod-req-label">Wajib</span>' +
                 '</div>'
               ) +
             '</div>' +
             '<div class="mod-req-col">' +
               '<div class="mod-req-text">' +
                 '<span class="mod-req-num">' + optCount + ' Dokumen</span>' +
                 '<span class="mod-req-label">Opsional</span>' +
               '</div>' +
             '</div>' +
           '</div>';

      // 4. Template Reference Box (Mockup style)
      h += '<div class="mod-format-box">' +
             (m.file_referensi ?
               '<div class="mod-format-text" title="' + escapeAttr(m.file_referensi) + '">Template: ' + escapeHtml(m.file_referensi) + '</div>' +
               (canEdit ?
                 '<button class="mod-format-btn btnUploadTemplate" data-id="' + m.id_modul + '" title="Ganti Template Acuan" onclick="event.stopPropagation()">' +
                   '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>' +
                 '</button>' : '') :
               '<div class="mod-format-empty">Belum ada format acuan</div>' +
               (canEdit ?
                 '<button class="mod-format-btn btnUploadTemplate" data-id="' + m.id_modul + '" title="Unggah Template Acuan" onclick="event.stopPropagation()">' +
                   '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="2" x2="12" y2="15"/></svg>' +
                 '</button>' : '')
             ) +
           '</div>';

      // 5. Main Hero Button: "Kelola Modul"
      h += '<div>' +
             '<button class="mod-card-btn-primary btnOpenModWorkspace" data-id="' + m.id_modul + '">' +
               'Kelola Modul' +
             '</button>' +
           '</div>';

      // 6. Sub Actions: "Pengaturan" & "Tarik Draf / Terbitkan"
      h += '<div class="mod-card-sub-actions" onclick="event.stopPropagation()">';
      if (canEdit) {
        h += '<button class="mod-card-btn-outline btnEditModModal" data-id="' + m.id_modul + '">' +
               'Pengaturan' +
             '</button>' +
             '<button class="mod-card-btn-outline btnQuickToggleStatus" data-id="' + m.id_modul + '">' +
               (m.status_template === 'terbit' ? 'Tarik Draf' : 'Terbitkan') +
             '</button>';
      } else {
        h += '<button class="mod-card-btn-outline" style="flex:1;opacity:0.7;cursor:default">' +
               'Status: ' + (m.status_template === 'terbit' ? 'Terbit' : 'Draf') +
             '</button>';
      }
      h += '</div>'; // end mod-card-sub-actions

      h += '</div>'; // end mod-card
    });

    h += '</div>'; // end mod-grid

    // Empty state container
    h += '<div id="modEmptyState" style="display:none;background:var(--card);border:1px dashed var(--bd);border-radius:18px;padding:48px 24px;text-align:center;margin-top:12px">' +
           '<div style="width:54px;height:54px;border-radius:50%;background:var(--pri2);color:var(--pri);display:grid;place-items:center;margin:0 auto 12px">' +
             '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>' +
           '</div>' +
           '<h3 style="margin:0 0 6px;color:var(--dk)">Tidak ada modul yang cocok</h3>' +
           '<p style="color:var(--mut);font-size:13px;margin:0 0 16px">Coba ubah kata kunci pencarian atau bersihkan filter status / unit kerja.</p>' +
           '<button class="btn o sm" id="btnResetModFilter">Reset Filter &amp; Pencarian</button>' +
         '</div>';

    document.getElementById("modRoot").innerHTML = h;

    // Filter cards logic
    function applyFilter() {
      var q = (modSearchQuery || '').toLowerCase();
      var st = modStatusFilter || 'all';
      var un = modUnitFilter || 'all';
      var countVisible = 0;

      document.querySelectorAll('.mod-card').forEach(function(card){
        var name = (card.dataset.name || '').toLowerCase();
        var unit = (card.dataset.unit || '').toLowerCase();
        var status = card.dataset.status || '';
        var unitId = card.dataset.unitId || '';
        var inds = (card.dataset.indicators || '').toLowerCase();

        var matchQ = !q || name.indexOf(q) !== -1 || unit.indexOf(q) !== -1 || inds.indexOf(q) !== -1;
        var matchSt = st === 'all' || status === st;
        var matchUn = un === 'all' || String(unitId) === String(un);

        var isVis = matchQ && matchSt && matchUn;
        card.style.display = isVis ? '' : 'none';
        if (isVis) countVisible++;
      });

      var emptyEl = document.getElementById("modEmptyState");
      if (emptyEl) emptyEl.style.display = countVisible === 0 ? 'block' : 'none';
    }

    applyFilter();

    // Search input listener
    var sInp = document.getElementById("modSearchInp");
    if (sInp) {
      sInp.oninput = function(){
        modSearchQuery = this.value;
        applyFilter();
      };
    }

    // Filter tab buttons
    document.querySelectorAll(".mod-filter-btn").forEach(function(btn){
      btn.onclick = function(){
        modStatusFilter = this.dataset.status;
        document.querySelectorAll(".mod-filter-btn").forEach(function(b){ b.classList.toggle("on", b === btn); });
        applyFilter();
      };
    });

    // Unit filter select
    var uSel = document.getElementById("modUnitFilterSel");
    if (uSel) {
      uSel.onchange = function(){
        modUnitFilter = this.value;
        applyFilter();
      };
    }

    // Reset filter button
    var rBtn = document.getElementById("btnResetModFilter");
    if (rBtn) {
      rBtn.onclick = function(){
        modSearchQuery = '';
        modStatusFilter = 'all';
        modUnitFilter = 'all';
        if (sInp) sInp.value = '';
        if (uSel) uSel.value = 'all';
        document.querySelectorAll(".mod-filter-btn").forEach(function(b){ b.classList.toggle("on", b.dataset.status === 'all'); });
        applyFilter();
      };
    }

    // Open Workspace when clicking Card or Hero Button
    document.querySelectorAll(".btnOpenModWorkspace").forEach(function(btn){
      btn.onclick = function(e){
        e.stopPropagation();
        currentModulId = this.dataset.id;
        renderModul();
        window.scrollTo({top: 0, behavior: 'smooth'});
      };
    });

    document.querySelectorAll(".mod-card.catalog-view").forEach(function(card){
      card.onclick = function(e){
        if (e.target.closest('button') || e.target.closest('.mod-top-actions') || e.target.closest('.mod-card-sub-actions') || e.target.closest('.mod-format-box')) return;
        currentModulId = this.dataset.id;
        renderModul();
        window.scrollTo({top: 0, behavior: 'smooth'});
      };
    });

    // Bind shared actions (Edit, Toggle Status, Delete, Create)
    bindModulSharedActions();
  }

  // --- 2B. WORKSPACE HALAMAN PENUH DETAIL MODUL (FOCUSED STUDIO) ---
  function renderModulWorkspace(curMod, canCreate, canEdit, canDelete) {
    var modInds = STATE.indikators.filter(function(i){ return i.id_modul === curMod.id_modul; });
    var mandCount = modInds.filter(function(i){ return parseInt(i.is_mandatory) === 1; }).length;
    var optCount = modInds.length - mandCount;

    var mTypeLabel = 'Instrumen Dokumen Eviden';
    var isTerbit = curMod.status_template === 'terbit';

    var h = '<div class="mod-workspace">';

    // 1. Navigation & Breadcrumb Bar (Tombol Kembali Besar & Jelas untuk Staf 30-50 Tahun)
    h += '<div class="mod-workspace-nav">' +
           '<button class="btn-back-catalog" id="btnBackToModCatalog">' +
             '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m15 18-6-6 6-6"/></svg>' +
             '<span>Kembali ke Daftar Modul</span>' +
           '</button>' +
           '<div class="mod-workspace-crumb">' +
             '<span style="cursor:pointer" id="crumbCatalogRoot">Katalog Modul SKI</span>' +
             '<span>&rsaquo;</span>' +
             '<span>' + escapeHtml(curMod.nama_unit) + '</span>' +
             '<span>&rsaquo;</span>' +
             '<b>' + escapeHtml(curMod.nama_modul) + '</b>' +
           '</div>' +
         '</div>';

    // 2. Hero Header Card (Spacious, Clear & Comprehensive)
    h += '<div class="mod-workspace-hero">' +
           '<div class="mod-hero-top-row">' +
             '<div style="flex:1;min-width:280px">' +
               '<div style="display:flex;align-items:center;gap:8px;margin-bottom:8px;flex-wrap:wrap">' +
                 '<span class="tag ' + (isTerbit ? 't-ok' : 't-wn') + '" style="font-weight:700;font-size:12px;padding:4px 10px">' +
                   (isTerbit ? 'STATUS: TERBIT (Aktif diisi PIC)' : 'STATUS: DRAF (Internal SKI)') +
                 '</span>' +
                 '<span class="tag t-in" style="font-weight:600;font-size:12px;padding:4px 10px">' + mTypeLabel + '</span>' +
               '</div>' +
               '<h2 class="mod-hero-title">' + escapeHtml(curMod.nama_modul) + '</h2>' +
               '<p style="color:var(--tx);font-size:13.5px;margin:0 0 6px;line-height:1.5">' +
                 'Modul pengawasan ini ditugaskan kepada unit kerja <b>' + escapeHtml(curMod.nama_unit) + '</b>. ' +
                 (isTerbit ?
                   '<span style="color:var(--ok)">Saat jadwal pengawasan dibuka, seluruh butir indikator di bawah akan langsung muncul pada lembar kerja PIC.</span>' :
                   '<span style="color:var(--wn)">Modul berstatus DRAF dan belum terlihat oleh PIC sampai Anda menekan tombol <b>Terbitkan Modul</b>.</span>') +
               '</p>' +
             '</div>' +
             '<div class="mod-hero-actions">';
    if (canEdit) {
      h += '<button class="btn o btnEditModModal" data-id="' + curMod.id_modul + '" style="padding:9px 14px;font-size:13px;font-weight:600">' +
             'Pengaturan Profil' +
           '</button>' +
           '<button class="btn ' + (isTerbit ? 'o' : '') + ' btnQuickToggleStatus" data-id="' + curMod.id_modul + '" style="padding:9px 16px;font-size:13px;font-weight:700">' +
             (isTerbit ? 'Tarik ke Draf' : 'Terbitkan Modul') +
           '</button>';
    }
    if (canDelete) {
      h += '<button class="btn danger o btnQuickDeleteMod" data-id="' + curMod.id_modul + '" style="padding:9px 12px;font-size:13px" title="Hapus Modul">' +
             'Hapus Modul' +
           '</button>';
    }
    h += '</div></div>';

    // Metadata Grid (Clean and text-focused, no redundant icon containers)
    h += '<div class="mod-hero-meta-grid">' +
           '<div class="mod-hero-meta-item">' +
             '<span class="mod-hero-meta-label">Unit Penanggung Jawab:</span>' +
             '<span class="mod-hero-meta-value">' + escapeHtml(curMod.nama_unit) + '</span>' +
           '</div>' +
           '<div class="mod-hero-meta-item">' +
             '<span class="mod-hero-meta-label">Total Butir Tagihan:</span>' +
             '<span class="mod-hero-meta-value" style="color:var(--pri)">' + modInds.length + ' Butir Dokumen</span>' +
           '</div>' +
           '<div class="mod-hero-meta-item">' +
             '<span class="mod-hero-meta-label">Format Tagihan:</span>' +
             '<span class="mod-hero-meta-value">Dokumen Eviden (Berkas / Tautan Cloud)</span>' +
           '</div>' +
           '<div class="mod-hero-meta-item">' +
             '<span class="mod-hero-meta-label">Kode Modul:</span>' +
             '<span class="mod-hero-meta-value">#' + curMod.id_modul + '</span>' +
           '</div>' +
         '</div>';

    h += '</div>'; // end mod-workspace-hero

    // 3. Slot Berkas Format Template Baku SKI (Full Width Card)
    var hasTpl = !!curMod.file_referensi;
    h += '<div class="mod-template-card-full">' +
           '<div style="flex:1;min-width:280px">' +
             '<div style="display:flex;align-items:center;gap:8px;margin-bottom:2px">' +
               '<b style="font-size:14px;color:var(--dk)">Berkas Template / Format Baku Acuan SKI</b>' +
               (hasTpl ? '<span class="tag t-ok" style="font-size:10.5px">Tersedia</span>' : '<span class="tag t-wn" style="font-size:10.5px">Belum Ada</span>') +
             '</div>' +
             '<div style="font-size:12.5px;color:var(--mut)">' +
               (hasTpl ? 'Nama berkas: <b style="color:var(--pri)">' + escapeHtml(curMod.file_referensi) + '</b> (dapat diunduh oleh PIC untuk panduan pengisian).' : 'Unggah berkas acuan (Excel/Word/PDF) agar PIC dapat mengunduh dan menyusun dokumen sesuai standar SKI.') +
             '</div>' +
           '</div>' +
           '<div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap">';
    if (hasTpl) {
      h += '<a href="uploads/templates/' + encodeURIComponent(curMod.file_referensi) + '" download="' + escapeAttr(curMod.file_referensi) + '" target="_blank" class="btn sm o" style="font-size:12.5px;padding:7px 12px;text-decoration:none;display:inline-flex;align-items:center;gap:6px">' +
             '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>' +
             'Unduh Berkas' +
           '</a>';
      if (canEdit || canDelete) {
        h += '<button class="btn sm o btnUploadTemplate" data-id="' + curMod.id_modul + '" data-name="' + escapeAttr(curMod.nama_modul) + '" style="font-size:12.5px;padding:7px 12px">' +
               'Ganti Berkas' +
             '</button>' +
             '<button class="btn sm o btnDeleteTemplate" data-id="' + curMod.id_modul + '" data-name="' + escapeAttr(curMod.nama_modul) + '" style="border-color:#ef4444;color:#ef4444;font-size:12.5px;padding:7px 12px" title="Hapus berkas template acuan">' +
               'Hapus Berkas Template' +
             '</button>';
      }
    } else {
      if (canEdit) {
        h += '<button class="btn sm btnUploadTemplate" data-id="' + curMod.id_modul + '" data-name="' + escapeAttr(curMod.nama_modul) + '" style="font-size:12.5px;padding:7px 14px">' +
               '+ Unggah Format Acuan SKI' +
             '</button>';
      }
    }
    h += '</div></div>';

    // 4. Mini Stats Bar (Ringkasan Butir Tagihan Dokumen Eviden)
    h += '<div class="mod-stats-distribution">' +
           '<div class="mod-dist-card">' +
             '<div class="mod-dist-label">Total Tagihan Dokumen</div>' +
             '<div class="mod-dist-val">' + modInds.length + ' <small style="font-size:12px;font-weight:500;color:var(--mut)">Butir Tagihan</small></div>' +
           '</div>' +
           '<div class="mod-dist-card">' +
             '<div class="mod-dist-label">Wajib Dipenuhi PIC</div>' +
             '<div class="mod-dist-val" style="color:#b91c1c">' + mandCount + ' <small style="font-size:12px;font-weight:500;color:var(--mut)">Butir (100% Kelengkapan)</small></div>' +
           '</div>' +
           '<div class="mod-dist-card">' +
             '<div class="mod-dist-label">Butir Opsional</div>' +
             '<div class="mod-dist-val">' + optCount + ' <small style="font-size:12px;font-weight:500;color:var(--mut)">Butir Tambahan</small></div>' +
           '</div>' +
           '<div class="mod-dist-card">' +
             '<div class="mod-dist-label">Format Acuan SKI</div>' +
             '<div class="mod-dist-val">' + (hasTpl ? '<span style="color:var(--ok)">Tersedia</span>' : '<span style="color:var(--mut);font-weight:500">Belum Ada</span>') + '</div>' +
           '</div>' +
         '</div>';

    // 5. Section Header (Daftar Butir Tagihan)
    h += '<div class="mod-section-header">' +
           '<div>' +
             '<h3 class="mod-section-title">' +
               'Daftar Butir Tagihan &amp; Indikator Penilaian (' + modInds.length + ' Butir)' +
             '</h3>' +
             '<p style="margin:2px 0 0;font-size:13px;color:var(--mut)">Instrumen bukti kepatuhan yang wajib dan/atau disarankan untuk dipenuhi oleh PIC ' + escapeHtml(curMod.nama_unit) + '.</p>' +
           '</div>' +
           '<div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap">' +
             (canDelete && modInds.length > 0 ?
               '<button class="btn sm o" id="btnClearAllInds" data-id="' + curMod.id_modul + '" style="border-color:#ef4444;color:#ef4444;padding:8px 14px;font-size:13px;display:inline-flex;align-items:center;gap:5px" title="Kosongkan seluruh butir tagihan/isi modul">' +
                 '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg> Kosongkan / Hapus Semua Butir' +
               '</button>' : '') +
             (canEdit ? '<button class="btn sm" id="btnScrollToAddInd" style="padding:8px 16px;font-size:13px;font-weight:700">+ Tambah Butir Tagihan</button>' : '') +
           '</div>' +
         '</div>';

    // 6. Indicators Full List
    if (modInds.length === 0) {
      h += '<div style="background:var(--card);border:2px dashed var(--bd);border-radius:14px;padding:36px 20px;text-align:center">' +
             '<h4 style="margin:0 0 6px;color:var(--dk);font-size:16px">Belum Ada Butir Tagihan pada Modul Ini</h4>' +
             '<p style="color:var(--mut);font-size:13px;max-width:540px;margin:0 auto 16px;line-height:1.5">Gunakan formulir di bawah ini untuk menambahkan butir tagihan dokumen eviden pengawasan (berkas fisik / tautan cloud).</p>' +
             (canEdit ? '<button class="btn sm" onclick="document.getElementById(\'studioIndDesc\').focus()">+ Buat Butir Tagihan Sekarang</button>' : '') +
           '</div>';
    } else {
      h += '<div class="mod-ind-full-list">';
      modInds.forEach(function(ind, idx){
        var meta = getInputTypeMeta(ind.input_type || 'file');
        var isMand = parseInt(ind.is_mandatory) === 1;

        h += '<div class="mod-ind-full-item">' +
               '<div class="mod-ind-full-num">' + (idx + 1) + '</div>' +
               '<div class="mod-ind-full-body">' +
                 '<div class="mod-ind-full-meta">' +
                   '<span class="ind-type-badge ' + (meta.badgeClass || meta.type) + '">' + meta.shortLabel + '</span>' +
                   (isMand ?
                     '<span style="color:#b91c1c;font-size:11px;font-weight:700;background:#fef2f2;padding:2px 8px;border-radius:6px;border:1px solid #fecaca" title="Wajib dipenuhi PIC">* Wajib Dipenuhi PIC</span>' :
                     '<span style="color:var(--mut);font-size:11px;background:var(--bg);padding:2px 8px;border-radius:6px;border:1px solid var(--bd)">Opsional</span>') +
                 '</div>' +
                 '<div class="mod-ind-full-text">' + escapeHtml(ind.deskripsi_indikator) + '</div>' +
                 (ind.guide_notes ?
                   '<div class="mod-ind-guide-box">' +
                     '<b>Petunjuk Teknis PIC:</b> ' + escapeHtml(ind.guide_notes) +
                   '</div>' : '') +
               '</div>' +
               '<div class="mod-ind-full-actions">';
        if (canEdit) {
          h += '<button class="btn sm o btnConfigIndModal" data-id="' + ind.id_indikator + '" style="font-size:12px;padding:5px 12px;font-weight:600" title="Atur Tagihan, Panduan PIC &amp; Sifat Wajib">' +
                 'Atur Tagihan' +
               '</button>' +
               '<button class="btn sm o btnQuickEditInd" data-id="' + ind.id_indikator + '" style="font-size:12px;padding:5px 12px" title="Ubah Uraian Teks">' +
                 'Edit Uraian' +
               '</button>';
        }
        if (canDelete) {
          h += '<button class="btn sm o btnDelInd" data-id="' + ind.id_indikator + '" style="border-color:#ef4444;color:#ef4444;font-size:12px;padding:5px 10px;display:inline-flex;align-items:center;gap:4px" title="Hapus butir indikator ini">' +
                 '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg> Hapus' +
               '</button>';
        }
        h += '</div></div>';
      });
      h += '</div>'; // end mod-ind-full-list
    }

    // 7. Studio Form Tambah Butir Tagihan Baru (Designed for 30-50 Staff - Fokus Tipe Dokumen)
    if (canEdit) {
      h += '<div class="mod-studio-add-card" id="modAddStudioBox">' +
             '<div>' +
               '<h3 class="mod-studio-add-title">Tambah Butir Tagihan Dokumen Baru</h3>' +
               '<p style="color:var(--mut);font-size:13px;margin:4px 0 0;line-height:1.4">Tentukan butir tagihan dokumen eviden yang wajib/disarankan untuk diunggah PIC ' + escapeHtml(curMod.nama_unit) + '.</p>' +
             '</div>' +

             // Format Type Indicator (Fokus Tipe Dokumen)
             '<div style="display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;background:var(--pri2);padding:10px 14px;border-radius:10px;border-left:3.5px solid var(--pri)">' +
               '<div>' +
                 '<div style="font-size:11px;font-weight:700;color:var(--pri);text-transform:uppercase">Format Input Tagihan:</div>' +
                 '<b style="font-size:13.5px;color:var(--dk)">Tipe Dokumen (Upload Berkas Fisik / Tautan Cloud)</b>' +
               '</div>' +
               '<span style="font-size:12px;color:var(--tx)">PIC akan mengunggah berkas eviden (PDF, Word, Excel) atau tautan Google Drive / Cloud Link.</span>' +
             '</div>' +

             // Step 1: Description Textarea
             '<div>' +
               '<label style="display:block;font-size:13px;font-weight:700;color:var(--dk);margin-bottom:6px">Langkah 1: Uraian Butir Tagihan Dokumen <span style="color:#ef4444">*</span></label>' +
               '<textarea id="studioIndDesc" style="width:100%;min-height:70px;padding:10px 14px;border:1.5px solid var(--bd);border-radius:10px;font:inherit;font-size:14px;color:var(--dk);box-sizing:border-box" placeholder="Contoh: Laporan Realisasi Anggaran Belanja Modal Triwulan II Tahun Anggaran 2026..."></textarea>' +
             '</div>' +

             // Step 2: Guide Notes
             '<div>' +
               '<label style="display:block;font-size:13px;font-weight:700;color:var(--dk);margin-bottom:6px">Langkah 2: Petunjuk Teknis / Catatan Panduan Pengisian untuk PIC (Opsional)</label>' +
               '<textarea id="studioIndGuide" style="width:100%;min-height:55px;padding:8px 12px;border:1px solid var(--bd);border-radius:10px;font:inherit;font-size:13px;box-sizing:border-box" placeholder="Contoh: Pastikan melampirkan berkas BAST asli yang telah ditandatangani PPK dan Penyedia serta rincian kwitansi pembayaran..."></textarea>' +
               '<div style="font-size:11.5px;color:var(--mut);margin-top:4px">Petunjuk teknis ini akan memandu staf PIC agar mengunggah eviden yang sesuai standar pengawasan.</div>' +
             '</div>' +

             // Step 3: Mandatory Toggle & Submit
             '<div style="display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap;padding-top:4px">' +
               '<label style="display:inline-flex;align-items:center;gap:10px;cursor:pointer;font-weight:700;font-size:13.5px;color:var(--dk)">' +
                 '<input type="checkbox" id="studioIndMandatory" checked style="width:18px;height:18px"> ' +
                 '<span>Wajib Dipenuhi PIC (Mandatory untuk kelengkapan 100%)</span>' +
               '</label>' +
               '<button class="btn" id="btnStudioSaveInd" style="padding:12px 24px;font-size:14px;font-weight:700;border-radius:10px">' +
                 'Simpan Butir Tagihan Dokumen' +
               '</button>' +
             '</div>' +

             // Quick Add Bar for Power Users
             '<div style="border-top:1px dashed var(--bd);padding-top:12px;margin-top:4px;display:flex;align-items:center;gap:8px;font-size:12px;color:var(--mut);flex-wrap:wrap">' +
               '<span style="font-weight:600;color:var(--tx)">Tambah Cepat Butir Dokumen:</span>' +
               '<input type="text" id="inpQuickStudioText" class="mod-quick-add-inp" placeholder="Ketik uraian butir tagihan dokumen lalu tekan Enter..." style="flex:1;min-width:220px">' +
               '<button class="btn sm" id="btnQuickStudioAdd" style="padding:6px 14px;font-size:12px;font-weight:600">+ Tambah</button>' +
             '</div>' +

           '</div>'; // end mod-studio-add-card
    }

    h += '</div>'; // end mod-workspace

    document.getElementById("modRoot").innerHTML = h;

    // Back Button Handler
    var btnBack = document.getElementById("btnBackToModCatalog");
    if (btnBack) {
      btnBack.onclick = function(){
        currentModulId = null;
        renderModul();
        window.scrollTo({top: 0, behavior: 'smooth'});
      };
    }
    var crumbRoot = document.getElementById("crumbCatalogRoot");
    if (crumbRoot) {
      crumbRoot.onclick = function(){
        currentModulId = null;
        renderModul();
        window.scrollTo({top: 0, behavior: 'smooth'});
      };
    }

    // Scroll To Studio Add Box Button
    var btnScroll = document.getElementById("btnScrollToAddInd");
    if (btnScroll) {
      btnScroll.onclick = function(){
        var box = document.getElementById("modAddStudioBox");
        if (box) {
          box.scrollIntoView({behavior: 'smooth'});
          var desc = document.getElementById("studioIndDesc");
          if (desc) desc.focus();
        }
      };
    }

    // Studio Save Handler (Always File / Dokumen)
    var selectedStudioType = 'file';

    // Studio Save Button
    var btnStudioSave = document.getElementById("btnStudioSaveInd");
    if (btnStudioSave) {
      btnStudioSave.onclick = function(){
        var desc = (document.getElementById("studioIndDesc").value || '').trim();
        var guide = (document.getElementById("studioIndGuide").value || '').trim();
        var isMand = document.getElementById("studioIndMandatory").checked ? 1 : 0;
        if (!desc) {
          alert("Silakan tuliskan uraian butir tagihan dokumen terlebih dahulu!");
          document.getElementById("studioIndDesc").focus();
          return;
        }

        var fd = new FormData();
        fd.append('action', 'create_indikator');
        fd.append('id_modul', curMod.id_modul);
        fd.append('deskripsi_indikator', desc);
        fd.append('input_type', 'file');
        fd.append('guide_notes', guide);
        fd.append('is_mandatory', isMand);

        btnStudioSave.disabled = true;
        btnStudioSave.textContent = "Menyimpan Butir Dokumen...";

        fetch('ajax.php', { method: 'POST', body: fd }).then(function(r){ return r.json(); }).then(function(res){
          toast(res.message);
          if (res.success) {
            fetchInit(function(){ renderModul(); });
          } else {
            btnStudioSave.disabled = false;
            btnStudioSave.textContent = "Simpan Butir Tagihan Dokumen";
          }
        }).catch(function(e){
          alert("Gagal menyimpan: " + e);
          btnStudioSave.disabled = false;
          btnStudioSave.textContent = "Simpan Butir Tagihan Dokumen";
        });
      };
    }

    // Quick Studio Add Input
    function submitQuickStudio() {
      var inp = document.getElementById("inpQuickStudioText");
      var txt = (inp ? inp.value : '').trim();
      var typ = 'file';
      if (!txt) { alert("Tulis uraian butir tagihan dokumen terlebih dahulu!"); return; }

      var fd = new FormData();
      fd.append('action', 'create_indikator');
      fd.append('id_modul', curMod.id_modul);
      fd.append('deskripsi_indikator', txt);
      fd.append('input_type', typ);
      fd.append('is_mandatory', 1);

      fetch('ajax.php', { method: 'POST', body: fd }).then(function(r){ return r.json(); }).then(function(res){
        toast(res.message);
        if (res.success) fetchInit(function(){ renderModul(); });
      });
    }

    var btnQuickStudio = document.getElementById("btnQuickStudioAdd");
    if (btnQuickStudio) btnQuickStudio.onclick = submitQuickStudio;

    var inpQuickStudio = document.getElementById("inpQuickStudioText");
    if (inpQuickStudio) {
      inpQuickStudio.onkeydown = function(e){
        if (e.key === "Enter") {
          e.preventDefault();
          submitQuickStudio();
        }
      };
    }

    // Quick Edit Text Handler for Staff
    document.querySelectorAll(".btnQuickEditInd").forEach(function(b){
      b.onclick = function(){
        var id = this.dataset.id;
        var ind = STATE.indikators.find(function(i){ return String(i.id_indikator) === String(id); });
        if (!ind) return;
        var newText = prompt("Ubah teks uraian butir tagihan/indikator:", ind.deskripsi_indikator);
        if (newText === null) return;
        newText = newText.trim();
        if (!newText) { alert("Uraian tagihan tidak boleh kosong!"); return; }

        var fd = new FormData();
        fd.append('action', 'update_indikator');
        fd.append('id_indikator', id);
        fd.append('deskripsi_indikator', newText);
        fetch('ajax.php', { method: 'POST', body: fd }).then(function(r){ return r.json(); }).then(function(res){
          toast(res.message);
          if (res.success) {
            ind.deskripsi_indikator = newText;
            renderModul();
          }
        });
      };
    });

    // Delete Indicator Handler
    document.querySelectorAll(".btnDelInd").forEach(function(b){
      b.onclick = function(){
        if (!confirm("Hapus butir indikator tagihan ini? Seluruh eviden terkait butir ini juga akan terhapus.")) return;
        var fd = new FormData();
        fd.append('action', 'delete_indikator');
        fd.append('id_indikator', this.dataset.id);
        fetch('ajax.php', { method: 'POST', body: fd }).then(function(r){ return r.json(); }).then(function(res){
          toast(res.message);
          if (res.success) fetchInit(function(){ renderModul(); });
        });
      };
    });

    // Clear All Indicators (Kosongkan Seluruh Isi Modul) Handler
    var btnClearInds = document.getElementById("btnClearAllInds");
    if (btnClearInds) {
      btnClearInds.onclick = function(){
        var mId = this.dataset.id;
        var curMod = STATE.moduls.find(function(m){ return String(m.id_modul) === String(mId); });
        var mName = curMod ? curMod.nama_modul : 'modul ini';
        if (!confirm("Apakah Anda yakin ingin MENGHAPUS SELURUH BUTIR TAGIHAN (isi modul) pada modul '" + mName + "'?\n\nSemua indikator dan riwayat eviden terkait butir tagihan modul ini akan dibersihkan.")) return;
        var fd = new FormData();
        fd.append('action', 'clear_module_indicators');
        fd.append('id_modul', mId);
        fetch('ajax.php', { method: 'POST', body: fd }).then(function(r){ return r.json(); }).then(function(res){
          toast(res.message);
          if (res.success) fetchInit(function(){ renderModul(); });
        });
      };
    }

    // Bind shared actions (Edit, Toggle Status, Delete, Template, Config)
    bindModulSharedActions();
  }

  // --- 2C. SHARED EVENT HANDLERS FOR MODUL & INDIKATOR ---
  function bindModulSharedActions() {
    var canEdit = can('mod', 'u');
    var canDelete = can('mod', 'h');

    // Configuration Modal for Dynamic Indicator Tagihan (SRS v1.0)
    function openConfigIndicatorModal(indId) {
      var ind = STATE.indikators.find(function(i){ return String(i.id_indikator) === String(indId); });
      if (!ind) return;
      var curMod = STATE.moduls.find(function(m){ return String(m.id_modul) === String(ind.id_modul); });
      var curType = ind.input_type || 'file';
      var isMand = parseInt(ind.is_mandatory) === 1;

      var bodyHtml = '<div style="font-size:13.5px">' +
        '<div style="background:var(--pri2);padding:12px 16px;border-radius:12px;margin-bottom:16px">' +
          '<div style="font-size:11px;font-weight:700;color:var(--pri);text-transform:uppercase">Modul: ' + (curMod ? escapeAttr(curMod.nama_modul) : '-') + '</div>' +
          '<b style="font-size:15px;color:var(--dk)">Konfigurasi Butir Tagihan Indikator</b>' +
        '</div>' +
        '<div style="margin-bottom:14px">' +
          '<label style="display:block;font-weight:700;margin-bottom:6px">Uraian / Deskripsi Butir Tagihan: <span style="color:#ef4444">*</span></label>' +
          '<textarea id="cfgIndDesc" style="width:100%;min-height:60px;border:1.5px solid var(--bd);border-radius:10px;padding:10px;font:inherit;font-size:13.5px;box-sizing:border-box">' + escapeAttr(ind.deskripsi_indikator) + '</textarea>' +
        '</div>' +
        '<div style="margin-bottom:14px">' +
          '<label style="display:block;font-weight:700;margin-bottom:6px">Tipe Tagihan:</label>' +
          '<div style="background:var(--pri2);color:var(--pri);padding:10px 14px;border-radius:10px;font-size:13px;font-weight:700;display:flex;align-items:center;justify-content:space-between;gap:8px">' +
            '<span>Tipe Dokumen (Upload Berkas Fisik / Tautan Cloud)</span>' +
            '<span class="tag t-ok" style="font-size:11px">Aktif</span>' +
          '</div>' +
          '<input type="hidden" id="cfgIndType" value="file">' +
          '<div style="margin-top:6px;font-size:12px;color:var(--mut);line-height:1.4">Slot upload berkas fisik (PDF, Word, Excel) atau tautan Google Drive / Cloud Link.</div>' +
        '</div>' +
        '<div style="margin-bottom:14px">' +
          '<label style="display:block;font-weight:700;margin-bottom:6px">Petunjuk Teknis / Catatan Panduan Pengisian untuk PIC:</label>' +
          '<textarea id="cfgIndNotes" style="width:100%;min-height:60px;border:1px solid var(--bd);border-radius:10px;padding:10px;font:inherit;font-size:13px;box-sizing:border-box" placeholder="Contoh: Pastikan melampirkan berkas BAST dan rincian realisasi belanja modal...">' + escapeAttr(ind.guide_notes || '') + '</textarea>' +
          '<small style="color:var(--mut);font-size:11.5px">Petunjuk ini akan muncul pada kartu formulir PIC untuk memandu pengisian data secara tepat.</small>' +
        '</div>' +
        '<div style="margin-bottom:10px">' +
          '<label style="display:inline-flex;align-items:center;gap:10px;font-weight:700;cursor:pointer;font-size:13.5px">' +
            '<input type="checkbox" id="cfgIndMandatory" ' + (isMand ? 'checked' : '') + ' style="width:18px;height:18px"> ' +
            '<span>Wajib Dipenuhi (Mandatory untuk kelengkapan 100%)</span>' +
          '</label>' +
        '</div>' +
      '</div>';

      openModal({
        title: "Konfigurasi Butir Tagihan: #" + ind.id_indikator,
        body: bodyHtml,
        okText: "Simpan Konfigurasi",
        cancelText: "Batal",
        width: "600px",
        onOk: function(){
          var d = document.getElementById("cfgIndDesc").value.trim();
          var t = 'file';
          var n = document.getElementById("cfgIndNotes").value.trim();
          var m = document.getElementById("cfgIndMandatory").checked ? 1 : 0;
          if (!d) { alert("Deskripsi indikator tidak boleh kosong!"); return; }

          var fd = new FormData();
          fd.append('action', 'save_indicator_config');
          fd.append('id_indikator', ind.id_indikator);
          fd.append('deskripsi_indikator', d);
          fd.append('input_type', 'file');
          fd.append('guide_notes', n);
          fd.append('is_mandatory', m);

          fetch('ajax.php', { method: 'POST', body: fd }).then(function(r){ return r.json(); }).then(function(res){
            toast(res.message);
            closeModal();
            if (res.success) {
              ind.deskripsi_indikator = d;
              ind.input_type = 'file';
              ind.guide_notes = n;
              ind.is_mandatory = m;
              fetchInit(function(){ renderModul(); });
            }
          });
        }
      });
    }

    document.querySelectorAll(".btnConfigIndModal").forEach(function(b){
      b.onclick = function(){ openConfigIndicatorModal(this.dataset.id); };
    });

    // Template Upload trigger
    var currentUploadTemplateModulId = null;
    var finTemplate = document.getElementById("finModTemplate");

    document.querySelectorAll(".btnUploadTemplate").forEach(function(b){
      b.onclick = function(e){
        e.stopPropagation();
        currentUploadTemplateModulId = this.dataset.id;
        if (finTemplate) {
          finTemplate.value = '';
          finTemplate.click();
        }
      };
    });

    if (finTemplate) {
      finTemplate.onchange = function(){
        if (!this.files || !this.files[0] || !currentUploadTemplateModulId) return;
        var file = this.files[0];
        var fd = new FormData();
        fd.append('action', 'upload_template');
        fd.append('id_modul', currentUploadTemplateModulId);
        fd.append('template_file', file);
        toast("Mengunggah berkas template acuan...");
        fetch('ajax.php', { method: 'POST', body: fd })
          .then(function(r){ return r.json(); })
          .then(function(res){
            toast(res.message);
            if (res.success) fetchInit(function(){ renderModul(); });
          })
          .catch(function(err){
            toast("Gagal mengunggah template: " + err);
          });
      };
    }

    // Template Delete trigger
    document.querySelectorAll(".btnDeleteTemplate").forEach(function(b){
      b.onclick = function(e){
        e.stopPropagation();
        var id = this.dataset.id;
        var name = this.dataset.name || 'modul ini';
        if (!confirm("Hapus berkas template acuan untuk modul '" + name + "'?")) return;
        var fd = new FormData();
        fd.append('action', 'delete_template');
        fd.append('id_modul', id);
        fetch('ajax.php', { method: 'POST', body: fd })
          .then(function(r){ return r.json(); })
          .then(function(res){
            toast(res.message);
            if (res.success) fetchInit(function(){ renderModul(); });
          });
      };
    });

    // Edit Modul Modal Popup (Including module_type & scoring_threshold KKR)
    document.querySelectorAll(".btnEditModModal").forEach(function(b){
      b.onclick = function(e){
        e.stopPropagation();
        var idMod = this.dataset.id;
        var curMod = STATE.moduls.find(function(m){ return String(m.id_modul) === String(idMod); });
        if (!curMod) return;

        var mType = curMod.module_type || 'document_verification';
        var mThresh = curMod.scoring_threshold !== undefined && curMod.scoring_threshold !== null ? curMod.scoring_threshold : 80;

        var formHtml = '<div style="font-size:13.5px">' +
          '<label style="display:block;margin-bottom:6px;font-weight:700">Nama Modul Pengawasan</label>' +
          '<input id="mEditModName" class="srch" style="width:100%;margin-bottom:14px;font-size:14px;padding:9px" value="' + escapeAttr(curMod.nama_modul) + '">' +
          '<label style="display:block;margin-bottom:6px;font-weight:700">Unit Kerja PIC Penanggung Jawab</label>' +
          '<select id="mEditModUnit" class="fl" style="width:100%;margin-bottom:14px;font-size:14px;padding:9px">' +
            STATE.units.map(function(u){
              return '<option value="' + u.id_unit + '" ' + (u.id_unit === curMod.id_unit_pic ? 'selected' : '') + '>' + u.nama_unit + '</option>';
            }).join('') +
          '</select>' +
          '<input type="hidden" id="mEditModType" value="document_verification">' +
          '<input type="hidden" id="mEditModThreshold" value="' + mThresh + '">' +
          '<label style="display:block;margin-bottom:6px;font-weight:700">Status Modul Pengawasan</label>' +
          '<select id="mEditModStatus" class="fl" style="width:100%;margin-bottom:14px;font-size:14px;padding:9px">' +
            '<option value="terbit" ' + (curMod.status_template === 'terbit' ? 'selected' : '') + '>TERBIT (Aktif &amp; Siap Diisi PIC)</option>' +
            '<option value="draf" ' + (curMod.status_template === 'draf' ? 'selected' : '') + '>DRAF (Penyusunan Internal SKI)</option>' +
          '</select>' +
          '<label style="display:block;margin-bottom:6px;font-weight:700">Unggah / Ganti Berkas Template Acuan (Opsional)</label>' +
          (curMod.file_referensi ? '<div style="margin-bottom:6px;font-size:12.5px;color:var(--pri)">Berkas template saat ini: <b>' + escapeAttr(curMod.file_referensi) + '</b></div>' : '<div style="margin-bottom:6px;font-size:12.5px;color:var(--mut)">Belum ada berkas template acuan.</div>') +
          '<input type="file" id="mEditModFile" class="fl" style="width:100%;margin-bottom:12px" accept=".xlsx,.xls,.docx,.doc,.pdf,.csv,.zip,.pptx">' +
          '<p style="color:var(--mut);font-size:12px;margin:0">Pastikan format template baku sesuai dengan instrumen kepatuhan yang ditugaskan ke PIC.</p>' +
        '</div>';

        openModal({
          title: "Pengaturan Modul: " + curMod.nama_modul,
          body: formHtml,
          okText: "Simpan Perubahan",
          cancelText: "Batal",
          onOk: function(){
            var nm = document.getElementById("mEditModName").value.trim();
            var un = document.getElementById("mEditModUnit").value;
            var st = document.getElementById("mEditModStatus").value;
            var mt = document.getElementById("mEditModType").value;
            var th = document.getElementById("mEditModThreshold").value;
            var fInp = document.getElementById("mEditModFile");
            if (!nm) { alert("Nama modul wajib diisi!"); return; }
            var fd = new FormData();
            fd.append('action', 'update_modul');
            fd.append('id_modul', idMod);
            fd.append('nama_modul', nm);
            fd.append('id_unit_pic', un);
            fd.append('status_template', st);
            fd.append('module_type', mt);
            fd.append('scoring_threshold', th);
            if (fInp && fInp.files && fInp.files[0]) {
              fd.append('template_file', fInp.files[0]);
            }
            fetch('ajax.php', { method: 'POST', body: fd }).then(function(r){ return r.json(); }).then(function(res){
              toast(res.message);
              closeModal();
              if (res.success) fetchInit(function(){ renderModul(); });
            });
          }
        });
      };
    });

    // Quick Toggle Status (Terbitkan / Drafkan)
    document.querySelectorAll(".btnQuickToggleStatus").forEach(function(b){
      b.onclick = function(e){
        e.stopPropagation();
        var idMod = this.dataset.id;
        var curMod = STATE.moduls.find(function(m){ return String(m.id_modul) === String(idMod); });
        if (!curMod) return;
        var nextSt = curMod.status_template === 'terbit' ? 'draf' : 'terbit';
        var fd = new FormData();
        fd.append('action', 'update_modul');
        fd.append('id_modul', idMod);
        fd.append('nama_modul', curMod.nama_modul);
        fd.append('id_unit_pic', curMod.id_unit_pic);
        fd.append('status_template', nextSt);
        fetch('ajax.php', { method: 'POST', body: fd }).then(function(r){ return r.json(); }).then(function(res){
          toast(nextSt === 'terbit' ? 'Modul berhasil DITERBITKAN!' : 'Modul dikembalikan ke status DRAF.');
          if (res.success) fetchInit(function(){ renderModul(); });
        });
      };
    });

    // Quick Delete Modul
    document.querySelectorAll(".btnQuickDeleteMod").forEach(function(b){
      b.onclick = function(e){
        e.stopPropagation();
        var idMod = this.dataset.id;
        var curMod = STATE.moduls.find(function(m){ return String(m.id_modul) === String(idMod); });
        var modName = curMod ? curMod.nama_modul : 'modul ini';
        if (!confirm("Hapus modul '" + modName + "' beserta seluruh butir indikator dan riwayat evidennya?")) return;
        var fd = new FormData();
        fd.append('action', 'delete_modul');
        fd.append('id_modul', idMod);
        fetch('ajax.php', { method: 'POST', body: fd }).then(function(r){ return r.json(); }).then(function(res){
          toast(res.message);
          if (res.success) {
            if (currentModulId === idMod) currentModulId = null;
            fetchInit(function(){ renderModul(); });
          }
        });
      };
    });

    // Create Modul Modal
    var btnCreate = document.getElementById("btnPopupCreateMod");
    if (btnCreate) {
      btnCreate.onclick = function(){
        var formHtml = '<div style="font-size:13.5px">' +
                       '<label style="display:block;margin-bottom:6px;font-weight:700">Nama Modul Pengawasan</label>' +
                       '<input id="mNewModName" class="srch" style="width:100%;margin-bottom:14px;font-size:14px;padding:9px" placeholder="mis. Pengendalian Gratifikasi (UPG)">' +
                       '<label style="display:block;margin-bottom:6px;font-weight:700">Unit PIC Pengisi Dokumen</label>' +
                       '<select id="mNewModUnit" class="fl" style="width:100%;margin-bottom:14px;font-size:14px;padding:9px">' +
                         STATE.units.map(function(u){ return '<option value="' + u.id_unit + '">' + u.nama_unit + '</option>'; }).join('') +
                       '</select>' +
                       '<input type="hidden" id="mNewModType" value="document_verification">' +
                       '<input type="hidden" id="mNewModThreshold" value="80">' +
                       '<label style="display:block;margin-bottom:6px;font-weight:700">Unggah Berkas Template / Format Acuan (Opsional)</label>' +
                       '<div style="font-size:12px;color:var(--mut);margin-bottom:6px">Format: Excel (.xlsx, .xls), Word (.docx, .doc), PDF (.pdf). Maks 35 MB.</div>' +
                       '<input type="file" id="mNewModFile" class="fl" style="width:100%;margin-bottom:14px" accept=".xlsx,.xls,.docx,.doc,.pdf,.csv,.zip,.pptx">' +
                       '<p style="color:var(--mut);font-size:12px;margin:0">Modul akan otomatis dibuat sebagai status <b>DRAF</b> dan langsung membuka lembar kerja penyusunan butir indikator.</p>' +
                       '</div>';

        openModal({
          title: "Tambah Modul Pengawasan Baru",
          body: formHtml,
          okText: "Simpan &amp; Buka Modul",
          cancelText: "Batal",
          onOk: function(){
            var nm = document.getElementById("mNewModName").value.trim();
            var un = document.getElementById("mNewModUnit").value;
            var mt = document.getElementById("mNewModType").value;
            var th = document.getElementById("mNewModThreshold").value;
            var fInp = document.getElementById("mNewModFile");
            if (!nm) { alert("Nama modul wajib diisi!"); return; }
            var fd = new FormData();
            fd.append('action', 'create_modul');
            fd.append('nama_modul', nm);
            fd.append('id_unit_pic', un);
            fd.append('module_type', mt);
            fd.append('scoring_threshold', th);
            if (fInp && fInp.files && fInp.files[0]) {
              fd.append('template_file', fInp.files[0]);
            }
            fetch('ajax.php', { method: 'POST', body: fd }).then(function(r){ return r.json(); }).then(function(res){
              toast(res.message);
              closeModal();
              if (res.success) {
                if (res.id_modul) {
                  currentModulId = res.id_modul; // Langsung masuk ke lembar kerja modul baru
                }
                fetchInit(function(){ renderModul(); });
              }
            });
          }
        });
      };
    }
  }

  // --- 3. JADWAL & PERIODE ---
  function renderJadwal() {
    var canCreate = can('jdw', 't');
    var h = '';

    if (canCreate) {
      h += '<div style="background:var(--bg);padding:14px;border-radius:14px;border:1px solid var(--bd);margin:14px 0">';
      h += '<h3 style="margin:0 0 10px;font-size:14px;color:var(--dk)">Buka Periode Pengawasan Baru</h3>';
      h += '<div class="grid g2">';
      h += '<div><label style="font-size:12px;color:var(--mut);font-weight:600">Nama Periode</label><input id="jdwPer" class="srch" value="Oktober 2026" style="width:100%"></div>';
      h += '<div><label style="font-size:12px;color:var(--mut);font-weight:600">Siklus</label><select id="jdwSiklus" class="fl" style="width:100%"><option>Bulanan</option><option>Triwulan</option><option>Semester</option><option>Tahunan</option></select></div>';
      h += '<div><label style="font-size:12px;color:var(--mut);font-weight:600">Tenggat Unggah PIC (Auto-Lock)</label><input id="jdwTenggat" type="date" class="srch" value="2026-11-10" style="width:100%"></div>';
      h += '<div><label style="font-size:12px;color:var(--mut);font-weight:600">Mulai Penilaian SKI</label><input id="jdwMulai" type="date" class="srch" value="2026-11-02" style="width:100%"></div>';
      h += '</div>';

      h += '<div style="margin-top:14px"><button class="btn" id="btnPubJdw">Terbitkan Jadwal Aktif</button></div>';
      h += '</div>';
    }

    // Filter modul aktif vs modul draf
    var activeModuls = STATE.moduls.filter(function(m){ return m.status_template === 'terbit' && !!m.id_jadwal; });
    var drafModuls = STATE.moduls.filter(function(m){ return m.status_template !== 'terbit'; });

    h += '<h3 style="margin-top:22px;display:flex;align-items:center;gap:8px">Jadwal Pengawasan yang Sedang Berjalan <span class="tag t-ok" style="font-size:11px;font-weight:700">' + activeModuls.length + ' Modul Aktif</span></h3>';
    h += '<div class="tw"><table><tr><th>Nama Modul</th><th>Unit PIC</th><th>Status Jadwal</th><th>Tenggat Unggah PIC</th><th>Mulai Penilaian SKI</th><th>Status Kunci</th></tr>';
    if (activeModuls.length === 0) {
      h += '<tr><td colspan="6" style="text-align:center;padding:24px;color:var(--mut)"><div style="margin-bottom:6px"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></div>Belum ada jadwal aktif.</td></tr>';
    } else {
      activeModuls.forEach(function(m){
        var isLock = parseInt(m.is_locked) === 1;
        h += '<tr><td><b>' + escapeHtml(m.nama_modul) + '</b></td><td>' + escapeHtml(m.nama_unit || '-') + '</td>' +
             '<td><span class="tag t-ok" style="font-weight:600">Aktif Diterbitkan</span></td>' +
             '<td>' + (m.tenggat_unggah || '-') + '</td><td>' + (m.mulai_penilaian || '-') + '</td>' +
             '<td><span class="tag ' + (isLock ? 't-gy' : 't-ok') + '">' + (isLock ? 'Terkunci (Jatuh Tempo)' : 'Bebas Diubah PIC') + '</span></td></tr>';
      });
    }
    h += '</table></div>';

    // Panel modul draf / nonaktif jika ada
    if (drafModuls.length > 0) {
      h += '<div style="margin-top:16px;background:var(--bg);border:1px dashed var(--bd);border-radius:12px;padding:12px 16px">' +
           '<div style="font-size:12.5px;font-weight:700;color:var(--dk);margin-bottom:8px;display:flex;align-items:center;gap:8px">' +
           '<span class="tag t-wn" style="font-size:10.5px;font-weight:700">DRAF / NONAKTIF</span>' +
           'Modul Tidak Aktif / Belum Diterbitkan (' + drafModuls.length + ' Modul)' +
           '</div>' +
           '<div style="display:flex;gap:8px;flex-wrap:wrap">' +
           drafModuls.map(function(m){
             return '<span class="tag t-gy" style="font-size:12px;padding:4px 10px"><b>' + escapeHtml(m.nama_modul) + '</b> <span class="mut">(' + escapeHtml(m.nama_unit || '-') + ')</span></span>';
           }).join('') +
           '</div>' +
           '</div>';
    }

    document.getElementById("jdwC").innerHTML = h;

    if (canCreate) {
      var btnPub = document.getElementById("btnPubJdw");
      if (btnPub) {
        btnPub.onclick = function(){
          var modulOptions = STATE.moduls.map(function(m){
            var checked = m.status_template === 'terbit' ? ' checked' : '';
            return '<label style="display:flex;align-items:center;gap:8px;padding:10px 12px;border:1px solid var(--bd);border-radius:8px;cursor:pointer">' +
              '<input type="checkbox" class="cbJdwMod" value="' + escapeAttr(m.id_modul) + '"' + checked + '>' +
              '<span><b>' + escapeHtml(m.nama_modul) + '</b> <small class="mut">' + escapeHtml(m.nama_unit || '') + '</small></span>' +
              '</label>';
          }).join('');
          openModal({
            title: "Pilih Modul",
            body: '<div class="grid" style="gap:8px;max-height:55vh;overflow-y:auto">' + modulOptions + '</div>',
            footerHtml: '<button class="btn o sm" id="mJdwCancel">Batal</button><button class="btn sm" id="mJdwPublish">Terbitkan</button>',
            width: "520px"
          });
          document.getElementById("mJdwCancel").onclick = closeModal;
          document.getElementById("mJdwPublish").onclick = function(){
            var modIds = [].map.call(document.querySelectorAll("#modalBody .cbJdwMod:checked"), function(x){ return x.value; });
            if (modIds.length === 0) {
              alert("Pilih minimal satu modul.");
              return;
            }

            var submitBtn = this;
            submitBtn.disabled = true;
            submitBtn.textContent = "Menerbitkan...";
            var fd = new FormData();
            fd.append('action', 'publish_jadwal');
            fd.append('periode', document.getElementById("jdwPer").value);
            fd.append('siklus', document.getElementById("jdwSiklus").value);
            fd.append('tenggat_unggah', document.getElementById("jdwTenggat").value);
            fd.append('mulai_penilaian', document.getElementById("jdwMulai").value);
            fd.append('modul_ids', JSON.stringify(modIds));
            fetch('ajax.php', { method: 'POST', body: fd }).then(function(r){ return r.json(); }).then(function(res){
              toast(res.message);
              if (res.success) {
                closeModal();
                fetchInit(function(){ renderJadwal(); });
              } else {
                submitBtn.disabled = false;
                submitBtn.textContent = "Terbitkan";
              }
            }).catch(function(err){
              submitBtn.disabled = false;
              submitBtn.textContent = "Terbitkan";
              alert("Terjadi kesalahan jaringan: " + err);
            });
          };
        };
      }
    }
  }

  // --- 4. UPLOAD EVIDEN (PIC & SUPERADMIN) - REDESIGN SESUAI SCREENSHOT ---
  function getModulCode(m) {
    if (m.kode_modul) return '#' + m.kode_modul;
    var name = (m.nama_modul || '').trim();
    var words = name.split(/\s+/).filter(Boolean);
    var code = '';
    if (words.length >= 2) {
      code = words.slice(0, 3).map(function(w){ return w.replace(/[^a-zA-Z0-9]/g, '').substr(0, 1).toUpperCase(); }).join('');
    } else if (words.length === 1) {
      code = words[0].replace(/[^a-zA-Z0-9]/g, '').substr(0, 3).toUpperCase();
    }
    if (!code || code.length < 2) code = 'MOD';
    var idSuffix = m.id_modul ? m.id_modul.replace(/[^a-zA-Z0-9]/g, '').substr(-4).toUpperCase() : '01';
    return '#' + code + '-2026-' + idSuffix;
  }

  function getModulEvidenStats(m) {
    var modInds = STATE.indikators.filter(function(i){ return i.id_modul === m.id_modul; });
    var totalInd = modInds.length;
    var fulfilledInds = modInds.filter(function(ind){
      var ev = STATE.evidens.find(function(e){ return e.id_indikator === ind.id_indikator; });
      return ev && ev.status_eviden !== 'n' && ev.status_eviden !== 'r';
    });
    var fulfilledCount = fulfilledInds.length;
    var pct = totalInd > 0 ? Math.round((fulfilledCount / totalInd) * 100) : 0;

    var revisiEv = STATE.evidens.find(function(e){
      return e.id_modul === m.id_modul && (e.status_eviden === 'r' || (e.status_kesesuaian === 'tidak_sesuai' && e.status_eviden !== 's'));
    });
    if (!revisiEv) {
      modInds.forEach(function(ind){
        if (revisiEv) return;
        var ev = STATE.evidens.find(function(e){ return e.id_indikator === ind.id_indikator; });
        if (ev && (ev.status_eviden === 'r' || ev.status_kesesuaian === 'tidak_sesuai')) {
          revisiEv = ev;
        }
      });
    }

    var isSelesai = totalInd > 0 && fulfilledCount === totalInd && modInds.every(function(ind){
      var ev = STATE.evidens.find(function(e){ return e.id_indikator === ind.id_indikator; });
      return ev && (ev.status_eviden === 'o' || ev.status_eviden === 'a' || ev.status_eviden === 'f' || ev.status_eviden === 's');
    });

    var isUnderReview = !isSelesai && totalInd > 0 && fulfilledCount === totalInd;

    var statusKey = 'belum';
    var badgeText = 'Belum Diunggah';
    var badgeClass = 'belum';

    if (revisiEv) {
      statusKey = 'revisi';
      badgeText = 'Perlu Revisi';
      badgeClass = 'revisi';
    } else if (isSelesai) {
      statusKey = 'selesai';
      badgeText = 'Selesai';
      badgeClass = 'selesai';
    } else if (isUnderReview) {
      statusKey = 'review';
      badgeText = 'Sedang Direview';
      badgeClass = 'review';
    } else if (fulfilledCount > 0) {
      statusKey = 'progress';
      badgeText = 'Sedang Diunggah';
      badgeClass = 'belum';
    }

    var revisiNote = '';
    if (revisiEv && revisiEv.catatan_temuan) {
      var revAuthor = revisiEv.nama_reviewer ? ('Revisi dari ' + revisiEv.nama_reviewer + ': ') : 'Revisi dari Ketua: ';
      revisiNote = revAuthor + revisiEv.catatan_temuan;
    } else if (revisiEv) {
      revisiNote = 'Revisi dari Ketua: Perbaiki berkas eviden yang belum sesuai ketentuan.';
    }

    return {
      totalInd: totalInd,
      fulfilledCount: fulfilledCount,
      pct: pct,
      statusKey: statusKey,
      badgeText: badgeText,
      badgeClass: badgeClass,
      revisiNote: revisiNote
    };
  }

  function renderUploadCatalog(availableModuls) {
    var isSuperadmin = STATE.user && STATE.user.role === 'adm';

    var modStatsMap = {};
    var totalCount = availableModuls.length;
    var revisiCount = 0;
    var selesaiCount = 0;

    availableModuls.forEach(function(m){
      var st = getModulEvidenStats(m);
      modStatsMap[m.id_modul] = st;
      if (st.statusKey === 'revisi') revisiCount++;
      if (st.statusKey === 'selesai') selesaiCount++;
    });

    var belumSelesaiCount = totalCount - selesaiCount;

    var q = uplCatSearchQuery.trim().toLowerCase();
    var filtered = availableModuls.filter(function(m){
      var st = modStatsMap[m.id_modul];
      if (uplCatTab === 'revisi' && st.statusKey !== 'revisi') return false;
      if (uplCatTab === 'belum_selesai' && st.statusKey === 'selesai') return false;
      if (uplCatTab === 'selesai' && st.statusKey !== 'selesai') return false;

      if (q) {
        var matchTitle = (m.nama_modul || '').toLowerCase().indexOf(q) > -1;
        var code = getModulCode(m).toLowerCase();
        var matchCode = code.indexOf(q) > -1;
        var matchUnit = (m.nama_unit || '').toLowerCase().indexOf(q) > -1;
        var matchInd = STATE.indikators.some(function(ind){
          return ind.id_modul === m.id_modul && (ind.deskripsi_indikator || '').toLowerCase().indexOf(q) > -1;
        });
        if (!matchTitle && !matchCode && !matchUnit && !matchInd) return false;
      }
      return true;
    });

    var h = '<div class="upl-cat-wrap">';

    // 1. Breadcrumb & Page Title
    h += '<div class="upl-cat-header">';
    h += '<div class="upl-cat-crumb">Daftar Tugas / Laporan Eviden</div>';
    h += '<h1 class="upl-cat-title">Daftar Modul Tugas Eviden</h1>';
    h += '</div>';

    // 3. Toolbar: Search + Filter Tabs + Period Dropdown
    h += '<div class="upl-cat-toolbar">';
    h += '<div class="upl-cat-left">';

    // Search Input
    h += '<div class="upl-cat-search-box">';
    h += '<svg class="upl-cat-search-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>';
    h += '<input type="text" class="upl-cat-search-input" id="uplCatSearchBox" placeholder="Cari berkas atau indikator..." value="' + escapeAttr(uplCatSearchQuery) + '">';
    h += '</div>';

    // Filter Tabs
    h += '<div class="upl-cat-tabs">';
    h += '<button class="upl-cat-tab-btn ' + (uplCatTab === 'all' ? 'active' : '') + '" data-tab="all">Semua (' + totalCount + ')</button>';
    h += '<button class="upl-cat-tab-btn ' + (uplCatTab === 'revisi' ? 'active' : '') + '" data-tab="revisi">Perlu Revisi (' + revisiCount + ')</button>';
    h += '<button class="upl-cat-tab-btn ' + (uplCatTab === 'belum_selesai' ? 'active' : '') + '" data-tab="belum_selesai">Belum Selesai (' + belumSelesaiCount + ')</button>';
    h += '<button class="upl-cat-tab-btn ' + (uplCatTab === 'selesai' ? 'active' : '') + '" data-tab="selesai">Selesai (' + selesaiCount + ')</button>';
    h += '</div>';

    h += '</div>';

    // Period Select
    h += '<div class="upl-cat-right">';
    h += '<select class="upl-cat-period-sel" id="uplCatPeriodSel">';
    h += '<option value="2026-10"' + (uplCatPeriod === '2026-10' ? ' selected' : '') + '>Oktober 2026 - Siklus Bulanan ▾</option>';
    h += '<option value="2026-11"' + (uplCatPeriod === '2026-11' ? ' selected' : '') + '>November 2026 - Siklus Bulanan ▾</option>';
    h += '<option value="2026-12"' + (uplCatPeriod === '2026-12' ? ' selected' : '') + '>Desember 2026 - Siklus Bulanan ▾</option>';
    h += '</select>';
    h += '</div>';

    h += '</div>';

    // 4. Grid of Cards
    if (filtered.length === 0) {
      h += '<div style="background:#fff;border:1px dashed #cbd5e1;border-radius:14px;padding:48px 20px;text-align:center;color:#64748b;margin-top:10px">';
      h += '<div style="margin-bottom:8px"><svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></div>';
      h += '<div style="font-weight:700;color:#1e293b;margin-bottom:4px">Tidak Ada Modul Tugas Ditemukan</div>';
      h += '<div style="font-size:13px">Coba ubah kata kunci pencarian atau ganti filter tab di atas.</div>';
      h += '</div>';
    } else {
      h += '<div class="upl-cat-grid">';
      filtered.forEach(function(m){
        var st = modStatsMap[m.id_modul];
        var code = getModulCode(m);
        var tenggatFormatted = formatDateIndo(m.tenggat_unggah || '2026-10-30');
        var isSelesai = st.statusKey === 'selesai';

        h += '<div class="upl-task-card">';
        h += '<div>';

        // Top Row: Title, Code, Badge
        h += '<div class="upl-task-top">';
        h += '<div class="upl-task-titles">';
        h += '<div class="upl-task-title">' + escapeHtml(m.nama_modul) + '</div>';
        h += '<div class="upl-task-code">' + escapeHtml(code) + '</div>';
        h += '</div>';
        h += '<span class="upl-task-badge ' + st.badgeClass + '">' + st.badgeText + '</span>';
        h += '</div>';

        // Progress Section
        var progText = st.fulfilledCount + '/' + st.totalInd + ' Eviden Terpenuhi';
        if (st.totalInd === 0) progText = '0/0 Eviden Terpenuhi';
        else if (st.fulfilledCount === 0) progText = '0/' + st.totalInd + ' Eviden';

        h += '<div class="upl-task-prog-sec">';
        h += '<div class="upl-task-prog-labels">';
        h += '<span>' + progText + '</span>';
        h += '<span>' + st.pct + '%</span>';
        h += '</div>';
        h += '<div class="upl-task-prog-track">';
        h += '<div class="upl-task-prog-fill" style="width:' + st.pct + '%"></div>';
        h += '</div>';
        h += '</div>';

        // Deadline
        h += '<div class="upl-task-deadline">Tenggat: ' + tenggatFormatted + '</div>';
        h += '</div>';

        // Bottom Section: Button & Note
        h += '<div>';
        h += '<button class="upl-task-btn ' + (isSelesai ? 'selesai' : '') + ' btnOpenUplTask" data-id="' + m.id_modul + '">';
        h += 'Buka Tugas';
        h += '</button>';

        if (st.revisiNote) {
          h += '<div class="upl-task-rev-note">' + escapeHtml(st.revisiNote) + '</div>';
        }

        h += '</div>';
        h += '</div>';
      });
      h += '</div>';
    }

    h += '</div>';

    document.getElementById("uplC").innerHTML = h;

    // Attach Catalog Event Listeners:
    var sBox = document.getElementById("uplCatSearchBox");
    if (sBox) {
      sBox.oninput = function(){
        uplCatSearchQuery = this.value;
        var cursorPos = this.selectionStart;
        renderUploadCatalog(availableModuls);
        var refreshed = document.getElementById("uplCatSearchBox");
        if (refreshed) {
          refreshed.focus();
          refreshed.setSelectionRange(cursorPos, cursorPos);
        }
      };
    }

    document.querySelectorAll(".upl-cat-tab-btn").forEach(function(b){
      b.onclick = function(){
        uplCatTab = this.dataset.tab;
        renderUploadCatalog(availableModuls);
      };
    });

    var pSel = document.getElementById("uplCatPeriodSel");
    if (pSel) {
      pSel.onchange = function(){
        uplCatPeriod = this.value;
      };
    }

    document.querySelectorAll(".btnOpenUplTask").forEach(function(b){
      b.onclick = function(){
        uplSelectedModulId = this.dataset.id;
        renderUpload();
      };
    });
  }

  function renderUploadDetail(activeMod, availableModuls) {
    var isSuperadmin = STATE.user && STATE.user.role === 'adm';

    var allModInds = STATE.indikators.filter(function(i){ return i.id_modul === activeMod.id_modul; });
    var totalInd = allModInds.length;
    var fulfilledInds = allModInds.filter(function(ind){
      var ev = STATE.evidens.find(function(e){ return e.id_indikator === ind.id_indikator; });
      return ev && ev.status_eviden !== 'n' && ev.status_eviden !== 'r';
    });
    var fulfilledCount = fulfilledInds.length;
    var pct = totalInd > 0 ? Math.round((fulfilledCount / totalInd) * 100) : 0;

    var missingInds = allModInds.filter(function(ind){
      var ev = STATE.evidens.find(function(e){ return e.id_indikator === ind.id_indikator; });
      return !ev || ev.status_eviden === 'n' || ev.status_eviden === 'r';
    });

    var isLocked = parseInt(activeMod.is_locked) === 1;
    var tenggatStr = formatDateIndo(activeMod.tenggat_unggah || '2026-10-20');
    var mulaiStr = formatDateIndo(activeMod.mulai_penilaian || '2026-10-21');
    var templateName = activeMod.file_referensi || ('Panduan_' + (activeMod.nama_modul ? activeMod.nama_modul.replace(/[^a-zA-Z0-9]/g, '_') : 'PBJ') + '.pdf');

    // Filter by search query if present
    var q = uplSearchQuery.trim().toLowerCase();
    var displayInds = allModInds.filter(function(ind){
      if (!q) return true;
      var ev = STATE.evidens.find(function(e){ return e.id_indikator === ind.id_indikator; });
      var matchDesc = ind.deskripsi_indikator.toLowerCase().indexOf(q) > -1;
      var matchFile = ev && ev.nama_file && ev.nama_file.toLowerCase().indexOf(q) > -1;
      return matchDesc || matchFile;
    });

    var h = '<div class="upl-container">';

    // 1. Secondary Toolbar: Breadcrumb + Search + View Switcher
    h += '<div class="upl-sub-bar">';
    h += '<div class="upl-breadcrumb">';
    h += '<button class="btn o sm" id="btnBackToUplCatalog" style="display:inline-flex;align-items:center;gap:6px;padding:4px 10px;font-size:12px;font-weight:600;border-radius:8px;background:#ffffff;border:1px solid #cbd5e1;color:#087066;cursor:pointer">' +
         '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"></polyline></svg> Daftar Modul</button>';
    h += '<span class="upl-crumb-sep">/</span>';
    h += '<span class="upl-crumb-root" id="uplCrumbRoot" title="Klik untuk kembali ke Daftar Modul">' + (isSuperadmin ? 'Superadmin Eviden' : 'Eviden PIC') + '</span>';
    h += '<span class="upl-crumb-sep">›</span>';
    if (availableModuls.length > 1) {
      h += '<select class="upl-modul-select" id="uplModulSwitcher">';
      availableModuls.forEach(function(m){
        var unitSuffix = isSuperadmin ? (' [' + (m.nama_unit || 'Unit') + ']') : '';
        h += '<option value="' + m.id_modul + '"' + (m.id_modul === activeMod.id_modul ? ' selected' : '') + '>' + escapeAttr(m.nama_modul) + unitSuffix + '</option>';
      });
      h += '</select>';
    } else {
      h += '<span class="upl-crumb-curr">' + escapeAttr(activeMod.nama_modul) + '</span>';
    }
    h += '</div>';

    h += '<div class="upl-tools-right">';
    h += '<div class="upl-search-wrap">';
    h += '<svg class="upl-search-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>';
    h += '<input type="text" class="upl-search-input" id="uplSearchBox" placeholder="Cari berkas atau indikator..." value="' + escapeAttr(uplSearchQuery) + '">';
    h += '</div>';
    h += '<div class="upl-view-tabs">';
    h += '<button class="upl-view-btn ' + (uplActiveView === 'folder' ? 'on' : '') + '" id="uplBtnViewFolder" title="Tampilan Kartu">';
    h += '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg> Folder</button>';
    h += '<button class="upl-view-btn ' + (uplActiveView === 'daftar' ? 'on' : '') + '" id="uplBtnViewDaftar" title="Tampilan Tabel">';
    h += '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg> Daftar</button>';
    h += '</div>';
    h += '</div>';
    h += '</div>'; // end .upl-sub-bar

    // 2. Hero Progress Card
    h += '<div class="upl-hero-card">';
    h += '<div class="upl-hero-top">';
    h += '<h2 class="upl-hero-title">' + escapeAttr(activeMod.nama_modul) + '</h2>';
    h += '<div class="upl-badge-status ' + (isLocked ? 'kunci' : 'bebas') + '">';
    h += '<span class="upl-pulse-dot"></span> ' + (isLocked ? 'Terkunci' : 'Bebas diubah');
    h += '</div>';
    h += '</div>';

    h += '<div class="upl-hero-sub">' + fulfilledCount + ' dari ' + totalInd + ' indikator terpenuhi · tenggat ' + tenggatStr + ' · penilaian SKI mulai ' + mulaiStr + '</div>';

    h += '<div class="upl-progress-track">';
    h += '<div class="upl-progress-fill ' + (pct >= 100 ? 'done' : '') + '" style="width:' + pct + '%"></div>';
    h += '</div>';

    // KKR Calculation Banner (Threshold Kelulusan Checklist Otomatis)
    var modKkr = calculateModuleKKR(activeMod.id_modul);
    if (modKkr && modKkr.total > 0) {
      h += '<div class="upl-kkr-banner ' + (modKkr.isPass ? 'pass' : 'fail') + '" style="margin:12px 0 6px">' +
             '<div>' +
               '<div style="display:flex;align-items:center;gap:12px">' +
                 '<span class="upl-kkr-score ' + (modKkr.isPass ? 'pass' : 'fail') + '">' + modKkr.percentage + '%</span>' +
                 '<div>' +
                   '<b style="font-size:14px;color:var(--dk);display:block">' + (modKkr.isPass ? 'Memenuhi Standar Ambang Batas KKR SKI' : 'Perhatian: Belum Memenuhi Ambang Batas KKR SKI') + '</b>' +
                   '<span style="font-size:12px;color:var(--tx)">' + modKkr.scoreYa + ' dari ' + modKkr.total + ' Butir Checklist Kepatuhan Dinyatakan YA (Target Minimum: ' + modKkr.target + '%)</span>' +
                 '</div>' +
               '</div>' +
             '</div>' +
             '<div style="text-align:right">' +
               '<span class="tag ' + (modKkr.isPass ? 't-ok' : 't-er') + '" style="font-size:12px;padding:5px 12px;font-weight:700">' + (modKkr.isPass ? 'LOLOS KKR' : 'PERBAIKAN KKR') + '</span>' +
             '</div>' +
           '</div>';
    }

    // Missing chips
    h += '<div class="upl-missing-row">';
    h += '<span class="upl-missing-label">Yang masih kurang:</span>';
    if (missingInds.length > 0) {
      missingInds.forEach(function(mi){
        h += '<span class="upl-missing-chip" data-scroll-to="ind-' + mi.id_indikator + '">' + escapeAttr(mi.deskripsi_indikator) + '</span>';
      });
    } else {
      h += '<span class="upl-all-done-chip">Semua butir tagihan indikator telah terpenuhi</span>';
    }
    h += '</div>';

    // Notice callout
    h += '<div class="upl-notice-banner">';
    h += (isLocked
      ? 'Jadwal pengunggahan berkas telah jatuh tempo pada ' + tenggatStr + '. Dokumen telah terkunci secara otomatis untuk tahap verifikasi SKI.'
      : 'Sampai ' + tenggatStr + ' Anda bebas mengunggah, mengganti, atau menghapus berkas. Setelah itu berkas terkunci otomatis.');
    h += '</div>';

    // Template row
    var hasTpl = !!activeMod.file_referensi;
    h += '<div class="upl-template-row">';
    h += '<div class="upl-template-info">';
    h += '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m21.44 11.05-9.19 9.19a6 6 0 0 1-8.49-8.49l8.57-8.57A4 4 0 1 1 18 8.84l-8.59 8.57a2 2 0 0 1-2.83-2.83l8.49-8.48"/></svg>';
    if (hasTpl) {
      h += '<span>Template &amp; format acuan dari SKI: <b>' + escapeAttr(activeMod.file_referensi) + '</b></span>';
      h += '</div>';
      h += '<a href="uploads/templates/' + encodeURIComponent(activeMod.file_referensi) + '" download="' + escapeAttr(activeMod.file_referensi) + '" target="_blank" class="upl-btn-unduh" id="btnUnduhTemplate" style="text-decoration:none">';
      h += '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg> Unduh Template</a>';
    } else {
      h += '<span style="color:var(--mut)">Template format acuan belum diunggah oleh SKI (PIC dapat menggunakan format standar).</span>';
      h += '</div>';
    }
    h += '</div>';
    h += '</div>'; // end .upl-hero-card

    // 3. Views: Folder (Grid) vs Daftar (Table)
    if (uplActiveView === 'folder') {
      h += '<div class="upl-grid">';
      if (displayInds.length === 0) {
        h += '<div style="grid-column:1/-1;text-align:center;padding:36px;color:var(--mut)">Tidak ada indikator yang sesuai dengan pencarian "<b>' + escapeAttr(uplSearchQuery) + '</b>"</div>';
      } else {
        displayInds.forEach(function(ind, idx){
          var ev = STATE.evidens.find(function(e){ return e.id_indikator === ind.id_indikator; });
          var st = ev ? ev.status_eviden : 'n';
          var indTypeMeta = getInputTypeMeta(ind.input_type || 'file');
          var isMand = parseInt(ind.is_mandatory) === 1;

                    h += '<div class="upl-card" id="card-ind-' + ind.id_indikator + '">';
          h += '<div class="upl-card-header" style="display:flex;flex-direction:column;gap:4px">' +
                 '<div style="display:flex;align-items:center;gap:6px;flex-wrap:wrap">' +
                   '<span class="ind-type-badge type-' + indTypeMeta.id + ' font-weight:700">' + indTypeMeta.label + '</span>' +
                   (isMand ? '<span style="color:#ef4444;font-size:10px;font-weight:700;background:#fee2e2;padding:1px 5px;border-radius:3px" title="Wajib Diisi PIC">* Wajib</span>' : '') +
                 '</div>' +
                 '<div>' + (idx + 1) + '. ' + escapeAttr(ind.deskripsi_indikator) + '</div>' +
                 (ind.guide_notes ? '<div style="font-size:11px;color:var(--mut);font-weight:normal;line-height:1.3;font-style:italic">Petunjuk: ' + escapeAttr(ind.guide_notes) + '</div>' : '') +
               '</div>';

          // File / Structured Isian Box
          h += '<div class="upl-file-area">';
          if (!ev || st === 'n') {
            h += '<div class="upl-empty-box">Belum diisi / diunggah</div>';
          } else {
            var parsed = parseEvidenNilai(ev);
            if (parsed) {
              h += '<div class="upl-structured-box">';
              if (parsed._type === 'numeric') {
                h += '<div class="upl-structured-title">Data Realisasi Kuantitatif</div>' +
                     '<div class="upl-structured-grid">' +
                       '<div><span style="color:var(--mut)">Pagu Anggaran:</span><br><b>' + formatRupiah(parsed.pagu) + '</b></div>' +
                       '<div><span style="color:var(--mut)">Realisasi:</span><br><b>' + formatRupiah(parsed.realisasi) + '</b></div>' +
                       '<div><span style="color:var(--mut)">Persentase:</span><br><b style="color:var(--pri)">' + (parsed.persen || 0) + '%</b></div>' +
                       '<div><span style="color:var(--mut)">Rekap Pegawai:</span><br><b>' + (parsed.pegawai || 0) + ' Orang</b></div>' +
                     '</div>' +
                     (parsed.catatan ? '<div style="margin-top:6px;font-size:11.5px;color:var(--tx)"><i>' + escapeAttr(parsed.catatan) + '</i></div>' : '');
              } else if (parsed._type === 'binary_score') {
                var isYa = parseInt(parsed.skor) === 1;
                h += '<div class="upl-structured-title">Checklist Kelulusan KKR</div>' +
                     '<div style="display:flex;align-items:center;gap:8px;margin:4px 0">' +
                       '<span class="tag ' + (isYa ? 't-ok' : 't-er') + '" style="font-size:12px;font-weight:700">' + (isYa ? 'YA (Skor: 1 - Memenuhi Standar)' : 'TIDAK (Skor: 0 - Belum Memenuhi)') + '</span>' +
                     '</div>' +
                     (parsed.catatan ? '<div style="margin-top:4px;font-size:11.5px;color:var(--tx)"><b>Justifikasi:</b> ' + escapeAttr(parsed.catatan) + '</div>' : '');
              } else if (parsed._type === 'pbj_matrix') {
                var countSesuai = (parsed.kualitas ? 1 : 0) + (parsed.jumlah ? 1 : 0) + (parsed.harga ? 1 : 0) + (parsed.penyedia ? 1 : 0);
                h += '<div class="upl-structured-title">Matriks 4 Tepat Pengadaan (PBJ)</div>' +
                     '<div class="upl-pbj-grid">' +
                       '<div class="upl-pbj-cell ' + (parsed.kualitas ? 'ok' : 'no') + '">Kualitas: <b>' + (parsed.kualitas ? 'Tepat' : 'Tidak') + '</b></div>' +
                       '<div class="upl-pbj-cell ' + (parsed.jumlah ? 'ok' : 'no') + '">Jumlah: <b>' + (parsed.jumlah ? 'Tepat' : 'Tidak') + '</b></div>' +
                       '<div class="upl-pbj-cell ' + (parsed.harga ? 'ok' : 'no') + '">Harga: <b>' + (parsed.harga ? 'Tepat' : 'Tidak') + '</b></div>' +
                       '<div class="upl-pbj-cell ' + (parsed.penyedia ? 'ok' : 'no') + '">Penyedia: <b>' + (parsed.penyedia ? 'Tepat' : 'Tidak') + '</b></div>' +
                     '</div>' +
                     '<div style="margin-top:6px;font-size:11.5px;display:flex;justify-content:space-between;align-items:center">' +
                       '<span>Skor: <b>' + countSesuai + '/4 Tepat</b></span>' +
                       '<span>Nilai: <b>' + formatRupiah(parsed.nilai_kontrak) + '</b></span>' +
                     '</div>' +
                     (parsed.catatan ? '<div style="margin-top:4px;font-size:11.5px;color:var(--tx)"><i>' + escapeAttr(parsed.catatan) + '</i></div>' : '');
              } else if (parsed._type === 'risk_scale') {
                var rScore = parseInt(parsed.skor_risiko) || (parseInt(parsed.kemungkinan) * parseInt(parsed.dampak)) || 1;
                var rLvl = rScore >= 16 ? 'Ekstrem' : (rScore >= 10 ? 'Tinggi' : (rScore >= 5 ? 'Sedang' : 'Rendah'));
                var rCls = rScore >= 16 ? 't-er' : (rScore >= 10 ? 't-wn' : (rScore >= 5 ? 't-in' : 't-ok'));
                h += '<div class="upl-structured-title">Matriks Level Risiko</div>' +
                     '<div style="display:flex;align-items:center;justify-content:space-between;margin:4px 0">' +
                       '<span>Kemungkinan: <b>' + parsed.kemungkinan + '/5</b> · Dampak: <b>' + parsed.dampak + '/5</b></span>' +
                       '<span class="tag ' + rCls + '" style="font-weight:700">Skor: ' + rScore + ' (' + rLvl + ')</span>' +
                     '</div>' +
                     (parsed.mitigasi ? '<div style="margin-top:4px;font-size:11.5px;color:var(--tx)"><b>Mitigasi:</b> ' + escapeAttr(parsed.mitigasi) + '</div>' : '');
              }
              if (ev.path_file && ev.path_file !== '#') {
                var isLink = isEvidenUrl(ev.path_file) || ev.format_file === 'link' || ev.format_file === 'gdrive';
                h += '<div style="margin-top:8px;padding-top:6px;border-top:1px dashed var(--bd);font-size:11.5px">' +
                       '<span style="color:var(--mut)">Berkas Pendukung:</span> ' +
                       '<a href="' + ev.path_file + '" target="_blank" rel="noopener noreferrer" style="color:var(--pri);font-weight:600;text-decoration:none">' + escapeAttr(ev.nama_file) + '</a>' +
                     '</div>';
              }
              h += '</div>';
            } else {
              var isLink = isEvidenUrl(ev.path_file) || ev.format_file === 'link' || ev.format_file === 'gdrive' || ev.format_file === 'onedrive' || ev.format_file === 'dropbox';
              var providerText = (ev.format_file === 'gdrive' || (ev.path_file && ev.path_file.indexOf('drive.google.com') > -1)) ? 'Google Drive' : (ev.format_file === 'onedrive' ? 'OneDrive' : (ev.format_file === 'dropbox' ? 'Dropbox' : 'Cloud Link'));
              h += '<div class="upl-file-box' + (isLink ? ' is-link' : '') + '">';
              h += '<div class="upl-file-icon">' + getFileIconSvg(ev.nama_file, ev.format_file, ev.path_file) + '</div>';
              h += '<div class="upl-file-meta">';
              h += '<a href="' + ev.path_file + '" target="_blank" rel="noopener noreferrer" class="upl-file-name" title="' + escapeAttr(ev.nama_file) + '">' + escapeAttr(ev.nama_file) + '</a>';
              h += '<span class="upl-file-sub">v' + ev.versi + ' · ' + (isLink ? providerText : ev.ukuran_file_mb + ' MB') + ' · ' + formatDateIndo(ev.waktu_unggah) + '</span>';
              h += '</div>';
              h += '</div>';
            }
          }
          h += '</div>';

          // SKI Finding Note (Catatan SKI)
          if (ev && ev.catatan_temuan) {
            h += '<div class="upl-finding-box"><b>Catatan SKI:</b> ' + escapeAttr(ev.catatan_temuan) + '</div>';
          }

          // Status Badge + Mini Progress Bar
          h += '<div class="upl-status-row">';
          if (!ev || st === 'n') {
            h += '<span class="upl-status-tag upl-st-empty"><span class="upl-dot"></span> Belum diisi</span>';
            h += '<div class="upl-mini-prog"><div class="upl-mini-fill gray" style="width:0%"></div></div>';
          } else if (st === 'r') {
            h += '<span class="upl-status-tag upl-st-revisi"><span class="upl-dot"></span> Perlu tindak lanjut</span>';
            h += '<div class="upl-mini-prog"><div class="upl-mini-fill red" style="width:25%"></div></div>';
          } else if (st === 'f') {
            h += '<span class="upl-status-tag upl-st-done"><span class="upl-dot"></span> Sesuai (Disetujui)</span>';
            h += '<div class="upl-mini-prog"><div class="upl-mini-fill teal" style="width:100%"></div></div>';
          } else {
            var stLabel = (st === 'u' ? 'Menunggu review SKI' : (st === 'o' ? 'Menunggu Ketua SKI' : 'Menunggu review Pimpinan'));
            h += '<span class="upl-status-tag upl-st-wait"><span class="upl-dot"></span> ' + stLabel + '</span>';
            h += '<div class="upl-mini-prog"><div class="upl-mini-fill teal" style="width:60%"></div></div>';
          }
          h += '</div>';

          // Action Buttons
          h += '<div class="upl-card-actions">';
          if (isLocked) {
            h += '<span class="tag t-gy" style="font-size:11px">Terkunci (Jatuh Tempo)</span>';
          } else if (!ev || st === 'n') {
            h += '<button class="upl-btn-action upl-btn-unggah btnOpenUploadPopup" data-type="' + (ind.input_type || 'file') + '" data-ind="' + ind.id_indikator + '" data-jdw="' + (activeMod.id_jadwal || '') + '" data-mod="' + escapeAttr(activeMod.nama_modul) + '" data-desc="' + escapeAttr(ind.deskripsi_indikator) + '" data-cat="">Isi / Unggah</button>';
          } else if (st === 'r') {
            h += '<button class="upl-btn-action upl-btn-tindaklanjut btnOpenUploadPopup" data-type="' + (ind.input_type || 'file') + '" data-ind="' + ind.id_indikator + '" data-jdw="' + (activeMod.id_jadwal || '') + '" data-mod="' + escapeAttr(activeMod.nama_modul) + '" data-desc="' + escapeAttr(ind.deskripsi_indikator) + '" data-cat="' + escapeAttr(ev.catatan_temuan || '') + '">Tindak lanjut</button>';
          } else {
            h += '<div class="upl-actions-split">';
            h += '<button class="upl-btn-action upl-btn-ganti btnOpenUploadPopup" data-type="' + (ind.input_type || 'file') + '" data-ind="' + ind.id_indikator + '" data-jdw="' + (activeMod.id_jadwal || '') + '" data-mod="' + escapeAttr(activeMod.nama_modul) + '" data-desc="' + escapeAttr(ind.deskripsi_indikator) + '" data-cat="">Ubah Isian</button>';
            h += '<button class="upl-btn-action upl-btn-hapus btnDeleteEviden" data-ev="' + ev.id_eviden + '" data-file="' + escapeAttr(ev.nama_file) + '">Hapus</button>';
            h += '</div>';
          }
          h += '</div>'; // end .upl-card-actions

          h += '</div>'; // end .upl-card
        });
      }
      h += '</div>'; // end .upl-grid
    } else {
      // DAFTAR (TABLE) VIEW
      h += '<div class="card" style="padding:16px"><div class="tw"><table>';
      h += '<tr><th>No</th><th>Indikator Tagihan</th><th>Isian &amp; Eviden Terunggah</th><th>Versi</th><th>Ukuran / Tipe</th><th>Waktu Unggah</th><th>Status</th><th>Aksi</th></tr>';
      if (displayInds.length === 0) {
        h += '<tr><td colspan="8" style="text-align:center;padding:32px;color:var(--mut)">Tidak ada indikator yang sesuai dengan pencarian</td></tr>';
      } else {
        displayInds.forEach(function(ind, idx){
          var ev = STATE.evidens.find(function(e){ return e.id_indikator === ind.id_indikator; });
          var st = ev ? ev.status_eviden : 'n';
          var indTypeMeta = getInputTypeMeta(ind.input_type || 'file');
          var isMand = parseInt(ind.is_mandatory) === 1;
          var parsed = ev ? parseEvidenNilai(ev) : null;
          var isLink = ev && (isEvidenUrl(ev.path_file) || ev.format_file === 'link' || ev.format_file === 'gdrive' || ev.format_file === 'onedrive' || ev.format_file === 'dropbox');
          var iconSymbol = '';

          h += '<tr>';
          h += '<td><b>' + (idx + 1) + '</b></td>';
          h += '<td>' +
                 '<div style="display:flex;align-items:center;gap:5px;margin-bottom:3px">' +
                   '<span class="ind-type-badge type-' + indTypeMeta.id + '">' + indTypeMeta.icon + ' ' + indTypeMeta.label + '</span>' +
                   (isMand ? '<span style="color:#ef4444;font-size:10px;font-weight:700">* Wajib</span>' : '') +
                 '</div>' +
                 '<b>' + escapeAttr(ind.deskripsi_indikator) + '</b>' +
                 (ind.guide_notes ? '<div style="font-size:11px;color:var(--mut);line-height:1.2;margin-top:2px">Petunjuk: ' + escapeAttr(ind.guide_notes) + '</div>' : '') +
                 (ev && ev.catatan_temuan ? '<br><small style="color:var(--er)"><b>Catatan SKI:</b> ' + escapeAttr(ev.catatan_temuan) + '</small>' : '') +
               '</td>';

          // Dokumen / Isian column
          h += '<td>';
          if (!ev || st === 'n') {
            h += '<span style="color:var(--mut)">Belum ada</span>';
          } else if (parsed) {
            if (parsed._type === 'numeric') {
              h += '<div><b>Pagu:</b> ' + formatRupiah(parsed.pagu) + ' · <b>Realisasi:</b> ' + formatRupiah(parsed.realisasi) + ' (' + (parsed.persen || 0) + '%)</div>';
            } else if (parsed._type === 'binary_score') {
              h += '<div><span class="tag ' + (parseInt(parsed.skor) === 1 ? 't-ok' : 't-er') + '">' + (parseInt(parsed.skor) === 1 ? 'YA (1)' : 'TIDAK (0)') + '</span> ' + escapeAttr(parsed.catatan || '') + '</div>';
            } else if (parsed._type === 'pbj_matrix') {
              h += '<div><b>PBJ 4 Tepat:</b> ' + (parsed.kualitas ? 'Tepat' : 'Tidak') + ' Kualitas, ' + (parsed.jumlah ? 'Tepat' : 'Tidak') + ' Jumlah, ' + (parsed.harga ? 'Tepat' : 'Tidak') + ' Harga, ' + (parsed.penyedia ? 'Tepat' : 'Tidak') + ' Penyedia</div>';
            } else if (parsed._type === 'risk_scale') {
              var rScore = parseInt(parsed.skor_risiko) || (parseInt(parsed.kemungkinan) * parseInt(parsed.dampak)) || 1;
              h += '<div><b>Skala Risiko:</b> Skor ' + rScore + ' (K:' + parsed.kemungkinan + ' × D:' + parsed.dampak + ')</div>';
            }
            if (ev.path_file && ev.path_file !== '#') {
              h += '<div style="margin-top:4px"><a href="' + ev.path_file + '" target="_blank" rel="noopener noreferrer" style="color:var(--pri);font-size:11.5px;text-decoration:none">' + escapeAttr(ev.nama_file) + '</a></div>';
            }
          } else {
            h += '<a href="' + ev.path_file + '" target="_blank" rel="noopener noreferrer" style="color:var(--pri);font-weight:600;text-decoration:none;display:inline-flex;align-items:center;gap:4px">' + iconSymbol + escapeAttr(ev.nama_file) + ' ↗</a>';
          }
          h += '</td>';

          h += '<td>' + (ev ? 'v' + ev.versi : '-') + '</td>';
          h += '<td>' + (ev ? (parsed ? indTypeMeta.label : (isLink ? 'Tautan Awan' : ev.ukuran_file_mb + ' MB')) : '-') + '</td>';
          h += '<td>' + (ev ? formatDateIndo(ev.waktu_unggah) : '-') + '</td>';
          h += '<td><span class="tag ' + SS[st][1] + '">' + SS[st][0] + '</span></td>';
          h += '<td>';
          if (isLocked) {
            h += '<span class="tag t-gy">Terkunci</span>';
          } else if (!ev || st === 'n') {
            h += '<button class="btn sm btnOpenUploadPopup" data-type="' + (ind.input_type || 'file') + '" data-ind="' + ind.id_indikator + '" data-jdw="' + (activeMod.id_jadwal || '') + '" data-mod="' + escapeAttr(activeMod.nama_modul) + '" data-desc="' + escapeAttr(ind.deskripsi_indikator) + '" data-cat="">Isi</button>';
          } else if (st === 'r') {
            h += '<button class="btn sm btnOpenUploadPopup" data-type="' + (ind.input_type || 'file') + '" data-ind="' + ind.id_indikator + '" data-jdw="' + (activeMod.id_jadwal || '') + '" data-mod="' + escapeAttr(activeMod.nama_modul) + '" data-desc="' + escapeAttr(ind.deskripsi_indikator) + '" data-cat="' + escapeAttr(ev.catatan_temuan || '') + '" style="background:#0d9488">Tindak lanjut</button>';
          } else {
            h += '<div style="display:flex;gap:6px">';
            h += '<button class="btn o sm btnOpenUploadPopup" data-type="' + (ind.input_type || 'file') + '" data-ind="' + ind.id_indikator + '" data-jdw="' + (activeMod.id_jadwal || '') + '" data-mod="' + escapeAttr(activeMod.nama_modul) + '" data-desc="' + escapeAttr(ind.deskripsi_indikator) + '" data-cat="">Ubah</button>';
            h += '<button class="btn o sm btnDeleteEviden" data-ev="' + ev.id_eviden + '" data-file="' + escapeAttr(ev.nama_file) + '" style="color:#ef4444;border-color:#ef4444">Hapus</button>';
            h += '</div>';
          }
          h += '</td>';
          h += '</tr>';
        });
      }
      h += '</table></div></div>';
    }

    h += '</div>'; // end .upl-container
    document.getElementById("uplC").innerHTML = h;

    // Attach Event Handlers:
    // 0. Back to catalog buttons
    var btnBackCat = document.getElementById("btnBackToUplCatalog");
    if (btnBackCat) {
      btnBackCat.onclick = function(){
        uplSelectedModulId = null;
        renderUpload();
      };
    }
    var crumbRoot = document.getElementById("uplCrumbRoot");
    if (crumbRoot) {
      crumbRoot.onclick = function(){
        uplSelectedModulId = null;
        renderUpload();
      };
    }

    // 1. Modul switcher
    var modSw = document.getElementById("uplModulSwitcher");
    if (modSw) {
      modSw.onchange = function(){
        uplSelectedModulId = this.value;
        renderUpload();
      };
    }

    // 2. Search box
    var sBox = document.getElementById("uplSearchBox");
    if (sBox) {
      sBox.oninput = function(){
        uplSearchQuery = this.value;
        // Keep focus when re-rendering
        var cursorPos = this.selectionStart;
        renderUpload();
        var refreshedBox = document.getElementById("uplSearchBox");
        if (refreshedBox) {
          refreshedBox.focus();
          refreshedBox.setSelectionRange(cursorPos, cursorPos);
        }
      };
    }

    // 3. View Switcher
    var btnFolder = document.getElementById("uplBtnViewFolder");
    var btnDaftar = document.getElementById("uplBtnViewDaftar");
    if (btnFolder) {
      btnFolder.onclick = function(){ uplActiveView = 'folder'; renderUpload(); };
    }
    if (btnDaftar) {
      btnDaftar.onclick = function(){ uplActiveView = 'daftar'; renderUpload(); };
    }

    // 4. Missing chip click scroll to card
    document.querySelectorAll(".upl-missing-chip[data-scroll-to]").forEach(function(chip){
      chip.onclick = function(){
        var targetId = 'card-' + this.dataset.scrollTo;
        var el = document.getElementById(targetId);
        if (el) {
          el.scrollIntoView({ behavior: 'smooth', block: 'center' });
          el.style.boxShadow = '0 0 0 3px #0d9488';
          setTimeout(function(){ el.style.boxShadow = ''; }, 2000);
        }
      };
    });

    // 5. Template download
    var btnUnduh = document.getElementById("btnUnduhTemplate");
    if (btnUnduh) {
      btnUnduh.onclick = function(){
        toast("Mengunduh berkas template acuan: " + (activeMod.file_referensi || ''));
      };
    }

    // 6. Delete Eviden handler
    document.querySelectorAll(".btnDeleteEviden").forEach(function(b){
      b.onclick = function(){
        var evId = this.dataset.ev;
        var fileName = this.dataset.file;
        openModal({
          title: "Konfirmasi Hapus Berkas",
          body: '<div style="font-size:13.5px">' +
                '<p style="margin:0 0 10px">Apakah Anda yakin ingin menghapus berkas eviden <b>' + escapeAttr(fileName) + '</b>?</p>' +
                '<div style="background:#fee2e2;color:#991b1b;padding:10px 14px;border-radius:10px;font-size:12px;border-left:4px solid #dc2626">' +
                'Perhatian: Berkas akan dihapus permanen dan butir indikator ini akan kembali ke status <b>Belum Diunggah</b>.' +
                '</div></div>',
          okText: "Ya, Hapus Berkas",
          cancelText: "Batal",
          onOk: function(){
            var fd = new FormData();
            fd.append('action', 'delete_eviden');
            fd.append('id_eviden', evId);
            fetch('ajax.php', { method: 'POST', body: fd })
              .then(function(r){ return r.json(); })
              .then(function(res){
                toast(res.message);
                closeModal();
                if (res.success) fetchInit(function(){ renderUpload(); });
              });
          }
        });
      };
    });

    // 7. Dynamic Upload & Structured Tagihan Popup Handler (SRS v1.0)
    document.querySelectorAll(".btnOpenUploadPopup").forEach(function(b){
      b.onclick = function(){
        currentUploadInd = this.dataset.ind;
        currentUploadJadwal = this.dataset.jdw;
        var modName = this.dataset.mod;
        var indDesc = this.dataset.desc;
        var cat = this.dataset.cat;
        var inputType = this.dataset.type || 'file';

        var existingEv = STATE.evidens.find(function(e){ return e.id_indikator === currentUploadInd; });
        var curVal = (existingEv ? parseEvidenNilai(existingEv) : null) || {};
        var typeMeta = getInputTypeMeta(inputType);

        var isExistingLink = existingEv && (isEvidenUrl(existingEv.path_file) || existingEv.format_file === 'link' || existingEv.format_file === 'gdrive' || existingEv.format_file === 'onedrive' || existingEv.format_file === 'dropbox');
        var initialMode = isExistingLink ? 'link' : 'file';
        var currentUploadMode = initialMode;
        var initialUrl = isExistingLink ? (existingEv.path_file || '') : '';
        var initialTitle = isExistingLink ? (existingEv.nama_file || '') : '';

        var popBody = '<div style="font-size:13px">' +
                      '<div style="background:var(--pri2);padding:10px 14px;border-radius:10px;margin-bottom:12px">' +
                        '<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:4px">' +
                          '<span class="ind-type-badge type-' + typeMeta.id + '">' + typeMeta.icon + ' ' + typeMeta.label + '</span>' +
                          '<span style="font-size:11px;color:var(--pri);font-weight:700">Modul: ' + escapeAttr(modName) + '</span>' +
                        '</div>' +
                        '<b style="color:var(--dk);font-size:13.5px">' + escapeAttr(indDesc) + '</b>' +
                      '</div>' +
                      (cat ? '<div style="background:#fee2e2;color:#991b1b;padding:10px 14px;border-radius:10px;margin-bottom:12px;border-left:4px solid #dc2626"><b>Catatan Perbaikan dari SKI:</b><br>' + escapeAttr(cat) + '</div>' : '');

        // --- FORM TIPE 2: NUMERIC (Pagu, Realisasi, Persentase, Rekap Pegawai) ---
        if (inputType === 'numeric') {
          popBody += '<div style="display:flex;flex-direction:column;gap:12px">' +
            '<div class="grid g2">' +
              '<div>' +
                '<label style="display:block;font-weight:700;margin-bottom:4px">Pagu Anggaran (Rp): <span style="color:#ef4444">*</span></label>' +
                '<input type="number" id="inpNumPagu" class="srch" style="width:100%" placeholder="mis. 500000000" value="' + (curVal.pagu !== undefined ? curVal.pagu : '') + '">' +
                '<small id="lblPaguFmt" style="color:var(--mut);font-size:11px;display:block;margin-top:2px">' + (curVal.pagu ? formatRupiah(curVal.pagu) : '-') + '</small>' +
              '</div>' +
              '<div>' +
                '<label style="display:block;font-weight:700;margin-bottom:4px">Realisasi Anggaran (Rp): <span style="color:#ef4444">*</span></label>' +
                '<input type="number" id="inpNumRealisasi" class="srch" style="width:100%" placeholder="mis. 465000000" value="' + (curVal.realisasi !== undefined ? curVal.realisasi : '') + '">' +
                '<small id="lblRealFmt" style="color:var(--mut);font-size:11px;display:block;margin-top:2px">' + (curVal.realisasi ? formatRupiah(curVal.realisasi) : '-') + '</small>' +
              '</div>' +
            '</div>' +
            '<div class="grid g2">' +
              '<div>' +
                '<label style="display:block;font-weight:700;margin-bottom:4px">Persentase Capaian (%):</label>' +
                '<input type="number" id="inpNumPersen" step="0.01" class="srch" style="width:100%" placeholder="mis. 93.00" value="' + (curVal.persen !== undefined ? curVal.persen : '') + '">' +
                '<small style="color:var(--mut);font-size:11px;display:block;margin-top:2px">Dihitung otomatis atau dapat disesuaikan.</small>' +
              '</div>' +
              '<div>' +
                '<label style="display:block;font-weight:700;margin-bottom:4px">Rekap Jumlah Pegawai (Orang):</label>' +
                '<input type="number" id="inpNumPegawai" class="srch" style="width:100%" placeholder="mis. 45" value="' + (curVal.pegawai !== undefined ? curVal.pegawai : '') + '">' +
              '</div>' +
            '</div>' +
            '<div>' +
              '<label style="display:block;font-weight:700;margin-bottom:4px">Catatan &amp; Uraian Realisasi Kuantitatif:</label>' +
              '<textarea id="inpNumCatatan" style="width:100%;min-height:55px;border:1px solid var(--bd);border-radius:8px;padding:8px;font:inherit" placeholder="Rincian sumber daya, realisasi belanja, atau catatan tambahan...">' + escapeAttr(curVal.catatan || '') + '</textarea>' +
            '</div>' +
            '<div style="background:#f8fafc;padding:10px 12px;border-radius:10px;border:1px solid var(--bd)">' +
              '<label style="display:block;font-weight:700;margin-bottom:4px">Lampirkan Berkas Bukti / Eviden Pendukung (Opsional):</label>' +
              '<input type="file" id="inpAttFile" class="fl" style="width:100%;margin-bottom:6px" accept=".pdf,.xlsx,.xls,.docx,.doc">' +
              '<input type="url" id="inpAttUrl" class="srch" style="width:100%" placeholder="Atau tautan Google Drive / Cloud Link..." value="' + escapeAttr(isExistingLink ? (existingEv.path_file || '') : '') + '">' +
            '</div>' +
          '</div>';

        // --- FORM TIPE 3: BINARY SCORE (Checklist KKR Ya/Tidak) ---
        } else if (inputType === 'binary_score') {
          var curSkor = curVal.skor !== undefined ? parseInt(curVal.skor) : 1;
          popBody += '<div style="display:flex;flex-direction:column;gap:12px">' +
            '<label style="display:block;font-weight:700">Pilih Status Pemenuhan Indikator KKR: <span style="color:#ef4444">*</span></label>' +
            '<div style="display:grid;grid-template-columns:1fr 1fr;gap:10px">' +
              '<label class="upl-choice-card ' + (curSkor === 1 ? 'selected' : '') + '" id="cardBinYa" style="cursor:pointer">' +
                '<input type="radio" name="binSkor" id="rbBinYa" value="1" ' + (curSkor === 1 ? 'checked' : '') + ' style="margin-top:3px">' +
                '<div>' +
                  '<b style="color:#166534;font-size:13.5px;display:block">YA (Skor: 1)</b>' +
                  '<small style="color:#15803d">Memenuhi standar indikator kepatuhan secara penuh.</small>' +
                '</div>' +
              '</label>' +
              '<label class="upl-choice-card ' + (curSkor === 0 ? 'selected' : '') + '" id="cardBinTidak" style="cursor:pointer">' +
                '<input type="radio" name="binSkor" id="rbBinTidak" value="0" ' + (curSkor === 0 ? 'checked' : '') + ' style="margin-top:3px">' +
                '<div>' +
                  '<b style="color:#991b1b;font-size:13.5px;display:block">TIDAK (Skor: 0)</b>' +
                  '<small style="color:#b91c1c">Belum memenuhi standar indikator kepatuhan.</small>' +
                '</div>' +
              '</label>' +
            '</div>' +
            '<div>' +
              '<label style="display:block;font-weight:700;margin-bottom:4px">Justifikasi / Keterangan Pemenuhan:</label>' +
              '<textarea id="inpBinCatatan" style="width:100%;min-height:60px;border:1px solid var(--bd);border-radius:8px;padding:8px;font:inherit" placeholder="Uraikan kondisi faktual pemenuhan indikator kepatuhan...">' + escapeAttr(curVal.catatan || '') + '</textarea>' +
            '</div>' +
            '<div style="background:#f8fafc;padding:10px 12px;border-radius:10px;border:1px solid var(--bd)">' +
              '<label style="display:block;font-weight:700;margin-bottom:4px">Lampirkan Berkas Bukti / Eviden Pendukung (Opsional):</label>' +
              '<input type="file" id="inpAttFile" class="fl" style="width:100%;margin-bottom:6px" accept=".pdf,.xlsx,.xls,.docx,.doc">' +
              '<input type="url" id="inpAttUrl" class="srch" style="width:100%" placeholder="Atau tautan Google Drive / Cloud Link..." value="' + escapeAttr(isExistingLink ? (existingEv.path_file || '') : '') + '">' +
            '</div>' +
          '</div>';

        // --- FORM TIPE 4a: PBJ MATRIX (Matriks 4 Tepat Pengadaan) ---
        } else if (inputType === 'pbj_matrix') {
          var isKual = curVal.kualitas !== undefined ? !!curVal.kualitas : true;
          var isJum = curVal.jumlah !== undefined ? !!curVal.jumlah : true;
          var isHrg = curVal.harga !== undefined ? !!curVal.harga : true;
          var isPny = curVal.penyedia !== undefined ? !!curVal.penyedia : true;

          popBody += '<div style="display:flex;flex-direction:column;gap:12px">' +
            '<label style="display:block;font-weight:700">Checklist Evaluasi Parameter Matriks 4 Tepat PBJ: <span style="color:#ef4444">*</span></label>' +
            '<div style="display:grid;grid-template-columns:1fr 1fr;gap:8px">' +
              '<label style="display:flex;align-items:flex-start;gap:8px;padding:8px 10px;background:#f8fafc;border:1px solid var(--bd);border-radius:8px;cursor:pointer">' +
                '<input type="checkbox" id="inpPbjKualitas" ' + (isKual ? 'checked' : '') + ' style="margin-top:2px">' +
                '<span style="font-size:12px"><b>1. Tepat Kualitas</b><br><small style="color:var(--mut)">Mutu &amp; spesifikasi sesuai KAK/Kontrak.</small></span>' +
              '</label>' +
              '<label style="display:flex;align-items:flex-start;gap:8px;padding:8px 10px;background:#f8fafc;border:1px solid var(--bd);border-radius:8px;cursor:pointer">' +
                '<input type="checkbox" id="inpPbjJumlah" ' + (isJum ? 'checked' : '') + ' style="margin-top:2px">' +
                '<span style="font-size:12px"><b>2. Tepat Jumlah</b><br><small style="color:var(--mut)">Kuantitas sesuai kebutuhan riil &amp; BAST.</small></span>' +
              '</label>' +
              '<label style="display:flex;align-items:flex-start;gap:8px;padding:8px 10px;background:#f8fafc;border:1px solid var(--bd);border-radius:8px;cursor:pointer">' +
                '<input type="checkbox" id="inpPbjHarga" ' + (isHrg ? 'checked' : '') + ' style="margin-top:2px">' +
                '<span style="font-size:12px"><b>3. Tepat Harga</b><br><small style="color:var(--mut)">Kewajaran HPS, efisiensi &amp; negosiasi.</small></span>' +
              '</label>' +
              '<label style="display:flex;align-items:flex-start;gap:8px;padding:8px 10px;background:#f8fafc;border:1px solid var(--bd);border-radius:8px;cursor:pointer">' +
                '<input type="checkbox" id="inpPbjPenyedia" ' + (isPny ? 'checked' : '') + ' style="margin-top:2px">' +
                '<span style="font-size:12px"><b>4. Tepat Penyedia</b><br><small style="color:var(--mut)">Kredibilitas &amp; kepatuhan administrasi vendor.</small></span>' +
              '</label>' +
            '</div>' +
            '<div>' +
              '<label style="display:block;font-weight:700;margin-bottom:4px">Nilai Kontrak / Pengadaan (Rp):</label>' +
              '<input type="number" id="inpPbjNilai" class="srch" style="width:100%" placeholder="mis. 185000000" value="' + (curVal.nilai_kontrak || '') + '">' +
            '</div>' +
            '<div>' +
              '<label style="display:block;font-weight:700;margin-bottom:4px">Uraian Evaluasi PBJ / Keterangan Penyedia:</label>' +
              '<textarea id="inpPbjCatatan" style="width:100%;min-height:55px;border:1px solid var(--bd);border-radius:8px;padding:8px;font:inherit" placeholder="Catatan BAST, nomor SPK/Kontrak, nama rekanan...">' + escapeAttr(curVal.catatan || '') + '</textarea>' +
            '</div>' +
            '<div style="background:#f8fafc;padding:10px 12px;border-radius:10px;border:1px solid var(--bd)">' +
              '<label style="display:block;font-weight:700;margin-bottom:4px">Lampirkan Berkas BAST / SPK / Kontrak PBJ (Opsional):</label>' +
              '<input type="file" id="inpAttFile" class="fl" style="width:100%;margin-bottom:6px" accept=".pdf,.xlsx,.xls,.docx,.doc">' +
              '<input type="url" id="inpAttUrl" class="srch" style="width:100%" placeholder="Atau tautan Google Drive / Cloud Link..." value="' + escapeAttr(isExistingLink ? (existingEv.path_file || '') : '') + '">' +
            '</div>' +
          '</div>';

        // --- FORM TIPE 4b: RISK SCALE (Skala Level Risiko Kemungkinan x Dampak) ---
        } else if (inputType === 'risk_scale') {
          var curKem = curVal.kemungkinan !== undefined ? parseInt(curVal.kemungkinan) : 2;
          var curDam = curVal.dampak !== undefined ? parseInt(curVal.dampak) : 3;

          popBody += '<div style="display:flex;flex-direction:column;gap:12px">' +
            '<div class="grid g2">' +
              '<div>' +
                '<label style="display:block;font-weight:700;margin-bottom:4px">Tingkat Kemungkinan (1-5): <span style="color:#ef4444">*</span></label>' +
                '<select id="inpRiskKemungkinan" class="fl" style="width:100%">' +
                  '<option value="1" ' + (curKem === 1 ? 'selected' : '') + '>1 - Sangat Jarang</option>' +
                  '<option value="2" ' + (curKem === 2 ? 'selected' : '') + '>2 - Jarang Terjadi</option>' +
                  '<option value="3" ' + (curKem === 3 ? 'selected' : '') + '>3 - Sedang / Kadang</option>' +
                  '<option value="4" ' + (curKem === 4 ? 'selected' : '') + '>4 - Sering Terjadi</option>' +
                  '<option value="5" ' + (curKem === 5 ? 'selected' : '') + '>5 - Hampir Pasti Terjadi</option>' +
                '</select>' +
              '</div>' +
              '<div>' +
                '<label style="display:block;font-weight:700;margin-bottom:4px">Tingkat Dampak (1-5): <span style="color:#ef4444">*</span></label>' +
                '<select id="inpRiskDampak" class="fl" style="width:100%">' +
                  '<option value="1" ' + (curDam === 1 ? 'selected' : '') + '>1 - Tidak Signifikan</option>' +
                  '<option value="2" ' + (curDam === 2 ? 'selected' : '') + '>2 - Ringan</option>' +
                  '<option value="3" ' + (curDam === 3 ? 'selected' : '') + '>3 - Sedang / Moderat</option>' +
                  '<option value="4" ' + (curDam === 4 ? 'selected' : '') + '>4 - Berat</option>' +
                  '<option value="5" ' + (curDam === 5 ? 'selected' : '') + '>5 - Sangat Berat (Katastropik)</option>' +
                '</select>' +
              '</div>' +
            '</div>' +
            '<div id="riskMeterBox" class="upl-risk-meter" style="background:#fef3c7;border-left:4px solid #f59e0b;padding:10px 14px;border-radius:8px">' +
              '<div style="display:flex;justify-content:space-between;align-items:center">' +
                '<span style="font-size:12.5px;color:var(--tx)">Kalkulasi Matriks Risiko (K × D):</span>' +
                '<span id="riskMeterScore" style="font-weight:800;font-size:15px;color:#92400e">Skor: 6 (Tingkat Sedang)</span>' +
              '</div>' +
            '</div>' +
            '<div>' +
              '<label style="display:block;font-weight:700;margin-bottom:4px">Strategi &amp; Rencana Mitigasi Risiko:</label>' +
              '<textarea id="inpRiskMitigasi" style="width:100%;min-height:60px;border:1px solid var(--bd);border-radius:8px;padding:8px;font:inherit" placeholder="Uraikan prosedur mitigasi, kontrol internal, atau PIC tindak lanjut...">' + escapeAttr(curVal.mitigasi || '') + '</textarea>' +
            '</div>' +
            '<div style="background:#f8fafc;padding:10px 12px;border-radius:10px;border:1px solid var(--bd)">' +
              '<label style="display:block;font-weight:700;margin-bottom:4px">Lampirkan Berkas Register Risiko / SOP Bukti (Opsional):</label>' +
              '<input type="file" id="inpAttFile" class="fl" style="width:100%;margin-bottom:6px" accept=".pdf,.xlsx,.xls,.docx,.doc">' +
              '<input type="url" id="inpAttUrl" class="srch" style="width:100%" placeholder="Atau tautan Google Drive / Cloud Link..." value="' + escapeAttr(isExistingLink ? (existingEv.path_file || '') : '') + '">' +
            '</div>' +
          '</div>';

        // --- FORM TIPE 1: FILE DOKUMEN (Berkas Fisik atau Tautan Cloud) ---
        } else {
          popBody += '<!-- Tipe Eviden Selector (Tab Segmented Control) -->' +
            '<div class="upl-type-switcher">' +
              '<button type="button" class="upl-type-tab ' + (initialMode === 'file' ? 'on' : '') + '" id="tabTypeFile">' +
                '<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="12" y1="18" x2="12" y2="12"/><line x1="9" y1="15" x2="15" y2="15"/></svg>' +
                '<span>Unggah Berkas File</span>' +
              '</button>' +
              '<button type="button" class="upl-type-tab ' + (initialMode === 'link' ? 'on' : '') + '" id="tabTypeLink">' +
                '<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>' +
                '<span>Tautan GDrive / Cloud</span>' +
              '</button>' +
            '</div>' +
            '<div id="uplPanelFile" style="' + (initialMode === 'file' ? '' : 'display:none') + '">' +
              '<div class="drop-zone" id="popupDropZone">' +
                '<svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12"/></svg>' +
                '<div style="font-weight:700;color:var(--dk);font-size:14px">Klik untuk Memilih Berkas</div>' +
                '<p style="color:var(--mut);font-size:12px;margin:4px 0 0">Format: PDF, Excel (.xlsx, .xls), atau Word (.docx, .doc) · Maksimal 50 MB</p>' +
              '</div>' +
              '<div id="fileSelectedInfo" style="display:none;margin-top:12px;padding:10px 14px;background:#f1f5f9;border-radius:10px;border:1px solid var(--bd)">' +
                '<b>Berkas terpilih:</b> <span id="lblSelFileName">-</span> (<span id="lblSelFileSize">-</span>)' +
              '</div>' +
            '</div>' +
            '<div id="uplPanelLink" style="' + (initialMode === 'link' ? '' : 'display:none') + '">' +
              '<div style="display:flex;flex-direction:column;gap:12px">' +
                '<div>' +
                  '<label style="display:block;font-weight:700;color:var(--dk);margin-bottom:6px">Alamat URL / Tautan Eviden: <span style="color:#ef4444">*</span></label>' +
                  '<input type="url" id="inpLinkUrl" class="upl-link-input" placeholder="https://drive.google.com/drive/folders/... atau https://docs.google.com/..." value="' + escapeAttr(initialUrl) + '">' +
                  '<div style="display:flex;align-items:center;justify-content:space-between;margin-top:6px;gap:8px;flex-wrap:wrap">' +
                    '<div id="badgeProviderDetection" style="display:inline-flex;align-items:center;gap:5px;font-size:11.5px;color:var(--mut)">' +
                      '<span style="color:var(--mut)">Penyedia tautan: Google Drive, OneDrive, atau Web Cloud</span>' +
                    '</div>' +
                    '<button type="button" id="btnTestOpenLink" class="upl-btn-test-link" style="display:none">' +
                      '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>' +
                      'Uji Buka Tautan ↗' +
                    '</button>' +
                  '</div>' +
                '</div>' +
                '<div>' +
                  '<label style="display:block;font-weight:700;color:var(--dk);margin-bottom:6px">Nama / Judul Dokumen (Opsional):</label>' +
                  '<input type="text" id="inpLinkTitle" class="upl-link-input" placeholder="Contoh: Berkas Bukti Unit ' + escapeAttr(modName) + '" value="' + escapeAttr(initialTitle) + '">' +
                '</div>' +
              '</div>' +
            '</div>';
        }

        popBody += '</div>';

        openModal({
          title: "Pengisian Tagihan: " + typeMeta.label,
          body: popBody,
          okText: "Simpan &amp; Ajukan Tagihan",
          cancelText: "Batal",
          width: "600px",
          onOk: function(){
            var fd = new FormData();
            fd.append('action', 'upload_eviden');
            fd.append('id_jadwal', currentUploadJadwal);
            fd.append('id_indikator', currentUploadInd);
            fd.append('tipe_eviden', inputType);

            // Handle Structured Submissions
            if (inputType === 'numeric') {
              var pagu = parseFloat(document.getElementById("inpNumPagu").value) || 0;
              var real = parseFloat(document.getElementById("inpNumRealisasi").value) || 0;
              var prs = parseFloat(document.getElementById("inpNumPersen").value);
              if (isNaN(prs)) {
                prs = pagu > 0 ? parseFloat(((real / pagu) * 100).toFixed(2)) : 0;
              }
              var peg = parseInt(document.getElementById("inpNumPegawai").value) || 0;
              var cat = document.getElementById("inpNumCatatan").value.trim();

              if (!pagu && !real) {
                alert("Harap isikan minimal Pagu atau Realisasi Anggaran!");
                return;
              }

              var nilaiObj = { pagu: pagu, realisasi: real, persen: prs, pegawai: peg, catatan: cat };
              fd.append('nilai_isian', JSON.stringify(nilaiObj));
              fd.append('display_title', 'Realisasi: ' + formatRupiah(real) + ' (' + prs + '%)');

              var attF = document.getElementById("inpAttFile");
              if (attF && attF.files && attF.files[0]) fd.append('file', attF.files[0]);
              var attU = document.getElementById("inpAttUrl");
              if (attU && attU.value.trim()) fd.append('link_url', attU.value.trim());

            } else if (inputType === 'binary_score') {
              var rCheck = document.querySelector('input[name="binSkor"]:checked');
              var skorVal = rCheck ? parseInt(rCheck.value) : 1;
              var cat = document.getElementById("inpBinCatatan").value.trim();

              var nilaiObj = { skor: skorVal, catatan: cat };
              fd.append('nilai_isian', JSON.stringify(nilaiObj));
              fd.append('display_title', 'KKR: ' + (skorVal === 1 ? 'YA (Memenuhi)' : 'TIDAK (Belum Memenuhi)'));

              var attF = document.getElementById("inpAttFile");
              if (attF && attF.files && attF.files[0]) fd.append('file', attF.files[0]);
              var attU = document.getElementById("inpAttUrl");
              if (attU && attU.value.trim()) fd.append('link_url', attU.value.trim());

            } else if (inputType === 'pbj_matrix') {
              var isK = document.getElementById("inpPbjKualitas").checked ? 1 : 0;
              var isJ = document.getElementById("inpPbjJumlah").checked ? 1 : 0;
              var isH = document.getElementById("inpPbjHarga").checked ? 1 : 0;
              var isP = document.getElementById("inpPbjPenyedia").checked ? 1 : 0;
              var nNilai = parseFloat(document.getElementById("inpPbjNilai").value) || 0;
              var cat = document.getElementById("inpPbjCatatan").value.trim();
              var tot = isK + isJ + isH + isP;

              var nilaiObj = { kualitas: isK, jumlah: isJ, harga: isH, penyedia: isP, nilai_kontrak: nNilai, catatan: cat };
              fd.append('nilai_isian', JSON.stringify(nilaiObj));
              fd.append('display_title', 'Matriks PBJ: ' + tot + '/4 Tepat (' + formatRupiah(nNilai) + ')');

              var attF = document.getElementById("inpAttFile");
              if (attF && attF.files && attF.files[0]) fd.append('file', attF.files[0]);
              var attU = document.getElementById("inpAttUrl");
              if (attU && attU.value.trim()) fd.append('link_url', attU.value.trim());

            } else if (inputType === 'risk_scale') {
              var kem = parseInt(document.getElementById("inpRiskKemungkinan").value) || 1;
              var dam = parseInt(document.getElementById("inpRiskDampak").value) || 1;
              var rScore = kem * dam;
              var rLvl = rScore >= 16 ? 'Ekstrem' : (rScore >= 10 ? 'Tinggi' : (rScore >= 5 ? 'Sedang' : 'Rendah'));
              var mit = document.getElementById("inpRiskMitigasi").value.trim();

              var nilaiObj = { kemungkinan: kem, dampak: dam, skor_risiko: rScore, level: rLvl, mitigasi: mit };
              fd.append('nilai_isian', JSON.stringify(nilaiObj));
              fd.append('display_title', 'Level Risiko: ' + rLvl + ' (Skor: ' + rScore + ')');

              var attF = document.getElementById("inpAttFile");
              if (attF && attF.files && attF.files[0]) fd.append('file', attF.files[0]);
              var attU = document.getElementById("inpAttUrl");
              if (attU && attU.value.trim()) fd.append('link_url', attU.value.trim());

            } else {
              // Standard File / Link Upload
              if (currentUploadMode === 'file') {
                var file = document.getElementById("fin").files[0];
                if (!file) { alert("Pilih berkas dokumen terlebih dahulu!"); return; }
                fd.append('file', file);
              } else {
                var rawUrl = (document.getElementById("inpLinkUrl").value || '').trim();
                var rawTitle = (document.getElementById("inpLinkTitle").value || '').trim();
                if (!rawUrl) {
                  alert("Masukkan alamat tautan link Google Drive atau URL dokumen eviden terlebih dahulu!");
                  document.getElementById("inpLinkUrl").focus();
                  return;
                }
                fd.append('tipe_eviden', 'link');
                fd.append('link_url', rawUrl);
                fd.append('link_title', rawTitle);
              }
            }

            fetch('ajax.php', { method: 'POST', body: fd })
              .then(function(r){ return r.json(); })
              .then(function(res){
                toast(res.message);
                if (res.success) {
                  closeModal();
                  if (document.getElementById("fin")) document.getElementById("fin").value = '';
                  fetchInit(function(){ renderUpload(); });
                }
              });
          }
        });

        // Dynamic Interactive Bindings:
        // 1. Numeric calculations
        if (inputType === 'numeric') {
          var pInp = document.getElementById("inpNumPagu");
          var rInp = document.getElementById("inpNumRealisasi");
          var prInp = document.getElementById("inpNumPersen");
          var lP = document.getElementById("lblPaguFmt");
          var lR = document.getElementById("lblRealFmt");
          function syncNum(){
            var pv = parseFloat(pInp.value) || 0;
            var rv = parseFloat(rInp.value) || 0;
            lP.textContent = pv ? formatRupiah(pv) : '-';
            lR.textContent = rv ? formatRupiah(rv) : '-';
            if (pv > 0) {
              prInp.value = ((rv / pv) * 100).toFixed(2);
            }
          }
          if (pInp && rInp) {
            pInp.oninput = syncNum;
            rInp.oninput = syncNum;
          }
        }

        // 2. Binary Score Card Toggles
        if (inputType === 'binary_score') {
          var cYa = document.getElementById("cardBinYa");
          var cTidak = document.getElementById("cardBinTidak");
          var rYa = document.getElementById("rbBinYa");
          var rTidak = document.getElementById("rbBinTidak");
          function syncBin(){
            if (rYa.checked) {
              cYa.classList.add("selected");
              cTidak.classList.remove("selected");
            } else {
              cTidak.classList.add("selected");
              cYa.classList.remove("selected");
            }
          }
          if (cYa && cTidak) {
            cYa.onclick = function(){ rYa.checked = true; syncBin(); };
            cTidak.onclick = function(){ rTidak.checked = true; syncBin(); };
          }
        }

        // 3. Risk Scale Live Meter
        if (inputType === 'risk_scale') {
          var sK = document.getElementById("inpRiskKemungkinan");
          var sD = document.getElementById("inpRiskDampak");
          var mScore = document.getElementById("riskMeterScore");
          var mBox = document.getElementById("riskMeterBox");
          function updateRisk(){
            var kv = parseInt(sK.value) || 1;
            var dv = parseInt(sD.value) || 1;
            var sc = kv * dv;
            var lvl = sc >= 16 ? 'Ekstrem' : (sc >= 10 ? 'Tinggi' : (sc >= 5 ? 'Sedang' : 'Rendah'));
            var bg = sc >= 16 ? '#fee2e2' : (sc >= 10 ? '#ffedd5' : (sc >= 5 ? '#fef3c7' : '#ecfdf5'));
            var bd = sc >= 16 ? '#ef4444' : (sc >= 10 ? '#f97316' : (sc >= 5 ? '#f59e0b' : '#10b981'));
            var col = sc >= 16 ? '#991b1b' : (sc >= 10 ? '#9a3412' : (sc >= 5 ? '#92400e' : '#065f46'));
            mBox.style.background = bg;
            mBox.style.borderLeftColor = bd;
            mScore.style.color = col;
            mScore.textContent = 'Skor: ' + sc + ' (Level ' + lvl + ')';
          }
          if (sK && sD) {
            sK.onchange = updateRisk;
            sD.onchange = updateRisk;
            updateRisk();
          }
        }

        // 4. File / Link tabs for Document type
        if (inputType === 'file') {
          var tabFile = document.getElementById("tabTypeFile");
          var tabLink = document.getElementById("tabTypeLink");
          var panelFile = document.getElementById("uplPanelFile");
          var panelLink = document.getElementById("uplPanelLink");
          var inpUrl = document.getElementById("inpLinkUrl");
          var inpTitle = document.getElementById("inpLinkTitle");
          var badgeProv = document.getElementById("badgeProviderDetection");
          var btnTest = document.getElementById("btnTestOpenLink");

          function setUploadMode(m) {
            currentUploadMode = m;
            if (m === 'file') {
              tabFile.classList.add("on");
              tabLink.classList.remove("on");
              panelFile.style.display = "block";
              panelLink.style.display = "none";
            } else {
              tabLink.classList.add("on");
              tabFile.classList.remove("on");
              panelFile.style.display = "none";
              panelLink.style.display = "block";
              inpUrl.focus();
              updateProviderUI();
            }
          }

          function updateProviderUI() {
            var url = (inpUrl.value || '').trim();
            if (!url) {
              badgeProv.innerHTML = '<span style="color:var(--mut)">Penyedia tautan: Google Drive, OneDrive, atau Web Cloud</span>';
              btnTest.style.display = 'none';
              return;
            }
            btnTest.style.display = 'inline-flex';
            var low = url.toLowerCase();
            if (low.indexOf('drive.google.com') > -1 || low.indexOf('docs.google.com') > -1) {
              badgeProv.innerHTML = '<span class="tag t-ok" style="font-size:11px;font-weight:700">Google Drive / Docs</span>';
              if (!inpTitle.value.trim()) inpTitle.placeholder = 'Dokumen Google Drive - ' + indDesc;
            } else if (low.indexOf('onedrive') > -1 || low.indexOf('sharepoint') > -1 || low.indexOf('1drv.ms') > -1) {
              badgeProv.innerHTML = '<span class="tag t-bl" style="font-size:11px;font-weight:700">Microsoft OneDrive / SharePoint</span>';
              if (!inpTitle.value.trim()) inpTitle.placeholder = 'Dokumen OneDrive - ' + indDesc;
            } else if (low.indexOf('dropbox.com') > -1) {
              badgeProv.innerHTML = '<span class="tag t-pu" style="font-size:11px;font-weight:700">Dropbox</span>';
              if (!inpTitle.value.trim()) inpTitle.placeholder = 'Dokumen Dropbox - ' + indDesc;
            } else {
              badgeProv.innerHTML = '<span class="tag t-in" style="font-size:11px;font-weight:700">Tautan Web Eksternal</span>';
              if (!inpTitle.value.trim()) inpTitle.placeholder = 'Tautan Dokumen - ' + indDesc;
            }
          }

          if (tabFile) tabFile.onclick = function(){ setUploadMode('file'); };
          if (tabLink) tabLink.onclick = function(){ setUploadMode('link'); };
          if (inpUrl) inpUrl.oninput = updateProviderUI;

          if (btnTest) {
            btnTest.onclick = function(){
              var u = (inpUrl.value || '').trim();
              if (!u) return;
              if (!/^https?:\/\//i.test(u)) u = 'https://' + u;
              window.open(u, '_blank', 'noopener,noreferrer');
            };
          }

          var dropZone = document.getElementById("popupDropZone");
          if (dropZone) {
            dropZone.onclick = function(){ document.getElementById("fin").click(); };
          }

          if (initialMode === 'link') {
            updateProviderUI();
          }
        }
      };
    });
  }

  function renderUpload() {
    var isSuperadmin = STATE.user && STATE.user.role === 'adm';
    var myUnitId = STATE.user ? STATE.user.unit : '';
    // PIC hanya melihat modul yang sudah terbit, memiliki jadwal aktif, dan sesuai dengan unit kerjanya (Superadmin memiliki akses seluruh modul)
    var availableModuls = STATE.moduls.filter(function(m){
      var isTerbit = m.status_template === 'terbit';
      var hasJadwal = !!m.id_jadwal;
      if (isSuperadmin) return isTerbit && hasJadwal;
      var isMyUnit = !myUnitId || m.id_unit_pic === myUnitId;
      return isTerbit && hasJadwal && isMyUnit;
    });

    if (availableModuls.length === 0) {
      var unitName = (STATE.user && STATE.user.nama_unit) ? STATE.user.nama_unit : 'Unit Kerja Anda';
      document.getElementById("uplC").innerHTML = '<div class="card" style="text-align:center;padding:48px 20px;border-radius:16px">' +
        '<div style="margin-bottom:12px;color:var(--mut)"><svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M7 8h10M7 12h10M7 16h6"/></svg></div>' +
        '<h3 style="margin:0 0 8px;color:var(--dk)">Belum Ada Modul Pengawasan Aktif (' + escapeAttr(unitName) + ')</h3>' +
        '<p style="color:var(--mut);margin:0;font-size:13px;max-width:540px;margin:0 auto">Seluruh modul untuk unit kerja Anda saat ini masih dalam tahap draf penyusunan oleh Tim SKI atau belum dibuka jadwal pengawasannya. Modul akan otomatis muncul di sini setelah diterbitkan.</p>' +
        '</div>';
      return;
    }

    if (!uplSelectedModulId || !availableModuls.some(function(m){ return m.id_modul === uplSelectedModulId; })) {
      uplSelectedModulId = null;
      renderUploadCatalog(availableModuls);
      return;
    }

    var activeMod = availableModuls.find(function(m){ return m.id_modul === uplSelectedModulId; });
    renderUploadDetail(activeMod, availableModuls);
  }

  document.getElementById("fin").onchange = function(){
    var file = this.files[0];
    if (file) {
      var infoBox = document.getElementById("fileSelectedInfo");
      var lblName = document.getElementById("lblSelFileName");
      var lblSize = document.getElementById("lblSelFileSize");
      if (infoBox && lblName && lblSize) {
        infoBox.style.display = "block";
        lblName.textContent = file.name;
        lblSize.textContent = (file.size / (1024 * 1024)).toFixed(2) + " MB";
      }
    }
  };

  // --- 5. MONITORING UPLOAD ---
  function renderMonitoring() {
    var h = '<div class="row" style="margin-top:0;justify-content:flex-end;margin-bottom:12px">' +
            '<button class="btn o sm" onclick="document.getElementById(\'btnPageGuide\').click()">Petunjuk</button></div>';

    h += '<div class="tw"><table><tr><th>Nama Berkas</th><th>Modul Pengawasan</th><th>PIC &amp; Unit</th><th>Waktu Unggah</th><th>Status</th><th>Aksi</th></tr>';
    STATE.evidens.forEach(function(e){
      var isLink = isEvidenUrl(e.path_file) || e.format_file === 'link' || e.format_file === 'gdrive' || e.format_file === 'onedrive' || e.format_file === 'dropbox';
      var iconSymbol = '';
      var sizeOrLink = isLink ? ('Tautan ' + (e.format_file === 'gdrive' ? 'Google Drive' : (e.format_file === 'onedrive' ? 'OneDrive' : 'Cloud'))) : (e.ukuran_file_mb + ' MB');
      h += '<tr>';
      h += '<td><a href="' + e.path_file + '" target="_blank" rel="noopener noreferrer" style="color:var(--pri);font-weight:600;text-decoration:none">' + iconSymbol + escapeAttr(e.nama_file) + ' ↗</a><br><small class="mut">v' + e.versi + ' · ' + sizeOrLink + '</small></td>';
      h += '<td><b>' + escapeAttr(e.nama_modul) + '</b><br><small style="color:var(--mut)">' + escapeAttr(e.deskripsi_indikator) + '</small></td>';
      h += '<td>' + escapeAttr(e.nama_pic) + '<br><small style="color:var(--mut)">' + escapeAttr(e.nama_unit || '-') + '</small></td>';
      h += '<td>' + e.waktu_unggah + '</td>';
      h += '<td><span class="tag ' + SS[e.status_eviden][1] + '">' + SS[e.status_eviden][0] + '</span></td>';
      h += '<td><button class="btn o sm btnDetailEviden" data-id="' + e.id_eviden + '">Detail Berkas</button></td>';
      h += '</tr>';
    });
    h += '</table></div>';
    document.getElementById("monC").innerHTML = h;

    document.querySelectorAll(".btnDetailEviden").forEach(function(b){
      b.onclick = function(){
        var id = this.dataset.id;
        var e = STATE.evidens.find(function(x){ return x.id_eviden === id; });
        if (!e) return;

        var isLink = isEvidenUrl(e.path_file) || e.format_file === 'link' || e.format_file === 'gdrive' || e.format_file === 'onedrive' || e.format_file === 'dropbox';
        var formatDisplay = isLink ? ('Tautan Cloud (' + (e.format_file === 'gdrive' ? 'Google Drive' : (e.format_file === 'onedrive' ? 'OneDrive' : 'URL Eksternal')) + ')') : (e.ukuran_file_mb + ' MB (' + e.format_file.toUpperCase() + ')');
        var popHtml = '<div style="font-size:13px">' +
                      '<table style="width:100%;border-collapse:collapse">' +
                      '<tr><td style="width:140px;color:var(--mut);font-weight:600">Nama Dokumen</td><td><b>' + escapeAttr(e.nama_file) + '</b></td></tr>' +
                      '<tr><td style="color:var(--mut);font-weight:600">Modul</td><td>' + escapeAttr(e.nama_modul) + '</td></tr>' +
                      '<tr><td style="color:var(--mut);font-weight:600">Butir Indikator</td><td>' + escapeAttr(e.deskripsi_indikator) + '</td></tr>' +
                      '<tr><td style="color:var(--mut);font-weight:600">PIC Pengunggah</td><td>' + escapeAttr(e.nama_pic) + ' (' + escapeAttr(e.nama_unit || '-') + ')</td></tr>' +
                      '<tr><td style="color:var(--mut);font-weight:600">Tipe &amp; Format</td><td>' + formatDisplay + '</td></tr>' +
                      '<tr><td style="color:var(--mut);font-weight:600">Versi Dokumen</td><td>Versi ke-' + e.versi + '</td></tr>' +
                      '<tr><td style="color:var(--mut);font-weight:600">Waktu Masuk</td><td>' + e.waktu_unggah + '</td></tr>' +
                      '<tr><td style="color:var(--mut);font-weight:600">Status</td><td><span class="tag ' + SS[e.status_eviden][1] + '">' + SS[e.status_eviden][0] + '</span></td></tr>' +
                      '</table>' +
                      '<div style="margin-top:16px;display:flex;gap:10px">' +
                      '<a href="' + e.path_file + '" target="_blank" rel="noopener noreferrer" class="btn sm" style="text-decoration:none">' + (isLink ? 'Buka Tautan Google Drive / Cloud' : 'Unduh / Buka Dokumen Fisik') + '</a>' +
                      '</div>' +
                      '</div>';

        openModal({
          title: "Detail Dokumen Eviden: " + e.nama_file,
          body: popHtml,
          cancelText: "Tutup",
          width: "560px"
        });
      };
    });
  }

  // --- 6. REPOSITORI EVIDEN (Itjen Mode) ---
  function renderRepositori() {
    var h = '<div class="row" style="margin-top:0;justify-content:flex-end;margin-bottom:12px">' +
            '<button class="btn o sm" onclick="document.getElementById(\'btnPageGuide\').click()">Petunjuk</button></div>';

    h += '<div class="tw"><table><tr><th>Nama Berkas</th><th>Modul Pengawasan</th><th>Unit PIC</th><th>Format Berkas</th><th>Ukuran</th><th>Aksi</th></tr>';
    STATE.evidens.forEach(function(e){
      var isLink = isEvidenUrl(e.path_file) || e.format_file === 'link' || e.format_file === 'gdrive' || e.format_file === 'onedrive' || e.format_file === 'dropbox';
      var formatBadge = isLink ? ('<span class="tag t-pu">LINK ' + (e.format_file === 'gdrive' ? 'GDRIVE' : (e.format_file === 'onedrive' ? 'ONEDRIVE' : 'CLOUD')) + '</span>') : ('<span class="tag t-in">' + e.format_file.toUpperCase() + '</span>');
      var sizeText = isLink ? 'Tautan Awan' : (e.ukuran_file_mb + ' MB');
      h += '<tr>';
      h += '<td><b>' + escapeAttr(e.nama_file) + '</b></td>';
      h += '<td>' + escapeAttr(e.nama_modul) + '</td>';
      h += '<td>' + escapeAttr(e.nama_unit || '-') + '</td>';
      h += '<td>' + formatBadge + '</td>';
      h += '<td>' + sizeText + '</td>';
      h += '<td><a href="' + e.path_file + '" target="_blank" rel="noopener noreferrer" class="btn sm" style="text-decoration:none;display:inline-flex">' + (isLink ? 'Buka Tautan ↗' : 'Pratinjau / Unduh') + '</a></td>';
      h += '</tr>';
    });
    h += '</table></div>';
    document.getElementById("repC").innerHTML = h;
  }

  // --- 7. REVIEW & CROSS-CHECK (Anggota SKI) ---
  function renderReview() {
    var allItems = STATE.evidens.filter(function(e){ return e.status_eviden !== 'n'; });
    var pendingItems = allItems.filter(function(e){ return e.status_eviden === 'u'; });
    var historyItems = allItems.filter(function(e){ return e.status_eviden !== 'u'; });
    var sesuaiCount = allItems.filter(function(e){ return e.status_eviden === 'o' || e.status_eviden === 'a' || e.status_eviden === 'f'; }).length;
    var revisiCount = allItems.filter(function(e){ return e.status_eviden === 'r'; }).length;

    var h = '';

    // 1. Hero Card
    h += '<div class="rev-hero">' +
           '<div class="rev-stats-bar">' +
             '<div class="rev-stat-pill active"><span class="apr-dot purple"></span> ' + pendingItems.length + ' Menunggu Review</div>' +
             '<div class="rev-stat-pill success"><span class="apr-dot green"></span> ' + sesuaiCount + ' Lolos (Sesuai)</div>' +
             '<div class="rev-stat-pill warning"><span class="apr-dot pink"></span> ' + revisiCount + ' Perlu Revisi PIC</div>' +
           '</div>' +
         '</div>';

    // Petunjuk is available from the page header.

    // 3. Toolbar (Filter, Search, Tabs & Bulk Action)
    h += '<div class="rev-toolbar">' +
           '<div class="rev-tabs">' +
             '<button class="rev-tab-btn ' + (revFilterTab === 'pending' ? 'on' : '') + '" data-tab="pending">Antrean Menunggu (' + pendingItems.length + ')</button>' +
             '<button class="rev-tab-btn ' + (revFilterTab === 'history' ? 'on' : '') + '" data-tab="history">Riwayat Selesai (' + historyItems.length + ')</button>' +
             '<button class="rev-tab-btn ' + (revFilterTab === 'all' ? 'on' : '') + '" data-tab="all">Semua Berkas (' + allItems.length + ')</button>' +
           '</div>' +
           '<div class="rev-filter-group">' +
             '<div class="rev-search-box">' +
               '<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>' +
               '<input type="text" id="revSearchInp" placeholder="Cari modul, indikator, berkas, PIC..." value="' + escapeAttr(revSearchQuery) + '">' +
             '</div>' +
             '<select class="rev-select" id="revModSelect">' +
               '<option value="all">Semua Modul</option>' +
               STATE.moduls.map(function(m){ return '<option value="' + m.id_modul + '" ' + (revModFilter === m.id_modul ? 'selected' : '') + '>' + m.nama_modul + '</option>'; }).join('') +
             '</select>' +
             '<select class="rev-select" id="revUnitSelect">' +
               '<option value="all">Semua Unit</option>' +
               STATE.units.map(function(u){ return '<option value="' + u.id_unit + '" ' + (String(revUnitFilter) === String(u.id_unit) ? 'selected' : '') + '>' + u.nama_unit + '</option>'; }).join('') +
             '</select>' +
             (revFilterTab === 'pending' && pendingItems.length > 0 ? '<button class="rev-btn-bulk" id="btnBulkReviewOk" disabled>Loloskan Terpilih (0)</button>' : '') +
           '</div>' +
         '</div>';

    // Filter displayed list
    var currentList = revFilterTab === 'pending' ? pendingItems : (revFilterTab === 'history' ? historyItems : allItems);
    var q = revSearchQuery.toLowerCase().trim();
    var filteredList = currentList.filter(function(e){
      var matchQ = !q || (e.nama_modul || '').toLowerCase().indexOf(q) !== -1 ||
                         (e.deskripsi_indikator || '').toLowerCase().indexOf(q) !== -1 ||
                         (e.nama_file || '').toLowerCase().indexOf(q) !== -1 ||
                         (e.nama_pic || '').toLowerCase().indexOf(q) !== -1 ||
                         (e.nama_unit || '').toLowerCase().indexOf(q) !== -1;
      var matchMod = revModFilter === 'all' || e.id_modul === revModFilter;
      var matchUnit = revUnitFilter === 'all' || String(e.id_unit) === String(revUnitFilter);
      return matchQ && matchMod && matchUnit;
    });

    // 4. Table Card
    h += '<div class="rev-table-card">';

    if (filteredList.length === 0) {
      h += '<div style="background:#ffffff;padding:48px 24px;text-align:center;color:var(--mut)">' +
             '<div style="width:48px;height:48px;border-radius:50%;background:#f1f5f9;color:#64748b;display:grid;place-items:center;margin:0 auto 12px">' +
               '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>' +
             '</div>' +
             '<b style="font-size:15px;color:var(--dk);display:block;margin-bottom:4px">' +
               (revFilterTab === 'pending' ? 'Tidak ada antrean berkas yang menunggu review saat ini.' : 'Tidak ada berkas yang cocok dengan filter pencarian.') +
             '</b>' +
             '<small>' + (revFilterTab === 'pending' ? 'Semua berkas yang masuk telah selesai dievaluasi atau belum ada unggahan baru dari PIC.' : 'Coba ubah kata kunci pencarian atau bersihkan filter di atas.') + '</small>' +
           '</div>';
    } else {
      h += '<table class="rev-table">' +
             '<thead><tr>' +
               (revFilterTab === 'pending' ? '<th style="width:36px"><input type="checkbox" id="cbRevAll"></th>' : '') +
               '<th style="min-width:280px">MODUL &amp; BUTIR INDIKATOR</th>' +
               '<th style="min-width:240px">DOKUMEN EVIDEN</th>' +
               '<th style="min-width:180px">PENGUNGGAH &amp; WAKTU</th>' +
               '<th style="min-width:180px">STATUS / HASIL</th>' +
               '<th style="min-width:160px;text-align:right">AKSI EVALUASI</th>' +
             '</tr></thead><tbody>';

      filteredList.forEach(function(e){
        var isRevisi = parseInt(e.versi) > 1;
        var isPending = e.status_eviden === 'u';
        var statusLabel = SS[e.status_eviden] ? SS[e.status_eviden][0] : e.status_eviden;
        var statusClass = SS[e.status_eviden] ? SS[e.status_eviden][1] : 't-gy';

        h += '<tr>';
        if (revFilterTab === 'pending') {
          h += '<td><input type="checkbox" class="cbRevItem" data-id="' + e.id_eviden + '"></td>';
        }
        h += '<td>' +
               '<div><b style="color:var(--dk);font-size:13.5px">' + e.nama_modul + '</b></div>' +
               '<div style="color:var(--tx);font-size:13px;margin:3px 0 6px;line-height:1.4">' + e.deskripsi_indikator + '</div>' +
               '<span class="tag t-in" style="font-size:10.5px">' + (e.nama_unit || '-') + '</span>' +
             '</td>';
        var isLink = isEvidenUrl(e.path_file) || e.format_file === 'link' || e.format_file === 'gdrive' || e.format_file === 'onedrive' || e.format_file === 'dropbox';
        var sizeOrLink = isLink ? ('Tautan ' + (e.format_file === 'gdrive' ? 'Google Drive' : (e.format_file === 'onedrive' ? 'OneDrive' : 'Cloud'))) : (e.ukuran_file_mb + ' MB');
        h += '<td>' +
               '<a href="' + e.path_file + '" target="_blank" rel="noopener noreferrer" class="rev-file-link">' +
                 getFileIconSvg(e.nama_file, e.format_file, e.path_file) +
                 '<span>' + escapeAttr(e.nama_file) + '</span>' +
                 '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 17 17 7M8 7h9v9"/></svg>' +
               '</a>' +
               '<div style="font-size:11.5px;color:var(--mut);margin-top:4px">' +
                 sizeOrLink + ' · <span class="tag ' + (isRevisi ? 't-pu' : 't-gy') + '" style="font-size:10px;padding:1px 6px">' + (isRevisi ? 'Versi ' + e.versi + ' (Revisi)' : 'Versi 1 (Awal)') + '</span>' +
               '</div>' +
             '</td>';
        h += '<td>' +
               '<b>' + e.nama_pic + '</b>' +
               '<div style="font-size:11.5px;color:var(--mut);margin-top:2px">' + formatDateIndo(e.waktu_unggah) + '</div>' +
             '</td>';
        h += '<td>' +
               '<span class="tag ' + statusClass + '">' + statusLabel + '</span>' +
               (e.catatan_temuan ? '<div style="margin-top:5px;font-size:11.5px;color:#92400e;background:#fef3c7;padding:4px 8px;border-radius:6px;line-height:1.3;max-width:280px"><b>Temuan:</b> ' + e.catatan_temuan + '</div>' : '') +
             '</td>';
        h += '<td style="text-align:right">';
        if (isPending) {
          h += '<div class="rev-actions-wrap" style="justify-content:flex-end">' +
                 '<button class="rev-btn-quick-ok btnQuickSesuai" data-id="' + e.id_eviden + '" title="Loloskan langsung berkas ini ke Ketua SKI">Sesuai</button>' +
                 '<button class="rev-btn-eval btnOpenEvalModal" data-id="' + e.id_eviden + '">Tinjau &amp; Nilai</button>' +
               '</div>';
        } else {
          h += '<button class="btn o sm btnOpenEvalModal" data-id="' + e.id_eviden + '" style="font-size:11.5px">Detail Review</button>';
        }
        h += '</td>';
        h += '</tr>';
      });

      h += '</tbody></table>';
    }

    h += '</div>'; // end rev-table-card

    document.getElementById("revC").innerHTML = h;

    // Tabs listener
    document.querySelectorAll(".rev-tab-btn").forEach(function(btn){
      btn.onclick = function(){
        revFilterTab = this.dataset.tab;
        renderReview();
      };
    });

    // Search input listener
    var sInp = document.getElementById("revSearchInp");
    if (sInp) {
      sInp.oninput = function(){
        revSearchQuery = this.value;
        renderReview();
      };
    }

    // Modul & Unit Select listeners
    var mSel = document.getElementById("revModSelect");
    if (mSel) {
      mSel.onchange = function(){
        revModFilter = this.value;
        renderReview();
      };
    }
    var uSel = document.getElementById("revUnitSelect");
    if (uSel) {
      uSel.onchange = function(){
        revUnitFilter = this.value;
        renderReview();
      };
    }

    // Checkbox & Bulk Actions
    function updateBulkBtn() {
      var checked = document.querySelectorAll(".cbRevItem:checked");
      var count = checked.length;
      var bulkBtn = document.getElementById("btnBulkReviewOk");
      if (bulkBtn) {
        bulkBtn.textContent = "Loloskan Terpilih (" + count + ")";
        bulkBtn.disabled = (count === 0);
      }
    }

    var cbAll = document.getElementById("cbRevAll");
    if (cbAll) {
      cbAll.onchange = function(){
        var state = this.checked;
        document.querySelectorAll(".cbRevItem").forEach(function(c){ c.checked = state; });
        updateBulkBtn();
      };
    }

    document.querySelectorAll(".cbRevItem").forEach(function(cb){
      cb.onchange = function(){
        if (cbAll) {
          var allCbs = document.querySelectorAll(".cbRevItem");
          cbAll.checked = [].every.call(allCbs, function(c){ return c.checked; });
        }
        updateBulkBtn();
      };
    });

    var btnBulk = document.getElementById("btnBulkReviewOk");
    if (btnBulk) {
      btnBulk.onclick = function(){
        var checked = document.querySelectorAll(".cbRevItem:checked");
        var ids = [];
        checked.forEach(function(c){ ids.push(c.dataset.id); });
        if (!ids.length) return;
        if (!confirm("Loloskan " + ids.length + " berkas terpilih sebagai SESUAI ke Ketua SKI?")) return;
        var payload = ids.map(function(id){ return { id_eviden: id, status: 'ok', catatan: 'Sesuai indikator (Review Massal).' }; });
        var fd = new FormData();
        fd.append('action', 'submit_review');
        fd.append('reviews', JSON.stringify(payload));
        fetch('ajax.php', { method: 'POST', body: fd }).then(function(r){ return r.json(); }).then(function(res){
          toast(res.message);
          if (res.success) fetchInit(function(){ renderReview(); });
        });
      };
    }

    // Quick single Sesuai
    document.querySelectorAll(".btnQuickSesuai").forEach(function(b){
      b.onclick = function(){
        var id = this.dataset.id;
        var e = STATE.evidens.find(function(x){ return x.id_eviden === id; });
        if (!e) return;
        if (!confirm("Konfirmasi bahwa berkas '" + e.nama_file + "' SESUAI dan loloskan ke Ketua SKI?")) return;
        var payload = [{ id_eviden: id, status: 'ok', catatan: 'Sesuai indikator.' }];
        var fd = new FormData();
        fd.append('action', 'submit_review');
        fd.append('reviews', JSON.stringify(payload));
        fetch('ajax.php', { method: 'POST', body: fd }).then(function(r){ return r.json(); }).then(function(res){
          toast(res.message);
          if (res.success) fetchInit(function(){ renderReview(); });
        });
      };
    });

    // Open detailed review modal
    document.querySelectorAll(".btnOpenEvalModal").forEach(function(b){
      b.onclick = function(){
        var id = this.dataset.id;
        var e = STATE.evidens.find(function(x){ return x.id_eviden === id; });
        if (!e) return;
        openReviewModal(e);
      };
    });

    function openReviewModal(e) {
      var isRevisi = parseInt(e.versi) > 1;
      var isPending = e.status_eviden === 'u';
      var isLink = isEvidenUrl(e.path_file) || e.format_file === 'link' || e.format_file === 'gdrive' || e.format_file === 'onedrive' || e.format_file === 'dropbox';

      var bodyHtml = '<div style="font-size:13px">' +
        '<div style="background:#f8fafc;border:1px solid var(--bd);border-radius:12px;padding:14px 16px;margin-bottom:14px">' +
          '<div style="display:flex;justify-content:space-between;align-items:flex-start;gap:10px">' +
            '<div>' +
              '<div style="font-size:11px;font-weight:700;color:var(--mut);text-transform:uppercase">Modul Pengawasan:</div>' +
              '<b style="font-size:15px;color:var(--dk)">' + e.nama_modul + '</b>' +
              '<div style="margin-top:4px;color:var(--tx);font-size:13.5px"><b>Butir Indikator:</b> ' + e.deskripsi_indikator + '</div>' +
            '</div>' +
            '<span class="tag ' + (isRevisi ? 't-pu' : 't-in') + '">' + (isRevisi ? 'Revisi v' + e.versi : 'Versi 1') + '</span>' +
          '</div>' +
          '<div style="margin-top:10px;padding-top:10px;border-top:1px solid rgba(0,0,0,.06);display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:8px">' +
            '<div>' +
              '<span style="color:var(--mut);font-size:12px">PIC: <b>' + e.nama_pic + '</b> (' + (e.nama_unit || '-') + ')</span> · ' +
              '<span style="color:var(--mut);font-size:12px">' + e.waktu_unggah + '</span>' +
            '</div>' +
            '<a href="' + e.path_file + '" target="_blank" rel="noopener noreferrer" class="btn sm" style="text-decoration:none;display:inline-flex;align-items:center;gap:6px">' +
              (isLink
                ? '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg><span>Buka Tautan (' + (e.format_file === 'gdrive' ? 'Google Drive' : 'Cloud Link') + ') ↗</span>'
                : '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="12" y1="18" x2="12" y2="12"/><line x1="9" y1="15" x2="15" y2="15"/></svg><span>Buka Berkas Fisik (' + e.ukuran_file_mb + ' MB) ↗</span>'
              ) +
            '</a>' +
          '</div>' +
        '</div>';

      var parsedVal = parseEvidenNilai(e);
      if (parsedVal) {
        bodyHtml += '<div class="upl-structured-box" style="margin-bottom:14px">';
        if (parsedVal._type === 'numeric') {
          bodyHtml += '<div class="upl-structured-title">Data Realisasi Kuantitatif PIC</div>' +
            '<div class="upl-structured-grid">' +
              '<div><span style="color:var(--mut)">Pagu Anggaran:</span><br><b>' + formatRupiah(parsedVal.pagu) + '</b></div>' +
              '<div><span style="color:var(--mut)">Realisasi Anggaran:</span><br><b>' + formatRupiah(parsedVal.realisasi) + '</b></div>' +
              '<div><span style="color:var(--mut)">Persentase Capaian:</span><br><b style="color:var(--pri)">' + (parsedVal.persen || 0) + '%</b></div>' +
              '<div><span style="color:var(--mut)">Rekap Pegawai:</span><br><b>' + (parsedVal.pegawai || 0) + ' Orang</b></div>' +
            '</div>' +
            (parsedVal.catatan ? '<div style="margin-top:8px;font-size:12px;color:var(--tx)"><b>Uraian PIC:</b> ' + escapeAttr(parsedVal.catatan) + '</div>' : '');
        } else if (parsedVal._type === 'binary_score') {
          var isYa = parseInt(parsedVal.skor) === 1;
          bodyHtml += '<div class="upl-structured-title">Penilaian Checklist KKR</div>' +
            '<div style="display:flex;align-items:center;gap:8px;margin:6px 0">' +
              '<span class="tag ' + (isYa ? 't-ok' : 't-er') + '" style="font-size:13px;font-weight:700">' + (isYa ? 'YA (Skor: 1 - Memenuhi Standar)' : 'TIDAK (Skor: 0 - Belum Memenuhi)') + '</span>' +
            '</div>' +
            (parsedVal.catatan ? '<div style="margin-top:6px;font-size:12px;color:var(--tx)"><b>Justifikasi Pemenuhan:</b> ' + escapeAttr(parsedVal.catatan) + '</div>' : '');
        } else if (parsedVal._type === 'pbj_matrix') {
          var countS = (parsedVal.kualitas ? 1 : 0) + (parsedVal.jumlah ? 1 : 0) + (parsedVal.harga ? 1 : 0) + (parsedVal.penyedia ? 1 : 0);
          bodyHtml += '<div class="upl-structured-title">Hasil Evaluasi Matriks 4 Tepat PBJ</div>' +
            '<div class="upl-pbj-grid">' +
              '<div class="upl-pbj-cell ' + (parsedVal.kualitas ? 'ok' : 'no') + '">Kualitas: <b>' + (parsedVal.kualitas ? 'Tepat' : 'Tidak') + '</b></div>' +
              '<div class="upl-pbj-cell ' + (parsedVal.jumlah ? 'ok' : 'no') + '">Jumlah: <b>' + (parsedVal.jumlah ? 'Tepat' : 'Tidak') + '</b></div>' +
              '<div class="upl-pbj-cell ' + (parsedVal.harga ? 'ok' : 'no') + '">Harga: <b>' + (parsedVal.harga ? 'Tepat' : 'Tidak') + '</b></div>' +
              '<div class="upl-pbj-cell ' + (parsedVal.penyedia ? 'ok' : 'no') + '">Penyedia: <b>' + (parsedVal.penyedia ? 'Tepat' : 'Tidak') + '</b></div>' +
            '</div>' +
            '<div style="margin-top:8px;font-size:12px;display:flex;justify-content:space-between">' +
              '<span>Skor Kesesuaian: <b>' + countS + '/4 Parameter Tepat</b></span>' +
              '<span>Nilai Kontrak: <b>' + formatRupiah(parsedVal.nilai_kontrak) + '</b></span>' +
            '</div>' +
            (parsedVal.catatan ? '<div style="margin-top:6px;font-size:12px;color:var(--tx)"><b>Catatan PBJ:</b> ' + escapeAttr(parsedVal.catatan) + '</div>' : '');
        } else if (parsedVal._type === 'risk_scale') {
          var sc = parseInt(parsedVal.skor_risiko) || (parseInt(parsedVal.kemungkinan) * parseInt(parsedVal.dampak)) || 1;
          var lvl = sc >= 16 ? 'Ekstrem' : (sc >= 10 ? 'Tinggi' : (sc >= 5 ? 'Sedang' : 'Rendah'));
          var cls = sc >= 16 ? 't-er' : (sc >= 10 ? 't-wn' : (sc >= 5 ? 't-in' : 't-ok'));
          bodyHtml += '<div class="upl-structured-title">Matriks Level Risiko Kepatuhan</div>' +
            '<div style="display:flex;align-items:center;justify-content:space-between;margin:6px 0">' +
              '<span>Tingkat Kemungkinan: <b>' + parsedVal.kemungkinan + '/5</b> · Tingkat Dampak: <b>' + parsedVal.dampak + '/5</b></span>' +
              '<span class="tag ' + cls + '" style="font-weight:700">Skor Risiko: ' + sc + ' (' + lvl + ')</span>' +
            '</div>' +
            (parsedVal.mitigasi ? '<div style="margin-top:6px;font-size:12px;color:var(--tx)"><b>Rencana Mitigasi:</b> ' + escapeAttr(parsedVal.mitigasi) + '</div>' : '');
        }
        bodyHtml += '</div>';
      }

      bodyHtml += (e.catatan_temuan ? '<div style="background:#fffbeb;border:1px solid #fef3c7;border-radius:10px;padding:10px 14px;margin-bottom:14px;font-size:12.5px;color:#92400e"><b>Catatan Temuan / Pengembalian Sebelumnya:</b><br>' + e.catatan_temuan + '</div>' : '') +
        '<div class="rev-choice-card selected-ok" id="choiceCardOk">' +
          '<input type="radio" name="popRevSt" id="rbRevOk" value="ok" checked style="margin-top:3px">' +
          '<div>' +
            '<label for="rbRevOk" style="font-weight:700;color:#166534;cursor:pointer;display:block">Sesuai</label>' +
          '</div>' +
        '</div>' +
        '<div class="rev-choice-card" id="choiceCardNo">' +
          '<input type="radio" name="popRevSt" id="rbRevNo" value="no" style="margin-top:3px">' +
          '<div>' +
            '<label for="rbRevNo" style="font-weight:700;color:#991b1b;cursor:pointer;display:block">Tidak sesuai</label>' +
          '</div>' +
        '</div>' +
        '<div style="margin-top:12px">' +
          '<label style="display:block;font-size:12px;font-weight:700;color:var(--mut);margin-bottom:6px">Catatan <span id="lblCatatanReq" style="color:var(--er);display:none">*Wajib</span></label>' +
          '<textarea id="popRevCatatan" style="width:100%;min-height:64px;border:1px solid var(--bd);border-radius:10px;padding:10px;font:inherit;background:#fff" placeholder="Catatan perbaikan...">' + (e.catatan_temuan || '') + '</textarea>' +
        '</div>' +
      '</div>';

      openModal({
        title: "Review Eviden",
        body: bodyHtml,
        okText: "Simpan",
        cancelText: "Batal",
        width: "600px",
        onOk: function(){
          var st = document.querySelector('input[name="popRevSt"]:checked').value;
          var cat = document.getElementById("popRevCatatan").value.trim();
          if (st === 'no' && !cat) {
            alert("Catatan temuan wajib diisi jika berkas dinyatakan tidak sesuai!");
            return;
          }
          var payload = [{ id_eviden: e.id_eviden, status: st, catatan: cat }];
          var fd = new FormData();
          fd.append('action', 'submit_review');
          fd.append('reviews', JSON.stringify(payload));
          fetch('ajax.php', { method: 'POST', body: fd }).then(function(r){ return r.json(); }).then(function(res){
            toast(res.message);
            closeModal();
            if (res.success) fetchInit(function(){ renderReview(); });
          });
        }
      });

      var cOk = document.getElementById("choiceCardOk");
      var cNo = document.getElementById("choiceCardNo");
      var rOk = document.getElementById("rbRevOk");
      var rNo = document.getElementById("rbRevNo");
      var lblReq = document.getElementById("lblCatatanReq");
      function syncChoices(){
        if (rOk.checked) {
          cOk.className = "rev-choice-card selected-ok";
          cNo.className = "rev-choice-card";
          lblReq.style.display = "none";
        } else {
          cOk.className = "rev-choice-card";
          cNo.className = "rev-choice-card selected-no";
          lblReq.style.display = "inline";
        }
      }
      cOk.onclick = function(){ rOk.checked = true; syncChoices(); };
      cNo.onclick = function(){ rNo.checked = true; syncChoices(); };
      rOk.onchange = syncChoices;
      rNo.onchange = syncChoices;
    }
  }

  function copyFallback(text) {
    var ta = document.createElement("textarea");
    ta.value = text;
    ta.style.position = "fixed";
    ta.style.left = "-9999px";
    document.body.appendChild(ta);
    ta.focus();
    ta.select();
    try {
      document.execCommand("copy");
      toast("Teks berhasil disalin.");
    } catch (err) {
      prompt("Salin teks di bawah ini (Ctrl+C):", text);
    }
    document.body.removeChild(ta);
  }

  // --- 8. APPROVAL KETUA SKI & EKSPOR MODUL AKHIR GFORM ITJEN ---
  function downloadModulAkhirCsv(m, mInds, mEvs, rec) {
    var lines = [];
    var isPimApproved = (rec && rec.keputusan_pimpinan === 'Disetujui') || (mEvs.length > 0 && mEvs.every(function(e){ return e.status_eviden === 'f'; }));
    
    function csvEsc(val) {
      if (val === null || val === undefined) return '""';
      var s = String(val).replace(/"/g, '""').replace(/\r\n|\n|\r/g, ' ');
      return '"' + s + '"';
    }

    // Header Dokumen Resmi
    lines.push([csvEsc("KEMENTERIAN KESEHATAN REPUBLIK INDONESIA")].join(","));
    lines.push([csvEsc("BALAI BESAR PELATIHAN KESEHATAN (BBPK) JAKARTA")].join(","));
    lines.push([csvEsc("LAPORAN AKHIR HASIL PENGAWASAN KEPATUHAN INTERNAL (SKI)")].join(","));
    lines.push([csvEsc("FORMAT PELAPORAN RESMI INSPEKTORAT JENDERAL KEMENKES RI")].join(","));
    lines.push("");

    // Profil Modul
    lines.push([csvEsc("Nama Modul Pengawasan"), csvEsc(m.nama_modul)].join(","));
    lines.push([csvEsc("Kode Modul"), csvEsc(m.kode_modul || m.id_modul)].join(","));
    lines.push([csvEsc("Unit Kerja Pelaksana (PIC)"), csvEsc(m.nama_unit || "-")].join(","));
    lines.push([csvEsc("Kategori Modul"), csvEsc(m.kategori || "Pengawasan Rutin")].join(","));
    lines.push([csvEsc("Tanggal Ekspor"), csvEsc(new Date().toLocaleString('id-ID'))].join(","));
    lines.push([csvEsc("Status Legalisasi Akhir"), csvEsc(isPimApproved ? "Disetujui Penuh oleh Kepala BBPK Jakarta (Tuntas / Itjen Ready)" : "Dalam Proses Pengawasan")].join(","));
    lines.push("");

    // Legalisasi & Persetujuan
    lines.push([csvEsc("=== LEGALISASI DAN DISPOSISI RESMI ===")].join(","));
    lines.push([csvEsc("Ketua Tim SKI (Penyusun & Validator)"), csvEsc(rec && rec.nama_ketua ? rec.nama_ketua : "Ketua SKI BBPK Jakarta")].join(","));
    lines.push([csvEsc("Poin Rekomendasi Resmi SKI"), csvEsc(rec && rec.poin_rekomendasi ? rec.poin_rekomendasi : "-")].join(","));
    lines.push([csvEsc("Kepala BBPK Jakarta (Pimpinan)"), csvEsc(rec && rec.nama_pimpinan ? rec.nama_pimpinan : "Kepala BBPK Jakarta")].join(","));
    lines.push([csvEsc("Keputusan Pimpinan"), csvEsc(rec && rec.keputusan_pimpinan ? rec.keputusan_pimpinan : (isPimApproved ? "Disetujui" : "Menunggu"))].join(","));
    lines.push([csvEsc("Catatan Disposisi Pimpinan"), csvEsc(rec && rec.catatan_disposisi ? rec.catatan_disposisi : "-")].join(","));
    lines.push("");

    // Matriks Indikator & Eviden
    lines.push([csvEsc("=== MATRIKS RINCIAN BUTIR INDIKATOR & BUKTI DUKUNG EVIDEN ===")].join(","));
    lines.push([
      csvEsc("No"),
      csvEsc("Nomor Indikator"),
      csvEsc("Uraian Butir Indikator"),
      csvEsc("Target / Bobot"),
      csvEsc("Nama File / Eviden Terakhir"),
      csvEsc("Tautan / Link Eviden (Google Drive / Berkas)"),
      csvEsc("Versi"),
      csvEsc("Pengunggah (PIC)"),
      csvEsc("Waktu Unggah"),
      csvEsc("Status Eviden"),
      csvEsc("Hasil Review Kesesuaian SKI"),
      csvEsc("Catatan Temuan / Rekomendasi Reviewer")
    ].join(","));

    mInds.forEach(function(ind, idx){
      var evList = mEvs.filter(function(e){ return e.id_indikator === ind.id_indikator; });
      var latestEv = evList.length > 0 ? evList[0] : null;

      var evName = latestEv ? latestEv.nama_file : "(Belum ada eviden)";
      var evPath = latestEv ? (latestEv.path_file || "-") : "-";
      var evVer = latestEv ? "v" + latestEv.versi : "-";
      var evPic = latestEv ? (latestEv.nama_pic || "-") : "-";
      var evTime = latestEv ? (latestEv.waktu_unggah || "-") : "-";
      
      var stEv = "-";
      if (latestEv) {
        if (latestEv.status_eviden === 'f') stEv = "Final / Disetujui Pimpinan";
        else if (latestEv.status_eviden === 'a') stEv = "Disetujui Ketua SKI";
        else if (latestEv.status_eviden === 'o') stEv = "Sesuai / Menunggu Approval";
        else if (latestEv.status_eviden === 'r') stEv = "Perlu Revisi PIC";
        else stEv = "Menunggu Review";
      }

      var stRev = latestEv && latestEv.status_kesesuaian ? latestEv.status_kesesuaian : "-";
      var catRev = latestEv && latestEv.catatan_temuan ? latestEv.catatan_temuan : "-";

      lines.push([
        csvEsc(idx + 1),
        csvEsc(ind.nomor_indikator || (idx + 1)),
        csvEsc(ind.deskripsi_indikator),
        csvEsc(ind.target_bobot ? (ind.target_bobot + (ind.satuan ? " " + ind.satuan : "")) : "-"),
        csvEsc(evName),
        csvEsc(evPath),
        csvEsc(evVer),
        csvEsc(evPic),
        csvEsc(evTime),
        csvEsc(stEv),
        csvEsc(stRev),
        csvEsc(catRev)
      ].join(","));
    });

    lines.push("");
    lines.push([csvEsc("Dokumen ini dihasilkan secara otomatis oleh Sistem Monev SKI BBPK Jakarta untuk Pelaporan ke Inspektorat Jenderal Kemenkes RI.")].join(","));

    var csvContent = "\uFEFF" + lines.join("\r\n");
    var blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    var url = URL.createObjectURL(blob);
    var link = document.createElement("a");
    var cleanTitle = (m.nama_modul || 'Modul').replace(/[^a-zA-Z0-9_-]/g, '_');
    link.setAttribute("href", url);
    link.setAttribute("download", "Laporan_Akhir_Modul_" + cleanTitle + "_BBPK_Jakarta.csv");
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    URL.revokeObjectURL(url);
  }

  function printModulAkhirPdf(m, mInds, mEvs, rec) {
    var isPimApproved = (rec && rec.keputusan_pimpinan === 'Disetujui') || (mEvs.length > 0 && mEvs.every(function(e){ return e.status_eviden === 'f'; }));
    var safeTitle = escapeHtml(m.nama_modul);
    var printWin = window.open('', '_blank');
    if (!printWin) {
      alert("Jendela pratinjau cetak diblokir oleh browser. Harap izinkan pop-up untuk mencetak berkas laporan resmi.");
      return;
    }

    var curYear = new Date().getFullYear();
    var todayStr = new Intl.DateTimeFormat('id-ID', { dateStyle: 'long' }).format(new Date());

    var docHtml = '<!DOCTYPE html>' +
      '<html lang="id">' +
      '<head>' +
        '<meta charset="UTF-8">' +
        '<title>Laporan Hasil Pengawasan SKI - ' + safeTitle + '</title>' +
        '<style>' +
          '@page { size: A4 portrait; margin: 15mm 15mm 15mm 15mm; }' +
          'body { font-family: "Segoe UI", Arial, Helvetica, sans-serif; font-size: 11pt; color: #1e293b; line-height: 1.45; margin: 0; padding: 20px; background: #fff; }' +
          '.kop { display: flex; align-items: center; justify-content: center; gap: 18px; text-align: center; border-bottom: 3px double #0f172a; padding-bottom: 12px; margin-bottom: 18px; }' +
          '.kop-text h2 { margin: 0; font-size: 13pt; font-weight: 800; letter-spacing: 0.5px; color: #0f172a; text-transform: uppercase; }' +
          '.kop-text h3 { margin: 2px 0 0; font-size: 11.5pt; font-weight: 700; color: #0d9488; text-transform: uppercase; }' +
          '.kop-text p { margin: 3px 0 0; font-size: 8.5pt; color: #475569; }' +
          '.title-doc { text-align: center; margin: 16px 0 18px; }' +
          '.title-doc h1 { margin: 0; font-size: 13pt; font-weight: 800; color: #0f172a; text-transform: uppercase; text-decoration: underline; }' +
          '.title-doc .nomor { font-size: 9.5pt; color: #475569; margin-top: 4px; }' +
          '.meta-table { width: 100%; border-collapse: collapse; margin-bottom: 16px; font-size: 10pt; }' +
          '.meta-table td { padding: 4px 6px; vertical-align: top; }' +
          '.meta-table td.lbl { width: 26%; font-weight: 700; color: #334155; }' +
          '.meta-table td.colon { width: 2%; text-align: center; }' +
          '.box-dispo { border: 1.5px solid #cbd5e1; border-radius: 8px; padding: 10px 14px; margin-bottom: 16px; background: #f8fafc; font-size: 9.5pt; }' +
          '.box-dispo h4 { margin: 0 0 6px; font-size: 10pt; color: #0d9488; text-transform: uppercase; }' +
          '.data-table { width: 100%; border-collapse: collapse; margin-bottom: 22px; font-size: 9pt; }' +
          '.data-table th, .data-table td { border: 1px solid #94a3b8; padding: 6px 8px; vertical-align: top; }' +
          '.data-table th { background: #f1f5f9; font-weight: 700; text-align: center; color: #0f172a; text-transform: uppercase; font-size: 8.5pt; }' +
          '.ttd-grid { width: 100%; display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-top: 24px; page-break-inside: avoid; }' +
          '.ttd-box { text-align: center; font-size: 10pt; line-height: 1.35; }' +
          '.ttd-space { height: 65px; display: flex; align-items: center; justify-content: center; }' +
          '.stamp-badge { border: 1.5px dashed #0d9488; color: #0d9488; padding: 4px 10px; border-radius: 6px; font-weight: 800; font-size: 9pt; display: inline-block; transform: rotate(-3deg); }' +
          '.footer-note { margin-top: 30px; font-size: 8pt; color: #64748b; border-top: 1px solid #e2e8f0; padding-top: 8px; text-align: center; font-style: italic; }' +
          '@media print { .no-print { display: none !important; } body { padding: 0; } }' +
        '</style>' +
      '</head>' +
      '<body>' +
        '<div class="no-print" style="position:sticky;top:0;background:#0f172a;color:#fff;padding:12px 18px;border-radius:10px;margin-bottom:20px;display:flex;justify-content:space-between;align-items:center;box-shadow:0 4px 12px rgba(0,0,0,.2)">' +
          '<div><b>Pratinjau cetak</b></div>' +
          '<div style="display:flex;gap:8px">' +
            '<button onclick="window.print()" style="background:#0d9488;color:#fff;border:none;padding:7px 16px;border-radius:6px;font-weight:700;cursor:pointer">Cetak PDF</button>' +
            '<button onclick="window.close()" style="background:#475569;color:#fff;border:none;padding:7px 14px;border-radius:6px;cursor:pointer">Tutup</button>' +
          '</div>' +
        '</div>' +

        '<div class="kop">' +
          '<div class="kop-text">' +
            '<h2>KEMENTERIAN KESEHATAN REPUBLIK INDONESIA</h2>' +
            '<h3>BALAI BESAR PELATIHAN KESEHATAN (BBPK) JAKARTA</h3>' +
            '<p>Jl. Hang Jebat III Blok F3, Kebayoran Baru, Jakarta Selatan 12120 · Telp: (021) 7244415 · Laman: bbpkjakarta.kemkes.go.id</p>' +
          '</div>' +
        '</div>' +

        '<div class="title-doc">' +
          '<h1>LAPORAN HASIL PENGAWASAN KEPATUHAN INTERNAL (SKI)</h1>' +
          '<div class="nomor">Nomor Dokumen: BBPK/SKI/MODUL-' + (m.kode_modul || m.id_modul) + '/' + curYear + '</div>' +
        '</div>' +

        '<table class="meta-table">' +
          '<tr><td class="lbl">Modul Pengawasan</td><td class="colon">:</td><td><b>' + safeTitle + '</b></td></tr>' +
          '<tr><td class="lbl">Unit Kerja Pelaksana (PIC)</td><td class="colon">:</td><td>' + escapeHtml(m.nama_unit || '-') + '</td></tr>' +
          '<tr><td class="lbl">Kategori Modul</td><td class="colon">:</td><td>' + escapeHtml(m.kategori || 'Pengawasan Rutin') + '</td></tr>' +
          '<tr><td class="lbl">Status Verifikasi &amp; Approval</td><td class="colon">:</td><td><b>' + (isPimApproved ? 'Disetujui Penuh oleh Kepala BBPK (Tuntas &amp; Siap Lapor Itjen)' : 'Dalam Proses Pengawasan') + '</b></td></tr>' +
          '<tr><td class="lbl">Tanggal Pengesahan</td><td class="colon">:</td><td>' + todayStr + '</td></tr>' +
        '</table>' +

        '<div class="box-dispo">' +
          '<h4>I. Rekomendasi Resmi Tim Satuan Kepatuhan Internal (SKI)</h4>' +
          '<div style="font-style:' + (rec && rec.poin_rekomendasi ? 'normal' : 'italic') + '">' +
            (rec && rec.poin_rekomendasi ? escapeHtml(rec.poin_rekomendasi) : 'Seluruh bukti pemenuhan butir indikator telah diverifikasi secara objektif dan dinyatakan memenuhi standar kepatuhan BBPK Jakarta.') +
          '</div>' +
        '</div>' +

        '<div class="box-dispo" style="background:#f0fdf4;border-color:#86efac">' +
          '<h4 style="color:#16a34a">II. Lembar Disposisi &amp; Penetapan Kepala BBPK Jakarta</h4>' +
          '<div style="color:#14532d">' +
            '<b>Keputusan:</b> ' + (rec && rec.keputusan_pimpinan ? escapeHtml(rec.keputusan_pimpinan) : (isPimApproved ? 'Disetujui' : 'Menunggu Penetapan')) + '<br>' +
            (rec && rec.catatan_disposisi ? '<div style="margin-top:4px"><b>Catatan Disposisi:</b> ' + escapeHtml(rec.catatan_disposisi) + '</div>' : '<div style="margin-top:4px;font-style:italic">Dokumen hasil evaluasi kepatuhan disetujui untuk diunggah pada formulir Inspektorat Jenderal Kemenkes RI.</div>') +
          '</div>' +
        '</div>' +

        '<div style="font-weight:700;font-size:10pt;color:#0f172a;margin-bottom:6px;text-transform:uppercase">III. Matriks Butir Indikator &amp; Hasil Evaluasi Bukti Kepatuhan</div>' +
        '<table class="data-table">' +
          '<thead><tr>' +
            '<th style="width:28px">No</th>' +
            '<th>Butir Tagihan / Indikator</th>' +
            '<th style="width:26%">Dokumen Bukti (Eviden)</th>' +
            '<th style="width:18%">Hasil Verifikasi SKI</th>' +
            '<th style="width:14%">Status Akhir</th>' +
          '</tr></thead>' +
          '<tbody>';

    mInds.forEach(function(ind, idx){
      var evList = mEvs.filter(function(e){ return e.id_indikator === ind.id_indikator; });
      var latestEv = evList.length > 0 ? evList[0] : null;

      var evLabel = latestEv ? escapeHtml(latestEv.nama_file) + '<br><small style="color:#64748b">v' + latestEv.versi + ' · ' + (latestEv.waktu_unggah || '') + '</small>' : '<i style="color:#94a3b8">(Belum diunggah)</i>';
      var revLabel = latestEv && latestEv.status_kesesuaian ? escapeHtml(latestEv.status_kesesuaian) + (latestEv.catatan_temuan ? '<br><small style="color:#64748b">' + escapeHtml(latestEv.catatan_temuan) + '</small>' : '') : '-';

      var finalBadge = 'Belum Selesai';
      if (latestEv) {
        if (latestEv.status_eviden === 'f') finalBadge = 'Disetujui Pimpinan';
        else if (latestEv.status_eviden === 'a') finalBadge = 'Disetujui Ketua SKI';
        else if (latestEv.status_eviden === 'o') finalBadge = 'Sesuai (Proses)';
        else if (latestEv.status_eviden === 'r') finalBadge = 'Perlu Revisi';
      }

      docHtml += '<tr>' +
        '<td style="text-align:center">' + (idx + 1) + '</td>' +
        '<td><b>' + escapeHtml(ind.deskripsi_indikator) + '</b></td>' +
        '<td>' + evLabel + '</td>' +
        '<td>' + revLabel + '</td>' +
        '<td style="text-align:center;font-weight:700">' + finalBadge + '</td>' +
      '</tr>';
    });

    docHtml += '</tbody></table>' +

        '<div class="ttd-grid">' +
          '<div class="ttd-box">' +
            '<div>Disahkan oleh,<br><b>Kepala Balai Besar Pelatihan Kesehatan Jakarta</b></div>' +
            '<div class="ttd-space">' +
              '<div class="stamp-badge">DIGITAL SIGNED<br><small>' + todayStr + '</small></div>' +
            '</div>' +
            '<div><b>' + (rec && rec.nama_pimpinan ? escapeHtml(rec.nama_pimpinan) : 'Kepala BBPK Jakarta') + '</b><br><span style="font-size:9pt;color:#64748b">NIP. 197405121999031002</span></div>' +
          '</div>' +

          '<div class="ttd-box">' +
            '<div>Jakarta, ' + todayStr + '<br><b>Ketua Tim Satuan Kepatuhan Internal (SKI)</b></div>' +
            '<div class="ttd-space">' +
              '<div class="stamp-badge">VALIDATED SKI<br><small>' + todayStr + '</small></div>' +
            '</div>' +
            '<div><b>' + (rec && rec.nama_ketua ? escapeHtml(rec.nama_ketua) : 'Ketua SKI BBPK') + '</b><br><span style="font-size:9pt;color:#64748b">NIP. 198208172006041001</span></div>' +
          '</div>' +
        '</div>' +

        '<div class="footer-note">' +
          'Dokumen resmi ini diterbitkan secara elektronik oleh Sistem Monitoring &amp; Evaluasi SKI Balai Besar Pelatihan Kesehatan Jakarta ' +
          'sebagai bukti kepatuhan internal untuk pelaporan ke Inspektorat Jenderal Kementerian Kesehatan Republik Indonesia.' +
        '</div>' +
      '</body>' +
      '</html>';

    printWin.document.open();
    printWin.document.write(docHtml);
    printWin.document.close();
  }

  function exportModulePdf(modulId) {
    var m = STATE.moduls.find(function(item){ return item.id_modul === modulId; });
    if (!m) return;
    var mInds = STATE.indikators.filter(function(item){ return item.id_modul === modulId; });
    var mEvs = STATE.evidens.filter(function(item){ return item.id_modul === modulId; });
    var rec = (STATE.rekomendasi || []).find(function(item){ return item.id_modul === modulId; });
    printModulAkhirPdf(m, mInds, mEvs, rec);
  }

  function modulHasPhysicalFiles(modulId) {
    var mEvs = STATE.evidens.filter(function(e){ return e.id_modul === modulId; });
    if (!mEvs || mEvs.length === 0) return false;
    return mEvs.some(function(e){
      if (!e || !e.path_file) return false;
      var isUrl = isEvidenUrl(e.path_file) || e.format_file === 'link' || e.format_file === 'gdrive' || e.format_file === 'onedrive' || e.format_file === 'dropbox';
      if (isUrl) return false;
      var p = (e.path_file || '').toLowerCase();
      var n = (e.nama_file || '').toLowerCase();
      var f = (e.format_file || '').toLowerCase();
      var isWord = p.endsWith('.docx') || p.endsWith('.doc') || f === 'docx' || f === 'doc' || n.endsWith('.docx') || n.endsWith('.doc');
      var isExcel = p.endsWith('.xlsx') || p.endsWith('.xls') || f === 'xlsx' || f === 'xls' || n.endsWith('.xlsx') || n.endsWith('.xls');
      var isPdf = p.endsWith('.pdf') || f === 'pdf' || n.endsWith('.pdf');
      return isWord || isExcel || isPdf || (e.path_file !== '' && e.path_file !== '#');
    });
  }

  function openExportModal(modulId) {
    var m = STATE.moduls.find(function(x){ return x.id_modul === modulId; });
    if (!m) return;
    var mInds = STATE.indikators.filter(function(i){ return i.id_modul === modulId; });
    var mEvs = STATE.evidens.filter(function(e){ return e.id_modul === modulId; });
    var hasPhysical = modulHasPhysicalFiles(modulId);
    var hasWord = mEvs.some(function(e){
      if (!e || !e.path_file || isEvidenUrl(e.path_file)) return false;
      var p = (e.path_file || '').toLowerCase(), n = (e.nama_file || '').toLowerCase(), f = (e.format_file || '').toLowerCase();
      return p.endsWith('.docx') || p.endsWith('.doc') || f === 'docx' || f === 'doc' || n.endsWith('.docx') || n.endsWith('.doc');
    });

    var bannerHtml = '';
    if (hasPhysical) {
      bannerHtml = '<div style="background:#f0fdf4;border:1.5px solid #86efac;border-radius:12px;padding:12px 16px;margin-bottom:14px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px">' +
        '<div>' +
          '<div style="font-weight:800;color:#166534;font-size:13px;display:flex;align-items:center;gap:6px">' +
            'Ekspor Bukti Dukung' +
          '</div>' +
          '<div style="font-size:11.5px;color:#15803d;margin-top:2px">' +
            'Unduh paket arsip ZIP untuk seluruh berkas fisik bukti dukung yang telah diunggah.' +
          '</div>' +
        '</div>' +
        '<div style="display:flex;gap:8px;flex-wrap:wrap">' +
          '<a href="ajax.php?action=export_evidens_zip&id_modul=' + m.id_modul + '" class="btn sm" style="background:#0d9488;color:#fff;text-decoration:none;font-weight:700;display:inline-flex;align-items:center;gap:6px;box-shadow:0 2px 8px rgba(13,148,136,.25)">' +
            '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M7 10l5 5 5-5M12 15V3"/></svg> Unduh Semua Eviden (ZIP)' +
          '</a>' +
          (hasWord ? ('<a href="ajax.php?action=export_evidens_zip&id_modul=' + m.id_modul + '&word_to_pdf=1" class="btn sm o" style="border-color:#0d9488;color:#0d9488;text-decoration:none;font-weight:700;display:inline-flex;align-items:center;gap:6px;background:#fff" title="Unduh ZIP dan sertakan juga versi PDF untuk dokumen Word">' +
            '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg> Unduh ZIP (+ PDF Word)' +
          '</a>') : '') +
          '<button type="button" class="btn sm o" id="btnCopyAllEvidenLinks" style="border-color:#64748b;color:#334155;font-weight:700;display:inline-flex;align-items:center;gap:6px;background:#fff">' +
            '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg> Salin Link' +
          '</button>' +
        '</div>' +
      '</div>';
    } else {
      // Formatnya link Google Drive: tombol Unduh Semua Eviden (ZIP) dan Unduh ZIP dihilangkan
      bannerHtml = '<div style="background:#f8fafc;border:1.5px solid #cbd5e1;border-radius:12px;padding:12px 16px;margin-bottom:14px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px">' +
        '<div>' +
          '<div style="font-weight:800;color:#334155;font-size:13px;display:flex;align-items:center;gap:6px">' +
            'Tautan Google Drive' +
          '</div>' +
          '<div style="font-size:11.5px;color:#64748b;margin-top:2px">' +
            'Buka tautan dari daftar atau salin semuanya.' +
          '</div>' +
        '</div>' +
        '<div style="display:flex;gap:8px;flex-wrap:wrap">' +
          '<button type="button" class="btn sm" id="btnCopyAllEvidenLinks" style="background:#0d9488;color:#fff;font-weight:700;display:inline-flex;align-items:center;gap:6px">' +
            '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg> Salin Semua Link' +
          '</button>' +
        '</div>' +
      '</div>';
    }

    var popHtml = '<div style="font-size:13px">' +
      '<div style="background:linear-gradient(135deg,#0d9488,#075e57);color:#fff;padding:16px 20px;border-radius:16px;margin-bottom:14px;box-shadow:0 4px 16px rgba(13,148,136,.2)">' +
        '<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px;flex-wrap:wrap;gap:6px">' +
          '<span style="font-size:11px;font-weight:700;letter-spacing:.05em;text-transform:uppercase;opacity:.9">BALAI BESAR PELATIHAN KESEHATAN JAKARTA · SATUAN KEPATUHAN INTERNAL</span>' +
          '<span class="tag t-ok" style="font-weight:800;font-size:11px">' + mEvs.length + ' eviden</span>' +
        '</div>' +
        '<h3 style="margin:0 0 4px;font-size:19px;color:#fff">' + escapeHtml(m.nama_modul) + '</h3>' +
        '<div style="font-size:12.5px;opacity:.92">Unit Kerja PIC: <b>' + escapeHtml(m.nama_unit || '-') + '</b> · ' + (hasPhysical ? 'Ekspor Berkas Bukti Dukung Asli' : 'Tautan Bukti Dukung Google Drive') + '</div>' +
      '</div>' +

      bannerHtml +

      // Tabel Rincian Eviden & Aksi Ekspor Satuan
      '<div style="background:#fff;border:1px solid var(--bd);border-radius:12px;padding:12px 14px;margin-bottom:12px">' +
        '<div style="font-weight:700;color:var(--dk);margin-bottom:8px;display:flex;align-items:center;justify-content:space-between">' +
          '<span style="display:inline-flex;align-items:center;gap:6px"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg> Eviden (' + mEvs.length + ')</span>' +
          '<span style="font-size:11.5px;color:var(--mut)">Pilih format unduhan</span>' +
        '</div>' +
        '<div style="max-height:280px;overflow-y:auto;border:1px solid var(--bd);border-radius:8px">' +
          '<table style="width:100%;font-size:11.5px;border-collapse:collapse">' +
            '<tr style="background:#f8fafc;border-bottom:1px solid var(--bd);position:sticky;top:0;z-index:2">' +
              '<th style="padding:7px 8px;text-align:center;width:24px">No</th>' +
              '<th style="padding:7px 8px;text-align:left;width:32%">Butir Indikator / Tugas</th>' +
              '<th style="padding:7px 8px;text-align:left;width:28%">Berkas Bukti Dukung (Eviden)</th>' +
              '<th style="padding:7px 8px;text-align:center;width:15%">Format</th>' +
              '<th style="padding:7px 8px;text-align:right;width:25%">Aksi Ekspor Satuan</th>' +
            '</tr>' +
            mInds.map(function(ind, idx){
              var evList = mEvs.filter(function(e){ return e.id_indikator === ind.id_indikator; });
              var latestEv = evList.length > 0 ? evList[0] : null;
              var isUrl = latestEv && latestEv.path_file && /^https?:\/\//i.test(latestEv.path_file);
              var hasLocal = latestEv && latestEv.path_file && !isUrl && latestEv.path_file !== '' && latestEv.path_file !== '#';

              var evName = latestEv ? escapeHtml(latestEv.nama_file) : '<i style="color:var(--mut)">Belum ada eviden</i>';
              var formatBadge = '<span class="tag t-gy" style="font-size:10px">Belum Unggah</span>';
              var actBtns = '<span style="color:var(--mut);font-size:11px">-</span>';

              if (latestEv) {
                var pLow = (latestEv.path_file || '').toLowerCase();
                var nLow = (latestEv.nama_file || '').toLowerCase();
                var fmt = (latestEv.format_file || '').toLowerCase();

                if (isUrl) {
                  var isGDoc = pLow.indexOf('docs.google.com/document') !== -1;
                  var isGSheet = pLow.indexOf('docs.google.com/spreadsheets') !== -1;
                  var isGSlide = pLow.indexOf('docs.google.com/presentation') !== -1;
                  var isGFolder = pLow.indexOf('drive.google.com/drive/folders') !== -1;

                  if (isGDoc) {
                    formatBadge = '<span class="tag" style="background:#e0e7ff;color:#3730a3;font-size:10px;font-weight:700">Google Docs</span>';
                    actBtns = '<div style="display:inline-flex;gap:4px;justify-content:flex-end;flex-wrap:wrap">' +
                                '<a href="ajax.php?action=download_eviden&id_eviden=' + latestEv.id_eviden + '&format=docx" class="btn sm" style="background:#2563eb;color:#fff;padding:2px 7px;font-size:10.5px;text-decoration:none" download title="Unduh Word">Word</a>' +
                                '<a href="ajax.php?action=download_eviden&id_eviden=' + latestEv.id_eviden + '&format=pdf" class="btn sm" style="background:#dc2626;color:#fff;padding:2px 7px;font-size:10.5px;text-decoration:none" download title="Unduh PDF">PDF</a>' +
                                '<a href="' + escapeHtml(latestEv.path_file) + '" target="_blank" rel="noopener noreferrer" class="btn sm o" style="padding:2px 6px;font-size:10.5px;text-decoration:none" title="Buka Google Docs">Buka</a>' +
                              '</div>';
                  } else if (isGSheet) {
                    formatBadge = '<span class="tag" style="background:#dcfce7;color:#166534;font-size:10px;font-weight:700">Google Sheets</span>';
                    actBtns = '<div style="display:inline-flex;gap:4px;justify-content:flex-end;flex-wrap:wrap">' +
                                '<a href="ajax.php?action=download_eviden&id_eviden=' + latestEv.id_eviden + '&format=xlsx" class="btn sm" style="background:#059669;color:#fff;padding:2px 7px;font-size:10.5px;text-decoration:none" download title="Unduh Excel">Excel</a>' +
                                '<a href="ajax.php?action=download_eviden&id_eviden=' + latestEv.id_eviden + '&format=pdf" class="btn sm" style="background:#dc2626;color:#fff;padding:2px 7px;font-size:10.5px;text-decoration:none" download title="Unduh PDF">PDF</a>' +
                                '<a href="' + escapeHtml(latestEv.path_file) + '" target="_blank" rel="noopener noreferrer" class="btn sm o" style="padding:2px 6px;font-size:10.5px;text-decoration:none" title="Buka Google Sheets">Buka</a>' +
                              '</div>';
                  } else if (isGSlide) {
                    formatBadge = '<span class="tag" style="background:#fef3c7;color:#92400e;font-size:10px;font-weight:700">Google Slides</span>';
                    actBtns = '<div style="display:inline-flex;gap:4px;justify-content:flex-end;flex-wrap:wrap">' +
                                '<a href="ajax.php?action=download_eviden&id_eviden=' + latestEv.id_eviden + '&format=pptx" class="btn sm" style="background:#d97706;color:#fff;padding:2px 7px;font-size:10.5px;text-decoration:none" download title="Unduh PPTX">PPTX</a>' +
                                '<a href="ajax.php?action=download_eviden&id_eviden=' + latestEv.id_eviden + '&format=pdf" class="btn sm" style="background:#dc2626;color:#fff;padding:2px 7px;font-size:10.5px;text-decoration:none" download title="Unduh PDF">PDF</a>' +
                                '<a href="' + escapeHtml(latestEv.path_file) + '" target="_blank" rel="noopener noreferrer" class="btn sm o" style="padding:2px 6px;font-size:10.5px;text-decoration:none" title="Buka Google Slides">Buka</a>' +
                              '</div>';
                  } else if (isGFolder) {
                    formatBadge = '<span class="tag" style="background:#f1f5f9;color:#334155;font-size:10px;font-weight:700">Folder GDrive</span>';
                    actBtns = '<div style="display:inline-flex;gap:4px;justify-content:flex-end">' +
                                '<a href="' + escapeHtml(latestEv.path_file) + '" target="_blank" rel="noopener noreferrer" class="btn sm o" style="border-color:#0284c7;color:#0284c7;padding:2px 7px;font-size:10.5px;text-decoration:none">' +
                                  'Buka Folder Drive' +
                                '</a>' +
                              '</div>';
                  } else {
                    formatBadge = '<span class="tag" style="background:#e0f2fe;color:#0369a1;font-size:10px;font-weight:700">File GDrive</span>';
                    actBtns = '<div style="display:inline-flex;gap:4px;justify-content:flex-end;flex-wrap:wrap">' +
                                '<a href="ajax.php?action=download_eviden&id_eviden=' + latestEv.id_eviden + '" class="btn sm" style="background:#0d9488;color:#fff;padding:2px 7px;font-size:10.5px;text-decoration:none" download title="Unduh langsung berkas">' +
                                  'Unduh' +
                                '</a>' +
                                '<a href="' + escapeHtml(latestEv.path_file) + '" target="_blank" rel="noopener noreferrer" class="btn sm o" style="padding:2px 6px;font-size:10.5px;text-decoration:none" title="Buka tautan">' +
                                  'Buka' +
                                '</a>' +
                              '</div>';
                  }
                } else if (hasLocal) {
                  var isWord = pLow.endsWith('.docx') || pLow.endsWith('.doc') || fmt === 'docx' || fmt === 'doc' || nLow.endsWith('.docx') || nLow.endsWith('.doc');
                  var isExcel = pLow.endsWith('.xlsx') || pLow.endsWith('.xls') || fmt === 'xlsx' || fmt === 'xls' || nLow.endsWith('.xlsx') || nLow.endsWith('.xls');
                  var isPdf = pLow.endsWith('.pdf') || fmt === 'pdf' || nLow.endsWith('.pdf');

                  if (isWord) {
                    formatBadge = '<span class="tag" style="background:#dbeafe;color:#1e40af;font-size:10px;font-weight:700">Word (.docx)</span>';
                    actBtns = '<div style="display:inline-flex;gap:4px;justify-content:flex-end;flex-wrap:wrap">' +
                                '<a href="ajax.php?action=download_eviden&id_eviden=' + latestEv.id_eviden + '" class="btn sm" style="background:#2563eb;color:#fff;padding:2px 7px;font-size:10.5px;text-decoration:none" download title="Unduh berkas Word asli">' +
                                  'Word' +
                                '</a>' +
                                '<a href="ajax.php?action=download_eviden&id_eviden=' + latestEv.id_eviden + '&format=pdf" target="_blank" class="btn sm" style="background:#dc2626;color:#fff;padding:2px 7px;font-size:10.5px;text-decoration:none" title="Ekspor dokumen Word ke PDF">' +
                                  'PDF' +
                                '</a>' +
                              '</div>';
                  } else if (isExcel) {
                    formatBadge = '<span class="tag" style="background:#dcfce7;color:#166534;font-size:10px;font-weight:700">Excel (.xlsx)</span>';
                    actBtns = '<div style="display:inline-flex;gap:4px;justify-content:flex-end;flex-wrap:wrap">' +
                                '<a href="ajax.php?action=download_eviden&id_eviden=' + latestEv.id_eviden + '" class="btn sm" style="background:#059669;color:#fff;padding:2px 7px;font-size:10.5px;text-decoration:none" download title="Unduh berkas Excel">' +
                                  'Excel' +
                                '</a>' +
                              '</div>';
                  } else if (isPdf) {
                    formatBadge = '<span class="tag" style="background:#fee2e2;color:#991b1b;font-size:10px;font-weight:700">PDF (.pdf)</span>';
                    actBtns = '<div style="display:inline-flex;gap:4px;justify-content:flex-end">' +
                                '<a href="ajax.php?action=download_eviden&id_eviden=' + latestEv.id_eviden + '" class="btn sm" style="background:#dc2626;color:#fff;padding:2px 7px;font-size:10.5px;text-decoration:none" download title="Unduh berkas PDF">' +
                                  'Unduh' +
                                '</a>' +
                                '<a href="' + escapeHtml(latestEv.path_file) + '" target="_blank" class="btn sm o" style="padding:2px 6px;font-size:10.5px;text-decoration:none" title="Buka berkas di tab baru">' +
                                  'Buka' +
                                '</a>' +
                              '</div>';
                  } else {
                    formatBadge = '<span class="tag" style="background:#f1f5f9;color:#334155;font-size:10px;font-weight:700">Berkas Fisik</span>';
                    actBtns = '<div style="display:inline-flex;gap:4px;justify-content:flex-end">' +
                                '<a href="ajax.php?action=download_eviden&id_eviden=' + latestEv.id_eviden + '" class="btn sm" style="background:#0d9488;color:#fff;padding:2px 7px;font-size:10.5px;text-decoration:none" download title="Unduh berkas">' +
                                  'Unduh' +
                                '</a>' +
                              '</div>';
                  }
                }
              }

              return '<tr style="border-bottom:1px solid var(--bd)">' +
                '<td style="padding:6px 8px;text-align:center">' + (idx + 1) + '</td>' +
                '<td style="padding:6px 8px"><b>' + escapeHtml(ind.deskripsi_indikator) + '</b></td>' +
                '<td style="padding:6px 8px">' + evName + '</td>' +
                '<td style="padding:6px 8px;text-align:center">' + formatBadge + '</td>' +
                '<td style="padding:6px 8px;text-align:right">' + actBtns + '</td>' +
              '</tr>';
            }).join('') +
          '</table>' +
        '</div>' +
      '</div>' +

      // Petunjuk SOP
      '<div style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:12px;padding:12px 14px;margin-bottom:14px;font-size:12.5px;color:#1e3a8a">' +
        '<div style="font-weight:700;margin-bottom:4px;display:flex;align-items:center;gap:6px">' +
          '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6M15 3h6v6M10 14L21 3"/></svg>' +
          'Panduan Ekspor Berkas Eviden:' +
        '</div>' +
        '<ul style="margin:4px 0 0;padding-left:18px;line-height:1.6">' +
          (hasPhysical ? '<li>Unduh semua berkas dalam ZIP.</li>' : '<li>Buka atau salin tautan Google Drive.</li>') +
          '<li>Berkas dokumen Word dapat diunduh dalam format <b>Word (.docx)</b> atau diekspor langsung menjadi <b>PDF</b>.</li>' +
          '<li>Tautan Google Drive (Docs, Sheets, dll.) otomatis diunduh sesuai format file dokumen aslinya.</li>' +
        '</ul>' +
      '</div>' +
    '</div>';

    var footHtml = '<button class="btn o sm" id="mExpClose">Tutup</button>';
    if (hasPhysical) {
      footHtml += '<a href="ajax.php?action=export_evidens_zip&id_modul=' + m.id_modul + '" class="btn sm" style="background:#0d9488;color:#fff;text-decoration:none;display:inline-flex;align-items:center;gap:6px">' +
                    '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M7 10l5 5 5-5M12 15V3"/></svg> Unduh Semua Eviden (ZIP)' +
                  '</a>';
      if (hasWord) {
        footHtml += '<a href="ajax.php?action=export_evidens_zip&id_modul=' + m.id_modul + '&word_to_pdf=1" class="btn sm" style="background:#0284c7;color:#fff;text-decoration:none;display:inline-flex;align-items:center;gap:6px" title="Sertakan versi PDF untuk berkas Word">' +
                      '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg> Unduh ZIP (+ PDF Word)' +
                    '</a>';
      }
    }
    footHtml += '<a href="https://forms.gle/ItjenKemenkesBBPKMonev2026" target="_blank" rel="noopener noreferrer" class="btn sm" style="background:#16a34a;color:#fff;text-decoration:none;display:inline-flex;align-items:center;gap:6px">' +
                  '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6M15 3h6v6M10 14L21 3"/></svg> Buka Google Form Itjen ↗' +
                '</a>';

    openModal({
      title: "Ekspor Berkas Bukti Dukung (Eviden) - " + escapeHtml(m.nama_modul),
      body: popHtml,
      footerHtml: footHtml,
      width: "840px"
    });

    document.getElementById("mExpClose").onclick = closeModal;

    // Salin Semua Tautan Eviden ke Clipboard
    var btnCopyAll = document.getElementById("btnCopyAllEvidenLinks");
    if (btnCopyAll) {
      btnCopyAll.onclick = function(){
        var linksTxt = "DAFTAR TAUTAN & BERKAS EVIDEN SKI BBPK JAKARTA\n" +
          "Modul: " + m.nama_modul + "\n" +
          "Unit Kerja PIC: " + (m.nama_unit || '-') + "\n" +
          "Tanggal Ekspor: " + new Date().toLocaleString('id-ID') + "\n\n" +
          "RINCIAN INDIKATOR & BUKTI DUKUNG EVIDEN:\n" +
          "------------------------------------------------------------------------\n";

        var countLinks = 0;
        mInds.forEach(function(ind, idx){
          var evList = mEvs.filter(function(e){ return e.id_indikator === ind.id_indikator; });
          var latestEv = evList.length > 0 ? evList[0] : null;
          var evPath = latestEv ? (latestEv.path_file || '-') : '-';
          var evName = latestEv ? latestEv.nama_file : '(Belum ada eviden)';
          linksTxt += (idx + 1) + ". Indikator : " + ind.deskripsi_indikator + "\n" +
                      "   Eviden    : " + evName + " (v" + (latestEv ? latestEv.versi : "1") + ")\n" +
                      "   Tautan/File: " + evPath + "\n\n";
          if (latestEv && latestEv.path_file) countLinks++;
        });

        linksTxt += "Google Form Itjen Kemenkes: https://forms.gle/ItjenKemenkesBBPKMonev2026\n";

        if (navigator.clipboard && navigator.clipboard.writeText) {
          navigator.clipboard.writeText(linksTxt).then(function(){
            toast(countLinks + " tautan disalin.");
          }).catch(function(){
            copyFallback(linksTxt);
          });
        } else {
          copyFallback(linksTxt);
        }
      };
    }
  }

  var aprActiveTab = 'all'; // 'all' | 'pending' | 'pimpinan' | 'approved'
  function renderApprovalKetua() {
    var forApprove = STATE.evidens.filter(function(e){ return e.status_eviden === 'o'; });
    var totalModuls = STATE.moduls.length;

    var finishedCount = STATE.moduls.filter(function(m){
      var rec = (STATE.rekomendasi || []).find(function(r){ return r.id_modul === m.id_modul; });
      return rec && rec.keputusan_pimpinan === 'Disetujui';
    }).length;

    var h = '';

    // 1. Hero Card: Approval per Modul
    h += '<div class="apr-hero-card">' +
           '<div class="apr-hero-header">' +
             '<span class="apr-modul-badge"><span class="apr-dot teal"></span> ' + totalModuls + ' modul</span>' +
           '</div>' +
           '<div style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;margin-top:10px">' +
             '<button class="apr-btn-bulk-approve" id="btnBulkApproveTop" disabled>Setujui (0)</button>' +
             '<div style="margin-left:auto;display:flex;gap:6px;flex-wrap:wrap">' +
               '<button class="btn sm ' + (aprActiveTab === 'all' ? '' : 'o') + ' btnAprTab" data-tab="all">Semua (' + totalModuls + ')</button>' +
               '<button class="btn sm ' + (aprActiveTab === 'pending' ? '' : 'o') + ' btnAprTab" data-tab="pending">Perlu persetujuan</button>' +
               '<button class="btn sm ' + (aprActiveTab === 'pimpinan' ? '' : 'o') + ' btnAprTab" data-tab="pimpinan">Pimpinan</button>' +
               '<button class="btn sm ' + (aprActiveTab === 'approved' ? '' : 'o') + ' btnAprTab" data-tab="approved" style="border-color:#16a34a;' + (aprActiveTab === 'approved' ? 'background:#16a34a;color:#fff' : 'color:#16a34a') + '">Selesai (' + finishedCount + ')</button>' +
             '</div>' +
           '</div>' +
         '</div>';

    // 2. Modul Group Cards Container
    h += '<div style="display:flex;flex-direction:column;gap:14px;margin-top:16px">';

    var visibleModuls = STATE.moduls.filter(function(m){
      var modPending = STATE.evidens.filter(function(e){ return e.id_modul === m.id_modul && e.status_eviden === 'o'; });
      var rec = (STATE.rekomendasi || []).find(function(r){ return r.id_modul === m.id_modul; });
      var isPimApproved = (rec && rec.keputusan_pimpinan === 'Disetujui');
      var isWaitingPim = (rec && rec.keputusan_pimpinan === 'Menunggu');
      if (aprActiveTab === 'pending') return modPending.length > 0;
      if (aprActiveTab === 'pimpinan') return isWaitingPim;
      if (aprActiveTab === 'approved') return isPimApproved;
      return true;
    });

    if (visibleModuls.length === 0) {
      h += '<div style="background:#fff;border:1px solid var(--bd);border-radius:14px;padding:24px;text-align:center;color:var(--mut)">' +
           'Tidak ada modul yang sesuai dengan filter yang dipilih.' +
           '</div>';
    }

    visibleModuls.forEach(function(m){
      var modPending = STATE.evidens.filter(function(e){ return e.id_modul === m.id_modul && e.status_eviden === 'o'; });
      var modApproved = STATE.evidens.filter(function(e){ return e.id_modul === m.id_modul && (e.status_eviden === 'a' || e.status_eviden === 'f'); });
      var rec = (STATE.rekomendasi || []).find(function(r){ return r.id_modul === m.id_modul; });
      var hasRecom = (rec !== undefined);
      var isPimApproved = (rec && rec.keputusan_pimpinan === 'Disetujui') || (modApproved.length > 0 && STATE.evidens.filter(function(e){ return e.id_modul === m.id_modul && e.status_eviden === 'f'; }).length === modApproved.length && modPending.length === 0);
      var isPimDisposisi = (rec && rec.keputusan_pimpinan === 'Disposisi');
      var isWaitingPim = (rec && rec.keputusan_pimpinan === 'Menunggu');

      h += '<div class="apr-modul-card" id="cardModul_' + m.id_modul + '">';
      
      // Top header of module card
      h += '<div class="apr-modul-top">' +
             '<h3 class="apr-modul-title">' + m.nama_modul + '</h3>' +
             '<div class="apr-tags-wrap">';

      if (isPimApproved) {
        h += '<span class="apr-tag" style="background:#dcfce7;color:#16a34a;font-weight:700;border:1px solid #86efac"><span class="apr-dot green"></span> Disetujui Pimpinan</span>';
      } else if (isPimDisposisi) {
        h += '<span class="apr-tag" style="background:#fee2e2;color:#dc2626;font-weight:700"><span class="apr-dot red"></span> Perlu perbaikan</span>';
      } else if (isWaitingPim) {
        h += '<span class="apr-tag" style="background:#fce7f3;color:#be185d;font-weight:700"><span class="apr-dot pink"></span> Menunggu Pimpinan</span>';
      }

      if (modPending.length === 0) {
        if (!isPimApproved && !isWaitingPim && !isPimDisposisi) {
          h += '<span class="apr-tag apr-tag-none"><span class="apr-dot green"></span> Tidak ada yang menunggu</span>';
        }
        h += '<span class="apr-tag apr-tag-disetujui"><span class="apr-dot pink"></span> ' + modApproved.length + ' divalidasi</span>';
        if (hasRecom && !isPimApproved) {
          h += '<span class="apr-tag apr-tag-rekom"><span class="apr-dot teal"></span> Rekomendasi terkirim</span>';
        }
        h += '</div></div>'; // end apr-tags-wrap & apr-modul-top
      } else {
        h += '<span class="apr-tag apr-tag-pending"><span class="apr-dot purple"></span> ' + modPending.length + ' menunggu approval</span>';
        h += '<span class="apr-tag apr-tag-disetujui"><span class="apr-dot pink"></span> ' + modApproved.length + ' divalidasi</span>';
        if (hasRecom) {
          h += '<span class="apr-tag apr-tag-rekom"><span class="apr-dot teal"></span> Rekomendasi terkirim</span>';
        }
        h += '</div></div>'; // end apr-tags-wrap & apr-modul-top

        // In-card toolbar
        h += '<div class="apr-card-toolbar">' +
               '<button class="apr-btn-tool apr-btn-pilih-semua" data-modid="' + m.id_modul + '">Pilih semua</button>' +
               '<button class="apr-btn-tool apr-btn-setujui-semua" data-modid="' + m.id_modul + '">Setujui semua</button>' +
             '</div>';

        // Table of pending items
        h += '<div class="tw" style="margin:0;border:0;border-radius:10px">' +
             '<table class="apr-table">' +
             '<thead><tr>' +
             '<th style="width:36px"><input type="checkbox" class="cbModGroupAll" data-modid="' + m.id_modul + '"></th>' +
             '<th>INDIKATOR</th>' +
             '<th>BERKAS</th>' +
             '<th>PEMILIK</th>' +
             '<th>HASIL REVIEW</th>' +
             '<th>AKSI</th>' +
             '</tr></thead><tbody>';

        modPending.forEach(function(e){
          var reviewerName = e.nama_reviewer || 'Rina - Anggota SKI';
          var isLink = isEvidenUrl(e.path_file) || e.format_file === 'link' || e.format_file === 'gdrive' || e.format_file === 'onedrive' || e.format_file === 'dropbox';
          var fileIcon = getFileIconSvg(e.nama_file, e.format_file, e.path_file);
          var fileBadge = isLink ? ' <span style="font-size:10px;padding:2px 6px;border-radius:4px;background:#e8f0fe;color:#1967d2;font-weight:700">Link GDrive</span>' : '';
          h += '<tr>' +
               '<td><input type="checkbox" class="cbAprItem" data-id="' + e.id_eviden + '" data-modid="' + m.id_modul + '"></td>' +
               '<td><b>' + escapeAttr(e.deskripsi_indikator) + '</b></td>' +
               '<td><a href="' + e.path_file + '" target="_blank" rel="noopener noreferrer" class="apr-file-link">' +
                 fileIcon + ' ' +
                 escapeAttr(e.nama_file) + fileBadge + ' ↗</a></td>' +
               '<td>' + escapeAttr(e.nama_pic) + '<br><small class="mut">' + escapeAttr(e.nama_unit || '-') + '</small></td>' +
               '<td><span class="apr-tag apr-tag-sesuai"><span class="apr-dot green"></span> Sesuai</span><br><small class="mut">' + escapeAttr(reviewerName) + '</small></td>' +
               '<td>' +
                 '<button class="apr-btn-action apr-btn-setujui btnApKet" data-id="' + e.id_eviden + '">Setujui</button>' +
                 '<button class="apr-btn-action apr-btn-kembalikan btnRtKet" data-id="' + e.id_eviden + '">Kembalikan</button>' +
               '</td>' +
               '</tr>';
        });

        h += '</tbody></table></div>';
      }

      // BANNER SPESIAL JIKA MODUL TELAH DISETUJUI PIMPINAN (KEMBALI KE SKI)
      if (isPimApproved) {
        h += '<div style="background:linear-gradient(135deg,rgba(16,185,129,0.12),rgba(13,148,136,0.06));border:1px solid #10b981;border-radius:12px;padding:14px 16px;margin:12px 0 4px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px">' +
               '<div>' +
                 '<div style="font-weight:800;color:#065f46;font-size:13.5px;display:flex;align-items:center;gap:6px">' +
                   '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>' +
                   'Disetujui Pimpinan' +
                 '</div>' +
                 '<div style="font-size:12.5px;color:#047857;margin-top:2px">' +
                   'Laporan PDF siap diunduh.' +
                 '</div>' +
               '</div>' +
               '<div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap">' +
                 '<button class="btn sm btnExportModulItjen" data-id="' + m.id_modul + '" style="background:#0d9488;color:#fff;font-weight:700">' +
                   'Ekspor PDF' +
                 '</button>' +
                 '<a href="https://forms.gle/ItjenKemenkesBBPKMonev2026" target="_blank" rel="noopener noreferrer" class="btn sm o" style="background:#fff;border-color:#0d9488;color:#0d9488;font-weight:700;text-decoration:none;display:inline-flex;align-items:center;gap:6px">' +
                   '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6M15 3h6v6M10 14L21 3"/></svg> ' +
                   'Upload ke Itjen ↗' +
                 '</a>' +
               '</div>' +
             '</div>';
      }

      h += '</div>'; // end apr-modul-card
    });

    h += '</div>'; // end container

    // 3. Rekomendasi Resmi Card
    h += '<div class="apr-modul-card" style="margin-top:20px">' +
           '<div class="apr-modul-top">' +
             '<h3 class="apr-modul-title" style="display:flex;align-items:center;gap:8px">' +
               '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg> ' +
               'Kirim Rekomendasi</h3>' +
           '</div>' +
           '<div class="grid g2" style="margin-top:4px">' +
             '<div>' +
               '<label style="font-size:12px;color:var(--mut);font-weight:700">Pilih Modul Pengawasan:</label>' +
               '<select id="recMod" class="fl" style="width:100%">' +
                 STATE.moduls.map(function(m){ return '<option value="' + m.id_modul + '" data-jdw="' + (m.id_jadwal || '') + '">' + m.nama_modul + '</option>'; }).join('') +
               '</select>' +
             '</div>' +
             '<div>' +
               '<label style="font-size:12px;color:var(--mut);font-weight:700">Poin Rekomendasi Resmi SKI:</label>' +
               '<textarea id="recText" style="width:100%;min-height:74px;border:1px solid var(--bd);border-radius:10px;padding:10px;font:inherit;background:#fff" placeholder="Tuliskan rekomendasi hasil pengawasan kepatuhan..."></textarea>' +
             '</div>' +
           '</div>' +
           '<button class="apr-btn-bulk-approve" id="btnSendRec" style="margin-top:4px">Kirim Rekomendasi</button>' +
         '</div>';

    document.getElementById("aprC").innerHTML = h;

    // Filter tab handler
    document.querySelectorAll(".btnAprTab").forEach(function(btn){
      btn.onclick = function(){
        aprActiveTab = this.dataset.tab;
        renderApprovalKetua();
      };
    });

    // Checkbox & Bulk Actions
    function updateTopBulkBtn() {
      var checked = document.querySelectorAll(".cbAprItem:checked");
      var count = checked.length;
      var topBtn = document.getElementById("btnBulkApproveTop");
      if (topBtn) {
        topBtn.textContent = "Setujui (" + count + ")";
        topBtn.disabled = (count === 0);
      }
    }

    document.querySelectorAll(".cbAprItem").forEach(function(cb){
      cb.onchange = function(){
        var modId = this.dataset.modid;
        var modCbs = document.querySelectorAll('.cbAprItem[data-modid="' + modId + '"]');
        var headCb = document.querySelector('.cbModGroupAll[data-modid="' + modId + '"]');
        if (headCb) {
          headCb.checked = [].every.call(modCbs, function(c){ return c.checked; });
        }
        updateTopBulkBtn();
      };
    });

    document.querySelectorAll(".cbModGroupAll").forEach(function(hcb){
      hcb.onchange = function(){
        var modId = this.dataset.modid;
        var checkedState = this.checked;
        document.querySelectorAll('.cbAprItem[data-modid="' + modId + '"]').forEach(function(c){
          c.checked = checkedState;
        });
        updateTopBulkBtn();
      };
    });

    document.querySelectorAll(".apr-btn-pilih-semua").forEach(function(btn){
      btn.onclick = function(){
        var modId = this.dataset.modid;
        var cbs = document.querySelectorAll('.cbAprItem[data-modid="' + modId + '"]');
        var anyUnchecked = [].some.call(cbs, function(c){ return !c.checked; });
        cbs.forEach(function(c){ c.checked = anyUnchecked; });
        var headCb = document.querySelector('.cbModGroupAll[data-modid="' + modId + '"]');
        if (headCb) headCb.checked = anyUnchecked;
        this.textContent = anyUnchecked ? "Batal pilih" : "Pilih semua";
        updateTopBulkBtn();
      };
    });

    document.querySelectorAll(".apr-btn-setujui-semua").forEach(function(btn){
      btn.onclick = function(){
        var modId = this.dataset.modid;
        var cbs = document.querySelectorAll('.cbAprItem[data-modid="' + modId + '"]');
        var ids = [];
        cbs.forEach(function(c){ ids.push(c.dataset.id); });
        if (!ids.length) return;
        if (!confirm("Setujui seluruh " + ids.length + " berkas pada modul ini?")) return;
        var fd = new FormData();
        fd.append('action', 'approve_ketua');
        fd.append('tipe', 'bulk');
        fd.append('ids', JSON.stringify(ids));
        fetch('ajax.php', { method: 'POST', body: fd }).then(function(r){ return r.json(); }).then(function(res){
          toast(res.message); if (res.success) fetchInit(function(){ renderApprovalKetua(); });
        });
      };
    });

    var topBtn = document.getElementById("btnBulkApproveTop");
    if (topBtn) {
      topBtn.onclick = function(){
        var checked = document.querySelectorAll(".cbAprItem:checked");
        var ids = [];
        checked.forEach(function(c){ ids.push(c.dataset.id); });
        if (!ids.length) return;
        if (!confirm("Setujui " + ids.length + " berkas terpilih sekaligus?")) return;
        var fd = new FormData();
        fd.append('action', 'approve_ketua');
        fd.append('tipe', 'bulk');
        fd.append('ids', JSON.stringify(ids));
        fetch('ajax.php', { method: 'POST', body: fd }).then(function(r){ return r.json(); }).then(function(res){
          toast(res.message); if (res.success) fetchInit(function(){ renderApprovalKetua(); });
        });
      };
    }

    document.querySelectorAll(".btnApKet").forEach(function(b){
      b.onclick = function(){
        var fd = new FormData();
        fd.append('action', 'approve_ketua');
        fd.append('tipe', 'single');
        fd.append('ids', JSON.stringify([this.dataset.id]));
        fetch('ajax.php', { method: 'POST', body: fd }).then(function(r){ return r.json(); }).then(function(res){
          toast(res.message); if (res.success) fetchInit(function(){ renderApprovalKetua(); });
        });
      };
    });

    document.querySelectorAll(".btnRtKet").forEach(function(b){
      b.onclick = function(){
        if (!confirm("Kembalikan berkas ini ke PIC untuk perbaikan/tindak lanjut?")) return;
        var fd = new FormData();
        fd.append('action', 'approve_ketua');
        fd.append('tipe', 'return');
        fd.append('ids', JSON.stringify([this.dataset.id]));
        fetch('ajax.php', { method: 'POST', body: fd }).then(function(r){ return r.json(); }).then(function(res){
          toast(res.message); if (res.success) fetchInit(function(){ renderApprovalKetua(); });
        });
      };
    });

    // Handler ekspor laporan PDF
    document.querySelectorAll(".btnExportModulItjen").forEach(function(b){
      b.onclick = function(){
        exportModulePdf(this.dataset.id);
      };
    });

    var btnSend = document.getElementById("btnSendRec");
    if (btnSend) {
      btnSend.onclick = function(){
        var sel = document.getElementById("recMod");
        var modId = sel.value;
        var jdwId = sel.options[sel.selectedIndex] ? sel.options[sel.selectedIndex].dataset.jdw : '';
        var txt = document.getElementById("recText").value.trim();
        if (!txt) { alert("Poin rekomendasi resmi wajib diisi!"); return; }

        var fd = new FormData();
        fd.append('action', 'approve_ketua');
        fd.append('tipe', 'send_recom');
        fd.append('id_modul', modId);
        fd.append('id_jadwal', jdwId);
        fd.append('rekomendasi', txt);
        fetch('ajax.php', { method: 'POST', body: fd }).then(function(r){ return r.json(); }).then(function(res){
          toast(res.message); if (res.success) fetchInit(function(){ renderApprovalKetua(); });
        });
      };
    }
  }

  // --- 9. APPROVAL PIMPINAN ---
  function renderApprovalPimpinan() {
    var pendingEvidens = STATE.evidens.filter(function(e){ return e.status_eviden === 'a'; });
    var allRecs = STATE.rekomendasi || [];

    var h = '';

    // Ringkasan Cepat
    h += '<div class="grid g2" style="margin-bottom:16px">' +
         '<div class="card" style="background:linear-gradient(135deg,rgba(10,143,131,0.08),transparent);border-color:var(--pri)">' +
         '<div class="row" style="margin-top:0"><span style="font-size:12px;color:var(--mut);font-weight:700;text-transform:uppercase">Berkas Menunggu</span>' +
         '<span class="tag ' + (pendingEvidens.length > 0 ? 't-pk' : 't-ok') + '">' + pendingEvidens.length + '</span></div>' +
         '</div>' +
         '<div class="card" style="background:linear-gradient(135deg,rgba(124,58,237,0.08),transparent);border-color:var(--pu)">' +
         '<div class="row" style="margin-top:0"><span style="font-size:12px;color:var(--mut);font-weight:700;text-transform:uppercase">Rekomendasi Modul</span>' +
         '<span class="tag t-pu">' + allRecs.length + '</span></div>' +
         '</div>' +
         '</div>';

    // Bagian 1: Berkas Eviden & Dokumen Revisi (Menunggu Evaluasi Pimpinan)
    h += '<h3 style="margin:20px 0 8px;color:var(--dk);display:flex;align-items:center;gap:8px">' +
         '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 3H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/><path d="M14 3v6h6"/></svg>' +
         'Berkas Menunggu (' + pendingEvidens.length + ')' +
         '</h3>';

    if (pendingEvidens.length === 0) {
      h += '<div style="background:var(--bg);border-radius:12px;padding:20px;text-align:center;color:var(--mut);margin-bottom:20px;border:1px solid var(--bd)">' +
           'Tidak ada berkas menunggu.' +
           '</div>';
    } else {
      h += '<div class="tw" style="margin-bottom:24px"><table>' +
           '<tr><th>Modul &amp; Butir Indikator</th><th>Dokumen Bukti</th><th>Versi Dokumen</th><th>PIC &amp; Unit</th><th>Catatan Temuan SKI</th><th>Aksi Pimpinan</th></tr>';
      pendingEvidens.forEach(function(e){
        var isRevisi = parseInt(e.versi) > 1;
        var isLink = isEvidenUrl(e.path_file) || e.format_file === 'link' || e.format_file === 'gdrive' || e.format_file === 'onedrive' || e.format_file === 'dropbox';
        var iconSymbol = '';
        var sizeOrLink = isLink ? 'Tautan Awan' : (e.ukuran_file_mb + ' MB');
        var linkBadge = isLink ? ' <span style="font-size:10px;padding:2px 6px;border-radius:4px;background:#e8f0fe;color:#1967d2;font-weight:700">Link GDrive</span>' : '';
        h += '<tr>';
        h += '<td><b>' + escapeAttr(e.nama_modul) + '</b><br><span style="font-size:12.5px;color:var(--tx)">' + escapeAttr(e.deskripsi_indikator) + '</span></td>';
        h += '<td><a href="' + e.path_file + '" target="_blank" rel="noopener noreferrer" style="color:var(--pri);font-weight:700;text-decoration:none;display:inline-flex;align-items:center;gap:4px">' + iconSymbol + escapeAttr(e.nama_file) + linkBadge + ' ↗</a><br><small class="mut">' + sizeOrLink + ' · ' + e.waktu_unggah + '</small></td>';
        h += '<td><span class="tag ' + (isRevisi ? 't-pu' : 't-bl') + '" style="font-weight:700">' +
             (isRevisi ? 'Versi ' + e.versi + ' (Berkas Revisi/TL)' : 'Versi 1 (Awal)') + '</span></td>';
        h += '<td>' + escapeAttr(e.nama_pic) + '<br><small class="mut">' + escapeAttr(e.nama_unit || '-') + '</small></td>';
        h += '<td>' + (e.catatan_temuan ? '<span style="font-size:12px;color:var(--tx);background:var(--bg);padding:4px 8px;border-radius:6px;display:inline-block">' + escapeAttr(e.catatan_temuan) + '</span>' : '<span class="mut">-</span>') + '</td>';
        h += '<td><button class="btn sm btnEvalEvidenPim" data-id="' + e.id_eviden + '" data-mod="' + escapeAttr(e.nama_modul) + '" data-desc="' + escapeAttr(e.deskripsi_indikator) + '" data-file="' + escapeAttr(e.nama_file) + '" data-path="' + escapeAttr(e.path_file) + '" data-ver="' + e.versi + '" data-pic="' + escapeAttr(e.nama_pic) + '" data-unit="' + escapeAttr(e.nama_unit || '') + '" data-cat="' + escapeAttr(e.catatan_temuan || '') + '">Tinjau</button></td>';
        h += '</tr>';
      });
      h += '</table></div>';
    }

    // Bagian 2: Daftar Rekomendasi Resmi per Modul
    h += '<h3 style="margin:24px 0 8px;color:var(--dk);border-top:1px solid var(--bd);padding-top:16px;display:flex;align-items:center;gap:8px">' +
         '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/></svg>' +
         'Rekomendasi Modul (' + allRecs.length + ')' +
         '</h3>';

    if (allRecs.length === 0) {
      h += '<div style="background:var(--bg);border-radius:12px;padding:20px;text-align:center;color:var(--mut);border:1px solid var(--bd)">' +
           'Belum ada rekomendasi.' +
           '</div>';
    } else {
      h += '<div class="tw"><table><tr><th>Modul Pengawasan</th><th>Ketua SKI</th><th>Poin Rekomendasi Resmi</th><th>Status Baca</th><th>Keputusan</th><th>Aksi</th></tr>';
      allRecs.forEach(function(r){
        var seen = parseInt(r.is_dilihat_pimpinan) === 1;
        h += '<tr>';
        h += '<td><b>' + r.nama_modul + '</b></td>';
        h += '<td>' + r.nama_ketua + '</td>';
        h += '<td><span style="font-size:12.5px">' + r.poin_rekomendasi + '</span></td>';
        h += '<td><span class="tag ' + (seen ? 't-ok' : 't-wn') + '">' + (seen ? 'Dilihat' : 'Belum Dilihat') + '</span></td>';
        h += '<td><span class="tag ' + (r.keputusan_pimpinan === 'Disetujui' ? 't-ok' : (r.keputusan_pimpinan === 'Disposisi' ? 't-er' : 't-pu')) + '">' + r.keputusan_pimpinan + '</span></td>';
        h += '<td><button class="btn sm btnLihatPim" data-id="' + r.id_rekomendasi + '">Keputusan</button></td>';
        h += '</tr>';
      });
      h += '</table></div>';
    }

    document.getElementById("apmL").innerHTML = h;

    // Handler untuk tombol "Evaluasi Berkas" (Individual Eviden / File Revisi)
    document.querySelectorAll(".btnEvalEvidenPim").forEach(function(b){
      b.onclick = function(){
        var id = this.dataset.id;
        var mod = this.dataset.mod;
        var desc = this.dataset.desc;
        var file = this.dataset.file;
        var path = this.dataset.path;
        var ver = parseInt(this.dataset.ver);
        var pic = this.dataset.pic;
        var unit = this.dataset.unit;
        var cat = this.dataset.cat;
        var isRevisi = ver > 1;

        var isLink = isEvidenUrl(path);
        var labelDokumen = isLink ? 'Tautan Eviden' : 'Dokumen';
        var btnOpenText = 'Buka Dokumen';

        var popHtml = '<div style="font-size:13px">' +
                      '<div style="background:var(--pri2);padding:12px 16px;border-radius:12px;margin-bottom:14px;border-left:4px solid var(--pri)">' +
                      '<div style="font-size:11px;font-weight:700;color:var(--dk);text-transform:uppercase">Modul: ' + escapeAttr(mod) + '</div>' +
                      '<div style="font-size:13.5px;font-weight:600;color:var(--tx);margin-top:2px">' + escapeAttr(desc) + '</div>' +
                      '<div style="font-size:12px;color:var(--mut);margin-top:4px">PIC: <b>' + escapeAttr(pic) + ' (' + escapeAttr(unit) + ')</b></div>' +
                      '</div>' +
                      '<div style="background:#fff;border:1px solid var(--bd);border-radius:12px;padding:12px 14px;margin-bottom:14px">' +
                      '<div class="row" style="margin-top:0"><span style="font-weight:700;color:var(--dk)">' + labelDokumen + '</span>' +
                      '<span class="tag ' + (isRevisi ? 't-pu' : 't-bl') + '" style="font-weight:700">' + (isRevisi ? 'Versi ' + ver + ' (Berkas Revisi/Tindak Lanjut)' : 'Versi 1') + '</span></div>' +
                      '<div style="margin:8px 0">' +
                      '<a href="' + path + '" target="_blank" rel="noopener noreferrer" class="btn sm o" style="text-decoration:none;display:inline-flex;align-items:center;gap:6px">' +
                      btnOpenText + '</a>' +
                      '</div>' +
                      (cat ? '<div style="margin-top:8px;padding:8px 12px;background:var(--bg);border-radius:8px;font-size:12px"><b>Catatan Tim SKI Sebelumnya:</b><br>' + escapeAttr(cat) + '</div>' : '') +
                      '</div>' +
                      '<label style="display:block;font-weight:700;margin-bottom:4px;color:var(--dk)">Catatan Disposisi</label>' +
                      '<textarea id="mEvPimDisposisi" style="width:100%;min-height:75px;border:1px solid var(--bd);border-radius:10px;padding:10px;font:inherit" placeholder="Wajib diisi untuk disposisi"></textarea>' +
                      '</div>';

        var footHtml = '<button class="btn o sm" id="mEvPimCancel">Batal</button>' +
                       '<button class="btn o sm" id="mEvPimNo" style="color:var(--er);border-color:var(--er)">Disposisi</button>' +
                       '<button class="btn sm" id="mEvPimOk">Setuju</button>';

        openModal({
          title: "Evaluasi Berkas",
          body: popHtml,
          footerHtml: footHtml,
          width: "620px"
        });

        document.getElementById("mEvPimCancel").onclick = closeModal;

        document.getElementById("mEvPimOk").onclick = function(){
          execPimEviden(id, 'Setuju', '');
        };
        document.getElementById("mEvPimNo").onclick = function(){
          var dsp = document.getElementById("mEvPimDisposisi").value.trim();
          if (!dsp) { alert("Tuliskan catatan instruksi disposisi perbaikan terlebih dahulu!"); return; }
          execPimEviden(id, 'Disposisi', dsp);
        };
      };
    });

    // Handler untuk tombol "Buka Keputusan Modul" (Rekomendasi Modul)
    document.querySelectorAll(".btnLihatPim").forEach(function(b){
      b.onclick = function(){
        var id = this.dataset.id;
        var r = STATE.rekomendasi.find(function(x){ return x.id_rekomendasi === id; });
        if (!r) return;

        var fd = new FormData();
        fd.append('action', 'approval_pimpinan');
        fd.append('sub_action', 'mark_seen');
        fd.append('id_rekomendasi', id);
        fetch('ajax.php', { method: 'POST', body: fd }).then(function(){ syncNav(); });

        // Cari seluruh berkas untuk modul ini
        var modEvs = STATE.evidens.filter(function(e){ return e.id_modul === r.id_modul; });

        var evTableHtml = '';
        if (modEvs.length === 0) {
          evTableHtml = '<p class="mut" style="font-size:12px">Belum ada dokumen bukti yang terlampir pada modul ini.</p>';
        } else {
          evTableHtml = '<div class="tw" style="margin:10px 0;max-height:220px;overflow-y:auto;border:1px solid var(--bd);border-radius:10px">' +
                        '<table style="font-size:12px"><tr><th>Indikator</th><th>Dokumen Berkas</th><th>Versi</th><th>Status</th></tr>';
          modEvs.forEach(function(ev){
            var isRev = parseInt(ev.versi) > 1;
            var isLinkEv = isEvidenUrl(ev.path_file) || ev.format_file === 'link' || ev.format_file === 'gdrive' || ev.format_file === 'onedrive' || ev.format_file === 'dropbox';
            var iconEv = '';
            var linkBdg = isLinkEv ? ' <span style="font-size:9.5px;padding:1px 5px;border-radius:4px;background:#e8f0fe;color:#1967d2;font-weight:700">Link GDrive</span>' : '';
            evTableHtml += '<tr>';
            evTableHtml += '<td>' + escapeAttr(ev.deskripsi_indikator) + '</td>';
            evTableHtml += '<td><a href="' + ev.path_file + '" target="_blank" rel="noopener noreferrer" style="color:var(--pri);font-weight:700">' + iconEv + escapeAttr(ev.nama_file) + linkBdg + ' ↗</a></td>';
            evTableHtml += '<td><span class="tag ' + (isRev ? 't-pu' : 't-bl') + '">' + (isRev ? 'v' + ev.versi + ' (Revisi)' : 'v1') + '</span></td>';
            evTableHtml += '<td><span class="tag ' + SS[ev.status_eviden][1] + '">' + SS[ev.status_eviden][0] + '</span></td>';
            evTableHtml += '</tr>';
          });
          evTableHtml += '</table></div>';
        }

        var popHtml = '<div style="font-size:13px">' +
                      '<div style="background:var(--pri2);padding:12px 16px;border-radius:12px;margin-bottom:12px;border-left:4px solid var(--pri)">' +
                      '<div style="font-size:11px;font-weight:700;color:var(--dk);text-transform:uppercase">Modul: ' + r.nama_modul + '</div>' +
                      '<div style="font-size:13.5px;font-weight:600;color:var(--tx);margin-top:4px"><b>Poin Rekomendasi Resmi Ketua SKI:</b><br>' + r.poin_rekomendasi + '</div>' +
                      '</div>' +
                      '<label style="display:block;font-weight:700;margin-bottom:4px;color:var(--dk)">Berkas Eviden &amp; Dokumen Revisi Modul Ini (' + modEvs.length + '):</label>' +
                      evTableHtml +
                      '<label style="display:block;font-weight:700;margin:12px 0 4px;color:var(--dk)">Catatan Disposisi</label>' +
                      '<textarea id="mPimDisposisi" style="width:100%;min-height:75px;border:1px solid var(--bd);border-radius:10px;padding:10px;font:inherit" placeholder="Wajib diisi untuk disposisi">' + (r.catatan_disposisi || '') + '</textarea>' +
                      '</div>';

        var footHtml = '<button class="btn o sm" id="mPimCancel">Batal</button>' +
                       '<button class="btn o sm" id="mPimNo" style="color:var(--er);border-color:var(--er)">Disposisi</button>' +
                       '<button class="btn sm" id="mPimOk">Setuju</button>';

        openModal({
          title: "Keputusan Modul",
          body: popHtml,
          footerHtml: footHtml,
          width: "640px"
        });

        document.getElementById("mPimCancel").onclick = closeModal;

        document.getElementById("mPimOk").onclick = function(){
          execPim(id, 'Setuju', '');
        };
        document.getElementById("mPimNo").onclick = function(){
          var dsp = document.getElementById("mPimDisposisi").value.trim();
          if (!dsp) { alert("Tuliskan catatan disposisi perbaikan terlebih dahulu!"); return; }
          execPim(id, 'Disposisi', dsp);
        };
      };
    });
  }

  function execPimEviden(idEviden, kep, cat) {
    var fd = new FormData();
    fd.append('action', 'approval_pimpinan');
    fd.append('id_eviden', idEviden);
    fd.append('keputusan', kep);
    fd.append('catatan_disposisi', cat);
    fetch('ajax.php', { method: 'POST', body: fd }).then(function(r){ return r.json(); }).then(function(res){
      toast(res.message);
      closeModal();
      if (res.success) fetchInit(function(){ renderApprovalPimpinan(); });
    });
  }

  function execPim(id, kep, cat) {
    var fd = new FormData();
    fd.append('action', 'approval_pimpinan');
    fd.append('id_rekomendasi', id);
    fd.append('keputusan', kep);
    fd.append('catatan_disposisi', cat);
    fetch('ajax.php', { method: 'POST', body: fd }).then(function(r){ return r.json(); }).then(function(res){
      toast(res.message);
      closeModal();
      if (res.success) fetchInit(function(){ renderApprovalPimpinan(); });
    });
  }

  // --- 10. EKSPOR LAPORAN (Itjen Ready & Alur Balik ke SKI) ---
  var expActiveTab = 'all'; // 'all' | 'ready' | 'empty'
  function renderEkspor() {
    var totalModuls = STATE.moduls.length;
    var readyCount = 0;
    var emptyCount = 0;

    STATE.moduls.forEach(function(m){
      var mEvs = STATE.evidens.filter(function(e){ return e.id_modul === m.id_modul; });
      if (mEvs.length > 0) readyCount++; else emptyCount++;
    });

    var h = '';

    // 1. Kartu Ringkasan KPI Ekspor
    h += '<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:12px;margin-bottom:18px">' +
           '<div style="background:#fff;border:1px solid var(--bd);border-radius:12px;padding:14px 16px">' +
             '<div style="font-size:12px;color:var(--mut);font-weight:600">Total Modul Pengawasan</div>' +
             '<div style="font-size:24px;font-weight:800;color:var(--dk);margin-top:2px">' + totalModuls + ' <span style="font-size:13px;font-weight:500;color:var(--mut)">modul</span></div>' +
           '</div>' +
           '<div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:12px;padding:14px 16px">' +
             '<div style="font-size:12px;color:#15803d;font-weight:600">Ada Eviden Selesai (Siap Ekspor)</div>' +
             '<div style="font-size:24px;font-weight:800;color:#16a34a;margin-top:2px">' + readyCount + ' <span style="font-size:13px;font-weight:500;color:#15803d">modul siap</span></div>' +
           '</div>' +
           '<div style="background:#fffbeb;border:1px solid #fde68a;border-radius:12px;padding:14px 16px">' +
             '<div style="font-size:12px;color:#b45309;font-weight:600">Belum Ada Berkas Eviden</div>' +
             '<div style="font-size:24px;font-weight:800;color:#d97706;margin-top:2px">' + emptyCount + ' <span style="font-size:13px;font-weight:500;color:#b45309">modul</span></div>' +
           '</div>' +
         '</div>';

    // 3. Tab Navigasi & Filter
    h += '<div style="display:flex;gap:8px;margin-bottom:12px;flex-wrap:wrap">' +
           '<button class="btn sm ' + (expActiveTab === 'all' ? '' : 'o') + ' btnExpTab" data-tab="all">Semua Modul (' + totalModuls + ')</button>' +
           '<button class="btn sm ' + (expActiveTab === 'ready' ? '' : 'o') + ' btnExpTab" data-tab="ready" style="border-color:#16a34a;' + (expActiveTab === 'ready' ? 'background:#16a34a;color:#fff' : 'color:#16a34a') + '">Siap ekspor (' + readyCount + ')</button>' +
           '<button class="btn sm ' + (expActiveTab === 'empty' ? '' : 'o') + ' btnExpTab" data-tab="empty">Belum Ada Eviden (' + emptyCount + ')</button>' +
         '</div>';

    // 4. Tabel Modul Ekspor
    h += '<div class="tw"><table><tr>' +
           '<th>Nama Modul &amp; Satker PIC</th>' +
           '<th>Indikator Modul</th>' +
           '<th>Status Berkas Eviden</th>' +
           '<th>Kelengkapan Tugas</th>' +
           '<th style="text-align:right">Ekspor</th>' +
         '</tr>';

    var filteredModuls = STATE.moduls.filter(function(m){
      var mEvs = STATE.evidens.filter(function(e){ return e.id_modul === m.id_modul; });
      var hasEviden = mEvs.length > 0;
      if (expActiveTab === 'ready') return hasEviden;
      if (expActiveTab === 'empty') return !hasEviden;
      return true;
    });

    if (filteredModuls.length === 0) {
      h += '<tr><td colspan="5" style="text-align:center;padding:28px;color:var(--mut)">Tidak ada modul pada filter ini.</td></tr>';
    } else {
      filteredModuls.forEach(function(m){
        var mInds = STATE.indikators.filter(function(i){ return i.id_modul === m.id_modul; });
        var mEvs = STATE.evidens.filter(function(e){ return e.id_modul === m.id_modul; });
        var hasEviden = mEvs.length > 0;

        var filledCount = mInds.filter(function(ind){
          return mEvs.some(function(e){ return e.id_indikator === ind.id_indikator; });
        }).length;

        h += '<tr>';
        h += '<td>' +
               '<div style="font-weight:700;color:var(--dk);font-size:13.5px">' + escapeHtml(m.nama_modul) + '</div>' +
               '<div style="font-size:11.5px;color:var(--mut);margin-top:2px">PIC: <b>' + escapeHtml(m.nama_unit || '-') + '</b></div>' +
             '</td>';

        h += '<td>' +
               '<div style="font-size:12.5px;font-weight:600">' + mInds.length + ' Indikator</div>' +
             '</td>';

        h += '<td>';
        if (hasEviden) {
          h += '<span class="tag t-ok" style="font-weight:700">' + mEvs.length + ' eviden</span>';
        } else {
          h += '<span class="tag t-gy" style="font-weight:600">Belum ada</span>';
        }
        h += '</td>';

        h += '<td>' +
               '<div style="font-size:12px;font-weight:700;color:var(--dk)">' + filledCount + ' / ' + mInds.length + ' Indikator Terisi</div>' +
               '<div style="font-size:11px;color:var(--mut);margin-top:2px">' + (mInds.length > 0 ? Math.round((filledCount / mInds.length) * 100) : 0) + '% kelengkapan tugas</div>' +
             '</td>';

        h += '<td style="text-align:right">';
        h += '<div style="display:inline-flex;gap:6px;flex-wrap:wrap;justify-content:flex-end">';
        if (hasEviden) {
          h += '<button class="btn sm btnExportPdf" data-id="' + m.id_modul + '" style="background:#0d9488;color:#fff" title="Ekspor laporan PDF">Ekspor PDF</button>';
        } else {
          h += '<span style="font-size:12px;color:var(--mut)">Belum ada eviden</span>';
        }
        h += '</div>';
        h += '</td>';
        h += '</tr>';
      });
    }

    h += '</table></div>';
    document.getElementById("expC").innerHTML = h;

    // Listener Tab Filter Ekspor
    document.querySelectorAll(".btnExpTab").forEach(function(b){
      b.onclick = function(){
        expActiveTab = this.dataset.tab;
        renderEkspor();
      };
    });

    // Listener ekspor laporan PDF
    document.querySelectorAll(".btnExportPdf").forEach(function(b){
      b.onclick = function(){
        exportModulePdf(this.dataset.id);
      };
    });
  }

  // --- 11. AUDIT TRAIL ---
  function renderAudit() {
    var h = '';

    h += '<div class="tw"><table><tr><th>Waktu Aktivitas</th><th>Pengguna</th><th>Peran Saat Aksi</th><th>Jenis Aksi</th><th>Objek Target</th><th>Alamat IP</th></tr>';
    STATE.audit.forEach(function(a){
      h += '<tr>';
      h += '<td><small>' + a.timestamp_aktivitas + '</small></td>';
      h += '<td><b>' + a.nama_lengkap + '</b></td>';
      h += '<td>' + a.role_saat_aksi + '</td>';
      h += '<td><span class="tag t-in">' + a.jenis_aksi + '</span></td>';
      h += '<td>' + a.objek_target + '</td>';
      h += '<td><code>' + a.ip_address + '</code></td>';
      h += '</tr>';
    });
    h += '</table></div>';
    document.getElementById("audC").innerHTML = h;
  }

  // --- 12. PENGGUNA & PERAN ---
  var userSubView = 'list'; // 'list' | 'add' | 'edit'
  var userEditTargetId = null;
  var userSearchKeyword = '';
  var userRoleFilter = 'all';

  function renderUsers() {
    var canCreate = can('usr', 't');
    var canEdit = can('usr', 'u');
    var canDelete = can('usr', 'h');

    // === VIEW 1: FORMULIR HALAMAN BARU TAMBAH PEGAWAI ===
    if (userSubView === 'add') {
      var hAdd = '<div style="margin-top:0">' +
        '<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;flex-wrap:wrap;gap:10px">' +
          '<button class="btn sm o" id="btnBackToUserList" style="display:inline-flex;align-items:center;gap:6px">' +
            '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg> Kembali ke Daftar Pegawai' +
          '</button>' +
          '<span class="tag t-in" style="font-weight:700;font-size:12px">Pendaftaran Akun Baru</span>' +
        '</div>' +

        '<div style="background:#fff;border:1px solid var(--bd);border-radius:16px;padding:24px 28px;box-shadow:0 4px 20px rgba(0,0,0,.04);margin-bottom:24px">' +
          '<div style="border-bottom:1px solid var(--bd);padding-bottom:12px;margin-bottom:18px">' +
            '<h2 style="margin:0;font-size:19px;color:var(--dk)">Daftarkan Akun Pegawai Baru</h2>' +
          '</div>' +

          '<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:24px">' +
            // Kolom Kiri: Kredensial & Identitas
            '<div>' +
              '<h4 style="margin:0 0 14px;font-size:13.5px;color:var(--pri);display:flex;align-items:center;gap:6px">' +
                '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>' +
                '1. Identitas &amp; Kredensial Akses' +
              '</h4>' +

              '<div style="margin-bottom:14px">' +
                '<label style="display:block;font-size:12.5px;font-weight:700;color:var(--dk);margin-bottom:5px">Nama Lengkap &amp; Gelar <span style="color:#ef4444">*</span></label>' +
                '<input id="inpAddNama" class="srch" style="width:100%;font-size:13.5px;padding:9px 12px;background:#fff" placeholder="Nama lengkap pegawai...">' +
              '</div>' +

              '<div style="margin-bottom:14px">' +
                '<label style="display:block;font-size:12.5px;font-weight:700;color:var(--dk);margin-bottom:5px">NIP / Username Login <span style="color:#ef4444">*</span></label>' +
                '<input id="inpAddNip" class="srch" style="width:100%;font-size:13.5px;padding:9px 12px;background:#fff" placeholder="NIP atau username login...">' +
              '</div>' +

              '<div style="margin-bottom:14px">' +
                '<label style="display:block;font-size:12.5px;font-weight:700;color:var(--dk);margin-bottom:5px">Kata Sandi (Password) <span style="color:#ef4444">*</span></label>' +
                '<div style="display:flex;gap:6px">' +
                  '<input id="inpAddPass" type="text" class="srch" style="flex:1;font-size:13.5px;padding:9px 12px;background:#fff" value="password123">' +
                  '<button type="button" class="btn sm o" id="btnToggleAddPass" style="font-size:11.5px">Sembunyikan</button>' +
                '</div>' +
                '<div style="font-size:11px;color:var(--mut);margin-top:4px">Baku disetel ke <code>password123</code>.</div>' +
              '</div>' +

              '<div style="margin-bottom:14px">' +
                '<label style="display:block;font-size:12.5px;font-weight:700;color:var(--dk);margin-bottom:5px">Status Akun</label>' +
                '<select id="inpAddStatus" class="fl" style="width:100%;font-size:13px;padding:8px 10px">' +
                  '<option value="1" selected>Aktif</option>' +
                  '<option value="0">Nonaktif</option>' +
                '</select>' +
              '</div>' +
            '</div>' +

            // Kolom Kanan: Peran & Unit Kerja
            '<div>' +
              '<h4 style="margin:0 0 14px;font-size:13.5px;color:var(--pri);display:flex;align-items:center;gap:6px">' +
                '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>' +
                '2. Peran &amp; Penempatan Unit Kerja' +
              '</h4>' +

              '<div style="margin-bottom:14px">' +
                '<label style="display:block;font-size:12.5px;font-weight:700;color:var(--dk);margin-bottom:5px">Peran Pengawasan Sistem <span style="color:#ef4444">*</span></label>' +
                '<select id="inpAddRole" class="fl" style="width:100%;font-size:13.5px;font-weight:700;padding:9px 12px">' +
                  '<option value="pic">PIC Unit Kerja</option>' +
                  '<option value="ang">Anggota Tim SKI</option>' +
                  '<option value="ket">Ketua Tim SKI</option>' +
                  '<option value="pim">Kepala BBPK (Pimpinan)</option>' +
                  '<option value="itj">Auditor Itjen</option>' +
                  '<option value="adm">Administrator</option>' +
                '</select>' +
              '</div>' +

              '<div id="boxAddUnitPicker" style="margin-bottom:14px">' +
                '<label style="display:block;font-size:12.5px;font-weight:700;color:var(--dk);margin-bottom:5px">Unit Kerja Penempatan Operasional <span style="color:#ef4444">*</span></label>' +
                '<select id="inpAddUnit" class="fl" style="width:100%;font-size:13px;padding:9px 12px">' +
                  '<option value="">-- Pilih Unit Kerja Penempatan --</option>' +
                  STATE.units.map(function(un){
                    return '<option value="' + un.id_unit + '">' + un.nama_unit + '</option>';
                  }).join('') +
                '</select>' +
                '<div id="addUnitHelp" style="font-size:11px;color:var(--mut);margin-top:4px">Wajib dipilih jika peran sebagai PIC Unit Kerja.</div>' +
              '</div>' +
            '</div>' +
          '</div>' +

          // Tombol Eksekusi Form Tambah
          '<div style="display:flex;gap:12px;margin-top:20px;padding-top:16px;border-top:1px solid var(--bd);align-items:center">' +
            '<button class="btn" id="btnSubmitAddUser" style="padding:10px 24px;font-weight:700;font-size:13.5px">' +
              'Daftarkan Pegawai' +
            '</button>' +
            '<button class="btn o" id="btnCancelAddUser" style="padding:10px 18px;font-size:13.5px">Batal</button>' +
          '</div>' +
        '</div>' +
      '</div>';

      document.getElementById("usrC").innerHTML = hAdd;

      function updateAddRoleUI() {
        var rVal = document.getElementById("inpAddRole").value;
        var uSel = document.getElementById("inpAddUnit");
        var uHelp = document.getElementById("addUnitHelp");
        if (rVal === 'pic') {
          uSel.disabled = false;
          uHelp.textContent = "Wajib memilih unit kerja operasional PIC.";
          uHelp.style.color = "#b45309";
        } else {
          uSel.disabled = true;
          uSel.value = "";
          uHelp.textContent = "Pegawai peran struktural/pengawas tidak terikat pada satu unit operasional.";
          uHelp.style.color = "var(--mut)";
        }
      }

      document.getElementById("inpAddRole").onchange = updateAddRoleUI;
      updateAddRoleUI();

      var passVisible = true;
      document.getElementById("btnToggleAddPass").onclick = function(){
        passVisible = !passVisible;
        var inpP = document.getElementById("inpAddPass");
        inpP.type = passVisible ? 'text' : 'password';
        this.textContent = passVisible ? 'Sembunyikan' : 'Lihat';
      };

      document.getElementById("btnBackToUserList").onclick = function(){ userSubView = 'list'; renderUsers(); };
      document.getElementById("btnCancelAddUser").onclick = function(){ userSubView = 'list'; renderUsers(); };

      document.getElementById("btnSubmitAddUser").onclick = function(){
        var nama = document.getElementById("inpAddNama").value.trim();
        var nip = document.getElementById("inpAddNip").value.trim();
        var pass = document.getElementById("inpAddPass").value.trim();
        var role = document.getElementById("inpAddRole").value;
        var unit = document.getElementById("inpAddUnit").value;
        var status = document.getElementById("inpAddStatus").value;

        if (!nama || !nip) { alert("Nama lengkap dan NIP/Username wajib diisi!"); return; }
        if (role === 'pic' && !unit) { alert("Pegawai dengan peran PIC Unit Kerja wajib dipilihkan unit kerja penempatannya!"); return; }

        var fd = new FormData();
        fd.append('action', 'create_user');
        fd.append('nama_lengkap', nama);
        fd.append('nip_username', nip);
        fd.append('password', pass !== '' ? pass : 'password123');
        fd.append('id_role', role);
        fd.append('id_unit', (role === 'pic') ? unit : '');
        fd.append('status_aktif', status);

        fetch('ajax.php', { method: 'POST', body: fd })
          .then(function(r){ return r.json(); })
          .then(function(res){
            toast(res.message);
            if (res.success) {
              userSubView = 'list';
              fetchInit(function(){ renderUsers(); });
            }
          });
      };
      return;
    }

    // === VIEW 2: FORMULIR HALAMAN BARU EDIT AKUN PEGAWAI ===
    if (userSubView === 'edit') {
      var targetUser = STATE.users.find(function(x){ return x.id_user === userEditTargetId; });
      if (!targetUser) {
        userSubView = 'list';
        renderUsers();
        return;
      }

      var hEdit = '<div style="margin-top:0">' +
        '<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;flex-wrap:wrap;gap:10px">' +
          '<button class="btn sm o" id="btnBackToUserList" style="display:inline-flex;align-items:center;gap:6px">' +
            '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg> Kembali ke Daftar Pegawai' +
          '</button>' +
          '<span class="tag t-ok" style="font-weight:700;font-size:12px">Edit Akun Pegawai</span>' +
        '</div>' +

        // Kartu Profil Pegawai Saat Ini
        '<div style="background:linear-gradient(135deg,#1e293b,#0f172a);color:#fff;border-radius:14px;padding:16px 20px;margin-bottom:18px;box-shadow:0 4px 16px rgba(0,0,0,.12);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px">' +
          '<div style="display:flex;align-items:center;gap:12px">' +
            '<div style="width:46px;height:46px;border-radius:12px;background:var(--pri);color:#fff;display:flex;align-items:center;justify-content:center;font-size:18px;font-weight:800;border:2px solid rgba(255,255,255,.2)">' +
              escapeHtml(targetUser.nama_lengkap.substr(0, 2).toUpperCase()) +
            '</div>' +
            '<div>' +
              '<h3 style="margin:0 0 2px;font-size:18px;color:#fff">' + escapeHtml(targetUser.nama_lengkap) + '</h3>' +
              '<div style="font-size:12px;color:#cbd5e1">NIP: <b>' + escapeHtml(targetUser.nip_username) + '</b> · Peran: <b style="color:#5eead4">' + escapeHtml(targetUser.nama_role) + '</b> (' + escapeHtml(targetUser.nama_unit || 'Internal SKI / Pimpinan') + ')</div>' +
            '</div>' +
          '</div>' +
          '<div>' +
            '<span class="tag ' + (parseInt(targetUser.status_aktif) === 1 ? 't-ok' : 't-gy') + '" style="font-size:12px;font-weight:700">' +
              (parseInt(targetUser.status_aktif) === 1 ? 'Aktif' : 'Nonaktif') +
            '</span>' +
          '</div>' +
        '</div>' +

        // Form Edit Dua Kolom
        '<div style="background:#fff;border:1px solid var(--bd);border-radius:16px;padding:24px 28px;box-shadow:0 4px 20px rgba(0,0,0,.04);margin-bottom:24px">' +
          '<div style="border-bottom:1px solid var(--bd);padding-bottom:12px;margin-bottom:18px">' +
            '<h2 style="margin:0;font-size:18px;color:var(--dk)">Ubah Data Akun &amp; Peran Pegawai</h2>' +
          '</div>' +

          '<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:24px">' +
            // Kolom Kiri
            '<div>' +
              '<h4 style="margin:0 0 14px;font-size:13.5px;color:var(--pri);display:flex;align-items:center;gap:6px">' +
                '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>' +
                '1. Data Kredensial &amp; Sandi' +
              '</h4>' +

              '<div style="margin-bottom:14px">' +
                '<label style="display:block;font-size:12.5px;font-weight:700;color:var(--dk);margin-bottom:5px">Nama Lengkap Pegawai <span style="color:#ef4444">*</span></label>' +
                '<input id="inpEditNama" class="srch" style="width:100%;font-size:13.5px;padding:9px 12px;background:#fff" value="' + escapeHtml(targetUser.nama_lengkap) + '">' +
              '</div>' +

              '<div style="margin-bottom:14px">' +
                '<label style="display:block;font-size:12.5px;font-weight:700;color:var(--dk);margin-bottom:5px">NIP / Username Login <span style="color:#ef4444">*</span></label>' +
                '<input id="inpEditNip" class="srch" style="width:100%;font-size:13.5px;padding:9px 12px;background:#fff" value="' + escapeHtml(targetUser.nip_username) + '">' +
              '</div>' +

              '<div style="margin-bottom:14px">' +
                '<label style="display:block;font-size:12.5px;font-weight:700;color:var(--dk);margin-bottom:5px">Reset / Ganti Kata Sandi</label>' +
                '<div style="display:flex;gap:6px">' +
                  '<input id="inpEditPass" type="password" class="srch" style="flex:1;font-size:13.5px;padding:9px 12px;background:#fff" placeholder="Kosongkan jika tidak ingin ganti sandi">' +
                  '<button type="button" class="btn sm o" id="btnToggleEditPass" style="font-size:11.5px">Lihat</button>' +
                '</div>' +
                '<div style="display:flex;justify-content:space-between;align-items:center;margin-top:5px;flex-wrap:wrap;gap:6px">' +
                  '<span style="font-size:11px;color:var(--mut)">Kosongkan jika sandi lama tetap digunakan.</span>' +
                  '<button type="button" class="btn sm o" id="btnQuickSetPass" style="font-size:11px;padding:2px 8px">Setel Cepat: password123</button>' +
                '</div>' +
              '</div>' +

              '<div style="margin-bottom:14px">' +
                '<label style="display:block;font-size:12.5px;font-weight:700;color:var(--dk);margin-bottom:5px">Status Akun Pegawai</label>' +
                '<select id="inpEditStatus" class="fl" style="width:100%;font-size:13px;padding:8px 10px">' +
                  '<option value="1" ' + (parseInt(targetUser.status_aktif) === 1 ? 'selected' : '') + '>Aktif</option>' +
                  '<option value="0" ' + (parseInt(targetUser.status_aktif) === 0 ? 'selected' : '') + '>Nonaktif</option>' +
                '</select>' +
              '</div>' +
            '</div>' +

            // Kolom Kanan
            '<div>' +
              '<h4 style="margin:0 0 14px;font-size:13.5px;color:var(--pri);display:flex;align-items:center;gap:6px">' +
                '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>' +
                '2. Peran &amp; Penempatan Unit Kerja' +
              '</h4>' +

              '<div style="margin-bottom:14px">' +
                '<label style="display:block;font-size:12.5px;font-weight:700;color:var(--dk);margin-bottom:5px">Peran Pengawasan Sistem <span style="color:#ef4444">*</span></label>' +
                '<select id="inpEditRole" class="fl" style="width:100%;font-size:13.5px;font-weight:700;padding:9px 12px">' +
                  '<option value="pim" ' + (targetUser.id_role === 'pim' ? 'selected' : '') + '>Kepala BBPK (Pimpinan)</option>' +
                  '<option value="ket" ' + (targetUser.id_role === 'ket' ? 'selected' : '') + '>Ketua Tim SKI</option>' +
                  '<option value="ang" ' + (targetUser.id_role === 'ang' ? 'selected' : '') + '>Anggota Tim SKI</option>' +
                  '<option value="pic" ' + (targetUser.id_role === 'pic' ? 'selected' : '') + '>PIC Unit Kerja</option>' +
                  '<option value="itj" ' + (targetUser.id_role === 'itj' ? 'selected' : '') + '>Auditor Itjen</option>' +
                  '<option value="adm" ' + (targetUser.id_role === 'adm' ? 'selected' : '') + '>Administrator</option>' +
                '</select>' +
              '</div>' +

              '<div id="boxEditUnitPicker" style="margin-bottom:14px">' +
                '<label style="display:block;font-size:12.5px;font-weight:700;color:var(--dk);margin-bottom:5px">Unit Kerja Penempatan Operasional <span style="color:#ef4444">*</span></label>' +
                '<select id="inpEditUnit" class="fl" style="width:100%;font-size:13px;padding:9px 12px">' +
                  '<option value="">-- Internal SKI / Pimpinan (Non-Unit) --</option>' +
                  STATE.units.map(function(un){
                    return '<option value="' + un.id_unit + '" ' + (un.id_unit === targetUser.id_unit ? 'selected' : '') + '>' + un.nama_unit + '</option>';
                  }).join('') +
                '</select>' +
                '<div id="editUnitHelp" style="font-size:11px;color:var(--mut);margin-top:4px">Wajib dipilih jika peran sebagai PIC Unit Kerja.</div>' +
              '</div>' +
            '</div>' +
          '</div>' +

          // Tombol Footer
          '<div style="display:flex;gap:12px;margin-top:20px;padding-top:16px;border-top:1px solid var(--bd);align-items:center;flex-wrap:wrap">' +
            '<button class="btn" id="btnSubmitEditUser" style="padding:10px 24px;font-weight:700;font-size:13.5px">' +
              'Simpan Perubahan' +
            '</button>' +
            '<button class="btn o" id="btnCancelEditUser" style="padding:10px 18px;font-size:13.5px">Batal</button>' +
            (canDelete ? '<button class="btn sm o" id="btnDeleteUserFromEdit" style="margin-left:auto;border-color:#ef4444;color:#ef4444;display:inline-flex;align-items:center;gap:5px"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg> Hapus / Nonaktifkan Akun</button>' : '') +
          '</div>' +
        '</div>' +
      '</div>';

      document.getElementById("usrC").innerHTML = hEdit;

      function updateEditRoleUI() {
        var rVal = document.getElementById("inpEditRole").value;
        var uSel = document.getElementById("inpEditUnit");
        var uHelp = document.getElementById("editUnitHelp");
        if (rVal === 'pic') {
          uSel.disabled = false;
          uHelp.textContent = "Wajib memilih unit kerja operasional PIC.";
          uHelp.style.color = "#b45309";
        } else {
          uSel.disabled = true;
          uSel.value = "";
          uHelp.textContent = "Pegawai peran struktural/pengawas tidak terikat pada satu unit operasional.";
          uHelp.style.color = "var(--mut)";
        }
      }

      document.getElementById("inpEditRole").onchange = updateEditRoleUI;
      updateEditRoleUI();

      var editPassVis = false;
      document.getElementById("btnToggleEditPass").onclick = function(){
        editPassVis = !editPassVis;
        var inpP = document.getElementById("inpEditPass");
        inpP.type = editPassVis ? 'text' : 'password';
        this.textContent = editPassVis ? 'Sembunyikan' : 'Lihat';
      };

      document.getElementById("btnQuickSetPass").onclick = function(){
        var inpP = document.getElementById("inpEditPass");
        inpP.type = 'text';
        inpP.value = 'password123';
        document.getElementById("btnToggleEditPass").textContent = 'Sembunyikan';
        editPassVis = true;
        toast("Kata sandi disetel cepat ke: password123. Klik Simpan untuk memperbarui.");
      };

      document.getElementById("btnBackToUserList").onclick = function(){ userSubView = 'list'; renderUsers(); };
      document.getElementById("btnCancelEditUser").onclick = function(){ userSubView = 'list'; renderUsers(); };

      if (document.getElementById("btnDeleteUserFromEdit")) {
        document.getElementById("btnDeleteUserFromEdit").onclick = function(){
          if (!confirm("Yakin ingin menghapus/menonaktifkan akun '" + targetUser.nama_lengkap + "'?")) return;
          var fd = new FormData();
          fd.append('action', 'delete_user');
          fd.append('id_user', targetUser.id_user);
          fetch('ajax.php', { method: 'POST', body: fd })
            .then(function(r){ return r.json(); })
            .then(function(res){
              toast(res.message);
              if (res.success) {
                userSubView = 'list';
                fetchInit(function(){ renderUsers(); });
              }
            });
        };
      }

      document.getElementById("btnSubmitEditUser").onclick = function(){
        var nama = document.getElementById("inpEditNama").value.trim();
        var nip = document.getElementById("inpEditNip").value.trim();
        var pass = document.getElementById("inpEditPass").value.trim();
        var role = document.getElementById("inpEditRole").value;
        var unit = document.getElementById("inpEditUnit").value;
        var status = document.getElementById("inpEditStatus").value;

        if (!nama || !nip) { alert("Nama lengkap dan NIP/Username wajib diisi!"); return; }
        if (role === 'pic' && !unit) { alert("Pegawai dengan peran PIC Unit Kerja wajib dipilihkan unit kerja penempatannya!"); return; }

        var fd = new FormData();
        fd.append('action', 'update_user');
        fd.append('id_user', targetUser.id_user);
        fd.append('nama_lengkap', nama);
        fd.append('nip_username', nip);
        fd.append('password', pass);
        fd.append('id_role', role);
        fd.append('id_unit', (role === 'pic') ? unit : '');
        fd.append('status_aktif', status);

        fetch('ajax.php', { method: 'POST', body: fd })
          .then(function(r){ return r.json(); })
          .then(function(res){
            toast(res.message);
            if (res.success) {
              userSubView = 'list';
              fetchInit(function(){
                renderUsers();
                if (typeof renderHakAkses === 'function') renderHakAkses();
              });
            }
          });
      };
      return;
    }

    // === VIEW 3: DAFTAR AKUN PEGAWAI (TABEL & SEARCH) ===
    var filteredUsers = STATE.users.filter(function(u){
      var matchKw = true;
      if (userSearchKeyword) {
        var kw = userSearchKeyword.toLowerCase();
        matchKw = (u.nama_lengkap && u.nama_lengkap.toLowerCase().indexOf(kw) > -1) ||
                  (u.nip_username && u.nip_username.toLowerCase().indexOf(kw) > -1) ||
                  (u.nama_unit && u.nama_unit.toLowerCase().indexOf(kw) > -1);
      }
      var matchRole = (userRoleFilter === 'all') || (u.id_role === userRoleFilter);
      return matchKw && matchRole;
    });

    var h = '<div class="row" style="margin-top:0;justify-content:flex-end;margin-bottom:12px">' +
              (canCreate ? '<button class="btn sm" id="btnGoAddUserPage" style="display:inline-flex;align-items:center;gap:6px"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> Tambah Pegawai</button>' : '') +
            '</div>';

    // Filter Bar & Pencarian
    h += '<div style="background:#fff;border:1px solid var(--bd);border-radius:12px;padding:12px 16px;margin-bottom:16px;display:flex;gap:12px;align-items:center;flex-wrap:wrap">' +
           '<div style="flex:1;min-width:240px">' +
             '<input id="inpSearchUser" class="srch" style="width:100%;font-size:13px;padding:7px 12px" placeholder="Cari nama pegawai, NIP, atau unit kerja..." value="' + escapeHtml(userSearchKeyword) + '">' +
           '</div>' +
           '<div style="min-width:200px">' +
             '<select id="selFilterRole" class="fl" style="width:100%;font-size:13px;padding:7px 10px">' +
               '<option value="all" ' + (userRoleFilter === 'all' ? 'selected' : '') + '>Semua Peran Pegawai</option>' +
               '<option value="pim" ' + (userRoleFilter === 'pim' ? 'selected' : '') + '>Pimpinan</option>' +
               '<option value="ket" ' + (userRoleFilter === 'ket' ? 'selected' : '') + '>Ketua Tim SKI</option>' +
               '<option value="ang" ' + (userRoleFilter === 'ang' ? 'selected' : '') + '>Anggota Tim SKI</option>' +
               '<option value="pic" ' + (userRoleFilter === 'pic' ? 'selected' : '') + '>PIC Unit Kerja</option>' +
               '<option value="itj" ' + (userRoleFilter === 'itj' ? 'selected' : '') + '>Auditor Itjen</option>' +
               '<option value="adm" ' + (userRoleFilter === 'adm' ? 'selected' : '') + '>Administrator</option>' +
             '</select>' +
           '</div>' +
         '</div>';

    // Tabel Pengguna
    h += '<div class="tw"><table><tr>' +
           '<th>Nama Lengkap Pegawai</th>' +
           '<th>NIP / Username Login</th>' +
           '<th>Peran Sistem</th>' +
           '<th>Unit Kerja Penempatan</th>' +
           '<th style="text-align:center">Status Akun</th>' +
           '<th style="text-align:right">Aksi Kelola Akun</th>' +
         '</tr>';

    if (filteredUsers.length === 0) {
      h += '<tr><td colspan="6" style="text-align:center;padding:28px;color:var(--mut)">Tidak ada pegawai yang cocok dengan kriteria pencarian.</td></tr>';
    } else {
      filteredUsers.forEach(function(u){
        var roleColor = {
          pim: 'background:#fef3c7;color:#92400e;border:1px solid #fde68a',
          ket: 'background:#ccfbf1;color:#0f766e;border:1px solid #99f6e4',
          ang: 'background:#e0f2fe;color:#0369a1;border:1px solid #bae6fd',
          pic: 'background:#ffedd5;color:#c2410c;border:1px solid #fed7aa',
          itj: 'background:#f1f5f9;color:#475569;border:1px solid #cbd5e1',
          adm: 'background:#ffe4e6;color:#be123c;border:1px solid #fecdd3'
        }[u.id_role] || 'background:var(--bg);color:var(--dk)';

        h += '<tr>';
        h += '<td><b>' + escapeHtml(u.nama_lengkap) + '</b></td>';
        h += '<td><code>' + escapeHtml(u.nip_username) + '</code></td>';
        h += '<td><span class="tag" style="' + roleColor + ';font-weight:700">' + escapeHtml(u.nama_role) + '</span></td>';
        h += '<td>' + escapeHtml(u.nama_unit || 'Internal SKI / Pimpinan') + '</td>';
        h += '<td style="text-align:center"><button class="tag ' + (parseInt(u.status_aktif) === 1 ? 't-ok' : 't-gy') + ' btnToggleUsr" data-id="' + u.id_user + '" ' + (canEdit ? '' : 'disabled') + ' style="border:0;cursor:pointer">' + (parseInt(u.status_aktif) === 1 ? 'Aktif' : 'Nonaktif') + '</button></td>';
        h += '<td style="text-align:right">';
        if (canEdit) {
          h += '<div style="display:inline-flex;gap:6px;justify-content:flex-end">' +
                 '<button class="btn sm o btnGoEditUserPage" data-id="' + u.id_user + '" style="font-size:12px;display:inline-flex;align-items:center;gap:4px">' +
                   '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg> Kelola &amp; Edit Akun' +
                 '</button>' +
                 (canDelete && u.id_user !== STATE.user.id ? '<button class="btn sm o btnDelUserRow" data-id="' + u.id_user + '" data-nama="' + escapeHtml(u.nama_lengkap) + '" style="font-size:12px;border-color:#ef4444;color:#ef4444;padding:4px 8px" title="Hapus / Nonaktifkan Akun"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></button>' : '') +
               '</div>';
        } else {
          h += '<span style="color:var(--mut);font-size:11.5px">Read-only</span>';
        }
        h += '</td>';
        h += '</tr>';
      });
    }

    h += '</table></div>';
    document.getElementById("usrC").innerHTML = h;

    if (document.getElementById("btnGoAddUserPage")) {
      document.getElementById("btnGoAddUserPage").onclick = function(){
        userSubView = 'add';
        renderUsers();
      };
    }

    document.querySelectorAll(".btnGoEditUserPage").forEach(function(b){
      b.onclick = function(){
        userEditTargetId = this.dataset.id;
        userSubView = 'edit';
        renderUsers();
      };
    });

    document.querySelectorAll(".btnDelUserRow").forEach(function(b){
      b.onclick = function(){
        var uId = this.dataset.id;
        var uNm = this.dataset.nama;
        if (!confirm("Apakah Anda yakin ingin menghapus/menonaktifkan akun '" + uNm + "'?")) return;
        var fd = new FormData();
        fd.append('action', 'delete_user');
        fd.append('id_user', uId);
        fetch('ajax.php', { method: 'POST', body: fd })
          .then(function(r){ return r.json(); })
          .then(function(res){
            toast(res.message);
            if (res.success) fetchInit(function(){ renderUsers(); });
          });
      };
    });

    document.querySelectorAll(".btnToggleUsr").forEach(function(b){
      b.onclick = function(){
        var fd = new FormData();
        fd.append('action', 'toggle_user_status');
        fd.append('id_user', this.dataset.id);
        fetch('ajax.php', { method: 'POST', body: fd }).then(function(r){ return r.json(); }).then(function(res){
          toast(res.message); if (res.success) fetchInit(function(){ renderUsers(); });
        });
      };
    });

    var inpSearch = document.getElementById("inpSearchUser");
    if (inpSearch) {
      inpSearch.oninput = function(){
        userSearchKeyword = this.value;
        renderUsers();
        var reFocus = document.getElementById("inpSearchUser");
        if (reFocus) { reFocus.focus(); reFocus.selectionStart = reFocus.selectionEnd = reFocus.value.length; }
      };
    }

    var selRoleF = document.getElementById("selFilterRole");
    if (selRoleF) {
      selRoleF.onchange = function(){
        userRoleFilter = this.value;
        renderUsers();
      };
    }
  }

  // --- 13. HAK AKSES (RBAC Granular dengan Selektor Peran Dinamis oleh Admin) ---
  var currentHakRole = 'ket'; // Default peran yang sedang dikonfigurasi hak aksesnya
  function renderHakAkses() {
    var AK = { l: "Lihat", t: "Tambah", u: "Ubah", h: "Hapus", d: "Unduh", s: "Setujui" };
    var FE = [
      { k: "dash", n: "Dashboard Statistik" },
      { k: "mod",  n: "Master Modul & Template" },
      { k: "jdw",  n: "Jadwal & Periode Unggah" },
      { k: "upl",  n: "Upload Berkas Eviden" },
      { k: "mon",  n: "Monitoring Upload Satker" },
      { k: "rep",  n: "Repositori Eviden & Berkas" },
      { k: "rev",  n: "Review & Cross-check SKI" },
      { k: "apr",  n: "Approval Ketua SKI" },
      { k: "apm",  n: "Approval Pimpinan (Kepala BBPK)" },
      { k: "exp",  n: "Ekspor Modul Akhir (GForm Itjen)" },
      { k: "aud",  n: "Audit Trail Sistem" },
      { k: "usr",  n: "Pengguna & Peran" },
      { k: "hak",  n: "Hak Akses Matriks RBAC" }
    ];

    var h = '';

    // Selektor Peran yang Dikonfigurasi
    h += '<div style="background:#fff;border:1px solid var(--bd);border-radius:14px;padding:14px 20px;margin-bottom:16px;box-shadow:0 2px 8px rgba(0,0,0,.03)">' +
           '<div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px">' +
             '<label style="font-size:12.5px;font-weight:700;color:var(--dk)">PILIH PERAN PEGAWAI YANG DIKELOLA HAK AKSESNYA:</label>' +
             '<select id="selHakRole" class="fl" style="font-weight:800;font-size:13.5px;padding:8px 12px;min-width:320px;border-color:var(--pri)">' +
               '<option value="ket" ' + (currentHakRole === 'ket' ? 'selected' : '') + '>Ketua Tim SKI</option>' +
               '<option value="pim" ' + (currentHakRole === 'pim' ? 'selected' : '') + '>Kepala BBPK / Pimpinan</option>' +
               '<option value="ang" ' + (currentHakRole === 'ang' ? 'selected' : '') + '>Anggota Tim SKI</option>' +
               '<option value="pic" ' + (currentHakRole === 'pic' ? 'selected' : '') + '>PIC Unit Kerja</option>' +
               '<option value="itj" ' + (currentHakRole === 'itj' ? 'selected' : '') + '>Auditor Itjen</option>' +
               '<option value="adm" ' + (currentHakRole === 'adm' ? 'selected' : '') + '>Administrator</option>' +
             '</select>' +
           '</div>' +
         '</div>';

    // Matriks Checkbox Permissions untuk Peran Terpilih
    var targetRolePerms = (STATE.rolePermissions && STATE.rolePermissions[currentHakRole]) ? STATE.rolePermissions[currentHakRole] : {};

    h += '<div class="tw"><table><tr><th>Fitur Sistem</th>' + Object.values(AK).map(function(v){ return '<th style="text-align:center">' + v + '</th>'; }).join('') + '</tr>';
    FE.forEach(function(f){
      var permsForMenu = targetRolePerms[f.k] || "";
      h += '<tr><td><b>' + f.n + '</b> <span style="font-size:11px;color:var(--mut)">(' + f.k + ')</span></td>';
      Object.keys(AK).forEach(function(act){
        var isChecked = permsForMenu.indexOf(act) > -1;
        var isAdminLocked = (currentHakRole === 'adm' && ['upl', 'mon', 'rep', 'rev', 'apr', 'apm'].indexOf(f.k) > -1);

        h += '<td style="text-align:center">' +
               '<input type="checkbox" class="cbPerm" data-menu="' + f.k + '" data-act="' + act + '" ' +
               (isChecked ? 'checked' : '') + ' ' +
               (isAdminLocked ? 'disabled title="Isolasi RNF-01: Admin terkunci mutlak dari eviden dan approval demi integritas audit"' : '') +
               ' style="cursor:pointer;width:16px;height:16px">' +
             '</td>';
      });
      h += '</tr>';
    });
    h += '</table></div>';
    document.getElementById("hakC").innerHTML = h;

    // Listener Dropdown Pilih Peran
    var selRoleEl = document.getElementById("selHakRole");
    if (selRoleEl) {
      selRoleEl.onchange = function(){
        currentHakRole = this.value;
        renderHakAkses();
      };
    }

    // Listener Checkbox Perubahan Permission untuk Peran Terpilih
    document.querySelectorAll(".cbPerm:not([disabled])").forEach(function(cb){
      cb.onchange = function(){
        var self = this;
        var menuKey = this.dataset.menu;
        var actKey = this.dataset.act;
        var isChk = this.checked ? '1' : '0';

        var fd = new FormData();
        fd.append('action', 'update_permission');
        fd.append('id_role', currentHakRole);
        fd.append('menu', menuKey);
        fd.append('action_key', actKey);
        fd.append('checked', isChk);

        fetch('ajax.php', { method: 'POST', body: fd })
          .then(function(r){ return r.json(); })
          .then(function(res){
            toast(res.message);
            if (res.success) {
              if (!STATE.rolePermissions[currentHakRole]) STATE.rolePermissions[currentHakRole] = {};
              var cur = STATE.rolePermissions[currentHakRole][menuKey] || "";
              if (self.checked) {
                if (cur.indexOf(actKey) === -1) cur += actKey;
              } else {
                cur = cur.replace(actKey, "");
              }
              STATE.rolePermissions[currentHakRole][menuKey] = cur;

              // Jika peran yang diubah adalah peran user yang sedang login, update STATE.perms
              if (STATE.user && STATE.user.role === currentHakRole) {
                STATE.perms[menuKey] = cur;
                syncNav();
              }
            }
          });
      };
    });
  }

  // --- 13. PROFIL AKUN PENGGUNA MANDIRI ---
  function renderProfile() {
    var u = STATE.user;
    if (!u) return;

    var isAdmin = (u.role === 'adm');
    var initials = u.nama ? u.nama.trim().substr(0, 2).toUpperCase() : 'AK';

    var h = '<div style="margin-top:0">' +
      // Navigation / Breadcrumb Bar
      '<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:18px;flex-wrap:wrap;gap:10px">' +
        '<button class="btn sm o" id="btnBackFromProf" style="display:inline-flex;align-items:center;gap:6px">' +
          '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg> Kembali ke Dashboard' +
        '</button>' +
        '<div style="display:flex;align-items:center;gap:8px">' +
          '<span class="tag t-ok" style="font-weight:700;font-size:12px">Akun Aktif Terverifikasi</span>' +
          '<span class="tag t-in" style="font-weight:700;font-size:12px">' + escapeHtml(u.nama_role) + '</span>' +
        '</div>' +
      '</div>' +

      // 2-Column Responsive Grid Layout
      '<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:20px;align-items:start">' +

        // KOLOM KIRI: Kartu Ringkasan Akun & Foto Profil (Dummy)
        '<div style="background:#fff;border:1px solid var(--bd);border-radius:18px;padding:24px;box-shadow:0 4px 20px rgba(0,0,0,.04);text-align:center">' +
          // Avatar Visual Frame
          '<div style="position:relative;width:96px;height:96px;margin:0 auto 16px">' +
            '<div style="width:96px;height:96px;border-radius:50%;background:linear-gradient(135deg,var(--pri),var(--dk));color:#fff;display:grid;place-items:center;font-size:32px;font-weight:800;letter-spacing:1px;box-shadow:0 8px 24px rgba(10,143,131,.3);border:3px solid #fff">' +
              initials +
            '</div>' +
            '<span style="position:absolute;bottom:4px;right:4px;width:16px;height:16px;border-radius:50%;background:#16a34a;border:2.5px solid #fff;box-shadow:0 2px 6px rgba(0,0,0,.15)" title="Status Akun: Aktif"></span>' +
          '</div>' +

          '<h3 style="margin:0 0 4px;font-size:18px;color:var(--dk);font-weight:700">' + escapeHtml(u.nama) + '</h3>' +
          '<div style="font-size:12.5px;color:var(--mut);margin-bottom:12px">NIP / Username: <b style="color:var(--tx)">' + escapeHtml(u.username) + '</b></div>' +

          '<div style="display:inline-flex;align-items:center;gap:6px;background:var(--pri2);color:var(--pri);padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;margin-bottom:16px">' +
            '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg> ' +
            escapeHtml(u.nama_role) +
          '</div>' +

          // GANTI FOTO PROFIL (DUMMY FITUR - SESUAI INSTRUKSI)
          '<div style="background:var(--bg);border:1px dashed var(--bd);border-radius:14px;padding:14px;margin-bottom:18px">' +
            '<button type="button" class="btn sm o" id="btnDummyPhoto" style="width:100%;display:inline-flex;align-items:center;justify-content:center;gap:7px;font-size:12.5px;padding:8px 12px;border-radius:10px">' +
              '<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>' +
              'Ganti Foto Profil' +
            '</button>' +
            '<div style="font-size:11px;color:var(--mut);margin-top:8px;line-height:1.4">' +
              'Format berkas foto: JPG / PNG, maksimal 2MB.<br>' +
              '<span style="color:var(--wn);font-weight:600">*) Fitur unggah foto kustom sedang disiapkan (Dummy).</span>' +
            '</div>' +
          '</div>' +

          // Informasi Tambahan
          '<div style="text-align:left;border-top:1px solid var(--bd);padding-top:16px;display:flex;flex-direction:column;gap:10px;font-size:12.5px">' +
            '<div style="display:flex;justify-content:space-between;align-items:center">' +
              '<span style="color:var(--mut)">Unit Kerja:</span>' +
              '<b style="color:var(--tx);text-align:right">' + escapeHtml(u.nama_unit || 'Internal SKI / Pimpinan') + '</b>' +
            '</div>' +
            '<div style="display:flex;justify-content:space-between;align-items:center">' +
              '<span style="color:var(--mut)">ID Akun:</span>' +
              '<code style="font-size:11px;background:var(--bg);padding:2px 6px;border-radius:4px;color:var(--mut)">' + escapeHtml(u.id) + '</code>' +
            '</div>' +
            '<div style="display:flex;justify-content:space-between;align-items:center">' +
              '<span style="color:var(--mut)">Instansi:</span>' +
              '<span style="font-weight:600;color:var(--tx)">BBPK Jakarta - Kemenkes RI</span>' +
            '</div>' +
          '</div>' +
        '</div>' +

        // KOLOM KANAN: Formulir Pembaruan Profil & Keamanan Password
        '<div style="background:#fff;border:1px solid var(--bd);border-radius:18px;padding:26px 28px;box-shadow:0 4px 20px rgba(0,0,0,.04)">' +
          // Heading Formulir
          '<div style="border-bottom:1px solid var(--bd);padding-bottom:14px;margin-bottom:20px">' +
            '<h3 style="margin:0 0 4px;font-size:17px;color:var(--dk);display:flex;align-items:center;gap:8px">' +
              '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>' +
              'Perbarui Informasi Akun &amp; Keamanan' +
            '</h3>' +
            '<p style="margin:0;font-size:12.5px;color:var(--mut)">Kelola nama lengkap kedinasan Anda dan ganti kata sandi secara berkala untuk menjaga keamanan akun.</p>' +
          '</div>' +

          // 1. DATA IDENTITAS
          '<div style="margin-bottom:22px">' +
            '<h4 style="margin:0 0 12px;font-size:13.5px;color:var(--pri);display:flex;align-items:center;gap:6px">' +
              '<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>' +
              '1. Data Diri Pegawai' +
            '</h4>' +

            // Input Nama Lengkap
            '<div style="margin-bottom:16px">' +
              '<label style="display:block;font-size:12.5px;font-weight:700;color:var(--dk);margin-bottom:6px">' +
                'Nama Lengkap &amp; Gelar <span style="color:#ef4444">*</span>' +
              '</label>' +
              '<input type="text" id="profInpNama" class="srch" style="width:100%;padding:10px 14px;font-size:13.5px;background:#fff" value="' + escapeAttr(u.nama) + '" placeholder="Contoh: Dr. Budi Prasetyo, S.Kom., M.M.">' +
              '<small style="display:block;color:var(--mut);font-size:11.5px;margin-top:4px">Gunakan nama resmi kedinasan yang akan tertera pada jejak audit dan lembar eviden pengawasan.</small>' +
            '</div>' +

            // Input NIP / Username (Admin Only Edit)
            '<div style="margin-bottom:16px">' +
              '<label style="display:block;font-size:12.5px;font-weight:700;color:var(--dk);margin-bottom:6px">' +
                'NIP / Username Login <span style="color:#ef4444">*</span>' +
              '</label>' +
              (isAdmin
                ? '<input type="text" id="profInpNip" class="srch" style="width:100%;padding:10px 14px;font-size:13.5px;background:#fff;border-color:var(--pri)" value="' + escapeAttr(u.username) + '">' +
                  '<div style="display:flex;align-items:center;gap:5px;font-size:12px;color:var(--pri);margin-top:5px;font-weight:600">' +
                    '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>' +
                    'Hak Akses Administrator: Anda berhak mengubah NIP / Username akun ini.' +
                  '</div>'
                : '<div style="position:relative">' +
                    '<input type="text" id="profInpNip" class="srch" style="width:100%;padding:10px 38px 10px 14px;font-size:13.5px;background:#f8fafc;cursor:not-allowed;color:var(--mut)" value="' + escapeAttr(u.username) + '" readonly>' +
                    '<span style="position:absolute;right:14px;top:50%;transform:translateY(-50%);color:var(--mut)" title="Terkunci">' +
                      '<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>' +
                    '</span>' +
                  '</div>' +
                  '<div style="display:flex;align-items:center;gap:6px;font-size:12px;color:#b91c1c;margin-top:6px;background:#fef2f2;border:1px solid #fee2e2;padding:6px 12px;border-radius:8px">' +
                    '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>' +
                    'NIP / Username terkunci. Sesuai kebijakan tata kelola sistem, hanya Administrator yang berwenang mengubah NIP/Username.' +
                  '</div>'
              ) +
            '</div>' +
          '</div>' +

          // 2. KEAMANAN & UBAH KATA SANDI
          '<div style="border-top:1px solid var(--bd);padding-top:20px;margin-bottom:24px">' +
            '<h4 style="margin:0 0 6px;font-size:13.5px;color:var(--pri);display:flex;align-items:center;gap:6px">' +
              '<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>' +
              '2. Ubah Kata Sandi (Opsional)' +
            '</h4>' +
            '<p style="margin:0 0 14px;font-size:12px;color:var(--mut)">Kosongkan seluruh kolom kata sandi di bawah jika Anda tidak ingin mengubah kata sandi akun saat ini.</p>' +

            // Password Saat Ini
            '<div style="margin-bottom:14px">' +
              '<label style="display:block;font-size:12.5px;font-weight:700;color:var(--dk);margin-bottom:5px">Kata Sandi Saat Ini</label>' +
              '<div style="display:flex;gap:6px">' +
                '<input type="password" id="profInpCurPass" class="srch" style="flex:1;padding:10px 14px;font-size:13.5px;background:#fff" placeholder="Masukkan kata sandi saat ini...">' +
                '<button type="button" class="btn sm o btnToggleProfPass" data-target="profInpCurPass" style="padding:0 12px" title="Lihat/Sembunyikan Kata Sandi">' +
                  '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>' +
                '</button>' +
              '</div>' +
            '</div>' +

            // Password Baru & Konfirmasi
            '<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:12px">' +
              '<div>' +
                '<label style="display:block;font-size:12.5px;font-weight:700;color:var(--dk);margin-bottom:5px">Kata Sandi Baru</label>' +
                '<div style="display:flex;gap:6px">' +
                  '<input type="password" id="profInpNewPass" class="srch" style="flex:1;padding:10px 14px;font-size:13.5px;background:#fff" placeholder="Minimal 5 karakter...">' +
                  '<button type="button" class="btn sm o btnToggleProfPass" data-target="profInpNewPass" style="padding:0 12px" title="Lihat/Sembunyikan">' +
                    '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>' +
                  '</button>' +
                '</div>' +
              '</div>' +
              '<div>' +
                '<label style="display:block;font-size:12.5px;font-weight:700;color:var(--dk);margin-bottom:5px">Konfirmasi Kata Sandi Baru</label>' +
                '<div style="display:flex;gap:6px">' +
                  '<input type="password" id="profInpConfPass" class="srch" style="flex:1;padding:10px 14px;font-size:13.5px;background:#fff" placeholder="Ulangi kata sandi baru...">' +
                  '<button type="button" class="btn sm o btnToggleProfPass" data-target="profInpConfPass" style="padding:0 12px" title="Lihat/Sembunyikan">' +
                    '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>' +
                  '</button>' +
                '</div>' +
              '</div>' +
            '</div>' +
          '</div>' +

          // Action Buttons
          '<div style="display:flex;align-items:center;justify-content:flex-end;gap:12px;border-top:1px solid var(--bd);padding-top:20px">' +
            '<button type="button" class="btn o" id="btnCancelProfile" style="padding:10px 18px;font-size:13.5px">Batal / Kembali</button>' +
            '<button type="button" class="btn" id="btnSaveProfile" style="padding:10px 24px;font-size:13.5px;display:inline-flex;align-items:center;gap:8px">' +
              '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>' +
              'Simpan Perubahan Profil' +
            '</button>' +
          '</div>' +
        '</div>' +
      '</div>' +
    '</div>';

    document.getElementById("profC").innerHTML = h;

    // Attach Event Handlers:
    // 1. Back button
    var btnBack = document.getElementById("btnBackFromProf");
    if (btnBack) {
      btnBack.onclick = function(){ showScreen('dash'); };
    }
    var btnCancel = document.getElementById("btnCancelProfile");
    if (btnCancel) {
      btnCancel.onclick = function(){ showScreen('dash'); };
    }

    // 2. Dummy photo changer modal
    var btnPhoto = document.getElementById("btnDummyPhoto");
    if (btnPhoto) {
      btnPhoto.onclick = function(){
        openModal({
          title: "Pengaturan Foto Profil Pegawai",
          body: '<div style="text-align:center;padding:12px 6px">' +
                  '<div style="width:64px;height:64px;border-radius:50%;background:var(--pri2);color:var(--pri);display:grid;place-items:center;margin:0 auto 14px;box-shadow:0 4px 14px rgba(10,143,131,.18)">' +
                    '<svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>' +
                  '</div>' +
                  '<h4 style="margin:0 0 8px;color:var(--dk);font-size:16px;font-weight:700">Foto profil belum tersedia</h4>' +
                  '<p style="color:var(--tx);font-size:13px;line-height:1.55;margin:0 0 14px">' +
                    'Avatar menampilkan inisial <b>' + initials + '</b>.' +
                  '</p>' +
                '</div>',
          cancelText: "Saya Mengerti &amp; Tutup",
          width: "520px"
        });
      };
    }

    // 3. Eye toggle password
    document.querySelectorAll(".btnToggleProfPass").forEach(function(b){
      b.onclick = function(){
        var targetId = this.dataset.target;
        var inp = document.getElementById(targetId);
        if (inp) {
          inp.type = inp.type === 'password' ? 'text' : 'password';
        }
      };
    });

    // 4. Submit Profile Update
    var btnSave = document.getElementById("btnSaveProfile");
    if (btnSave) {
      btnSave.onclick = function(){
        var namaInp = document.getElementById("profInpNama");
        var nipInp = document.getElementById("profInpNip");
        var curPassInp = document.getElementById("profInpCurPass");
        var newPassInp = document.getElementById("profInpNewPass");
        var confPassInp = document.getElementById("profInpConfPass");

        var nama = namaInp ? namaInp.value.trim() : '';
        var nip = nipInp ? nipInp.value.trim() : '';
        var curPass = curPassInp ? curPassInp.value : '';
        var newPass = newPassInp ? newPassInp.value : '';
        var confPass = confPassInp ? confPassInp.value : '';

        if (!nama) {
          alert("Nama lengkap wajib diisi.");
          if (namaInp) namaInp.focus();
          return;
        }

        if (isAdmin && !nip) {
          alert("NIP / Username wajib diisi untuk Administrator.");
          if (nipInp) nipInp.focus();
          return;
        }

        var isChangingPass = (curPass !== '' || newPass !== '' || confPass !== '');
        if (isChangingPass) {
          if (!curPass) {
            alert("Silakan masukkan Kata Sandi Saat Ini untuk memverifikasi penggantian kata sandi.");
            if (curPassInp) curPassInp.focus();
            return;
          }
          if (newPass.length < 5) {
            alert("Kata sandi baru minimal 5 karakter demi keamanan akun.");
            if (newPassInp) newPassInp.focus();
            return;
          }
          if (newPass !== confPass) {
            alert("Konfirmasi kata sandi baru tidak cocok dengan kata sandi baru.");
            if (confPassInp) confPassInp.focus();
            return;
          }
        }

        var origHtml = btnSave.innerHTML;
        btnSave.disabled = true;
        btnSave.textContent = "Menyimpan Perubahan...";

        var fd = new FormData();
        fd.append('action', 'update_profile');
        fd.append('nama_lengkap', nama);
        if (isAdmin) {
          fd.append('nip_username', nip);
        }
        if (isChangingPass) {
          fd.append('current_password', curPass);
          fd.append('new_password', newPass);
          fd.append('confirm_password', confPass);
        }

        fetch('ajax.php', { method: 'POST', body: fd })
          .then(function(r){ return r.json(); })
          .then(function(res){
            btnSave.disabled = false;
            btnSave.innerHTML = origHtml;
            if (res.success) {
              STATE.user = res.user;

              // Perbarui tampilan header secara real-time tanpa perlu refresh halaman
              var uav = document.getElementById("uav");
              var unm = document.getElementById("unm");
              var urn = document.getElementById("urn");
              if (uav && res.user.nama) uav.textContent = res.user.nama.trim().substr(0, 2).toUpperCase();
              if (unm && res.user.nama) unm.textContent = res.user.nama;
              if (urn && res.user.nama_role) urn.textContent = res.user.nama_role;

              // Sinkronkan juga daftar user jika ada di STATE.users
              if (Array.isArray(STATE.users)) {
                var uIdx = STATE.users.findIndex(function(x){ return x.id_user === res.user.id; });
                if (uIdx > -1) {
                  STATE.users[uIdx].nama_lengkap = res.user.nama;
                  STATE.users[uIdx].nip_username = res.user.username;
                }
              }

              toast(res.message);
              renderProfile();
            } else {
              alert(res.message || "Gagal memperbarui profil.");
            }
          })
          .catch(function(err){
            btnSave.disabled = false;
            btnSave.innerHTML = origHtml;
            alert("Terjadi kesalahan jaringan atau server: " + err.message);
          });
      };
    }
  }

  // --- EVENT HANDLERS ---
  document.querySelectorAll(".nav").forEach(function(btn){
    btn.onclick = function(){
      if (can(this.dataset.s, 'l')) {
        if (this.dataset.s === 'mod') {
          currentModulId = null; // Selalu kembali ke katalog modul bila menu Modul Master diklik di sidebar
        }
        if (this.dataset.s === 'upl') {
          uplSelectedModulId = null; // Selalu kembali ke katalog daftar modul tugas eviden bila menu Upload Eviden diklik di sidebar
        }
        if (this.dataset.s === 'usr') {
          userSubView = 'list';
          userEditTargetId = null;
        }
        showScreen(this.dataset.s);
      }
    };
  });

  document.querySelectorAll(".rb[data-g]").forEach(function(rb){
    rb.onclick = function(){
      var g = this.dataset.g;
      document.getElementById("sidebar").classList.remove("col");
      var pg = document.querySelector('.pg[data-g="' + g + '"]');
      if (!pg) return;
      var permittedNav = [].filter.call(pg.querySelectorAll(".nav"), function(n){
        return n.style.display !== 'none' && can(n.dataset.s, 'l');
      })[0];
      if (permittedNav) {
        if (permittedNav.dataset.s === 'mod') currentModulId = null;
        if (permittedNav.dataset.s === 'upl') uplSelectedModulId = null;
        showScreen(permittedNav.dataset.s);
      }
    };
  });

  document.getElementById("sbt").onclick = function(){
    document.getElementById("sidebar").classList.toggle("col");
  };

  function syncDemoInputs() {
    var sel = document.getElementById("lr");
    if (!sel) return;
    var v = sel.value;
    var uInp = document.getElementById("lu");
    var pInp = document.getElementById("lp");
    if (v === 'pic-keu') { uInp.value = 'budi.keu'; pInp.value = 'password123'; }
    else if (v === 'pic-peg') { uInp.value = 'dewi.peg'; pInp.value = 'password123'; }
    else if (v === 'pic-ren') { uInp.value = 'agus.ren'; pInp.value = 'password123'; }
    else if (v === 'ang') { uInp.value = 'rina.ski'; pInp.value = 'password123'; }
    else if (v === 'ket') { uInp.value = 'ketua.ski'; pInp.value = 'password123'; }
    else if (v === 'pim') { uInp.value = 'pimpinan'; pInp.value = 'password123'; }
    else if (v === 'itj') { uInp.value = 'itjen.01'; pInp.value = 'password123'; }
    else if (v === 'adm') { uInp.value = 'admin'; pInp.value = 'password123'; }
  }

  var lrEl = document.getElementById("lr");
  if (lrEl) {
    lrEl.onchange = syncDemoInputs;
    syncDemoInputs();
  }

  document.getElementById("btnMasuk").onclick = function(){
    var lu = document.getElementById("lu").value;
    var lp = document.getElementById("lp").value;
    var lr = document.getElementById("lr").value;
    var fd = new FormData();
    fd.append('action', 'login');
    fd.append('username', lu);
    fd.append('password', lp);
    fd.append('demo_role', lr);

    fetch('ajax.php', { method: 'POST', body: fd })
      .then(function(r){ return r.json(); })
      .then(function(res){
        if (res.success) {
          toast("Autentikasi berhasil.");
          fetchInit(function(){ showScreen('dash'); });
        } else {
          toast(res.message);
        }
      });
  };

  var btnGoogle = document.getElementById("btnGoogleMasuk");
  if (btnGoogle) {
    btnGoogle.onclick = function(){
      toast("Fitur 'Lanjutkan dengan Google' sedang dalam tahap pengembangan (Google Workspace BBPK / @kemkes.go.id).");
    };
  }

  document.getElementById("eye").onclick = function(){
    var p = document.getElementById("lp");
    p.type = p.type === 'password' ? 'text' : 'password';
  };

  // Mobile menu toggle & drawer close
  var mbt = document.getElementById("mbt");
  var ov = document.getElementById("ov");
  var mdc = document.getElementById("mdc");
  if (mbt && ov) {
    mbt.onclick = function(){ document.body.classList.toggle("nav-open"); };
    ov.onclick = function(){ document.body.classList.remove("nav-open"); };
  }
  if (mdc) {
    mdc.onclick = function(){ document.body.classList.remove("nav-open"); };
  }

  var btnUserAccount = document.getElementById("btnUserAccount");
  if (btnUserAccount) {
    btnUserAccount.onclick = function(){ showScreen('prof'); };
  }

  // Initial load
  fetchInit(function(){ showScreen('dash'); });
})();
</script>
</body>
</html>