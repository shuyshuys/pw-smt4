-- Buat tabel dengan nama kontak dalam database Anda. Field-fieldnya adalah:
-- Field Tipe Data Panjang Keterangan
-- id integer 4 Not null, auto_increment
-- Nama Varchar 30 Not null
-- jkel Varchar 10 -
-- Email Varchar 40 -
-- Alamat Varchar 50 -
-- Kota Varchar 20 -
-- Pesan text 
CREATE TABLE kontak (
    id INT(4) NOT NULL AUTO_INCREMENT,
    Nama VARCHAR(30) NOT NULL,
    jkel VARCHAR(10),
    Email VARCHAR(40),
    Alamat VARCHAR(50),
    Kota VARCHAR(20),
    Pesan TEXT,
    PRIMARY KEY (id)
);
