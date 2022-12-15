INSERT INTO tb_jabatan (nama_jabatan) VALUES 
("Admin"),
("Direktur"),
("Kepala Bidang"),
("Kepala Ruangan"),
("Pegawai");

INSERT INTO tb_pegawai (id_jabatan, username_pegawai, password_pegawai, nip_pegawai, nama_pegawai, no_hp_pegawai, email_pegawai,
alamat_pegawai, kecamatan_pegawai, kabupaten_pegawai, negara_pegawai, agama_pegawai, jenis_kelamin_pegawai, golongan_darah_pegawai, 
tempat_lahir_pegawai, tgl_lahir_pegawai, status_kawin_pegawai, no_ktp_pegawai, file_ktp_pegawai, tahun_masuk_pegawai, jenis_kontrak_pegawai,
bidang_pegawai, ruangan_pegawai) VALUES 
("1", "admin", "admin", "1", "Test", "081", "test@gmail.com", "Jl. Test", "Kec. Test", "Kab. Test", 
"Neg. Test", "Agama", "L", "A", "Test", "2012-12-12", "Kawin", "5555", "", "2012", "Test", "Bd. Test", "R. Test");