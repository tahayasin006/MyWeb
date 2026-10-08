<?php require_once __DIR__.'/../app/config.php'; ?>
<!doctype html><html lang="tr"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Adres ve Ödeme | 3Byaz</title>
<style>body{font-family:Arial;background:#f6f6f6;margin:0}.wrap{width:min(900px,92%);margin:30px auto}.box{background:#fff;padding:25px;border-radius:12px;margin-bottom:20px}label{display:block;font-weight:700;margin:12px 0 6px}input,textarea,select{width:100%;padding:12px;border:1px solid #ddd;border-radius:7px}button{background:#ff6a00;color:#fff;border:0;padding:14px 20px;border-radius:7px;font-weight:700;width:100%}.summary{font-size:18px;font-weight:700}</style></head><body>
<div class="wrap"><h1>Adres ve Ödeme</h1><div class="box"><h2>Teslimat Bilgileri</h2>
<label>Ad Soyad</label><input id="name" required><label>E-posta</label><input id="email" type="email" required><label>Telefon</label><input id="phone" required><label>İl</label><input id="city"><label>İlçe</label><input id="district"><label>Posta Kodu</label><input id="postal"><label>Adres</label><textarea id="address" rows="4"></textarea></div>
<div class="box"><h2>Ödeme</h2><select id="method"><option value="iyzico">Kredi/Banka Kartı — iyzico</option><option value="eft">Havale/EFT</option></select><p class="summary">Sepet toplamı: <span id="total">hesaplanıyor...</span></p><button onclick="placeOrder()">Siparişi Oluştur ve Ödemeye Geç</button><p id="msg"></p></div></div>
<script>
async function placeOrder(){
 let cart=JSON.parse(localStorage.getItem('3byaz_cart')||'[]');if(!cart.length)return msg.textContent='Sepet boş.';
 let customer={name:name.value,email:email.value,phone:phone.value,city:city.value,district:district.value,postal_code:postal.value,address:address.value};
 if(!customer.name||!customer.email||!customer.phone||!customer.address)return msg.textContent='Lütfen zorunlu alanları doldurun.';
 let r=await fetch('api.php?action=create-order',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({items:cart,customer,payment_method:method.value})});let d=await r.json();
 if(!d.ok)return msg.textContent=d.message;
 localStorage.removeItem('3byaz_cart');location.href='success.php?order='+encodeURIComponent(d.order_no)+'&total='+encodeURIComponent(d.total);
}
</script></body></html>
