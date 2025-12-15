// database/migrations/[timestamp]_add_status_to_umkm_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('umkm', function (Blueprint $table) {
            if (!Schema::hasColumn('umkm', 'status')) {
                $table->string('status')->default('pending')->after('tdp');
            }
            if (!Schema::hasColumn('umkm', 'approved_at')) {
                $table->timestamp('approved_at')->nullable()->after('status');
            }
            if (!Schema::hasColumn('umkm', 'alasan_penolakan')) {
                $table->text('alasan_penolakan')->nullable()->after('approved_at');
            }
        });
    }

    public function down()
    {
        Schema::table('umkm', function (Blueprint $table) {
            $table->dropColumn(['status', 'approved_at', 'alasan_penolakan']);
        });
    }
};