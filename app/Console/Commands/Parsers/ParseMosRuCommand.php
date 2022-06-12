<?php

namespace App\Console\Commands\Parsers;

use App\Models\Article;
use Carbon\CarbonImmutable;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class ParseMosRuCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mos-ru:parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse https://mos.ru tech news';

    public function handle()
    {
        $now = CarbonImmutable::now();
        $from = $now->startOfYear()->subYears(2)->toDateString();
        $to = $now->toDateString();
        $page = 1;
        $totalPages = 1;

        while ($page <= $totalPages) {
            $response = Http::get(
                sprintf(
                    'https://mos.ru/api/newsfeed/v4/frontend/json/ru/articles?fields=id,title,date,full_text,&filter={"spheres.id":"183299","!=id":[108162073,108148073,108124073,108157073,108150073,108128073,108160073,108138073,108123073]}&from=%s&per-page=50&sort=-date&to=%s&page=%s',
                    $from, $to, $page
                )
            );

            if ($response->status() !== 200) {
                break;
            }

            $data = $response->json();
            $totalPages = $data['_meta']['pageCount'];
            $items = $data['items'];
            $preparedItems = Arr::map($items, function ($item, $key) {
                return [
                    'external_id' => $item['id'],
                    'source' => 'https://mos.ru',
                    'title' => $item['title'],
                    'text' => trim(
                        preg_replace('!\s+!', ' ',
                            html_entity_decode(
                                str_replace('&nbsp;',' ', strip_tags($item['full_text']))
                            )
                        )
                    ),
                    'date' => $item['date'],
                ];
            });

            Article::query()->upsert(
                $preparedItems,
                ['external_id', 'source'],
                ['title', 'text', 'date']
            );

            $page++;
        }
    }
}
