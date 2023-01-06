const form = document.getElementById("form");
const username = document.getElementById("username");
const email = document.getElementById("email");
const password = document.getElementById("password");
const nip = document.getElementById("nip");
const nama = document.getElementById("nama");
const tahun_masuk = document.getElementById("tahun_masuk");
const jenis_kontrak = document.getElementById("jenis_kontrak");
const no_ktp = document.getElementById("no_ktp");
const telepon = document.getElementById("no_hp");
const alamat = document.getElementById("alamat");
const kecamatan = document.getElementById("kecamatan");
const kabupaten = document.getElementById("kabupaten");
const negara = document.getElementById("negara");
const tempat_lahir = document.getElementById("tempat_lahir");

var checker_username = false;
var checker_email = false;
var checker_password = false;
var checker_nip = false;
var checker_nama = false;
var checker_tahun_masuk = false;
var checker_jenis_kontrak = false;
var checker_no_ktp = false;
var checker_telepon = false;
var checker_alamat = false;
var checker_kecamatan = false;
var checker_kabupaten = false;
var checker_negara = false;
var checker_tempat_lahir = false;

username.addEventListener("keyup", function (e) {
    if (username.value === "") {
        // tampilkan error dan tambahkan class error
        setError(username, "username tidak boleh kosong");
        checker_username = false;
    } else if (cekSimbol(username.value)) {
        // tampilkan error dan tambahkan class error
        setError(username, "username tidak boleh mengandung simbol");
        checker_username = false;
    } else if (cekWhiteSpace(username.value)) {
        // tampilkan error dan tambahkan class error
        setError(username, "username tidak boleh mengandung white space");
        checker_username = false;
    } else {
        // tambahkan class success
        setSuccess(username);
        checker_username = true;
    }
});

email.addEventListener("keyup", function (e) {
    if (email.value === "") {
        // tampilkan error dan tambahkan class error
        setError(email, "Email tidak boleh kosong");
        checker_email = false;
    } else if (cekWhiteSpace(email.value)) {
        // tampilkan error dan tambahkan class error
        setError(email, "Email tidak boleh mengandung white space");
        checker_email = false;
    } else if (!cekEmail(email.value)) {
        // tampilkan error dan tambahkan class error
        setError(email, "Email tidak valid");
        checker_email = false;
    } else {
        // tambahkan class success
        setSuccess(email);
        checker_email = true;
    }
});

password.addEventListener("keyup", function (e) {
    if (password.value === "") {
        // tampilkan error dan tambahkan class error
        setError(password, "Password tidak boleh kosong");
        checker_password = false;
    } else if (password.value.length < 5) {
        // tampilkan error dan tambahkan class error
        setError(password, "Password harus terdiri dari 5 hingga 28 karakter");
        checker_password = false;
    } else if (cekWhiteSpace(password.value)) {
        // tampilkan error dan tambahkan class error
        setError(password, "Password tidak boleh mengandung white space");
        checker_password = false;
    } else {
        // tambahkan class success
        setSuccess(password);
        checker_password = true;
    }
});

nama.addEventListener("keyup", function (e) {
    if (nama.value === "") {
        // tampilkan error dan tambahkan class error
        setError(nama, "Nama tidak boleh kosong");
        checker_nama = false;
    } else if (cekSimbol(nama.value)) {
        // tampilkan error dan tambahkan class error
        setError(nama, "Nama tidak boleh mengandung simbol");
        checker_nama = false;
    } else if (cekAngka(nama.value)) {
        // tampilkan error dan tambahkan class error
        setError(nama, "Nama tidak boleh mengandung angka");
        checker_nama = false;
    } else if (nama.value.length < 2) {
        // tampilkan error dan tambahkan class error
        setError(nama, "Nama harus lebih dari 1 huruf");
        checker_nama = false;
    } else if (!cekNama(nama.value)) {
        // tampilkan error dan tambahkan class error
        setError(nama, "Nama tidak boleh diawali atau diakhiri spasi");
        checker_nama = false;
    } else {
        // tambahkan class success
        setSuccess(nama);
        checker_nama = true;
    }
});

nip.addEventListener("keyup", function (e) {
    if (nip.value === "") {
        // tampilkan error dan tambahkan class error
        setError(nip, "NIP tidak boleh kosong");
        checker_nip = false;
    } else if (nip.value.length < 3) {
        // tampilkan error dan tambahkan class error
        setError(nip, "NIP harus terdiri dari 3 hingga 12 angka");
        checker_nip = false;
    } else if (cekSimbol(nip.value)) {
        // tampilkan error dan tambahkan class error
        setError(nip, "NIP tidak boleh mengandung simbol");
        checker_nip = false;
    } else if (cekHuruf(nip.value)) {
        // tampilkan error dan tambahkan class error
        setError(nip, "NIP tidak boleh mengandung huruf");
        checker_nip = false;
    } else if (cekWhiteSpace(nip.value)) {
        // tampilkan error dan tambahkan class error
        setError(nip, "NIP tidak boleh mengandung white space");
        checker_nip = false;
    } else {
        // tambahkan class success
        setSuccess(nip);
        checker_nip = true;
    }
});

tahun_masuk.addEventListener("keyup", function (e) {
    if (tahun_masuk.value === "") {
        // tampilkan error dan tambahkan class error
        setError(tahun_masuk, "tahun masuk tidak boleh kosong");
        checker_tahun_masuk = false;
    } else if (cekSimbol(tahun_masuk.value)) {
        // tampilkan error dan tambahkan class error
        setError(tahun_masuk, "tahun masuk tidak boleh mengandung simbol");
        checker_tahun_masuk = false;
    } else if (cekHuruf(tahun_masuk.value)) {
        // tampilkan error dan tambahkan class error
        setError(tahun_masuk, "tahun masuk tidak boleh mengandung huruf");
        checker_tahun_masuk = false;
    } else if (cekWhiteSpace(tahun_masuk.value)) {
        // tampilkan error dan tambahkan class error
        setError(tahun_masuk, "tahun masuk tidak boleh mengandung white space");
        checker_tahun_masuk = false;
    } else {
        // tambahkan class success
        setSuccess(tahun_masuk);
        checker_tahun_masuk = true;
    }
});

telepon.addEventListener("keyup", function (e) {
    if (telepon.value === "") {
        // tampilkan error dan tambahkan class error
        setError(telepon, "No. Telepon tidak boleh kosong");
        checker_telepon = false;
    } else if (telepon.value.length < 3) {
        // tampilkan error dan tambahkan class error
        setError(telepon, "No. Telepon harus terdiri dari 3 hingga 12 angka");
        checker_telepon = false;
    } else if (cekSimbol(telepon.value)) {
        // tampilkan error dan tambahkan class error
        setError(telepon, "No. Telepon tidak boleh mengandung simbol");
        checker_telepon = false;
    } else if (cekHuruf(telepon.value)) {
        // tampilkan error dan tambahkan class error
        setError(telepon, "No. Telepon tidak boleh mengandung huruf");
        checker_telepon = false;
    } else if (cekWhiteSpace(telepon.value)) {
        // tampilkan error dan tambahkan class error
        setError(telepon, "No. Telepon tidak boleh mengandung white space");
        checker_telepon = false;
    } else if (!cekTelepon(telepon.value)) {
        // tampilkan error dan tambahkan class error
        setError(telepon, "No. Telepon tidak valid");
        checker_telepon = false;
    } else {
        // tambahkan class success
        setSuccess(telepon);
        checker_telepon = true;
    }
});

jenis_kontrak.addEventListener("keyup", function (e) {
    if (jenis_kontrak.value === "") {
        // tampilkan error dan tambahkan class error
        setError(jenis_kontrak, "jenis kontrak tidak boleh kosong");
        checker_jenis_kontrak = false;
    } else if (jenis_kontrak.value.length < 2) {
        // tampilkan error dan tambahkan class error
        setError(jenis_kontrak, "jenis kontrak harus lebih dari 1 karakter");
        checker_jenis_kontrak = false;
    } else if (!cekAlamat(jenis_kontrak.value)) {
        // tampilkan error dan tambahkan class error
        setError(jenis_kontrak, "jenis kontrak tidak boleh diawali atau diakhiri spasi");
        checker_jenis_kontrak = false;
    } else {
        // tambahkan class success
        setSuccess(jenis_kontrak);
        checker_jenis_kontrak = true;
    }
});

no_ktp.addEventListener("keyup", function (e) {
    if (no_ktp.value === "") {
        // tampilkan error dan tambahkan class error
        setError(no_ktp, "no KTP tidak boleh kosong");
        checker_no_ktp = false;
    } else if (cekSimbol(no_ktp.value)) {
        // tampilkan error dan tambahkan class error
        setError(no_ktp, "no KTP tidak boleh mengandung simbol");
        checker_no_ktp = false;
    } else if (cekHuruf(no_ktp.value)) {
        // tampilkan error dan tambahkan class error
        setError(no_ktp, "no KTP tidak boleh mengandung huruf");
        checker_no_ktp = false;
    } else if (cekWhiteSpace(no_ktp.value)) {
        // tampilkan error dan tambahkan class error
        setError(no_ktp, "no KTP tidak boleh mengandung white space");
        checker_no_ktp = false;
    } else {
        // tambahkan class success
        setSuccess(no_ktp);
        checker_no_ktp = true;
    }
});

alamat.addEventListener("keyup", function (e) {
    if (alamat.value === "") {
        // tampilkan error dan tambahkan class error
        setError(alamat, "Alamat tidak boleh kosong");
        checker_alamat = false;
    } else if (alamat.value.length < 2) {
        // tampilkan error dan tambahkan class error
        setError(alamat, "Alamat harus lebih dari 1 karakter");
        checker_alamat = false;
    } else if (!cekAlamat(alamat.value)) {
        // tampilkan error dan tambahkan class error
        setError(alamat, "Alamat tidak boleh diawali atau diakhiri spasi");
        checker_alamat = false;
    } else {
        // tambahkan class success
        setSuccess(alamat);
        checker_alamat = true;
    }
});

kecamatan.addEventListener("keyup", function (e) {
    if (kecamatan.value === "") {
        // tampilkan error dan tambahkan class error
        setError(kecamatan, "kecamatan tidak boleh kosong");
        checker_kecamatan = false;
    } else if (kecamatan.value.length < 2) {
        // tampilkan error dan tambahkan class error
        setError(kecamatan, "kecamatan harus lebih dari 1 karakter");
        checker_kecamatan = false;
    } else if (!cekAlamat(kecamatan.value)) {
        // tampilkan error dan tambahkan class error
        setError(kecamatan, "kecamatan tidak boleh diawali atau diakhiri spasi");
        checker_kecamatan = false;
    } else {
        // tambahkan class success
        setSuccess(kecamatan);
        checker_kecamatan = true;
    }
});

kabupaten.addEventListener("keyup", function (e) {
    if (kabupaten.value === "") {
        // tampilkan error dan tambahkan class error
        setError(kabupaten, "kabupaten tidak boleh kosong");
        checker_kabupaten = false;
    } else if (kabupaten.value.length < 2) {
        // tampilkan error dan tambahkan class error
        setError(kabupaten, "kabupaten harus lebih dari 1 karakter");
        checker_kabupaten = false;
    } else if (!cekAlamat(kabupaten.value)) {
        // tampilkan error dan tambahkan class error
        setError(kabupaten, "kabupaten tidak boleh diawali atau diakhiri spasi");
        checker_kabupaten = false;
    } else {
        // tambahkan class success
        setSuccess(kabupaten);
        checker_kabupaten = true;
    }
});

negara.addEventListener("keyup", function (e) {
    if (negara.value === "") {
        // tampilkan error dan tambahkan class error
        setError(negara, "negara tidak boleh kosong");
        checker_negara = false;
    } else if (negara.value.length < 2) {
        // tampilkan error dan tambahkan class error
        setError(negara, "negara harus lebih dari 1 karakter");
        checker_negara = false;
    } else if (!cekAlamat(negara.value)) {
        // tampilkan error dan tambahkan class error
        setError(negara, "negara tidak boleh diawali atau diakhiri spasi");
        checker_negara = false;
    } else {
        // tambahkan class success
        setSuccess(negara);
        checker_negara = true;
    }
});

tempat_lahir.addEventListener("keyup", function (e) {
    if (tempat_lahir.value === "") {
        // tampilkan error dan tambahkan class error
        setError(tempat_lahir, "tempat_lahir tidak boleh kosong");
        checker_tempat_lahir = false;
    } else if (tempat_lahir.value.length < 2) {
        // tampilkan error dan tambahkan class error
        setError(tempat_lahir, "tempat_lahir harus lebih dari 1 karakter");
        checker_tempat_lahir = false;
    } else if (!cekAlamat(tempat_lahir.value)) {
        // tampilkan error dan tambahkan class error
        setError(tempat_lahir, "tempat_lahir tidak boleh diawali atau diakhiri spasi");
        checker_tempat_lahir = false;
    } else {
        // tambahkan class success
        setSuccess(tempat_lahir);
        checker_tempat_lahir = true;
    }
});

form.addEventListener("submit", (e) => {
    if (
        checker_username == false ||
        checker_email == false ||
        checker_password == false ||
        checker_nip == false ||
        checker_nama == false ||
        checker_tahun_masuk == false ||
        checker_jenis_kontrak == false ||
        checker_no_ktp == false ||
        checker_telepon == false ||
        checker_alamat == false ||
        checker_kecamatan == false ||
        checker_kabupaten == false ||
        checker_negara == false ||
        checker_tempat_lahir == false
    ) {
        // cegah agar form tidak kosong saat dikirim
        e.preventDefault();
    }
});

function setError(input, pesan) {
    // .form-control
    const formControl = input.parentElement;
    const small = formControl.querySelector("small");

    // tambahkan pesan error di dalam small
    small.innerText = pesan;

    // tambahkan class error (ubah warna kolom form menjadi merah)
    formControl.className = "form-control error";
}

function setSuccess(input) {
    const formControl = input.parentElement; // .form-control

    // tambahkan class success (ubah warna kolom form menjadi hijau)
    formControl.className = "form-control success";
}

// Regex:
// /.../    = scope dari regex
// /^       = parameter karakter pertama
// $/       = parameter karakter terakhir
// []       = scope karakter
// [^...]   = scope untuk mengecualikan karakter
// -        = untuk range/interval karakter
// \s       = parameter white space
// /.../g   = global, parameter untuk mencocokkan keseluruhan string
// /.../i   = case-insensitive, parameter untuk mengabaikan huruf besar atau kecil

function cekNama(nama) {
    // ^[^\s]       = karakter pertama tidak boleh white space
    // [a-z\s]*     = karakter berikutnya harus huruf dan boleh mengandung white space
    // [^\s]$       = karakter terakhir tidak boleh white space
    let regex = /^[^\s][a-z\s]*[^\s]$/gi;
    return nama.match(regex);
}

function cekAlamat(alamat) {
    // ^[^\s]       = karakter pertama tidak boleh white space
    // [a-z0-9\s/"':._,()#&-]*  = karakter berikutnya berupa huruf atau angka, serta boleh mengandung white space dan simbol (/"':._,()#&-)
    // [^\s]$       = karakter terakhir tidak boleh white space
    let regex = /^[^\s][a-z0-9\s/"':._,()#&-]*[^\s]$/gi;
    return alamat.match(regex);
}

function cekTelepon(telepon) {
    // ^([0-9]*)$   = karakter harus berupa angka, serta tidak boleh mengandung white space
    let regex = /^([0-9]*)$/g;
    return telepon.match(regex);
}

function cekSimbol(input) {
    // [^a-z0-9\s]  = karakter harus berupa huruf atau angka, serta tidak boleh mengandung white space
    let regex = /[^a-z0-9\s]/gi;
    return input.match(regex);
}

function cekWhiteSpace(input) {
    // [\s]         = cek semua white space di dalam suatu string
    let regex = /[\s]/g;
    return input.match(regex);
}

function cekAngka(input) {
    // [0-9]        = cek semua angka di dalam suatu string
    let regex = /[0-9]/g;
    return input.match(regex);
}

function cekHuruf(input) {
    // [0-9]        = cek semua angka di dalam suatu string
    let regex = /[a-z]/gi;
    return input.match(regex);
}

function cekEmail(email) {
    // ^[^\s]       = karakter pertama tidak boleh white space
    // ^[a-z0-9.]+  = karakter pertama harus diawali dengan angka atau huruf atau tanda titik (.)
    // @            = karakter berikutnya harus simbol @
    // [a-z.]+      = karakter berikutnya harus berupa huruf
    // \.           = karakter berikutnya adalah tanda titik (.)
    // [a-z]{2,3}$  = karakter terakhir harus berupa huruf dengan minimal 2 dan maksimal 3
    let regex = /^[^\s][a-z0-9.]+@[a-z.]+\.[a-z]{2,3}$/gi;
    return email.match(regex);
}
