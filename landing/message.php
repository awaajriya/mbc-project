<?php
$title = "Kirim Pesan - Mardira Business Center";
include __DIR__ . '/header.php';
?>
<section class="section-pad">
  <div class="container" style="max-width:720px; margin:40px auto;">
    <div class="card-box">
      <h2>Kirim Pesan untuk Bergabung</h2>
      <p>Isi formulir berikut untuk memberi tahu admin bahwa Anda ingin bergabung. Kami akan menghubungi Anda kembali.</p>

      <?php if (isset($_GET['sent']) && $_GET['sent'] == '1'): ?>
        <div style="padding:12px;background:#ecfdf5;border:1px solid #bbf7d0;margin:12px 0;border-radius:8px;color:#065f46;">Pesan terkirim. Email akan segera dikirim.</div>
      <?php endif; ?>

      <form action="submit_message.php" method="post">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:12px;">
          <input type="text" name="nama" placeholder="Nama lengkap" required style="padding:10px;border:1px solid #e6eef8;border-radius:8px;">
          <input type="email" name="email" placeholder="Email" required style="padding:10px;border:1px solid #e6eef8;border-radius:8px;">
        </div>
        <input type="text" name="subject" placeholder="Judul pesan" required style="width:100%;padding:10px;border:1px solid #e6eef8;border-radius:8px;margin-bottom:12px;">
        <textarea name="pesan" rows="6" placeholder="Tulis pesan Anda di sini..." required style="width:100%;padding:10px;border:1px solid #e6eef8;border-radius:8px;margin-bottom:12px;"></textarea>
        <div>
          <button type="submit" style="background:var(--blue);color:#fff;padding:12px 18px;border-radius:12px;border:none;">Kirim Pesan</button>
        </div>
      </form>
    </div>
  </div>
</section>

<?php include __DIR__ . '/footer.php'; ?>
