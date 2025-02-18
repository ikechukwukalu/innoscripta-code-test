<?php

namespace Database\Seeders;

use App\Facades\NewsSource as NewsSourceFacade;
use App\Models\NewsApi;
use App\Models\NewYorkTimes;
use App\Models\TheGuardian;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewSourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        NewsSourceFacade::firstOrCreate([
            'model' => NewYorkTimes::class,
        ],[
            'name' => 'New York Times',
            'url' => 'https://www.nytimes.com/',
            'logo' => null,
            'model' => NewYorkTimes::class,
            'active' => '1',
        ]);

        NewsSourceFacade::firstOrCreate([
            'model' => TheGuardian::class,
        ],[
            'name' => 'The Guardian',
            'url' => 'https://www.theguardian.com/',
            'logo' => null,
            'model' => TheGuardian::class,
            'active' => '1',
        ]);

        NewsSourceFacade::firstOrCreate([
            'model' => NewsApi::class,
        ],[
            'name' => 'News API',
            'url' => 'https://newsapi.org/',
            'logo' => null,
            'model' => NewsApi::class,
            'active' => '1',
        ]);

    }
}
