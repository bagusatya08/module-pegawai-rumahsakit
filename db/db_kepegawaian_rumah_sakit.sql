-- ddl
CREATE DATABASE db_kepegawaian_rumah_sakit;

USE db_kepegawaian_rumah_sakit;

CREATE TABLE tb_jabatan(
	id_jabatan INT AUTO_INCREMENT,
	nama_jabatan VARCHAR(255),
	PRIMARY KEY(id_jabatan)
);

CREATE TABLE tb_pegawai(
	id_pegawai INT AUTO_INCREMENT,
	id_jabatan INT,
	username VARCHAR(255),
	email VARCHAR(255),
	password_pg VARCHAR(255),
	nip VARCHAR(18),
	nama VARCHAR(255),
	no_hp VARCHAR(15),
	alamat VARCHAR(255),
	foto_profile MEDIUMBLOB,
	kecamatan VARCHAR(255),
	kabupaten VARCHAR(255),
	negara VARCHAR(255),
	agama VARCHAR(255),
	jenis_kelamin ENUM('L','P'),
	golongan_darah CHAR(3),
	tempat_lahir VARCHAR(255),
	tgl_lahir DATE,
	status_kawin VARCHAR(255),
	no_ktp VARCHAR(16),
	file_ktp BLOB,
	tahun_masuk YEAR,
	jenis_kontrak VARCHAR(255),
	bidang VARCHAR(255),
	ruangan VARCHAR(255),
	tgl_buat TIMESTAMP,
	PRIMARY KEY(id_pegawai),
	FOREIGN KEY(id_jabatan) REFERENCES tb_jabatan(id_jabatan),
	UNIQUE(username)
);

CREATE TABLE tb_jadwal(
	id_jadwal INT AUTO_INCREMENT,
	shift VARCHAR(255),
	STATUS VARCHAR(255),
	tgl DATE,
	PRIMARY KEY(id_jadwal)
);

CREATE TABLE tb_jadwal_detail(
	id_jadwal INT AUTO_INCREMENT,
	id_pegawai INT,
	FOREIGN KEY(id_jadwal) REFERENCES tb_jadwal(id_jadwal),
	FOREIGN KEY(id_pegawai) REFERENCES tb_pegawai(id_pegawai)
);

CREATE TABLE tb_pengumuman(
	id_pengumuman INT AUTO_INCREMENT,
	judul VARCHAR(255),
	tgl DATE,
	konten TEXT,
	media BLOB,
	PRIMARY KEY(id_pengumuman)
);

CREATE TABLE tb_pengumuman_detail(
	id_pengumuman INT AUTO_INCREMENT,
	id_pegawai INT,
	FOREIGN KEY(id_pengumuman) REFERENCES tb_pengumuman(id_pengumuman),
	FOREIGN KEY(id_pegawai) REFERENCES tb_pegawai(id_pegawai)
);

CREATE TABLE tb_panduan(
	id_panduan INT AUTO_INCREMENT,
	judul VARCHAR(255),
	tgl DATE,
	konten TEXT,
	media BLOB,
	PRIMARY KEY(id_panduan)
);

CREATE TABLE tb_panduan_detail(
	id_panduan INT AUTO_INCREMENT,
	id_pegawai INT,
	FOREIGN KEY(id_panduan) REFERENCES tb_panduan(id_panduan),
	FOREIGN KEY(id_pegawai) REFERENCES tb_pegawai(id_pegawai)
);

CREATE TABLE tb_pengajuan(
	id_pengajuan INT AUTO_INCREMENT,
	id_pegawai INT,
	judul VARCHAR(30),
	tgl_masuk DATE,
	tgl_konfirmasi DATE,
	STATUS VARCHAR(255),
	konten TEXT,
	media BLOB,
	PRIMARY KEY(id_pengajuan),
	FOREIGN KEY(id_pegawai) REFERENCES tb_pegawai(id_pegawai)
);


-- dml
INSERT INTO tb_jabatan (nama_jabatan) VALUES 
("Admin"),
("Direktur"),
("Kepala Bidang"),
("Kepala Ruangan"),
("Pegawai");

INSERT INTO tb_pegawai (id_jabatan, username, password_pg, nip, nama, no_hp, email,
alamat, kecamatan, kabupaten, negara, agama, jenis_kelamin, golongan_darah, 
tempat_lahir, tgl_lahir, status_kawin, no_ktp, file_ktp, tahun_masuk, jenis_kontrak,
bidang, ruangan) VALUES 
("1", "admin", "admin", "1", "Test", "081", "test@gmail.com", "Jl. Test", "Kec. Test", "Kab. Test", 
"Neg. Test", "Agama", "L", "A", "Test", "2012-12-12", "Kawin", "5555", "", "2012", "Test", "Bd. Test", "R. Test"),
("1", "admin2", "admin", "1", "Test", "081", "test@gmail.com", "Jl. Test", "Kec. Test", "Kab. Test", 
"Neg. Test", "Agama", "L", "A", "Test", "2012-12-12", "Kawin", "5555", "", "2012", "Test", "Bd. Test", "R. Test");

