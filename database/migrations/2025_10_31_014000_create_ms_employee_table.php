<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ms_employee', function (Blueprint $table) {
            $table->string('rec_usercreated', 50);
            $table->string('rec_userupdate', 50);
            $table->dateTime('rec_datecreated');
            $table->dateTime('rec_dateupdate');
            $table->char('rec_status', 1);
            $table->string('emp_id', 50)->primary();
            $table->string('emp_iddivision', 50)->nullable();
            $table->string('emp_name', 100)->nullable();
            $table->boolean('emp_inactive')->nullable();
            $table->string('emp_subdivision', 50)->nullable();
            $table->decimal('emp_upahpokok', 19, 4)->nullable(); // money
            $table->decimal('emp_tunjangan', 19, 4)->nullable(); // money
            $table->date('emp_datejoin')->nullable();
            $table->date('emp_dateresign')->nullable();
            $table->date('emp_born')->nullable();
            $table->string('emp_nokontrak', 50)->nullable();
            $table->date('emp_expdatekontrak')->nullable();
            $table->decimal('emp_numkontrak', 19, 4)->nullable(); // money
            $table->string('emp_npwp', 50)->nullable();
            $table->string('emp_bank', 50)->nullable();
            $table->string('emp_norek', 50)->nullable();
            $table->string('emp_address', 200)->nullable();
            $table->string('emp_idktp', 50)->nullable();
            $table->string('emp_kotalahir', 100)->nullable();
            $table->decimal('emp_childno', 19, 4)->nullable(); // money
            $table->string('emp_namaistri', 50)->nullable();
            $table->string('emp_jamsostek', 50)->nullable();
            $table->boolean('emp_includepajak')->nullable();
            $table->string('emp_telp', 50)->nullable();
            $table->string('emp_lastedu', 100)->nullable();
            $table->string('emp_lastcom', 100)->nullable();
            $table->string('emp_telplastcom', 50)->nullable();
            $table->string('emp_lastjabatan', 100)->nullable();
            $table->decimal('emp_lastsalary', 19, 4)->nullable(); // money
            $table->string('emp_cutitotal', 50)->nullable();
            $table->string('emp_com', 50)->nullable();
            $table->string('emp_status', 50)->nullable();
            $table->string('emp_religion', 50)->nullable();
            $table->string('emp_citizen', 50)->nullable();
            $table->string('emp_desc', 100)->nullable();
            $table->decimal('emp_levelclass', 19, 4)->nullable(); // money
            $table->decimal('emp_leveljabatan', 19, 4)->nullable(); // money
            $table->string('emp_lastjobdesk', 50)->nullable();
            $table->string('emp_apprlast', 50)->nullable();
            $table->char('emp_gender', 1)->nullable();
            $table->string('emp_typepayroll', 50)->nullable();
            $table->string('emp_reason_nonactive', 200)->nullable();
            $table->string('emp_aksesuser', 50)->nullable();
            $table->string('emp_email', 255)->nullable();
            $table->string('emp_statuskaryawan', 50)->nullable();
            $table->string('card_id', 10)->nullable();
            $table->string('emp_no_drt', 50)->nullable();
            $table->string('emp_name_drt', 100)->nullable();
            $table->string('emp_akn_fb', 100)->nullable();
            $table->string('emp_akn_ig', 100)->nullable();
            $table->dateTime('emp_last_contract')->nullable();
            $table->string('emp_state_appr', 1)->nullable();
            $table->string('emp_nik', 255)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ms_employee');
    }
};
