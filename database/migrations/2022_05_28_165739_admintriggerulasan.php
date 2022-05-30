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
        CREATE TRIGGER admintriggerulasan AFTER INSERT ON `product_reviews` FOR EACH ROW
            BEGIN
                INSERT INTO adminnotifications (`id_checkout_review`, `jenis`)
                VALUES (NEW.id, "review");
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
        DB::unprepared('DROP TRIGGER `admintriggerulasan`');
    }
};
