<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\KasusController;
use App\Http\Controllers\TindakanController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\LaporanKeuanganController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\Auth\AuthenticatedSessionController;


// Rute untuk halaman utama

require __DIR__.'/auth.php';
Route::redirect('/', '/login');
// Auth::routes();
// Route::get('/', [AuthenticatedSessionController::class, 'create'])
//         ->name('login');
// Route::get('/', function () {
//     return view('welcome');
// });

// Rute untuk dashboard
// Route::get('/dashboard', function () {
// Route::middleware(['auth'])->prefix('dashboard')->name('dashboards.')->group(function () {
//     return view('dashboard');
//     // Route::get('/', [DashboardController::class, 'index'])->name('index'); 
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware(['auth', 'verified'])->name('dashboard')->group(function () {
//     Route::get('/dashboard', [DashboardController::class, 'index']); 
// });

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        if (session('user_role') === 'admin') {
            return redirect('/kasir');
        }
        return app(\App\Http\Controllers\DashboardController::class)->index(request());
    })->name('dashboard');
});

// Grup route untuk Dokter dengan middleware 'auth'
Route::middleware(['auth'])->prefix('dokters')->name('dokters.')->group(function () {
    Route::get('/', [DokterController::class, 'index'])->name('index'); // Menampilkan daftar dokter
    Route::get('/create', [DokterController::class, 'create'])->name('create'); // Form tambah dokter
    Route::post('/', [DokterController::class, 'store'])->name('store'); // Proses simpan dokter
    Route::get('/{dokter:id_dokter}', [DokterController::class, 'show'])->name('show'); // Tampilkan detail dokter
    Route::get('/{dokter}/edit', [DokterController::class, 'edit'])->name('edit'); // Form edit dokter
    Route::put('/{dokter}', [DokterController::class, 'update'])->name('update'); // Proses update dokter
    Route::delete('/{dokter:id_dokter}', [DokterController::class, 'destroy'])->name('destroy'); // Hapus dokter
});

// Grup route untuk Pasien
Route::middleware(['auth'])->prefix('pasiens')->name('pasiens.')->group(function () {
    Route::get('/', [PasienController::class, 'index'])->name('index'); // Menampilkan daftar pasien
    Route::get('/create', [PasienController::class, 'create'])->name('create'); // Menampilkan form tambah pasien
    Route::post('/', [PasienController::class, 'store'])->name('store'); // Menyimpan data pasien baru
    Route::get('/{pasien}', [PasienController::class, 'show'])->name('show'); // Menampilkan detail pasien
    Route::get('/{pasien}/edit', [PasienController::class, 'edit'])->name('edit'); // Menampilkan form edit pasien
    Route::put('/{pasien}', [PasienController::class, 'update'])->name('update'); // Mengupdate data pasien
    Route::delete('/{pasien}', [PasienController::class, 'destroy'])->name('destroy'); // Menghapus data pasien
});



Route::middleware(['auth'])->group(function () {
    Route::prefix('obats')->name('obats.')->group(function () {
        // Menampilkan daftar obat
        Route::get('/', [ObatController::class, 'index'])->name('index');

        // Form untuk menambahkan obat
        Route::get('/create', [ObatController::class, 'create'])->name('create');

        // Menyimpan data obat baru
        Route::post('/store', [ObatController::class, 'store'])->name('store');

        // Form untuk mengedit obat tertentu
        Route::get('/{obat}/edit', [ObatController::class, 'edit'])->name('edit');

        // Memperbarui data obat
        Route::put('/{obat}', [ObatController::class, 'update'])->name('update');

        // Menghapus obat tertentu
        Route::delete('/{obat}', [ObatController::class, 'destroy'])->name('destroy');

        // Route untuk penghapusan massal (jika diperlukan)
        Route::delete('/delete-selected', [ObatController::class, 'deleteSelected'])->name('deleteSelected');
    });
});



Route::middleware(['auth'])->group(function () {
    Route::resource('kasus', KasusController::class);
});

// Grup route untuk Admin
// Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
//     Route::get('/', [AdminController::class, 'index'])->name('index');
//     Route::get('/users', [AdminController::class, 'users'])->name('users');
//     Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
// });

// Grup route untuk Profil
Route::middleware(['auth'])->prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'edit'])->name('edit');
    Route::patch('/', [ProfileController::class, 'update'])->name('update');
    Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
});


Route::middleware(['auth'])->group(function () {
    // Routes untuk Tindakan
    Route::resource('tindakan', TindakanController::class);
    

// Tambahkan route show untuk tindakan
// Route::get('/tindakan/{tindakan}', [TindakanController::class, 'show'])->name('tindakan.show');

// Tambahkan route autocomplete-pasien
Route::get('autocomplete-pasien', [TindakanController::class, 'autocomplete'])->name('autocomplete-pasien');

// Tambahkan route di web.php untuk menangani pencarian pasien
// Route::get('/tindakan', [TindakanController::class, 'index'])->name('tindakan.index');

    // Routes untuk Kasus
    // Route::prefix('kasus')->group(function () {
    //     Route::get('/{tindakan}', [KasusController::class, 'index'])->name('kasus.index'); // Lihat kasus berdasarkan tindakan
    //     Route::post('/{tindakan}', [KasusController::class, 'store'])->name('kasus.store'); // Tambah kasus ke tindakan tertentu
    //     Route::get('/edit/{kasus}', [KasusController::class, 'edit'])->name('kasus.edit'); // Form edit kasus
    //     Route::put('/{kasus}', [KasusController::class, 'update'])->name('kasus.update'); // Update kasus
    //     Route::delete('/{kasus}', [KasusController::class, 'destroy'])->name('kasus.destroy'); // Hapus kasus
    // });
});

// Kasir routes
Route::middleware(['auth'])->group(function () {
    Route::resource('kasir', KasirController::class);
    Route::get('/kasir/{id}/print', [KasirController::class, 'printNota'])->name('kasir.print');
});

// Laporan Keuangan routes
Route::middleware(['auth'])->name('laporan-keuangan')->group(function () {
    Route::get('/laporan-keuangan', [LaporanKeuanganController::class, 'laporanKeuangan']);
});



// Rute autentikasi

