<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER triggerulasan AFTER INSERT ON `rensponses` FOR EACH ROW
            BEGIN
            DECLARE iduser INT;
            DECLARE idreview INT;
  
                SELECT product_reviews.user_id, rensponses.review_id INTO iduser, idreview FROM product_reviews JOIN rensponses WHERE product_reviews.id = rensponses.review_id ORDER BY rensponses.review_id DESC LIMIT 1;

                INSERT INTO notifications (`id_ulasan_checkout`, `id_user`, `jenis`)
                VALUES (idreview, iduser, "ulasan");
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `triggerulasan`');
    }
};
