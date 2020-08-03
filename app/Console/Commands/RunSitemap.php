<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class RunSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sd:run-sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Sitemap::create()
            ->add(
                Url::create('/')
                    ->setLastModificationDate(Carbon::yesterday())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
                    ->setPriority(1.0)
            )
            // ->add(
            //     Url::create('/privacy')
            //         ->setLastModificationDate(Carbon::yesterday())
            //         ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            //         ->setPriority(0.8)
            // )
            ->writeToFile(public_path('sitemap.xml'));
    }
}
