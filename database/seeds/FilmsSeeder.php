<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder for films
 *
 * @author Andsalves
 */
class FilmsSeeder extends Seeder {

    /**
     * Run the database seeds.
     * @return void
     */
    public function run() {
        /** @var \Illuminate\Database\Eloquent\Builder $builder */
        $builder = DB::table('films');

        $builder->whereBetween('id', [0, 5])->delete();

        /** Film 1 */
        $builder->insert([
            'id' => 1,
            'name' => 'Interstellar',
            'description' => 'Interstellar is a 2014 epic science fiction film directed, co-written and co-produced by Christopher Nolan. It stars Matthew McConaughey, Anne Hathaway, Jessica Chastain, Bill Irwin, Casey Affleck, Ellen Burstyn, John Lithgow and Michael Caine. Set in a dystopian future where humanity is struggling to survive, the film follows a group of astronauts who travel through a wormhole in search of a new home for humanity.',
            'release_date' => '2014-11-06 00:00:00',
            'rating' => '5.0',
            'ticket_price' => '20',
            'country' => 'United States',
            'photo' => 'https://i.ytimg.com/vi/Df7IEKqimOY/movieposter.jpg',
            'slug' => 'interstellar'
        ]);
        DB::table('film_genre')->insert(['film_slug' => 'interstellar', 'genre_slug' => 'science-fiction']);
        DB::table('film_genre')->insert(['film_slug' => 'interstellar', 'genre_slug' => 'drama']);
        DB::table('film_genre')->insert(['film_slug' => 'interstellar', 'genre_slug' => 'adventure']);

        /** Film 2 */
        DB::table('films')->insert([
            'id' => 2,
            'name' => 'Gravity',
            'description' => 'Gravity is a 2013 science fiction thriller film directed, co-written, co-edited and co-produced by Alfonso Cuarón. It stars Sandra Bullock and George Clooney as astronauts who are stranded in space after the mid-orbit destruction of their space shuttle, and their subsequent attempt to return to Earth.',
            'release_date' => '2013-08-28 00:00:00',
            'rating' => '4.0',
            'ticket_price' => '15.50',
            'country' => 'United States',
            'photo' => 'https://upload.wikimedia.org/wikipedia/en/f/f6/Gravity_Poster.jpg',
            'slug' => 'gravity'
        ]);
        DB::table('film_genre')->insert(['film_slug' => 'gravity', 'genre_slug' => 'science-fiction']);
        DB::table('film_genre')->insert(['film_slug' => 'gravity', 'genre_slug' => 'thriller']);

        /** Film 3 */
        DB::table('films')->insert([
            'id' => 3,
            'name' => 'Contact',
            'description' => 'Dr. Ellie Arroway works for the SETI program at the Arecibo Observatory in Puerto Rico. Fascinated by science and communication since she was a child, she listens to radio emissions from space, hoping to find evidence of alien life. David Drumlin, the president\'s science advisor, pulls the funding from SETI, because he believes the endeavor is futile. Arroway gains backing from secretive billionaire industrialist S. R. Hadden, which allows her to continue the project at the Very Large Array in New Mexico.',
            'release_date' => '1997-07-11 00:00:00',
            'rating' => '4.6',
            'ticket_price' => '17.50',
            'country' => 'United States',
            'photo' => 'https://upload.wikimedia.org/wikipedia/en/7/75/Contact_ver2.jpg',
            'slug' => 'contact'
        ]);
        DB::table('film_genre')->insert(['film_slug' => 'contact', 'genre_slug' => 'science-fiction']);
        DB::table('film_genre')->insert(['film_slug' => 'contact', 'genre_slug' => 'drama']);

        /** Film 2 */
        DB::table('films')->insert([
            'id' => 4,
            'name' => 'Predator',
            'description' => 'A spacecraft flies near Earth and releases a bright object which enters the atmosphere. In the Val Verde jungle, Major Alan "Dutch" Schaefer and his team — medic Mac Elliot, tracker Billy Sole, gunner Blain Cooper, explosives expert Jorge "Poncho" Ramírez, and radio operator Rick Hawkins —are tasked by the CIA with rescuing an official held hostage by insurgents. CIA agent, liaison and former US Army Colonel George Dillon, a former commando and an old friend of Dutch, is assigned to supervise the team despite Dutch\'s objections.',
            'release_date' => '1987-06-12 00:00:00',
            'rating' => '4.8',
            'ticket_price' => '23.50',
            'country' => 'United States',
            'photo' => 'https://upload.wikimedia.org/wikipedia/en/9/95/Predator_Movie.jpg',
            'slug' => 'predator'
        ]);
        DB::table('film_genre')->insert(['film_slug' => 'predator', 'genre_slug' => 'science-fiction']);
        DB::table('film_genre')->insert(['film_slug' => 'predator', 'genre_slug' => 'thriller']);
        DB::table('film_genre')->insert(['film_slug' => 'predator', 'genre_slug' => 'action']);
    }
}
