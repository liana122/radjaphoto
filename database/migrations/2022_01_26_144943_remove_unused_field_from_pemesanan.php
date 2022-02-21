<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveUnusedFieldFromPemesanan extends Migration
{
    /*
     * Table name
     *
     * @var string
     */
    protected $table = 'pemesanan';


    /*
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table($this->table, function (Blueprint $table) {
        //     $table->dropColumn("id_paket");
        //     $table->dropColumn("id_paketstudio");
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table($this->table, function (Blueprint $table) {
        //    $table->integer('id_paket');
        //    $table->integer('id_paketstudio');
        // });
    }
}
