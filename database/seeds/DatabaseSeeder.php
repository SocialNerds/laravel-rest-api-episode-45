<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = factory(App\Models\Book::class, 10)->create();
        factory(App\Models\User::class, 5)->create()->each(
          function ($u) {
              $favorites = [];
              foreach (range(1, 3) as $index) {
                  $favorites[] = App\Models\Book::all()->random()->id;
              }
              $u->favorites()->sync($favorites);
          }
        );
    }
}
