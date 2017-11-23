<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * films and genres relationship table
 *
 * @author Andsalves
 */
class CreateFilmGenreTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('film_genre', function (Blueprint $table) {
            $table->string('film_slug', 80);
            $table->string('genre_slug', 80);

            $table->foreign('film_slug')->references('slug')->on('films')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('genre_slug')->references('slug')->on('genres')->onDelete('cascade')->onUpdate('cascade');

            $table->primary(['film_slug', 'genre_slug']);

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
    }
}
