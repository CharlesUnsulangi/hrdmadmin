<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('tr_hr_pelamar_main', function (Blueprint $table) {
            // Kolom utama
            $table->string('tr_hr_pelamar_id', 50)->nullable()->unique()->after('id');
            $table->string('nama', 50)->nullable(false)->change();
            $table->string('email', 50)->nullable(false)->unique()->change();
            $table->string('hp', 50)->nullable(false)->after('email');
            $table->string('posisi', 50)->nullable(false)->after('hp');
            $table->string('user_created', 50)->nullable()->after('posisi');
            $table->date('date_created')->nullable()->after('user_created');
            $table->integer('rating')->nullable()->after('date_created');
            $table->boolean('cek_confirm')->default(0)->after('rating');
            $table->dateTimeTz('time_confirm')->nullable()->after('cek_confirm');
            $table->boolean('cek_cv')->default(0)->after('time_confirm');
            $table->boolean('cek_driver')->default(0)->after('cek_cv');
            $table->boolean('cek_interview')->default(0)->after('cek_driver');
            $table->boolean('cek_kandidat')->default(0)->after('cek_interview');
            $table->boolean('cek_priority')->default(0)->after('cek_kandidat');
            $table->boolean('cek_tolak')->default(0)->after('cek_priority');
            $table->boolean('cek_wa')->default(0)->after('cek_tolak');
            $table->dateTimeTz('time_cv')->nullable()->after('cek_wa');
            $table->dateTimeTz('time_interview')->nullable()->after('time_cv');
            $table->dateTimeTz('time_wa')->nullable()->after('time_interview');
            $table->string('link_cv', 250)->nullable()->after('time_wa');
        });
    }

    public function down(): void
    {
        Schema::table('tr_hr_pelamar_main', function (Blueprint $table) {
            $table->dropColumn([
                'tr_hr_pelamar_id', 'hp', 'posisi', 'user_created', 'date_created', 'rating',
                'cek_confirm', 'time_confirm', 'cek_cv', 'cek_driver', 'cek_interview',
                'cek_kandidat', 'cek_priority', 'cek_tolak', 'cek_wa', 'time_cv',
                'time_interview', 'time_wa', 'link_cv'
            ]);
            $table->dropUnique(['email']);
        });
    }
};
