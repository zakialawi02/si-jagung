<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Membuat trigger functions dan trigger untuk view
        DB::statement('
            CREATE OR REPLACE FUNCTION insert_into_lahan_view()
            RETURNS TRIGGER AS
            $$
            BEGIN
                INSERT INTO lahan_kebuns (id, user_id, no_kebun, nama_pemilik, luas, jumlah_produksi, jenis_jagung, varietas_jagung, geom, created_at, updated_at)
                VALUES (NEW.id, NEW.user_id, NEW.no_kebun, NEW.nama_pemilik, NEW.luas, NEW.jumlah_produksi, NEW.jenis_jagung, NEW.varietas_jagung, NEW.geom, NOW(), NOW());

                INSERT INTO lahan_revieweds (lahan_kebun_id, reviewed, reviewed_at, created_at, updated_at)
                VALUES (NEW.id, NEW.reviewed, NEW.reviewed_at, NOW(), NOW());
                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;
        ');

        DB::statement('
            CREATE OR REPLACE FUNCTION update_lahan_view()
            RETURNS TRIGGER AS
            $$
            BEGIN
                UPDATE lahan_kebuns
                SET
                    no_kebun = NEW.no_kebun,
                    nama_pemilik = NEW.nama_pemilik,
                    luas = NEW.luas,
                    jumlah_produksi = NEW.jumlah_produksi,
                    jenis_jagung = NEW.jenis_jagung,
                    varietas_jagung = NEW.varietas_jagung,
                    geom = NEW.geom,
                    updated_at = NOW()
                WHERE id = OLD.id;

                UPDATE lahan_revieweds
                SET
                    reviewed = NEW.reviewed,
                    reviewed_at = NEW.reviewed_at,
                    updated_at = NOW()
                WHERE lahan_kebun_id = OLD.id;
                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;
        ');

        DB::statement('
            CREATE OR REPLACE FUNCTION delete_from_lahan_view()
            RETURNS TRIGGER AS
            $$
            BEGIN
                DELETE FROM lahan_kebuns WHERE id = OLD.id;
                DELETE FROM lahan_revieweds WHERE lahan_kebun_id = OLD.id;
                RETURN OLD;
            END;
            $$ LANGUAGE plpgsql;
        ');

        DB::statement('
            CREATE TRIGGER insert_lahan_view_trigger
            INSTEAD OF INSERT ON view_lahan
            FOR EACH ROW
            EXECUTE FUNCTION insert_into_lahan_view();
        ');

        DB::statement('
            CREATE TRIGGER update_lahan_view_trigger
            INSTEAD OF UPDATE ON view_lahan
            FOR EACH ROW
            EXECUTE FUNCTION update_lahan_view();
        ');

        DB::statement('
            CREATE TRIGGER delete_lahan_view_trigger
            INSTEAD OF DELETE ON view_lahan
            FOR EACH ROW
            EXECUTE FUNCTION delete_from_lahan_view();
        ');
    }

    public function down()
    {
        DB::statement('DROP TRIGGER IF EXISTS insert_lahan_view_trigger ON view_lahan');
        DB::statement('DROP TRIGGER IF EXISTS update_lahan_view_trigger ON view_lahan');
        DB::statement('DROP TRIGGER IF EXISTS delete_lahan_view_trigger ON view_lahan');
        DB::statement('DROP FUNCTION IF EXISTS insert_into_lahan_view()');
        DB::statement('DROP FUNCTION IF EXISTS update_lahan_view()');
        DB::statement('DROP FUNCTION IF EXISTS delete_from_lahan_view()');
    }
};
