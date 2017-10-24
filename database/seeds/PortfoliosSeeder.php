<?php

use App\Portfolio;
use Illuminate\Database\Seeder;

class PortfoliosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Portfolio::create([
            'name'      => 'Shopping',
            'images'    => 'portfolio_pic4.jpg',
            'filter'    => 'android'
        ]);
        Portfolio::create([
            'name'      => 'Management',
            'images'    => 'portfolio_pic5.jpg',
            'filter'    => 'design'
        ]);
        Portfolio::create([
            'name'      => 'iPhone',
            'images'    => 'portfolio_pic6.jpg',
            'filter'    => 'web'
        ]);
        Portfolio::create([
            'name'      => 'Nexus Phone',
            'images'    => 'portfolio_pic7.jpg',
            'filter'    => 'web'
        ]);
        Portfolio::create([
            'name'      => 'Android',
            'images'    => 'portfolio_pic8.jpg',
            'filter'    => 'android'
        ]);
    }
}
