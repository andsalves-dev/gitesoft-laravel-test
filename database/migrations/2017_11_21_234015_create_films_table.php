<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('films', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 64);
            $table->text('description');
            $table->dateTime('release_date');
            $table->unsignedDecimal('rating', 2, 1);
            $table->unsignedDecimal('ticket_price', 5, 2);
            $table->string('country', 64);
            $table->string('genre', 64);
            $table->string('photo', 200);

            $table->index('name', 'name_idx');
            $table->index('release_date', 'release_date_idx');
            $table->index('ticket_price', 'ticket_price_idx');

            $table->unique('name');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('films');
    }
}
