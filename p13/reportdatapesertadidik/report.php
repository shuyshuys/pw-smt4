<?php
include('../../p10/pages/auth/koneksi.php');
require '../reportexcel/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = null;
$filePath = 'Report Data Siswa.xlsx';
echo $filePath . "<br>";


if (file_exists($filePath)) {
    // Jika file sudah ada, load file tersebut
    $spreadsheet = IOFactory::load($filePath);
    echo "Load file " . $filePath . "<br>";
    // Ambil sheet yang aktif
    $sheet = $spreadsheet->getActiveSheet();
} else {
    // Jika file tidak ada, buat spreadsheet baru
    echo "File tidak ditemukan, membuat file baru <br>";
    $spreadsheet = new Spreadsheet();
    echo "File " . $filePath . " telah dibuat! <br>";
    // Buat sheet baru
    $sheet = $spreadsheet->getActiveSheet();
    // Set judul sheet
    $sheet->setTitle('Data Peserta Didik');

    // Buat header kolom
    $header = [
        'No', 'Tanggal Pengisian', 'Jenis Pendaftaran', 'Tanggal Masuk Sekolah', 'NIS', 'No. Peserta Ujian', 'Apakah Pernah PAUD', 'Apakah Pernah TK',
        'No. Seri SKHUN Sebelumnya', 'No. Seri Ijazah Sebelumnya', 'Hobi', 'Cita-cita', 'Nama Lengkap', 'Jenis Kelamin', 'NISN', 'NIK', 'Tempat Lahir',
        'Tanggal Lahir', 'Agama', 'Berkebutuhan Khusus', 'Alamat', 'RT', 'RW', 'Dusun', 'Kelurahan', 'Kecamatan', 'Kode Pos', 'Tempat Tinggal', 'Transportasi',
        'No. HP', 'No. Telepon', 'Email Pribadi', 'Penerima KPS/PKH/KIP', 'No. KPS/PKH/KIP', 'Kewarganegaraan', 'Nama Ayah', 'Tahun Lahir Ayah',
        'Pendidikan Ayah', 'Pekerjaan Ayah', 'Penghasilan Ayah', 'Berkebutuhan Khusus Ayah', 'Nama Ibu', 'Tahun Lahir Ibu', 'Pendidikan Ibu', 'Pekerjaan Ibu',
        'Penghasilan Ibu', 'Berkebutuhan Khusus Ibu'
    ];
    $sheet->fromArray($header, null, 'A1');
}

// Ambil data dari database
$query = "SELECT
r.id_registrasi,
r.tanggal_pendaftaran,
jp.keterangan_pendaftaran,
r.tgl_masuk_sekolah,
r.nis,
r.no_peserta_ujian,
paud.keterangan,
tk.keterangan,
r.no_skhun,
r.no_ijazah,
h.nama_hobi,
c.nama_cita,
s.nama_lengkap,
jk.nama_jenis_kelamin,
s.nisn,
s.nik,
s.tempat_lahir,
s.tgl_lahir,
ag.nama_agama,
bk.nama_kebutuhan_khusus,
al.alamat_jalan,
al.rt,
al.rw,
al.dusun,
al.kelurahan_desa,
al.kecamatan,
al.kode_pos,
tt.nama_tempat_tinggal,
mt.nama_moda_transportasi,
s.no_hp,
s.nomor_telepon,
s.email,
kps.keterangan,
s.no_kps_kks_pkh_kip,
kw.keterangan,
oa.nama_ayah,
oa.tahun_lahir,
pda.nama_pendidikan_ortu,
pka.nama_pekerjaan_ortu,
pha.jumlah_penghasilan_ortu,
kka.nama_kebutuhan_khusus,
oi.nama_ibu,
oi.tahun_lahir,
pdi.nama_pendidikan_ortu,
pki.nama_pekerjaan_ortu,
phi.jumlah_penghasilan_ortu,
kki.nama_kebutuhan_khusus
FROM
registrasi r
LEFT JOIN jenis_pendaftaran jp ON r.id_pendaftaran = jp.id_pendaftaran
LEFT JOIN paud ON r.kode_paud = paud.kode_paud
LEFT JOIN tk ON r.kode_tk = tk.kode_tk
LEFT JOIN hobi h ON r.id_hobi = h.id_hobi
LEFT JOIN cita c ON r.id_cita = c.id_cita
LEFT JOIN siswa s ON r.id_siswa = s.id_siswa
LEFT JOIN jenis_kelamin jk ON s.kode_jenis_kelamin = jk.kode_jenis_kelamin
LEFT JOIN agama ag ON s.id_agama = ag.id_agama
LEFT JOIN kebutuhan_khusus bk ON s.id_kebutuhan_khusus = bk.id_kebutuhan_khusus
LEFT JOIN alamat al ON s.id_alamat = al.id_alamat
LEFT JOIN tempat_tinggal tt ON s.id_tempat_tinggal = tt.id_tempat_tinggal
LEFT JOIN moda_transportasi mt ON s.id_moda_transportasi = mt.id_moda_transportasi
LEFT JOIN kps_kks_pkh_kip kps ON s.kode_kps_kks_pkh_kip = kps.kode_kps_kks_pkh_kip
LEFT JOIN kewarganegaraan kw ON s.kode_kewarganegaraan = kw.kode_kewarganegaraan
LEFT JOIN ortu_ayah oa ON s.id_siswa = oa.id_siswa
LEFT JOIN ortu_ibu oi ON s.id_siswa= oi.id_siswa
LEFT JOIN pekerjaan_ortu pka ON oa.id_pekerjaan_ortu = pka.id_pekerjaan_ortu
LEFT JOIN pekerjaan_ortu pki ON oi.id_pekerjaan_ortu = pki.id_pekerjaan_ortu
LEFT JOIN pendidikan_ortu pda ON oa.id_pendidikan_ortu = pda.id_pendidikan_ortu
LEFT JOIN pendidikan_ortu pdi ON oi.id_pendidikan_ortu = pdi.id_pendidikan_ortu
LEFT JOIN penghasilan_ortu pha ON oa.id_penghasilan_ortu = pha.id_penghasilan_ortu
LEFT JOIN penghasilan_ortu phi ON oi.id_penghasilan_ortu = phi.id_penghasilan_ortu
LEFT JOIN kebutuhan_khusus kka ON oa.id_kebutuhan_khusus = kka.id_kebutuhan_khusus
LEFT JOIN kebutuhan_khusus kki ON oi.id_kebutuhan_khusus = kki.id_kebutuhan_khusus;";

// jalankan query
$result = mysqli_query($koneksi, $query);

// ambil semua data dan masukkan ke variable $data
$data = mysqli_fetch_all($result);

echo "Memulai Export Data...<br>";
// memasukkan data ke sheet
$sheet->fromArray($data, null, 'A2');

// set style border
$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
];

// set style border ke semua cell yang memiliki data
$startRow = $sheet->getHighestRow();
$sheet->getStyle('A1:AU' . $startRow)->applyFromArray($styleArray);

// set autofit column width
for ($column = 'A'; $column <= 'Z'; $column++) {
    $spreadsheet->getActiveSheet()->getColumnDimension($column)->setAutoSize(true);
}

// set dan tulis ke file excel
$writer = new Xlsx($spreadsheet);
$writer->save('Report Data Siswa.xlsx');

echo "Selesai Export Data...<br>";
echo "<script>alert('Data Berhasil Di Export!');</script>";
// button untuk download file Report Data Siswa.xlsx
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Excel Data Registrasi Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../default.css">
</head>

<body class="container">
    <!-- menambahkan button untuk download file report -->
    <a class="btn btn-success" href='download.php' download>Download Report Data Siswa</a>
</body>

</html>