const form = document.getElementById("form");
const nama = document.getElementById("nama_ruangan");

var checker_nama = false;

nama.addEventListener("keyup", function (e) {
    if (nama.value === "") {
        // tampilkan error dan tambahkan class error
        setError(nama, "Nama tidak boleh kosong");
        checker_nama = false;
    } else if (cekSimbol(nama.value)) {
        // tampilkan error dan tambahkan class error
        setError(nama, "Nama tidak boleh mengandung simbol");
        checker_nama = false;
    } else if (nama.value.length < 2) {
        // tampilkan error dan tambahkan class error
        setError(nama, "Nama harus lebih dari 1 huruf");
        checker_nama = false;
    } else if (!cekAlamat(nama.value)) {
        // tampilkan error dan tambahkan class error
        setError(nama, "Nama tidak boleh diawali atau diakhiri spasi");
        checker_nama = false;
    } else {
        // tambahkan class success
        setSuccess(nama);
        checker_nama = true;
    }
});

form.addEventListener("submit", (e) => {
    if (checker_nama == false) {
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
    // [a-z0-9\s]*  = karakter berikutnya berupa huruf atau angka, serta boleh mengandung white space
    // [^\s]$       = karakter terakhir tidak boleh white space
    let regex = /^[^\s][a-z0-9\s]*[^\s]$/gi;
    return alamat.match(regex);
}

function cekTelepon(telepon) {
    // ^([0-9]*)$   = karakter harus berupa angka, serta tidak boleh mengandung white space
    let regex = /^([0-9]*)$/g;
    return telepon.match(regex);
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
