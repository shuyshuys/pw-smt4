<?php
include('../../p10/pages/auth/koneksi.php');
require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = null;
$filePath = 'path/to/your/spreadsheet.xlsx';


if (file_exists($filePath)) {
    $spreadsheet = IOFactory::load($filePath);
    $sheet = $spreadsheet->getActiveSheet();
    $startRow = $sheet->getHighestRow() + 1;
} else {
    // Jika file tidak ada, buat spreadsheet baru
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $startRow = $sheet->getHighestRow() + 1;
    $header = [
        'No', 'Tanggal Pengisian', 'Jenis Pendaftaran', 'Tanggal Masuk Sekolah', 'NIS', 'No. Peserta Ujian', 'Apakah Pernah PAUD', 'Apakah Pernah TK',
        'No. Seri SKHUN Sebelumnya', 'No. Seri Ijazah Sebelumnya', 'Hobi', 'Cita-cita', 'Nama Lengkap', 'Jenis Kelamin', 'NISN', 'NIK', 'Tempat Lahir',
        'Tanggal Lahir', 'Agama', 'Berkebutuhan Khusus', 'Alamat', 'RT', 'RW', 'Dusun', 'Kelurahan', 'Kecamatan', 'Kode Pos', 'Tempat Tinggal', 'Transportasi',
        'No. HP', 'No. Telepon', 'Email Pribadi', 'Penerima KPS/PKH/KIP', 'No. KPS/PKH/KIP', 'Kewarganegaraan', 'Nama Negara', 'Nama Ayah', 'Tahun Lahir Ayah',
        'Pendidikan Ayah', 'Pekerjaan Ayah', 'Penghasilan Ayah', 'Berkebutuhan Khusus Ayah', 'Nama Ibu', 'Tahun Lahir Ibu', 'Pendidikan Ibu', 'Pekerjaan Ibu',
        'Penghasilan Ibu', 'Berkebutuhan Khusus Ibu'
    ];
    $sheet->fromArray($header, null, 'A1');
}


// $sheet->setCellValue('A1', 'No');
// $sheet->setCellValue('B1', 'Tanggal Pengisian');
// $sheet->setCellValue('C1', 'Jenis Pendaftaran');
// $sheet->setCellValue('D1', 'Tanggal Masuk Sekolah');
// $sheet->setCellValue('E1', 'NIS');
// $sheet->setCellValue('F1', 'No. Peserta Ujian');
// $sheet->setCellValue('G1', 'Apakah Pernah PAUD');
// $sheet->setCellValue('H1', 'Apakah Pernah TK');
// $sheet->setCellValue('I1', 'No. Seri SKHUN Sebelumnya');
// $sheet->setCellValue('J1', 'No. Seri Ijazah Sebelumnya');
// $sheet->setCellValue('K1', 'Hobi');
// $sheet->setCellValue('L1', 'Cita-cita');

// $sheet->setCellValue('M1', 'Nama Lengkap');
// $sheet->setCellValue('N1', 'Jenis Kelamin');
// $sheet->setCellValue('O1', 'NISN');
// $sheet->setCellValue('P1', 'NIK');
// $sheet->setCellValue('Q1', 'Tempat Lahir');
// $sheet->setCellValue('R1', 'Tanggal Lahir');
// $sheet->setCellValue('S1', 'Agama');
// $sheet->setCellValue('T1', 'Berkebutuhan Khusus');
// $sheet->setCellValue('U1', 'Alamat');
// $sheet->setCellValue('V1', 'RT');
// $sheet->setCellValue('W1', 'RW');
// $sheet->setCellValue('X1', 'Dusun');
// $sheet->setCellValue('Y1', 'Kelurahan');
// $sheet->setCellValue('Z1', 'Kecamatan');
// $sheet->setCellValue('AA1', 'Kode Pos');
// $sheet->setCellValue('AB1', 'Tempat Tinggal');
// $sheet->setCellValue('AC1', 'Moda Transportasi');
// $sheet->setCellValue('AD1', 'No. HP');
// $sheet->setCellValue('AE1', 'No. Telepon');
// $sheet->setCellValue('AF1', 'Email Pribadi');
// $sheet->setCellValue('AG1', 'Penerima KPS/PKH/KIP');
// $sheet->setCellValue('AH1', 'No. KPS/PKH/KIP');
// $sheet->setCellValue('AH1', 'Kewarganegaraan');
// $sheet->setCellValue('AI1', 'Nama Negara');

// $sheet->setCellValue('AJ1', 'Nama Ayah');
// $sheet->setCellValue('AK1', 'Tahun Lahir Ayah');
// $sheet->setCellValue('AL1', 'Pendidikan Ayah');
// $sheet->setCellValue('AM1', 'Pekerjaan Ayah');
// $sheet->setCellValue('AR1', 'Penghasilan Ayah');
// $sheet->setCellValue('AR1', 'Kebutuhan Khusus Ayah');

// $sheet->setCellValue('AO1', 'Nama Ibu');
// $sheet->setCellValue('AP1', 'Tahun Lahir Ibu');
// $sheet->setCellValue('AQ1', 'Pendidikan Ibu');
// $sheet->setCellValue('AR1', 'Pekerjaan Ibu');
// $sheet->setCellValue('AR1', 'Penghasilan Ibu');
// $sheet->setCellValue('AR1', 'Kebutuhan Khusus Ibu');

// $query = "SELECT
// r.id_registrasi,
// r.tanggal_pendaftaran, 
// r.nis,
// r.no_peserta_ujian,
// paud.keterangan,
// tk.keterangan,
// r.no_skhun,
// r.no_ijazah,
// h.nama_hobi,
// c.nama_cita,

// s.nama_lengkap,
// jk.nama_jenis_kelamin,
// s.nisn,
// s.nik,
// s.tempat_lahir,
// s.tgl_lahir,
// ag.nama_agama,
// bk.nama_kebutuhan_khusus,

// al.alamat_jalan,
// al.rt,
// al.rw,
// al.dusun,
// al.kelurahan_desa,
// al.kecamatan,
// al.kode_pos,
// tt.nama_tempat_tinggal,
// mt.nama_moda_transportasi,

// s.no_hp,
// s.nomor_telepon,
// s.email,
// kps.keterangan,
// s.no_kps_kks_pkh_kip,
// kw.keterangan,
// -- s.nama_negara,

// oa.nama_ayah,
// oa.tahun_lahir,
// pda.nama_pendidikan_ortu,
// pka.nama_pekerjaan_ortu,
// pha.jumlah_penghasilan_ortu,
// kka.nama_kebutuhan_khusus,

// oi.nama_ibu,
// oi.tahun_lahir,
// pdi.nama_pendidikan_ortu,
// pki.nama_pekerjaan_ortu,
// phi.jumlah_penghasilan_ortu,
// kki.nama_kebutuhan_khusus,

// jp.keterangan_pendaftaran,
// r.tgl_masuk_sekolah

// FROM registrasi r
// JOIN cita c ON r.id_cita = c.id_cita
// JOIN hobi h ON r.id_hobi = h.id_hobi
// JOIN jenis_pendaftaran jp ON r.id_pendaftaran = jp.id_pendaftaran
// JOIN paud ON r.kode_paud = paud.kode_paud
// JOIN tk ON r.kode_tk = tk.kode_tk
// JOIN siswa s ON r.id_siswa = s.id_siswa
// JOIN agama ag ON s.id_agama = ag.id_agama
// JOIN kebutuhan_khusus bk ON s.id_kebutuhan_khusus = bk.id_kebutuhan_khusus
// JOIN alamat al ON s.id_alamat = al.id_alamat
// JOIN tempat_tinggal tt ON s.id_tempat_tinggal = tt.id_tempat_tinggal
// JOIN moda_transportasi mt ON mt.id_moda_transportasi = s.id_moda_transportasi
// JOIN jenis_kelamin jk ON s.kode_jenis_kelamin = jk.kode_jenis_kelamin
// JOIN kps_kks_pkh_kip kps ON s.kode_kps_kks_pkh_kip = kps.kode_kps_kks_pkh_kip
// JOIN kewarganegaraan kw ON s.kode_kewarganegaraan = kw.kode_kewarganegaraan

// JOIN ortu_ayah oa ON s.id_siswa = oa.id_siswa
// JOIN ortu_ibu oi ON s.id_siswa= oi.id_siswa

// JOIN pekerjaan_ortu pka ON oa.id_pekerjaan_ortu = pka.id_pekerjaan_ortu
// JOIN pekerjaan_ortu pki ON oi.id_pekerjaan_ortu = pki.id_pekerjaan_ortu

// JOIN pendidikan_ortu pda ON oa.id_pendidikan_ortu = pda.id_pendidikan_ortu
// JOIN pendidikan_ortu pdi ON oi.id_pendidikan_ortu = pdi.id_pendidikan_ortu

// JOIN penghasilan_ortu pha ON oa.id_penghasilan_ortu = pha.id_penghasilan_ortu
// JOIN penghasilan_ortu phi ON oi.id_penghasilan_ortu = phi.id_penghasilan_ortu

// JOIN kebutuhan_khusus kka ON oa.id_kebutuhan_khusus = kka.id_kebutuhan_khusus
// JOIN kebutuhan_khusus kki ON oi.id_kebutuhan_khusus = kki.id_kebutuhan_khusus

// WHERE r.id_registrasi = '1759001'";

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

$result = mysqli_query($koneksi, $query);
$i = 2;

$data = mysqli_fetch_all($result);

$sheet->fromArray($data, null, 'A2');

// while ($row = mysqli_fetch_array($result)) {
//     $sheet->setCellValue('B' . $i, $row['nama']);
//     $sheet->setCellValue('C' . $i, $row['KELAS']);
//     $sheet->setCellValue('D' . $i, $row['alamat']);
//     $i++;
// }

$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
];

// $i = $i - 1;
// $sheet->getStyle('A1:D' . $i)->applyFromArray($styleArray);

$writer = new Xlsx($spreadsheet);
$writer->save('Report Data Siswa.xlsx');
