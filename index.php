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
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500&display=swap" rel="stylesheet">
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
#appView{height:100vh;height:100dvh;overflow:hidden}
.app{display:flex;height:100vh;height:100dvh;min-height:0;align-items:flex-start;overflow:hidden}
.side{
  position:sticky;top:0;height:100vh;height:100dvh;align-self:flex-start;
  display:flex;flex-direction:column;
  width:260px;flex-shrink:0;z-index:10;
  background:#e8f8f6;
  border-right:1px solid rgba(13,148,136,.16);
  box-shadow:1px 0 12px rgba(10,95,87,.04);
  transition:width .25s cubic-bezier(.4,0,.2,1);
  overflow:visible;
}
.side.col{width:72px}
.side-header{
  display:flex;align-items:center;gap:12px;
  padding:16px 16px 14px;
  border-bottom:1px solid rgba(13,148,136,.14);
  position:relative;
  min-height:74px;
  box-sizing:border-box;
}
.brand-logo-card{
  width:44px;height:44px;border-radius:14px;
  background:#fff;border:1.5px solid rgba(13,148,136,.2);
  box-shadow:0 3px 10px rgba(10,95,87,.08);
  display:grid;place-items:center;
  flex-shrink:0;overflow:hidden;padding:6px;
}
.brand-logo-img{width:100%;height:100%;object-fit:contain}
.side-brand-info{
  display:flex;flex-direction:column;min-width:0;line-height:1.2;
}
.side-brand-info strong{
  color:#006a55;font-size:15.5px;font-weight:800;letter-spacing:-.01em;
}
.side-brand-info span{
  color:#526b66;font-size:12px;font-weight:600;
}
.tg{
  position:absolute;right:-13px;top:62px;
  width:26px;height:26px;border-radius:50%;
  border:1px solid rgba(13,148,136,.24);
  background:#fff;color:#006a55;
  display:grid;place-items:center;cursor:pointer;
  box-shadow:0 2px 8px rgba(0,0,0,.08);
  z-index:12;transition:all .2s ease;
}
.tg:hover{transform:scale(1.1);background:#f4fbf9}
.side.col .tg{right:-13px}
.side.col .tg svg{transform:rotate(180deg)}
.side.col .side-brand-info{display:none}
.side.col .brand-logo-card{margin:0 auto}

.side-nav-body{
  flex:1;overflow-y:auto;overflow-x:hidden;
  padding:14px 12px 24px;
  display:flex;flex-direction:column;gap:14px;
  scrollbar-width:thin;
  scrollbar-color:rgba(13,148,136,.22) transparent;
}
.side-nav-body::-webkit-scrollbar{width:4px}
.side-nav-body::-webkit-scrollbar-thumb{background:rgba(13,148,136,.22);border-radius:4px}

.nav-group{
  display:flex;flex-direction:column;gap:3px;
}
.nav-group-title{
  color:#357a70;font-size:10.5px;font-weight:800;
  letter-spacing:.06em;text-transform:uppercase;
  padding:6px 12px 2px;
  user-select:none;
}
.side.col .nav-group-title{display:none}

.nav{
  display:flex;align-items:center;gap:12px;
  width:100%;text-align:left;
  background:transparent;border:1.5px solid transparent;
  color:#1e3a34;padding:10px 12px;border-radius:14px;
  cursor:pointer;font:inherit;font-size:13.5px;font-weight:600;
  transition:all .18s ease;position:relative;
  text-decoration:none;box-sizing:border-box;
}
.nav:hover:not(.on){
  background:rgba(255,255,255,.62);
  color:#006a55;
  transform:translateX(2px);
}
.nav.on{
  background:#ffffff;
  color:#006a55;
  font-weight:700;
  border-color:rgba(13,148,136,.28);
  box-shadow:0 3px 12px rgba(10,95,87,.08);
}
.nav-icon{
  width:22px;height:22px;display:grid;place-items:center;
  flex-shrink:0;color:currentColor;
}
.nav-txt{
  flex:1;min-width:0;white-space:nowrap;overflow:hidden;
  text-overflow:ellipsis;letter-spacing:-.01em;
}
.side.col .nav{
  padding:10px 0;justify-content:center;
  border-radius:12px;
}
.side.col .nav-txt{display:none}
.side.col .nav-badge{
  position:absolute;top:4px;right:6px;min-width:16px;height:16px;
  font-size:10px;padding:0 3px;
}
.nav-badge{
  margin-left:auto;
  background:#e11d48;color:#ffffff;
  font-size:11px;font-weight:700;
  border-radius:9999px;min-width:20px;height:20px;
  display:inline-grid;place-items:center;padding:0 6px;
  box-shadow:0 1px 4px rgba(225,29,72,.3);
  flex-shrink:0;
}
.mw{flex:1;min-width:0;display:flex;flex-direction:column;height:100%;min-height:0;max-width:100%;overflow-x:hidden}
.hd{background:#e8f8f6;color:#1b2333;min-height:68px;padding:0 24px;display:flex;align-items:center;gap:14px;position:sticky;top:env(safe-area-inset-top,0px);z-index:5;border-bottom:1px solid rgba(13,148,136,.14);box-shadow:0 2px 10px rgba(7,94,87,.08)}
.hd-brand{font-size:16px;font-weight:800;line-height:1.2;letter-spacing:-.01em;white-space:nowrap}
.hd-brand small{display:block;margin-top:2px;font-size:11.5px;font-weight:400;color:#64748b}
.ua{margin-left:auto;display:flex;gap:16px;align-items:center}
.hl{color:#334155;text-decoration:none;font-weight:500;display:inline-flex;align-items:center;gap:4px;font-size:12.5px}
.hl:hover{color:#075e57}
.usr{display:flex;align-items:center;gap:10px;padding:4px 10px 4px 14px;border-left:1px solid rgba(13,148,136,.2);cursor:pointer;border-radius:12px;transition:all .18s ease;user-select:none}
.usr:hover{background:rgba(255,255,255,.62);box-shadow:0 2px 10px rgba(0,0,0,.06);transform:translateY(-1px)}
.usr i{width:36px;height:36px;border-radius:50%;background:#d5f3ed;color:#075e57;display:grid;place-items:center;font-weight:700;font-style:normal;font-size:12px;box-shadow:0 0 0 2px rgba(13,148,136,.16);transition:transform .18s ease}
.usr:hover i{transform:scale(1.06)}
.un{display:flex;flex-direction:column;line-height:1.25}.un b{font-size:13px;font-weight:600}.un small{font-size:11.5px;color:#64748b}
.btn{background:var(--pri);color:#fff;border:0;border-radius:10px;padding:8px 14px;cursor:pointer;font:inherit;font-weight:600;transition:.15s;box-shadow:0 2px 6px rgba(10,143,131,.25);display:inline-flex;align-items:center;justify-content:center;gap:6px}
.btn:hover{filter:brightness(1.08);transform:translateY(-1px)}.btn.o{background:none;color:var(--pri);border:1px solid var(--pri);box-shadow:none}
.btn.o:hover{background:var(--pri2)}.btn.lo{background:#fff;color:#075e57;border:1px solid rgba(13,148,136,.28);border-radius:8px;box-shadow:none;display:inline-flex;align-items:center;gap:7px;padding:6px 12px;font-size:12.5px}
.btn.lo:hover{background:#f4fbf9;border-color:#0d9488;transform:none}
.btn.sm{padding:6px 11px;font-size:12px;border-radius:8px}
.main{flex:1;min-width:0;min-height:0;max-width:100%;box-sizing:border-box;padding:20px;overflow-y:auto;overscroll-behavior:contain}
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
.apm-shell{background:#fff;border:1px solid #e2e8f0;border-radius:16px;overflow:hidden}
.apm-toolbar{display:flex;align-items:stretch;justify-content:space-between;gap:14px;min-height:54px;padding:0 24px 0 30px;border-bottom:1px solid #e8edf4}
.apm-tabs{display:flex;align-items:stretch;gap:20px;min-width:0}
.apm-tab{position:relative;display:inline-flex;align-items:center;gap:8px;padding:0 8px 1px;border:0;border-bottom:2px solid transparent;border-radius:0;background:transparent;color:#49627e;font:500 12px/1.2 "Plus Jakarta Sans",sans-serif;cursor:pointer;white-space:nowrap;box-shadow:none}
.apm-tab:hover{color:#087066;background:transparent;transform:none;filter:none}
.apm-tab.active{border-bottom-color:#087066;color:#087066;font-weight:600}
.apm-count{min-width:22px;height:20px;display:inline-grid;place-items:center;padding:0 6px;border-radius:999px;background:#e9f8f3;color:#087066;font-size:10px;font-weight:700}
.apm-count.revision{background:#f1f4f8;color:#52657d}
.apm-search-wrap{position:relative;align-self:center;flex:0 0 192px;height:28px}
.apm-search-icon{position:absolute;left:9px;top:50%;width:13px;height:13px;transform:translateY(-50%);pointer-events:none}
.apm-search{width:100%;height:100%;padding:0 9px 0 29px;border:1px solid #dfe6ef;border-radius:7px;background:#fff;color:#334155;font:11px "Plus Jakarta Sans",sans-serif;outline:none}
.apm-search::placeholder{color:#94a3b8;opacity:1}
.apm-search:focus{border-color:#b9d8d1;box-shadow:0 0 0 2px rgba(8,112,102,.08)}
.apm-content{padding:24px}
.apm-empty{min-height:174px;border:1px dashed #dbe4ef;border-radius:12px;background:#fcfdff;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;padding:20px;color:#334155}
.apm-empty-icon{width:40px;height:40px;border-radius:50%;background:#f0f3f8;color:#72839a;display:grid;place-items:center;margin-bottom:12px}
.apm-empty-icon svg{width:18px;height:18px}
.apm-empty-title{font-size:13px;font-weight:700;line-height:1.4;color:#172033}
.apm-empty-message{font-size:11.5px;line-height:1.5;color:#94a3b8;margin-top:3px}
.apm-list{border-top:1px solid #eef2f7}
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
  .mw{width:100%;min-width:0;height:100%}
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
  .mbt{display:grid;place-items:center;width:38px;height:38px;border-radius:10px;border:1px solid rgba(13,148,136,.24);background:#fff;color:#075e57;cursor:pointer;flex-shrink:0}
  .side{position:fixed!important;left:0;top:0;bottom:0;width:260px!important;max-width:86vw!important;height:100dvh!important;z-index:60;transform:translateX(-104%);transition:transform .25s ease;display:flex!important;background:#e8f8f6!important}
  body.nav-open .side{transform:none;box-shadow:0 0 50px rgba(0,0,0,.45)}
  .ov{display:none;position:fixed;inset:0;background:rgba(8,20,24,.55);z-index:58}
  body.nav-open .ov{display:block}body.nav-open{overflow:hidden}
  .tg{display:none!important}
  .side.col{width:260px!important;max-width:86vw!important}
  .side.col .side-brand-info{display:flex!important}
  .side.col .nav-group-title{display:block!important}
  .side.col .nav-txt{display:block!important}
  .side.col .nav{padding:10px 12px!important;justify-content:flex-start!important}
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
  .apm-toolbar{padding:0 12px;gap:0 10px;flex-wrap:wrap}
  .apm-tabs{flex:1 1 100%;gap:8px;overflow-x:auto}
  .apm-tab{min-height:48px;padding-right:5px;padding-left:5px;font-size:10.5px}
  .apm-search-wrap{flex:0 1 100%;max-width:none;margin:0 0 10px auto}
  .apm-content{padding:12px}
  .apm-empty{min-height:165px;padding:18px 12px}
  .apm-empty-message{max-width:290px}
  .tw{overflow-x:auto;-webkit-overflow-scrolling:touch;border-radius:10px;margin:8px 0}
  table{min-width:560px}
  th,td{padding:8px 6px;font-size:12px}
  .modal-backdrop{padding:10px;align-items:flex-end}
  .modal-card{max-height:92vh;border-radius:20px 20px 12px 12px}
  .modal-header{padding:12px 16px}
  .modal-body{padding:14px 16px;font-size:13px}
  .modal-footer{padding:12px 16px;flex-wrap:wrap;gap:8px}
  .modal-footer .btn{flex:1 1 auto;padding:10px 14px}
  .upl-workspace-layout{grid-template-columns:1fr!important;gap:14px!important}
  .upl-side-panel{position:static!important;width:100%!important;max-width:100%!important;padding:14px!important;border-radius:16px!important}
  .upl-hero-card{padding:16px 14px!important;border-radius:16px!important;gap:10px!important}
  .upl-hero-top{flex-direction:column!important;align-items:flex-start!important;gap:8px!important}
  .upl-hero-title{font-size:18px!important}
  .upl-pipeline-row{gap:5px!important;padding:4px 0!important}
  .upl-pipeline-step{padding:4px 10px!important;font-size:11px!important}
  .upl-pipeline-arrow{font-size:11px!important}
  .upl-template-row{flex-direction:column!important;align-items:stretch!important;gap:10px!important;padding:12px 14px!important}
  .upl-btn-unduh{width:100%!important;justify-content:center!important}
  .upl-card{padding:14px!important;border-radius:14px!important}
  .upl-grid{grid-template-columns:1fr!important;gap:12px!important}
  .upl-sub-bar{flex-direction:column!important;align-items:stretch!important;gap:10px!important}
  .upl-breadcrumb{flex-wrap:wrap!important;gap:6px!important}
  .upl-view-switch{width:100%!important;justify-content:center!important}
  .upl-search-input{width:100%!important;max-width:none!important}
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
  max-width: 100px;
  font-size: 11px;
  line-height: 1.25;
  color: #64748b;
  margin-top: 0;
  white-space: normal;
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
.main.dashboard-active .hero {
  margin-bottom: 16px;
  padding: 0;
  align-items: center;
}
.main.dashboard-active .hero p {
  color: #0f766e;
  font-size: 11px;
  font-weight: 600;
}
.main.dashboard-active .hero h1 {
  font-size: 20px;
  letter-spacing: -.3px;
}
.main.upload-active > .hero {
  display: none;
}
.dash-member-layout {
  display: grid;
  grid-template-columns: minmax(0, 2fr) minmax(320px, 1fr);
  gap: 20px;
  align-items: stretch;
}
.dash-member-left {
  display: flex;
  flex-direction: column;
  gap: 20px;
  min-width: 0;
}
.dash-member-kpis {
  display: grid;
  grid-template-columns: repeat(4, minmax(0, 1fr));
  gap: 16px;
}
.dash-member-kpi {
  display: flex;
  align-items: center;
  gap: 12px;
  min-width: 0;
  padding: 14px 16px;
  background: #fff;
  border: 1px solid #e2e8f0;
  border-radius: 18px;
  box-shadow: 0 2px 8px rgba(15, 23, 42, .025);
}
.dash-member-kpi-icon {
  width: 44px;
  height: 44px;
  border-radius: 13px;
  display: grid;
  place-items: center;
  flex: 0 0 44px;
}
.dash-member-kpi-copy {
  min-width: 0;
  display: flex;
  flex-direction: column;
}
.dash-member-kpi-label {
  color: #64748b;
  font-size: 11px;
  line-height: 1.3;
}
.dash-member-kpi-value {
  color: #0f172a;
  font-size: 24px;
  font-weight: 800;
  line-height: 1.15;
  margin-top: 2px;
}
.dash-member-kpi-sub {
  color: #94a3b8;
  font-size: 10px;
  line-height: 1.3;
  margin-top: 2px;
}
.dash-member-unit-grid {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: 12px;
}
.dash-member-unit-card {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 10px;
  min-width: 0;
  padding: 13px 14px;
  background: #f8fafc;
  border: 1px solid #eef2f6;
  border-radius: 14px;
}
.dash-member-unit-name {
  color: #1e293b;
  font-size: 12px;
  font-weight: 700;
  line-height: 1.35;
  overflow-wrap: anywhere;
}
.dash-member-unit-meta {
  color: #94a3b8;
  font-size: 10.5px;
  line-height: 1.35;
  margin-top: 3px;
}
.dash-member-unit-badge {
  flex: 0 0 auto;
  padding: 5px 8px;
  border-radius: 9px;
  background: #dcfce7;
  color: #047857;
  font-size: 11px;
  font-weight: 700;
  white-space: nowrap;
}
.dash-member-unit-badge.pending {
  background: #e2e8f0;
  color: #475569;
}
.dash-member-bottom {
  display: grid;
  grid-template-columns: minmax(250px, 5fr) minmax(0, 7fr);
  gap: 20px;
}
.dash-member-review-card,
.dash-member-progress-card {
  min-width: 0;
  min-height: 340px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
.dash-member-review-top,
.dash-member-progress-head {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 10px;
}
.dash-member-review-card {
  min-height: 360px;
  padding: 20px;
}
.dash-member-review-top .dash-card-title {
  font-size: 16px;
}
.dash-member-quality {
  padding: 3px 9px;
  border-radius: 7px;
  background: #ecfdf5;
  color: #047857;
  font-size: 10px;
  font-weight: 700;
  white-space: nowrap;
}
.dash-member-review-ring {
  position: relative;
  width: 174px;
  height: 174px;
  margin: 20px auto;
  flex: 0 0 auto;
  display: grid;
  place-items: center;
  border-radius: 50%;
  background: #f0fdfa;
}
.dash-member-review-ring svg {
  display: block;
  width: 148px;
  height: 148px;
  transform: rotate(-90deg);
}
.dash-member-review-center {
  position: absolute;
  inset: 0;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
}
.dash-member-review-percent {
  color: #0f172a;
  font-size: 30px;
  font-weight: 800;
  line-height: 1;
}
.dash-member-review-caption {
  color: #94a3b8;
  max-width: 96px;
  font-size: 10.5px;
  line-height: 1.25;
  margin-top: 6px;
  overflow-wrap: anywhere;
}
.dash-member-review-stats {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: 10px;
  text-align: center;
}
.dash-member-review-stat {
  padding: 10px 6px;
  border: 1px solid #f1f5f9;
  border-radius: 14px;
  background: #f8fafc;
}
.dash-member-review-stat:first-child {
  border-color: #d1fae5;
  background: #ecfdf5;
}
.dash-member-review-stat span {
  display: block;
  color: #64748b;
  font-size: 11px;
}
.dash-member-review-stat b {
  display: block;
  color: #0f172a;
  font-size: 16px;
  margin-top: 3px;
}
.dash-member-review-stat b.ok {
  color: #047857;
}
.dash-member-progress-head {
  margin-bottom: 16px;
}
.dash-member-queue-badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 4px 10px;
  border-radius: 999px;
  background: #f0fdfa;
  color: #0f766e;
  font-size: 10.5px;
  font-weight: 700;
  white-space: nowrap;
}
.dash-member-queue-badge i {
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: #14b8a6;
}
.dash-member-progress-list {
  display: flex;
  flex-direction: column;
  gap: 16px;
}
.dash-member-progress-row {
  min-width: 0;
}
.dash-member-progress-meta {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 8px;
  margin-bottom: 6px;
}
.dash-member-progress-name {
  min-width: 0;
  color: #1e293b;
  font-size: 11.5px;
  font-weight: 700;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
.dash-member-progress-unit {
  color: #94a3b8;
  font-size: 10.5px;
  font-weight: 400;
  margin-left: 4px;
}
.dash-member-progress-result {
  display: flex;
  align-items: center;
  gap: 8px;
  flex: 0 0 auto;
  color: #64748b;
  font-size: 10.5px;
  white-space: nowrap;
}
.dash-member-progress-result b {
  color: #0f172a;
}
.dash-member-progress-status {
  color: #059669;
  font-weight: 700;
}
.dash-member-progress-bar {
  height: 8px;
  border-radius: 999px;
  background: #f1f5f9;
  overflow: hidden;
}
.dash-member-progress-fill {
  height: 100%;
  border-radius: inherit;
  background: #10b981;
  transition: width .4s ease;
}
.dash-member-progress-footer {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 8px;
  margin-top: 18px;
  padding-top: 12px;
  border-top: 1px solid #f1f5f9;
  color: #94a3b8;
  font-size: 10.5px;
}
.dash-member-progress-footer button {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  padding: 0;
  background: none;
  border: 0;
  color: #0f766e;
  font: inherit;
  font-weight: 700;
  cursor: pointer;
}
.dash-member-activity {
  min-width: 0;
  min-height: 650px;
  display: flex;
  flex-direction: column;
  overflow: hidden;
  padding: 0;
}
.dash-member-tabs {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 8px;
  padding: 0 20px;
  border-bottom: 1px solid #f1f5f9;
}
.dash-member-tabs-list {
  display: flex;
  align-items: center;
  gap: 18px;
}
.dash-member-tab {
  padding: 14px 0 12px;
  border: 0;
  border-bottom: 2px solid transparent;
  background: none;
  color: #64748b;
  font: inherit;
  font-size: 11.5px;
  cursor: pointer;
}
.dash-member-tab.active {
  color: #0f766e;
  border-bottom-color: #0d9488;
  font-weight: 700;
}
.dash-member-data-status {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  padding-bottom: 12px;
  color: #059669;
  font-size: 10px;
  font-weight: 700;
  white-space: nowrap;
}
.dash-member-data-status i {
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: #34d399;
}
.dash-member-viewers {
  padding: 18px 20px;
  background: #f8fafc;
  border-bottom: 1px solid #f1f5f9;
}
.dash-member-overline {
  color: #94a3b8;
  font-size: 9.5px;
  font-weight: 800;
  letter-spacing: .06em;
  text-transform: uppercase;
}
.dash-member-viewers-title {
  color: #1e293b;
  font-size: 11.5px;
  font-weight: 700;
  margin: 3px 0 10px;
}
.dash-member-viewers-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 10px;
}
.dash-member-avatars {
  display: flex;
  align-items: center;
  padding-left: 2px;
}
.dash-member-avatar {
  width: 34px;
  height: 34px;
  margin-left: -5px;
  display: grid;
  place-items: center;
  border: 2px solid #fff;
  border-radius: 50%;
  color: #fff;
  font-size: 9px;
  font-weight: 800;
  flex: 0 0 34px;
}
.dash-member-avatar:first-child {
  margin-left: 0;
}
.dash-member-avatar.more {
  background: #475569;
  font-size: 10px;
}
.dash-member-viewers-count {
  color: #475569;
  font-size: 10px;
  font-weight: 600;
  text-align: right;
}
.dash-member-timeline-section {
  min-height: 0;
  display: flex;
  flex: 1;
  flex-direction: column;
  padding: 18px 20px 20px;
}
.dash-member-timeline-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 8px;
  margin-bottom: 14px;
}
.dash-member-timeline-count {
  color: #94a3b8;
  font-size: 10px;
}
.dash-member-timeline {
  position: relative;
  max-height: 350px;
  overflow-y: auto;
  padding-left: 18px;
}
.dash-member-timeline::before {
  content: "";
  position: absolute;
  top: 5px;
  bottom: 5px;
  left: 5px;
  width: 1px;
  background: #e2e8f0;
}
.dash-member-activity-item {
  position: relative;
  padding: 0 0 17px;
}
.dash-member-activity-item:last-child {
  padding-bottom: 0;
}
.dash-member-activity-dot {
  position: absolute;
  top: 2px;
  left: -18px;
  width: 12px;
  height: 12px;
  border: 2px solid #bae6fd;
  border-radius: 50%;
  background: #0ea5e9;
}
.dash-member-activity-dot.upload {
  border-color: #c7d2fe;
  background: #6366f1;
}
.dash-member-activity-dot.review {
  border-color: #a7f3d0;
  background: #10b981;
}
.dash-member-activity-userline {
  color: #0f172a;
  font-size: 10.5px;
  line-height: 1.4;
}
.dash-member-activity-userline b {
  font-weight: 700;
}
.dash-member-activity-userline span {
  color: #94a3b8;
  font-weight: 400;
}
.dash-member-activity-action {
  margin-top: 2px;
  color: #475569;
  font-size: 10.5px;
  line-height: 1.4;
  overflow-wrap: anywhere;
}
.dash-member-activity-target {
  display: inline-block;
  max-width: 100%;
  margin-top: 5px;
  padding: 3px 7px;
  overflow: hidden;
  border-radius: 5px;
  background: #f1f5f9;
  color: #475569;
  font-size: 9.5px;
  font-weight: 600;
  text-overflow: ellipsis;
  white-space: nowrap;
}
@media (max-width: 1100px) {
  .dash-member-layout {
    grid-template-columns: minmax(0, 1fr);
  }
  .dash-member-activity {
    min-height: 0;
  }
  .dash-member-timeline {
    max-height: 320px;
  }
}
@media (min-width: 1101px) and (max-width: 1350px) {
  .main.dashboard-active {
    padding: 14px;
  }
  .dash-member-layout {
    grid-template-columns: minmax(0, 1.9fr) minmax(270px, 1fr);
    gap: 14px;
  }
  .dash-member-left {
    gap: 14px;
  }
  .dash-member-kpis {
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 10px;
  }
  .dash-member-kpi {
    gap: 10px;
    padding: 11px 12px;
    border-radius: 14px;
  }
  .dash-member-kpi-icon {
    width: 40px;
    height: 40px;
    flex-basis: 40px;
    border-radius: 11px;
  }
  .dash-member-kpi-value {
    font-size: 21px;
  }
  .dash-member-bottom {
    gap: 14px;
  }
}
@media (max-width: 760px) {
  .dash-member-kpis {
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 10px;
  }
  .dash-member-unit-grid {
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }
  .dash-member-bottom {
    grid-template-columns: minmax(0, 1fr);
  }
  .dash-member-review-card,
  .dash-member-progress-card {
    min-height: 300px;
  }
}
@media (max-width: 480px) {
  .dash-member-kpis,
  .dash-member-unit-grid {
    grid-template-columns: minmax(0, 1fr);
  }
  .dash-member-kpi {
    padding: 12px 14px;
  }
  .dash-member-tabs {
    padding: 0 14px;
  }
  .dash-member-tabs-list {
    gap: 13px;
  }
  .dash-member-viewers,
  .dash-member-timeline-section {
    padding-right: 14px;
    padding-left: 14px;
  }
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
    flex: 0 0 auto;
    min-width: 0;
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

/* Modul Card Actions */
.mod-card-main-actions {
  display: flex;
  align-items: stretch;
  gap: 10px;
}
.mod-card-main-actions .mod-card-btn-primary {
  flex: 1 1 0;
  width: auto;
}
.mod-card-btn-outline {
  flex: 1;
  background: #ffffff;
  color: #334155;
  border: 1px solid #cbd5e1;
  border-radius: 9px;
  padding: 11px 12px;
  font-size: 13.5px;
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
  width: 100%;
  max-width: none;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 14px;
}
.app.mod-workspace-open .side {
  display: flex !important;
}
.app.mod-workspace-open .hero {
  display: none;
}
/* Navigasi Bilah Atas */
.mod-workspace-nav {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  flex-wrap: wrap;
  padding: 0;
}
.mod-workspace-crumb-link {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  padding: 0;
  border: 0;
  background: transparent;
  color: #475569;
  font: inherit;
  font-weight: 500;
  cursor: pointer;
}
.mod-workspace-crumb-link:hover {
  color: var(--pri);
}
.mod-workspace-period {
  display: flex;
  align-items: center;
}
.mod-workspace-period .dash-period-select {
  min-width: 205px;
  padding: 8px 34px 8px 12px;
  font-size: 12px;
}
.btn-back-catalog {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 7px 12px;
  font-size: 12.5px;
  font-weight: 600;
  color: var(--dk);
  background: var(--card);
  border: 1px solid var(--bd);
  border-radius: 10px;
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
  font-size: 12px;
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
  border-radius: 16px;
  padding: 20px 22px;
  display: flex;
  flex-direction: column;
  gap: 16px;
  box-shadow: 0 2px 8px rgba(15,23,42,.04);
}
.mod-hero-top-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 16px;
  flex-wrap: wrap;
}
.mod-hero-title {
  margin: 0;
  font-size: 23px;
  font-weight: 700;
  color: var(--dk);
  line-height: 1.35;
}
.mod-hero-title-row {
  display: flex;
  align-items: center;
  gap: 10px;
  flex-wrap: wrap;
  margin-bottom: 8px;
}
.mod-hero-code {
  padding: 2px 6px;
  border-radius: 5px;
  background: #f1f5f9;
  color: #64748b;
  font-family: ui-monospace, SFMono-Regular, Menlo, monospace;
  font-size: 11px;
  font-weight: 500;
}
.mod-hero-meta-grid {
  display: flex;
  align-items: center;
  gap: 18px;
  flex-wrap: wrap;
  background: transparent;
  border: 0;
  border-top: 1px solid var(--bd);
  border-radius: 0;
  padding: 12px 0 0;
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
  border-radius: 16px;
  padding: 18px 20px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 16px;
  flex-wrap: wrap;
  box-shadow: 0 2px 8px rgba(15,23,42,.04);
}
.mod-template-icon {
  width: 38px;
  height: 38px;
  display: grid;
  place-items: center;
  flex: 0 0 38px;
  border-radius: 12px;
  background: #fffbeb;
  color: #d97706;
}

/* Distribusi Tipe Tagihan */
.mod-overview-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.25fr) minmax(0, .9fr);
  gap: 14px;
  align-items: stretch;
}
.mod-stats-distribution {
  display: grid;
  grid-template-columns: minmax(0, 1.2fr) repeat(2, minmax(0, .7fr));
  align-items: center;
  gap: 0;
  padding: 14px 18px;
  border: 1px solid var(--bd);
  border-radius: 16px;
  background: var(--card);
  box-shadow: 0 2px 8px rgba(15,23,42,.04);
}
.mod-dist-card {
  background: var(--card);
  border: 0;
  border-radius: 0;
  padding: 4px 12px;
  display: flex;
  flex-direction: column;
  gap: 2px;
}
.mod-dist-card + .mod-dist-card {
  border-left: 1px solid #f1f5f9;
}
.mod-dist-label {
  font-size: 11.5px;
  color: var(--mut);
  font-weight: 600;
}
.mod-dist-card:not(:first-child) .mod-dist-label,
.mod-dist-card:not(:first-child) .mod-dist-val {
  text-align: center;
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
  padding: 16px 18px;
  border-bottom: 1px solid var(--bd);
}
.mod-items-card {
  overflow: hidden;
  background: var(--card);
  border: 1px solid var(--bd);
  border-radius: 16px;
  box-shadow: 0 2px 8px rgba(15,23,42,.04);
}
.mod-section-title {
  margin: 0;
  font-size: 16px;
  font-weight: 700;
  color: var(--dk);
}
.mod-clear-ind-btn {
  padding: 6px 8px;
  border: 0;
  background: transparent;
  color: var(--mut);
  font: inherit;
  font-size: 12px;
  font-weight: 500;
  cursor: pointer;
}
.mod-clear-ind-btn:hover {
  color: #e11d48;
}

/* Daftar Butir Tagihan */
.mod-ind-full-list {
  display: flex;
  flex-direction: column;
  gap: 0;
}
.mod-ind-full-item {
  background: var(--card);
  border: 0;
  border-bottom: 1px solid var(--bd);
  border-radius: 0;
  padding: 14px 18px;
  display: flex;
  align-items: center;
  gap: 14px;
  transition: background .15s ease;
}
.mod-ind-full-item:hover {
  background: #f8fafc;
}
.mod-ind-full-item:last-child {
  border-bottom: 0;
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
.mod-ind-mandatory-badge {
  padding: 4px 8px;
  border: 1px solid #e2e8f0;
  border-radius: 6px;
  color: #64748b;
  font-size: 11px;
  font-weight: 600;
  white-space: nowrap;
}
.mod-ind-mandatory-badge.is-mandatory {
  border-color: #fecaca;
  background: #fef2f2;
  color: #b91c1c;
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
@media (max-width: 800px) {
  .mod-overview-grid {
    grid-template-columns: 1fr;
  }
  .mod-ind-full-item {
    flex-wrap: wrap;
    align-items: flex-start;
  }
  .mod-ind-full-actions {
    width: 100%;
    margin-left: 42px;
  }
}
@media (max-width: 680px) {
  .mod-workspace {
    gap: 12px;
  }
  .mod-workspace-hero,
  .mod-template-card-full,
  .mod-studio-add-card {
    padding: 16px;
  }
  .mod-hero-top-row {
    align-items: flex-start;
    flex-direction: column;
  }
  .mod-hero-actions {
    width: 100%;
  }
  .mod-hero-actions .btn {
    flex: 1 1 auto;
  }
  .mod-hero-meta-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
  }
  .mod-hero-meta-item,
  .mod-hero-meta-label,
  .mod-hero-meta-value {
    display: block;
  }
  .mod-section-header {
    align-items: flex-start;
    padding: 14px;
  }
  .mod-section-header > div:last-child {
    width: 100%;
  }
  .mod-stats-distribution {
    padding: 12px 10px;
    grid-template-columns: minmax(0, 1fr) repeat(2, minmax(0, .7fr));
  }
  .mod-dist-card {
    padding: 4px 8px;
  }
  .mod-ind-full-item {
    padding: 13px 14px;
  }
  .mod-ind-full-actions {
    margin-left: 0;
  }
}

/* Detail Modul - keep the shared application shell */
.app.mod-workspace-open .side {
  display: flex !important;
}
.mod-workspace {
  width: 100%;
  max-width: none;
  margin: 0;
  gap: 24px;
  font-family: Inter, "Plus Jakarta Sans", system-ui, sans-serif;
}
.mod-workspace-nav {
  gap: 16px;
}
.mod-workspace-crumb {
  gap: 8px;
  color: #64748b;
  font-size: 12px;
}
.mod-workspace-crumb-link {
  gap: 5px;
  color: #475569;
  font-size: 12px;
}
.mod-workspace-period .dash-period-select {
  min-width: 0;
  padding: 6px 30px 6px 12px;
  border: 1px solid rgba(226,232,240,.9);
  border-radius: 9px;
  background-color: #fff;
  color: #334155;
  font-family: inherit;
  font-size: 12px;
  font-weight: 500;
}
.mod-workspace-hero {
  gap: 0;
  padding: 20px;
  border: 1px solid rgba(226,232,240,.9);
  border-radius: 16px;
  box-shadow: 0 2px 6px rgba(15,23,42,.025);
}
.mod-hero-top-row {
  align-items: center;
  flex-wrap: nowrap;
}
.mod-hero-title-row {
  gap: 10px;
  margin: 0 0 7px;
}
.mod-hero-title {
  font-size: 24px;
  line-height: 1.3;
  letter-spacing: -.025em;
  color: #0f172a;
}
.mod-ref-status {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 3px 9px;
  border-radius: 999px;
  font-size: 12px;
  font-weight: 600;
  white-space: nowrap;
}
.mod-ref-status::before {
  content: "";
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: currentColor;
}
.mod-ref-status.is-published {
  background: #ecfdf5;
  color: #047857;
}
.mod-ref-status.is-draft {
  background: #fffbeb;
  color: #b45309;
}
.mod-hero-meta-grid {
  gap: 10px;
  border: 0;
  padding: 0;
  font-size: 12px;
  color: #64748b;
}
.mod-hero-meta-item {
  align-items: center;
  gap: 5px;
  color: #64748b;
}
.mod-hero-meta-item > svg {
  flex: 0 0 auto;
  color: #94a3b8;
}
.mod-hero-meta-item > span {
  white-space: nowrap;
}
.mod-hero-meta-label {
  color: #64748b;
  font-size: 12px;
}
.mod-hero-meta-value {
  color: #334155;
  font-weight: 500;
}
.mod-hero-code {
  padding: 2px 6px;
  background: #f1f5f9;
  color: #64748b;
  font-family: "JetBrains Mono", ui-monospace, monospace;
  font-size: 11px;
}
.mod-hero-actions {
  gap: 8px;
  flex-wrap: nowrap;
}
.mod-ref-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
  min-height: 32px;
  padding: 6px 11px;
  border: 1px solid #e2e8f0;
  border-radius: 9px;
  background: #fff;
  color: #475569;
  font-family: inherit;
  font-size: 12px;
  font-weight: 500;
  white-space: nowrap;
  cursor: pointer;
  transition: background .15s, color .15s, border-color .15s;
}
.mod-ref-btn:hover {
  border-color: #cbd5e1;
  background: #f8fafc;
  color: #0f172a;
}
.mod-ref-btn-primary {
  border-color: #0d9488;
  background: #0d9488;
  color: #fff;
  font-weight: 600;
}
.mod-ref-btn-primary:hover {
  border-color: #0f766e;
  background: #0f766e;
  color: #fff;
}
.mod-ref-more-wrap {
  position: relative;
  display: block;
}
.mod-ref-more-wrap > summary {
  width: 32px;
  min-width: 32px;
  padding: 6px;
  color: #64748b;
  list-style: none;
}
.mod-ref-more-wrap > summary::-webkit-details-marker {
  display: none;
}
.mod-ref-more-menu {
  position: absolute;
  top: calc(100% + 6px);
  right: 0;
  z-index: 20;
  width: 160px;
  padding: 4px;
  border: 1px solid #e2e8f0;
  border-radius: 11px;
  background: #fff;
  box-shadow: 0 8px 20px rgba(15,23,42,.12);
}
.mod-ref-more-menu .btnQuickDeleteMod,
.mod-ref-more-menu .btnDeleteTemplate {
  display: flex;
  width: 100%;
  align-items: center;
  gap: 8px;
  padding: 8px 10px;
  border: 0;
  border-radius: 7px;
  background: transparent;
  color: #e11d48;
  font: inherit;
  font-size: 11px;
  text-align: left;
  cursor: pointer;
}
.mod-ref-more-menu .btnQuickDeleteMod:hover,
.mod-ref-more-menu .btnDeleteTemplate:hover {
  background: #fff1f2;
}
.mod-overview-grid {
  grid-template-columns: repeat(12, minmax(0, 1fr));
  gap: 16px;
}
.mod-hero-main {
  flex: 1;
  min-width: 0;
}
.mod-ref-separator {
  color: #cbd5e1;
  font-size: 11px;
}
.mod-template-card-full {
  grid-column: span 7;
  flex-wrap: nowrap;
  gap: 12px;
  padding: 16px;
  border: 1px solid rgba(226,232,240,.9);
  border-radius: 16px;
  box-shadow: 0 2px 6px rgba(15,23,42,.025);
}
.mod-template-icon {
  width: 36px;
  height: 36px;
  flex-basis: 36px;
  border-radius: 11px;
  background: #fffbeb;
  color: #d97706;
}
.mod-template-info {
  flex: 1;
  min-width: 0;
}
.mod-template-heading {
  display: flex;
  align-items: center;
  gap: 8px;
  min-width: 0;
  color: #0f172a;
  font-size: 12px;
  font-weight: 600;
}
.mod-template-status {
  flex: 0 0 auto;
  padding: 2px 7px;
  border-radius: 999px;
  background: #fffbeb;
  color: #b45309;
  font-size: 10px;
  font-weight: 500;
}
.mod-template-status.is-available {
  background: #ecfdf5;
  color: #047857;
}
.mod-template-desc {
  overflow: hidden;
  margin: 2px 0 0;
  color: #94a3b8;
  font-size: 11px;
  text-overflow: ellipsis;
  white-space: nowrap;
}
.mod-template-actions {
  display: flex;
  align-items: center;
  flex: 0 0 auto;
}
.mod-template-actions .mod-ref-btn-primary {
  border-color: #0f172a;
  background: #0f172a;
}
.mod-template-actions .mod-ref-btn-primary:hover {
  border-color: #1e293b;
  background: #1e293b;
}
.mod-template-heading + .mod-template-desc a {
  color: #64748b;
  text-decoration: none;
}
.mod-template-heading + .mod-template-desc a:hover {
  color: #0d9488;
  text-decoration: underline;
}
.mod-template-card-full > div:nth-child(2) {
  min-width: 0;
}
.mod-template-card-full > div:nth-child(2) > div:first-child {
  gap: 8px;
}
.mod-template-card-full > div:nth-child(2) b {
  font-size: 12px !important;
  color: #0f172a !important;
}
.mod-template-card-full > div:nth-child(2) > div:last-child {
  overflow: hidden;
  color: #94a3b8 !important;
  font-size: 11px !important;
  text-overflow: ellipsis;
  white-space: nowrap;
}
.mod-template-card-full > div:nth-child(2) > div:last-child a {
  color: #64748b;
  text-decoration: none;
}
.mod-template-card-full > div:nth-child(2) > div:last-child a:hover {
  color: #0d9488;
  text-decoration: underline;
}
.mod-template-card-full .tag {
  padding: 2px 7px;
  font-size: 10px !important;
}
.mod-template-card-full .tag::before {
  display: none;
}
.mod-template-card-full > div:last-child {
  gap: 6px !important;
}
.mod-template-card-full > div:last-child .btn {
  padding: 6px 10px !important;
  border-color: #0f172a;
  background: #0f172a;
  color: #fff;
  font-family: inherit;
  font-size: 11px !important;
  font-weight: 500;
  white-space: nowrap;
}
.mod-template-card-full > div:last-child .btn:hover {
  border-color: #1e293b;
  background: #1e293b;
}
.mod-stats-distribution {
  grid-column: span 5;
  display: flex;
  justify-content: space-between;
  gap: 12px;
  padding: 14px 16px;
  border: 1px solid rgba(226,232,240,.9);
  border-radius: 16px;
  box-shadow: 0 2px 6px rgba(15,23,42,.025);
}
.mod-dist-card {
  gap: 2px;
  padding: 0;
  background: transparent;
}
.mod-dist-card + .mod-dist-card {
  border: 0;
}
.mod-dist-summary {
  display: flex;
  align-items: center;
  gap: 14px;
}
.mod-ref-stat-divider {
  width: 1px;
  height: 24px;
  background: #f1f5f9;
}
.mod-dist-card:not(:first-child) .mod-dist-label,
.mod-dist-card:not(:first-child) .mod-dist-val {
  text-align: left;
}
.mod-dist-card:first-child .mod-dist-val {
  font-size: 18px;
}
.mod-dist-summary .mod-dist-card,
.mod-dist-summary .mod-dist-label,
.mod-dist-summary .mod-dist-val {
  text-align: right !important;
}
.mod-dist-summary .mod-dist-val {
  font-size: 14px;
}
.mod-dist-label {
  color: #94a3b8;
  font-size: 11px;
  font-weight: 500;
}
.mod-dist-val {
  color: #0f172a;
  font-size: 14px;
}
.mod-dist-val.mod-dist-required {
  color: #0d9488;
}
.mod-items-card {
  border: 1px solid rgba(226,232,240,.9);
  border-radius: 16px;
  box-shadow: 0 2px 6px rgba(15,23,42,.025);
}
.mod-section-header {
  gap: 16px;
  padding: 16px 20px;
  border-color: #f1f5f9;
}
.mod-section-title {
  color: #0f172a;
  font-size: 14px;
}
.mod-ref-count {
  margin-left: 4px;
  color: #94a3b8;
  font-weight: 400;
}
.mod-section-actions {
  display: flex;
  align-items: center;
  gap: 12px;
}
.mod-clear-ind-btn {
  display: inline-flex;
  align-items: center;
  padding: 5px 0;
  color: #94a3b8;
  font-family: inherit;
  font-size: 11px;
}
.mod-ind-full-item {
  gap: 14px;
  padding: 14px 20px;
  border-color: #f1f5f9;
}
.mod-ind-full-item:hover {
  background: rgba(248,250,252,.7);
}
.mod-ind-full-num {
  width: 24px;
  height: 24px;
  border: 0;
  border-radius: 6px;
  background: #f1f5f9;
  color: #64748b;
  font-size: 12px;
  font-weight: 500;
}
.mod-ind-full-body {
  gap: 2px;
}
.mod-ind-title-row {
  display: flex;
  align-items: center;
  gap: 8px;
  min-width: 0;
}
.mod-ind-full-text {
  color: #0f172a;
  font-size: 14px;
  font-weight: 600;
  line-height: 1.4;
}
.mod-ind-guide-box {
  margin: 0;
  padding: 0;
  border: 0;
  background: transparent;
  color: #94a3b8;
  font-size: 12px;
  line-height: 1.4;
}
.mod-ind-full-actions .btnDelInd {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  border-radius: 7px;
  background: transparent;
  color: #94a3b8;
  cursor: pointer;
}
.mod-ref-empty {
  padding: 48px 20px;
  color: #94a3b8;
  text-align: center;
}
.mod-ref-empty p {
  margin: 0;
  font-size: 12px;
}
.mod-ref-empty button {
  margin-top: 12px;
  padding: 0;
  border: 0;
  background: transparent;
  color: #0d9488;
  font-family: inherit;
  font-size: 12px;
  font-weight: 600;
  cursor: pointer;
}
.mod-ind-guide-box span {
  display: none;
}
.mod-ind-full-actions {
  gap: 6px;
}
.mod-ind-mandatory-badge {
  padding: 2px 7px;
  border: 0;
  border-radius: 999px;
  background: #f1f5f9;
  color: #64748b;
  font-size: 10px;
  font-weight: 500;
}
.mod-ind-mandatory-badge.is-mandatory {
  border: 0;
  background: #fff1f2;
  color: #e11d48;
}
.mod-ind-full-actions .mod-ref-item-edit {
  padding: 5px 9px;
  border: 0;
  background: transparent;
  color: #64748b;
  font-family: inherit;
  font-size: 11px;
  font-weight: 500;
  cursor: pointer;
}
.mod-ind-full-actions .mod-ref-item-edit:hover {
  background: #f0fdfa;
  color: #0f766e;
}
.mod-ind-full-actions .btnDelInd {
  padding: 5px;
  border: 0 !important;
  color: #94a3b8 !important;
}
.mod-ind-full-actions .btnDelInd:hover {
  background: #fff1f2;
  color: #e11d48 !important;
}
@media (max-width: 768px) {
  .mod-overview-grid {
    grid-template-columns: 1fr;
  }
  .mod-template-card-full,
  .mod-stats-distribution {
    grid-column: auto;
  }
  .mod-hero-top-row {
    flex-wrap: wrap;
  }
  .mod-hero-actions {
    flex-wrap: wrap;
  }
}
@media (max-width: 620px) {
  .mod-workspace {
    gap: 18px;
  }
  .mod-workspace-nav {
    align-items: flex-start;
  }
  .mod-workspace-crumb {
    gap: 5px;
  }
  .mod-workspace-period .dash-period-select {
    max-width: 138px;
  }
  .mod-hero-top-row {
    align-items: flex-start;
    flex-direction: column;
    gap: 14px;
  }
  .mod-hero-title {
    font-size: 20px;
  }
  .mod-hero-actions {
    width: 100%;
    flex-wrap: wrap;
  }
  .mod-template-card-full {
    flex-wrap: wrap;
  }
  .mod-template-card-full > div:last-child {
    width: 100%;
    margin-left: 48px;
  }
  .mod-template-actions {
    margin-left: 48px;
  }
  .mod-stats-distribution {
    gap: 8px;
    padding: 14px 12px;
  }
  .mod-section-header {
    align-items: flex-start;
    padding: 14px;
  }
  .mod-section-header > div:last-child {
    width: auto;
  }
  .mod-section-actions {
    gap: 8px;
  }
  .mod-ind-full-item {
    align-items: flex-start;
    flex-wrap: wrap;
    padding: 12px 14px;
  }
  .mod-ind-full-actions {
    width: calc(100% - 38px);
    margin-left: 38px;
  }
  .mod-ind-title-row {
    align-items: flex-start;
    flex-wrap: wrap;
  }
  .mod-dist-summary {
    gap: 8px;
  }
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
  gap: 4px;
  flex-wrap: wrap;
  background: #f1f5f9;
  padding: 3px;
  border-radius: 10px;
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
  background: #006a55;
  color: #ffffff;
  font-weight: 700;
  box-shadow: 0 2px 6px rgba(0,106,85,.2);
}

.upl-cat-right {
  display: flex;
  align-items: center;
  gap: 10px;
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

/* Workspace 2-Column Grid Layout */
.upl-workspace-layout {
  display: grid;
  grid-template-columns: minmax(0, 1fr) 320px;
  gap: 20px;
  align-items: start;
  width: 100%;
  max-width: 100%;
  box-sizing: border-box;
}
@media (max-width: 1200px) {
  .upl-workspace-layout {
    grid-template-columns: minmax(0, 1fr);
  }
  .upl-side-panel {
    position: static !important;
    width: 100% !important;
    max-width: 100% !important;
  }
}
.upl-main-col {
  display: flex;
  flex-direction: column;
  gap: 18px;
  min-width: 0;
  max-width: 100%;
  box-sizing: border-box;
}

/* Workflow Stepper Pipeline */
.upl-pipeline-row {
  display: flex;
  align-items: center;
  gap: 8px;
  flex-wrap: wrap;
  padding: 6px 0 2px;
}
.upl-pipeline-step {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 6px 14px;
  border-radius: 9999px;
  font-size: 12px;
  font-weight: 700;
  transition: all .2s ease;
  white-space: nowrap;
}
.upl-pipeline-step.done {
  background: #006a55;
  color: #ffffff;
  box-shadow: 0 2px 6px rgba(0,106,85,0.22);
}
.upl-pipeline-step.active {
  background: #fef08a;
  color: #713f12;
  border: 1px solid #facc15;
  box-shadow: 0 2px 6px rgba(234,179,8,0.18);
}
.upl-pipeline-step.pending {
  background: #ffffff;
  color: #64748b;
  border: 1px solid #cbd5e1;
}
.upl-pipeline-arrow {
  color: #94a3b8;
  display: inline-flex;
  align-items: center;
  font-size: 13px;
}

/* Right Activity & Active Users Panel */
.upl-side-panel {
  background: #ffffff;
  border: 1px solid #e2e8f0;
  border-radius: 20px;
  padding: 20px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.03);
  display: flex;
  flex-direction: column;
  gap: 20px;
  position: sticky;
  top: 80px;
}
.upl-side-tabs {
  display: flex;
  align-items: center;
  border-bottom: 2px solid #f1f5f9;
  gap: 20px;
  padding-bottom: 2px;
}
.upl-side-tab-btn {
  background: none;
  border: none;
  font: inherit;
  font-size: 13.5px;
  font-weight: 600;
  color: #64748b;
  padding: 6px 2px;
  cursor: pointer;
  position: relative;
  transition: color .15s ease;
}
.upl-side-tab-btn:hover {
  color: #006a55;
}
.upl-side-tab-btn.active {
  color: #006a55;
  font-weight: 700;
}
.upl-side-tab-btn.active::after {
  content: '';
  position: absolute;
  bottom: -4px;
  left: 0;
  right: 0;
  height: 2.5px;
  background: #006a55;
  border-radius: 9999px;
}

/* Section: Pengguna Aktif */
.upl-active-users-sec {
  display: flex;
  flex-direction: column;
  gap: 8px;
}
.upl-sec-subtitle {
  font-size: 10.5px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: .6px;
  color: #64748b;
}
.upl-sec-title {
  font-size: 15px;
  font-weight: 800;
  color: #0f172a;
  letter-spacing: -.2px;
}
.upl-avatar-stack {
  display: flex;
  align-items: center;
  margin-top: 4px;
}
.upl-avatar-circle {
  width: 34px;
  height: 34px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 11.5px;
  font-weight: 700;
  color: #ffffff;
  border: 2px solid #ffffff;
  margin-left: -7px;
  box-shadow: 0 1px 4px rgba(0,0,0,0.12);
  cursor: pointer;
  transition: transform .15s ease, z-index .15s ease;
  position: relative;
}
.upl-avatar-circle:first-child {
  margin-left: 0;
}
.upl-avatar-circle:hover {
  transform: translateY(-2px) scale(1.08);
  z-index: 5;
}
.upl-avatar-more-text {
  font-size: 12.5px;
  font-weight: 700;
  color: #1e293b;
  margin-top: 4px;
}

/* Section: Riwayat Aktivitas Timeline */
.upl-timeline-sec {
  display: flex;
  flex-direction: column;
  gap: 12px;
}
.upl-timeline-wrap {
  position: relative;
  padding-left: 18px;
  display: flex;
  flex-direction: column;
  gap: 14px;
}
.upl-timeline-wrap::before {
  content: '';
  position: absolute;
  left: 5px;
  top: 6px;
  bottom: 8px;
  width: 2px;
  background: #cbd5e1;
}
.upl-timeline-item {
  position: relative;
  font-size: 12.5px;
}
.upl-timeline-dot {
  position: absolute;
  left: -18px;
  top: 5px;
  width: 10px;
  height: 10px;
  border-radius: 50%;
  background: #10b981;
  border: 2px solid #ffffff;
  box-shadow: 0 0 0 1px #cbd5e1;
}
.upl-timeline-item.in-progress .upl-timeline-dot {
  background: #f59e0b;
}
.upl-timeline-head {
  font-size: 12px;
  font-weight: 700;
  color: #1e293b;
  line-height: 1.35;
}
.upl-timeline-desc {
  font-size: 12px;
  color: #475569;
  margin-top: 2px;
}
.upl-timeline-box-highlight {
  background: #fefce8;
  border: 1px solid #fde047;
  border-radius: 12px;
  padding: 10px 14px;
  margin-top: 4px;
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

/* Indicator Grid (Folder View) */
.upl-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 16px;
  width: 100%;
  max-width: 100%;
  min-width: 0;
  box-sizing: border-box;
}
@media (min-width: 1440px) {
  .upl-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); }
}
@media (max-width: 900px) {
  .upl-grid { grid-template-columns: minmax(0, 1fr); gap: 14px; }
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
  min-width: 0;
  max-width: 100%;
  box-sizing: border-box;
  overflow: hidden;
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
  min-width: 0;
  max-width: 100%;
  box-sizing: border-box;
}
.upl-empty-box {
  width: 100%;
  min-height: 68px;
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
  max-width: 100%;
  box-sizing: border-box;
  min-height: 68px;
  background: #f8fafc;
  border: 1px solid #e2e8f0;
  border-radius: 12px;
  padding: 10px 12px;
  display: flex;
  align-items: flex-start;
  gap: 10px;
  min-width: 0;
  overflow: hidden;
}
.upl-file-icon {
  flex-shrink: 0;
  margin-top: 2px;
}
.upl-file-meta {
  flex: 1;
  min-width: 0;
  max-width: 100%;
  display: flex;
  flex-direction: column;
  gap: 3px;
  overflow: hidden;
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
  max-width: 100%;
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
  overflow-wrap: anywhere;
  word-break: break-word;
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
  background: #006a55;
  color: #ffffff;
  font-weight: 700;
  box-shadow: 0 2px 6px rgba(0,106,85,.2);
}
.rev-current-view {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 10px;
  flex-wrap: wrap;
  background: #ffffff;
  border: 1px solid rgba(13,148,136,.18);
  border-left: 4px solid #006a55;
  border-radius: 10px;
  padding: 10px 14px;
  margin-bottom: 12px;
}
.rev-current-view-label {
  display: flex;
  align-items: center;
  gap: 8px;
  color: #64748b;
  font-size: 12px;
}
.rev-current-view-label b {
  color: #075e57;
  font-size: 13px;
}
.rev-current-view-count {
  background: #e6f4f1;
  color: #006a55;
  border-radius: 999px;
  padding: 4px 10px;
  font-size: 11.5px;
  font-weight: 700;
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
  vertical-align: top;
  overflow-wrap: anywhere;
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
  min-width: 0;
  flex: 1;
  max-width: 100%;
}
.rev-file-link span {
  display: block;
  min-width: 0;
  overflow-wrap: anywhere;
  white-space: normal;
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
  background: #0a8f83;
  color: #ffffff;
  border: 1px solid #0a8f83;
  border-radius: 8px;
  padding: 6px 11px;
  font: inherit;
  font-size: 12px;
  font-weight: 700;
  cursor: pointer;
  transition: all .15s ease;
}
.rev-btn-quick-ok:hover {
  background: #08786f;
  border-color: #08786f;
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


/* --- FULLPAGE EVIDEN & DOCUMENT VIEWER STYLES --- */
.fpv-overlay {
  position: fixed;
  inset: 0;
  width: 100vw;
  height: 100vh;
  height: 100dvh;
  background: #0f172a;
  z-index: 1050;
  display: flex;
  flex-direction: column;
  overflow: hidden;
  font-family: "Plus Jakarta Sans", system-ui, -apple-system, sans-serif;
  color: #1e293b;
}
.fpv-topbar {
  height: 56px;
  background: #006a55;
  color: #ffffff;
  padding: 0 16px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  flex-shrink: 0;
  box-shadow: 0 2px 10px rgba(0,0,0,0.18);
  z-index: 20;
}
.fpv-topbar-left {
  display: flex;
  align-items: center;
  gap: 12px;
  min-width: 0;
  flex: 1;
}
.fpv-btn-back {
  background: rgba(255,255,255,0.15);
  color: #ffffff;
  border: 1px solid rgba(255,255,255,0.25);
  border-radius: 8px;
  padding: 6px 12px;
  font: inherit;
  font-size: 12.5px;
  font-weight: 700;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  transition: all .15s ease;
  white-space: nowrap;
}
.fpv-btn-back:hover {
  background: rgba(255,255,255,0.28);
  transform: translateY(-1px);
}
.fpv-file-info {
  display: flex;
  align-items: center;
  gap: 10px;
  min-width: 0;
  flex-wrap: wrap;
}
.fpv-file-name {
  font-size: 13.5px;
  font-weight: 700;
  color: #ffffff;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 340px;
}
.fpv-pill {
  background: rgba(255,255,255,0.16);
  color: #e2e8f0;
  padding: 2.5px 8px;
  border-radius: 6px;
  font-size: 11px;
  font-weight: 600;
  white-space: nowrap;
}
.fpv-badge-status {
  padding: 3px 10px;
  border-radius: 6px;
  font-size: 11px;
  font-weight: 700;
  white-space: nowrap;
}
.fpv-topbar-right {
  display: flex;
  align-items: center;
  gap: 8px;
  flex-shrink: 0;
}
.fpv-btn-action {
  background: rgba(255,255,255,0.14);
  color: #ffffff;
  border: 1px solid rgba(255,255,255,0.22);
  border-radius: 8px;
  padding: 6px 11px;
  font: inherit;
  font-size: 12px;
  font-weight: 600;
  text-decoration: none;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  transition: all .15s ease;
}
.fpv-btn-action:hover {
  background: rgba(255,255,255,0.25);
  color: #ffffff;
}
.fpv-btn-cta {
  background: #ffffff;
  color: #006a55;
  border: 0;
  border-radius: 8px;
  padding: 6px 14px;
  font: inherit;
  font-size: 12px;
  font-weight: 700;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.16);
  transition: all .15s ease;
}
.fpv-btn-cta:hover {
  background: #f0fdf4;
  transform: translateY(-1px);
}
.fpv-btn-toggle-sidebar {
  background: rgba(255,255,255,0.12);
  color: #ffffff;
  border: 1px solid rgba(255,255,255,0.2);
  border-radius: 8px;
  padding: 6px 10px;
  font: inherit;
  font-size: 12px;
  font-weight: 600;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 5px;
  transition: all .15s ease;
}
.fpv-btn-toggle-sidebar:hover {
  background: rgba(255,255,255,0.22);
}
.fpv-workspace {
  display: flex;
  flex: 1;
  min-height: 0;
  width: 100%;
  position: relative;
  overflow: hidden;
}
.fpv-canvas {
  flex: 1;
  min-width: 0;
  height: 100%;
  display: flex;
  flex-direction: column;
  background: #1e293b;
  position: relative;
  transition: all .2s ease;
}
.fpv-canvas-toolbar {
  height: 38px;
  background: #0f172a;
  border-bottom: 1px solid #334155;
  padding: 0 14px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-shrink: 0;
  color: #94a3b8;
  font-size: 12px;
}
.fpv-toolbar-left {
  display: flex;
  align-items: center;
  gap: 8px;
  overflow-x: auto;
  max-width: 80%;
}
.fpv-format-badge {
  background: #334155;
  color: #38bdf8;
  font-weight: 700;
  padding: 2px 7px;
  border-radius: 4px;
  font-size: 10.5px;
  letter-spacing: .5px;
}
.fpv-sheet-tabs-container {
  display: flex;
  align-items: center;
  gap: 4px;
}
.fpv-sheet-tab {
  background: #1e293b;
  color: #cbd5e1;
  border: 1px solid #334155;
  border-radius: 4px;
  padding: 3px 10px;
  font-size: 11.5px;
  font-weight: 600;
  cursor: pointer;
  white-space: nowrap;
  transition: all .15s ease;
}
.fpv-sheet-tab:hover {
  background: #334155;
  color: #fff;
}
.fpv-sheet-tab.active {
  background: #107c41;
  border-color: #107c41;
  color: #ffffff;
  font-weight: 700;
}
.fpv-canvas-body {
  flex: 1;
  min-height: 0;
  position: relative;
  overflow: auto;
  background: #1e293b;
}
.fpv-sidebar {
  width: 340px;
  height: 100%;
  background: #f8fafc;
  border-left: 1px solid #cbd5e1;
  display: flex;
  flex-direction: column;
  gap: 12px;
  padding: 14px;
  overflow-y: auto;
  flex-shrink: 0;
  transition: all .25s ease;
  box-shadow: -2px 0 10px rgba(0,0,0,0.04);
}
.fpv-workspace.sidebar-hidden .fpv-sidebar {
  display: none !important;
}
.fpv-card {
  background: #ffffff;
  border: 1px solid #e2e8f0;
  border-radius: 12px;
  padding: 12px 14px;
  box-shadow: 0 1px 3px rgba(15,23,42,0.03);
}
.fpv-card-title {
  font-size: 11px;
  font-weight: 800;
  color: #006a55;
  text-transform: uppercase;
  letter-spacing: .5px;
  margin-bottom: 8px;
}
.fpv-card-title-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 8px;
}
.fpv-meta-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 8px;
}
.fpv-meta-item {
  background: #f8fafc;
  border: 1px solid #f1f5f9;
  border-radius: 8px;
  padding: 6px 8px;
}
.fpv-meta-label {
  font-size: 10px;
  font-weight: 700;
  color: #64748b;
  text-transform: uppercase;
  display: block;
}
.fpv-meta-value {
  font-size: 12px;
  font-weight: 700;
  color: #0f172a;
  word-break: break-word;
  margin-top: 1px;
}
.fpv-ind-list {
  display: flex;
  flex-direction: column;
  gap: 6px;
  max-height: 220px;
  overflow-y: auto;
  padding-right: 2px;
}
.fpv-ind-item {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 8px;
  padding: 8px 10px;
  border-radius: 8px;
  border: 1px solid #e2e8f0;
  background: #f8fafc;
  cursor: pointer;
  transition: all .15s ease;
}
.fpv-ind-item:hover {
  background: #f1f5f9;
  border-color: #cbd5e1;
}
.fpv-ind-item.active {
  background: #f0fdfa;
  border-color: #006a55;
}
/* DOCX CONTAINER SPECIFIC */
.fpv-docx-wrapper {
  padding: 24px 16px;
  background: #475569;
  min-height: 100%;
  display: flex;
  justify-content: center;
  overflow-y: auto;
}
.fpv-docx-wrapper .docx-viewer {
  background: #ffffff;
  box-shadow: 0 8px 30px rgba(0,0,0,0.3);
  padding: 36px 42px;
  min-height: 800px;
  max-width: 860px;
  width: 100%;
  border-radius: 4px;
  color: #0f172a;
  font-family: Calibri, 'Segoe UI', Arial, sans-serif;
  line-height: 1.5;
}
.docx-wrapper {
  background: transparent !important;
  padding: 24px 16px !important;
  display: flex !important;
  flex-direction: column !important;
  align-items: center !important;
}
.docx-wrapper > section.docx {
  background: white !important;
  box-shadow: 0 8px 30px rgba(0,0,0,0.3) !important;
  margin-bottom: 24px !important;
  border-radius: 4px !important;
  color: #1e293b !important;
}
/* EXCEL TABLE SPECIFIC */
.fpv-excel-scroll {
  width: 100%;
  height: 100%;
  overflow: auto;
  background: #ffffff;
}
.fpv-excel-scroll table {
  border-collapse: collapse;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
  font-size: 12.5px;
  min-width: 100%;
}
.fpv-excel-scroll th,
.fpv-excel-scroll td {
  border: 1px solid #cbd5e1;
  padding: 6px 12px;
  white-space: nowrap;
}
.fpv-excel-scroll tr:first-child td,
.fpv-excel-scroll tr:first-child th {
  background: #f1f5f9;
  font-weight: 700;
  color: #0f172a;
  position: sticky;
  top: 0;
  z-index: 2;
  border-bottom: 2px solid #94a3b8;
}
.fpv-excel-scroll tr:hover td {
  background: #e0f2fe;
}
.fpv-edit-bar {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  background: #1e293b;
  padding: 2px 6px;
  border-radius: 6px;
  border: 1px solid #334155;
}
.fpv-btn-fmt {
  background: transparent;
  color: #e2e8f0;
  border: 0;
  border-radius: 4px;
  padding: 3px 7px;
  font-size: 11px;
  font-weight: 700;
  cursor: pointer;
  transition: all .15s ease;
  line-height: 1;
}
.fpv-btn-fmt:hover {
  background: #334155;
  color: #fff;
}
.fpv-btn-save-doc {
  background: #16a34a;
  color: #ffffff;
  border: 0;
  border-radius: 6px;
  padding: 4px 12px;
  font-size: 11.5px;
  font-weight: 700;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 5px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.2);
  transition: all .15s ease;
}
.fpv-btn-save-doc:hover {
  background: #15803d;
  transform: translateY(-1px);
}
.fpv-btn-grid-tool {
  background: #334155;
  color: #e2e8f0;
  border: 1px solid #475569;
  border-radius: 6px;
  padding: 3px 8px;
  font-size: 11px;
  font-weight: 600;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 4px;
  transition: all .15s ease;
}
.fpv-btn-grid-tool:hover {
  background: #475569;
  color: #fff;
}

/* Keep the application frame fixed while each screen adapts to its content. */
#appView {
  position: fixed;
  inset: 0;
  width: 100%;
  height: 100vh;
  height: 100dvh;
  overflow: hidden;
}
.app {
  width: 100%;
  min-width: 0;
}
.side {
  flex: 0 0 260px;
  max-height: 100vh;
  max-height: 100dvh;
}
.side.col {
  flex-basis: 72px;
}
.mw {
  flex: 1 1 0;
  width: 0;
  min-width: 0;
}
.hd {
  flex: 0 0 auto;
  min-width: 0;
}
.main {
  flex: 1 1 auto;
  width: 100%;
  min-width: 0;
  min-height: 0;
  padding: clamp(12px, 1.5vw, 24px);
  overflow-y: auto;
  overscroll-behavior: contain;
}
.scr,
.scr > div {
  min-width: 0;
  max-width: 100%;
}
.grid > *,
.split > * {
  min-width: 0;
}
.tw {
  max-width: 100%;
  overflow-x: auto;
  overscroll-behavior-x: contain;
  -webkit-overflow-scrolling: touch;
}
img,
video,
iframe,
canvas {
  max-width: 100%;
}
input,
select,
textarea {
  max-width: 100%;
}
#audC .audit-table th:first-child,
#audC .audit-table td:first-child {
  width: 155px;
  white-space: nowrap;
}
#audC .audit-table {
  min-width: 980px;
  table-layout: fixed;
}
#audC .audit-table th,
#audC .audit-table td {
  padding: 12px;
  line-height: 1.45;
  vertical-align: top;
}
#audC .audit-table th:nth-child(2),
#audC .audit-table td:nth-child(2) {
  width: 170px;
}
#audC .audit-table th:nth-child(3),
#audC .audit-table td:nth-child(3) {
  width: 145px;
}
#audC .audit-table th:nth-child(4),
#audC .audit-table td:nth-child(4) {
  width: 220px;
}
#audC .audit-target-cell {
  white-space: normal;
  overflow-wrap: anywhere;
  line-height: 1.5;
}
#audC .audit-time {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  gap: 2px;
  line-height: 1.3;
}
#audC .audit-time small {
  color: var(--mut);
  font-size: 11px;
}

@media (min-width: 769px) and (max-width: 1024px) {
  .side:not(.col) {
    width: 232px;
    flex-basis: 232px;
  }
  .hd {
    padding-right: 16px;
    padding-left: 16px;
  }
  .main {
    padding: 16px;
  }
  .dash-member-kpis,
  .dash-member-unit-grid {
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 10px;
  }
  .dash-member-bottom {
    grid-template-columns: minmax(0, 1fr);
  }
  .rev-tabs {
    min-width: 0;
    max-width: 100%;
    overflow-x: auto;
    overscroll-behavior-x: contain;
    scrollbar-width: thin;
    -webkit-overflow-scrolling: touch;
  }
  .rev-tab-btn {
    flex: 0 0 auto;
  }
}

@media (max-width: 768px) {
  .mw {
    width: 100%;
    min-height: 0;
  }
  .main {
    padding: 12px 10px;
  }
  .rev-toolbar,
  .rev-filter-group {
    width: 100%;
    min-width: 0;
  }
  .rev-tabs {
    flex: 1 1 100%;
    width: 100%;
    min-width: 0;
    max-width: 100%;
    overflow-x: auto;
    overscroll-behavior-x: contain;
    scrollbar-width: thin;
    -webkit-overflow-scrolling: touch;
  }
  .rev-tab-btn {
    flex: 0 0 auto;
  }
  .rev-search-box {
    flex: 1 1 100%;
    width: 100%;
    min-width: 0;
    max-width: none;
  }
  .rev-filter-group > * {
    min-width: 0;
    max-width: 100%;
  }
  .rev-select {
    flex: 1 1 140px;
  }
  .rev-btn-bulk {
    white-space: normal;
    text-align: center;
  }
  .rev-current-view-label {
    min-width: 0;
    flex-wrap: wrap;
  }
}
</style>
<script src="https://cdn.jsdelivr.net/npm/jszip@3.10.1/dist/jszip.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/docx-preview@0.3.1/dist/docx-preview.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/html-docx-js@0.3.1/dist/html-docx.js"></script>
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
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

<!-- FULLPAGE DOKUMEN EVIDEN & STATUS VIEWER -->
<div id="fullpageEvidenViewer" class="fpv-overlay" style="display:none;" role="dialog" aria-modal="true">
  <header class="fpv-topbar">
    <div class="fpv-topbar-left">
      <button type="button" class="fpv-btn-back" id="fpvBtnClose" title="Kembali / Tutup (Esc)">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
        <span>Tutup</span>
      </button>
      <div class="fpv-file-info">
        <div class="fpv-file-name" id="fpvFileName">Nama_Dokumen.pdf</div>
        <div class="fpv-file-tags" style="display:flex;align-items:center;gap:6px">
          <span class="fpv-pill" id="fpvPillModul">Modul: -</span>
          <span class="fpv-pill" id="fpvPillVersi">v1</span>
          <span class="fpv-badge-status" id="fpvBadgeStatus">-</span>
        </div>
      </div>
    </div>
    <div class="fpv-topbar-right">
      <div id="fpvCustomActionSlot" style="display:inline-flex;align-items:center;gap:6px"></div>
      <button type="button" class="fpv-btn-toggle-sidebar" id="fpvBtnToggleSidebar" title="Tampilkan / Sembunyikan Panel Samping">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="15" y1="3" x2="15" y2="21"/></svg>
        <span>Panel</span>
      </button>
    </div>
  </header>

  <div class="fpv-workspace" id="fpvWorkspace">
    <!-- LEFT: VIEWER CANVAS -->
    <div class="fpv-canvas" id="fpvCanvas">
      <div class="fpv-canvas-toolbar" id="fpvCanvasToolbar">
        <div class="fpv-toolbar-left" id="fpvToolbarLeft">
          <span class="fpv-format-badge" id="fpvFormatBadge">PDF</span>
          <div class="fpv-sheet-tabs-container" id="fpvSheetTabs"></div>
        </div>
        <div class="fpv-toolbar-right" id="fpvToolbarRight">
          <span id="fpvViewerHint" style="font-size:11.5px;color:#94a3b8"></span>
        </div>
      </div>
      <div class="fpv-canvas-body" id="fpvCanvasBody">
        <!-- Render viewer (PDF/DOCX/XLSX/Image/Link) -->
      </div>
    </div>

    <!-- RIGHT: CLEAN INFO & STATUS SIDEBAR -->
    <aside class="fpv-sidebar" id="fpvSidebar">
      <!-- Section 1: Ringkasan Status -->
      <div class="fpv-card" id="fpvCardStatus">
        <div class="fpv-card-title">Status Kepatuhan</div>
        <div id="fpvStatusContent"></div>
      </div>

      <!-- Section 2: Informasi Dokumen Ringkas -->
      <div class="fpv-card">
        <div class="fpv-card-title">Informasi Dokumen</div>
        <div class="fpv-meta-grid" id="fpvMetaGrid"></div>
      </div>

      <!-- Section 3: Data Isian PIC (Bila Ada) -->
      <div class="fpv-card" id="fpvCardStructured" style="display:none">
        <div class="fpv-card-title">Data Isian PIC</div>
        <div id="fpvStructuredBody"></div>
      </div>

      <!-- Section 4: Navigasi Indikator Modul -->
      <div class="fpv-card">
        <div class="fpv-card-title-row">
          <span class="fpv-card-title">Indikator Modul Ini</span>
          <span class="fpv-counter" id="fpvIndCounter" style="font-size:11.5px;font-weight:700;color:#006a55">0/0</span>
        </div>
        <div class="fpv-ind-list" id="fpvIndList"></div>
      </div>
    </aside>
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
      <button class="tg" id="sbt" aria-label="Toggle Menu" title="Kecilkan / Perlebar Menu"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="m15 18-6-6 6-6"/></svg></button>
      
      <div class="side-header">
        <div class="brand-logo-card" title="Kementerian Kesehatan RI">
          <img src="assets/images/logo-kemenkes.webp" alt="Kemenkes" class="brand-logo-img" onerror="this.style.display='none';this.nextElementSibling.style.display='block';">
          <svg class="brand-logo-fallback" style="display:none;" width="26" height="26" viewBox="0 0 24 24" fill="none"><path d="M12 4v16m-8-8h16" stroke="#007a64" stroke-width="4.2" stroke-linecap="round"/><circle cx="12" cy="12" r="2.2" fill="#00a884"/></svg>
        </div>
        <div class="side-brand-info">
          <strong>Kemenkes</strong>
          <span>BBPK Jakarta</span>
        </div>
        <button class="modal-close mobile-drawer-close" id="mdc" aria-label="Tutup Menu" style="margin-left:auto;display:none;font-size:22px;background:none;border:none;cursor:pointer;color:#526b66">&times;</button>
      </div>

      <div class="side-nav-body">
        <!-- UTAMA -->
        <div class="nav-group" data-nav-group="utama">
          <div class="nav-group-title">Utama</div>
          <button class="nav on" data-s="dash" title="Dashboard">
            <span class="nav-icon">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
            </span>
            <span class="nav-txt">Dashboard</span>
          </button>
        </div>

        <!-- PENGAWASAN -->
        <div class="nav-group" data-nav-group="pengawasan">
          <div class="nav-group-title">Pengawasan</div>
          <button class="nav" data-s="mod" title="Master Modul &amp; Template" style="display:none">
            <span class="nav-icon">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></svg>
            </span>
            <span class="nav-txt">Master Modul &amp; Template</span>
          </button>
          <button class="nav" data-s="upl" title="Upload Eviden" style="display:none">
            <span class="nav-icon">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
            </span>
            <span class="nav-txt">Upload Eviden</span>
          </button>
          <button class="nav" data-s="mon" title="Monitoring Upload" style="display:none">
            <span class="nav-icon">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
            </span>
            <span class="nav-txt">Monitoring Upload</span>
          </button>
          <button class="nav" data-s="rep" title="Repositori Eviden" style="display:none">
            <span class="nav-icon">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
            </span>
            <span class="nav-txt">Repositori Eviden</span>
          </button>
        </div>

        <!-- VERIFIKASI -->
        <div class="nav-group" data-nav-group="verifikasi">
          <div class="nav-group-title">Verifikasi</div>
          <button class="nav" data-s="rev" title="Review &amp; Cross-check" style="display:none">
            <span class="nav-icon">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
            </span>
            <span class="nav-txt">Review &amp; Cross-check</span>
          </button>
          <button class="nav" data-s="apm" title="Approval Pimpinan" style="display:none">
            <span class="nav-icon">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>
            </span>
            <span class="nav-txt">Approval Pimpinan</span>
            <span class="nav-badge" id="bdg" hidden>0</span>
          </button>
        </div>

        <!-- PELAPORAN -->
        <div class="nav-group" data-nav-group="pelaporan">
          <div class="nav-group-title">Pelaporan</div>
          <button class="nav" data-s="exp" title="Ekspor Laporan" style="display:none">
            <span class="nav-icon">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
            </span>
            <span class="nav-txt">Ekspor Laporan</span>
          </button>
        </div>

        <!-- SISTEM -->
        <div class="nav-group" data-nav-group="sistem">
          <div class="nav-group-title">Sistem</div>
          <button class="nav" data-s="aud" title="Audit Trail" style="display:none">
            <span class="nav-icon">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
            </span>
            <span class="nav-txt">Audit Trail</span>
          </button>
          <button class="nav" data-s="usr" title="Pengguna &amp; Peran" style="display:none">
            <span class="nav-icon">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            </span>
            <span class="nav-txt">Pengguna &amp; Peran</span>
          </button>
          <button class="nav" data-s="hak" title="Hak Akses" style="display:none">
            <span class="nav-icon">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            </span>
            <span class="nav-txt">Hak Akses</span>
          </button>
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
        <section class="scr" id="upl"><div id="uplC"></div><input type="file" id="fin" hidden accept=".pdf,.xlsx,.xls,.docx,.doc"></section>
        <section class="scr" id="mon"><div class="card" id="monC"></div></section>
        <section class="scr" id="rep"><div class="card" id="repC"></div></section>
        <section class="scr" id="rev"><div id="revC"></div></section>
        <section class="scr" id="apr"><div id="aprC"></div></section>
        <section class="scr" id="apm"><div id="apmL"></div></section>
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
  var moduleSettingsHandler = null;
  var moduleStatusHandler = null;
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
  var uplActivityTab = 'all'; // 'all' | 'upload' | 'activity'
  var dashActivityTab = 'all';
  var uplRealtimeTimer = null;
  var uplLoggedViews = {};

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
    a: ["Menunggu Approval Pimpinan", "t-pk", 60],
    p: ["Disetujui Pimpinan (Siap Selesai)", "t-ok", 85],
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

  var fpvPreviewObjectUrl = null;

  function closeFullpageViewer() {
    var fpv = document.getElementById("fullpageEvidenViewer");
    if (fpv) {
      fpv.style.display = "none";
      var bodyEl = document.getElementById("fpvCanvasBody");
      if (bodyEl) bodyEl.innerHTML = '';
      var tabsEl = document.getElementById("fpvSheetTabs");
      if (tabsEl) tabsEl.innerHTML = '';
    }
    if (fpvPreviewObjectUrl) {
      URL.revokeObjectURL(fpvPreviewObjectUrl);
      fpvPreviewObjectUrl = null;
    }
  }
  var fpvBtnClose = document.getElementById("fpvBtnClose");
  if (fpvBtnClose) fpvBtnClose.onclick = closeFullpageViewer;
  var fpvBtnToggleSidebar = document.getElementById("fpvBtnToggleSidebar");
  if (fpvBtnToggleSidebar) fpvBtnToggleSidebar.onclick = function(){
    var ws = document.getElementById("fpvWorkspace");
    if (ws) ws.classList.toggle("sidebar-hidden");
  };

  document.getElementById("modalClose").onclick = closeModal;
  document.getElementById("modalContainer").onclick = function(e){
    if (e.target === this) closeModal();
  };
  document.addEventListener("keydown", function(e){
    if (e.key === "Escape") {
      var fpv = document.getElementById("fullpageEvidenViewer");
      if (fpv && fpv.style.display !== "none") closeFullpageViewer();
      else closeModal();
    }
  });

  function escapeAttr(s) {
    if (s === null || s === undefined) return '';
    return String(s).replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/'/g, '&#39;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
  }

  function escapeHtml(s) {
    if (s === null || s === undefined) return '';
    return String(s).replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/'/g, '&#39;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
  }

  function openEvidencePreview(e, requestedFormat) {
    if (!e || !e.path_file || e.path_file === '#') {
      toast("Berkas eviden tidak tersedia untuk dipratinjau.");
      return;
    }

    var isTemplate = !!e.is_template;
    var fileName = e.nama_file || (isTemplate ? "Format Acuan SKI" : "Berkas Eviden");
    var filePath = e.path_file;
    var fileExt = (fileName.match(/\.([a-z0-9]+)$/i) || filePath.match(/\.([a-z0-9]+)(?:[?#].*)?$/i) || [])[1] || "";
    var storedFormat = String(e.format_file || "").toLowerCase();
    var cloudFormat = ["link", "gdrive", "onedrive", "dropbox"].indexOf(storedFormat) !== -1 || isEvidenUrl(filePath);
    var sourceFormat = (["link", "gdrive", "onedrive", "dropbox"].indexOf(storedFormat) === -1 ? storedFormat : fileExt).toLowerCase();
    if (!/^(pdf|docx|doc|xlsx|xls|csv|pptx|ppt|jpg|jpeg|png|gif|webp|svg)$/.test(sourceFormat)) {
      sourceFormat = fileExt.toLowerCase();
    }

    var format = String(requestedFormat || sourceFormat || "cloud").toLowerCase();
    if (format === "original") format = sourceFormat || "cloud";
    var requestExport = !!requestedFormat && requestedFormat !== "original" &&
      (cloudFormat || format !== sourceFormat);
    if (sourceFormat === "doc" && format === "docx") format = "pdf";
    if (format === "doc" && !requestedFormat) {
      format = "pdf";
      requestExport = true;
    }

    var previewUrl = filePath;
    if (requestExport) {
      previewUrl = "ajax.php?action=download_eviden&id_eviden=" +
        encodeURIComponent(e.id_eviden) + "&format=" + encodeURIComponent(format);
    }

    var fpv = document.getElementById("fullpageEvidenViewer");
    var fileNameEl = document.getElementById("fpvFileName");
    var moduleEl = document.getElementById("fpvPillModul");
    var versionEl = document.getElementById("fpvPillVersi");
    var statusEl = document.getElementById("fpvBadgeStatus");
    var formatEl = document.getElementById("fpvFormatBadge");
    var hintEl = document.getElementById("fpvViewerHint");
    var canvasBody = document.getElementById("fpvCanvasBody");
    var tabsEl = document.getElementById("fpvSheetTabs");
    if (!fpv || !canvasBody || !formatEl || !hintEl) return;

    if (fpvPreviewObjectUrl) {
      URL.revokeObjectURL(fpvPreviewObjectUrl);
      fpvPreviewObjectUrl = null;
    }
    document.getElementById("fpvCustomActionSlot").innerHTML = "";
    fileNameEl.textContent = fileName;
    moduleEl.textContent = "Modul: " + (e.nama_modul || "-");
    versionEl.textContent = isTemplate ? "Acuan" : "v" + (e.versi || 1);
    statusEl.textContent = isTemplate ? "Format Acuan SKI" : ((SS[e.status_eviden] && SS[e.status_eviden][0]) || "Eviden");
    formatEl.textContent = format.toUpperCase();
    hintEl.textContent = isTemplate ? "Pratinjau format acuan hanya baca di dalam aplikasi" : "Pratinjau dokumen di dalam aplikasi";
    tabsEl.innerHTML = "";
    canvasBody.innerHTML = '<div style="display:grid;place-items:center;min-height:240px;color:#94a3b8">Memuat pratinjau...</div>';

    var workspace = document.getElementById("fpvWorkspace");
    if (workspace) workspace.classList.remove("sidebar-hidden");
    document.getElementById("fpvStatusContent").innerHTML =
      '<div style="font-size:12px;color:#64748b">' + (isTemplate ? "Jenis dokumen" : "Status eviden") + '</div>' +
      '<b style="font-size:12px;color:#0f766e">' + escapeHtml(statusEl.textContent) + '</b>' +
      (e.catatan_temuan ? '<div style="margin-top:8px;font-size:12px;color:#92400e">' + escapeHtml(e.catatan_temuan) + '</div>' : '');
    document.getElementById("fpvMetaGrid").innerHTML =
      '<div class="fpv-meta-item"><span class="fpv-meta-label">Modul</span><div class="fpv-meta-value">' + escapeHtml(e.nama_modul || '-') + '</div></div>' +
      '<div class="fpv-meta-item"><span class="fpv-meta-label">Unit Kerja</span><div class="fpv-meta-value">' + escapeHtml(e.nama_unit || '-') + '</div></div>' +
      '<div class="fpv-meta-item" style="grid-column:span 2"><span class="fpv-meta-label">' + (isTemplate ? "Jenis Dokumen" : "Indikator") + '</span><div class="fpv-meta-value">' + escapeHtml(isTemplate ? "Format Baku Acuan SKI" : (e.deskripsi_indikator || '-')) + '</div></div>' +
      '<div class="fpv-meta-item"><span class="fpv-meta-label">' + (isTemplate ? "Sumber" : "Pengunggah") + '</span><div class="fpv-meta-value">' + escapeHtml(isTemplate ? "Tim SKI" : (e.nama_pic || '-')) + '</div></div>' +
      '<div class="fpv-meta-item"><span class="fpv-meta-label">Format</span><div class="fpv-meta-value">' + escapeHtml(format.toUpperCase()) + '</div></div>';
    document.getElementById("fpvCardStructured").style.display = "none";
    document.getElementById("fpvIndList").innerHTML = "";
    document.getElementById("fpvIndList").parentElement.style.display = isTemplate ? "none" : "";
    fpv.style.display = "flex";

    function showPreviewError(message) {
      canvasBody.innerHTML = '<div style="display:grid;place-items:center;min-height:240px;padding:24px;text-align:center;color:#fecaca">' +
        '<div><b>Pratinjau tidak dapat dimuat</b><div style="margin-top:6px;color:#cbd5e1;font-size:12px">' + escapeHtml(message) + '</div></div></div>';
    }

    function fetchPreviewBlob() {
      return fetch(previewUrl).then(function(response){
        if (!response.ok) throw new Error("Server mengembalikan status " + response.status + ".");
        return response.blob();
      });
    }

    if (cloudFormat && !requestExport) {
      var embedUrl = filePath;
      var driveFile = filePath.match(/drive\.google\.com\/file\/d\/([^/?#]+)/i);
      var driveOpen = filePath.match(/drive\.google\.com\/open\?[^#]*id=([^&#]+)/i);
      var driveFolder = filePath.match(/drive\.google\.com\/drive\/folders\/([^/?#]+)/i);
      var googleDoc = filePath.match(/docs\.google\.com\/(document|spreadsheets|presentation)\/d\/([^/?#]+)/i);
      if (driveFile) embedUrl = "https://drive.google.com/file/d/" + driveFile[1] + "/preview";
      else if (driveOpen) embedUrl = "https://drive.google.com/file/d/" + driveOpen[1] + "/preview";
      else if (driveFolder) embedUrl = "https://drive.google.com/embeddedfolderview?id=" + driveFolder[1] + "#grid";
      else if (googleDoc) embedUrl = "https://docs.google.com/" + googleDoc[1] + "/d/" + googleDoc[2] + "/preview";
      if (driveFile || driveOpen || driveFolder || googleDoc) {
        canvasBody.innerHTML = '<iframe src="' + escapeAttr(embedUrl) + '" style="width:100%;height:100%;min-height:60vh;border:0;background:#1e293b" title="Pratinjau eviden hanya baca"></iframe>';
      } else {
        showPreviewError("Tautan ini tidak mendukung pratinjau hanya baca di dalam aplikasi.");
      }
      return;
    }

    if (format === "pdf" && !requestExport) {
      canvasBody.innerHTML = '<iframe src="' + escapeAttr(filePath) + '" style="width:100%;height:100%;min-height:60vh;border:0;background:#1e293b" title="Pratinjau PDF"></iframe>';
      return;
    }

    if (format === "jpg" || format === "jpeg" || format === "png" || format === "gif" || format === "webp" || format === "svg") {
      canvasBody.innerHTML = '<div style="display:grid;place-items:center;min-height:60vh;padding:20px;background:#0f172a"><img src="' + escapeAttr(filePath) + '" alt="Pratinjau eviden" style="max-width:100%;max-height:75vh;object-fit:contain"></div>';
      return;
    }

    if (format === "pdf") {
      fetchPreviewBlob().then(function(blob){
        fpvPreviewObjectUrl = URL.createObjectURL(blob);
        canvasBody.innerHTML = '<iframe src="' + escapeAttr(fpvPreviewObjectUrl) + '" style="width:100%;height:100%;min-height:60vh;border:0;background:#1e293b" title="Pratinjau PDF"></iframe>';
      }).catch(function(error){ showPreviewError(error.message); });
      return;
    }

    if (format === "docx") {
      canvasBody.innerHTML = '<div class="fpv-docx-wrapper"><div id="fpvInlineDocxTarget" class="docx-viewer"></div></div>';
      fetchPreviewBlob().then(function(blob){
        var target = document.getElementById("fpvInlineDocxTarget");
        if (!target) return;
        if (!window.docx || typeof window.docx.renderAsync !== "function") throw new Error("Library pratinjau DOCX belum tersedia.");
        return window.docx.renderAsync(blob, target, null, { className: "docx-inner-page", inWrapper: false });
      }).catch(function(error){ showPreviewError(error.message); });
      return;
    }

    if (format === "xlsx" || format === "xls" || format === "csv") {
      canvasBody.innerHTML = '<div id="fpvInlineXlsxTarget" class="fpv-excel-scroll"></div>';
      fetchPreviewBlob().then(function(blob){ return blob.arrayBuffer(); }).then(function(buffer){
        if (!window.XLSX || typeof window.XLSX.read !== "function") throw new Error("Library pratinjau Excel belum tersedia.");
        var workbook = window.XLSX.read(new Uint8Array(buffer), { type: "array" });
        var target = document.getElementById("fpvInlineXlsxTarget");
        if (!target) return;
        if (!workbook.SheetNames || workbook.SheetNames.length === 0) throw new Error("Berkas tidak memiliki lembar kerja.");
        function showSheet(sheetName) {
          target.innerHTML = window.XLSX.utils.sheet_to_html(workbook.Sheets[sheetName], { editable: false });
        }
        workbook.SheetNames.forEach(function(sheetName, index){
          var tab = document.createElement("button");
          tab.type = "button";
          tab.className = "fpv-sheet-tab" + (index === 0 ? " active" : "");
          tab.textContent = sheetName;
          tab.onclick = function(){
            tabsEl.querySelectorAll(".fpv-sheet-tab").forEach(function(item){ item.classList.remove("active"); });
            tab.classList.add("active");
            showSheet(sheetName);
          };
          tabsEl.appendChild(tab);
        });
        showSheet(workbook.SheetNames[0]);
      }).catch(function(error){ showPreviewError(error.message); });
      return;
    }

    if (format === "pptx") {
      fetchPreviewBlob().then(function(blob){
        if (!window.JSZip || typeof window.JSZip.loadAsync !== "function") throw new Error("Library pratinjau PowerPoint belum tersedia.");
        return window.JSZip.loadAsync(blob);
      }).then(function(zip){
        var slideNames = Object.keys(zip.files).filter(function(name){ return /^ppt\/slides\/slide\d+\.xml$/i.test(name); });
        slideNames.sort(function(a, b){ return parseInt(a.match(/slide(\d+)/i)[1], 10) - parseInt(b.match(/slide(\d+)/i)[1], 10); });
        if (!slideNames.length) throw new Error("Tidak ada slide yang dapat ditampilkan.");
        return Promise.all(slideNames.map(function(name){
          return zip.files[name].async("text").then(function(xml){
            var doc = new DOMParser().parseFromString(xml, "application/xml");
            return [].map.call(doc.getElementsByTagNameNS("*", "p"), function(paragraph){
              return [].map.call(paragraph.getElementsByTagNameNS("*", "t"), function(text){ return text.textContent; }).join("");
            }).filter(Boolean);
          });
        }));
      }).then(function(slides){
        canvasBody.innerHTML = slides.map(function(paragraphs, index){
          return '<article style="max-width:900px;min-height:360px;margin:18px auto;padding:32px;background:#fff;border-radius:8px;box-shadow:0 2px 12px rgba(0,0,0,.2);color:#1e293b">' +
            '<div style="font-size:11px;color:#64748b;margin-bottom:18px">Slide ' + (index + 1) + '</div>' +
            paragraphs.map(function(text){ return '<p>' + escapeHtml(text) + '</p>'; }).join("") + '</article>';
        }).join("");
        hintEl.textContent = "Pratinjau teks per slide";
      }).catch(function(error){ showPreviewError(error.message); });
      return;
    }

    if (cloudFormat) {
      showPreviewError("Tautan ini tidak mendukung pratinjau hanya baca di dalam aplikasi.");
      return;
    }

    showPreviewError("Format " + format.toUpperCase() + " belum didukung untuk pratinjau di dalam aplikasi.");
  }

  document.addEventListener("click", function(event){
    var button = event.target.closest(".btnPreviewEviden");
    if (!button) return;
    event.preventDefault();
    var evidence = (STATE.evidens || []).find(function(item){
      return String(item.id_eviden) === String(button.dataset.id);
    });
    if (!evidence) {
      toast("Data eviden tidak ditemukan.");
      return;
    }
    openEvidencePreview(evidence, button.dataset.format || "");
  });

  document.addEventListener("click", function(event){
    var button = event.target.closest(".btnPreviewTemplate");
    if (!button) return;
    event.preventDefault();
    var fileName = button.dataset.file || "";
    if (!fileName) {
      toast("Berkas format acuan tidak tersedia untuk dipratinjau.");
      return;
    }
    openEvidencePreview({
      nama_file: fileName,
      path_file: "uploads/templates/" + encodeURIComponent(fileName),
      format_file: "",
      nama_modul: button.dataset.module || "-",
      nama_unit: "-",
      deskripsi_indikator: "Format Baku Acuan SKI",
      nama_pic: "Tim SKI",
      versi: 1,
      is_template: true
    }, "original");
  });

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
        STATE.perms = res.permissions || {};
        STATE.moduls = res.moduls || [];
        STATE.indikators = res.indikators || [];
        STATE.evidens = res.evidens || [];
        STATE.rekomendasi = res.rekomendasi || [];
        STATE.audit = res.audit || [];
        STATE.users = res.users || [];
        STATE.units = res.units || [];
        STATE.roles = res.roles || [];
        STATE.rolePermissions = res.role_permissions || {};

        document.getElementById("loginView").style.display = "none";
        document.getElementById("appView").style.display = "block";
        if (STATE.user) {
          if (document.getElementById("unm")) document.getElementById("unm").textContent = STATE.user.nama || '';
          if (document.getElementById("urn")) document.getElementById("urn").textContent = STATE.user.nama_role || '';
          if (document.getElementById("uav")) document.getElementById("uav").textContent = (STATE.user.nama || 'AK').substr(0, 2).toUpperCase();
        }

        syncNav();
        if (callback) callback();
      }).catch(function(err){
        console.error("fetchInit error:", err);
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
    document.querySelectorAll(".nav-group").forEach(function(grp){
      var hasVisible = [].some.call(grp.querySelectorAll(".nav"), function(n){
        return n.style.display !== "none";
      });
      grp.style.display = hasVisible ? "" : "none";
    });
    var unseen = (STATE.rekomendasi || []).filter(function(r){ return parseInt(r.is_dilihat_pimpinan) === 0; }).length;
    var pendingEv = (STATE.evidens || []).filter(function(e){ return e.status_eviden === 'a'; }).length;
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
    if (s !== 'upl' && uplRealtimeTimer) {
      clearInterval(uplRealtimeTimer);
      uplRealtimeTimer = null;
    }
    if (s === 'apr') s = 'rev';
    if (s === 'jdw') s = 'mod';
    if (s !== 'dash' && s !== 'prof' && !can(s, 'l')) {
      s = 'dash';
    }
    if (s !== 'mod') setModWorkspaceOpen(false);
    ACTIVE_SCREEN = s;
    document.body.classList.remove("nav-open");
    document.querySelectorAll(".scr").forEach(function(x){ x.classList.toggle("on", x.id === s); });
    document.querySelectorAll(".nav").forEach(function(b){ b.classList.toggle("on", b.dataset.s === s); });
    var mainEl = document.querySelector('.main');
    if (mainEl) {
      mainEl.classList.toggle('dashboard-active', s === 'dash');
      mainEl.classList.toggle('upload-active', s === 'upl');
    }
    
    // Toggle page guide button visibility (hidden on dash to match mockup cleanly, visible on other screens)
    var btnGuide = document.getElementById("btnPageGuide");
    if (btnGuide) {
      btnGuide.style.display = (s === 'dash') ? 'none' : 'inline-flex';
    }

    var nb = document.querySelector('.nav[data-s="' + s + '"]');
    if (nb) {
      var navTxtEl = nb.querySelector('.nav-txt');
      var navTitle = navTxtEl ? navTxtEl.textContent : nb.textContent;
      document.getElementById("ttl").innerHTML = '<span>' + (s === 'dash' ? 'Dashboard Pengawasan' : navTitle.replace(/[0-9]/g, '').trim()) + '</span>';
    } else if (s === 'prof') {
      document.getElementById("ttl").innerHTML = '<span>Profil Akun Saya</span>';
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
    mod: {
      step: "Master Modul & Template",
      role: "Ketua SKI, Anggota SKI, dan Admin sesuai hak akses",
      desc: "Kelola modul, butir tagihan, template acuan, serta jadwal pengawasan per modul.",
      actions: [
        "Klik ikon edit pada kartu modul untuk mengubah nama modul, periode, siklus, tenggat unggah PIC, atau tanggal mulai penilaian SKI.",
        "Klik <b>Terbitkan</b> pada modul draf, lengkapi jadwalnya, lalu pilih <b>Terbitkan Jadwal</b> agar modul aktif untuk PIC.",
        "Jadwal hanya berlaku untuk modul yang sedang diatur; modul lain tidak berubah."
      ],
      next: "Periksa kembali tenggat dan tanggal penilaian pada kartu modul sebelum modul diterbitkan."
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
      step: "Tahap 4: Review & Cross-check SKI",
      role: "Anggota SKI & Ketua SKI",
      desc: "Tim SKI memverifikasi kesesuaian dokumen bukti dan mengajukan berkas ke Meja Pimpinan.",
      actions: [
        "Pilih berkas dari antrean, klik tombol <b>Tinjau & Nilai</b> untuk memeriksa kesesuaian berkas.",
        "Pilih <b>Setujui & Ajukan ke Pimpinan</b> jika berkas memenuhi standar, atau kembalikan ke PIC modul jika perlu revisi.",
        "Setelah Pimpinan menyetujui berkas, status kembali ke SKI (Disetujui Pimpinan).",
        "Tekan tombol <b>Selesai</b> untuk menuntaskan seluruh proses approval berkas."
      ],
      next: "Setelah disetujui Pimpinan, Tim SKI menuntaskan alur dengan menekan tombol <b>Selesai</b>."
    },
    apm: {
      step: "Tahap 5: Persetujuan Pimpinan",
      role: "Pimpinan / Kepala BBPK Jakarta",
      desc: "Pimpinan mengevaluasi berkas eviden yang diajukan SKI dengan 3 opsi keputusan: Disetujui, Ditolak (ke SKI), atau Revisi (ke PIC).",
      actions: [
        "Periksa dokumen eviden pada tabel Berkas Menunggu Persetujuan.",
        "Klik <b>Disetujui</b> untuk menyetujui berkas dan mengembalikannya ke SKI agar diselesaikan.",
        "Klik <b>Ditolak (Ke SKI)</b> jika berkas belum layak diajukan oleh Tim SKI.",
        "Klik <b>Revisi (Ke PIC)</b> untuk meminta perbaikan dokumen langsung ke PIC unit kerja."
      ],
      next: "Berkas yang disetujui Pimpinan dikembalikan ke SKI untuk penyelesaian akhir (Selesai)."
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
      desc: "Merekam setiap aktivitas mutasi data secara objektif (waktu, nama, peran, jenis aksi, dan objek target) tanpa dapat diubah atau dihapus oleh siapa pun, termasuk Admin.",
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
    else if (ACTIVE_SCREEN === 'upl') renderUpload();
    else if (ACTIVE_SCREEN === 'mon') renderMonitoring();
    else if (ACTIVE_SCREEN === 'rep') renderRepositori();
    else if (ACTIVE_SCREEN === 'rev' || ACTIVE_SCREEN === 'apr') renderReview();
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

  // --- SHARED DASHBOARD COMPONENT BUILDERS (STANDAR DESAIN ANGGOTA SKI UNTUK SEMUA ROLE) ---
  function memberKpi(label, value, sub, icon, bg, color, valueColor, onClick) {
    var clickAttr = onClick ? ' onclick="' + onClick + '" style="cursor:pointer"' : '';
    return '<div class="dash-member-kpi"' + clickAttr + '>' +
             '<div class="dash-member-kpi-icon" style="background:' + bg + ';color:' + color + '">' + icon + '</div>' +
             '<div class="dash-member-kpi-copy">' +
               '<span class="dash-member-kpi-label">' + escapeHtml(label) + '</span>' +
               '<b class="dash-member-kpi-value" style="' + (valueColor ? 'color:' + valueColor : '') + '">' + escapeHtml(String(value)) + '</b>' +
               '<span class="dash-member-kpi-sub">' + escapeHtml(sub) + '</span>' +
             '</div>' +
           '</div>';
  }

  function activityDateValue(value) {
    var d = new Date(String(value || '').replace(' ', 'T'));
    return isNaN(d.getTime()) ? null : d;
  }

  function activityTimeLabel(value) {
    var d = activityDateValue(value);
    if (!d) return escapeHtml(value || '-');
    var months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    var hour = String(d.getHours());
    var minute = String(d.getMinutes());
    return d.getDate() + ' ' + months[d.getMonth()] + ', ' +
      (hour.length < 2 ? '0' + hour : hour) + ':' +
      (minute.length < 2 ? '0' + minute : minute);
  }

  function buildDashActivityAside(auditList, selectedTab) {
    var tab = ['all', 'upload', 'activity'].indexOf(selectedTab) > -1 ? selectedTab : 'all';
    var entries = (auditList || []).filter(function(entry){
      var action = String(entry.jenis_aksi || '').trim().toLowerCase();
      var target = String(entry.objek_target || '').toLowerCase();
      return action &&
        action.indexOf('login') === -1 &&
        action.indexOf('logout') === -1 &&
        action.indexOf('rbac') === -1 &&
        action.indexOf('pengguna') === -1 &&
        action.indexOf('akun') === -1 &&
        target.indexOf('sistem monev ski') === -1 &&
        target.indexOf('portal bbpk') === -1 &&
        target.indexOf('role:') === -1;
    });
    entries.sort(function(a, b){
      var da = activityDateValue(a.timestamp_aktivitas);
      var db = activityDateValue(b.timestamp_aktivitas);
      return (db ? db.getTime() : 0) - (da ? da.getTime() : 0);
    });

    var activityUsers = [];
    var seenActivityUsers = {};
    if (STATE.user && STATE.user.nama) {
      var currentNameKey = STATE.user.nama.trim().toLowerCase();
      activityUsers.push({ name: STATE.user.nama, role: STATE.user.nama_role || 'Pengguna' });
      seenActivityUsers[currentNameKey] = true;
    }
    entries.slice(0, 6).forEach(function(entry){
      var name = String(entry.nama_lengkap || '').trim();
      var key = name.toLowerCase();
      if (name && !seenActivityUsers[key]) {
        seenActivityUsers[key] = true;
        activityUsers.push({ name: name, role: entry.role_saat_aksi || 'Pengguna' });
      }
    });

    var filteredActivity = entries.filter(function(entry){
      var action = String(entry.jenis_aksi || '').toLowerCase();
      var isUpload = /unggah|upload|eviden|berkas/.test(action);
      if (tab === 'upload') return isUpload;
      if (tab === 'activity') return !isUpload;
      return true;
    }).slice(0, 6);

    var avatarsHtml = '';
    var roleColors = ['#6366f1', '#8b5cf6', '#0d9488', '#f59e0b', '#475569'];
    activityUsers.slice(0, 4).forEach(function(person, index){
      var initials = person.name.split(/\s+/).slice(0, 2).map(function(word){ return word.charAt(0); }).join('').toUpperCase();
      var role = String(person.role || '').toLowerCase();
      var color = role.indexOf('pic') > -1 ? '#8b5cf6' :
        (role.indexOf('anggota') > -1 ? '#6366f1' :
        (role.indexOf('ketua') > -1 ? '#0d9488' :
        (role.indexOf('pimpinan') > -1 ? '#475569' :
        (role.indexOf('admin') > -1 ? '#f59e0b' : roleColors[index % roleColors.length]))));
      avatarsHtml += '<span class="dash-member-avatar" style="background:' + color + '" title="' +
        escapeAttr(person.name + ' (' + person.role + ')') + '">' + escapeHtml(initials) + '</span>';
    });
    if (activityUsers.length > 4) {
      avatarsHtml += '<span class="dash-member-avatar more">+' + (activityUsers.length - 4) + '</span>';
    }
    if (activityUsers.length === 0) {
      avatarsHtml = '<span class="dash-member-viewers-count">Belum ada aktivitas pengguna</span>';
    }

    var activityHtml = '';
    if (filteredActivity.length === 0) {
      activityHtml = '<div style="padding:24px 8px;color:#94a3b8;font-size:11px;text-align:center">Belum ada aktivitas untuk kategori ini.</div>';
    } else {
      filteredActivity.forEach(function(entry){
        var action = String(entry.jenis_aksi || 'Aktivitas').trim();
        var userName = String(entry.nama_lengkap || 'Pengguna');
        var roleName = String(entry.role_saat_aksi || '').trim();
        var target = String(entry.objek_target || '').trim();
        var lowerTarget = target.toLowerCase();
        var matchedModule = (STATE.moduls || []).find(function(m){
          var moduleName = String(m.nama_modul || '').trim().toLowerCase();
          return moduleName && lowerTarget.indexOf(moduleName) > -1;
        });
        var moduleLabel = matchedModule ? matchedModule.nama_modul : target;
        var actionLower = action.toLowerCase();
        var dotType = /unggah|upload|eviden|berkas/.test(actionLower) ? 'upload' :
          (/review|setujui|approval|verifikasi/.test(actionLower) ? 'review' : '');

        activityHtml += '<div class="dash-member-activity-item">' +
                          '<span class="dash-member-activity-dot ' + dotType + '"></span>' +
                          '<div class="dash-member-activity-userline">' +
                            '<b>' + escapeHtml(userName) + (roleName ? ' (' + escapeHtml(roleName) + ')' : '') + '</b>' +
                            '<span> &nbsp;•&nbsp; ' + activityTimeLabel(entry.timestamp_aktivitas) + '</span>' +
                          '</div>' +
                          '<div class="dash-member-activity-action">' + escapeHtml(action) + '</div>' +
                          (moduleLabel ? '<span class="dash-member-activity-target" title="' + escapeAttr(moduleLabel) + '">' + escapeHtml(moduleLabel) + '</span>' : '') +
                        '</div>';
      });
    }

    var tabCounts = {
      all: entries.length,
      upload: entries.filter(function(entry){ return /unggah|upload|eviden|berkas/i.test(String(entry.jenis_aksi || '')); }).length,
      activity: entries.filter(function(entry){ return !/unggah|upload|eviden|berkas/i.test(String(entry.jenis_aksi || '')); }).length
    };
    var viewerCountText = activityUsers.length > 4
      ? '+' + (activityUsers.length - 4) + ' Orang Lainnya'
      : activityUsers.length + ' Pengguna Terlibat';

    return '<aside class="dash-card dash-member-activity">' +
             '<div class="dash-member-tabs">' +
               '<div class="dash-member-tabs-list">' +
                 '<button type="button" class="dash-member-tab' + (tab === 'all' ? ' active' : '') + '" data-tab="all">Semua</button>' +
                 '<button type="button" class="dash-member-tab' + (tab === 'upload' ? ' active' : '') + '" data-tab="upload">Upload</button>' +
                 '<button type="button" class="dash-member-tab' + (tab === 'activity' ? ' active' : '') + '" data-tab="activity">Aktivitas</button>' +
               '</div>' +
               '<span class="dash-member-data-status"><i></i> Terbaru</span>' +
             '</div>' +
             '<div class="dash-member-viewers">' +
               '<div class="dash-member-overline">Pengguna Terlibat</div>' +
               '<div class="dash-member-viewers-title">Terlihat pada aktivitas terbaru</div>' +
               '<div class="dash-member-viewers-row">' +
                 '<div class="dash-member-avatars">' + avatarsHtml + '</div>' +
                 '<span class="dash-member-viewers-count">' + escapeHtml(viewerCountText) + '</span>' +
               '</div>' +
             '</div>' +
             '<div class="dash-member-timeline-section">' +
               '<div class="dash-member-timeline-header">' +
                 '<span class="dash-member-overline">Riwayat Aktivitas</span>' +
                 '<span class="dash-member-timeline-count">' + Math.min(tabCounts[tab], 6) + ' aktivitas</span>' +
               '</div>' +
               '<div class="dash-member-timeline">' + activityHtml + '</div>' +
             '</div>' +
           '</aside>';
  }

  function buildDashDonutCard(title, qualityTag, pct, caption, statItems) {
    var circumference = 2 * Math.PI * 40;
    var statsHtml = (statItems || []).map(function(s){
      return '<div class="dash-member-review-stat"><span>' + escapeHtml(s.label) + '</span><b class="' + (s.cls || '') + '"' + (s.color ? ' style="color:' + s.color + '"' : '') + '>' + escapeHtml(String(s.val)) + '</b></div>';
    }).join('');

    return '<section class="dash-card dash-member-review-card">' +
             '<div class="dash-member-review-top">' +
               '<h2 class="dash-card-title">' + escapeHtml(title) + '</h2>' +
               '<span class="dash-member-quality">' + escapeHtml(qualityTag) + '</span>' +
             '</div>' +
             '<div class="dash-member-review-ring">' +
               '<svg viewBox="0 0 100 100" aria-label="' + escapeAttr(title) + ' ' + pct + '%">' +
                 '<circle cx="50" cy="50" r="40" fill="none" stroke="#f1f5f9" stroke-width="11"></circle>' +
                 '<circle cx="50" cy="50" r="40" fill="none" stroke="#0d9488" stroke-width="11" stroke-linecap="round" stroke-dasharray="' + circumference.toFixed(1) + '" stroke-dashoffset="' + (circumference - (pct / 100) * circumference).toFixed(1) + '"></circle>' +
               '</svg>' +
               '<div class="dash-member-review-center">' +
                 '<b class="dash-member-review-percent">' + pct + '%</b>' +
                 '<span class="dash-member-review-caption">' + escapeHtml(caption) + '</span>' +
               '</div>' +
             '</div>' +
             '<div class="dash-member-review-stats">' + statsHtml + '</div>' +
           '</section>';
  }

  function buildDashProgressCard(title, queueBadgeText, progressItems, footerText, footerBtnText, footerBtnId) {
    var rowsHtml = '';
    if (!progressItems || progressItems.length === 0) {
      rowsHtml = '<div style="padding:30px 8px;text-align:center;color:#94a3b8;font-size:11px">Belum ada berkas untuk ditinjau.</div>';
    } else {
      progressItems.slice(0, 4).forEach(function(item){
        var status = item.pct >= 80 ? 'Baik' : (item.pct >= 60 ? 'Cukup' : (item.done > 0 ? 'Proses' : 'Menunggu'));
        var fillColor = item.pct >= 80 ? '#10b981' : (item.pct >= 40 ? '#f59e0b' : '#0ea5e9');
        var subUnit = item.subUnit ? '<small class="dash-member-progress-unit">(' + escapeHtml(item.subUnit) + ')</small>' : '';
        rowsHtml += '<div class="dash-member-progress-row" data-mod-id="' + escapeAttr(item.id) + '" title="Buka modul ' + escapeAttr(item.name) + '">' +
                      '<div class="dash-member-progress-meta">' +
                        '<span class="dash-member-progress-name">' + escapeHtml(item.name) + ' ' + subUnit + '</span>' +
                        '<span class="dash-member-progress-result"><span><b>' + item.done + '</b>/' + item.total + ' ' + (item.unitLabel || 'lolos') + '</span><b class="dash-member-progress-status" style="color:' + fillColor + '">' + status + '</b></span>' +
                      '</div>' +
                      '<div class="dash-member-progress-bar"><div class="dash-member-progress-fill" style="width:' + item.pct + '%;background:' + fillColor + '"></div></div>' +
                    '</div>';
      });
    }

    return '<section class="dash-card dash-member-progress-card">' +
             '<div>' +
               '<div class="dash-member-progress-head">' +
                 '<h2 class="dash-card-title">' + escapeHtml(title) + '</h2>' +
                 '<span class="dash-member-queue-badge"><i></i> ' + escapeHtml(queueBadgeText) + '</span>' +
               '</div>' +
               '<div class="dash-member-progress-list">' + rowsHtml + '</div>' +
             '</div>' +
             '<div class="dash-member-progress-footer">' +
               '<span>' + escapeHtml(footerText) + '</span>' +
               (footerBtnText ? '<button type="button" id="' + (footerBtnId || 'btnDashReviewAllModules') + '">' + escapeHtml(footerBtnText) + ' <span aria-hidden="true">&rarr;</span></button>' : '') +
             '</div>' +
           '</section>';
  }

  function buildDashUnitGrid(activeModules) {
    var unitCards = '';
    var units = STATE.units || [];
    var reviewStatuses = ['o', 'a', 'f'];
    if (units.length === 0) {
      unitCards = '<div style="grid-column:1/-1;padding:20px;text-align:center;color:#94a3b8;font-size:11px">Data unit kerja belum tersedia.</div>';
    } else {
      units.forEach(function(unit){
        var unitModules = (activeModules || []).filter(function(m){
          return String(m.id_unit_pic) === String(unit.id_unit);
        });
        var unitModuleIds = unitModules.map(function(m){ return String(m.id_modul); });
        var unitIndicators = (STATE.indikators || []).filter(function(i){
          return unitModuleIds.indexOf(String(i.id_modul)) > -1;
        });
        var unitEvidens = (STATE.evidens || []).filter(function(e){
          return unitModuleIds.indexOf(String(e.id_modul)) > -1;
        });
        var unitDone = unitIndicators.filter(function(ind){
          var ev = (STATE.evidens || []).find(function(e){
            return String(e.id_indikator) === String(ind.id_indikator);
          });
          return ev && reviewStatuses.indexOf(ev.status_eviden) > -1;
        }).length;
        var unitPct = unitIndicators.length > 0 ? Math.round((unitDone / unitIndicators.length) * 100) : 0;
        var isPending = unitModules.length === 0 || unitEvidens.length === 0;
        var badgeText = unitModules.length === 0 ? '—' : (unitEvidens.length === 0 ? 'Menunggu' : unitPct + '%');
        var detailText = unitModules.length + ' Modul · ' +
          (unitEvidens.length > 0 ? unitEvidens.length + ' Berkas' : (unitModules.length > 0 ? 'Terjadwal' : 'Belum aktif'));

        unitCards += '<div class="dash-member-unit-card">' +
                       '<div style="min-width:0">' +
                         '<div class="dash-member-unit-name">' + escapeHtml(unit.nama_unit || 'Unit Kerja') + '</div>' +
                         '<div class="dash-member-unit-meta">' + escapeHtml(detailText) + '</div>' +
                       '</div>' +
                       '<span class="dash-member-unit-badge' + (isPending ? ' pending' : '') + '">' + escapeHtml(badgeText) + '</span>' +
                     '</div>';
      });
    }
    return unitCards;
  }

  // Tampilan Dashboard: PIC (Penanggung Jawab Modul Unit Kerja)
  function dashPIC() {
    var myUnitId = STATE.user ? STATE.user.unit : null;
    var myModuls = (STATE.moduls || []).filter(function(m){
      return (!myUnitId || String(m.id_unit_pic) === String(myUnitId)) && m.status_template === 'terbit' && !!m.id_jadwal;
    });
    var myModuleIds = myModuls.map(function(m){ return String(m.id_modul); });
    var myInds = (STATE.indikators || []).filter(function(i){
      return myModuleIds.indexOf(String(i.id_modul)) > -1;
    });
    var myEvs = (STATE.evidens || []).filter(function(e){
      return myModuleIds.indexOf(String(e.id_modul)) > -1;
    });

    var terpenuhiCount = myInds.filter(function(i){
      var e = STATE.evidens.find(function(ev){ return String(ev.id_indikator) === String(i.id_indikator); });
      return e && e.status_eviden !== 'n' && e.status_eviden !== 'r';
    }).length;
    var totalInd = myInds.length;
    var pctTerpenuhi = totalInd > 0 ? Math.round((terpenuhiCount / totalInd) * 100) : 0;
    var revisiCount = myEvs.filter(function(e){ return e.status_eviden === 'r'; }).length;
    var antreReviewCount = myEvs.filter(function(e){ return ['u', 'o', 'a'].indexOf(e.status_eviden) > -1; }).length;
    var tenggatInfo = dashEarliestTenggatInfo(myModuls);
    var unitName = (STATE.user && STATE.user.nama_unit) ? STATE.user.nama_unit : 'Unit Kerja PIC';

    var modCards = '';
    if (myModuls.length === 0) {
      modCards = '<div style="grid-column:1/-1;padding:20px;text-align:center;color:#94a3b8;font-size:11px">Belum ada modul pengawasan aktif untuk unit kerja ini.</div>';
    } else {
      myModuls.forEach(function(m){
        var mInds = (STATE.indikators || []).filter(function(i){ return String(i.id_modul) === String(m.id_modul); });
        var mEvs = (STATE.evidens || []).filter(function(e){ return String(e.id_modul) === String(m.id_modul); });
        var mDone = mInds.filter(function(i){
          var e = mEvs.find(function(ev){ return String(ev.id_indikator) === String(i.id_indikator); });
          return e && e.status_eviden !== 'n' && e.status_eviden !== 'r';
        }).length;
        var mPct = mInds.length > 0 ? Math.round((mDone / mInds.length) * 100) : 0;
        var isPending = mDone === 0;
        var badgeText = mPct === 100 ? '100%' : (mDone > 0 ? mPct + '%' : 'Belum Isi');
        var tenggatStr = m.tenggat_unggah ? formatDateIndo(m.tenggat_unggah) : 'Terjadwal';

        modCards += '<div class="dash-member-unit-card" onclick="goToUploadModul(\'' + escapeAttr(m.id_modul) + '\')" style="cursor:pointer" title="Klik untuk langsung buka modul ini di Upload Eviden">' +
                      '<div style="min-width:0">' +
                        '<div class="dash-member-unit-name">' + escapeHtml(m.nama_modul) + '</div>' +
                        '<div class="dash-member-unit-meta">' + mInds.length + ' Indikator &bull; Batas: ' + escapeHtml(tenggatStr) + '</div>' +
                      '</div>' +
                      '<span class="dash-member-unit-badge' + (isPending ? ' pending' : '') + '">' + escapeHtml(badgeText) + '</span>' +
                    '</div>';
      });
    }

    var progressItems = myModuls.map(function(m){
      var mInds = (STATE.indikators || []).filter(function(i){ return String(i.id_modul) === String(m.id_modul); });
      var mEvs = (STATE.evidens || []).filter(function(e){ return String(e.id_modul) === String(m.id_modul); });
      var mDone = mInds.filter(function(i){
        var e = mEvs.find(function(ev){ return String(ev.id_indikator) === String(i.id_indikator); });
        return e && e.status_eviden !== 'n' && e.status_eviden !== 'r';
      }).length;
      var total = mInds.length;
      return {
        id: m.id_modul,
        name: m.nama_modul,
        subUnit: '',
        done: mDone,
        total: total,
        pct: total > 0 ? Math.round((mDone / total) * 100) : 0,
        unitLabel: 'indikator'
      };
    });

    var picAudit = (STATE.audit || []).filter(function(a){
      var obj = String(a.objek_target || '').toLowerCase();
      var act = String(a.jenis_aksi || '').toLowerCase();
      return myModuls.some(function(m){
        return obj.indexOf(String(m.nama_modul || '').toLowerCase()) > -1;
      }) || act.indexOf('unggah') > -1 || act.indexOf('upload') > -1;
    });
    if (picAudit.length === 0) picAudit = STATE.audit || [];

    var h = '<div class="dash-member-layout">' +
              '<div class="dash-member-left">' +
                '<div class="dash-member-kpis">' +
                  memberKpi("Modul Unit Saya", myModuls.length, "modul aktif terjadwal", dashIconFolder, "#eff6ff", "#2563eb", "", "goToUploadWithTab('all')") +
                  memberKpi("Indikator Terpenuhi", terpenuhiCount + " / " + totalInd, pctTerpenuhi + "% selesai", dashIconCheck, "#ecfdf5", "#059669", "#059669", "goToUploadWithTab('selesai')") +
                  memberKpi("Perlu Tindak Lanjut", revisiCount, revisiCount > 0 ? "berkas perlu perbaikan" : "semua eviden aman", dashIconAlert, "#fff1f2", "#dc2626", revisiCount > 0 ? "#dc2626" : "", "goToUploadWithTab('revisi')") +
                  memberKpi("Tenggat Terdekat", tenggatInfo.val, tenggatInfo.sub, dashIconClock, "#faf5ff", "#9333ea", "", tenggatInfo.earliest ? "goToUploadModul('" + tenggatInfo.earliest.id_modul + "')" : "goToUploadWithTab('belum_selesai')") +
                '</div>';

    h += dashCard(
      'Daftar Modul Unit Kerja',
      '<span style="font-size:10.5px;color:#94a3b8;font-weight:500">Unit: ' + escapeHtml(unitName) + '</span>',
      '<div class="dash-member-unit-grid">' + modCards + '</div>'
    );

    h += '<div class="dash-member-bottom">' +
           buildDashDonutCard(
             "Capaian Eviden PIC",
             pctTerpenuhi === 100 ? "Lengkap" : (pctTerpenuhi >= 60 ? "Proses Unggah" : "Perlu Dilengkapi"),
             pctTerpenuhi,
             "indikator terpenuhi",
             [
               { label: "Terpenuhi", val: terpenuhiCount, cls: "ok", color: "#059669" },
               { label: "Antrean", val: antreReviewCount, cls: "" },
               { label: "Revisi", val: revisiCount, cls: "", color: revisiCount > 0 ? "#dc2626" : "" }
             ]
           ) +
           buildDashProgressCard(
             "Progres Pemenuhan Modul",
             "Unit Kerja PIC",
             progressItems,
             myModuls.length + " modul pengawasan di unit Anda",
             "Katalog Eviden",
             "btnDashReviewAllModules"
           ) +
         '</div>' +
       '</div>' +
       buildDashActivityAside(picAudit, dashActivityTab) +
     '</div>';

    return h;
  }

  // Tampilan Dashboard: Anggota SKI
  function dashAnggota() {
    var reviewStatuses = ['o', 'a', 'f'];
    var activeModules = (STATE.moduls || []).filter(function(m){
      return m.status_template === 'terbit' && !!m.id_jadwal;
    });
    var valAntrean = (STATE.evidens || []).filter(function(e){ return e.status_eviden === 'u'; }).length;
    var valRevisi = (STATE.evidens || []).filter(function(e){ return e.status_eviden === 'r'; }).length;
    var valLolos = (STATE.evidens || []).filter(function(e){ return reviewStatuses.indexOf(e.status_eviden) > -1; }).length;
    var modAntreanCount = activeModules.filter(function(m){
      return (STATE.evidens || []).some(function(e){
        return String(e.id_modul) === String(m.id_modul) && e.status_eviden === 'u';
      });
    }).length;
    var reviewTotal = valLolos + valAntrean + valRevisi;
    var reviewPct = reviewTotal > 0 ? Math.round((valLolos / reviewTotal) * 100) : 0;
    var periodSelect = document.getElementById('dashPeriodSelect');
    var periodText = (periodSelect && periodSelect.options && periodSelect.selectedIndex >= 0 && periodSelect.options[periodSelect.selectedIndex])
      ? periodSelect.options[periodSelect.selectedIndex].textContent.split('·')[0].trim()
      : 'Periode Aktif';

    var unitCards = buildDashUnitGrid(activeModules);

    var progressModules = activeModules.map(function(m){
      var modIndicators = (STATE.indikators || []).filter(function(i){
        return String(i.id_modul) === String(m.id_modul);
      });
      var modEvidens = (STATE.evidens || []).filter(function(e){
        return String(e.id_modul) === String(m.id_modul);
      });
      if (modEvidens.length === 0) return null;
      var done = modIndicators.filter(function(ind){
        var ev = modEvidens.find(function(e){
          return String(e.id_indikator) === String(ind.id_indikator);
        });
        return ev && reviewStatuses.indexOf(ev.status_eviden) > -1;
      }).length;
      var total = modIndicators.length;
      return {
        id: m.id_modul,
        name: m.nama_modul,
        subUnit: m.nama_unit || '',
        done: done,
        total: total,
        pct: total > 0 ? Math.round((done / total) * 100) : 0,
        unitLabel: 'lolos'
      };
    }).filter(Boolean);
    progressModules.sort(function(a, b){
      return b.pct - a.pct || String(a.name).localeCompare(String(b.name));
    });

    var h = '<div class="dash-member-layout">' +
              '<div class="dash-member-left">' +
                '<div class="dash-member-kpis">' +
                  memberKpi('Antrean Review', valAntrean, 'berkas menunggu', dashIconFile, '#eff6ff', '#2563eb') +
                  memberKpi('Dikembalikan PIC', valRevisi, 'perlu tindak lanjut', dashIconAlert, '#fff1f2', '#e11d48') +
                  memberKpi('Lolos Review', valLolos, 'sesuai indikator', dashIconCheck, '#ecfdf5', '#059669', '#059669') +
                  memberKpi('Modul Antrean', modAntreanCount, 'dari ' + activeModules.length + ' modul', dashIconFolder, '#faf5ff', '#9333ea') +
                '</div>';

    h += dashCard(
      'Status Kepatuhan Unit Kerja',
      '<span style="font-size:10.5px;color:#94a3b8;font-weight:500">Periode ' + escapeHtml(periodText) + '</span>',
      '<div class="dash-member-unit-grid">' + unitCards + '</div>'
    );

    h += '<div class="dash-member-bottom">' +
           buildDashDonutCard(
             "Review Selesai",
             reviewPct === 100 && reviewTotal > 0 ? "Optimal" : "Dalam Proses",
             reviewPct,
             "berkas lolos",
             [
               { label: "Lolos", val: valLolos, cls: "ok", color: "#059669" },
               { label: "Antre", val: valAntrean, cls: "" },
               { label: "Revisi", val: valRevisi, cls: "" }
             ]
           ) +
           buildDashProgressCard(
             "Progres Review per Modul",
             "Antrean Aktif",
             progressModules,
             progressModules.length + " dari " + activeModules.length + " modul aktif memiliki berkas",
             "Semua Modul",
             "btnDashReviewAllModules"
           ) +
         '</div>' +
       '</div>' +
       buildDashActivityAside(STATE.audit, dashActivityTab) +
     '</div>';

    return h;
  }

  // Tampilan Dashboard: Ketua SKI (juga dipakai sebagai default untuk Admin)
  function dashKetua() {
    var reviewStatuses = ['o', 'a', 'f'];
    var activeModules = (STATE.moduls || []).filter(function(m){
      return m.status_template === 'terbit' && !!m.id_jadwal;
    });
    var totalMod = STATE.moduls ? STATE.moduls.length : 0;
    var totalInd = STATE.indikators ? STATE.indikators.length : 0;
    var lolosCount = (STATE.evidens || []).filter(function(e){ return reviewStatuses.indexOf(e.status_eviden) > -1; }).length;
    var avgKelengkapan = totalInd > 0 ? Math.round((lolosCount / totalInd) * 100) : 0;
    var revisiCount = (STATE.evidens || []).filter(function(e){ return e.status_eviden === 'r'; }).length;
    var antreanCount = (STATE.evidens || []).filter(function(e){ return e.status_eviden === 'u' || e.status_eviden === 'o'; }).length;

    var unitCards = buildDashUnitGrid(activeModules);

    var progressModules = activeModules.map(function(m){
      var mInds = (STATE.indikators || []).filter(function(i){ return String(i.id_modul) === String(m.id_modul); });
      var mEvs = (STATE.evidens || []).filter(function(e){ return String(e.id_modul) === String(m.id_modul); });
      var done = mInds.filter(function(ind){
        var ev = mEvs.find(function(e){ return String(e.id_indikator) === String(ind.id_indikator); });
        return ev && reviewStatuses.indexOf(ev.status_eviden) > -1;
      }).length;
      var total = mInds.length;
      return {
        id: m.id_modul,
        name: m.nama_modul,
        subUnit: m.nama_unit || '',
        done: done,
        total: total,
        pct: total > 0 ? Math.round((done / total) * 100) : 0,
        unitLabel: 'indikator'
      };
    });
    progressModules.sort(function(a, b){ return b.pct - a.pct; });

    var h = '<div class="dash-member-layout">' +
              '<div class="dash-member-left">' +
                '<div class="dash-member-kpis">' +
                  memberKpi("Modul Pengawasan", activeModules.length + " / " + totalMod, "modul aktif terjadwal", dashIconFolder, "#eff6ff", "#2563eb") +
                  memberKpi("Kelengkapan SKI", avgKelengkapan + "%", lolosCount + " dari " + totalInd + " indikator", dashIconCheck, "#ecfdf5", "#059669", "#059669") +
                  memberKpi("Antrean Validasi SKI", antreanCount, "berkas siap review", dashIconFile, "#faf5ff", "#9333ea") +
                  memberKpi("Perlu Revisi PIC", revisiCount, "catatan perbaikan", dashIconAlert, "#fff1f2", "#dc2626", revisiCount > 0 ? "#dc2626" : "") +
                '</div>';

    h += dashCard(
      'Status Kepatuhan Unit Kerja',
      '<span style="font-size:10.5px;color:#94a3b8;font-weight:500">Pengawasan Seluruh Satker</span>',
      '<div class="dash-member-unit-grid">' + unitCards + '</div>'
    );

    h += '<div class="dash-member-bottom">' +
           buildDashDonutCard(
             "Status Kepatuhan BBPK",
             avgKelengkapan >= 80 ? "Optimal" : "Dalam Pengawasan",
             avgKelengkapan,
             "kelengkapan rata-rata",
             [
               { label: "Lolos", val: lolosCount, cls: "ok", color: "#059669" },
               { label: "Antrean", val: antreanCount, cls: "" },
               { label: "Revisi", val: revisiCount, cls: "", color: revisiCount > 0 ? "#dc2626" : "" }
             ]
           ) +
           buildDashProgressCard(
             "Progres Pengawasan per Modul",
             "Pengawasan Internal",
             progressModules,
             activeModules.length + " modul pengawasan aktif",
             "Ruang Review",
             "btnDashReviewAllModules"
           ) +
         '</div>' +
       '</div>' +
       buildDashActivityAside(STATE.audit, dashActivityTab) +
     '</div>';

    return h;
  }

  // Tampilan Dashboard: Pimpinan
  function dashPimpinan() {
    var reviewStatuses = ['o', 'a', 'f'];
    var activeModules = (STATE.moduls || []).filter(function(m){
      return m.status_template === 'terbit' && !!m.id_jadwal;
    });
    var totalDepts = STATE.units ? STATE.units.length : 0;
    var totalInd = STATE.indikators ? STATE.indikators.length : 0;
    var lolosCount = (STATE.evidens || []).filter(function(e){ return reviewStatuses.indexOf(e.status_eviden) > -1; }).length;
    var avgKelengkapan = totalInd > 0 ? Math.round((lolosCount / totalInd) * 100) : 0;
    var revisiCount = (STATE.evidens || []).filter(function(e){ return e.status_eviden === 'r'; }).length;
    var siapPimpinan = (STATE.evidens || []).filter(function(e){ return e.status_eviden === 'a'; }).length;

    var now = new Date();
    var overdueIncomplete = (STATE.moduls || []).filter(function(m){
      if (!m.tenggat_unggah) return false;
      var d = new Date(m.tenggat_unggah.replace(' ', 'T'));
      if (isNaN(d.getTime())) return false;
      var isOverdue = d < now;
      var mInds = (STATE.indikators || []).filter(function(i){ return String(i.id_modul) === String(m.id_modul); });
      var mEvs = (STATE.evidens || []).filter(function(e){ return String(e.id_modul) === String(m.id_modul); });
      var mLolos = mEvs.filter(function(e){ return reviewStatuses.indexOf(e.status_eviden) > -1; }).length;
      return isOverdue && (mInds.length === 0 || mLolos < mInds.length);
    }).length;

    var unitCards = buildDashUnitGrid(activeModules);

    var progressModules = activeModules.map(function(m){
      var mInds = (STATE.indikators || []).filter(function(i){ return String(i.id_modul) === String(m.id_modul); });
      var mEvs = (STATE.evidens || []).filter(function(e){ return String(e.id_modul) === String(m.id_modul); });
      var done = mInds.filter(function(ind){
        var ev = mEvs.find(function(e){ return String(e.id_indikator) === String(ind.id_indikator); });
        return ev && reviewStatuses.indexOf(ev.status_eviden) > -1;
      }).length;
      var total = mInds.length;
      return {
        id: m.id_modul,
        name: m.nama_modul,
        subUnit: m.nama_unit || '',
        done: done,
        total: total,
        pct: total > 0 ? Math.round((done / total) * 100) : 0,
        unitLabel: 'indikator'
      };
    });
    progressModules.sort(function(a, b){ return a.pct - b.pct; });

    var h = '<div class="dash-member-layout">' +
              '<div class="dash-member-left">' +
                '<div class="dash-member-kpis">' +
                  memberKpi("Unit Kerja Terpantau", totalDepts + " Unit", "satker BBPK Jakarta", dashIconBuilding, "#eff6ff", "#2563eb") +
                  memberKpi("Kepatuhan Organisasi", avgKelengkapan + "%", "kepatuhan internal", dashIconCheck, "#ecfdf5", "#059669", "#059669") +
                  memberKpi("Menunggu Disposisi", siapPimpinan, "berkas di meja pimpinan", dashIconFile, "#faf5ff", "#9333ea") +
                  memberKpi("Lewat Tenggat", overdueIncomplete, "modul belum lengkap", dashIconAlert, "#fff1f2", "#dc2626", overdueIncomplete > 0 ? "#dc2626" : "") +
                '</div>';

    h += dashCard(
      'Evaluasi Kepatuhan per Unit Kerja',
      '<span style="font-size:10.5px;color:#94a3b8;font-weight:500">Meja Kepala BBPK</span>',
      '<div class="dash-member-unit-grid">' + unitCards + '</div>'
    );

    h += '<div class="dash-member-bottom">' +
           buildDashDonutCard(
             "Tingkat Kepatuhan Organisasi",
             avgKelengkapan >= 85 ? "Sangat Baik" : (avgKelengkapan >= 70 ? "Baik" : "Perlu Perhatian"),
             avgKelengkapan,
             "kepatuhan rata-rata",
             [
               { label: "Selesai", val: lolosCount, cls: "ok", color: "#059669" },
               { label: "Disposisi", val: siapPimpinan, cls: "" },
               { label: "Revisi", val: revisiCount, cls: "", color: revisiCount > 0 ? "#dc2626" : "" }
             ]
           ) +
           buildDashProgressCard(
             "Prioritas Pemantauan Pimpinan",
             "Meja Pimpinan",
             progressModules,
             totalDepts + " unit kerja BBPK terpantau",
             "Ringkasan Eksekutif",
             "btnDashReviewAllModules"
           ) +
         '</div>' +
       '</div>' +
       buildDashActivityAside(STATE.audit, dashActivityTab) +
     '</div>';

    return h;
  }

  // Tampilan Dashboard: Itjen (Inspektorat Jenderal)
  function dashItjen() {
    var reviewStatuses = ['o', 'a', 'f'];
    var activeModules = (STATE.moduls || []).filter(function(m){
      return m.status_template === 'terbit' && !!m.id_jadwal;
    });
    var totalEv = STATE.evidens ? STATE.evidens.length : 0;
    var modWithEv = (STATE.moduls || []).filter(function(m){
      return (STATE.evidens || []).some(function(e){ return String(e.id_modul) === String(m.id_modul); });
    }).length;
    var totalMod = STATE.moduls ? STATE.moduls.length : 0;
    var totalInd = STATE.indikators ? STATE.indikators.length : 0;
    var lolosCount = (STATE.evidens || []).filter(function(e){ return reviewStatuses.indexOf(e.status_eviden) > -1; }).length;
    var kelengkapanPct = totalInd > 0 ? Math.round((lolosCount / totalInd) * 100) : 0;

    var lastUploadDate = null;
    (STATE.evidens || []).forEach(function(e){
      if (e.waktu_unggah && (!lastUploadDate || e.waktu_unggah > lastUploadDate)) {
        lastUploadDate = e.waktu_unggah;
      }
    });
    var lastUploadStr = lastUploadDate ? formatDateIndo(lastUploadDate) : '-';

    var unitCards = buildDashUnitGrid(activeModules);

    var progressModules = (STATE.moduls || []).map(function(m){
      var mInds = (STATE.indikators || []).filter(function(i){ return String(i.id_modul) === String(m.id_modul); });
      var mEvs = (STATE.evidens || []).filter(function(e){ return String(e.id_modul) === String(m.id_modul); });
      var done = mInds.filter(function(ind){
        var ev = mEvs.find(function(e){ return String(e.id_indikator) === String(ind.id_indikator); });
        return ev && reviewStatuses.indexOf(ev.status_eviden) > -1;
      }).length;
      var total = mInds.length;
      return {
        id: m.id_modul,
        name: m.nama_modul,
        subUnit: m.nama_unit || '',
        done: done,
        total: total,
        pct: total > 0 ? Math.round((done / total) * 100) : 0,
        unitLabel: 'indikator'
      };
    });
    progressModules.sort(function(a, b){ return b.pct - a.pct; });

    var h = '<div class="dash-member-layout">' +
              '<div class="dash-member-left">' +
                '<div class="dash-member-kpis">' +
                  memberKpi("Total Berkas Eviden", totalEv, "dokumen terunggah", dashIconFile, "#eff6ff", "#2563eb") +
                  memberKpi("Modul Berisi Berkas", modWithEv + " / " + totalMod, "modul memiliki eviden", dashIconFolder, "#ecfdf5", "#059669", "#059669") +
                  memberKpi("Uji Petik Terverifikasi", lolosCount, "dari " + totalInd + " indikator", dashIconCheck, "#faf5ff", "#9333ea") +
                  memberKpi("Aktivitas Terakhir", lastUploadStr, "waktu unggah terbaru", dashIconClock, "#fff1f2", "#dc2626") +
                '</div>';

    h += dashCard(
      'Pemantauan Unit Kerja',
      '<span style="font-size:10.5px;color:#94a3b8;font-weight:500">Audit Trail Independen</span>',
      '<div class="dash-member-unit-grid">' + unitCards + '</div>'
    );

    h += '<div class="dash-member-bottom">' +
           buildDashDonutCard(
             "Ketersediaan Bukti Dukung",
             "Audit Trail Aktif",
             kelengkapanPct,
             "ketersediaan bukti",
             [
               { label: "Lolos", val: lolosCount, cls: "ok", color: "#059669" },
               { label: "Proses", val: Math.max(0, totalEv - lolosCount), cls: "" },
               { label: "Total", val: totalEv, cls: "" }
             ]
           ) +
           buildDashProgressCard(
             "Kelengkapan Uji Petik per Modul",
             "Audit Independen",
             progressModules,
             totalMod + " modul audit pengawasan",
             "Log Audit Trail",
             "btnDashReviewAllModules"
           ) +
         '</div>' +
       '</div>' +
       buildDashActivityAside(STATE.audit, dashActivityTab) +
     '</div>';

    return h;
  }

  // Router Dashboard
  function renderDash() {
    var role = (STATE.user && STATE.user.role) ? STATE.user.role : 'ket';
    var h = '';
    var mainEl = document.querySelector('.main');
    var guide = document.getElementById('btnPageGuide');
    if (mainEl) mainEl.classList.add('dashboard-active');
    if (guide) guide.style.display = 'none';
    if (STATE.user) {
      var greetingEl = document.getElementById('gr');
      var titleEl = document.getElementById('ttl');
      if (greetingEl) greetingEl.textContent = getGreetingText(STATE.user.nama);
      if (titleEl) titleEl.innerHTML = '<span>Dashboard Pengawasan</span>';
    }

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

    document.querySelectorAll('.dash-member-tab').forEach(function(button){
      button.onclick = function(){
        dashActivityTab = this.dataset.tab || 'all';
        renderDash();
      };
    });

    document.querySelectorAll('.dash-member-progress-row').forEach(function(row){
      row.onclick = function(){
        var modId = this.dataset.modId;
        if (!modId || modId === 'all') return;
        var r = (STATE.user && STATE.user.role) ? STATE.user.role : '';
        if (r === 'pic') {
          goToUploadModul(modId);
        } else if (r === 'ang' || r === 'ket') {
          revModFilter = modId;
          revFilterTab = 'all';
          showScreen('rev');
        } else if (r === 'itj') {
          repModFilter = modId;
          showScreen('rep');
        } else {
          revModFilter = modId;
          showScreen('rev');
        }
      };
    });

    var allModulesButton = document.getElementById('btnDashReviewAllModules');
    if (allModulesButton) {
      allModulesButton.onclick = function(){
        var r = (STATE.user && STATE.user.role) ? STATE.user.role : '';
        if (r === 'pic') {
          goToUploadWithTab('all');
        } else if (r === 'ang' || r === 'ket') {
          revModFilter = 'all';
          revFilterTab = 'pending';
          showScreen('rev');
        } else if (r === 'pim') {
          showScreen('eks');
        } else if (r === 'itj') {
          showScreen('aud');
        } else {
          showScreen('rev');
        }
      };
    }
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
        setModWorkspaceOpen(ACTIVE_SCREEN === 'mod');
        return;
      } else {
        currentModulId = null;
      }
    }

    // 2. DEFAULT: TAMPILKAN KATALOG SEMUA MODUL (OVERVIEW LEGA & BERSIH)
    setModWorkspaceOpen(false);
    renderModulCatalog(canCreate, canEdit, canDelete);
  }

  function setModWorkspaceOpen(isOpen) {
    var app = document.querySelector('.app');
    var period = document.getElementById('dashPeriodSelect');
    var guide = document.getElementById('btnPageGuide');
    if (app) app.classList.toggle('mod-workspace-open', isOpen);

    if (isOpen) {
      var periodSlot = document.getElementById('modWorkspacePeriodSlot');
      if (period && periodSlot) periodSlot.appendChild(period);
    } else if (period && guide && guide.parentNode) {
      guide.parentNode.appendChild(period);
    }
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
        h += '<button class="mod-icon-btn btnEditModModal" data-id="' + m.id_modul + '" title="Edit Modul, Periode &amp; Jadwal">' +
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

      h += '<div style="font-size:11px;line-height:1.55;color:#64748b;margin-top:-3px;margin-bottom:9px">' +
             (m.schedule_id_jadwal
               ? '<span style="font-weight:700;color:#0f766e">' + escapeHtml(m.schedule_nama_periode || 'Periode belum diatur') + '</span>' +
                 ' · ' + escapeHtml(m.schedule_siklus || '-') +
                 ' · Tenggat PIC: ' + escapeHtml(formatDateIndo(m.schedule_tenggat_unggah)) +
                 ' · Mulai SKI: ' + escapeHtml(formatDateIndo(m.schedule_mulai_penilaian))
               : '<span>Jadwal belum diatur</span>') +
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

      // 5. Main module actions
      h += '<div class="mod-card-main-actions" onclick="event.stopPropagation()">' +
             '<button class="mod-card-btn-primary btnOpenModWorkspace" data-id="' + m.id_modul + '">' +
               'Kelola Modul' +
             '</button>';
      if (canEdit) {
        h += '<button class="mod-card-btn-outline btnQuickToggleStatus" data-id="' + m.id_modul + '">' +
               (m.status_template === 'terbit' ? 'Tarik Draf' : 'Terbitkan') +
             '</button>';
      } else {
        h += '<button class="mod-card-btn-outline" style="flex:1;opacity:0.7;cursor:default">' +
               'Status: ' + (m.status_template === 'terbit' ? 'Terbit' : 'Draf') +
             '</button>';
      }
      h += '</div>'; // end mod-card-main-actions

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
        if (e.target.closest('button') || e.target.closest('.mod-top-actions') || e.target.closest('.mod-card-main-actions') || e.target.closest('.mod-format-box')) return;
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

    var isTerbit = curMod.status_template === 'terbit';

    var h = '<div class="mod-workspace">';

    h += '<div class="mod-workspace-nav">' +
           '<div class="mod-workspace-crumb">' +
             '<button type="button" class="mod-workspace-crumb-link" id="crumbCatalogRoot">' +
               '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg>' +
               '<span>Katalog Modul</span>' +
             '</button>' +
             '<span class="mod-ref-separator">/</span>' +
             '<span>' + escapeHtml(curMod.nama_unit) + '</span>' +
             '<span class="mod-ref-separator">/</span>' +
             '<b>' + escapeHtml(curMod.nama_modul) + '</b>' +
           '</div>' +
           '<div class="mod-workspace-period" id="modWorkspacePeriodSlot"></div>' +
         '</div>';

    h += '<section class="mod-workspace-hero">' +
           '<div class="mod-hero-top-row">' +
             '<div class="mod-hero-main">' +
               '<div class="mod-hero-title-row">' +
                 '<h1 class="mod-hero-title">' + escapeHtml(curMod.nama_modul) + '</h1>' +
                 '<span class="mod-ref-status ' + (isTerbit ? 'is-published' : 'is-draft') + '">' +
                   (isTerbit ? 'Terbit' : 'Draf') +
                 '</span>' +
               '</div>' +
               '<div class="mod-hero-meta-grid">' +
                 '<span class="mod-hero-meta-item">' +
                   '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 21h18M5 21V7l8-4v18M19 21V11l-6-4"/><path d="M9 9v.01M9 12v.01M9 15v.01M9 18v.01"/></svg>' +
                   '<span>Unit: <strong class="mod-hero-meta-value">' + escapeHtml(curMod.nama_unit) + '</strong></span>' +
                 '</span>' +
                 '<span class="mod-ref-separator">•</span>' +
                 '<span class="mod-hero-meta-item">' +
                   '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M8 13h8M8 17h5"/></svg>' +
                   '<span>Dokumen Eviden</span>' +
                 '</span>' +
                 '<span class="mod-ref-separator">•</span>' +
                 '<code class="mod-hero-code">#mod-' + escapeHtml(curMod.id_modul) + '</code>' +
               '</div>' +
             '</div>' +
             '<div class="mod-hero-actions">';
    if (canEdit) {
      h += '<button type="button" class="mod-ref-btn btnQuickToggleStatus" data-id="' + escapeAttr(curMod.id_modul) + '">' +
             (isTerbit ? 'Tarik ke Draf' : 'Terbitkan') +
           '</button>';
    }
    if (canDelete || (curMod.file_referensi && canEdit)) {
      h += '<details class="mod-ref-more-wrap">' +
             '<summary class="mod-ref-btn" aria-label="Aksi lainnya" title="Aksi lainnya">' +
               '<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><circle cx="5" cy="12" r="1.7"/><circle cx="12" cy="12" r="1.7"/><circle cx="19" cy="12" r="1.7"/></svg>' +
             '</summary>' +
             '<div class="mod-ref-more-menu">';
      if (curMod.file_referensi && (canEdit || canDelete)) {
        h += '<button type="button" class="btnDeleteTemplate" data-id="' + escapeAttr(curMod.id_modul) + '" data-name="' + escapeAttr(curMod.nama_modul) + '">' +
               '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 6h18M8 6V4h8v2m3 0-1 14H6L5 6m4 4v6m6-6v6"/></svg>' +
               'Hapus template' +
             '</button>';
      }
      if (canDelete) {
        h += '<button type="button" class="btnQuickDeleteMod" data-id="' + escapeAttr(curMod.id_modul) + '">' +
               '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 6h18M8 6V4h8v2m3 0-1 14H6L5 6m4 4v6m6-6v6"/></svg>' +
               'Hapus modul' +
             '</button>';
      }
      h += '</div></details>';
    }
    h += '</div>' +
           '</div>' +
         '</section>';

    var hasTpl = !!curMod.file_referensi;
    h += '<div class="mod-overview-grid">' +
           '<section class="mod-template-card-full">' +
             '<div class="mod-template-icon">' +
               '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M8 13h8M8 17h8"/></svg>' +
             '</div>' +
             '<div class="mod-template-info">' +
               '<div class="mod-template-heading">' +
                 '<span>Format Baku Acuan SKI</span>' +
                 '<span class="mod-template-status ' + (hasTpl ? 'is-available' : '') + '">' + (hasTpl ? 'Tersedia' : 'Belum Ada') + '</span>' +
               '</div>' +
               '<p class="mod-template-desc">' +
                 (hasTpl ?
                   'Nama berkas: <a href="uploads/templates/' + encodeURIComponent(curMod.file_referensi) + '" download="' + escapeAttr(curMod.file_referensi) + '">' + escapeHtml(curMod.file_referensi) + '</a>' :
                   'Opsional · Berkas acuan untuk PIC') +
               '</p>' +
             '</div>' +
             '<div class="mod-template-actions">';
    if (hasTpl) {
      h += '<button type="button" class="mod-ref-btn btnPreviewTemplate" data-file="' + escapeAttr(curMod.file_referensi) + '" data-module="' + escapeAttr(curMod.nama_modul) + '" title="Pratinjau format acuan SKI">' +
             'Pratinjau' +
           '</button>';
    }
    if (canEdit) {
      h += '<button type="button" class="mod-ref-btn mod-ref-btn-primary btnUploadTemplate" data-id="' + escapeAttr(curMod.id_modul) + '" data-name="' + escapeAttr(curMod.nama_modul) + '">' +
             (hasTpl ? 'Ganti' : 'Unggah') +
           '</button>';
    }
    h += '</div>' +
           '</section>' +
           '<section class="mod-stats-distribution">' +
             '<div class="mod-dist-card">' +
               '<span class="mod-dist-label">Total Indikator</span>' +
               '<strong class="mod-dist-val" id="modStatTotal">' + modInds.length + ' Butir</strong>' +
             '</div>' +
             '<div class="mod-dist-summary">' +
               '<div class="mod-dist-card">' +
                 '<span class="mod-dist-label">Wajib</span>' +
                 '<strong class="mod-dist-val mod-dist-required" id="modStatMandatory">' + mandCount + '</strong>' +
               '</div>' +
               '<span class="mod-ref-stat-divider"></span>' +
               '<div class="mod-dist-card">' +
                 '<span class="mod-dist-label">Opsional</span>' +
                 '<strong class="mod-dist-val" id="modStatOptional">' + optCount + '</strong>' +
               '</div>' +
             '</div>' +
           '</section>' +
         '</div>';

    h += '<section class="mod-items-card">' +
           '<div class="mod-section-header">' +
             '<h2 class="mod-section-title">Daftar Butir Tagihan <span class="mod-ref-count">(' + modInds.length + ')</span></h2>' +
             '<div class="mod-section-actions">';
    if (canDelete && modInds.length > 0) {
      h += '<button type="button" class="mod-clear-ind-btn" id="btnClearAllInds" data-id="' + escapeAttr(curMod.id_modul) + '" title="Kosongkan seluruh butir">' +
             'Kosongkan' +
           '</button>';
    }
    if (canEdit) {
      h += '<button type="button" class="mod-ref-btn mod-ref-btn-primary btnOpenAddIndModal">' +
             '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>' +
             '<span>Tambah Butir</span>' +
           '</button>';
    }
    h += '</div></div>' +
           '<div class="mod-ind-full-list">';
    if (modInds.length === 0) {
      h += '<div class="mod-ref-empty">' +
             '<p>Belum ada butir tagihan.</p>' +
             (canEdit ? '<button type="button" class="btnOpenAddIndModal">+ Tambah Butir Pertama</button>' : '') +
           '</div>';
    } else {
      modInds.forEach(function(ind, idx){
        var isMand = parseInt(ind.is_mandatory) === 1;
        h += '<div class="mod-ind-full-item">' +
               '<span class="mod-ind-full-num">' + (idx + 1) + '</span>' +
               '<div class="mod-ind-full-body">' +
                 '<div class="mod-ind-title-row">' +
                   '<span class="mod-ind-full-text">' + escapeHtml(ind.deskripsi_indikator) + '</span>' +
                   '<span class="mod-ind-mandatory-badge ' + (isMand ? 'is-mandatory' : '') + '">' + (isMand ? 'Wajib' : 'Opsional') + '</span>' +
                 '</div>' +
                 (ind.guide_notes ? '<p class="mod-ind-guide-box">' + escapeHtml(ind.guide_notes) + '</p>' : '') +
               '</div>' +
               '<div class="mod-ind-full-actions">';
        if (canEdit) {
          h += '<button type="button" class="mod-ref-item-edit btnConfigIndModal" data-id="' + escapeAttr(ind.id_indikator) + '" title="Edit butir">Edit</button>';
        }
        if (canDelete) {
          h += '<button type="button" class="btnDelInd" data-id="' + escapeAttr(ind.id_indikator) + '" title="Hapus butir" aria-label="Hapus butir">' +
                 '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 6h18M8 6V4h8v2m3 0-1 14H6L5 6m4 4v6m6-6v6"/></svg>' +
               '</button>';
        }
        h += '</div></div>';
      });
    }
    h += '</div></section></div>';

    document.getElementById("modRoot").innerHTML = h;

    if (moduleSettingsHandler) {
      document.querySelectorAll(".btnEditModModal").forEach(function(button){
        button.onclick = function(e){
          e.stopPropagation();
          moduleSettingsHandler(this.dataset.id, false);
        };
      });
    }
    if (moduleStatusHandler) {
      document.querySelectorAll(".btnQuickToggleStatus").forEach(function(button){
        button.onclick = function(e){
          e.stopPropagation();
          moduleStatusHandler(this.dataset.id);
        };
      });
    }

    var crumbRoot = document.getElementById("crumbCatalogRoot");
    if (crumbRoot) {
      crumbRoot.onclick = function(){
        currentModulId = null;
        renderModul();
        window.scrollTo({top: 0, behavior: 'smooth'});
      };
    }

    document.querySelectorAll(".btnOpenAddIndModal").forEach(function(btn){
      btn.onclick = function(){
        var bodyHtml = '<div style="display:flex;flex-direction:column;gap:12px">' +
          '<div>' +
            '<label for="newIndDesc" style="display:block;margin-bottom:5px;font-size:12px;font-weight:600;color:#334155">Nama Butir</label>' +
            '<textarea id="newIndDesc" required style="width:100%;min-height:72px;padding:9px 11px;border:1px solid #e2e8f0;border-radius:9px;font:inherit;font-size:12px;resize:vertical" placeholder="Masukkan nama atau uraian butir tagihan"></textarea>' +
          '</div>' +
          '<div>' +
            '<label for="newIndGuide" style="display:block;margin-bottom:5px;font-size:12px;font-weight:600;color:#334155">Keterangan Singkat</label>' +
            '<textarea id="newIndGuide" style="width:100%;min-height:56px;padding:9px 11px;border:1px solid #e2e8f0;border-radius:9px;font:inherit;font-size:12px;resize:vertical" placeholder="Opsional"></textarea>' +
          '</div>' +
          '<label style="display:inline-flex;align-items:center;gap:8px;font-size:12px;color:#475569">' +
            '<input type="checkbox" id="newIndMandatory" checked> Wajib dipenuhi PIC' +
          '</label>' +
        '</div>';
        openModal({
          title: "Tambah Butir Tagihan",
          body: bodyHtml,
          okText: "Simpan",
          cancelText: "Batal",
          width: "520px",
          onOk: function(){
            var desc = document.getElementById("newIndDesc").value.trim();
            var guide = document.getElementById("newIndGuide").value.trim();
            var isMandatory = document.getElementById("newIndMandatory").checked ? 1 : 0;
            if (!desc) {
              alert("Nama butir wajib diisi.");
              document.getElementById("newIndDesc").focus();
              return;
            }

            var fd = new FormData();
            fd.append('action', 'create_indikator');
            fd.append('id_modul', curMod.id_modul);
            fd.append('deskripsi_indikator', desc);
            fd.append('input_type', 'file');
            fd.append('guide_notes', guide);
            fd.append('is_mandatory', isMandatory);

            var saveButton = document.getElementById("mOk");
            if (saveButton) {
              saveButton.disabled = true;
              saveButton.textContent = "Menyimpan...";
            }
            fetch('ajax.php', { method: 'POST', body: fd }).then(function(r){ return r.json(); }).then(function(res){
              toast(res.message);
              if (res.success) {
                closeModal();
                fetchInit(function(){ renderModul(); });
              } else if (saveButton) {
                saveButton.disabled = false;
                saveButton.textContent = "Simpan";
              }
            }).catch(function(err){
              toast("Gagal menyimpan butir: " + err);
              if (saveButton) {
                saveButton.disabled = false;
                saveButton.textContent = "Simpan";
              }
            });
          }
        });
      };
    });

    document.querySelectorAll(".mod-ref-more-menu").forEach(function(menu){
      menu.onclick = function(){
        var actions = this.closest("details");
        if (actions) actions.open = false;
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

    function openModuleSettings(idMod, publishOnSave) {
      var curMod = STATE.moduls.find(function(m){ return String(m.id_modul) === String(idMod); });
      if (!curMod) return;

      var mThresh = curMod.scoring_threshold !== undefined && curMod.scoring_threshold !== null ? curMod.scoring_threshold : 80;
      var scheduleDeadline = curMod.schedule_tenggat_unggah ? String(curMod.schedule_tenggat_unggah).split(' ')[0] : '';
      var scheduleAssessment = curMod.schedule_mulai_penilaian ? String(curMod.schedule_mulai_penilaian).split(' ')[0] : '';
      var cycleOptions = ['Bulanan', 'Triwulan', 'Semester', 'Tahunan'].map(function(cycle){
        return '<option value="' + cycle + '" ' + ((curMod.schedule_siklus || 'Bulanan') === cycle ? 'selected' : '') + '>' + cycle + '</option>';
      }).join('');

      var formHtml = '<div style="font-size:13.5px">' +
        '<label style="display:block;margin-bottom:6px;font-weight:700">Nama Modul Pengawasan</label>' +
        '<input id="mEditModName" class="srch" style="width:100%;margin-bottom:14px;font-size:14px;padding:9px" value="' + escapeAttr(curMod.nama_modul) + '">' +
        '<label style="display:block;margin-bottom:6px;font-weight:700">Unit Kerja PIC Penanggung Jawab</label>' +
        '<select id="mEditModUnit" class="fl" style="width:100%;margin-bottom:14px;font-size:14px;padding:9px">' +
          STATE.units.map(function(u){
            return '<option value="' + u.id_unit + '" ' + (u.id_unit === curMod.id_unit_pic ? 'selected' : '') + '>' + escapeHtml(u.nama_unit) + '</option>';
          }).join('') +
        '</select>' +
        '<input type="hidden" id="mEditModType" value="document_verification">' +
        '<input type="hidden" id="mEditModThreshold" value="' + mThresh + '">' +
        '<label style="display:block;margin-bottom:6px;font-weight:700">Status Modul Pengawasan</label>' +
        '<select id="mEditModStatus" class="fl" style="width:100%;margin-bottom:14px;font-size:14px;padding:9px"' + (publishOnSave ? ' disabled' : '') + '>' +
          '<option value="terbit" ' + ((publishOnSave || curMod.status_template === 'terbit') ? 'selected' : '') + '>TERBIT (Aktif &amp; Siap Diisi PIC)</option>' +
          '<option value="draf" ' + ((!publishOnSave && curMod.status_template === 'draf') ? 'selected' : '') + '>DRAF (Penyusunan Internal SKI)</option>' +
        '</select>' +
        '<div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:12px;padding:12px 14px;margin-bottom:14px">' +
          '<div style="font-size:13px;font-weight:700;color:#075e57;margin-bottom:3px">Periode &amp; Jadwal Modul</div>' +
          '<p style="font-size:11.5px;color:var(--mut);margin:0 0 10px">Tanggal ini berlaku khusus untuk modul ' + escapeHtml(curMod.nama_modul) + '.</p>' +
          '<input type="hidden" id="mEditModScheduleId" value="' + escapeAttr(curMod.schedule_id_jadwal || '') + '">' +
          '<label style="display:block;margin-bottom:5px;font-size:12px;font-weight:600">Nama Periode</label>' +
          '<input id="mEditModPeriod" class="srch" maxlength="100" style="width:100%;margin-bottom:10px;font-size:13px;padding:8px 10px" value="' + escapeAttr(curMod.schedule_nama_periode || '') + '" placeholder="Contoh: November 2026">' +
          '<div class="grid g2" style="gap:10px">' +
            '<div><label style="display:block;margin-bottom:5px;font-size:12px;font-weight:600">Siklus</label><select id="mEditModCycle" class="fl" style="width:100%;font-size:13px;padding:8px 10px">' + cycleOptions + '</select></div>' +
            '<div><label style="display:block;margin-bottom:5px;font-size:12px;font-weight:600">Tenggat Unggah PIC (Auto-Lock)</label><input id="mEditModDeadline" type="date" class="srch" style="width:100%;font-size:13px;padding:8px 10px" value="' + escapeAttr(scheduleDeadline) + '"></div>' +
            '<div><label style="display:block;margin-bottom:5px;font-size:12px;font-weight:600">Mulai Penilaian SKI</label><input id="mEditModAssessment" type="date" class="srch" style="width:100%;font-size:13px;padding:8px 10px" value="' + escapeAttr(scheduleAssessment) + '"></div>' +
          '</div>' +
        '</div>' +
        '<label style="display:block;margin-bottom:6px;font-weight:700">Unggah / Ganti Berkas Template Acuan (Opsional)</label>' +
        (curMod.file_referensi ? '<div style="margin-bottom:6px;font-size:12.5px;color:var(--pri)">Berkas template saat ini: <b>' + escapeHtml(curMod.file_referensi) + '</b></div>' : '<div style="margin-bottom:6px;font-size:12.5px;color:var(--mut)">Belum ada berkas template acuan.</div>') +
        '<input type="file" id="mEditModFile" class="fl" style="width:100%;margin-bottom:12px" accept=".xlsx,.xls,.docx,.doc,.pdf,.csv,.zip,.pptx">' +
        '<p style="color:var(--mut);font-size:12px;margin:0">Pastikan format template baku sesuai dengan instrumen kepatuhan yang ditugaskan ke PIC.</p>' +
      '</div>';

      openModal({
        title: (publishOnSave ? "Terbitkan Modul: " : "Edit Modul: ") + curMod.nama_modul,
        body: formHtml,
        okText: publishOnSave ? "Terbitkan Jadwal" : "Simpan Perubahan",
        cancelText: "Batal",
        width: "700px",
        onOk: function(){
          var nm = document.getElementById("mEditModName").value.trim();
          var un = document.getElementById("mEditModUnit").value;
          var st = document.getElementById("mEditModStatus").value;
          var mt = document.getElementById("mEditModType").value;
          var th = document.getElementById("mEditModThreshold").value;
          var period = document.getElementById("mEditModPeriod").value.trim();
          var cycle = document.getElementById("mEditModCycle").value;
          var deadline = document.getElementById("mEditModDeadline").value;
          var assessment = document.getElementById("mEditModAssessment").value;
          var scheduleIdInput = document.getElementById("mEditModScheduleId");
          var fInp = document.getElementById("mEditModFile");
          var hasScheduleInput = !!(period || deadline || assessment);
          var hasSchedule = !!(period && deadline && assessment);
          if (!nm) { alert("Nama modul wajib diisi!"); return; }
          if (hasScheduleInput && !hasSchedule) {
            alert("Lengkapi nama periode, tenggat unggah, dan tanggal mulai penilaian.");
            return;
          }
          if (st === 'terbit' && curMod.status_template !== 'terbit' && !hasSchedule) {
            alert("Atur periode dan tanggal jadwal sebelum menerbitkan modul.");
            return;
          }

          var fd = new FormData();
          fd.append('action', 'update_modul');
          fd.append('id_modul', idMod);
          fd.append('nama_modul', nm);
          fd.append('id_unit_pic', un);
          fd.append('status_template', st);
          fd.append('module_type', mt);
          fd.append('scoring_threshold', th);
          if (hasSchedule) {
            fd.append('jadwal_id_jadwal', scheduleIdInput.value);
            fd.append('jadwal_periode', period);
            fd.append('jadwal_siklus', cycle);
            fd.append('jadwal_tenggat_unggah', deadline);
            fd.append('jadwal_mulai_penilaian', assessment);
          }
          if (fInp && fInp.files && fInp.files[0]) {
            fd.append('template_file', fInp.files[0]);
          }
          fetch('ajax.php', { method: 'POST', body: fd }).then(function(r){ return r.json(); }).then(function(res){
            toast(res.message);
            if (res.success) {
              closeModal();
              fetchInit(function(){ renderModul(); });
            }
          }).catch(function(err){
            alert("Terjadi kesalahan jaringan: " + err);
          });
        }
      });
    }

    moduleSettingsHandler = openModuleSettings;

    document.querySelectorAll(".btnEditModModal").forEach(function(b){
      b.onclick = function(e){
        e.stopPropagation();
        moduleSettingsHandler(this.dataset.id, false);
      };
    });

    function toggleModuleStatus(idMod) {
      var curMod = STATE.moduls.find(function(m){ return String(m.id_modul) === String(idMod); });
      if (!curMod) return;
      var nextSt = curMod.status_template === 'terbit' ? 'draf' : 'terbit';
      if (nextSt === 'terbit') {
        moduleSettingsHandler(idMod, true);
        return;
      }
      var fd = new FormData();
      fd.append('action', 'update_modul');
      fd.append('id_modul', idMod);
      fd.append('nama_modul', curMod.nama_modul);
      fd.append('id_unit_pic', curMod.id_unit_pic);
      fd.append('status_template', nextSt);
      fetch('ajax.php', { method: 'POST', body: fd }).then(function(r){ return r.json(); }).then(function(res){
        toast(res.message);
        if (res.success) fetchInit(function(){ renderModul(); });
      });
    }

    moduleStatusHandler = toggleModuleStatus;

    // Quick Toggle Status (Terbitkan / Drafkan)
    document.querySelectorAll(".btnQuickToggleStatus").forEach(function(b){
      b.onclick = function(e){
        e.stopPropagation();
        moduleStatusHandler(this.dataset.id);
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

    var rec = (STATE.rekomendasi || []).find(function(r){ return r.id_modul === m.id_modul; });
    var allApprovedByPim = totalInd > 0 && fulfilledCount === totalInd && modInds.every(function(ind){
      var ev = STATE.evidens.find(function(e){ return e.id_indikator === ind.id_indikator; });
      return ev && (ev.status_eviden === 'f' || ev.status_eviden === 's');
    });
    var isSelesai = allApprovedByPim || (rec && rec.keputusan_pimpinan === 'Disetujui' && fulfilledCount === totalInd && totalInd > 0);

    var isWaitingPimpinan = !isSelesai && totalInd > 0 && fulfilledCount === totalInd && modInds.every(function(ind){
      var ev = STATE.evidens.find(function(e){ return e.id_indikator === ind.id_indikator; });
      return ev && (ev.status_eviden === 'a' || ev.status_eviden === 'f' || ev.status_eviden === 's');
    });

    var isUnderReview = !isSelesai && !isWaitingPimpinan && totalInd > 0 && fulfilledCount === totalInd;

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
    } else if (isWaitingPimpinan) {
      statusKey = 'menunggu_pimpinan';
      badgeText = 'Menunggu Pimpinan';
      badgeClass = 'review';
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
    h += '<select class="dash-period-select" id="uplCatPeriodSel" aria-label="Pilih periode pengawasan">';
    h += '<option value="2026-10"' + (uplCatPeriod === '2026-10' ? ' selected' : '') + '>Oktober 2026 - Siklus Bulanan</option>';
    h += '<option value="2026-11"' + (uplCatPeriod === '2026-11' ? ' selected' : '') + '>November 2026 - Siklus Bulanan</option>';
    h += '<option value="2026-12"' + (uplCatPeriod === '2026-12' ? ' selected' : '') + '>Desember 2026 - Siklus Bulanan</option>';
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

    // Pipeline Workflow Calculation (PIC -> Anggota SKI -> Ketua SKI -> Pimpinan)
    var rec = (STATE.rekomendasi || []).find(function(r){ return r.id_modul === activeMod.id_modul; });
    var hasUnderReviewAnggota = allModInds.some(function(ind){
      var ev = STATE.evidens.find(function(e){ return e.id_indikator === ind.id_indikator; });
      return ev && ev.status_eviden === 'u';
    });
    var hasKetuaReview = allModInds.some(function(ind){
      var ev = STATE.evidens.find(function(e){ return e.id_indikator === ind.id_indikator; });
      return ev && ev.status_eviden === 'o';
    });
    var hasPimpinanReview = allModInds.some(function(ind){
      var ev = STATE.evidens.find(function(e){ return e.id_indikator === ind.id_indikator; });
      return ev && ev.status_eviden === 'a';
    });
    var allApproved = totalInd > 0 && fulfilledCount === totalInd && allModInds.every(function(ind){
      var ev = STATE.evidens.find(function(e){ return e.id_indikator === ind.id_indikator; });
      return ev && (ev.status_eviden === 'f' || ev.status_eviden === 's');
    });

    var picStatus = (totalInd > 0 && fulfilledCount === totalInd) ? 'done' : 'active';
    var angStatus = 'pending';
    var ketStatus = 'pending';
    var pimStatus = 'pending';

    if (allApproved || (rec && rec.keputusan_pimpinan === 'Disetujui')) {
      picStatus = 'done'; angStatus = 'done'; ketStatus = 'done'; pimStatus = 'done';
    } else if (hasPimpinanReview || (rec && rec.status_approval === 'diajukan_pimpinan')) {
      picStatus = 'done'; angStatus = 'done'; ketStatus = 'done'; pimStatus = 'active';
    } else if (hasKetuaReview || (rec && rec.status_approval === 'draf_ski')) {
      picStatus = 'done'; angStatus = 'done'; ketStatus = 'active'; pimStatus = 'pending';
    } else if (hasUnderReviewAnggota) {
      picStatus = 'done'; angStatus = 'active'; ketStatus = 'pending'; pimStatus = 'pending';
    } else if (picStatus === 'done') {
      angStatus = 'done'; ketStatus = 'active'; pimStatus = 'pending';
    }

    var h = '<div class="upl-container">';

    // 1. Secondary Toolbar: Breadcrumb + Search + View Switcher
    h += '<div class="upl-sub-bar">';
    h += '<div class="upl-breadcrumb">';
    h += '<button class="btn o sm" id="btnBackToUplCatalog" style="display:inline-flex;align-items:center;gap:6px;padding:5px 12px;font-size:12.5px;font-weight:700;border-radius:10px;background:#ffffff;border:1px solid #cbd5e1;color:#006a55;cursor:pointer">' +
         '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"></polyline></svg> Daftar Modul</button>';
    h += '<span class="upl-crumb-sep">/</span>';
    h += '<span class="upl-crumb-root" id="uplCrumbRoot" title="Klik untuk kembali ke Daftar Modul">' + (isSuperadmin ? 'Superadmin Eviden' : 'Eviden PIC') + '</span>';
    h += '<span class="upl-crumb-sep">›</span>';
    if (availableModuls.length > 1) {
      h += '<select class="upl-modul-select" id="uplModulSwitcher" style="border-radius:10px;padding:6px 12px;font-weight:700">';
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
    h += '<div class="upl-search-wrap" style="width:260px">';
    h += '<svg class="upl-search-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>';
    h += '<input type="text" class="upl-search-input" id="uplSearchBox" placeholder="Cari berkas atau indikator..." value="' + escapeAttr(uplSearchQuery) + '" style="border-radius:10px;padding:8px 12px 8px 34px">';
    h += '</div>';
    h += '<div class="upl-view-tabs">';
    h += '<button class="upl-view-btn ' + (uplActiveView === 'folder' ? 'on' : '') + '" id="uplBtnViewFolder" title="Tampilan Kartu">';
    h += '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg> Folder</button>';
    h += '<button class="upl-view-btn ' + (uplActiveView === 'daftar' ? 'on' : '') + '" id="uplBtnViewDaftar" title="Tampilan Tabel">';
    h += '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg> Daftar</button>';
    h += '</div>';
    h += '</div>';
    h += '</div>'; // end .upl-sub-bar

    // 2. Workspace 2-Column Grid Layout (Left: Main Workspace, Right: Activity & Users)
    h += '<div class="upl-workspace-layout">';

    // Left Column
    h += '<div class="upl-main-col">';

    // Hero Progress Card
    h += '<div class="upl-hero-card" style="background:#ffffff;border:1px solid #e2e8f0;border-radius:20px;padding:22px;box-shadow:0 4px 20px rgba(0,0,0,0.03);display:flex;flex-direction:column;gap:12px">';
    h += '<div class="upl-hero-top" style="display:flex;align-items:center;justify-content:space-between;gap:12px">';
    h += '<h2 class="upl-hero-title" style="margin:0;font-size:20px;font-weight:800;color:#0f172a;letter-spacing:-.3px">' + escapeAttr(activeMod.nama_modul) + '</h2>';
    h += '<div class="upl-badge-status ' + (isLocked ? 'kunci' : 'bebas') + '" style="border-radius:9999px;padding:4px 14px;font-size:12px;font-weight:700;display:inline-flex;align-items:center;gap:6px;' + (isLocked ? 'background:#f1f5f9;color:#475569' : 'background:#dcfce7;color:#166534') + '">';
    h += '<span class="upl-pulse-dot" style="width:7px;height:7px;border-radius:50%;' + (isLocked ? 'background:#64748b' : 'background:#16a34a') + '"></span> ' + (isLocked ? 'Terkunci' : 'Bebas diubah');
    h += '</div>';
    h += '</div>';

    h += '<div class="upl-hero-sub" style="font-size:13px;color:#64748b;margin-top:-2px">' +
         '<b style="color:#0f172a">' + fulfilledCount + ' Indikator Terpenuhi</b> • Batas Waktu: ' + tenggatStr + '</div>';

    // Full-width Progress Bar
    h += '<div class="upl-progress-track" style="height:10px;border-radius:9999px;background:#e2e8f0;overflow:hidden;margin:4px 0 6px">';
    h += '<div class="upl-progress-fill ' + (pct >= 100 ? 'done' : '') + '" style="height:100%;border-radius:9999px;background:#059669;width:' + pct + '%;transition:width .4s ease"></div>';
    h += '</div>';

    // Missing chips row
    h += '<div class="upl-missing-row" style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;font-size:12.5px;margin:2px 0">';
    h += '<span class="upl-missing-label" style="color:#64748b;font-weight:600">Yang masih kurang:</span>';
    if (missingInds.length > 0) {
      missingInds.forEach(function(mi){
        h += '<span class="upl-missing-chip" data-scroll-to="ind-' + mi.id_indikator + '" style="background:#fee2e2;color:#991b1b;padding:3px 10px;border-radius:9999px;font-size:11.5px;font-weight:600;cursor:pointer">' + escapeAttr(mi.deskripsi_indikator) + '</span>';
      });
    } else {
      h += '<span class="upl-all-done-chip" style="background:#dcfce7;color:#166534;border:1px solid #bbf7d0;padding:4px 14px;border-radius:9999px;font-size:12px;font-weight:600">Semua butir tagihan indikator telah terpenuhi</span>';
    }
    h += '</div>';

    // 4-Step Pipeline Stepper (PIC -> Anggota SKI -> Ketua SKI -> Pimpinan)
    h += '<div class="upl-pipeline-row">';
    
    // Step 1: PIC
    if (picStatus === 'done') {
      h += '<div class="upl-pipeline-step done"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg> PIC</div>';
    } else {
      h += '<div class="upl-pipeline-step active"><span style="display:inline-block;width:6px;height:6px;border-radius:50%;background:#b45309"></span> PIC</div>';
    }
    h += '<span class="upl-pipeline-arrow">→</span>';

    // Step 2: Anggota SKI
    if (angStatus === 'done') {
      h += '<div class="upl-pipeline-step done"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg> Anggota SKI</div>';
    } else if (angStatus === 'active') {
      h += '<div class="upl-pipeline-step active"><span style="display:inline-block;width:6px;height:6px;border-radius:50%;background:#b45309"></span> Anggota SKI</div>';
    } else {
      h += '<div class="upl-pipeline-step pending">Anggota SKI <span style="display:inline-block;width:6px;height:6px;border-radius:50%;border:1px solid #94a3b8"></span></div>';
    }
    h += '<span class="upl-pipeline-arrow">→</span>';

    // Step 3: Ketua SKI
    if (ketStatus === 'done') {
      h += '<div class="upl-pipeline-step done"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg> Ketua SKI</div>';
    } else if (ketStatus === 'active') {
      h += '<div class="upl-pipeline-step active"><span style="display:inline-block;width:6px;height:6px;border-radius:50%;background:#b45309"></span> Ketua SKI</div>';
    } else {
      h += '<div class="upl-pipeline-step pending">Ketua SKI <span style="display:inline-block;width:6px;height:6px;border-radius:50%;border:1px solid #94a3b8"></span></div>';
    }
    h += '<span class="upl-pipeline-arrow">→</span>';

    // Step 4: Pimpinan
    if (pimStatus === 'done') {
      h += '<div class="upl-pipeline-step done"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg> Pimpinan</div>';
    } else if (pimStatus === 'active') {
      h += '<div class="upl-pipeline-step active"><span style="display:inline-block;width:6px;height:6px;border-radius:50%;background:#0284c7"></span> Pimpinan</div>';
    } else {
      h += '<div class="upl-pipeline-step pending">Pimpinan <span style="display:inline-block;width:6px;height:6px;border-radius:50%;border:1px solid #94a3b8"></span></div>';
    }

    h += '</div>'; // end .upl-pipeline-row

    // Bulk Approval to Pimpinan Action Box
    if (pimStatus === 'done') {
      h += '<div class="upl-bulk-approval-card" style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:14px;padding:12px 18px;display:flex;align-items:center;gap:12px;margin-top:6px">';
      h += '<div style="width:36px;height:36px;border-radius:10px;background:#dcfce7;display:grid;place-items:center;color:#16a34a">';
      h += '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>';
      h += '</div>';
      h += '<div>';
      h += '<div style="font-size:13.5px;font-weight:800;color:#166534">Seluruh Eviden Telah Disetujui Pimpinan</div>';
      h += '<div style="font-size:11.5px;color:#475569;margin-top:2px">Kepala BBPK telah menetapkan dan menyetujui evaluasi kepatuhan untuk modul ini secara tuntas.</div>';
      h += '</div>';
      h += '</div>';
    } else if (pimStatus === 'active') {
      h += '<div class="upl-bulk-approval-card" style="background:#f0f9ff;border:1px solid #bae6fd;border-radius:14px;padding:12px 18px;display:flex;align-items:center;gap:12px;margin-top:6px">';
      h += '<div style="width:36px;height:36px;border-radius:10px;background:#e0f2fe;display:grid;place-items:center;color:#0284c7">';
      h += '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>';
      h += '</div>';
      h += '<div>';
      h += '<div style="display:flex;align-items:center;gap:8px">';
      h += '<span style="font-size:13.5px;font-weight:800;color:#0369a1">Berkas Berada di Meja Pimpinan</span>';
      h += '<span style="background:#e0f2fe;color:#0369a1;font-size:11px;font-weight:700;padding:2px 8px;border-radius:6px;border:1px solid #bae6fd">Menunggu Pengesahan</span>';
      h += '</div>';
      h += '<div style="font-size:11.5px;color:#475569;margin-top:2px">Seluruh eviden PIC telah diserahkan dan saat ini sedang ditelaah oleh Kepala BBPK Jakarta.</div>';
      h += '</div>';
      h += '</div>';
    } else if (fulfilledCount > 0 && STATE.user && (STATE.user.role === 'ang' || STATE.user.role === 'ket')) {
      h += '<div class="upl-bulk-approval-card" style="background:#f0fdfa;border:1px solid #99f6e4;border-radius:14px;padding:12px 18px;display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;margin-top:6px">';
      h += '<div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;flex:1">';
      h += '<div style="width:36px;height:36px;border-radius:10px;background:#ccfbf1;display:grid;place-items:center;color:#0f766e">';
      h += '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';
      h += '</div>';
      h += '<div>';
      h += '<div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap">';
      h += '<span style="font-size:13.5px;font-weight:800;color:#0f766e">Bulk Approval Eviden PIC</span>';
      h += '<span style="background:#ccfbf1;color:#115e59;font-size:11px;font-weight:700;padding:2px 8px;border-radius:6px;border:1px solid #99f6e4">' + fulfilledCount + ' Berkas Siap</span>';
      h += '</div>';
      h += '</div>';
      h += '</div>';
      h += '<button type="button" class="btn sm" id="btnBulkApproveToPimpinan" style="background:#006a55;color:#ffffff;border:none;border-radius:10px;padding:9px 18px;font-weight:700;font-size:12.5px;display:inline-flex;align-items:center;gap:8px;cursor:pointer;box-shadow:0 2px 8px rgba(0,106,85,0.25)">';
      h += '<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>';
      h += 'Bulk Approve &amp; Serahkan ke Pimpinan';
      h += '</button>';
      h += '</div>';
    }

    // Template row (Template Acuan dari SKI)
    var hasTpl = !!activeMod.file_referensi;
    h += '<div class="upl-template-row" style="background:#f8fafc;padding:12px 16px;border-radius:14px;border:1px solid #e2e8f0;margin-top:6px;display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;min-width:0;max-width:100%;box-sizing:border-box">';
    h += '<div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;flex:1">';
    h += '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#006a55" stroke-width="2"><path d="m21.44 11.05-9.19 9.19a6 6 0 0 1-8.49-8.49l8.57-8.57A4 4 0 1 1 18 8.84l-8.59 8.57a2 2 0 0 1-2.83-2.83l8.49-8.48"/></svg>';
    if (hasTpl) {
      h += '<div>';
      h += '<div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap">';
      h += '<span style="background:#dcfce7;color:#166534;font-size:11px;font-weight:700;padding:2px 8px;border-radius:6px;border:1px solid #bbf7d0">Template Tersedia</span>';
      h += '<span style="font-size:13px;color:#1e293b">Template format acuan dari SKI: <b>' + escapeAttr(activeMod.file_referensi) + '</b></span>';
      h += '</div>';
      h += '<div style="font-size:11.5px;color:#64748b;margin-top:2px">Unduh dan sesuaikan dokumen Anda dengan format acuan resmi dari Tim SKI.</div>';
      h += '</div>';
      h += '</div>';
      h += '<a href="uploads/templates/' + encodeURIComponent(activeMod.file_referensi) + '" download="' + escapeAttr(activeMod.file_referensi) + '" target="_blank" class="upl-btn-unduh" id="btnUnduhTemplate" style="text-decoration:none;border-color:#006a55;color:#006a55">';
      h += '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg> Unduh Template</a>';
    } else {
      h += '<div>';
      h += '<div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap">';
      h += '<span style="background:#fef3c7;color:#92400e;font-size:11px;font-weight:700;padding:2px 8px;border-radius:6px;border:1px solid #fde68a">Belum Ada Template Khusus</span>';
      h += '</div>';
      h += '<div style="font-size:11.5px;color:#64748b;margin-top:2px">PIC dapat menggunakan format laporan internal atau mengunduh template standar BBPK di samping.</div>';
      h += '</div>';
      h += '</div>';
      h += '<div style="display:flex;gap:6px;flex-wrap:wrap">';
      h += '<a href="uploads/templates/Form_bantu_LRA_LO_LPE_Neraca.xlsx" download="Form_Standar_BBPK.xlsx" class="upl-btn-unduh" style="text-decoration:none;border-color:#94a3b8;color:#334155">';
      h += '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg> Unduh Format Standar BBPK</a>';
      h += '</div>';
    }
    h += '</div>';

    h += '</div>'; // end .upl-hero-card

    // Views: Folder (Grid) vs Daftar (Table)
    if (uplActiveView === 'folder') {
      h += '<div class="upl-grid">';
      if (displayInds.length === 0) {
        h += '<div style="grid-column:1/-1;text-align:center;padding:36px;color:#64748b;background:#fff;border-radius:16px;border:1px dashed #cbd5e1">Tidak ada indikator yang sesuai dengan pencarian "<b>' + escapeAttr(uplSearchQuery) + '</b>"</div>';
      } else {
        displayInds.forEach(function(ind, idx){
          var ev = STATE.evidens.find(function(e){ return e.id_indikator === ind.id_indikator; });
          var st = ev ? ev.status_eviden : 'n';
          var isMand = parseInt(ind.is_mandatory) === 1;

          h += '<div class="upl-card" id="card-ind-' + ind.id_indikator + '" style="background:#ffffff;border:1px solid #e2e8f0;border-radius:18px;padding:18px;display:flex;flex-direction:column;gap:12px;box-shadow:0 2px 12px rgba(0,0,0,0.03);min-width:0;max-width:100%;box-sizing:border-box;overflow:hidden">';
          
          // Card Header: Number left, Banana / category icon right
          h += '<div style="display:flex;align-items:center;justify-content:space-between">';
          h += '<span style="font-size:18px;font-weight:800;color:#0f172a">1.' + (idx + 1) + '</span>';
          h += '</div>';

          // Description
          h += '<div style="font-size:13px;font-weight:600;color:#1e293b;line-height:1.4;overflow-wrap:anywhere;word-break:break-word">';
          h += escapeAttr(ind.deskripsi_indikator);
          if (isMand) h += ' <span style="color:#ef4444;font-size:10px;font-weight:700">* Wajib</span>';
          h += '</div>';

          // File / Structured Area
          h += '<div class="upl-file-area" style="min-width:0;max-width:100%;box-sizing:border-box">';
          if (!ev || st === 'n') {
            h += '<div class="upl-empty-box" style="width:100%;min-height:68px;border:1.5px dashed #cbd5e1;background:#f8fafc;border-radius:14px;display:grid;place-items:center;color:#94a3b8;font-size:12.5px;font-weight:500">';
            h += 'Belum diisi / diunggah';
            h += '</div>';
          } else {
            var parsed = parseEvidenNilai(ev);
            if (parsed) {
              h += '<div class="upl-structured-box" style="width:100%;max-width:100%;box-sizing:border-box;background:#f8fafc;border:1px solid #e2e8f0;border-radius:14px;padding:12px;overflow:hidden">';
              if (parsed._type === 'numeric') {
                h += '<div style="font-size:11px;font-weight:700;color:#006a55;text-transform:uppercase;margin-bottom:4px">Data Realisasi Kuantitatif</div>' +
                     '<div style="font-size:12px;color:#1e293b;overflow-wrap:anywhere"><b>Realisasi:</b> ' + formatRupiah(parsed.realisasi) + ' (' + (parsed.persen || 0) + '%)</div>';
              } else if (parsed._type === 'binary_score') {
                var isYa = parseInt(parsed.skor) === 1;
                h += '<div style="font-size:11px;font-weight:700;color:#006a55;text-transform:uppercase;margin-bottom:4px">Checklist KKR</div>' +
                     '<div><span class="tag ' + (isYa ? 't-ok' : 't-er') + '" style="font-size:11.5px;font-weight:700">' + (isYa ? 'YA (Memenuhi)' : 'TIDAK (Belum)') + '</span></div>';
              } else {
                h += '<div style="font-size:12px;color:#1e293b;overflow-wrap:anywhere"><b>Isian:</b> ' + escapeAttr(ev.nama_file) + '</div>';
              }
              if (ev.path_file && ev.path_file !== '#') {
                h += '<div style="margin-top:6px;font-size:11.5px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap"><button type="button" class="btnPreviewEviden" data-id="' + escapeAttr(ev.id_eviden) + '" style="border:0;background:none;padding:0;color:#006a55;font:inherit;font-weight:700;cursor:pointer;text-align:left">' + escapeAttr(ev.nama_file) + '</button></div>';
              }
              h += '</div>';
            } else {
              var isPdf = (ev.nama_file || '').toLowerCase().indexOf('.pdf') > -1;
              var isXls = (ev.nama_file || '').toLowerCase().indexOf('.xls') > -1;
              var strokeCol = isPdf ? '#ef4444' : (isXls ? '#10b981' : '#0284c7');

              h += '<div class="upl-file-box" style="width:100%;max-width:100%;box-sizing:border-box;background:#f8fafc;border:1px solid #e2e8f0;border-radius:14px;padding:10px 12px;display:flex;align-items:center;gap:12px;min-width:0;overflow:hidden">';
              h += '<div class="upl-file-icon" style="flex-shrink:0">';
              h += '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="' + strokeCol + '" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>';
              h += '</div>';
              h += '<div class="upl-file-meta" style="flex:1;min-width:0;max-width:100%;overflow:hidden">';
              h += '<button type="button" class="upl-file-name btnPreviewEviden" data-id="' + escapeAttr(ev.id_eviden) + '" title="' + escapeAttr(ev.nama_file) + '" style="font:inherit;text-align:left;border:0;background:none;padding:0;font-size:12.5px;font-weight:700;color:#0f172a;cursor:pointer;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;display:block;max-width:100%">';
              h += escapeAttr(ev.nama_file);
              h += '</button>';
              h += '<span class="upl-file-sub" style="font-size:11px;color:#64748b;margin-top:2px;display:block;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">v' + ev.versi + ' • ' + formatDateIndo(ev.waktu_unggah) + '</span>';
              h += '</div>';
              h += '</div>';
            }
          }
          h += '</div>';

          // Catatan SKI
          if (ev && ev.catatan_temuan) {
            h += '<div class="upl-finding-box" style="background:#fff1f2;color:#9f1239;border-left:3px solid #f43f5e;border-radius:8px;padding:6px 10px;font-size:11.5px;overflow-wrap:anywhere;word-break:break-word"><b>Catatan SKI:</b> ' + escapeAttr(ev.catatan_temuan) + '</div>';
          }

          // Status Badge
          h += '<div>';
          if (!ev || st === 'n') {
            h += '<span style="background:#fef3c7;color:#92400e;border:1px solid #fde68a;border-radius:8px;padding:3.5px 10px;font-size:11.5px;font-weight:700;display:inline-block">Belum Diunggah</span>';
          } else if (st === 'r') {
            h += '<span style="background:#ffe4e6;color:#9f1239;border:1px solid #fecdd3;border-radius:8px;padding:3.5px 10px;font-size:11.5px;font-weight:700;display:inline-block">Perlu Tindak Lanjut</span>';
          } else if (st === 'f' || st === 's') {
            h += '<span style="background:#dcfce7;color:#166534;border:1px solid #bbf7d0;border-radius:8px;padding:3.5px 10px;font-size:11.5px;font-weight:700;display:inline-block">Sesuai (Disetujui)</span>';
          } else {
            var waitTxt = (st === 'u' ? 'Menunggu Review' : (st === 'o' ? 'Menunggu Ketua SKI' : 'Menunggu Pimpinan'));
            h += '<span style="background:#dbeafe;color:#1e40af;border:1px solid #bfdbfe;border-radius:8px;padding:3.5px 10px;font-size:11.5px;font-weight:700;display:inline-block">' + waitTxt + '</span>';
          }
          h += '</div>';

          // Action Buttons
          h += '<div class="upl-card-actions" style="margin-top:auto;display:flex;align-items:center;gap:10px;flex-wrap:wrap">';
          if (isLocked) {
            h += '<span class="tag t-gy" style="font-size:11px">Terkunci (Jatuh Tempo)</span>';
          } else if (!ev || st === 'n') {
            h += '<button class="upl-btn-action upl-btn-unggah btnOpenUploadPopup" data-type="' + (ind.input_type || 'file') + '" data-ind="' + ind.id_indikator + '" data-jdw="' + (activeMod.id_jadwal || '') + '" data-mod="' + escapeAttr(activeMod.nama_modul) + '" data-desc="' + escapeAttr(ind.deskripsi_indikator) + '" data-cat="" style="background:#006a55;color:#ffffff;border:none;border-radius:8px;padding:6px 14px;font-weight:700;font-size:12px;cursor:pointer">Isi / Unggah</button>';
          } else if (st === 'r') {
            h += '<button class="upl-btn-action upl-btn-tindaklanjut btnOpenUploadPopup" data-type="' + (ind.input_type || 'file') + '" data-ind="' + ind.id_indikator + '" data-jdw="' + (activeMod.id_jadwal || '') + '" data-mod="' + escapeAttr(activeMod.nama_modul) + '" data-desc="' + escapeAttr(ind.deskripsi_indikator) + '" data-cat="' + escapeAttr(ev.catatan_temuan || '') + '" style="background:#006a55;color:#ffffff;border:none;border-radius:8px;padding:6px 14px;font-weight:700;font-size:12px;cursor:pointer">Tindak Lanjut</button>';
          } else {
            h += '<button class="upl-btn-action upl-btn-ganti btnOpenUploadPopup" data-type="' + (ind.input_type || 'file') + '" data-ind="' + ind.id_indikator + '" data-jdw="' + (activeMod.id_jadwal || '') + '" data-mod="' + escapeAttr(activeMod.nama_modul) + '" data-desc="' + escapeAttr(ind.deskripsi_indikator) + '" data-cat="" style="background:#ffffff;border:1px solid #cbd5e1;color:#1e293b;border-radius:8px;padding:5px 12px;font-weight:600;font-size:12px;cursor:pointer">Ubah Isian</button>';
            h += '<button class="btnDeleteEviden" data-ev="' + ev.id_eviden + '" data-file="' + escapeAttr(ev.nama_file) + '" style="background:none;border:none;color:#e11d48;font-weight:600;font-size:12px;cursor:pointer;padding:5px">Hapus</button>';
          }
          h += '</div>';

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

          h += '<td>';
          if (!ev || st === 'n') {
            h += '<span style="color:var(--mut)">Belum ada</span>';
          } else if (parsed) {
            if (parsed._type === 'numeric') {
              h += '<div><b>Pagu:</b> ' + formatRupiah(parsed.pagu) + ' · <b>Realisasi:</b> ' + formatRupiah(parsed.realisasi) + ' (' + (parsed.persen || 0) + '%)</div>';
            } else if (parsed._type === 'binary_score') {
              h += '<div><span class="tag ' + (parseInt(parsed.skor) === 1 ? 't-ok' : 't-er') + '">' + (parseInt(parsed.skor) === 1 ? 'YA (1)' : 'TIDAK (0)') + '</span> ' + escapeAttr(parsed.catatan || '') + '</div>';
            } else {
              h += '<div>' + escapeAttr(ev.nama_file) + '</div>';
            }
            if (ev.path_file && ev.path_file !== '#') {
              h += '<div style="margin-top:4px"><button type="button" class="btnPreviewEviden" data-id="' + escapeAttr(ev.id_eviden) + '" style="border:0;background:none;padding:0;color:var(--pri);font:inherit;font-size:11.5px;cursor:pointer;text-align:left">' + escapeAttr(ev.nama_file) + '</button></div>';
            }
          } else {
            h += '<button type="button" class="btnPreviewEviden" data-id="' + escapeAttr(ev.id_eviden) + '" style="border:0;background:none;padding:0;color:var(--pri);font:inherit;font-weight:600;cursor:pointer;text-align:left">' + escapeAttr(ev.nama_file) + '</button>';
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

    h += '</div>'; // end .upl-main-col

    // Right Column: Activity History & Active Users Panel
    h += '<aside class="upl-side-panel">';

    // Tabs: Semua | Upload | Aktivitas
    h += '<div class="upl-side-tabs">';
    h += '<button class="upl-side-tab-btn ' + (uplActivityTab === 'all' ? 'active' : '') + '" data-tab="all">Semua</button>';
    h += '<button class="upl-side-tab-btn ' + (uplActivityTab === 'upload' ? 'active' : '') + '" data-tab="upload">Upload</button>';
    h += '<button class="upl-side-tab-btn ' + (uplActivityTab === 'activity' ? 'active' : '') + '" data-tab="activity">Aktivitas</button>';
    h += '</div>';

    // Metadata untuk isolasi aktivitas modul
    var curModName = (activeMod.nama_modul || '').trim().toLowerCase();
    var curModId = (activeMod.id_modul || '').trim().toLowerCase();
    var curUnitId = (activeMod.id_unit || '').trim();
    var curTplName = (activeMod.file_referensi || '').trim().toLowerCase();

    var allModInds = (STATE.indikators || []).filter(function(i){ return i.id_modul === activeMod.id_modul; });
    var modIndIds = allModInds.map(function(i){ return i.id_indikator; });

    var modEvidens = (STATE.evidens || []).filter(function(e){ return modIndIds.indexOf(e.id_indikator) > -1; });
    var modFileNames = modEvidens.map(function(e){ return (e.nama_file || '').trim().toLowerCase(); }).filter(Boolean);

    // Filter audit logs: Terpisah per modul & tanpa login/logout/audit sistem
    var modAuditLogs = (STATE.audit || []).filter(function(a){
      var actLower = (a.jenis_aksi || '').trim().toLowerCase();
      var objLower = (a.objek_target || '').trim().toLowerCase();

      // Buang aktivitas login, logout, sesi, dan akun sistem secara mutlak
      if (actLower === 'login' || actLower === 'logout' || actLower.indexOf('login') > -1 || actLower.indexOf('logout') > -1) return false;
      if (objLower.indexOf('sistem monev ski') > -1 || objLower.indexOf('sesi') > -1 || objLower.indexOf('portal bbpk') > -1) return false;
      if (actLower.indexOf('rbac') > -1 || actLower.indexOf('pengguna') > -1 || actLower.indexOf('akun') > -1) return false;

      // Pastikan aktivitas terkait modul aktif ini
      var isThisModul = false;
      if (curModName && (objLower.indexOf(curModName) > -1 || actLower.indexOf(curModName) > -1)) {
        isThisModul = true;
      } else if (curModId && objLower.indexOf(curModId) > -1) {
        isThisModul = true;
      } else if (curTplName && objLower.indexOf(curTplName) > -1) {
        isThisModul = true;
      } else {
        for (var f = 0; f < modFileNames.length; f++) {
          if (modFileNames[f] && objLower.indexOf(modFileNames[f]) > -1) {
            isThisModul = true;
            break;
          }
        }
      }

      if (!isThisModul) return false;

      // Filter tab
      var isUploadAction = actLower.indexOf('upload') > -1 || actLower.indexOf('unggah') > -1 || actLower.indexOf('hapus') > -1 || actLower.indexOf('isian') > -1 || actLower.indexOf('tagihan') > -1;
      if (uplActivityTab === 'upload' && !isUploadAction) return false;
      if (uplActivityTab === 'activity' && isUploadAction) return false;

      return true;
    });

    // Section 1: Pengguna Aktif (Spesifik Pengguna yang Terlibat / Melihat Modul Ini)
    h += '<div class="upl-active-users-sec">';
    h += '<div class="upl-sec-subtitle">PENGGUNA AKTIF</div>';
    h += '<div class="upl-sec-title">Siapa saja yang melihat?</div>';
    h += '<div class="upl-avatar-stack">';

    var activeViewerList = [];
    var seenUsers = {};

    // User yang sedang membuka halaman saat ini
    if (STATE.user && STATE.user.nama) {
      activeViewerList.push({ name: STATE.user.nama, role: STATE.user.nama_role || 'User', id_role: STATE.user.role });
      seenUsers[STATE.user.nama.toLowerCase()] = true;
    }

    // User yang aktif di modul ini dari audit logs modul
    modAuditLogs.forEach(function(l){
      var nm = (l.nama_lengkap || '').trim();
      if (nm && !seenUsers[nm.toLowerCase()]) {
        seenUsers[nm.toLowerCase()] = true;
        activeViewerList.push({ name: nm, role: l.role_saat_aksi || 'User', id_role: '' });
      }
    });

    // PIC unit kerja modul ini
    (STATE.users || []).forEach(function(u){
      var nm = (u.nama_lengkap || '').trim();
      if (!nm || seenUsers[nm.toLowerCase()]) return;
      if (curUnitId && u.id_unit === curUnitId && u.id_role === 'pic') {
        seenUsers[nm.toLowerCase()] = true;
        activeViewerList.push({ name: nm, role: u.nama_role || 'PIC Unit', id_role: u.id_role });
      }
    });

    // Reviewer SKI (Ketua / Anggota)
    (STATE.users || []).forEach(function(u){
      var nm = (u.nama_lengkap || '').trim();
      if (!nm || seenUsers[nm.toLowerCase()]) return;
      if (u.id_role === 'ket' || u.id_role === 'ang') {
        seenUsers[nm.toLowerCase()] = true;
        activeViewerList.push({ name: nm, role: u.nama_role || 'Tim SKI', id_role: u.id_role });
      }
    });

    var roleColors = {
      'adm': '#006a55',
      'pic': '#006a55',
      'ang': '#8b5cf6',
      'ket': '#eab308',
      'pim': '#0284c7',
      'itj': '#059669'
    };
    var palette = ['#006a55', '#8b5cf6', '#059669', '#d97706', '#2563eb'];

    var displayAvatars = activeViewerList.slice(0, 4);
    displayAvatars.forEach(function(av, i){
      var initials = av.name.split(/\s+/).slice(0, 2).map(function(w){ return w[0]; }).join('').toUpperCase();
      var col = roleColors[av.id_role] || palette[i % palette.length];
      h += '<div class="upl-avatar-circle" style="background:' + col + '" title="' + escapeAttr(av.name) + ' (' + escapeAttr(av.role) + ')">' + initials + '</div>';
    });
    if (activeViewerList.length > 4) {
      var moreCount = activeViewerList.length - 4;
      h += '<div class="upl-avatar-circle" style="background:#64748b;font-size:11px">+' + moreCount + '</div>';
    }
    h += '</div>'; // end .upl-avatar-stack
    var remainingText = (activeViewerList.length > 4) ? ('+' + (activeViewerList.length - 4) + ' Orang Lainnya') : (activeViewerList.length + ' Pengguna Terlibat');
    h += '<div class="upl-avatar-more-text">' + remainingText + '</div>';
    h += '</div>'; // end .upl-active-users-sec

    // Section 2: Riwayat Aktivitas Modul
    h += '<div class="upl-timeline-sec">';
    h += '<div class="upl-sec-subtitle">RIWAYAT AKTIVITAS</div>';
    h += '<div class="upl-timeline-wrap">';

    // If Pimpinan, Ketua, or Anggota is currently reviewing, show highlighted on-progress box
    if (pimStatus === 'active') {
      h += '<div class="upl-timeline-item in-progress">';
      h += '<div class="upl-timeline-dot" style="background:#0284c7"></div>';
      h += '<div class="upl-timeline-box-highlight" style="background:#f0f9ff;border-color:#bae6fd">';
      h += '<div class="upl-timeline-head" style="color:#0369a1;display:flex;align-items:center;gap:6px">';
      h += '<span style="display:inline-block;width:7px;height:7px;border-radius:50%;background:#0284c7"></span>';
      h += 'Pimpinan / Kepala BBPK (On Progress) • Hari ini</div>';
      h += '<div class="upl-timeline-desc" style="color:#075985;font-weight:600">Sedang menelaah berkas pengesahan</div>';
      h += '</div>';
      h += '</div>';
    } else if (ketStatus === 'active') {
      h += '<div class="upl-timeline-item in-progress">';
      h += '<div class="upl-timeline-dot"></div>';
      h += '<div class="upl-timeline-box-highlight">';
      h += '<div class="upl-timeline-head" style="color:#92400e;display:flex;align-items:center;gap:6px">';
      h += '<span style="display:inline-block;width:7px;height:7px;border-radius:50%;background:#f59e0b"></span>';
      h += 'Ketua SKI (On Progress) • Hari ini, 09:30</div>';
      h += '<div class="upl-timeline-desc" style="color:#78350f;font-weight:600">Sedang meninjau</div>';
      h += '</div>';
      h += '</div>';
    } else if (angStatus === 'active') {
      h += '<div class="upl-timeline-item in-progress">';
      h += '<div class="upl-timeline-dot"></div>';
      h += '<div class="upl-timeline-box-highlight">';
      h += '<div class="upl-timeline-head" style="color:#92400e;display:flex;align-items:center;gap:6px">';
      h += '<span style="display:inline-block;width:7px;height:7px;border-radius:50%;background:#f59e0b"></span>';
      h += 'Anggota SKI (On Progress) • Hari ini</div>';
      h += '<div class="upl-timeline-desc" style="color:#78350f;font-weight:600">Sedang meninjau</div>';
      h += '</div>';
      h += '</div>';
    }

    if (modAuditLogs.length === 0) {
      h += '<div style="font-size:12px;color:#94a3b8;font-style:italic;padding:10px 0">Belum ada riwayat aktivitas pada modul ini.</div>';
    } else {
      modAuditLogs.slice(0, 10).forEach(function(l){
        var timeFormatted = l.timestamp_aktivitas ? l.timestamp_aktivitas.substr(5, 11).replace('-', '/') : '';
        try {
          var dt = new Date(l.timestamp_aktivitas.replace(/-/g, '/'));
          var months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
          var hh = ('0' + dt.getHours()).slice(-2);
          var mm = ('0' + dt.getMinutes()).slice(-2);
          timeFormatted = dt.getDate() + ' ' + months[dt.getMonth()] + ', ' + hh + ':' + mm;
        } catch(e) {}

        var actLow = (l.jenis_aksi || '').toLowerCase();
        var isDel = actLow.indexOf('hapus') > -1;
        var isView = actLow.indexOf('lihat') > -1 || actLow.indexOf('baca') > -1;
        var isAppr = actLow.indexOf('setuju') > -1 || actLow.indexOf('approval') > -1;
        var isRev = actLow.indexOf('revisi') > -1 || actLow.indexOf('tindak lanjut') > -1;
        var dotColor = isDel ? '#ef4444' : (isAppr ? '#10b981' : (isRev ? '#f59e0b' : (isView ? '#0284c7' : '#10b981')));

        var actDesc = l.jenis_aksi;
        if (actLow.indexOf('bulk approval') > -1) actDesc = 'Bulk Approval eviden & diserahkan ke Pimpinan';
        else if (actLow.indexOf('upload eviden baru') > -1) actDesc = 'Mengunggah berkas baru';
        else if (actLow.indexOf('upload perbaikan') > -1 || actLow.indexOf('perbaikan eviden') > -1) actDesc = 'Mengunggah perbaikan berkas';
        else if (actLow.indexOf('input isian') > -1) actDesc = 'Mengisi tagihan indikator';
        else if (actLow.indexOf('ubah isian') > -1) actDesc = 'Mengubah isian tagihan';
        else if (actLow.indexOf('hapus') > -1) actDesc = 'Menghapus berkas eviden';
        else if (actLow.indexOf('unduh template') > -1) actDesc = 'Mengunduh template acuan';
        else if (actLow.indexOf('melihat') > -1 || actLow.indexOf('membaca') > -1) actDesc = 'Membaca & memeriksa modul';
        else if (actLow.indexOf('setuju') > -1) actDesc = 'Membaca & menyetujui';
        else if (actLow.indexOf('revisi') > -1) actDesc = 'Meminta perbaikan / revisi';

        h += '<div class="upl-timeline-item">';
        h += '<div class="upl-timeline-dot" style="background:' + dotColor + '"></div>';
        h += '<div class="upl-timeline-head">' + escapeHtml(l.nama_lengkap || 'Pengguna') + ' (' + escapeHtml(l.role_saat_aksi || 'User') + ') • ' + escapeHtml(timeFormatted) + '</div>';
        h += '<div class="upl-timeline-desc">' + escapeHtml(actDesc) + '</div>';
        h += '</div>';
      });
    }

    h += '</div>'; // end .upl-timeline-wrap
    h += '</div>'; // end .upl-timeline-sec
    h += '</aside>'; // end .upl-side-panel

    h += '</div>'; // end .upl-workspace-layout

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

    // 8. Right side activity panel tab switching
    document.querySelectorAll(".upl-side-tab-btn").forEach(function(btn){
      btn.onclick = function(){
        uplActivityTab = this.dataset.tab;
        renderUploadDetail(activeMod, availableModuls);
      };
    });

    // 9. Log activity view modul eviden (baca / lihat)
    if (!uplLoggedViews[activeMod.id_modul]) {
      uplLoggedViews[activeMod.id_modul] = true;
      var fdV = new FormData();
      fdV.append('action', 'log_view_eviden');
      fdV.append('modul_name', activeMod.nama_modul || 'Eviden');
      fdV.append('target_name', activeMod.nama_modul || 'Modul Eviden');
      fdV.append('jenis_aksi', 'Membaca & Memeriksa Modul');
      fetch('ajax.php', { method: 'POST', body: fdV });
    }

    // Listener unduh template acuan
    var btnUnduhTpl = document.getElementById("btnUnduhTemplate");
    if (btnUnduhTpl) {
      btnUnduhTpl.onclick = function(){
        var fdT = new FormData();
        fdT.append('action', 'log_download_template');
        fdT.append('modul_name', activeMod.nama_modul || '');
        fdT.append('template_name', activeMod.file_referensi || '');
        fetch('ajax.php', { method: 'POST', body: fdT });
      };
    }

    // Listener Bulk Approve & Serahkan ke Pimpinan
    var btnBulkPim = document.getElementById("btnBulkApproveToPimpinan");
    if (btnBulkPim) {
      btnBulkPim.onclick = function(){
        var mName = activeMod.nama_modul || 'modul ini';
        if (!confirm("Konfirmasi Bulk Approval:\n\nSetujui seluruh berkas eviden PIC pada modul '" + mName + "' di tingkat SKI dan langsung serahkan ke Meja Pimpinan (Kepala BBPK) untuk pengesahan?")) return;
        btnBulkPim.disabled = true;
        btnBulkPim.innerHTML = '<span class="spinner" style="width:13px;height:13px;border:2px solid #fff;border-top-color:transparent;border-radius:50%;display:inline-block;animation:spin 1s linear infinite"></span> Memproses ke Pimpinan...';
        
        var fd = new FormData();
        fd.append('action', 'bulk_approve_pic_to_pimpinan');
        fd.append('id_modul', activeMod.id_modul);
        fd.append('id_jadwal', activeMod.id_jadwal || '');

        fetch('ajax.php', { method: 'POST', body: fd })
          .then(function(r){ return r.json(); })
          .then(function(res){
            toast(res.message);
            if (res.success) {
              fetchInit(function(){
                var m = STATE.moduls.find(function(item){ return item.id_modul === activeMod.id_modul; });
                if (m) renderUploadDetail(m, availableModuls);
              });
            } else {
              btnBulkPim.disabled = false;
              btnBulkPim.innerHTML = '<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg> Bulk Approve &amp; Serahkan ke Pimpinan';
            }
          }).catch(function(err){
            btnBulkPim.disabled = false;
            toast('Terjadi kesalahan koneksi.');
          });
      };
    }

    // 10. Real-time background sync interval
    if (uplRealtimeTimer) clearInterval(uplRealtimeTimer);
    uplRealtimeTimer = setInterval(function(){
      if (ACTIVE_SCREEN !== 'upl' || !uplSelectedModulId) {
        clearInterval(uplRealtimeTimer);
        uplRealtimeTimer = null;
        return;
      }
      var isModalOpen = document.querySelector(".modal-backdrop") || document.querySelector(".m-wrap") || document.querySelector(".modal-card") || document.getElementById("popupDropZone");
      var sBoxActive = document.getElementById("uplSearchBox");
      if (isModalOpen || (sBoxActive && document.activeElement === sBoxActive)) return;

      fetch('ajax.php?action=init_data')
        .then(function(r){ return r.json(); })
        .then(function(res){
          if (!res.success) return;
          STATE.moduls = res.moduls;
          STATE.indikators = res.indikators;
          STATE.evidens = res.evidens;
          STATE.rekomendasi = res.rekomendasi;
          STATE.audit = res.audit;
          var m = STATE.moduls.find(function(item){ return item.id_modul === uplSelectedModulId; });
          if (m) {
            renderUploadDetail(m, STATE.moduls.filter(function(x){ return x.status_template === 'terbit' && !!x.id_jadwal; }));
          }
        }).catch(function(){});
    }, 7000);
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
    var h = '<div class="tw"><table><tr><th>Nama Berkas</th><th>Modul Pengawasan</th><th>PIC &amp; Unit</th><th>Waktu Unggah</th><th>Status</th><th>Aksi</th></tr>';
    STATE.evidens.forEach(function(e){
      var isLink = isEvidenUrl(e.path_file) || e.format_file === 'link' || e.format_file === 'gdrive' || e.format_file === 'onedrive' || e.format_file === 'dropbox';
      var iconSymbol = '';
      var sizeOrLink = isLink ? ('Tautan ' + (e.format_file === 'gdrive' ? 'Google Drive' : (e.format_file === 'onedrive' ? 'OneDrive' : 'Cloud'))) : (e.ukuran_file_mb + ' MB');
      h += '<tr>';
      h += '<td><button type="button" class="btnPreviewEviden" data-id="' + escapeAttr(e.id_eviden) + '" style="border:0;background:none;padding:0;color:var(--pri);font:inherit;font-weight:600;cursor:pointer;text-align:left">' + iconSymbol + escapeAttr(e.nama_file) + '</button><br><small class="mut">v' + e.versi + ' · ' + sizeOrLink + '</small></td>';
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
                      '<button type="button" class="btn sm btnPreviewEviden" data-id="' + escapeAttr(e.id_eviden) + '" style="text-decoration:none">' + (isLink ? 'Pratinjau Tautan Google Drive / Cloud' : 'Pratinjau Dokumen') + '</button>' +
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
    var h = '';

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
      h += '<td><div style="display:flex;gap:6px;flex-wrap:wrap">' +
        '<button type="button" class="btn sm o btnPreviewEviden" data-id="' + escapeAttr(e.id_eviden) + '" style="display:inline-flex;justify-content:center;min-width:76px">Pratinjau</button>' +
        '<a class="btn sm" href="ajax.php?action=download_eviden&amp;id_eviden=' + encodeURIComponent(e.id_eviden) + '" download style="display:inline-flex;justify-content:center;min-width:60px;text-decoration:none">Unduh</a>' +
        '</div></td>';
      h += '</tr>';
    });
    h += '</table></div>';
    document.getElementById("repC").innerHTML = h;
  }

  // --- 7. REVIEW & CROSS-CHECK (Anggota SKI & Ketua SKI) ---
  function renderReview() {
    var allItems = STATE.evidens.filter(function(e){ return e.status_eviden !== 'n'; });
    var pendingItems = allItems.filter(function(e){ return e.status_eviden === 'u'; });
    var waitingPimItems = allItems.filter(function(e){ return e.status_eviden === 'a'; });
    var pimApprovedItems = allItems.filter(function(e){ return e.status_eviden === 'p'; });
    var selesaiItems = allItems.filter(function(e){ return e.status_eviden === 'f'; });
    var revisiItems = allItems.filter(function(e){ return e.status_eviden === 'r'; });
    var historyItems = allItems.filter(function(e){ return e.status_eviden !== 'u'; });
    var q = revSearchQuery.toLowerCase().trim();

    function matchesReviewFilters(e) {
      var matchQ = !q || (e.nama_modul || '').toLowerCase().indexOf(q) !== -1 ||
                         (e.deskripsi_indikator || '').toLowerCase().indexOf(q) !== -1 ||
                         (e.nama_file || '').toLowerCase().indexOf(q) !== -1 ||
                         (e.nama_pic || '').toLowerCase().indexOf(q) !== -1 ||
                         (e.nama_unit || '').toLowerCase().indexOf(q) !== -1;
      var matchMod = revModFilter === 'all' || e.id_modul === revModFilter;
      var matchUnit = revUnitFilter === 'all' || String(e.id_unit) === String(revUnitFilter);
      return matchQ && matchMod && matchUnit;
    }

    var bulkApproveItems = pendingItems.filter(matchesReviewFilters);

    var h = '';

    // Toolbar (Filter, Search, Tabs & Bulk Action)
    h += '<div class="rev-toolbar">' +
           '<div class="rev-tabs">' +
             '<button class="rev-tab-btn ' + (revFilterTab === 'pending' ? 'on' : '') + '" data-tab="pending">Antrean Review (' + pendingItems.length + ')</button>' +
             '<button class="rev-tab-btn ' + (revFilterTab === 'waiting_pim' ? 'on' : '') + '" data-tab="waiting_pim">Menunggu Pimpinan (' + waitingPimItems.length + ')</button>' +
             '<button class="rev-tab-btn ' + (revFilterTab === 'pim_approved' ? 'on' : '') + '" data-tab="pim_approved">Disetujui Pimpinan (' + pimApprovedItems.length + ')</button>' +
             '<button class="rev-tab-btn ' + (revFilterTab === 'selesai' ? 'on' : '') + '" data-tab="selesai">Selesai (' + selesaiItems.length + ')</button>' +
             '<button class="rev-tab-btn ' + (revFilterTab === 'revisi' ? 'on' : '') + '" data-tab="revisi">Perlu Revisi (' + revisiItems.length + ')</button>' +
             '<button class="rev-tab-btn ' + (revFilterTab === 'all' ? 'on' : '') + '" data-tab="all">Semua Berkas (' + allItems.length + ')</button>' +
           '</div>' +
           '<div class="rev-filter-group">' +
             '<div class="rev-search-box">' +
               '<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>' +
               '<input type="text" id="revSearchInp" placeholder="Cari modul, indikator, berkas, PIC..." value="' + escapeAttr(revSearchQuery) + '">' +
             '</div>' +
             '<select class="rev-select" id="revModSelect">' +
               '<option value="all">Semua Modul</option>' +
               STATE.moduls.map(function(m){ return '<option value="' + m.id_modul + '" ' + (revModFilter === m.id_modul ? 'selected' : '') + '>' + escapeHtml(m.nama_modul) + '</option>'; }).join('') +
             '</select>' +
             '<select class="rev-select" id="revUnitSelect">' +
               '<option value="all">Semua Unit</option>' +
               STATE.units.map(function(u){ return '<option value="' + u.id_unit + '" ' + (String(revUnitFilter) === String(u.id_unit) ? 'selected' : '') + '>' + escapeHtml(u.nama_unit) + '</option>'; }).join('') +
             '</select>' +
             (bulkApproveItems.length > 0 && (revFilterTab === 'pending' || revFilterTab === 'all') ? '<button class="rev-btn-bulk" id="btnBulkApproveAll" style="background:#006a55;color:#fff;font-weight:700">Setujui Semua Antrean (' + bulkApproveItems.length + ')</button>' : '') +
             (pimApprovedItems.length > 0 ? '<button class="rev-btn-bulk" id="btnBulkFinalSesuai" style="background:#006a55;color:#fff;font-weight:700" disabled>Selesaikan Terpilih (0)</button>' : '') +
             (pendingItems.length > 0 ? '<button class="rev-btn-bulk" id="btnBulkToPimpinanReview" style="background:#006a55;color:#fff;font-weight:700" disabled>⚡ Ajukan Terpilih ke Pimpinan (0)</button>' : '') +
           '</div>' +
         '</div>';

    // Filter displayed list
    var currentList = allItems;
    if (revFilterTab === 'pending') currentList = pendingItems;
    else if (revFilterTab === 'waiting_pim') currentList = waitingPimItems;
    else if (revFilterTab === 'pim_approved') currentList = pimApprovedItems;
    else if (revFilterTab === 'selesai') currentList = selesaiItems;
    else if (revFilterTab === 'revisi') currentList = revisiItems;
    else if (revFilterTab === 'history') currentList = historyItems;
    var filteredList = currentList.filter(matchesReviewFilters);
    var reviewViewLabels = {
      pending: 'Antrean Review',
      waiting_pim: 'Menunggu Pimpinan',
      pim_approved: 'Disetujui Pimpinan',
      selesai: 'Selesai',
      revisi: 'Perlu Revisi',
      all: 'Semua Berkas',
      history: 'Riwayat Berkas'
    };
    h += '<div class="rev-current-view">' +
           '<div class="rev-current-view-label"><span>Daftar yang sedang dibuka:</span><b>' + (reviewViewLabels[revFilterTab] || 'Semua Berkas') + '</b></div>' +
           '<span class="rev-current-view-count">' + filteredList.length + ' berkas ditampilkan</span>' +
         '</div>';

    // 4. Modul & Indikator Cards
    var visibleModuls = STATE.moduls.filter(function(m){
      var matchMod = revModFilter === 'all' || m.id_modul === revModFilter;
      var matchUnit = revUnitFilter === 'all' || String(m.id_unit_pic) === String(revUnitFilter);
      if (!matchMod || !matchUnit) return false;
      var modItems = filteredList.filter(function(e){ return e.id_modul === m.id_modul; });
      return modItems.length > 0;
    });

    if (visibleModuls.length === 0) {
      h += '<div class="rev-table-card" style="padding:48px 24px;text-align:center;color:var(--mut);background:#ffffff;border-radius:16px">' +
             '<div style="width:48px;height:48px;border-radius:50%;background:#f1f5f9;color:#64748b;display:grid;place-items:center;margin:0 auto 12px">' +
               '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>' +
             '</div>' +
             '<b style="font-size:15px;color:var(--dk);display:block;margin-bottom:4px">' +
               (revFilterTab === 'pending' ? 'Tidak ada antrean berkas yang menunggu review SKI saat ini.' :
                (revFilterTab === 'waiting_pim' ? 'Tidak ada berkas yang sedang menunggu persetujuan Pimpinan.' :
                 (revFilterTab === 'pim_approved' ? 'Tidak ada berkas yang telah disetujui Pimpinan yang belum diselesaikan.' :
                  (revFilterTab === 'selesai' ? 'Belum ada berkas yang selesai.' :
                   (revFilterTab === 'revisi' ? 'Tidak ada berkas yang dalam status revisi PIC.' :
                    'Tidak ada modul atau berkas yang cocok dengan filter pencarian.'))))) +
             '</b>' +
             '<small>' + (revFilterTab === 'pending' ? 'Semua berkas yang masuk telah selesai dievaluasi atau belum ada unggahan baru dari PIC.' :
                         (revFilterTab === 'waiting_pim' ? 'Semua berkas yang diajukan SKI telah dievaluasi oleh Pimpinan.' :
                         'Coba ubah kata kunci pencarian atau bersihkan filter di atas.')) + '</small>' +
           '</div>';
    } else {
      h += '<div class="rev-moduls-container" style="display:flex;flex-direction:column;gap:20px">';

      visibleModuls.forEach(function(m){
        var modIndikators = (STATE.indikators || []).filter(function(i){ return i.id_modul === m.id_modul; });
        var totalInd = modIndikators.length || parseInt(m.total_indikator) || 1;
        var allModEvidens = allItems.filter(function(e){ return e.id_modul === m.id_modul; });
        var selesaiCount = allModEvidens.filter(function(e){ return e.status_eviden === 'f'; }).length;
        var pimApprovedModCount = allModEvidens.filter(function(e){ return e.status_eviden === 'p'; }).length;
        var waitingPimModCount = allModEvidens.filter(function(e){ return e.status_eviden === 'a'; }).length;
        var pendingReviewModCount = allModEvidens.filter(function(e){ return e.status_eviden === 'u'; }).length;
        var pctDone = Math.min(100, Math.round((selesaiCount / totalInd) * 100));

        var modItemsToShow = filteredList.filter(function(e){ return e.id_modul === m.id_modul; });

        h += '<div class="apr-modul-card" id="cardModul_' + m.id_modul + '" style="background:#fff;border:1px solid #ccfbf1;border-radius:18px;padding:20px;box-shadow:0 4px 16px rgba(0,106,85,0.04);display:flex;flex-direction:column;gap:16px">';

        // 1. Header Modul Pengawasan & Progres
        h += '<div class="apr-modul-top" style="display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:12px;padding-bottom:12px;border-bottom:1px solid #f0fdfa">' +
               '<div style="flex:1;min-width:260px">' +
                 '<div style="display:flex;align-items:center;gap:8px;margin-bottom:4px">' +
                   '<span style="background:#006a55;color:#fff;font-size:10.5px;font-weight:700;padding:2px 8px;border-radius:6px;text-transform:uppercase">MODUL PENGAWASAN</span>' +
                   '<span class="tag t-in" style="font-size:11px;font-weight:600">' + escapeHtml(m.nama_unit || 'Unit PIC') + '</span>' +
                   (m.is_locked == 1 ? '<span class="tag t-er" style="font-size:10.5px">Terkunci</span>' : '<span class="tag t-ok" style="font-size:10.5px">Aktif</span>') +
                 '</div>' +
                 '<h3 style="margin:0 0 4px;font-size:16.5px;font-weight:800;color:#006a55">' + escapeHtml(m.nama_modul) + '</h3>' +
                 '<div style="font-size:12px;color:#64748b">' +
                   'Tenggat Unggah: <b>' + (m.tenggat_unggah ? formatDateIndo(m.tenggat_unggah) : 'Sesuai Jadwal') + '</b>' +
                 '</div>' +
               '</div>' +
               '<div style="text-align:right;min-width:200px">' +
                 '<div style="display:flex;align-items:center;justify-content:flex-end;gap:6px;margin-bottom:4px">';

        if (pimApprovedModCount > 0) {
          h += '<span class="tag t-ok" style="font-weight:700;font-size:11.5px">' + pimApprovedModCount + ' Disetujui Pimpinan</span>';
        } else if (waitingPimModCount > 0) {
          h += '<span class="tag t-pk" style="font-weight:700;font-size:11.5px">' + waitingPimModCount + ' Menunggu Pimpinan</span>';
        } else if (pendingReviewModCount > 0) {
          h += '<span class="tag t-bl" style="font-size:11px">' + pendingReviewModCount + ' Menunggu Review SKI</span>';
        } else if (selesaiCount === totalInd && totalInd > 0) {
          h += '<span class="tag t-ok" style="font-weight:700;font-size:11.5px">✓ Selesai / Tuntas</span>';
        } else {
          h += '<span class="tag t-gy" style="font-size:11px">Berjalan</span>';
        }

        h +=     '</div>' +
                 '<div style="font-size:12px;font-weight:700;color:#0f172a">' + selesaiCount + ' / ' + totalInd + ' Indikator Selesai (' + pctDone + '%)</div>' +
                 '<div style="width:100%;height:6px;background:#e2e8f0;border-radius:4px;overflow:hidden;margin-top:4px">' +
                   '<div style="width:' + pctDone + '%;height:100%;background:#10b981;border-radius:4px"></div>' +
                 '</div>' +
               '</div>' +
             '</div>';

        // 2. Tabel Butir Indikator & Berkas Eviden Modul Ini
        h += '<div class="tw" style="margin:0;min-width:0;max-width:100%;border:1px solid #e2e8f0;border-radius:12px;overflow-x:auto;overflow-y:hidden;-webkit-overflow-scrolling:touch">' +
               '<table class="rev-table" style="margin:0">' +
                 '<thead><tr>' +
                   '<th style="width:36px"><input type="checkbox" class="cbModAll" data-mod="' + m.id_modul + '" title="Pilih semua berkas modul ini"></th>' +
                   '<th style="min-width:240px">BUTIR INDIKATOR</th>' +
                   '<th style="min-width:220px">DOKUMEN EVIDEN</th>' +
                   '<th style="min-width:160px">PENGUNGGAH &amp; WAKTU</th>' +
                   '<th style="min-width:180px">STATUS &amp; TEMUAN</th>' +
                   '<th style="min-width:180px;text-align:right">AKSI EVALUASI</th>' +
                 '</tr></thead><tbody>';

        modItemsToShow.forEach(function(e){
          var isRevisi = parseInt(e.versi) > 1;
          var isDone = e.status_eviden === 'f';
          var isPimApp = e.status_eviden === 'p';
          var isWaitPim = e.status_eviden === 'a';
          var isPending = e.status_eviden === 'u';
          var isRevisiPic = e.status_eviden === 'r';

          var statusLabel = SS[e.status_eviden] ? SS[e.status_eviden][0] : e.status_eviden;
          var statusClass = SS[e.status_eviden] ? SS[e.status_eviden][1] : 't-gy';

          if (isDone) {
            statusLabel = 'Selesai (Disetujui)';
            statusClass = 't-ok';
          } else if (isPimApp) {
            statusLabel = 'Disetujui Pimpinan';
            statusClass = 't-ok';
          } else if (isWaitPim) {
            statusLabel = 'Menunggu Pimpinan';
            statusClass = 't-pk';
          } else if (isRevisiPic) {
            statusLabel = 'Perlu Revisi PIC';
            statusClass = 't-er';
          } else {
            statusLabel = 'Menunggu Review SKI';
            statusClass = 't-bl';
          }

          var isLink = isEvidenUrl(e.path_file) || e.format_file === 'link' || e.format_file === 'gdrive' || e.format_file === 'onedrive' || e.format_file === 'dropbox';
          var sizeOrLink = isLink ? ('Tautan ' + (e.format_file === 'gdrive' ? 'Google Drive' : (e.format_file === 'onedrive' ? 'OneDrive' : 'Cloud'))) : (e.ukuran_file_mb + ' MB');

          h += '<tr>';
          h += '<td><input type="checkbox" class="cbRevItem" data-id="' + e.id_eviden + '" data-mod="' + m.id_modul + '" data-can-finalize="' + (isPimApp ? '1' : '0') + '" data-status="' + e.status_eviden + '"></td>';
          h += '<td>' +
                 '<div style="color:var(--tx);font-size:13px;font-weight:600;line-height:1.4">' + escapeHtml(e.deskripsi_indikator) + '</div>' +
                 '<span class="tag t-in" style="font-size:10px;margin-top:4px">' + escapeHtml(e.nama_unit || '-') + '</span>' +
               '</td>';
          h += '<td>' +
                 '<div style="display:flex;align-items:center;gap:6px;min-width:0;max-width:100%">' +
                   '<a href="javascript:void(0)" class="rev-file-link btnOpenDetailCard" data-id="' + e.id_eviden + '" title="' + escapeAttr(e.nama_file) + '">' +
                     getFileIconSvg(e.nama_file, e.format_file, e.path_file) +
                     '<span>' + escapeAttr(e.nama_file) + '</span>' +
                   '</a>' +
                   '<button type="button" class="btnOpenDetailCard" data-id="' + e.id_eviden + '" style="border:1px solid #cbd5e1;background:#fff;color:#006a55;display:inline-flex;align-items:center;gap:4px;padding:4px 8px;border-radius:7px;cursor:pointer;font:inherit;font-size:11px;font-weight:700;white-space:nowrap" title="Lihat berkas ini di aplikasi">' +
                     '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6-10-6-10-6z"/><circle cx="12" cy="12" r="3"/></svg><span>Lihat</span>' +
                   '</button>' +
                 '</div>' +
                 '<div style="font-size:11px;color:var(--mut);margin-top:3px">' +
                   sizeOrLink + ' · <span class="tag ' + (isRevisi ? 't-pu' : 't-gy') + '" style="font-size:9.5px;padding:1px 5px">' + (isRevisi ? 'Versi ' + e.versi + ' (Revisi)' : 'Versi 1') + '</span>' +
                 '</div>' +
               '</td>';
          h += '<td>' +
                 '<b>' + escapeHtml(e.nama_pic) + '</b>' +
                 '<div style="font-size:11px;color:var(--mut);margin-top:2px">' + formatDateIndo(e.waktu_unggah) + '</div>' +
               '</td>';
          h += '<td>' +
                 '<span class="tag ' + statusClass + '">' + statusLabel + '</span>' +
                 (e.catatan_temuan ? '<div style="margin-top:4px;font-size:11px;color:#92400e;background:#fef3c7;padding:3px 7px;border-radius:5px;line-height:1.3;max-width:240px"><b>Temuan:</b> ' + escapeHtml(e.catatan_temuan) + '</div>' : '') +
               '</td>';
          h += '<td style="text-align:right">';
          if (isDone) {
            h += '<div class="rev-actions-wrap" style="justify-content:flex-end">' +
                   '<button class="btn o sm btnOpenDetailCard" data-id="' + e.id_eviden + '" style="font-size:11.5px;color:#006a55;border-color:#006a55;font-weight:600">Lihat Berkas</button>' +
                   '<span class="tag t-ok" style="font-size:11px;font-weight:700">Selesai</span>' +
                 '</div>';
          } else if (isPimApp) {
            h += '<div class="rev-actions-wrap" style="justify-content:flex-end">' +
                   '<button class="btn o sm btnOpenDetailCard" data-id="' + e.id_eviden + '" style="font-size:11.5px;color:#006a55;border-color:#006a55;font-weight:600">Lihat Berkas</button>' +
                   '<button class="rev-btn-quick-ok btnQuickFinalSesuai" data-id="' + e.id_eviden + '" title="Pimpinan telah menyetujui berkas ini. Klik Selesai untuk menyelesaikan status akhir berkas.">Selesai</button>' +
                 '</div>';
          } else if (isWaitPim) {
            h += '<div class="rev-actions-wrap" style="justify-content:flex-end">' +
                   '<button class="btn o sm btnOpenDetailCard" data-id="' + e.id_eviden + '" style="font-size:11.5px;color:#006a55;border-color:#006a55;font-weight:600">Lihat Berkas</button>' +
                   '<span class="tag t-pk" style="font-size:11px">Di Meja Pimpinan</span>' +
                 '</div>';
          } else if (isPending) {
            h += '<div class="rev-actions-wrap" style="justify-content:flex-end">' +
                   '<button class="btn o sm btnOpenDetailCard" data-id="' + e.id_eviden + '" style="font-size:11.5px;color:#006a55;border-color:#006a55;font-weight:600">Lihat Berkas</button>' +
                   '<button class="rev-btn-eval btnOpenEvalModal" data-id="' + e.id_eviden + '">Tinjau &amp; Nilai</button>' +
                 '</div>';
          } else {
            h += '<div class="rev-actions-wrap" style="justify-content:flex-end">' +
                   '<button class="btn o sm btnOpenDetailCard" data-id="' + e.id_eviden + '" style="font-size:11.5px;color:#006a55;border-color:#006a55;font-weight:600">Lihat Berkas</button>' +
                   '<button class="btn o sm btnOpenEvalModal" data-id="' + e.id_eviden + '" style="font-size:11.5px">Tinjau</button>' +
                 '</div>';
          }
          h += '</td>';
          h += '</tr>';
        });

        h += '</tbody></table></div>';

        // Footer Modul: Aksi jika ada berkas yang telah disetujui pimpinan
        if (pimApprovedModCount > 0) {
          h += '<div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;background:#f0fdf4;border:1px solid #bbf7d0;border-radius:12px;padding:12px 16px">' +
                 '<div>' +
                   '<b style="color:#166534;font-size:13px">✓ ' + pimApprovedModCount + ' Berkas Telah Disetujui Pimpinan</b>' +
                   '<div style="color:#15803d;font-size:12px">Kepala BBPK telah menyetujui berkas. Silakan tekan tombol Selesai untuk mengonfirmasi status akhir.</div>' +
                 '</div>' +
                 '<button type="button" class="btn sm btnFinalizeModul" data-mod="' + m.id_modul + '" style="background:#0a8f83;color:#fff;font-weight:700">' +
                   'Selesaikan Seluruh Berkas Modul Ini (Selesai)' +
                 '</button>' +
               '</div>';
        } else if (selesaiCount === totalInd && totalInd > 0) {
          h += '<div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:10px;padding:10px 14px;color:#166534;font-size:12.5px;font-weight:700">' +
                 '✓ Seluruh berkas dalam modul ini telah Selesai dan disetujui tuntas.' +
               '</div>';
        }

        h += '</div>'; // end apr-modul-card
      });

      h += '</div>'; // end rev-moduls-container
    }

    document.getElementById("revC").innerHTML = h;

    // Listener Selesaikan Seluruh Berkas Modul Ini (Sesuai)
    document.querySelectorAll(".btnFinalizeModul").forEach(function(btn){
      btn.onclick = function(){
        var modId = this.dataset.mod;
        var m = STATE.moduls.find(function(x){ return x.id_modul === modId; });
        var mName = m ? m.nama_modul : 'modul ini';
        if (!confirm("Pimpinan telah menyetujui berkas untuk '" + mName + "'. Nyatakan seluruh berkas dalam modul ini SELESAI dan tuntaskan alur approval?")) return;
        var fd = new FormData();
        fd.append('action', 'approve_ketua');
        fd.append('tipe', 'finalize_modul');
        fd.append('id_modul', modId);
        fetch('ajax.php', { method: 'POST', body: fd }).then(function(r){ return r.json(); }).then(function(res){
          toast(res.message);
          if (res.success) fetchInit(function(){ renderReview(); });
        });
      };
    });

    // Checkbox per modul (Pilih semua dalam modul)
    document.querySelectorAll(".cbModAll").forEach(function(cb){
      cb.onchange = function(){
        var modId = this.dataset.mod;
        var st = this.checked;
        document.querySelectorAll('.cbRevItem[data-mod="' + modId + '"]').forEach(function(c){
          c.checked = st;
        });
        updateBulkBtn();
      };
    });

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
      var canFinalizeChecked = [].filter.call(checked, function(c){ return c.dataset.canFinalize === '1'; });
      var count = canFinalizeChecked.length;
      var bulkBtn = document.getElementById("btnBulkFinalSesuai");
      if (bulkBtn) {
        bulkBtn.textContent = "Selesaikan Terpilih (Selesai) (" + count + ")";
        bulkBtn.disabled = (count === 0);
      }

      var canPimChecked = [].filter.call(checked, function(c){ return c.dataset.status === 'u' || c.dataset.status === 'o' || c.dataset.status === 'r'; });
      var countPim = canPimChecked.length;
      var bulkPimBtn = document.getElementById("btnBulkToPimpinanReview");
      if (bulkPimBtn) {
        bulkPimBtn.textContent = "⚡ Ajukan Terpilih ke Pimpinan (" + countPim + ")";
        bulkPimBtn.disabled = (countPim === 0);
      }
    }

    var btnBulkApproveAll = document.getElementById("btnBulkApproveAll");
    if (btnBulkApproveAll) {
      btnBulkApproveAll.onclick = function(){
        var ids = bulkApproveItems.map(function(e){ return e.id_eviden; });
        if (!ids.length) return;
        if (!confirm("Setujui dan ajukan semua " + ids.length + " berkas yang sesuai filter ke Pimpinan? Pastikan seluruh eviden sudah diperiksa.")) return;

        var payload = ids.map(function(id){
          return {
            id_eviden: id,
            status: 'ok',
            catatan: 'Disetujui secara massal setelah review dan cross-check SKI.'
          };
        });
        var fd = new FormData();
        fd.append('action', 'submit_review');
        fd.append('reviews', JSON.stringify(payload));
        btnBulkApproveAll.disabled = true;
        btnBulkApproveAll.textContent = "Menyetujui...";
        fetch('ajax.php', { method: 'POST', body: fd })
          .then(function(r){
            if (!r.ok) throw new Error("Gagal mengirim persetujuan (" + r.status + ").");
            return r.json();
          })
          .then(function(res){
            toast(res.message);
            if (res.success) {
              fetchInit(function(){ renderReview(); });
            } else {
              btnBulkApproveAll.disabled = false;
              btnBulkApproveAll.textContent = "Setujui Semua Antrean (" + ids.length + ")";
            }
          })
          .catch(function(error){
            btnBulkApproveAll.disabled = false;
            btnBulkApproveAll.textContent = "Setujui Semua Antrean (" + ids.length + ")";
            toast(error.message || "Terjadi kesalahan saat menyetujui berkas.");
          });
      };
    }

    document.querySelectorAll(".cbRevItem").forEach(function(cb){
      cb.onchange = function(){
        var modId = this.dataset.mod;
        var modAll = document.querySelector('.cbModAll[data-mod="' + modId + '"]');
        if (modAll) {
          var allModCbs = document.querySelectorAll('.cbRevItem[data-mod="' + modId + '"]');
          modAll.checked = [].every.call(allModCbs, function(c){ return c.checked; });
        }
        updateBulkBtn();
      };
    });

    var btnBulkFinal = document.getElementById("btnBulkFinalSesuai");
    if (btnBulkFinal) {
      btnBulkFinal.onclick = function(){
        var checked = document.querySelectorAll(".cbRevItem:checked");
        var ids = [];
        checked.forEach(function(c){
          if (c.dataset.canFinalize === '1') ids.push(c.dataset.id);
        });
        if (!ids.length) {
          toast("Pilih berkas yang telah disetujui Pimpinan.");
          return;
        }
        if (!confirm("Nyatakan " + ids.length + " berkas terpilih sebagai SELESAI & Tuntas?")) return;
        var payload = ids.map(function(id){ return { id_eviden: id, status: 'final', catatan: 'Dinyatakan Selesai secara massal setelah disetujui Pimpinan.' }; });
        var fd = new FormData();
        fd.append('action', 'submit_review');
        fd.append('reviews', JSON.stringify(payload));
        fetch('ajax.php', { method: 'POST', body: fd }).then(function(r){ return r.json(); }).then(function(res){
          toast(res.message);
          if (res.success) fetchInit(function(){ renderReview(); });
        });
      };
    }

    var btnBulkPimRev = document.getElementById("btnBulkToPimpinanReview");
    if (btnBulkPimRev) {
      btnBulkPimRev.onclick = function(){
        var checked = document.querySelectorAll(".cbRevItem:checked");
        var ids = [];
        var modIds = {};
        checked.forEach(function(c){
          if (c.dataset.status === 'u' || c.dataset.status === 'o' || c.dataset.status === 'r') {
            ids.push(c.dataset.id);
            if (c.dataset.mod) modIds[c.dataset.mod] = true;
          }
        });
        if (!ids.length) {
          toast("Pilih berkas yang ingin diserahkan ke Pimpinan.");
          return;
        }
        var firstModId = Object.keys(modIds)[0] || '';
        if (!confirm("Setujui " + ids.length + " berkas eviden terpilih di tingkat SKI dan serahkan langsung ke Meja Pimpinan (Kepala BBPK)?")) return;
        var fd = new FormData();
        fd.append('action', 'bulk_approve_pic_to_pimpinan');
        fd.append('ids', JSON.stringify(ids));
        fd.append('id_modul', firstModId);
        fetch('ajax.php', { method: 'POST', body: fd }).then(function(r){ return r.json(); }).then(function(res){
          toast(res.message);
          if (res.success) fetchInit(function(){ renderReview(); });
        });
      };
    }

    // Quick single Sesuai / Selesai (hanya aktif setelah Pimpinan menyetujui)
    document.querySelectorAll(".btnQuickFinalSesuai").forEach(function(b){
      b.onclick = function(){
        var id = this.dataset.id;
        var e = STATE.evidens.find(function(x){ return x.id_eviden === id; });
        if (!e) return;
        if (!confirm("Pimpinan telah menyetujui berkas '" + e.nama_file + "'. Nyatakan SELESAI dan tuntaskan alur approval?")) return;
        var payload = [{ id_eviden: id, status: 'final', catatan: 'Dinyatakan Selesai setelah disetujui Pimpinan.' }];
        var fd = new FormData();
        fd.append('action', 'submit_review');
        fd.append('reviews', JSON.stringify(payload));
        fetch('ajax.php', { method: 'POST', body: fd }).then(function(r){ return r.json(); }).then(function(res){
          toast(res.message);
          if (res.success) fetchInit(function(){ renderReview(); });
        });
      };
    });

    // Tombol & Link Lihat Berkas (Membuka Tampilan Card Rincian Berkas, Modul & Status)
    document.querySelectorAll(".btnOpenDetailCard").forEach(function(b){
      b.onclick = function(evt){
        if (evt) evt.preventDefault();
        var id = this.dataset.id;
        var e = STATE.evidens.find(function(x){ return x.id_eviden === id; });
        if (!e) return;
        openDetailEvidenCard(e);
      };
    });

    // Open detailed review evaluation modal
    document.querySelectorAll(".btnOpenEvalModal").forEach(function(b){
      b.onclick = function(){
        var id = this.dataset.id;
        var e = STATE.evidens.find(function(x){ return x.id_eviden === id; });
        if (!e) return;
        openReviewModal(e);
      };
    });

    // Fungsi Menampilkan Detail Berkas, Modul, dan Status dalam Format CARD Komprehensif
    function getEmbeddableDocUrl(url) {
      if (!url) return '';
      if (/drive\.google\.com/i.test(url)) {
        var m = url.match(/\/d\/([a-zA-Z0-9_-]+)/);
        if (m && m[1]) return 'https://drive.google.com/file/d/' + m[1] + '/preview';
        var mId = url.match(/[?&]id=([a-zA-Z0-9_-]+)/);
        if (mId && mId[1]) return 'https://drive.google.com/file/d/' + mId[1] + '/preview';
      }
      return url;
    }

    // Fungsi Menampilkan Detail Berkas, Modul, dan Status dalam Format FULLPAGE & Interactive Viewer
    function openDetailEvidenCard(e) {
      if (!e) return;
      var fpv = document.getElementById("fullpageEvidenViewer");
      if (!fpv) return;

      var isRevisi = parseInt(e.versi) > 1;
      var isDone = e.status_eviden === 'f';
      var isPimApproved = e.status_eviden === 'p';
      var isWaitingPim = e.status_eviden === 'a';

      // Data Modul & Indikator
      var mod = (STATE.moduls || []).find(function(m){ return m.id_modul === e.id_modul; }) || {};
      var modIndicators = (STATE.indikators || []).filter(function(i){ return i.id_modul === e.id_modul; });
      var modEvidens = (STATE.evidens || []).filter(function(ev){ return ev.id_modul === e.id_modul; });

      var totalInd = modIndicators.length || parseInt(mod.total_indikator) || 1;
      var selesaiCount = modEvidens.filter(function(x){ return x.status_eviden === 'f'; }).length;

      // Deteksi Format Berkas
      var fileNameLower = (e.nama_file || '').toLowerCase();
      var pathLower = (e.path_file || '').toLowerCase();
      var formatLower = (e.format_file || '').toLowerCase();

      var isLink = isEvidenUrl(e.path_file) || formatLower === 'link' || formatLower === 'gdrive' || formatLower === 'onedrive' || formatLower === 'dropbox';
      var isPdf = (formatLower === 'pdf' || /\.pdf$/i.test(fileNameLower) || /\.pdf$/i.test(pathLower));
      var isDocx = (formatLower === 'docx' || formatLower === 'doc' || /\.docx?$/i.test(fileNameLower) || /\.docx?$/i.test(pathLower));
      var isXlsx = (formatLower === 'xlsx' || formatLower === 'xls' || formatLower === 'csv' || /\.(xlsx?|csv)$/i.test(fileNameLower) || /\.(xlsx?|csv)$/i.test(pathLower));
      var isImage = (['jpg', 'jpeg', 'png', 'webp', 'gif', 'svg'].indexOf(formatLower) !== -1 || /\.(png|jpe?g|webp|gif|svg)$/i.test(fileNameLower) || /\.(png|jpe?g|webp|gif|svg)$/i.test(pathLower));

      // 1. TOPBAR UPDATE
      document.getElementById("fpvFileName").textContent = e.nama_file || "Berkas Dokumen";
      document.getElementById("fpvPillModul").textContent = "Modul: " + (e.nama_modul || mod.nama_modul || "-");
      document.getElementById("fpvPillVersi").textContent = "v" + (e.versi || 1) + (isRevisi ? " (Revisi)" : "");

      var bSt = document.getElementById("fpvBadgeStatus");
      if (isDone) {
        bSt.textContent = "Selesai / Approved";
        bSt.style.background = "#dcfce7";
        bSt.style.color = "#15803d";
      } else if (isPimApproved) {
        bSt.textContent = "Disetujui Pimpinan";
        bSt.style.background = "#ccfbf1";
        bSt.style.color = "#0f766e";
      } else if (isWaitingPim) {
        bSt.textContent = "Menunggu Pimpinan";
        bSt.style.background = "#e0f2fe";
        bSt.style.color = "#0369a1";
      } else if (e.status_eviden === 'r') {
        bSt.textContent = "Perlu Revisi";
        bSt.style.background = "#ffe4e6";
        bSt.style.color = "#be123c";
      } else {
        bSt.textContent = "Menunggu Review SKI";
        bSt.style.background = "#dbeafe";
        bSt.style.color = "#1e40af";
      }

      // Slot Tombol Aksi di Topbar
      var actionSlot = document.getElementById("fpvCustomActionSlot");
      actionSlot.innerHTML = '';

      if (isPimApproved) {
        var btnFin = document.createElement("button");
        btnFin.type = "button";
        btnFin.className = "fpv-btn-cta";
        btnFin.style.background = "#16a34a";
        btnFin.style.color = "#ffffff";
        btnFin.innerHTML = '<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg><span>Selesaikan</span>';
        btnFin.onclick = function(){
          if (!confirm("Pimpinan telah menyetujui berkas '" + e.nama_file + "'. Nyatakan SELESAI dan tuntaskan alur approval?")) return;
          var payload = [{ id_eviden: e.id_eviden, status: 'final', catatan: 'Dinyatakan Selesai setelah disetujui Pimpinan.' }];
          var fd = new FormData();
          fd.append('action', 'submit_review');
          fd.append('reviews', JSON.stringify(payload));
          fetch('ajax.php', { method: 'POST', body: fd }).then(function(r){ return r.json(); }).then(function(res){
            toast(res.message);
            closeFullpageViewer();
            if (res.success) fetchInit(function(){ renderReview(); });
          });
        };
        actionSlot.appendChild(btnFin);
      }

      var canReview = (STATE.user && (STATE.user.role === 'ang' || STATE.user.role === 'ket' || STATE.user.role === 'adm' || can('rev', 's')));
      if (e.status_eviden === 'u' && canReview) {
        var btnEval = document.createElement("button");
        btnEval.type = "button";
        btnEval.className = "fpv-btn-cta";
        btnEval.innerHTML = '<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg><span>Tinjau &amp; Nilai</span>';
        btnEval.onclick = function(){
          closeFullpageViewer();
          setTimeout(function(){
            openReviewModal(e);
          }, 150);
        };
        actionSlot.appendChild(btnEval);
      }

      // 2. CANVAS TOOLBAR & VIEWER RENDERING
      var badgeFmt = document.getElementById("fpvFormatBadge");
      var sheetTabsContainer = document.getElementById("fpvSheetTabs");
      var viewerHint = document.getElementById("fpvViewerHint");
      var canvasBody = document.getElementById("fpvCanvasBody");

      sheetTabsContainer.innerHTML = '';
      viewerHint.textContent = '';
      canvasBody.innerHTML = '';

      if (isPdf) {
        badgeFmt.textContent = "PDF";
        badgeFmt.style.color = "#ef4444";
        viewerHint.textContent = "Pratinjau PDF Terintegrasi";
        canvasBody.innerHTML = '<iframe src="' + escapeAttr(e.path_file) + '" style="width:100%;height:100%;border:0;background:#334155" title="Pratinjau PDF"></iframe>';
      } else if (isDocx) {
        badgeFmt.textContent = "WORD (DOCX)";
        badgeFmt.style.color = "#3b82f6";
        viewerHint.textContent = "Pratinjau DOCX (hanya baca)";

        canvasBody.innerHTML = '<div class="fpv-docx-wrapper"><div id="fpvDocxTarget" class="docx-viewer"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;height:360px;color:#94a3b8"><div style="width:32px;height:32px;border:3px solid #cbd5e1;border-top-color:#006a55;border-radius:50%;animation:spin 1s linear infinite"></div><p style="margin-top:14px;font-size:13px;font-weight:600">Memuat dan merender isi berkas DOCX...</p></div></div></div>';

        var isDocxEditMode = false;
        var btnToggleEdit = document.getElementById("fpvBtnToggleEditDocx");
        var docxFmtBar = document.getElementById("fpvDocxFmtBar");
        var btnSaveDocx = document.getElementById("fpvBtnSaveDocx");
        var editDocxLabel = document.getElementById("fpvEditDocxLabel");

        function setDocxEditMode(enable) {
          isDocxEditMode = enable;
          var targetEl = document.getElementById("fpvDocxTarget");
          if (!targetEl) return;
          if (isDocxEditMode) {
            targetEl.contentEditable = "false";
            targetEl.focus();
            if (docxFmtBar) docxFmtBar.style.display = "inline-flex";
            if (btnSaveDocx) btnSaveDocx.style.display = "inline-flex";
            if (editDocxLabel) editDocxLabel.textContent = "Selesai Edit";
            if (btnToggleEdit) btnToggleEdit.style.background = "#006a55";
            toast("Mode Edit DOCX Aktif. Anda dapat langsung mengedit teks dan menyimpannya.");
          } else {
            targetEl.contentEditable = "false";
            if (docxFmtBar) docxFmtBar.style.display = "none";
            if (editDocxLabel) editDocxLabel.textContent = "Mode Edit";
            if (btnToggleEdit) btnToggleEdit.style.background = "";
          }
        }

        if (btnToggleEdit) {
          btnToggleEdit.onclick = function(){
            setDocxEditMode(!isDocxEditMode);
          };
        }

        // Formatting buttons
        var bBold = document.getElementById("fpvFmtBold");
        if (bBold) bBold.onclick = function(){ document.execCommand('bold', false, null); };
        var bItalic = document.getElementById("fpvFmtItalic");
        if (bItalic) bItalic.onclick = function(){ document.execCommand('italic', false, null); };
        var bUnder = document.getElementById("fpvFmtUnderline");
        if (bUnder) bUnder.onclick = function(){ document.execCommand('underline', false, null); };
        var bH2 = document.getElementById("fpvFmtH2");
        if (bH2) bH2.onclick = function(){ document.execCommand('formatBlock', false, '<h2>'); };
        var bList = document.getElementById("fpvFmtList");
        if (bList) bList.onclick = function(){ document.execCommand('insertUnorderedList', false, null); };

        // Save DOCX button
        if (btnSaveDocx) {
          btnSaveDocx.onclick = function(){
            var targetEl = document.getElementById("fpvDocxTarget");
            if (!targetEl) return;
            if (!window.htmlDocx || typeof window.htmlDocx.asBlob !== "function") {
              alert("Modul html-docx belum siap dimuat di peramban. Silakan periksa koneksi internet.");
              return;
            }

            btnSaveDocx.disabled = true;
            btnSaveDocx.innerHTML = '<span>Menyimpan...</span>';

            try {
              var docHtml = '<!DOCTYPE html><html><head><meta charset="utf-8"><title>' + escapeHtml(e.nama_file || 'dokumen') + '</title>' +
                            '<style>body{font-family:Calibri,Arial,sans-serif;font-size:11pt;line-height:1.5;color:#1e293b;} table{border-collapse:collapse;width:100%;} th,td{border:1px solid #999;padding:6px;}</style>' +
                            '</head><body>' + targetEl.innerHTML + '</body></html>';

              var docxBlob = window.htmlDocx.asBlob(docHtml);
              var saveName = (e.nama_file || 'dokumen.docx');
              if (!/\.docx$/i.test(saveName)) saveName = saveName.replace(/\.[^.]+$/, '') + '.docx';

              var fd = new FormData();
              fd.append('action', 'save_edited_document');
              fd.append('id_eviden', e.id_eviden);
              fd.append('file', docxBlob, saveName);

              fetch('ajax.php', { method: 'POST', body: fd })
                .then(function(r){ return r.json(); })
                .then(function(res){
                  btnSaveDocx.disabled = false;
                  btnSaveDocx.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg><span>Simpan DOCX</span>';
                  toast(res.message);
                  if (res.success) {
                    e.path_file = res.new_path || e.path_file;
                    e.ukuran_file_mb = res.new_size || e.ukuran_file_mb;
                    e.nama_file = res.new_name || e.nama_file;
                    setDocxEditMode(false);
                    fetchInit();
                  }
                })
                .catch(function(err){
                  btnSaveDocx.disabled = false;
                  btnSaveDocx.innerHTML = '<span>Simpan DOCX</span>';
                  toast("Gagal menyimpan berkas: " + err.message);
                });
            } catch(ex) {
              btnSaveDocx.disabled = false;
              btnSaveDocx.innerHTML = '<span>Simpan DOCX</span>';
              alert("Terjadi kesalahan saat memproses dokumen: " + ex.message);
            }
          };
        }

        fetch(e.path_file)
          .then(function(res){
            if (!res.ok) throw new Error("Gagal mengambil file berkas (" + res.status + ")");
            return res.blob();
          })
          .then(function(blob){
            var targetEl = document.getElementById("fpvDocxTarget");
            if (!targetEl) return;
            if (window.docx && typeof window.docx.renderAsync === "function") {
              targetEl.innerHTML = '';
              window.docx.renderAsync(blob, targetEl, null, {
                className: "docx-inner-page",
                inWrapper: false,
                ignoreWidth: false,
                ignoreHeight: false
              }).then(function(){
                targetEl.contentEditable = "false";
              }).catch(function(err){
                targetEl.innerHTML = '<div style="padding:40px;text-align:center;color:#ef4444"><b style="font-size:15px">Gagal Merender DOCX</b><p style="margin-top:6px;font-size:12.5px;color:#64748b">' + escapeHtml(err.message) + '</p></div>';
              });
            } else {
              targetEl.innerHTML = '<div style="padding:40px;text-align:center;color:#475569"><b style="font-size:14px">Library DOCX belum siap dimuat.</b><p style="margin-top:6px;font-size:12.5px">Pratinjau DOCX tidak dapat ditampilkan sampai library tersedia.</p></div>';
            }
          })
          .catch(function(err){
            var targetEl = document.getElementById("fpvDocxTarget");
            if (targetEl) {
              targetEl.innerHTML = '<div style="padding:40px;text-align:center;color:#ef4444"><b style="font-size:15px">Gagal Memuat Berkas DOCX</b><p style="margin-top:6px;font-size:12.5px;color:#64748b">' + escapeHtml(err.message) + '</p></div>';
            }
          });
      } else if (isXlsx) {
        badgeFmt.textContent = "EXCEL (SPREADSHEET)";
        badgeFmt.style.color = "#10b981";
        viewerHint.textContent = "";

        // Toolbar Editor Excel
        var xlsxToolbarHtml = '<div style="display:inline-flex;align-items:center;gap:6px">' +
                                '<button type="button" class="fpv-btn-grid-tool" id="fpvBtnAddRowXlsx" title="Tambahkan baris kosong baru di bagian bawah tabel">' +
                                  '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>' +
                                  '<span>Baris</span>' +
                                '</button>' +
                                '<button type="button" class="fpv-btn-grid-tool" id="fpvBtnAddColXlsx" title="Tambahkan kolom baru di sebelah kanan tabel">' +
                                  '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>' +
                                  '<span>Kolom</span>' +
                                '</button>' +
                                '<button type="button" class="fpv-btn-save-doc" id="fpvBtnSaveXlsx" style="background:#107c41" title="Simpan perubahan tabel langsung ke berkas Excel di server">' +
                                  '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>' +
                                  '<span>Simpan Excel</span>' +
                                '</button>' +
                              '</div>';
        viewerHint.textContent = "Pratinjau Excel (hanya baca)";

        canvasBody.innerHTML = '<div id="fpvXlsxTarget" class="fpv-excel-scroll"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;height:360px;color:#94a3b8"><div style="width:32px;height:32px;border:3px solid #cbd5e1;border-top-color:#006a55;border-radius:50%;animation:spin 1s linear infinite"></div><p style="margin-top:14px;font-size:13px;font-weight:600">Membaca lembar kerja Excel...</p></div></div>';

        var activeWorkbook = null;
        var activeSheetName = "";

        fetch(e.path_file)
          .then(function(res){
            if (!res.ok) throw new Error("Gagal mengambil file Excel (" + res.status + ")");
            return res.arrayBuffer();
          })
          .then(function(buffer){
            var targetEl = document.getElementById("fpvXlsxTarget");
            if (!targetEl) return;
            if (!window.XLSX || typeof window.XLSX.read !== "function") {
              targetEl.innerHTML = '<div style="padding:40px;text-align:center;color:#475569"><b style="font-size:14px">Library Excel belum siap dimuat.</b><p style="margin-top:6px;font-size:12.5px">Pratinjau Excel tidak dapat ditampilkan sampai library tersedia.</p></div>';
              return;
            }

            activeWorkbook = window.XLSX.read(new Uint8Array(buffer), { type: 'array' });
            if (!activeWorkbook.SheetNames || activeWorkbook.SheetNames.length === 0) {
              targetEl.innerHTML = '<div style="padding:40px;text-align:center;color:#64748b">Lembar kerja spreadsheet kosong.</div>';
              return;
            }

            function showSheet(sName) {
              activeSheetName = sName;
              var ws = activeWorkbook.Sheets[sName];
              if (!ws) return;
              var tableHtml = window.XLSX.utils.sheet_to_html(ws, { editable: false });
              targetEl.innerHTML = tableHtml;
            }

            sheetTabsContainer.innerHTML = '';
            activeWorkbook.SheetNames.forEach(function(sName, sIdx){
              var tabBtn = document.createElement("button");
              tabBtn.type = "button";
              tabBtn.className = "fpv-sheet-tab" + (sIdx === 0 ? " active" : "");
              tabBtn.textContent = sName;
              tabBtn.onclick = function(){
                // Simpan sheet lama ke workbook sebelum pindah tab
                var curTbl = targetEl.querySelector("table");
                if (curTbl && activeSheetName && activeWorkbook) {
                  activeWorkbook.Sheets[activeSheetName] = window.XLSX.utils.table_to_sheet(curTbl);
                }
                sheetTabsContainer.querySelectorAll(".fpv-sheet-tab").forEach(function(t){ t.classList.remove("active"); });
                tabBtn.classList.add("active");
                showSheet(sName);
              };
              sheetTabsContainer.appendChild(tabBtn);
            });

            showSheet(activeWorkbook.SheetNames[0]);

            // Handler Tambah Baris
            var btnAddRow = document.getElementById("fpvBtnAddRowXlsx");
            if (btnAddRow) {
              btnAddRow.onclick = function(){
                var tbl = targetEl.querySelector("table");
                if (!tbl) return;
                var tbody = tbl.querySelector("tbody") || tbl;
                var rows = tbl.querySelectorAll("tr");
                var colCount = rows.length > 0 ? rows[0].children.length : 5;
                var newTr = document.createElement("tr");
                for (var ci = 0; ci < colCount; ci++) {
                  var newTd = document.createElement("td");
                  newTd.setAttribute("contenteditable", "false");
                  newTd.setAttribute("spellcheck", "false");
                  newTd.textContent = "";
                  newTr.appendChild(newTd);
                }
                tbody.appendChild(newTr);
                if (newTr.firstChild) newTr.firstChild.focus();
                toast("Baris baru ditambahkan ke tabel.");
              };
            }

            // Handler Tambah Kolom
            var btnAddCol = document.getElementById("fpvBtnAddColXlsx");
            if (btnAddCol) {
              btnAddCol.onclick = function(){
                var tbl = targetEl.querySelector("table");
                if (!tbl) return;
                var rows = tbl.querySelectorAll("tr");
                rows.forEach(function(tr, rIdx){
                  var newCell = (rIdx === 0 && tr.querySelector("th")) ? document.createElement("th") : document.createElement("td");
                  newCell.setAttribute("contenteditable", "false");
                  newCell.setAttribute("spellcheck", "false");
                  newCell.textContent = rIdx === 0 ? "Kolom Baru" : "";
                  tr.appendChild(newCell);
                });
                toast("Kolom baru ditambahkan ke tabel.");
              };
            }

            // Handler Simpan Excel
            var btnSaveXlsx = document.getElementById("fpvBtnSaveXlsx");
            if (btnSaveXlsx) {
              btnSaveXlsx.onclick = function(){
                var curTbl = targetEl.querySelector("table");
                if (!curTbl || !activeWorkbook || !activeSheetName) return;

                btnSaveXlsx.disabled = true;
                btnSaveXlsx.innerHTML = '<span>Menyimpan...</span>';

                try {
                  // Perbarui worksheet saat ini dari HTML table
                  var updatedWs = window.XLSX.utils.table_to_sheet(curTbl);
                  activeWorkbook.Sheets[activeSheetName] = updatedWs;

                  // Tulis seluruh workbook menjadi array biner
                  var wbOut = window.XLSX.write(activeWorkbook, { bookType: 'xlsx', type: 'array' });
                  var xlsxBlob = new Blob([wbOut], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });

                  var saveName = (e.nama_file || 'dokumen.xlsx');
                  if (!/\.xlsx$/i.test(saveName)) saveName = saveName.replace(/\.[^.]+$/, '') + '.xlsx';

                  var fd = new FormData();
                  fd.append('action', 'save_edited_document');
                  fd.append('id_eviden', e.id_eviden);
                  fd.append('file', xlsxBlob, saveName);

                  fetch('ajax.php', { method: 'POST', body: fd })
                    .then(function(r){ return r.json(); })
                    .then(function(res){
                      btnSaveXlsx.disabled = false;
                      btnSaveXlsx.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg><span>Simpan Excel</span>';
                      toast(res.message);
                      if (res.success) {
                        e.path_file = res.new_path || e.path_file;
                        e.ukuran_file_mb = res.new_size || e.ukuran_file_mb;
                        e.nama_file = res.new_name || e.nama_file;
                        fetchInit();
                      }
                    })
                    .catch(function(err){
                      btnSaveXlsx.disabled = false;
                      btnSaveXlsx.innerHTML = '<span>Simpan Excel</span>';
                      toast("Gagal menyimpan Excel: " + err.message);
                    });
                } catch(ex) {
                  btnSaveXlsx.disabled = false;
                  btnSaveXlsx.innerHTML = '<span>Simpan Excel</span>';
                  alert("Terjadi kesalahan saat memproses Excel: " + ex.message);
                }
              };
            }
          })
          .catch(function(err){
            var targetEl = document.getElementById("fpvXlsxTarget");
            if (targetEl) {
              targetEl.innerHTML = '<div style="padding:40px;text-align:center;color:#ef4444"><b style="font-size:15px">Gagal Membaca Berkas Excel</b><p style="margin-top:6px;font-size:12.5px;color:#64748b">' + escapeHtml(err.message) + '</p></div>';
            }
          });
      } else if (isImage) {
        badgeFmt.textContent = "GAMBAR";
        badgeFmt.style.color = "#f59e0b";
        viewerHint.textContent = "Pratinjau Gambar Penuh";
        canvasBody.innerHTML = '<div style="display:flex;align-items:center;justify-content:center;height:100%;padding:20px;background:#0f172a"><img src="' + escapeAttr(e.path_file) + '" style="max-width:100%;max-height:100%;object-fit:contain;border-radius:6px;box-shadow:0 8px 30px rgba(0,0,0,0.5)" alt="Pratinjau Eviden"></div>';
      } else if (isLink) {
        badgeFmt.textContent = "CLOUD LINK";
        badgeFmt.style.color = "#10b981";
        viewerHint.textContent = "Tautan Penyimpanan Awan";
        var embedUrl = getEmbeddableDocUrl(e.path_file);
        if (/drive\.google\.com/i.test(e.path_file)) {
          canvasBody.innerHTML = '<iframe src="' + escapeAttr(embedUrl) + '" style="width:100%;height:100%;border:0;background:#1e293b" allow="autoplay" title="Pratinjau Cloud"></iframe>';
        } else {
          canvasBody.innerHTML = '<div style="display:flex;flex-direction:column;align-items:center;justify-content:center;height:100%;padding:30px;text-align:center;color:#cbd5e1">' +
                                   '<div style="width:64px;height:64px;border-radius:16px;background:rgba(255,255,255,0.08);display:grid;place-items:center;margin-bottom:16px">' +
                                     '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#2dd4bf" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>' +
                                   '</div>' +
                                   '<h4 style="margin:0 0 6px;color:#fff;font-size:16px">Tautan Dokumen Eksternal</h4>' +
                                   '<p style="max-width:440px;color:#94a3b8;font-size:13px;word-break:break-all;margin:0 0 20px">' + escapeHtml(e.path_file) + '</p>' +
                                   '<span style="font-size:12px;color:#cbd5e1">Penyedia tautan ini tidak mendukung pratinjau tertanam.</span>' +
                                 '</div>';
        }
      } else {
        badgeFmt.textContent = String(e.format_file || 'BERKAS').toUpperCase();
        badgeFmt.style.color = "#94a3b8";
        canvasBody.innerHTML = '<div style="display:flex;flex-direction:column;align-items:center;justify-content:center;height:100%;padding:30px;text-align:center;color:#cbd5e1">' +
                                 '<div style="width:64px;height:64px;border-radius:16px;background:rgba(255,255,255,0.08);display:grid;place-items:center;margin-bottom:16px">' +
                                   '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>' +
                                 '</div>' +
                                 '<h4 style="margin:0 0 6px;color:#fff;font-size:16px">Berkas Dokumen (' + String(e.format_file).toUpperCase() + ')</h4>' +
                                 '<p style="max-width:440px;color:#94a3b8;font-size:13px;margin:0 0 20px">' + escapeHtml(e.nama_file) + '</p>' +
                                 '<span style="font-size:12px;color:#cbd5e1">Pratinjau untuk format ini belum didukung.</span>' +
                               '</div>';
      }

      // 3. SIDEBAR UPDATE (CLEAN & RINGKAS TANPA BANYAK TEKS)
      // Status Content
      var stContent = document.getElementById("fpvStatusContent");
      var stInner = '<div style="display:flex;align-items:center;justify-content:space-between;gap:8px;margin-bottom:6px">' +
                      '<span style="font-size:12px;color:#64748b;font-weight:600">Alur Kepatuhan:</span>' +
                      '<span style="font-weight:700;font-size:12px;' + (isDone ? 'color:#15803d' : (isPimApproved ? 'color:#0f766e' : (e.status_eviden === 'r' ? 'color:#be123c' : 'color:#1e40af'))) + '">' +
                        (isDone ? 'Selesai' : (isPimApproved ? 'Disetujui Pimpinan' : (isWaitingPim ? 'Di Pimpinan' : (e.status_eviden === 'r' ? 'Perlu Revisi' : 'Menunggu Review')))) +
                      '</span>' +
                    '</div>';

      if (e.catatan_temuan) {
        stInner += '<div style="background:#fffbeb;border:1px solid #fef3c7;border-radius:8px;padding:8px 10px;margin-top:8px;font-size:12px;color:#92400e">' +
                     '<b style="display:block;margin-bottom:2px;font-size:11px;color:#b45309">Catatan Evaluasi / Temuan:</b>' +
                     escapeHtml(e.catatan_temuan) +
                     (e.nama_reviewer ? '<div style="margin-top:4px;font-size:10.5px;color:#a16207">Oleh: ' + escapeHtml(e.nama_reviewer) + '</div>' : '') +
                   '</div>';
      }
      stContent.innerHTML = stInner;

      // Metadata Grid Ringkas
      var metaGrid = document.getElementById("fpvMetaGrid");
      metaGrid.innerHTML =
        '<div class="fpv-meta-item">' +
          '<span class="fpv-meta-label">Modul</span>' +
          '<div class="fpv-meta-value">' + escapeHtml(e.nama_modul || mod.nama_modul || '-') + '</div>' +
        '</div>' +
        '<div class="fpv-meta-item">' +
          '<span class="fpv-meta-label">Unit Kerja</span>' +
          '<div class="fpv-meta-value">' + escapeHtml(e.nama_unit || mod.nama_unit || '-') + '</div>' +
        '</div>' +
        '<div class="fpv-meta-item" style="grid-column:span 2">' +
          '<span class="fpv-meta-label">Butir Indikator</span>' +
          '<div class="fpv-meta-value">' + escapeHtml(e.deskripsi_indikator || '-') + '</div>' +
        '</div>' +
        '<div class="fpv-meta-item">' +
          '<span class="fpv-meta-label">Pengunggah</span>' +
          '<div class="fpv-meta-value">' + escapeHtml(e.nama_pic || '-') + '</div>' +
        '</div>' +
        '<div class="fpv-meta-item">' +
          '<span class="fpv-meta-label">Waktu Unggah</span>' +
          '<div class="fpv-meta-value">' + formatDateIndo(e.waktu_unggah) + '</div>' +
        '</div>' +
        '<div class="fpv-meta-item">' +
          '<span class="fpv-meta-label">Format / Ukuran</span>' +
          '<div class="fpv-meta-value">' + (isLink ? 'Cloud Link' : (String(e.format_file).toUpperCase() + ' · ' + (e.ukuran_file_mb || '0') + ' MB')) + '</div>' +
        '</div>' +
        '<div class="fpv-meta-item">' +
          '<span class="fpv-meta-label">Tenggat Modul</span>' +
          '<div class="fpv-meta-value">' + (mod.tenggat_unggah ? formatDateIndo(mod.tenggat_unggah) : 'Sesuai Jadwal') + '</div>' +
        '</div>';

      // Data Isian PIC Struktural
      var parsedVal = parseEvidenNilai(e);
      var cardStruct = document.getElementById("fpvCardStructured");
      var structBody = document.getElementById("fpvStructuredBody");
      if (parsedVal) {
        cardStruct.style.display = "block";
        var sHtml = '';
        if (parsedVal._type === 'numeric') {
          sHtml = '<div style="display:grid;grid-template-columns:1fr 1fr;gap:6px;font-size:11.5px">' +
                    '<div style="background:#f8fafc;padding:6px 8px;border-radius:6px;border:1px solid #e2e8f0"><span style="color:#64748b;font-size:10px">Pagu:</span><br><b>' + formatRupiah(parsedVal.pagu) + '</b></div>' +
                    '<div style="background:#f8fafc;padding:6px 8px;border-radius:6px;border:1px solid #e2e8f0"><span style="color:#64748b;font-size:10px">Realisasi:</span><br><b>' + formatRupiah(parsedVal.realisasi) + '</b></div>' +
                    '<div style="background:#f0fdf4;padding:6px 8px;border-radius:6px;border:1px solid #bbf7d0"><span style="color:#166534;font-size:10px">Capaian:</span><br><b style="color:#15803d">' + (parsedVal.persen || 0) + '%</b></div>' +
                    '<div style="background:#f8fafc;padding:6px 8px;border-radius:6px;border:1px solid #e2e8f0"><span style="color:#64748b;font-size:10px">Pegawai:</span><br><b>' + (parsedVal.pegawai || 0) + ' Org</b></div>' +
                  '</div>' +
                  (parsedVal.catatan ? '<div style="margin-top:6px;font-size:11.5px;color:#475569;background:#f8fafc;padding:6px 8px;border-radius:6px"><b>Uraian:</b> ' + escapeHtml(parsedVal.catatan) + '</div>' : '');
        } else if (parsedVal._type === 'binary_score') {
          var isYa = parseInt(parsedVal.skor) === 1;
          sHtml = '<span class="tag ' + (isYa ? 't-ok' : 't-er') + '" style="font-size:12px;font-weight:700">' + (isYa ? 'YA (Skor 1 - Memenuhi)' : 'TIDAK (Skor 0 - Belum Memenuhi)') + '</span>' +
                  (parsedVal.catatan ? '<div style="margin-top:6px;font-size:11.5px;color:#475569">' + escapeHtml(parsedVal.catatan) + '</div>' : '');
        } else if (parsedVal._type === 'pbj_matrix') {
          var countS = (parsedVal.kualitas ? 1 : 0) + (parsedVal.jumlah ? 1 : 0) + (parsedVal.harga ? 1 : 0) + (parsedVal.penyedia ? 1 : 0);
          sHtml = '<div style="font-size:12px;font-weight:700;margin-bottom:4px;color:#0f172a">Kesesuaian 4 Tepat: ' + countS + '/4</div>' +
                  '<div style="font-size:11.5px;color:#64748b">Kontrak: ' + formatRupiah(parsedVal.nilai_kontrak) + '</div>' +
                  (parsedVal.catatan ? '<div style="margin-top:6px;font-size:11.5px;color:#475569">' + escapeHtml(parsedVal.catatan) + '</div>' : '');
        } else if (parsedVal._type === 'risk_scale') {
          var sc = parseInt(parsedVal.skor_risiko) || (parseInt(parsedVal.kemungkinan) * parseInt(parsedVal.dampak)) || 1;
          sHtml = '<div style="font-size:12px;font-weight:700">Skor Risiko: ' + sc + ' (' + (sc >= 16 ? 'Ekstrem' : (sc >= 10 ? 'Tinggi' : 'Sedang/Rendah')) + ')</div>' +
                  (parsedVal.mitigasi ? '<div style="margin-top:6px;font-size:11.5px;color:#475569"><b>Mitigasi:</b> ' + escapeHtml(parsedVal.mitigasi) + '</div>' : '');
        }
        structBody.innerHTML = sHtml;
      } else {
        cardStruct.style.display = "none";
      }

      // Indikator Modul Ini
      document.getElementById("fpvIndCounter").textContent = selesaiCount + '/' + totalInd + ' Selesai';
      var indListEl = document.getElementById("fpvIndList");
      indListEl.innerHTML = '';

      modIndicators.forEach(function(ind, idx){
        var ev = modEvidens.find(function(x){ return x.id_indikator === ind.id_indikator; });
        var isThis = ev && ev.id_eviden === e.id_eviden;
        var stLabel = 'Belum Ada';
        var stCls = 't-wn';

        if (ev) {
          if (ev.status_eviden === 'f') { stLabel = 'Selesai'; stCls = 't-ok'; }
          else if (ev.status_eviden === 'p') { stLabel = 'Disetujui'; stCls = 't-ok'; }
          else if (ev.status_eviden === 'a') { stLabel = 'Di Pimpinan'; stCls = 't-pk'; }
          else if (ev.status_eviden === 'r') { stLabel = 'Revisi'; stCls = 't-er'; }
          else { stLabel = 'Review'; stCls = 't-bl'; }
        }

        var item = document.createElement("div");
        item.className = "fpv-ind-item" + (isThis ? " active" : "");
        item.innerHTML = '<div style="display:flex;align-items:center;gap:8px;min-width:0;flex:1">' +
                           '<span style="width:20px;height:20px;border-radius:50%;background:' + (isThis ? '#006a55;color:#fff' : '#e2e8f0;color:#475569') + ';display:grid;place-items:center;font-size:10px;font-weight:700;flex-shrink:0">' + (idx + 1) + '</span>' +
                           '<div style="min-width:0;flex:1">' +
                             '<div style="font-size:12px;font-weight:' + (isThis ? '700' : '600') + ';color:' + (isThis ? '#006a55' : '#1e293b') + ';white-space:nowrap;overflow:hidden;text-overflow:ellipsis">' + escapeHtml(ind.deskripsi_indikator) + '</div>' +
                           '</div>' +
                         '</div>' +
                         '<span class="tag ' + stCls + '" style="font-size:10px;padding:1px 6px">' + stLabel + '</span>';

        if (ev && !isThis) {
          item.onclick = function(){
            openDetailEvidenCard(ev);
          };
        }
        indListEl.appendChild(item);
      });

      // Tampilkan Fullpage Viewer
      fpv.style.display = "flex";
    }

    // Modal Review Indikator & Berkas Eviden
    function openReviewModal(e) {
      var isRevisi = parseInt(e.versi) > 1;
      var isDone = e.status_eviden === 'f';
      var isPimApproved = e.status_eviden === 'p';
      var isLink = isEvidenUrl(e.path_file) || e.format_file === 'link' || e.format_file === 'gdrive' || e.format_file === 'onedrive' || e.format_file === 'dropbox';

      if (isDone) {
        openDetailEvidenCard(e);
        return;
      }

      if (isPimApproved) {
        var bodyFin = '<div style="font-size:13px">' +
                        '<div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:10px;padding:12px 14px;margin-bottom:14px;font-size:13px;color:#166534">' +
                          '<div style="font-weight:700;margin-bottom:2px">Pimpinan Telah Menyetujui Berkas Ini</div>' +
                          'Kepala BBPK telah menyetujui berkas eviden ini. Tekan tombol <b>"Selesai"</b> untuk menyelesaikan seluruh proses approval secara tuntas.' +
                        '</div>' +
                        (e.catatan_temuan ? '<div style="background:#fffbeb;border:1px solid #fef3c7;border-radius:10px;padding:10px 14px;margin-bottom:14px;font-size:12.5px;color:#92400e"><b>Catatan Evaluasi / Disposisi Sebelumnya:</b><br>' + escapeHtml(e.catatan_temuan) + '</div>' : '') +
                        '<div class="rev-choice-card selected-ok" id="choiceCardOk">' +
                          '<input type="radio" name="popRevSt" id="rbRevOk" value="final" checked style="margin-top:3px">' +
                          '<div>' +
                            '<label for="rbRevOk" style="font-weight:700;color:#166534;cursor:pointer;display:block">Selesai (Konfirmasi Penyelesaian)</label>' +
                            '<small style="color:#15803d;display:block;margin-top:2px">Menyelesaikan seluruh alur approval berkas ini secara sah dan tuntas.</small>' +
                          '</div>' +
                        '</div>' +
                        '<div style="margin-top:12px">' +
                          '<label style="display:block;font-size:12px;font-weight:700;color:var(--mut);margin-bottom:6px">Catatan Penyelesaian (Opsional)</label>' +
                          '<textarea id="popRevCatatan" style="width:100%;min-height:64px;border:1px solid var(--bd);border-radius:10px;padding:10px;font:inherit;background:#fff" placeholder="Catatan penyelesaian akhir..."></textarea>' +
                        '</div>' +
                      '</div>';

        openModal({
          title: "Penyelesaian Berkas (Disetujui Pimpinan)",
          body: bodyFin,
          okText: "Selesai",
          cancelText: "Batal",
          width: "600px",
          onOk: function(){
            var cat = document.getElementById("popRevCatatan").value.trim();
            var payload = [{ id_eviden: e.id_eviden, status: 'final', catatan: cat || 'Dinyatakan Selesai setelah disetujui Pimpinan.' }];
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
        return;
      }

      var bodyHtml = '<div style="font-size:13px">' +
        '<div style="display:flex;justify-content:flex-end;margin-bottom:12px">' +
          '<button type="button" class="btn o sm" id="btnSwitchToCardView" style="font-size:11.5px;color:#006a55;border-color:#006a55;display:inline-flex;align-items:center;gap:6px">' +
            '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>' +
            'Lihat Rincian Lengkap Modul &amp; Eviden (Card View)' +
          '</button>' +
        '</div>' +
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
            '<button type="button" class="btn sm btnPreviewEviden" data-id="' + escapeAttr(e.id_eviden) + '" style="text-decoration:none;display:inline-flex;align-items:center;gap:6px">' +
              (isLink
                ? '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg><span>Pratinjau Tautan (' + (e.format_file === 'gdrive' ? 'Google Drive' : 'Cloud Link') + ')</span>'
                : '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="12" y1="18" x2="12" y2="12"/><line x1="9" y1="15" x2="15" y2="15"/></svg><span>Pratinjau Berkas (' + e.ukuran_file_mb + ' MB)</span>'
              ) +
            '</button>' +
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

      bodyHtml += '<div style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:10px;padding:12px 14px;margin-bottom:14px;font-size:12.5px;color:#1e40af">' +
                    '<div style="font-weight:700;margin-bottom:2px">Alur Approval: SKI Review → Pimpinan Approval</div>' +
                    'Jika berkas disetujui oleh SKI, berkas akan diteruskan ke Meja Pimpinan (Kepala BBPK) untuk persetujuan resmi. Setelah disetujui Pimpinan, berkas kembali ke SKI untuk diselesaikan.' +
                  '</div>' +
                  (e.catatan_temuan ? '<div style="background:#fffbeb;border:1px solid #fef3c7;border-radius:10px;padding:10px 14px;margin-bottom:14px;font-size:12.5px;color:#92400e"><b>Catatan Temuan / Pengembalian Sebelumnya:</b><br>' + escapeHtml(e.catatan_temuan) + '</div>' : '') +
                  '<div class="rev-choice-card selected-ok" id="choiceCardOk">' +
                    '<input type="radio" name="popRevSt" id="rbRevOk" value="approve_pimpinan" checked style="margin-top:3px">' +
                    '<div>' +
                      '<label for="rbRevOk" style="font-weight:700;color:#0369a1;cursor:pointer;display:block">Setujui &amp; Ajukan ke Pimpinan</label>' +
                      '<small style="color:#0284c7;display:block;margin-top:2px">Berkas lengkap dan sesuai acuan internal SKI, teruskan ke Meja Kepala BBPK untuk approval.</small>' +
                    '</div>' +
                  '</div>' +
                  '<div class="rev-choice-card" id="choiceCardNo">' +
                    '<input type="radio" name="popRevSt" id="rbRevNo" value="no" style="margin-top:3px">' +
                    '<div>' +
                      '<label for="rbRevNo" style="font-weight:700;color:#991b1b;cursor:pointer;display:block">Kembalikan ke PIC (Minta Revisi)</label>' +
                      '<small style="color:#b91c1c;display:block;margin-top:2px">Berkas belum lengkap atau keliru, kembalikan ke PIC untuk diperbaiki.</small>' +
                    '</div>' +
                  '</div>' +
                  '<div style="margin-top:12px">' +
                    '<label style="display:block;font-size:12px;font-weight:700;color:var(--mut);margin-bottom:6px">Catatan Evaluasi <span id="lblCatatanReq" style="color:var(--er);display:none">*Wajib jika Minta Revisi</span></label>' +
                    '<textarea id="popRevCatatan" style="width:100%;min-height:64px;border:1px solid var(--bd);border-radius:10px;padding:10px;font:inherit;background:#fff" placeholder="Catatan hasil verifikasi berkas atau instruksi perbaikan PIC...">' + (e.catatan_temuan || '') + '</textarea>' +
                  '</div>' +
                '</div>';

      openModal({
        title: "Review &amp; Crosscheck SKI",
        body: bodyHtml,
        okText: "Simpan &amp; Ajukan ke Pimpinan",
        cancelText: "Batal",
        width: "600px",
        onOk: function(){
          var rSel = document.querySelector('input[name="popRevSt"]:checked');
          var st = rSel ? rSel.value : 'approve_pimpinan';
          var cat = document.getElementById("popRevCatatan").value.trim();
          if (st === 'no' && !cat) {
            alert("Catatan temuan wajib diisi jika berkas dikembalikan ke PIC untuk perbaikan!");
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

      // Tombol switch ke tampilan card dari dalam review modal
      var btnSwitch = document.getElementById("btnSwitchToCardView");
      if (btnSwitch) {
        btnSwitch.onclick = function(){
          closeModal();
          setTimeout(function(){
            openDetailEvidenCard(e);
          }, 150);
        };
      }

      var cOk = document.getElementById("choiceCardOk");
      var cNo = document.getElementById("choiceCardNo");
      var rOk = document.getElementById("rbRevOk");
      var rNo = document.getElementById("rbRevNo");
      var lblReq = document.getElementById("lblCatatanReq");
      if (cOk && cNo && rOk && rNo) {
        function syncChoices(){
          if (rOk.checked) {
            cOk.className = "rev-choice-card selected-ok";
            cNo.className = "rev-choice-card";
            if (lblReq) lblReq.style.display = "none";
          } else {
            cOk.className = "rev-choice-card";
            cNo.className = "rev-choice-card selected-no";
            if (lblReq) lblReq.style.display = "inline";
          }
        }
        cOk.onclick = function(){ rOk.checked = true; syncChoices(); };
        cNo.onclick = function(){ rNo.checked = true; syncChoices(); };
        rOk.onchange = syncChoices;
        rNo.onchange = syncChoices;
      }
    }
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

  function printModulAkhirPdf(m, mInds, mEvs, rec, previewOnly) {
    var isPimApproved = (rec && rec.keputusan_pimpinan === 'Disetujui') || (mEvs.length > 0 && mEvs.every(function(e){ return e.status_eviden === 'f'; }));
    var safeTitle = escapeHtml(m.nama_modul);
    var printWin = previewOnly ? null : window.open('', '_blank');
    if (!previewOnly && !printWin) {
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
        (previewOnly ? '' :
          '<div class="no-print" style="position:sticky;top:0;background:#0f172a;color:#fff;padding:12px 18px;border-radius:10px;margin-bottom:20px;display:flex;justify-content:space-between;align-items:center;box-shadow:0 4px 12px rgba(0,0,0,.2)">' +
            '<div><b>Pratinjau cetak</b></div>' +
            '<div style="display:flex;gap:8px">' +
              '<button onclick="window.print()" style="background:#0d9488;color:#fff;border:none;padding:7px 16px;border-radius:6px;font-weight:700;cursor:pointer">Cetak PDF</button>' +
              '<button onclick="window.close()" style="background:#475569;color:#fff;border:none;padding:7px 14px;border-radius:6px;cursor:pointer">Tutup</button>' +
            '</div>' +
          '</div>') +
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

    if (previewOnly) {
      openModal({
        title: "Pratinjau Laporan: " + safeTitle,
        body: '<iframe sandbox="" srcdoc="' + escapeAttr(docHtml) + '" title="Pratinjau laporan PDF" style="width:100%;height:68vh;border:0;background:#fff"></iframe>',
        width: "1100px"
      });
      return;
    }

    printWin.document.open();
    printWin.document.write(docHtml);
    printWin.document.close();
  }

  function openModuleReport(modulId, previewOnly) {
    var m = STATE.moduls.find(function(item){ return item.id_modul === modulId; });
    if (!m) return;
    var mInds = STATE.indikators.filter(function(item){ return item.id_modul === modulId; });
    var mEvs = STATE.evidens.filter(function(item){ return item.id_modul === modulId; });
    var rec = (STATE.rekomendasi || []).find(function(item){ return item.id_modul === modulId; });
    printModulAkhirPdf(m, mInds, mEvs, rec, previewOnly);
  }

  function exportModulePdf(modulId) {
    openModuleReport(modulId, false);
  }

  function previewModulePdf(modulId) {
    openModuleReport(modulId, true);
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
    function previewAction(e, format, label, style) {
      return '<button type="button" class="btn sm btnPreviewEviden" data-id="' + escapeAttr(e.id_eviden) + '" data-format="' + format + '" style="' + style + '">' + label + '</button>';
    }

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
          '<span style="font-size:11.5px;color:var(--mut)">Pilih format pratinjau</span>' +
        '</div>' +
        '<div style="max-height:280px;overflow-y:auto;border:1px solid var(--bd);border-radius:8px">' +
          '<table style="width:100%;font-size:11.5px;border-collapse:collapse">' +
            '<tr style="background:#f8fafc;border-bottom:1px solid var(--bd);position:sticky;top:0;z-index:2">' +
              '<th style="padding:7px 8px;text-align:center;width:24px">No</th>' +
              '<th style="padding:7px 8px;text-align:left;width:32%">Butir Indikator / Tugas</th>' +
              '<th style="padding:7px 8px;text-align:left;width:28%">Berkas Bukti Dukung (Eviden)</th>' +
              '<th style="padding:7px 8px;text-align:center;width:15%">Format</th>' +
              '<th style="padding:7px 8px;text-align:right;width:25%">Aksi Pratinjau</th>' +
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
                                previewAction(latestEv, 'docx', 'Word', 'background:#2563eb;color:#fff;padding:2px 7px;font-size:10.5px') +
                                previewAction(latestEv, 'pdf', 'PDF', 'background:#dc2626;color:#fff;padding:2px 7px;font-size:10.5px') +
                                previewAction(latestEv, 'original', 'Pratinjau', 'background:#fff;padding:2px 6px;font-size:10.5px') +
                              '</div>';
                  } else if (isGSheet) {
                    formatBadge = '<span class="tag" style="background:#dcfce7;color:#166534;font-size:10px;font-weight:700">Google Sheets</span>';
                    actBtns = '<div style="display:inline-flex;gap:4px;justify-content:flex-end;flex-wrap:wrap">' +
                                previewAction(latestEv, 'xlsx', 'Excel', 'background:#059669;color:#fff;padding:2px 7px;font-size:10.5px') +
                                previewAction(latestEv, 'pdf', 'PDF', 'background:#dc2626;color:#fff;padding:2px 7px;font-size:10.5px') +
                                previewAction(latestEv, 'original', 'Pratinjau', 'background:#fff;padding:2px 6px;font-size:10.5px') +
                              '</div>';
                  } else if (isGSlide) {
                    formatBadge = '<span class="tag" style="background:#fef3c7;color:#92400e;font-size:10px;font-weight:700">Google Slides</span>';
                    actBtns = '<div style="display:inline-flex;gap:4px;justify-content:flex-end;flex-wrap:wrap">' +
                                previewAction(latestEv, 'pptx', 'PPTX', 'background:#d97706;color:#fff;padding:2px 7px;font-size:10.5px') +
                                previewAction(latestEv, 'pdf', 'PDF', 'background:#dc2626;color:#fff;padding:2px 7px;font-size:10.5px') +
                                previewAction(latestEv, 'original', 'Pratinjau', 'background:#fff;padding:2px 6px;font-size:10.5px') +
                              '</div>';
                  } else if (isGFolder) {
                    formatBadge = '<span class="tag" style="background:#f1f5f9;color:#334155;font-size:10px;font-weight:700">Folder GDrive</span>';
                    actBtns = '<div style="display:inline-flex;gap:4px;justify-content:flex-end">' +
                                previewAction(latestEv, 'original', 'Pratinjau Folder', 'border-color:#0284c7;color:#0284c7;padding:2px 7px;font-size:10.5px') +
                              '</div>';
                  } else {
                    formatBadge = '<span class="tag" style="background:#e0f2fe;color:#0369a1;font-size:10px;font-weight:700">File GDrive</span>';
                    actBtns = '<div style="display:inline-flex;gap:4px;justify-content:flex-end;flex-wrap:wrap">' +
                                previewAction(latestEv, 'original', 'Pratinjau', 'background:#fff;padding:2px 6px;font-size:10.5px') +
                              '</div>';
                  }
                } else if (hasLocal) {
                  var isWord = pLow.endsWith('.docx') || pLow.endsWith('.doc') || fmt === 'docx' || fmt === 'doc' || nLow.endsWith('.docx') || nLow.endsWith('.doc');
                  var isExcel = pLow.endsWith('.xlsx') || pLow.endsWith('.xls') || fmt === 'xlsx' || fmt === 'xls' || nLow.endsWith('.xlsx') || nLow.endsWith('.xls');
                  var isPdf = pLow.endsWith('.pdf') || fmt === 'pdf' || nLow.endsWith('.pdf');

                  if (isWord) {
                    formatBadge = '<span class="tag" style="background:#dbeafe;color:#1e40af;font-size:10px;font-weight:700">Word (.docx)</span>';
                    actBtns = '<div style="display:inline-flex;gap:4px;justify-content:flex-end;flex-wrap:wrap">' +
                                previewAction(latestEv, 'docx', 'Word', 'background:#2563eb;color:#fff;padding:2px 7px;font-size:10.5px') +
                                previewAction(latestEv, 'pdf', 'PDF', 'background:#dc2626;color:#fff;padding:2px 7px;font-size:10.5px') +
                              '</div>';
                  } else if (isExcel) {
                    formatBadge = '<span class="tag" style="background:#dcfce7;color:#166534;font-size:10px;font-weight:700">Excel (.xlsx)</span>';
                    actBtns = '<div style="display:inline-flex;gap:4px;justify-content:flex-end;flex-wrap:wrap">' +
                                previewAction(latestEv, 'xlsx', 'Excel', 'background:#059669;color:#fff;padding:2px 7px;font-size:10.5px') +
                              '</div>';
                  } else if (isPdf) {
                    formatBadge = '<span class="tag" style="background:#fee2e2;color:#991b1b;font-size:10px;font-weight:700">PDF (.pdf)</span>';
                    actBtns = '<div style="display:inline-flex;gap:4px;justify-content:flex-end">' +
                                previewAction(latestEv, 'pdf', 'Pratinjau PDF', 'background:#dc2626;color:#fff;padding:2px 7px;font-size:10.5px') +
                              '</div>';
                  } else {
                    formatBadge = '<span class="tag" style="background:#f1f5f9;color:#334155;font-size:10px;font-weight:700">Berkas Fisik</span>';
                    actBtns = '<div style="display:inline-flex;gap:4px;justify-content:flex-end">' +
                                previewAction(latestEv, 'original', 'Pratinjau', 'background:#0d9488;color:#fff;padding:2px 7px;font-size:10.5px') +
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
          'Panduan Pratinjau dan Ekspor Berkas Eviden:' +
        '</div>' +
        '<ul style="margin:4px 0 0;padding-left:18px;line-height:1.6">' +
          (hasPhysical ? '<li>Unduh semua berkas dalam ZIP.</li>' : '<li>Buka atau salin tautan Google Drive.</li>') +
          '<li>Berkas Word, Excel, dan PDF pada daftar dapat dipratinjau langsung di dalam aplikasi.</li>' +
          '<li>Dokumen Google Drive dapat dipratinjau tanpa membuka tab baru.</li>' +
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
               '<td><input type="checkbox" class="cbAprItem" data-id="' + e.id_eviden + '" data-modid="' + m.id_modul + '"></td>' +
               '<td><b>' + escapeAttr(e.deskripsi_indikator) + '</b></td>' +
               '<td><button type="button" class="apr-file-link btnPreviewEviden" data-id="' + escapeAttr(e.id_eviden) + '" style="border:0;background:none;padding:0;text-align:left;cursor:pointer">' +
                 fileIcon + ' ' +
                 escapeAttr(e.nama_file) + fileBadge + '</button></td>' +
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
  }

  // --- 9. APPROVAL PIMPINAN (Persetujuan Berkas oleh Kepala BBPK) ---
  var apmActiveTab = 'revision';
  var apmSearchQuery = '';

  function renderApprovalPimpinan() {
    var pendingEvidens = STATE.evidens.filter(function(e){ return e.status_eviden === 'a'; });
    var approvedEvidens = STATE.evidens.filter(function(e){ return e.status_eviden === 'p' || e.status_eviden === 'f'; });
    var revisiEvidens = STATE.evidens.filter(function(e){ return e.status_eviden === 'r'; });
    var tabs = [
      { id: 'pending', label: 'Menunggu Approval', count: pendingEvidens.length },
      { id: 'approved', label: 'Telah Disetujui', count: approvedEvidens.length },
      { id: 'revision', label: 'Perlu Revisi PIC', count: revisiEvidens.length }
    ];
    var tabExists = tabs.some(function(tab){ return tab.id === apmActiveTab; });
    if (!tabExists) apmActiveTab = 'pending';

    var h = '<div class="apm-shell">' +
              '<div class="apm-toolbar">' +
                '<div class="apm-tabs">';
    tabs.forEach(function(tab){
      var isActive = apmActiveTab === tab.id;
      h += '<button type="button" class="apm-tab' + (isActive ? ' active' : '') + ' btnApmTab" data-tab="' + tab.id + '" aria-pressed="' + (isActive ? 'true' : 'false') + '">' +
            '<span>' + tab.label + '</span>' +
            '<span class="apm-count' + (tab.id === 'revision' ? ' revision' : '') + '">' + tab.count + '</span>' +
          '</button>';
    });
    h += '</div>' +
         '<label class="apm-search-wrap">' +
           '<svg class="apm-search-icon" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="m20 20-4-4"/></svg>' +
           '<input id="apmSearchInput" class="apm-search" type="search" value="' + escapeAttr(apmSearchQuery) + '" placeholder="Cari modul / unit..." aria-label="Cari modul atau unit">' +
         '</label>' +
       '</div>' +
       '<div id="apmTabContent" class="apm-content"></div>' +
     '</div>';

    document.getElementById("apmL").innerHTML = h;

    document.querySelectorAll(".btnApmTab").forEach(function(button){
      button.onclick = function(){
        apmActiveTab = this.dataset.tab;
        renderApprovalPimpinan();
        var input = document.getElementById("apmSearchInput");
        if (input) {
          input.focus();
          input.setSelectionRange(input.value.length, input.value.length);
        }
      };
    });

    document.getElementById("apmSearchInput").oninput = function(){
      apmSearchQuery = this.value;
      renderApmTabContent();
    };

    renderApmTabContent();

    function renderApmTabContent() {
      var allItems = apmActiveTab === 'pending' ? pendingEvidens : (apmActiveTab === 'approved' ? approvedEvidens : revisiEvidens);
      var query = apmSearchQuery.trim().toLowerCase();
      var filteredItems = allItems.filter(function(e){
        if (!query) return true;
        var searchable = [e.nama_modul, e.nama_unit].join(' ').toLowerCase();
        return searchable.indexOf(query) !== -1;
      });
      var content = '';

      if (apmActiveTab === 'pending' && filteredItems.length > 0) {
        content += '<div style="display:flex;justify-content:space-between;align-items:center;gap:10px;flex-wrap:wrap;margin:0 0 10px">' +
                     '<span style="font-size:12px;color:#64748b">Berkas yang menunggu keputusan pimpinan</span>' +
                     '<button type="button" class="btn sm" id="btnPimBulkApproveAll" style="background:#087066;color:#fff;font-weight:700">Setujui Semua (' + pendingEvidens.length + ')</button>' +
                   '</div>';
      }

      if (filteredItems.length === 0) {
        var emptyTitle = query ? 'Tidak ada berkas yang cocok dengan pencarian.' : (apmActiveTab === 'pending' ? 'Tidak ada berkas menunggu approval' : (apmActiveTab === 'approved' ? 'Belum ada berkas disetujui' : 'Tidak ada berkas perlu revisi'));
        var emptyMessage = query ? 'Coba kata kunci modul atau unit lainnya.' : (apmActiveTab === 'pending' ? 'Seluruh berkas yang diajukan telah selesai dievaluasi.' : (apmActiveTab === 'approved' ? 'Dokumen yang telah disetujui akan tampil di sini.' : 'Seluruh dokumen unit kerja telah memenuhi standar kelengkapan SKI.'));
        var emptyIcon = query
          ? '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="11" cy="11" r="7"/><path d="m20 20-4-4"/></svg>'
          : '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/><path d="m9 15 2 2 4-4"/></svg>';
        content += '<div class="apm-empty">' +
                     '<div class="apm-empty-icon">' + emptyIcon + '</div>' +
                     '<b class="apm-empty-title">' + emptyTitle + '</b>' +
                     '<span class="apm-empty-message">' + emptyMessage + '</span>' +
                   '</div>';
      } else {
        content += '<div class="apm-list">';
        filteredItems.forEach(function(e){
          var isRevisi = parseInt(e.versi, 10) > 1;
          var isLink = isEvidenUrl(e.path_file) || e.format_file === 'link' || e.format_file === 'gdrive' || e.format_file === 'onedrive' || e.format_file === 'dropbox';
          var fileInfo = isLink ? ('Tautan ' + (e.format_file === 'gdrive' ? 'Google Drive' : (e.format_file === 'onedrive' ? 'OneDrive' : 'Cloud'))) : ((e.ukuran_file_mb || 0) + ' MB');
          var statusLabel = apmActiveTab === 'pending' ? 'Menunggu Approval' : (apmActiveTab === 'approved' ? 'Disetujui' : 'Perlu Revisi PIC');
          var statusColor = apmActiveTab === 'pending' ? '#b45309' : (apmActiveTab === 'approved' ? '#15803d' : '#be123c');
          var statusBackground = apmActiveTab === 'pending' ? '#fffbeb' : (apmActiveTab === 'approved' ? '#f0fdf4' : '#fff1f2');
          var statusBorder = apmActiveTab === 'pending' ? '#fde68a' : (apmActiveTab === 'approved' ? '#bbf7d0' : '#fecdd3');

          content += '<article style="display:flex;align-items:center;gap:14px;padding:15px 3px;border-bottom:1px solid #eef2f7">' +
                       '<div style="width:42px;height:42px;flex:0 0 42px;border-radius:11px;display:grid;place-items:center;background:#f1f5f9;color:#64748b">' +
                         getFileIconSvg(e.nama_file, e.format_file, e.path_file) +
                       '</div>' +
                       '<div style="min-width:0;flex:1">' +
                         '<div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap">' +
                           '<b style="font-size:13px;color:#1e293b">' + escapeHtml(e.nama_modul || 'Modul') + '</b>' +
                           '<span style="border:1px solid ' + statusBorder + ';background:' + statusBackground + ';color:' + statusColor + ';border-radius:6px;padding:3px 7px;font-size:10px;font-weight:700">' + statusLabel + '</span>' +
                         '</div>' +
                         '<div style="font-size:12px;color:#64748b;margin-top:4px;line-height:1.45">' + escapeHtml(e.deskripsi_indikator || e.nama_file || '-') + '</div>' +
                         '<div style="display:flex;gap:6px 13px;flex-wrap:wrap;font-size:11px;color:#64748b;margin-top:6px">' +
                           '<span>Unit: <b style="color:#475569">' + escapeHtml(e.nama_unit || '-') + '</b></span>' +
                           '<span>PIC: <b style="color:#475569">' + escapeHtml(e.nama_pic || '-') + '</b></span>' +
                           '<span>' + escapeHtml(fileInfo) + ' · Versi ' + escapeHtml(String(e.versi || 1)) + (isRevisi ? ' (Revisi)' : '') + '</span>' +
                           '<span>Diunggah: ' + escapeHtml(formatDateIndo(e.waktu_unggah)) + '</span>' +
                         '</div>' +
                         (e.catatan_temuan ? '<div style="font-size:11px;color:#92400e;background:#fffbeb;border-radius:6px;padding:6px 8px;margin-top:8px"><b>Catatan evaluasi:</b> ' + escapeHtml(e.catatan_temuan) + '</div>' : '') +
                       '</div>' +
                       '<div style="display:flex;align-items:center;gap:7px;flex:0 0 auto;flex-wrap:wrap;justify-content:flex-end">' +
                         '<button type="button" class="btn sm o btnPreviewEviden" data-id="' + escapeAttr(e.id_eviden) + '">Lihat Berkas</button>' +
                         (apmActiveTab === 'pending' ? '<button type="button" class="btn sm btnEvalEvidenPim" data-id="' + escapeAttr(e.id_eviden) + '" data-mod="' + escapeAttr(e.nama_modul) + '" data-desc="' + escapeAttr(e.deskripsi_indikator) + '" data-file="' + escapeAttr(e.nama_file) + '" data-path="' + escapeAttr(e.path_file) + '" data-ver="' + escapeAttr(e.versi) + '" data-pic="' + escapeAttr(e.nama_pic) + '" data-unit="' + escapeAttr(e.nama_unit || '') + '" data-cat="' + escapeAttr(e.catatan_temuan || '') + '" style="background:#087066;color:#fff;font-weight:700">Tinjau &amp; Keputusan</button>' : '') +
                       '</div>' +
                     '</article>';
        });
        content += '</div>';
      }

      var target = document.getElementById('apmTabContent');
      if (!target) return;
      target.innerHTML = content;

      var btnBulkAll = document.getElementById("btnPimBulkApproveAll");
      if (btnBulkAll) {
        btnBulkAll.onclick = function(){
          if (!confirm("Setujui seluruh " + pendingEvidens.length + " berkas yang menunggu dan kembalikan ke SKI untuk penyelesaian akhir?")) return;
          var ids = pendingEvidens.map(function(e){ return e.id_eviden; });
          var fd = new FormData();
          fd.append('action', 'approval_pimpinan');
          fd.append('sub_action', 'bulk_approve');
          fd.append('ids', JSON.stringify(ids));
          fetch('ajax.php', { method: 'POST', body: fd }).then(function(r){ return r.json(); }).then(function(res){
            toast(res.message);
            if (res.success) fetchInit(function(){ renderApprovalPimpinan(); });
          });
        };
      }

      document.querySelectorAll(".btnEvalEvidenPim").forEach(function(b){
        b.onclick = function(){
          var id = this.dataset.id;
          var mod = this.dataset.mod;
          var desc = this.dataset.desc;
          var file = this.dataset.file;
          var ver = parseInt(this.dataset.ver, 10);
          var pic = this.dataset.pic;
          var unit = this.dataset.unit;
          var cat = this.dataset.cat;
          var isRevisi = ver > 1;

          var popHtml = '<div style="font-size:13px">' +
                        '<div style="background:var(--pri2);padding:12px 16px;border-radius:12px;margin-bottom:14px;border-left:4px solid var(--pri)">' +
                          '<div style="font-size:11px;font-weight:700;color:var(--dk);text-transform:uppercase">Modul: ' + escapeAttr(mod) + '</div>' +
                          '<div style="font-size:13.5px;font-weight:600;color:var(--tx);margin-top:2px">' + escapeAttr(desc) + '</div>' +
                          '<div style="font-size:12px;color:var(--mut);margin-top:4px">PIC: <b>' + escapeAttr(pic) + ' (' + escapeAttr(unit) + ')</b></div>' +
                        '</div>' +
                        '<div style="background:#fff;border:1px solid var(--bd);border-radius:12px;padding:12px 14px;margin-bottom:14px">' +
                          '<div class="row" style="margin-top:0"><span style="font-weight:700;color:var(--dk)">Dokumen Eviden Bukti:</span>' +
                          '<span class="tag ' + (isRevisi ? 't-pu' : 't-bl') + '" style="font-weight:700">' + (isRevisi ? 'Versi ' + ver + ' (Revisi)' : 'Versi 1') + '</span></div>' +
                          '<div style="margin:8px 0">' +
                            '<button type="button" class="btn sm o btnPreviewEviden" data-id="' + escapeAttr(id) + '" style="display:inline-flex;align-items:center;gap:6px">' +
                              'Pratinjau Dokumen' +
                            '</button>' +
                          '</div>' +
                          (cat ? '<div style="margin-top:8px;padding:8px 12px;background:#fef3c7;border-radius:8px;font-size:12px;color:#92400e"><b>Catatan Evaluasi Tim SKI:</b><br>' + escapeAttr(cat) + '</div>' : '') +
                        '</div>' +
                        '<label style="display:block;font-weight:700;margin-bottom:4px;color:var(--dk)">Catatan / Arahan Disposisi Pimpinan <span class="mut" style="font-weight:400;font-size:12px">(Wajib diisi jika Ditolak atau Revisi)</span></label>' +
                        '<textarea id="mEvPimDisposisi" style="width:100%;min-height:75px;border:1px solid var(--bd);border-radius:10px;padding:10px;font:inherit;background:#fff" placeholder="Tuliskan arahan persetujuan, alasan penolakan ke SKI, atau instruksi revisi ke PIC..."></textarea>' +
                        '</div>';

          var footHtml = '<button class="btn o sm" id="mEvPimCancel" style="margin-right:auto">Batal</button>' +
                         '<button class="btn o sm" id="mEvPimTolak" style="color:#dc2626;border-color:#dc2626;font-weight:700" title="Tolak berkas dan kembalikan ke Tim SKI untuk ditinjau ulang">Ditolak (Ke SKI)</button>' +
                         '<button class="btn o sm" id="mEvPimRevisi" style="color:#d97706;border-color:#d97706;font-weight:700" title="Minta revisi dokumen dan kembalikan ke PIC">Revisi (Ke PIC)</button>' +
                         '<button class="btn sm" id="mEvPimOk" style="background:#087066;color:#fff;font-weight:700">Disetujui</button>';

          openModal({
            title: "Evaluasi &amp; Keputusan Pimpinan",
            body: popHtml,
            footerHtml: footHtml,
            width: "640px"
          });

          document.getElementById("mEvPimCancel").onclick = closeModal;

          document.getElementById("mEvPimOk").onclick = function(){
            var dsp = document.getElementById("mEvPimDisposisi").value.trim();
            execPimEviden(id, 'Setuju', dsp);
          };
          document.getElementById("mEvPimTolak").onclick = function(){
            var dsp = document.getElementById("mEvPimDisposisi").value.trim();
            if (!dsp) { alert("Tuliskan catatan alasan penolakan untuk Tim SKI terlebih dahulu!"); return; }
            execPimEviden(id, 'Ditolak', dsp);
          };
          document.getElementById("mEvPimRevisi").onclick = function(){
            var dsp = document.getElementById("mEvPimDisposisi").value.trim();
            if (!dsp) { alert("Tuliskan instruksi revisi perbaikan untuk PIC terlebih dahulu!"); return; }
            execPimEviden(id, 'Revisi', dsp);
          };
        };
      });
    }
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

  // --- 10. EKSPOR LAPORAN (Itjen Ready & Alur Balik ke SKI) ---
  var expActiveTab = 'all'; // 'all' | 'ready' | 'empty'
  function renderEkspor() {
    var totalModuls = STATE.moduls.length;
    var readyCount = 0;
    var emptyCount = 0;

    STATE.moduls.forEach(function(m){
      var mInds = STATE.indikators.filter(function(i){ return i.id_modul === m.id_modul; });
      var mEvs = STATE.evidens.filter(function(e){ return e.id_modul === m.id_modul; });
      var rec = (STATE.rekomendasi || []).find(function(r){ return r.id_modul === m.id_modul; });
      var isPimApproved = (rec && rec.keputusan_pimpinan === 'Disetujui') || (mInds.length > 0 && mEvs.length >= mInds.length && mEvs.every(function(e){ return e.status_eviden === 'f'; }));
      if (isPimApproved) readyCount++;
      if (mEvs.length === 0) emptyCount++;
    });

    var h = '';

    // 1. Kartu Ringkasan KPI Ekspor
    h += '<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:12px;margin-bottom:18px">' +
           '<div style="background:#fff;border:1px solid var(--bd);border-radius:12px;padding:14px 16px">' +
             '<div style="font-size:12px;color:var(--mut);font-weight:600">Total Modul Pengawasan</div>' +
             '<div style="font-size:24px;font-weight:800;color:var(--dk);margin-top:2px">' + totalModuls + ' <span style="font-size:13px;font-weight:500;color:var(--mut)">modul</span></div>' +
           '</div>' +
           '<div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:12px;padding:14px 16px">' +
             '<div style="font-size:12px;color:#15803d;font-weight:600">Modul Selesai Disetujui (Siap Ekspor)</div>' +
             '<div style="font-size:24px;font-weight:800;color:#16a34a;margin-top:2px">' + readyCount + ' <span style="font-size:13px;font-weight:500;color:#15803d">modul tuntas</span></div>' +
           '</div>' +
           '<div style="background:#fffbeb;border:1px solid #fde68a;border-radius:12px;padding:14px 16px">' +
             '<div style="font-size:12px;color:#b45309;font-weight:600">Belum Ada Berkas Eviden</div>' +
             '<div style="font-size:24px;font-weight:800;color:#d97706;margin-top:2px">' + emptyCount + ' <span style="font-size:13px;font-weight:500;color:#b45309">modul</span></div>' +
           '</div>' +
         '</div>';

    // 3. Tab Navigasi & Filter
    h += '<div style="display:flex;gap:8px;margin-bottom:12px;flex-wrap:wrap">' +
           '<button class="btn sm ' + (expActiveTab === 'all' ? '' : 'o') + ' btnExpTab" data-tab="all">Semua Modul (' + totalModuls + ')</button>' +
           '<button class="btn sm ' + (expActiveTab === 'ready' ? '' : 'o') + ' btnExpTab" data-tab="ready" style="border-color:#16a34a;' + (expActiveTab === 'ready' ? 'background:#16a34a;color:#fff' : 'color:#16a34a') + '">Selesai Disetujui (' + readyCount + ')</button>' +
           '<button class="btn sm ' + (expActiveTab === 'empty' ? '' : 'o') + ' btnExpTab" data-tab="empty">Belum Ada Eviden (' + emptyCount + ')</button>' +
         '</div>';

    // 4. Tabel Modul Ekspor
    h += '<div class="tw"><table><tr>' +
           '<th>Nama Modul &amp; Satker PIC</th>' +
           '<th>Indikator Modul</th>' +
           '<th>Status Evaluasi Eviden</th>' +
           '<th>Kelengkapan Tugas</th>' +
           '<th style="text-align:right">Ekspor</th>' +
         '</tr>';

    var filteredModuls = STATE.moduls.filter(function(m){
      var mInds = STATE.indikators.filter(function(i){ return i.id_modul === m.id_modul; });
      var mEvs = STATE.evidens.filter(function(e){ return e.id_modul === m.id_modul; });
      var rec = (STATE.rekomendasi || []).find(function(r){ return r.id_modul === m.id_modul; });
      var isPimApproved = (rec && rec.keputusan_pimpinan === 'Disetujui') || (mInds.length > 0 && mEvs.length >= mInds.length && mEvs.every(function(e){ return e.status_eviden === 'f'; }));
      if (expActiveTab === 'ready') return isPimApproved;
      if (expActiveTab === 'empty') return mEvs.length === 0;
      return true;
    });

    if (filteredModuls.length === 0) {
      h += '<tr><td colspan="5" style="text-align:center;padding:28px;color:var(--mut)">Tidak ada modul pada filter ini.</td></tr>';
    } else {
      filteredModuls.forEach(function(m){
        var mInds = STATE.indikators.filter(function(i){ return i.id_modul === m.id_modul; });
        var mEvs = STATE.evidens.filter(function(e){ return e.id_modul === m.id_modul; });
        var hasEviden = mEvs.length > 0;
        var rec = (STATE.rekomendasi || []).find(function(r){ return r.id_modul === m.id_modul; });
        var isPimApproved = (rec && rec.keputusan_pimpinan === 'Disetujui') || (mInds.length > 0 && mEvs.length >= mInds.length && mEvs.every(function(e){ return e.status_eviden === 'f'; }));
        var isWaitingPim = !isPimApproved && mEvs.some(function(e){ return e.status_eviden === 'a'; });

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
        if (isPimApproved) {
          h += '<span class="tag t-ok" style="font-weight:700">Selesai (Disetujui)</span>';
        } else if (isWaitingPim) {
          h += '<span class="tag t-pk" style="font-weight:700">Menunggu Pimpinan</span>';
        } else if (hasEviden) {
          h += '<span class="tag t-in" style="font-weight:600">' + mEvs.length + ' eviden (Proses SKI)</span>';
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
          h += '<button class="btn sm o btnPreviewPdf" data-id="' + m.id_modul + '" title="Lihat pratinjau laporan">Pratinjau</button>';
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

    document.querySelectorAll(".btnPreviewPdf").forEach(function(b){
      b.onclick = function(){
        previewModulePdf(this.dataset.id);
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

    h += '<div class="tw"><table class="audit-table"><tr><th>Waktu Aktivitas</th><th>Pengguna</th><th>Peran Saat Aksi</th><th>Jenis Aksi</th><th>Objek Target</th></tr>';
    STATE.audit.forEach(function(a){
      var auditTimestamp = String(a.timestamp_aktivitas || '');
      var auditTimestampParts = auditTimestamp.split(/[ T]/);
      var auditDateLabel = formatDateIndo(auditTimestampParts[0]);
      var auditTimeLabel = (auditTimestampParts[1] || '').slice(0, 8);
      h += '<tr>';
      h += '<td class="audit-time-cell"><time class="audit-time" datetime="' + escapeAttr(auditTimestamp) + '">' +
             '<span>' + escapeHtml(auditDateLabel) + '</span>' +
             (auditTimeLabel ? '<small>' + escapeHtml(auditTimeLabel) + '</small>' : '') +
           '</time></td>';
      h += '<td><b>' + a.nama_lengkap + '</b></td>';
      h += '<td>' + a.role_saat_aksi + '</td>';
      h += '<td><span class="tag t-in">' + a.jenis_aksi + '</span></td>';
      h += '<td class="audit-target-cell">' + a.objek_target + '</td>';
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
      { k: "upl",  n: "Upload Berkas Eviden" },
      { k: "mon",  n: "Monitoring Upload Satker" },
      { k: "rep",  n: "Repositori Eviden & Berkas" },
      { k: "rev",  n: "Review & Cross-check SKI" },
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
        var isAdminLocked = (currentHakRole === 'adm' && ['upl', 'mon', 'rep', 'rev', 'apm'].indexOf(f.k) > -1);

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

  function doLogin() {
    var lu = document.getElementById("lu").value.trim();
    var lp = document.getElementById("lp").value;
    var lr = document.getElementById("lr").value;
    var btnMasuk = document.getElementById("btnMasuk");
    if (btnMasuk) {
      btnMasuk.disabled = true;
      btnMasuk.textContent = "Memverifikasi...";
    }
    var fd = new FormData();
    fd.append('action', 'login');
    fd.append('username', lu);
    fd.append('password', lp);
    fd.append('demo_role', lr);

    fetch('ajax.php', { method: 'POST', body: fd })
      .then(function(r){ return r.json(); })
      .then(function(res){
        if (btnMasuk) {
          btnMasuk.disabled = false;
          btnMasuk.textContent = "Masuk ke Sistem";
        }
        if (res.success) {
          toast("Autentikasi berhasil.");
          fetchInit(function(){ showScreen('dash'); });
        } else {
          toast(res.message || "Gagal masuk. Periksa username dan password.");
        }
      })
      .catch(function(err){
        if (btnMasuk) {
          btnMasuk.disabled = false;
          btnMasuk.textContent = "Masuk ke Sistem";
        }
        toast("Terjadi kesalahan jaringan atau server: " + err.message);
      });
  }

  document.getElementById("btnMasuk").onclick = doLogin;
  ['lu', 'lp'].forEach(function(inpId){
    var el = document.getElementById(inpId);
    if (el) {
      el.addEventListener('keydown', function(e){
        if (e.key === 'Enter') {
          e.preventDefault();
          doLogin();
        }
      });
    }
  });

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