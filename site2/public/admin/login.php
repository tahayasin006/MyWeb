<?php
require_once __DIR__.'/../../app/helpers.php';
if($_SERVER['REQUEST_METHOD']==='POST'){
 $s=db()->prepare("SELECT * FROM admins WHERE username=?");$s->execute([$_POST['username']??'']);$a=$s->fetch();
 if($a && password_verify($_POST['password']??'',$a['password_hash'])){$_SESSION['admin_id']=$a['id'];header('Location: index.php');exit;}
 $err='Kullanıcı adı veya şifre hatalı.';
}
?><!doctype html><html lang="tr"><body style="font-family:Arial;background:#111;padding:60px"><form method="post" style="max-width:360px;margin:auto;background:#fff;padding:30px;border-radius:12px"><h2>3Byaz Admin</h2><?=isset($err)?'<p>'.$err.'</p>':''?><input name="username" placeholder="Kullanıcı adı" style="width:100%;padding:12px;margin:8px 0"><input name="password" type="password" placeholder="Şifre" style="width:100%;padding:12px;margin:8px 0"><button style="width:100%;padding:12px;background:#ff6a00;color:#fff;border:0">Giriş</button></form></body></html>
