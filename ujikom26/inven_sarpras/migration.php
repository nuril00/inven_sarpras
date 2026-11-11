<?php
require 'config/Database.php';
$db = new Database();
$koneksi = $db->koneksi;

try {
    // 1. Tambah Kolom Baru di Tabel Inventaris
    $koneksi->exec("ALTER TABLE inventaris 
        ADD COLUMN merek VARCHAR(50) DEFAULT '-',
        ADD COLUMN tahun_perolehan YEAR,
        ADD COLUMN sumber_dana VARCHAR(50) DEFAULT '-',
        ADD COLUMN satuan VARCHAR(20) DEFAULT 'Unit',
        ADD COLUMN keterangan TEXT;
    ");

    // 2. Tambah Kolom Jabatan di Tabel Pegawai
    $koneksi->exec("ALTER TABLE pegawai ADD COLUMN jabatan VARCHAR(50) DEFAULT 'Siswa';");

    // 3. Tambah Kolom Keperluan di Tabel Peminjaman
    $koneksi->exec("ALTER TABLE peminjaman ADD COLUMN keperluan VARCHAR(255) DEFAULT '-';");

    // 4. Bersihkan Data Ruang & Jenis Lama
    $koneksi->exec("DELETE FROM ruang");
    $koneksi->exec("DELETE FROM jenis");

    // 5. Masukkan 59 Data Ruangan (Sesuai Excel)
    $ruangan = [
        'Kepala Sekolah', 'Guru dan Wks. Kurikulum', 'wks kesiswaan dan Bk', 'Wks Hubin dan BKK', 
        'TU Keuangan', 'TU Administrasi', 'UKS', 'Osis', 'Pramuka', 'Paskibra', 'Kantor Prusahaan DUDI', 
        'Sarana Prasarana dan Gudang', 'IT SUPPORT', 'LAB 1 PPLG', 'LAB 2 PPLG', 'LAB 3D ANIMASI', 
        'LAB GAMBAR', 'LAB DKV', 'LAB AKUNTANSI', 'LAB BAHSA', 'LAB PEMASARAN', 'LAB PPLG 3', 'LAB PPLG 4', 
        'LAB PPLG 5', 'LAB PPLG IOT', 'LAB BROADCAST', 'SABLON', 'LAB CETAK', 'Studio FOTO', 'KESENIAN', 
        'PERPUSTAKAAN', 'XII AKUNTANSI 1', 'XII AKUNTANSI 2', 'XII DKV', 'XII ANIMASI', 'GUDANG KURSI', 
        'XII PPLG 1', 'XII PPLG 2', 'XI AKT', 'KOSONG', 'XI PPLG 1', 'XI PPLG 2', 'X PPLG 1', 'X PPLG 2', 
        'XI DKV', 'XI ANIMASI', 'X DKV 2', 'X DKV 1', 'KOSONG', 'X AKUNTANSI 2', 'GUDANG KURSI', 
        'X AKUNTANSI 1', 'KELAS KOSONG 1', 'KELAS KOSONG 2', 'KELAS KOSONG 3', 'KLAS KOSONG GD DEPAN 1', 
        'KLAS KOSONG GD DEPAN 2', 'KLAS KOSONG GD DEPAN 3', 'KLAS KOSONG GD DEPAN 4'
    ];
    
    $stmt_ruang = $koneksi->prepare("INSERT INTO ruang (nama_ruang, kode_ruang) VALUES (?, ?)");
    foreach ($ruangan as $index => $nama) {
        $kode = 'R' . str_pad(($index + 1), 2, '0', STR_PAD_LEFT);
        $stmt_ruang->execute([$nama, $kode]);
    }

    // 6. Masukkan Data Jenis
    $koneksi->exec("INSERT INTO jenis (nama_jenis, kode_jenis) VALUES 
        ('PERABOTAN', 'PRB'), 
        ('ELEKTRONIK', 'ELK'), 
        ('ALAT PRAKTIK/LAB', 'LAB')
    ");

    echo "<h3 style='color:green;'>✅ Migrasi Database Berhasil!</h3>";
    echo "<p>Kolom baru telah ditambahkan, dan 59 Ruangan serta 3 Jenis telah dimasukkan.</p>";
    echo "<a href='admin/index.php'>Kembali ke Dashboard</a>";

} catch (PDOException $e) {
    die("Error Migrasi: " . $e->getMessage());
}
?>