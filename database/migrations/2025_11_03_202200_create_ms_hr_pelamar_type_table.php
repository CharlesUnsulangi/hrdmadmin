<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ms_hr_pelamar_type', function (Blueprint $table) {
            $table->string('ms_hr_pelamar_type_id', 50)->primary()->comment('Primary Key, kode unik tipe/jabatan pelamar, contoh: STAFF, DRIVER, KENEK');
            $table->string('type_desc', 50)->nullable()->comment('Deskripsi tipe/jabatan pelamar, contoh: Staff, Driver, Kenek');
            // Catatan tambahan: Tabel ini digunakan untuk mendefinisikan jenis/jabatan pelamar (staff, driver, kenek, dll)
        });
        // Catatan tabel (untuk DBMS yang mendukung):
        DB::statement("COMMENT ON TABLE ms_hr_pelamar_type IS 'Master tipe/jabatan pelamar: staff, driver, kenek, dll.'");
    }

    public function down(): void
    {
        Schema::dropIfExists('ms_hr_pelamar_type');
    }
};
