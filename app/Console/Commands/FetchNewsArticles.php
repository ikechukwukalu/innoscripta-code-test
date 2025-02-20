<?php

namespace App\Console\Commands;

use App\Facades\NewsSource as NewsSourceFacade;
use Illuminate\Console\Command;

class FetchNewsArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:articles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch all news articles from various sources according to their categories.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $newsSources = NewsSourceFacade::getAll();

        foreach ($newsSources as $newsSource) {
            $newsSourceModel = new $newsSource->model;
            $newsSourceService = $newsSourceModel->getNewsService();
            $responseData = $newsSourceService->fetchArticles();

            if ($responseData->success) {
                $this->info("Successfully fetched records from {$newsSource->name} source");
                continue;
            }

            $this->error("Failed to fetch some records from {$newsSource->name} source");
        }
    }
}
