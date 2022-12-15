CREATE DATABASE db_kepegawaian_rumah_sakit;

CREATE TABLE tb_jabatan(
	id_jabatan INT AUTO_INCREMENT,
	nama_jabatan VARCHAR(30),
	PRIMARY KEY(id_jabatan)
);

CREATE TABLE tb_pegawai(
	id_pegawai INT AUTO_INCREMENT,
	id_jabatan INT,
	username_pegawai VARCHAR(30),
	password_pegawai VARCHAR(255),
	nip_pegawai VARCHAR(18),
	nama_pegawai VARCHAR(30),
	no_hp_pegawai VARCHAR(15),
	email_pegawai VARCHAR(30),
	alamat_pegawai VARCHAR(80),
	kecamatan_pegawai VARCHAR(30),
	kabupaten_pegawai VARCHAR(30),
	negara_pegawai VARCHAR(30),
	agama_pegawai VARCHAR(30),
	jenis_kelamin_pegawai ENUM('L','P'),
	golongan_darah_pegawai CHAR(3),
	tempat_lahir_pegawai VARCHAR(30),
	tgl_lahir_pegawai DATE,
	status_kawin_pegawai VARCHAR(30),
	no_ktp_pegawai VARCHAR(16),
	file_ktp_pegawai BLOB,
	tahun_masuk_pegawai YEAR,
	jenis_kontrak_pegawai VARCHAR(30),
	bidang_pegawai VARCHAR(30),
	ruangan_pegawai VARCHAR(30),
	PRIMARY KEY(id_pegawai),
	FOREIGN KEY(id_jabatan) REFERENCES tb_jabatan(id_jabatan),
	UNIQUE (username_pegawai)
);

CREATE TABLE tb_jadwal(
	id_jadwal INT AUTO_INCREMENT,
	shift_jadwal VARCHAR(30),
	status_jadwal VARCHAR(30),
	tgl_jadwal DATE,
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
	judul_pengumuman VARCHAR(30),
	tgl_pengumuman DATE,
	konten_pengumuman TEXT,
	media_pengumuman BLOB,
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
	judul_panduan VARCHAR(30),
	tgl_panduan DATE,
	konten_panduan TEXT,
	media_panduan BLOB,
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
	judul_pengajuan VARCHAR(30),
	tgl_masuk_pengajuan DATE,
	tgl_konfirmasi_pengajuan DATE,
	status_pengajuan VARCHAR(30),
	konten_pengajuan TEXT,
	media_pengajuan BLOB,
	PRIMARY KEY(id_pengajuan),
	FOREIGN KEY(id_pegawai) REFERENCES tb_pegawai(id_pegawai)
);