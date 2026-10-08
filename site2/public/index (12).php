<?php
// ======================================================
// 3BYAZ - ANA SAYFA (index.php)
// ======================================================
$siteName = "3Byaz";
$siteDescription = "3Byaz - 3D yazıcı ile üretilen özgün figürler, dekorasyon ürünleri, hediyelikler ve kişiye özel tasarımlar.";

// Ayarlar (WhatsApp, kargo, iyzico) config.php'den, ürünler products.php'den gelir.
require __DIR__ . '/config.php';
require __DIR__ . '/products.php';

// >>> ÜRÜN BİLGİLERİ: kartlara tıklayınca açılan penceredeki yazılar. Buradan düzenleyebilirsin. <<<
$descriptions = [
  "Çiçek Lamba" => "Çiçek formunda tasarlanmış dekoratif lamba. Yumuşak ışığı ve zarif yapısıyla salon, yatak odası ya da çalışma masasına şık bir atmosfer katar.",
  "Flexi Fenek Tilkisi" => "Çöl tilkisi fenekten ilham alan, kocaman kulaklı ve iri gözlü sevimli eklemli figür. Gövdesi ve kuyruğu hareketli parçalardan oluşur, istediğin pozda durur.",
  "Flexi Kaplan" => "Canlı turuncu-siyah çizgileri ve tatlı ifadesiyle eklemli kaplan figürü. Kuyruğu ve gövdesi esner, elinde stres atmak için de raf süsü olarak da harika.",
  "Flexi Sincap" => "Gülen yüzü ve kıvrık kuyruğuyla dost canlısı eklemli sincap. Doğal toprak tonlarıyla her ortama yakışır, hareketli yapısıyla oynamaya davet eder.",
  "Flexi Rakun" => "Maskeli yüzü ve iri gözleriyle herkesin sevdiği eklemli rakun. Halka halka kuyruğu esner, farklı pozlarda sergilenebilir.",
  "Flexi Leopar Gecko" => "Parlak sarı rengi ve meraklı bakışlarıyla eklemli leopar gecko. Kuyruğu parça parça hareket eder, koleksiyonların favorisi olmaya aday.",
  "Fiyonklu Kalemlik" => "Fiyonk detaylı şirin kalemlik. Masandaki kalem ve fırçaları toplu tutarken çalışma alanına tatlı bir dokunuş katar.",
  "Çok Bölmeli Organizer" => "Farklı boyutlardaki bölmeleriyle kalem, makas, not kağıdı ve küçük kırtasiyeleri düzenli tutan masaüstü organizer.",
  "Fiyonklu Kapaklı Kutu" => "Kapağındaki fiyonk detayıyla hediye vermelik şık kutu. Takı, küçük aksesuar ve hatıra eşyalarını saklamak için ideal.",
  "İstiridye Mücevher Kutusu" => "İstiridye formunda tasarlanmış, yüzük ve küçük takılar için mücevher kutusu. Sevdiklerine verebileceğin özel bir hediye seçeneği.",
];
$catFeatures = [
  "OYUNCAK"    => ["Eklemli, hareketli gövde ve kuyruk", "Çok renkli 3D baskı", "Masa, raf ve çalışma alanı için ideal", "Çocuklar ve koleksiyonerler için sevimli hediye"],
  "DEKORASYON" => ["Modern ve özgün tasarım", "Ortama sıcak bir hava katar", "3D baskı ile özenle üretilir", "Hediye olarak çok uygun"],
  "MASAÜSTÜ"   => ["Masaüstünü düzenli tutar", "Hafif ve dayanıklı yapı", "Şık ve sevimli tasarım", "Ofis, ev ve ders çalışma alanı için uygun"],
  "HEDİYELİK"  => ["Özel günler için ideal", "Şık ve özgün tasarım", "Küçük eşyaları saklamaya uygun", "Hediye paketlemeye uygun"],
];
$commonDetails = [
  "Üretim"  => "3D yazıcı ile özenle basılır",
  "Malzeme" => "PLA filament",
  "Renk"    => "Fotoğraftaki renkler. Farklı renk için WhatsApp'tan yaz",
  "Bakım"   => "Sıcaktan ve doğrudan güneşten uzak tut, kuru ya da hafif nemli bezle sil",
  "Kargo"   => number_format($freeShipping, 0, ',', '.') . " TL ve üzeri siparişlerde ücretsiz",
  "Not"     => "El emeği 3D baskı olduğu için çok küçük katman izleri olabilir, bu üretim yönteminin doğal bir parçasıdır",
];
?>
<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= h($siteName) ?> | 3D Baskı Ürünleri</title>
<meta name="description" content="<?= h($siteDescription) ?>">
<meta name="keywords" content="3d baskı, 3d yazıcı ürünleri, 3d figür, kişiye özel 3d baskı, dekorasyon, 3byaz">
<meta name="theme-color" content="#111111">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box}
html{scroll-behavior:smooth;scrollbar-gutter:stable;scroll-padding-top:140px}
body{font-family:"Inter",sans-serif;background:#f7f7f7;color:#171717}
img{width:100%;display:block}
button,input{font-family:inherit}
button{cursor:pointer}
a{text-decoration:none;color:inherit}
.container{width:min(1400px,92%);margin:auto}

/* TOP BAR */
.top-bar{background:#111;color:#fff;text-align:center;padding:10px;font-size:13px;font-weight:600}
.top-bar span{color:#ff6a00}

/* HEADER */
header{background:#fff;position:sticky;top:0;z-index:1000;border-bottom:1px solid #eee}
.header-main{height:92px;display:flex;align-items:center;gap:35px}
.logo{font-size:54px;font-weight:900;letter-spacing:-2px;white-space:nowrap}
.logo span{color:#ff6a00}
.search-box{flex:1;position:relative}
.search-box input{width:100%;height:46px;border:1px solid #ddd;border-radius:8px;padding:0 50px 0 17px;outline:none;background:#fafafa;transition:.2s}
.search-box input:focus{border-color:#ff6a00;background:#fff}
.search-icon{position:absolute;right:16px;top:12px;font-size:20px}
.header-actions{display:flex;gap:22px;align-items:center}
.header-action{border:none;background:none;position:relative;font-size:22px}
.header-action small{display:block;font-size:11px;margin-top:3px}
.cart-count{position:absolute;top:-7px;right:-9px;width:19px;height:19px;border-radius:50%;background:#ff6a00;color:#fff;font-size:10px;display:flex;align-items:center;justify-content:center;font-weight:700}

/* NAV */
.navigation{border-top:1px solid #eee}
.nav-inner{height:52px;display:flex;align-items:center;gap:28px}
.nav-link{font-size:14px;font-weight:600;transition:.2s}
.nav-link:hover{color:#ff6a00}
.nav-link.category{color:#ff6a00}

/* HERO */
.hero{position:relative;overflow:hidden;min-height:580px;background:radial-gradient(circle at 80% 20%,#ff741e 0%,transparent 30%),linear-gradient(110deg,#111 0%,#171717 60%,#262626 100%);color:#fff}
.hero-content{min-height:580px;display:flex;align-items:center}
.hero-text{max-width:650px;position:relative;z-index:1}
.hero-tag{display:inline-block;background:rgba(255,106,0,.15);color:#ff7a1a;border:1px solid rgba(255,106,0,.4);padding:9px 15px;border-radius:30px;font-size:13px;font-weight:700;margin-bottom:25px}
.hero h1{font-size:clamp(42px,6vw,75px);line-height:1.02;letter-spacing:-3px;margin-bottom:25px}
.hero h1 span{color:#ff6a00}
.hero p{color:#cfcfcf;font-size:17px;line-height:1.7;max-width:580px;margin-bottom:35px}
.hero-buttons{display:flex;gap:14px;flex-wrap:wrap}
.btn{display:inline-block;padding:14px 23px;border-radius:8px;font-weight:700;border:none;transition:.25s}
.btn-primary{background:#ff6a00;color:#fff}
.btn-primary:hover{background:#e85e00;transform:translateY(-2px)}
.btn-outline{background:transparent;color:#fff;border:1px solid #555}
.btn-outline:hover{border-color:#ff6a00;color:#ff6a00}
.hero-shape{position:absolute;right:8%;top:100px;width:380px;height:380px;border-radius:30% 70% 60% 40%;background:linear-gradient(135deg,#ff6a00,#ff9b50);opacity:.9;transform:rotate(25deg);filter:drop-shadow(0 30px 60px rgba(0,0,0,.4))}
.hero-shape::before{content:"3D";position:absolute;inset:0;display:flex;align-items:center;justify-content:center;font-size:120px;font-weight:900;color:rgba(255,255,255,.85);transform:rotate(-25deg)}

/* FEATURES */
.features{background:#fff;border-bottom:1px solid #eee;padding:0}
.feature-grid{display:grid;grid-template-columns:repeat(4,1fr);padding:25px 0}
.feature{display:flex;gap:13px;align-items:center;justify-content:center;border-right:1px solid #eee}
.feature:last-child{border:none}
.feature-icon{font-size:27px}
.feature strong{display:block;font-size:13px}
.feature span{font-size:11px;color:#777}

/* SECTION */
section{padding:80px 0}
.section-head{display:flex;justify-content:space-between;align-items:end;margin-bottom:30px}
.section-title{font-size:30px;letter-spacing:-1px}
.section-subtitle{color:#777;margin-top:7px;font-size:14px}
.view-all{color:#ff6a00;font-size:14px;font-weight:700}

/* PRODUCTS */
.products{background:#fff}
.product-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:20px}
.product-card{background:#fff;border:1px solid #e9e9e9;border-radius:12px;overflow:hidden;position:relative;transition:.3s}
.product-card:hover{transform:translateY(-5px);box-shadow:0 15px 35px rgba(0,0,0,.09)}
.product-image{aspect-ratio:4/5;background:#f3f3f3;position:relative;overflow:hidden}
.product-image img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;transition:opacity .4s ease,transform .5s ease}
.product-image .p-alt{opacity:0}
.product-card:hover .p-alt{opacity:1}
.product-card:hover .p-main{transform:scale(1.03)}
.product-badge{z-index:2}
.product-badge{position:absolute;top:12px;left:12px;background:#ff6a00;color:#fff;padding:6px 9px;font-size:10px;font-weight:800;border-radius:5px}
.product-info{padding:18px}
.product-category{font-size:11px;color:#888;margin-bottom:7px}
.product-name{font-size:15px;font-weight:700;margin-bottom:10px}
.rating{font-size:12px;color:#ff6a00;margin-bottom:12px}
.price{font-size:20px;font-weight:900}
.product-bottom{display:flex;justify-content:space-between;align-items:center}
.add-cart{border:none;background:#111;color:#fff;padding:9px 13px;border-radius:7px;font-size:12px;font-weight:700}
.add-cart:hover{background:#ff6a00}

/* PRODUCT MODAL */
.product-card{cursor:pointer}
.product-more{font-size:12px;color:#ff6a00;font-weight:700;margin:-4px 0 12px}
.pm-overlay{position:fixed;inset:0;background:rgba(0,0,0,.6);z-index:2100;display:none;align-items:center;justify-content:center;padding:20px}
.pm-overlay.active{display:flex}
.pm-box{overscroll-behavior:contain;background:#fff;border-radius:16px;width:min(980px,100%);max-height:92vh;overflow-y:auto;position:relative;display:grid;grid-template-columns:1fr 1fr}
.pm-close{position:absolute;top:12px;right:12px;width:38px;height:38px;border:none;border-radius:50%;background:#111;color:#fff;font-size:22px;z-index:3}
.pm-close:hover{background:#ff6a00}
.pm-gallery{padding:20px;background:#f7f7f7;border-radius:16px 0 0 16px}
.pm-main{aspect-ratio:4/5;border-radius:12px;overflow:hidden;background:#eee}
.pm-main img{width:100%;height:100%;object-fit:contain;background:#f3f3f3}
.pm-thumbs{display:flex;gap:10px;margin-top:12px}
.pm-thumb{width:64px;height:64px;border-radius:8px;overflow:hidden;border:2px solid transparent;padding:0;background:#eee}
.pm-thumb.active{border-color:#ff6a00}
.pm-thumb img{width:100%;height:100%;object-fit:cover}
.pm-info{padding:30px 28px}
.pm-cat{font-size:11px;font-weight:800;color:#ff6a00;letter-spacing:1px;margin-bottom:8px}
.pm-title{font-size:28px;letter-spacing:-1px;margin-bottom:10px}
.pm-price{font-size:26px;font-weight:900;margin-bottom:16px}
.pm-desc{color:#555;line-height:1.7;font-size:14px;margin-bottom:18px}
.pm-info h4{font-size:13px;margin:18px 0 10px}
.pm-features{list-style:none;display:grid;gap:8px}
.pm-features li{font-size:13px;color:#333}
.pm-features li::before{content:"✓";color:#ff6a00;font-weight:900;margin-right:9px}
.pm-details{width:100%;border-collapse:collapse;font-size:13px}
.pm-details th{text-align:left;color:#888;font-weight:600;padding:8px 12px 8px 0;width:30%;vertical-align:top;border-bottom:1px solid #eee}
.pm-details td{padding:8px 0;border-bottom:1px solid #eee;color:#333}
.pm-actions{display:flex;gap:10px;margin-top:22px;flex-wrap:wrap}
.pm-actions .btn{flex:1;text-align:center;font-size:14px;padding:13px 16px}
.pm-add{background:#111;color:#fff}
.pm-add:hover{background:#ff6a00}
.pm-ask{background:#25D366;color:#fff}
@media(max-width:750px){
.pm-overlay{padding:0;align-items:flex-end}
.pm-box{display:block;border-radius:16px 16px 0 0;max-height:92vh;max-height:92dvh;-webkit-overflow-scrolling:touch;overscroll-behavior:contain}
.pm-close{position:sticky;top:10px;right:auto;display:block;margin:10px 10px -48px auto}
.pm-gallery{border-radius:16px 16px 0 0;padding:14px}
.pm-main{aspect-ratio:4/5}
.pm-actions{position:sticky;bottom:0;background:#fff;padding:12px 0 calc(12px + env(safe-area-inset-bottom));margin-top:18px;border-top:1px solid #eee}
.pm-info{padding:20px 18px 26px}
.pm-title{font-size:23px}
}

/* CUSTOM */
.custom-section{background:#111;color:#fff}
.custom-box{display:grid;grid-template-columns:1.2fr .8fr;gap:60px;align-items:center}
.custom-box h2{font-size:42px;letter-spacing:-2px;margin-bottom:18px}
.custom-box h2 span{color:#ff6a00}
.custom-box p{color:#aaa;line-height:1.8;margin-bottom:25px}
.custom-list{list-style:none;display:grid;gap:12px;margin-bottom:30px}
.custom-list li{font-size:14px}
.custom-list li::before{content:"✓";color:#ff6a00;font-weight:900;margin-right:10px}
.custom-card{background:#1d1d1d;border:1px solid #333;border-radius:15px;padding:35px;text-align:center}
.upload-icon{font-size:65px;margin-bottom:15px}
.custom-card h3{margin-bottom:10px}
.custom-card p{font-size:13px}

/* NEWSLETTER */
.newsletter{background:#ff6a00;color:#fff}
.newsletter-inner{display:flex;justify-content:space-between;align-items:center;gap:30px}
.newsletter h2{font-size:28px;margin-bottom:7px}
.newsletter p{opacity:.85;font-size:13px}
.newsletter-form{display:flex;background:#fff;padding:5px;border-radius:8px;min-width:430px}
.newsletter-form input{flex:1;border:none;outline:none;padding:12px}
.newsletter-form button{border:none;background:#111;color:#fff;border-radius:6px;padding:0 18px;font-weight:700}

/* FOOTER */
footer{background:#111;color:#fff;padding:60px 0 30px}
.footer-grid{display:grid;grid-template-columns:1.5fr 1fr 1fr 1fr;gap:40px;padding-bottom:40px}
.footer-logo{font-size:42px;font-weight:900;letter-spacing:-1.5px;margin-bottom:15px}
.footer-logo span{color:#ff6a00}
.footer-about{color:#999;font-size:13px;line-height:1.8;max-width:320px}
footer h4{margin-bottom:17px}
footer ul{list-style:none}
footer li{margin-bottom:11px;color:#999;font-size:13px}
footer li:hover{color:#ff6a00}
.copyright{border-top:1px solid #292929;padding-top:25px;color:#666;font-size:12px}

/* CART DRAWER */
.cart-overlay{position:fixed;inset:0;background:rgba(0,0,0,.55);z-index:2000;display:none}
.cart-overlay.active{display:block}
.cart-drawer{position:absolute;right:0;top:0;height:100%;height:100dvh;width:min(420px,100%);background:#fff;padding:25px;display:flex;flex-direction:column}
.cart-header{display:flex;justify-content:space-between;align-items:center;padding-bottom:20px;border-bottom:1px solid #eee}
.cart-close{border:none;background:none;font-size:25px}
.cart-scroll{flex:1;overflow-y:auto;overscroll-behavior:contain}
.cart-items{padding:20px 0}
.qty{display:inline-flex;align-items:center;border:1px solid #ddd;border-radius:7px;margin-top:8px}
.qty button{width:30px;height:30px;border:none;background:none;font-size:17px;font-weight:700}
.qty span{min-width:26px;text-align:center;font-size:13px;font-weight:700}
.cart-line-price{font-size:13px;font-weight:700;display:block}
.cart-form{display:none;border-top:1px solid #eee;padding:18px 0 10px}
.cart-form.active{display:block}
.cart-form h3{font-size:14px;margin-bottom:12px}
.cart-form input,.cart-form textarea{width:100%;border:1px solid #ddd;border-radius:8px;padding:11px 12px;margin-bottom:9px;font-family:inherit;font-size:14px;outline:none;background:#fafafa}
.cart-form input:focus,.cart-form textarea:focus{border-color:#ff6a00;background:#fff}
.cart-form textarea{resize:vertical;min-height:70px}
.cart-sum{font-size:13px;color:#555;display:grid;gap:6px;margin-bottom:10px}
.cart-sum div{display:flex;justify-content:space-between}
.cart-ship-hint{font-size:12px;color:#ff6a00;font-weight:600;margin-bottom:8px}
.cart-note{font-size:11px;color:#888;line-height:1.5;margin-bottom:10px}
.empty-cart{text-align:center;color:#888;margin-top:80px}
.cart-item{display:flex;gap:12px;padding:12px 0;border-bottom:1px solid #eee}
.cart-item-image{width:70px;height:70px;background:#eee;border-radius:8px;overflow:hidden}
.cart-item-image img{width:100%;height:100%;object-fit:cover}
.cart-item-info{flex:1}
.cart-item-info h4{font-size:13px;margin-bottom:7px}
.cart-item-info span{font-size:13px;font-weight:700}
.remove-item{border:none;background:none;color:#aaa;font-size:20px}
.cart-footer{border-top:1px solid #eee;padding-top:14px;padding-bottom:env(safe-area-inset-bottom)}
.cart-total{display:flex;justify-content:space-between;margin-bottom:15px;font-size:18px;font-weight:800}
.whatsapp-order{width:100%;border:none;background:#25D366;color:#fff;padding:14px;border-radius:8px;font-weight:800}
.card-order{width:100%;border:none;background:#ff6a00;color:#fff;padding:14px;border-radius:8px;font-weight:800;margin-bottom:8px}
.card-order:disabled{opacity:.6}

/* SIDEBAR */
.sidebar-overlay{position:fixed;inset:0;background:rgba(0,0,0,.42);opacity:0;visibility:hidden;transition:.25s ease;z-index:1900;overscroll-behavior:contain}
.sidebar-overlay.active{opacity:1;visibility:visible}
.category-sidebar{position:fixed;top:0;left:0;width:270px;height:100vh;background:#fff;border-right:1px solid #e8e8e8;box-shadow:12px 0 35px rgba(0,0,0,.12);z-index:1950;transform:translateX(-105%);transition:transform .3s ease;display:flex;flex-direction:column;overflow-y:auto;overscroll-behavior:contain}
.category-sidebar.active{transform:translateX(0)}
.sidebar-head{min-height:92px;padding:0 20px;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid #eee;background:#111;color:#fff}
.sidebar-brand{font-size:32px;font-weight:900;letter-spacing:-1px}
.sidebar-brand span{color:#ff6a00}
.sidebar-close{width:38px;height:38px;border:0;border-radius:10px;background:rgba(255,255,255,.1);color:#fff;font-size:22px;transition:.2s}
.sidebar-close:hover{background:#ff6a00}
.sidebar-content{padding:22px 15px 30px}
.sidebar-title{margin:0 10px 12px;font-size:11px;font-weight:800;color:#999;letter-spacing:1.2px;text-transform:uppercase}
.sidebar-link{display:flex;align-items:center;gap:12px;width:100%;padding:13px 12px;margin-bottom:5px;border-radius:10px;color:#222;font-size:14px;font-weight:600;transition:.2s}
.sidebar-link:hover,.sidebar-link.active{background:#fff3ea;color:#ff6a00}
.side-icon{width:30px;text-align:center;font-size:19px}
.sidebar-divider{height:1px;background:#eee;margin:18px 10px}
.sidebar-note{margin:20px 10px 0;padding:15px;border-radius:12px;background:#111;color:#fff;font-size:12px;line-height:1.55}
.sidebar-note strong{color:#ff6a00;display:block;margin-bottom:5px}
body.sidebar-open,html.sidebar-lock{overflow:hidden}

/* WHATSAPP BUTONU */
.wa-float{position:fixed;right:22px;bottom:22px;z-index:1400;width:62px;height:62px;border-radius:50%;background:#25D366;display:flex;align-items:center;justify-content:center;box-shadow:0 8px 25px rgba(37,211,102,.5);transition:transform .25s,background .25s}
.wa-float:hover{background:#1ebe5b;transform:scale(1.08)}
.wa-float svg{width:36px;height:36px;fill:#fff;position:relative}
.wa-float::before{content:"";position:absolute;inset:0;border-radius:50%;background:#25D366;opacity:.5;z-index:-1;animation:waPulse 2.2s ease-out infinite}
@keyframes waPulse{0%{transform:scale(1);opacity:.5}100%{transform:scale(1.7);opacity:0}}

/* MOBILE */
.mobile-bottom{display:none}
@media(max-width:1000px){
.product-grid{grid-template-columns:repeat(3,1fr)}
.hero-shape{opacity:.25}
.custom-box{grid-template-columns:1fr}
}
@media(max-width:750px){
.top-bar{font-size:11px}
.header-main{height:76px;gap:12px}
.logo{font-size:40px}
.search-box,.navigation{display:none}
.header-actions{margin-left:auto;gap:12px}
.header-action small{display:none}
.hero,.hero-content{min-height:560px}
.hero h1{font-size:45px;letter-spacing:-2px}
.hero p{font-size:14px}
.hero-shape{width:260px;height:260px;right:-100px;top:80px}
.feature-grid{grid-template-columns:repeat(2,1fr)}
.feature{padding:12px;border-bottom:1px solid #eee}
section{padding:55px 0}
.section-title{font-size:25px}
.product-grid{grid-template-columns:repeat(2,1fr);gap:10px}
.product-info{padding:13px}
.product-name{font-size:13px}
.price{font-size:17px}
.add-cart{font-size:10px;padding:8px}
.custom-box h2{font-size:32px}
.newsletter-inner{flex-direction:column;align-items:stretch}
.newsletter-form{min-width:0}
.footer-grid{grid-template-columns:1fr 1fr}
.category-sidebar{width:min(86vw,320px)}
.wa-float{right:14px;bottom:80px;width:56px;height:56px}
.wa-float svg{width:32px;height:32px}
.mobile-bottom{display:flex;position:fixed;bottom:0;left:0;right:0;background:#fff;border-top:1px solid #ddd;height:65px;z-index:1500;justify-content:space-around;align-items:center}
.mobile-bottom a{font-size:10px;text-align:center}
.mobile-bottom strong{display:block;font-size:20px;margin-bottom:2px}
body{padding-bottom:65px}
}
@media(hover:none){.product-card:hover{transform:none}.product-card:hover .p-alt{opacity:0}.product-card:hover .p-main{transform:none}}
@media(max-width:450px){
.product-bottom{flex-direction:column;align-items:stretch;gap:5px}
.add-cart{width:100%}
.footer-grid{grid-template-columns:1fr}
}
</style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>
<aside class="category-sidebar" id="categorySidebar" aria-label="Ürün kategorileri">
  <div class="sidebar-head">
    <div class="sidebar-brand">3<span>Byaz.com</span></div>
    <button class="sidebar-close" id="sidebarClose" aria-label="Kategorileri kapat">×</button>
  </div>
  <div class="sidebar-content">
    <div class="sidebar-title">Kategoriler</div>
    <a class="sidebar-link active" href="#products"><span class="side-icon">📂</span><span>Tüm Kategoriler</span></a>
    <a class="sidebar-link" href="#products"><span class="side-icon">🤖</span><span>Figür &amp; Oyuncak</span></a>
    <a class="sidebar-link" href="#products"><span class="side-icon">🏠</span><span>Ev &amp; Dekorasyon</span></a>
    <a class="sidebar-link" href="#products"><span class="side-icon">🎁</span><span>Hediyelik</span></a>
    <a class="sidebar-link" href="#products"><span class="side-icon">🔑</span><span>Anahtarlık</span></a>
    <a class="sidebar-link" href="#products"><span class="side-icon">🖥️</span><span>Masaüstü</span></a>
    <a class="sidebar-link" href="#custom"><span class="side-icon">✨</span><span>Kişiye Özel Üretim</span></a>
    <div class="sidebar-divider"></div>
    <div class="sidebar-title">Mağaza</div>
    <a class="sidebar-link" href="#products"><span class="side-icon">🛍️</span><span>Tüm Ürünler</span></a>
    <div class="sidebar-note"><strong>✦ Kişiye özel tasarım</strong>Hayalindeki ürünü gönder, 3Byaz ekibi 3D baskıya hazırlasın.</div>
  </div>
</aside>

<div class="top-bar"><?= number_format($freeShipping, 0, ',', '.') ?> TL ve üzeri siparişlerde <span>ücretsiz kargo</span> 🎁</div>

<header>
  <div class="container header-main">
    <a href="#" class="logo">3<span>Byaz.com</span></a>
    <div class="search-box">
      <input type="text" id="searchInput" placeholder="Ürün, kategori veya ürün kodu ara...">
      <span class="search-icon">⌕</span>
    </div>
    <div class="header-actions">
      <button class="header-action" id="cartButton">🛒<span class="cart-count" id="cartCount">0</span><small>Sepet</small></button>
    </div>
  </div>
  <nav class="navigation">
    <div class="container nav-inner">
      <a href="#products" class="nav-link category" id="sidebarOpen">☰ Kategoriler</a>
      <a href="#products" class="nav-link">Tüm Ürünler</a>
      <a href="#custom" class="nav-link">Kişiye Özel</a>
      <a href="#contact" class="nav-link">Hakkımızda</a>
      <a href="#contact" class="nav-link">İletişim</a>
    </div>
  </nav>
</header>

<!-- HERO -->
<section class="hero">
  <div class="container hero-content">
    <div class="hero-text">
      <div class="hero-tag">✦ 3D YAZICI İLE ÜRETİLDİ</div>
      <h1>Hayal et.<br><span>Biz üretelim.</span></h1>
      <p>Modern 3D baskı teknolojisiyle üretilen özgün figürler, dekorasyon ürünleri, hediyelikler ve kişiye özel tasarımlar.</p>
      <div class="hero-buttons">
        <a href="#products" class="btn btn-primary">Ürünleri Keşfet →</a>
        <a href="#custom" class="btn btn-outline">Kişiye Özel Üretim</a>
      </div>
    </div>
  </div>
  <div class="hero-shape"></div>
</section>

<!-- FEATURES -->
<section class="features">
  <div class="container feature-grid">
    <div class="feature"><div class="feature-icon">🖨️</div><div><strong>3D Baskı ile Üretim</strong><span>Özenle hazırlanır</span></div></div>
    <div class="feature"><div class="feature-icon">🎨</div><div><strong>Farklı Renk Seçenekleri</strong><span>Ürününe uygun renk seç</span></div></div>
    <div class="feature"><div class="feature-icon">📦</div><div><strong>Güvenli Paketleme</strong><span>Özenli gönderim</span></div></div>
    <div class="feature"><div class="feature-icon">💬</div><div><strong>WhatsApp Destek</strong><span>Bize kolayca ulaş</span></div></div>
  </div>
</section>

<!-- PRODUCTS -->
<span id="products"></span>

<section class="products" id="new-products">
  <div class="container">
    <div class="section-head">
      <div>
        <h2 class="section-title">Ürünlerimiz</h2>
        <p class="section-subtitle">3D yazıcıyla özenle ürettiğimiz koleksiyon.</p>
      </div>
    </div>

    <div class="product-grid" id="productGrid">
<?php foreach ($products as $pid => $p):
  $img1 = "images/" . $p["images"][0];
  $img2 = isset($p["images"][1]) ? "images/" . $p["images"][1] : null;
  $info = [
    "id"       => $pid,
    "name"     => $p["name"],
    "cat"      => $p["cat"],
    "price"    => number_format($p["price"], 2, ',', '.') . " TL",
    "priceRaw" => number_format($p["price"], 2, '.', ''),
    "images"   => array_map(function($i){ return "images/" . $i; }, $p["images"]),
    "desc"     => isset($descriptions[$p["name"]]) ? $descriptions[$p["name"]] : "",
    "features" => isset($catFeatures[$p["cat"]]) ? $catFeatures[$p["cat"]] : [],
    "details"  => $commonDetails,
  ];
?>
      <article class="product-card" data-info="<?= h(json_encode($info, JSON_UNESCAPED_UNICODE)) ?>">
        <div class="product-image">
          <img class="p-main" src="<?= h($img1) ?>" alt="<?= h($p["name"]) ?>" width="800" height="1000" loading="lazy">
<?php if ($img2): ?>
          <img class="p-alt" src="<?= h($img2) ?>" alt="<?= h($p["name"]) ?> - ikinci görsel" width="800" height="1000" loading="lazy">
<?php endif; ?>
<?php if ($p["badge"] !== ""): ?>
          <span class="product-badge"><?= h($p["badge"]) ?></span>
<?php endif; ?>
        </div>
        <div class="product-info">
          <div class="product-category"><?= h($p["cat"]) ?></div>
          <h3 class="product-name"><?= h($p["name"]) ?></h3>
          <div class="product-more">Ürün bilgisi →</div>
          <div class="product-bottom">
            <strong class="price"><?= number_format($p["price"], 2, ',', '.') ?> TL</strong>
            <button class="add-cart"
              data-id="<?= (int)$pid ?>"
              data-product="<?= h($p["name"]) ?>"
              data-price="<?= number_format($p["price"], 2, '.', '') ?>"
              data-image="<?= h($img1) ?>">Sepete Ekle</button>
          </div>
        </div>
      </article>
<?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CUSTOM -->
<section class="custom-section" id="custom">
  <div class="container custom-box">
    <div>
      <div class="hero-tag">KİŞİYE ÖZEL ÜRETİM</div>
      <h2>Aklındaki ürünü <span>gerçeğe dönüştürelim.</span></h2>
      <p>Kendi tasarımını gönder veya fikrini bize anlat. Boyut, renk ve tasarım seçenekleriyle sana özel 3D baskı ürünler hazırlayalım.</p>
      <ul class="custom-list">
        <li>Kişiye özel isimlik ve anahtarlık</li>
        <li>Özel figür ve dekorasyon ürünleri</li>
        <li>STL / OBJ dosyasından üretim</li>
        <li>Farklı renk ve boyut seçenekleri</li>
      </ul>
      <a href="https://wa.me/<?= h($whatsapp) ?>" class="btn btn-primary" target="_blank" rel="noopener">WhatsApp'tan Teklif Al</a>
    </div>
    <div class="custom-card">
      <div class="upload-icon">📁</div>
      <h3>Tasarımını Gönder</h3>
      <p>Dosyanı veya istediğin ürünün görselini bize gönder. Üretilebilirliğini değerlendirelim.</p>
      <br>
      <button class="btn btn-outline" onclick="alert('Dosya yükleme sistemi sonraki aşamada aktif edilecek.')">Dosya Gönder</button>
    </div>
  </div>
</section>

<!-- NEWSLETTER -->
<section class="newsletter">
  <div class="container newsletter-inner">
    <div>
      <h2>Yeni ürünlerden haberdar ol.</h2>
      <p>Kampanyalar ve yeni tasarımlar için e-posta listemize katıl.</p>
    </div>
    <form class="newsletter-form" id="newsletterForm">
      <input type="email" placeholder="E-posta adresin" required>
      <button type="submit">Katıl</button>
    </form>
  </div>
</section>

<!-- FOOTER -->
<footer id="contact">
  <div class="container">
    <div class="footer-grid">
      <div>
        <div class="footer-logo">3<span>Byaz</span></div>
        <p class="footer-about">3D yazıcı teknolojisiyle özgün, kullanışlı ve eğlenceli ürünler tasarlıyor ve üretiyoruz.</p>
      </div>
      <div>
        <h4>Alışveriş</h4>
        <ul>
          <li><a href="#products">Tüm Ürünler</a></li>
          <li><a href="#products">Kategoriler</a></li>
        </ul>
      </div>
      <div>
        <h4>3Byaz</h4>
        <ul>
          <li>Hakkımızda</li>
          <li>İletişim</li>
          <li>Kargo &amp; Teslimat</li>
          <li>İade Koşulları</li>
        </ul>
      </div>
      <div>
        <h4>İletişim</h4>
        <ul>
          <li>📱 WhatsApp</li>
          <li>📧 info@3byaz.com</li>
          <li>📷 Instagram: @3byaz</li>
        </ul>
      </div>
    </div>
    <div class="copyright">© 2026 3Byaz.com — Tüm hakları saklıdır.</div>
  </div>
</footer>

<!-- PRODUCT MODAL -->
<div class="pm-overlay" id="pmOverlay">
  <div class="pm-box" role="dialog" aria-modal="true" id="pmBox">
    <button class="pm-close" id="pmClose" aria-label="Kapat">×</button>
    <div class="pm-gallery">
      <div class="pm-main"><img id="pmMainImg" src="" alt=""></div>
      <div class="pm-thumbs" id="pmThumbs"></div>
    </div>
    <div class="pm-info">
      <div class="pm-cat" id="pmCat"></div>
      <h2 class="pm-title" id="pmTitle"></h2>
      <div class="pm-price" id="pmPrice"></div>
      <p class="pm-desc" id="pmDesc"></p>
      <h4>Öne Çıkan Özellikler</h4>
      <ul class="pm-features" id="pmFeatures"></ul>
      <h4>Ürün Bilgileri</h4>
      <table class="pm-details"><tbody id="pmDetails"></tbody></table>
      <div class="pm-actions">
        <button class="btn pm-add" id="pmAdd">Sepete Ekle</button>
        <a class="btn pm-ask" id="pmAsk" href="#" target="_blank" rel="noopener">WhatsApp'tan Sor</a>
      </div>
    </div>
  </div>
</div>

<!-- CART DRAWER -->
<div class="cart-overlay" id="cartOverlay">
  <div class="cart-drawer">
    <div class="cart-header">
      <h2>Sepetim</h2>
      <button class="cart-close" id="cartClose">×</button>
    </div>
    <div class="cart-scroll">
      <div class="cart-items" id="cartItems">
        <div class="empty-cart">Sepetiniz şu anda boş.</div>
      </div>
      <div class="cart-form" id="cartForm">
        <h3>Teslimat Bilgileri</h3>
        <input type="text" id="cName" placeholder="Ad Soyad" autocomplete="name">
        <input type="tel" id="cPhone" placeholder="Telefon (05xx xxx xx xx)" autocomplete="tel">
        <input type="email" id="cEmail" placeholder="E-posta (kartla ödeme için gerekli)" autocomplete="email">
        <input type="text" id="cCity" placeholder="İl (örn. Ankara)" autocomplete="address-level1">
        <textarea id="cAddress" placeholder="Adres (mahalle, sokak, no, ilçe / il)" autocomplete="street-address"></textarea>
        <textarea id="cNote" placeholder="Sipariş notu (renk tercihi, kişiye özel istek vb.) - isteğe bağlı"></textarea>
      </div>
    </div>
    <div class="cart-footer">
      <div class="cart-ship-hint" id="cartShipHint"></div>
      <div class="cart-sum">
        <div><span>Ara Toplam</span><span id="cartSubtotal">0,00 TL</span></div>
        <div><span>Kargo</span><span id="cartShipping">-</span></div>
      </div>
      <div class="cart-total"><span>Toplam</span><span id="cartTotal">0,00 TL</span></div>
      <div class="cart-note"><?= h($paymentNote) ?></div>
      <?php if ($cardEnabled): ?>
      <button class="card-order" id="cardOrder">💳 Kartla Öde</button>
      <?php endif; ?>
      <button class="whatsapp-order" id="whatsappOrder">WhatsApp ile Sipariş Ver</button>
    </div>
  </div>
</div>

<!-- MOBILE NAV -->
<div class="mobile-bottom">
  <a href="#"><strong>⌂</strong>Ana Sayfa</a>
  <a href="#products" id="mobileCategories"><strong>☰</strong>Kategoriler</a>
  <a href="#products"><strong>⌕</strong>Ürünler</a>
  <a href="#" id="mobileCart"><strong>🛒</strong>Sepet</a>
</div>

<!-- WHATSAPP BUTONU -->
<a class="wa-float" href="https://wa.me/<?= h($whatsapp) ?>?text=<?= rawurlencode("Merhaba 3Byaz, ürünleriniz hakkında bilgi almak istiyorum.") ?>" target="_blank" rel="noopener" aria-label="WhatsApp ile yazın" title="WhatsApp ile yazın">
  <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
</a>

<script>
/* ===== CART ===== */
const FREE_SHIPPING = <?= json_encode((float)$freeShipping) ?>;
const SHIPPING_FEE  = <?= json_encode((float)$shippingFee) ?>;
const CART_KEY = "3byaz_cart_v2";
const CUST_KEY = "3byaz_cust_v1";
let cart = [];
try {
  const saved = JSON.parse(localStorage.getItem(CART_KEY) || "[]");
  if (Array.isArray(saved)) {
    cart = saved.filter(i => i && Number.isInteger(i.id) && typeof i.name === "string" && Number(i.price) > 0 && Number(i.qty) >= 1)
                .map(i => ({ id: i.id, name: i.name, price: Number(i.price), image: String(i.image || ""), qty: Math.min(99, Math.floor(Number(i.qty))) }));
  }
} catch (e) { cart = []; }

const cartButton  = document.getElementById("cartButton");
const cartOverlay = document.getElementById("cartOverlay");
const cartClose   = document.getElementById("cartClose");
const cartItems   = document.getElementById("cartItems");
const cartCount   = document.getElementById("cartCount");
const cartTotal   = document.getElementById("cartTotal");
const cartForm    = document.getElementById("cartForm");

function openCart()  { cartOverlay.classList.add("active"); }
function closeCart() { cartOverlay.classList.remove("active"); }

cartButton.addEventListener("click", openCart);
cartClose.addEventListener("click", closeCart);
cartOverlay.addEventListener("click", e => { if (e.target === cartOverlay) closeCart(); });

function formatTL(n) {
  return n.toLocaleString("tr-TR", { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + " TL";
}

function saveCart() {
  try { localStorage.setItem(CART_KEY, JSON.stringify(cart)); } catch (e) {}
}

function addToCart(id, name, price, image) {
  const found = cart.find(i => i.id === id);
  if (found) { found.qty = Math.min(99, found.qty + 1); }
  else { cart.push({ id: id, name: name, price: price, image: image, qty: 1 }); }
  updateCart();
}

function changeQty(index, delta) {
  if (!cart[index]) return;
  cart[index].qty += delta;
  if (cart[index].qty < 1) cart.splice(index, 1);
  else if (cart[index].qty > 99) cart[index].qty = 99;
  updateCart();
}

function removeItem(index) {
  cart.splice(index, 1);
  updateCart();
}

function calcTotals() {
  const subtotal = cart.reduce((t, i) => t + i.price * i.qty, 0);
  const shipping = (subtotal === 0 || subtotal >= FREE_SHIPPING) ? 0 : SHIPPING_FEE;
  return { subtotal: subtotal, shipping: shipping, total: subtotal + shipping };
}

function updateCart() {
  saveCart();
  cartCount.textContent = cart.reduce((t, i) => t + i.qty, 0);
  const hint = document.getElementById("cartShipHint");

  if (cart.length === 0) {
    cartItems.innerHTML = '<div class="empty-cart">Sepetiniz şu anda boş.</div>';
    cartForm.classList.remove("active");
    document.getElementById("cartSubtotal").textContent = "0,00 TL";
    document.getElementById("cartShipping").textContent = "-";
    cartTotal.textContent = "0,00 TL";
    hint.textContent = "";
    return;
  }

  cartForm.classList.add("active");
  cartItems.innerHTML = "";

  cart.forEach((item, index) => {
    const row = document.createElement("div");
    row.className = "cart-item";

    const imgWrap = document.createElement("div");
    imgWrap.className = "cart-item-image";
    const img = document.createElement("img");
    img.src = item.image;
    img.alt = "";
    imgWrap.appendChild(img);

    const info = document.createElement("div");
    info.className = "cart-item-info";
    const h4 = document.createElement("h4");
    h4.textContent = item.name;
    const price = document.createElement("span");
    price.className = "cart-line-price";
    price.textContent = formatTL(item.price * item.qty);

    const qty = document.createElement("div");
    qty.className = "qty";
    const minus = document.createElement("button");
    minus.textContent = "−";
    minus.setAttribute("aria-label", "Azalt");
    minus.addEventListener("click", () => changeQty(index, -1));
    const num = document.createElement("span");
    num.textContent = item.qty;
    const plus = document.createElement("button");
    plus.textContent = "+";
    plus.setAttribute("aria-label", "Arttır");
    plus.addEventListener("click", () => changeQty(index, 1));
    qty.appendChild(minus); qty.appendChild(num); qty.appendChild(plus);

    info.appendChild(h4); info.appendChild(price); info.appendChild(qty);

    const rm = document.createElement("button");
    rm.className = "remove-item";
    rm.textContent = "×";
    rm.setAttribute("aria-label", "Ürünü kaldır");
    rm.addEventListener("click", () => removeItem(index));

    row.appendChild(imgWrap); row.appendChild(info); row.appendChild(rm);
    cartItems.appendChild(row);
  });

  const t = calcTotals();
  document.getElementById("cartSubtotal").textContent = formatTL(t.subtotal);
  document.getElementById("cartShipping").textContent = t.shipping === 0 ? "Ücretsiz" : formatTL(t.shipping);
  cartTotal.textContent = formatTL(t.total);
  hint.textContent = t.shipping === 0
    ? "🎉 Ücretsiz kargo kazandınız!"
    : formatTL(FREE_SHIPPING - t.subtotal) + " daha ekleyin, kargo ücretsiz olsun.";
}

document.querySelectorAll(".add-cart").forEach(button => {
  button.addEventListener("click", function (e) {
    e.stopPropagation();
    addToCart(parseInt(this.dataset.id), this.dataset.product, parseFloat(this.dataset.price), this.dataset.image);
    openCart();
  });
});

/* müşteri bilgilerini hatırla */
const custFields = { name: "cName", phone: "cPhone", email: "cEmail", city: "cCity", address: "cAddress", note: "cNote" };
try {
  const c = JSON.parse(localStorage.getItem(CUST_KEY) || "{}");
  Object.keys(custFields).forEach(k => { if (c[k]) document.getElementById(custFields[k]).value = c[k]; });
} catch (e) {}
Object.keys(custFields).forEach(k => {
  document.getElementById(custFields[k]).addEventListener("input", () => {
    const c = {};
    Object.keys(custFields).forEach(x => c[x] = document.getElementById(custFields[x]).value);
    try { localStorage.setItem(CUST_KEY, JSON.stringify(c)); } catch (e) {}
  });
});

updateCart();

/* ===== WHATSAPP SİPARİŞ ===== */
document.getElementById("whatsappOrder").addEventListener("click", function () {
  if (cart.length === 0) { alert("Önce sepete ürün ekleyin."); return; }

  const name = document.getElementById("cName").value.trim();
  const phone = document.getElementById("cPhone").value.trim();
  const city = document.getElementById("cCity").value.trim();
  const address = document.getElementById("cAddress").value.trim();
  const note = document.getElementById("cNote").value.trim();

  if (name.length < 3) { alert("Lütfen ad soyadınızı yazın."); document.getElementById("cName").focus(); return; }
  if (phone.replace(/\D/g, "").length < 10) { alert("Lütfen geçerli bir telefon numarası yazın."); document.getElementById("cPhone").focus(); return; }
  if (address.length < 10) { alert("Lütfen teslimat adresinizi eksiksiz yazın."); document.getElementById("cAddress").focus(); return; }

  const t = calcTotals();
  const orderNo = "3B-" + Date.now().toString().slice(-6);

  let msg = "Merhaba 3Byaz, sipariş vermek istiyorum.\n";
  msg += "Sipariş No: " + orderNo + "\n\n";
  msg += "🛍️ Ürünler:\n";
  cart.forEach(i => { msg += "• " + i.name + " x" + i.qty + " - " + formatTL(i.price * i.qty) + "\n"; });
  msg += "\nAra Toplam: " + formatTL(t.subtotal);
  msg += "\nKargo: " + (t.shipping === 0 ? "Ücretsiz" : formatTL(t.shipping));
  msg += "\nGenel Toplam: " + formatTL(t.total) + "\n\n";
  msg += "👤 Ad Soyad: " + name + "\n";
  msg += "📞 Telefon: " + phone + "\n";
  msg += "📍 Adres: " + (city ? city + " - " : "") + address + "\n";
  if (note) msg += "📝 Not: " + note + "\n";

  window.open("https://wa.me/<?= h($whatsapp) ?>?text=" + encodeURIComponent(msg), "_blank");
});

/* ===== KARTLA ÖDEME ===== */
const cardBtn = document.getElementById("cardOrder");
if (cardBtn) cardBtn.addEventListener("click", async function () {
  if (cart.length === 0) { alert("Önce sepete ürün ekleyin."); return; }
  const v = id => document.getElementById(id).value.trim();
  const customer = { name: v("cName"), phone: v("cPhone"), email: v("cEmail"), city: v("cCity"), address: v("cAddress"), note: v("cNote") };

  if (customer.name.length < 3 || customer.name.indexOf(" ") === -1) { alert("Lütfen ad ve soyadınızı birlikte yazın."); return; }
  if (customer.phone.replace(/\D/g, "").length < 10) { alert("Lütfen geçerli bir telefon numarası yazın."); return; }
  if (!/^\S+@\S+\.\S+$/.test(customer.email)) { alert("Kartla ödeme için geçerli bir e-posta yazın."); return; }
  if (customer.city.length < 2) { alert("Lütfen il bilgisini yazın."); return; }
  if (customer.address.length < 10) { alert("Lütfen teslimat adresinizi eksiksiz yazın."); return; }

  const btn = this;
  btn.disabled = true; btn.textContent = "Ödeme sayfası açılıyor...";
  try {
    const res = await fetch("odeme.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ customer: customer, items: cart.map(i => ({ id: i.id, qty: i.qty })) })
    });
    const data = await res.json();
    if (data.ok && data.url) { window.location.href = data.url; return; }
    alert(data.error || "Ödeme başlatılamadı.");
  } catch (e) {
    alert("Bağlantı hatası. Lütfen tekrar deneyin.");
  }
  btn.disabled = false; btn.textContent = "💳 Kartla Öde";
});

/* ===== ÖDEME SONUCU ===== */
(function () {
  const r = new URLSearchParams(location.search).get("odeme");
  if (!r) return;
  if (r === "basarili") {
    cart = []; updateCart();
    alert("Ödemeniz alındı, teşekkürler! Siparişiniz hazırlanacak.");
  } else {
    alert("Ödeme tamamlanamadı. Sepetiniz duruyor, tekrar deneyebilir ya da WhatsApp ile sipariş verebilirsiniz.");
  }
  history.replaceState(null, "", location.pathname);
})();

/* ===== SEARCH ===== */
document.getElementById("searchInput").addEventListener("input", function () {
  const query = this.value.toLowerCase().trim();

  document.querySelectorAll(".product-card").forEach(card => {
    const name = (card.querySelector(".product-name")?.textContent || "").toLowerCase();
    const category = (card.querySelector(".product-category")?.textContent || "").toLowerCase();
    card.style.display = (name.includes(query) || category.includes(query)) ? "" : "none";
  });
});

/* ===== NEWSLETTER ===== */
document.getElementById("newsletterForm").addEventListener("submit", function (e) {
  e.preventDefault();
  alert("E-posta adresiniz başarıyla kaydedildi!");
  this.reset();
});

/* ===== MOBILE CART ===== */
document.getElementById("mobileCart").addEventListener("click", function (e) {
  e.preventDefault();
  openCart();
});

/* ===== CATEGORY SIDEBAR ===== */
const categorySidebar = document.getElementById("categorySidebar");
const sidebarOverlay  = document.getElementById("sidebarOverlay");
const sidebarOpen     = document.getElementById("sidebarOpen");
const sidebarClose    = document.getElementById("sidebarClose");
const mobileCategories = document.getElementById("mobileCategories");

function lockSidebarScroll() {
  document.documentElement.classList.add("sidebar-lock");
  document.body.classList.add("sidebar-open");
}

function unlockSidebarScroll() {
  document.documentElement.classList.remove("sidebar-lock");
  document.body.classList.remove("sidebar-open");
}

function openSidebar() {
  categorySidebar.classList.add("active");
  sidebarOverlay.classList.add("active");
  lockSidebarScroll();
}

function closeSidebar() {
  categorySidebar.classList.remove("active");
  sidebarOverlay.classList.remove("active");
  unlockSidebarScroll();
}

sidebarOpen.addEventListener("click", function (e) {
  e.preventDefault();
  e.stopPropagation();
  categorySidebar.classList.contains("active") ? closeSidebar() : openSidebar();
});

mobileCategories.addEventListener("click", function (e) {
  e.preventDefault();
  openSidebar();
});

sidebarClose.addEventListener("click", function (e) {
  e.preventDefault();
  e.stopPropagation();
  closeSidebar();
});

sidebarOverlay.addEventListener("click", closeSidebar);

document.querySelectorAll(".sidebar-link").forEach(link => {
  link.addEventListener("click", function (e) {
    document.querySelectorAll(".sidebar-link").forEach(item => item.classList.remove("active"));
    this.classList.add("active");

    const target = this.getAttribute("href");
    closeSidebar();

    if (target && target.startsWith("#")) {
      e.preventDefault();
      setTimeout(() => {
        const el = document.querySelector(target);
        if (el) el.scrollIntoView({ behavior: "smooth", block: "start" });
      }, 60);
    }
  });
});

document.addEventListener("keydown", function (e) {
  if (e.key === "Escape") {
    closeSidebar();
    closeCart();
    closeProduct();
  }
});

/* ===== PRODUCT MODAL ===== */
const pmOverlay = document.getElementById("pmOverlay");
let pmCurrent = null;
let pmScrollY = 0;

function openProduct(info) {
  pmCurrent = info;
  const mainImg = document.getElementById("pmMainImg");
  mainImg.src = info.images[0];
  mainImg.alt = info.name;

  const thumbs = document.getElementById("pmThumbs");
  thumbs.innerHTML = "";
  if (info.images.length > 1) {
    info.images.forEach((src, i) => {
      const b = document.createElement("button");
      b.className = "pm-thumb" + (i === 0 ? " active" : "");
      b.innerHTML = '<img src="' + src + '" alt="">';
      b.addEventListener("click", () => {
        mainImg.src = src;
        thumbs.querySelectorAll(".pm-thumb").forEach(t => t.classList.remove("active"));
        b.classList.add("active");
      });
      thumbs.appendChild(b);
    });
  }

  document.getElementById("pmCat").textContent = info.cat;
  document.getElementById("pmTitle").textContent = info.name;
  document.getElementById("pmPrice").textContent = info.price;
  document.getElementById("pmDesc").textContent = info.desc;

  const feats = document.getElementById("pmFeatures");
  feats.innerHTML = "";
  info.features.forEach(f => {
    const li = document.createElement("li");
    li.textContent = f;
    feats.appendChild(li);
  });

  const det = document.getElementById("pmDetails");
  det.innerHTML = "";
  Object.keys(info.details).forEach(k => {
    const tr = document.createElement("tr");
    const th = document.createElement("th");
    const td = document.createElement("td");
    th.textContent = k;
    td.textContent = info.details[k];
    tr.appendChild(th);
    tr.appendChild(td);
    det.appendChild(tr);
  });

  const msg = "Merhaba 3Byaz, \"" + info.name + "\" (" + info.price + ") hakkında bilgi almak istiyorum.";
  document.getElementById("pmAsk").href = "https://wa.me/<?= h($whatsapp) ?>?text=" + encodeURIComponent(msg);

  if (!pmOverlay.classList.contains("active")) {
    pmScrollY = window.scrollY;
    document.body.style.position = "fixed";
    document.body.style.top = "-" + pmScrollY + "px";
    document.body.style.left = "0";
    document.body.style.right = "0";
  }
  pmOverlay.classList.add("active");
  document.getElementById("pmBox").scrollTop = 0;
}

function closeProduct() {
  if (!pmOverlay.classList.contains("active")) return;
  pmOverlay.classList.remove("active");
  document.body.style.position = "";
  document.body.style.top = "";
  document.body.style.left = "";
  document.body.style.right = "";
  window.scrollTo({ top: pmScrollY, behavior: "instant" });
}

document.querySelectorAll(".product-card").forEach(card => {
  card.addEventListener("click", function (e) {
    if (e.target.closest(".add-cart")) return;
    try { openProduct(JSON.parse(this.dataset.info)); } catch (err) {}
  });
});

document.getElementById("pmClose").addEventListener("click", closeProduct);
pmOverlay.addEventListener("click", e => { if (e.target === pmOverlay) closeProduct(); });

document.getElementById("pmAdd").addEventListener("click", function () {
  if (!pmCurrent) return;
  addToCart(pmCurrent.id, pmCurrent.name, parseFloat(pmCurrent.priceRaw), pmCurrent.images[0]);
  closeProduct();
  openCart();
});
</script>
</body>
</html>
