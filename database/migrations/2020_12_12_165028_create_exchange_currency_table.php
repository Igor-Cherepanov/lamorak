<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExchangeCurrencyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchange_currency', function (Blueprint $table) {
            $table->id();
            $table->string('f_name');
            $table->string('l_name');
            $table->string('m_name');
            $table->string('passport');
            $table->unsignedBigInteger('currency_id');
            $table->unsignedBigInteger('exchange_office_id');
            $table->integer('sold_currency_count');
            $table->integer('bought_currency_count');
            $table->integer('sold_rub_count');
            $table->integer('bought_rub_count');
            $table->timestamps();

            $table->foreign('currency_id')->references('id')->on('currencies')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('exchange_office_id')->references('id')->on('exchange_offices')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exchange_currency');
    }
}
