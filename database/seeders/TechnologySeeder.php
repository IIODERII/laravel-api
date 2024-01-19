<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technology;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = [
            [
                "name" => 'php',
                "icon" => 'fa-brands fa-php',
            ],
            [
                "name" => 'HTML',
                "icon" => 'fa-brands fa-html5 '
            ],
            [
                "name" => 'CSS',
                "icon" => 'fa-brands fa-css3-alt '
            ],
            [
                "name" => 'JavaScript',
                "icon" => 'fa-brands fa-js '
            ],
            [
                "name" => 'Laravel',
                "icon" => 'fa-brands fa-laravel '
            ],
            [
                "name" => 'Bootstrap',
                "icon" => 'fa-brands fa-bootstrap '
            ],
            [
                "name" => 'VueJS',
                "icon" => 'fa-brands fa-vuejs '
            ],
            [
                "name" => 'React',
                "icon" => 'fa-brands fa-react '
            ],
            [
                "name" => 'SASS',
                "icon" => 'fa-brands fa-sass '
            ],
            [
                "name" => 'Wordpress',
                "icon" => 'fa-brands fa-wordpress '
            ],
            [
                "name" => 'Angular',
                "icon" => 'fa-brands fa-angular '
            ],
            [
                "name" => 'Python',
                "icon" => 'fa-brands fa-python '
            ],
            [
                "name" => 'Java',
                "icon" => 'fa-brands fa-java '
            ]
        ];
        foreach ($technologies as $technology) {
            $newTechnology = new Technology();
            $newTechnology->name = $technology['name'];
            $newTechnology->icon = $technology['icon'];
            $newTechnology->slug = Str::slug($technology['name'], '-');
            $newTechnology->save();
        }
    }
}
