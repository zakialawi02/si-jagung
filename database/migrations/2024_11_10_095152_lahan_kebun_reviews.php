<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE VIEW view_lahan AS
            SELECT
                lk.*,
                lr.reviewed,
                lr.reviewed_at
            FROM
                lahan_kebuns AS lk
            LEFT JOIN
                lahan_revieweds AS lr
            ON
                lk.id = lr.lahan_kebun_id
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS lahan_kebun_reviews");
    }
};
