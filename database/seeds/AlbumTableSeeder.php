<?php

use Illuminate\Database\Seeder;

class AlbumTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Album', 5)->create()->each(function ($album) {
            $album->tracks()->saveMany(factory('App\Track', 10)->make());
        });

    }
}
