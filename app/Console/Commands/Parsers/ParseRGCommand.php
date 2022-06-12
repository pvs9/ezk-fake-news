<?php

namespace App\Console\Commands\Parsers;

use App\Models\Article;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class ParseRGCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rg:parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse https://rg.ru science news';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = CarbonImmutable::now();
        $from = $now->startOfYear()->subYears(2);
        $offset = $now->getTimestamp();

        while (Carbon::parse($offset)->greaterThanOrEqualTo($from)) {
            $response = Http::get(
                sprintf(
                    'https://apifilter.rg.ru/filter?query={"itemSelections":{"project":{"slug":"nauka"},"size":50,"priority":20,"fields":["id","link_title","label","is_adv","announce","publish_at","source_type","text"],"offset":%s}}',
                    $offset
                )
            );

            if ($response->status() !== 200) {
                break;
            }

            $data = $response->json();
            $items = $data['itemSelections']['hits'];

            if (empty($items)) {
                break;
            }

            $preparedItems = Arr::map($items, function ($item, $key) {
                return [
                    'external_id' => $item['_source']['id'],
                    'source' => 'https://rg.ru',
                    'title' => $item['_source']['link_title'],
                    'text' => trim(
                        preg_replace('!\s+!', ' ',
                            html_entity_decode(
                                str_replace('&nbsp;',' ', strip_tags($item['_source']['text']))
                            )
                        )
                    ),
                    'date' => Carbon::parse($item['_source']['publish_at'])->toDateTimeString(),
                ];
            });

            Article::query()->upsert(
                $preparedItems,
                ['external_id', 'source'],
                ['title', 'text', 'date']
            );

            $offset = Arr::last($items)['_source']['publish_at'];
        }
    }
}
