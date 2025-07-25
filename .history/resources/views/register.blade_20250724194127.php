<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- BS5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <title>Register</title>
</head>
<body>
    <div class="container-fluid min-vh-100 d-flex p-0">
    <!-- Kolom kiri: Gambar -->
    <div class="col-md-6 d-none d-md-block p-0">
        <img src="img/kost.png" alt="Register Image" class="img-fluid h-100 w-100 object-fit-cover">
    </div>

    <!-- Kolom kanan: Form Register -->
    <div class="col-md-6 d-flex flex-column justify-content-center align-items-center px-5">
        <!-- Logo dan Judul -->
        <div class="mb-4 text-center">
            <img src="img/logo.jpg" alt="Logo" style="width: 50px; height: 50px;">
            <h2 class="mt-3 fw-bold letter-spacing-lg">REGISTER</h2>
        </div>

        <!-- Form -->
        <form method="POST" action="/register-user" class="w-100" style="max-width: 400px;">
            @csrf

            <div class="mb-3">
                <input onkeydown="EnterButtonRegisterPenghuni(event)" type="text" name="name" class="form-control rounded" placeholder="Nama" required>
            </div>
            <div class="mb-3">
                <input onkeydown="EnterButtonRegisterPenghuni(event)" type="email" name="email" class="form-control rounded" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input onkeydown="EnterButtonRegisterPenghuni(event)" type="password" name="password" class="form-control rounded" placeholder="Kata Sandi" required>
            </div>
            <div class="mb-3">
                <input onkeydown="EnterButtonRegisterPenghuni(event)" type="text" name="phone" class="form-control rounded" placeholder="No. HP" required>
            </div>
            <div class="mb-3">
                <input onkeydown="EnterButtonRegisterPenghuni(event)" type="text" name="ktp" class="form-control rounded" placeholder="No. KTP" required>
            </div>
            <div class="mb-3">
                <input onkeydown="EnterButtonRegisterPenghuni(event)" type="text" name="address" class="form-control rounded" placeholder="Alamat" required>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-outline-dark w-100">Daftar</button>
            </div>
        </form>

        <!-- Link login -->
        <p class="text-muted mt-3" style="font-size: 0.9rem;">
            Sudah punya akun? <a href="/loginUser" class="fw-bold text-decoration-none">Masuk</a>
        </p>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function EnterButtonRegisterPenghuni(event){
        if(event.key == "Enter" || event.keyCode == 13){
            event.preventDefault();
            ButtonSumKamarIsStarting();
        }
    }
</script>
<script>
    function showAlert(message) {
        Swal.fire({
            icon: "warning",
            title: "Peringatan",
            text: message,
            confirmButtonColor: "#2600FF",
            timer: 2000,
            timerProgressBar: true,
        });
    }

    function ButtonSumKamarIsStarting() {
        const tipeKamar = document.getElementById('tipeKamar').value.trim();
        const nomorKamar = document.getElementById('nomorKamar').value.trim();
        const ukuran = document.getElementById('ukuran').value.trim();
        const hargaSewa = document.getElementById('hargaSewa').value.trim();

        if (tipeKamar === "Tipe Kamar" || !tipeKamar) {
            showAlert("Harap pilih Tipe Kamar!");
        } else if (!nomorKamar) {
            showAlert("Nomor Kamar belum terisi. Silakan pilih tipe kamar untuk generate nomor.");
        } else if (!ukuran) {
            showAlert("Harap isi Ukuran Kamar!");
        } else if (!hargaSewa) {
            showAlert("Harap isi Harga Sewa!");
        } else {
            // Semua validasi sukses, trigger tombol submit asli
            document.getElementById('RealSubmitButtonKamarId').click();
        }
    }
</script>
</body>
</html>