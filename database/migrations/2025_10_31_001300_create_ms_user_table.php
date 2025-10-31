<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ms_user', function (Blueprint $table) {
            $table->string('rec_usercreated', 50);
            $table->string('rec_userupdate', 50)->default('');
            $table->dateTime('rec_datecreated');
            $table->dateTime('rec_dateupdate')->default('1900-01-01');
            $table->char('rec_status', 1);
            $table->string('usr_loginname', 50);
            $table->string('usr_loginpassword', 50)->nullable();
            $table->string('usr_loginstamp', 50)->nullable();
            $table->string('usr_name', 50)->nullable();
            $table->string('usr_grpcode', 50);
            $table->string('usr_iut', 50)->nullable();
            $table->string('usr_kac', 50)->nullable();
            $table->string('usr_comcode', 50)->nullable();
            $table->string('usr_areacode', 50)->nullable();
            $table->string('usr_empcode', 50)->nullable();
            $table->string('usr_spccode', 50)->nullable();
            $table->primary('usr_loginname');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ms_user');
    }
};
