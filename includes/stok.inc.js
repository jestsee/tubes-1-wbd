// ambil elemen2 yang dibutuhkan
var stokInput = document.getElementById('stok');
var stokTombol = document.getElementById('tombol-stok');
var container = document.getElementById('container');

// sementara event nya pake change atau input (input bs cover semua)
// bisa jadi template buat ajax di fungsi lain
stokInput.addEventListener('input', function() {
    
    // buat objek ajax
    var xhr = new XMLHttpRequest();

    // cek kesiapan ajax
    xhr.onreadystatechange = function() {
        if( xhr.readyState == 4 && xhr.status == 200 ) {
            
            // nilai ready state itu antara 0 - 4
            // 0: inisialisasi
            // 1: membuka koneksi
            // 2: dst
            // 4: sumber sudah ready (sudah oke dah)

            // status 404: file not found

            container.innerHTML = xhr.responseText;

        }
    }

    // eksekusi ajax
    xhr.open('GET', 'includes/dorayakiFunctions.php', true);
    xhr.send();

})