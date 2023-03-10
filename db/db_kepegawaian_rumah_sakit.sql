-- ddl
CREATE DATABASE db_kepegawaian_rumah_sakit;

USE db_kepegawaian_rumah_sakit;

CREATE TABLE tb_jabatan(
	id_jabatan INT AUTO_INCREMENT,
	nama_jabatan VARCHAR(255),
	PRIMARY KEY(id_jabatan),
	UNIQUE(nama_jabatan)
);

CREATE TABLE tb_bidang(
	id_bidang INT AUTO_INCREMENT,
	nama_bidang VARCHAR(255),
	PRIMARY KEY(id_bidang),
	UNIQUE(nama_bidang)
);

CREATE TABLE tb_ruangan(
	id_ruangan INT AUTO_INCREMENT,
	nama_ruangan VARCHAR(255),
	PRIMARY KEY(id_ruangan),
	UNIQUE(nama_ruangan)
);

CREATE TABLE tb_pegawai(
	id_pegawai INT AUTO_INCREMENT,
	id_jabatan INT,
	id_bidang INT,
	id_ruangan INT,
	username VARCHAR(255),
	email VARCHAR(255),
	password_pg VARCHAR(255),
	nip VARCHAR(18),
	nama VARCHAR(255),
	foto_profile MEDIUMBLOB,
	no_hp VARCHAR(15),
	alamat VARCHAR(255),
	kecamatan VARCHAR(255),
	kabupaten VARCHAR(255),
	negara VARCHAR(255),
	agama VARCHAR(255),
	jenis_kelamin ENUM('L','P'),
	golongan_darah ENUM('A','B','AB','O'),
	tempat_lahir VARCHAR(255),
	tgl_lahir DATE,
	status_kawin ENUM('Kawin','Belum Kawin'),
	no_ktp VARCHAR(16),
	file_ktp MEDIUMBLOB,
	tahun_masuk YEAR,
	jenis_kontrak VARCHAR(255),
	tgl_buat TIMESTAMP,
	PRIMARY KEY(id_pegawai),
	FOREIGN KEY(id_jabatan) REFERENCES tb_jabatan(id_jabatan),
	FOREIGN KEY(id_bidang) REFERENCES tb_bidang(id_bidang),
	FOREIGN KEY(id_ruangan) REFERENCES tb_ruangan(id_ruangan),
	UNIQUE(username),
	UNIQUE(nip),
	UNIQUE(no_ktp)
);

CREATE TABLE tb_jadwal(
	id_jadwal INT AUTO_INCREMENT,
	shift ENUM('Pagi','Siang','Malam'),
	jam ENUM('07:00-15:00','15:00-21:00','21:00-07:00'),
	tgl DATE,
	status_jadwal ENUM('Y','N'),
	PRIMARY KEY(id_jadwal)
);

CREATE TABLE tb_jadwal_detail(
	id_jadwal INT AUTO_INCREMENT,
	id_pegawai INT,
	FOREIGN KEY(id_jadwal) REFERENCES tb_jadwal(id_jadwal),
	FOREIGN KEY(id_pegawai) REFERENCES tb_pegawai(id_pegawai),
	UNIQUE(id_jadwal, id_pegawai)
);

CREATE TABLE tb_pengumuman(
	id_pengumuman INT AUTO_INCREMENT,
	judul VARCHAR(255),
	tgl DATE,
	konten TEXT,
	media MEDIUMBLOB,
	status_pengumuman ENUM('Y','N'),
	PRIMARY KEY(id_pengumuman)
);

CREATE TABLE tb_pengumuman_detail(
	id_pengumuman INT AUTO_INCREMENT,
	id_pegawai INT,
	FOREIGN KEY(id_pengumuman) REFERENCES tb_pengumuman(id_pengumuman),
	FOREIGN KEY(id_pegawai) REFERENCES tb_pegawai(id_pegawai),
	UNIQUE(id_pengumuman, id_pegawai)
);

CREATE TABLE tb_panduan(
	id_panduan INT AUTO_INCREMENT,
	judul VARCHAR(255),
	tgl DATE,
	konten TEXT,
	media MEDIUMBLOB,
	status_panduan ENUM('Y','N'),
	PRIMARY KEY(id_panduan)
);

CREATE TABLE tb_panduan_detail(
	id_panduan INT AUTO_INCREMENT,
	id_pegawai INT,
	FOREIGN KEY(id_panduan) REFERENCES tb_panduan(id_panduan),
	FOREIGN KEY(id_pegawai) REFERENCES tb_pegawai(id_pegawai),
	UNIQUE(id_panduan, id_pegawai)
);

CREATE TABLE tb_pengajuan(
	id_pengajuan INT AUTO_INCREMENT,
	id_pegawai INT,
	jenis_pengajuan ENUM('Pengajuan Cuti Tahunan','Pengajuan Cuti Melahirkan','Pengajuan Naik Tingkat'),
	tgl_masuk DATE,
	tgl_konfirmasi DATE,
	status_pengajuan ENUM('Diterima','Pending','Ditolak'),
	konten TEXT,
	media MEDIUMBLOB,
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

INSERT INTO tb_bidang (nama_bidang) VALUES 
("Kesehatan"),
("Kebershian"),
("Pengendali Api");

INSERT INTO tb_ruangan (nama_ruangan) VALUES 
("Anggrek"),
("Melati"),
("Ratna");

INSERT INTO tb_pegawai (
	id_jabatan,
	username,
	email,
	password_pg,
	nip,
	nama,
	foto_profile,
	no_hp,
	alamat,
	kecamatan,
	kabupaten,
	negara,
	agama,
	jenis_kelamin,
	golongan_darah,
	tempat_lahir,
	tgl_lahir,
	status_kawin,
	no_ktp,
	file_ktp,
	tahun_masuk,
	jenis_kontrak
) VALUES (
	"1", 
	"admin", 
	"test@gmail.com", 
	"$2y$10$muK9xltRI5MxRJwcfozGjepKNMElNZLoArpDumW9tjyv3NeAyEdUy", 
	"123",
	"Test",
	"", 
	"081", 
	"Jl. Test", 
	"Kec. Test", 
	"Kab. Test", 
	"Neg. Test", 
	"Agama", 
	"L", 
	"A", 
	"Test", 
	"2012-12-12", 
	"Kawin", 
	"5555", 
	"", 
	"2012", 
	"Pegawai Tetap"
);
