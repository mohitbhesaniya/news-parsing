<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Api;
use App\News;

class getNewsData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:parsing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get News';

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
     * @return mixed
     */
    public function handle()
    {
        $apiModel = new Api();
        $newList = $apiModel->fetchAllNews();
        foreach($newList as $row){
            $matchThese = ['url'=>$row['url']];
            $insert = [
                'source' => $row['source']['name'] ?? 'cnn',
                'author' => $row['author'] ?? 'author',
                'title' => $row['title'],
                'description' =>$row['description'],
                'url' => $row['url'],
                'urlToImage' => $row['urlToImage'],
                'publishedAt' => $row['publishedAt'],
                'content' => $row['content'],
            ];
            News::updateOrCreate($matchThese,$insert);
        }
    }
}
