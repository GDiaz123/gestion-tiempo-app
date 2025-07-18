<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('eventos', function (Blueprint $table) {
            if (Schema::hasColumn('eventos', 'start')) {
                $table->dropColumn('start');
            }
        });
    }

    public function down()
    {
        Schema::table('eventos', function (Blueprint $table) {
            if (!Schema::hasColumn('eventos', 'start')) {
                $table->timestamp('start')->nullable();
            }
        });
    }
};
