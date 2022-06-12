<?php

namespace App\Services;

use App\DTO\ArticleAnalysisDTO;
use App\DTO\ArticleSourceDTO;
use App\Models\Article;
use JetBrains\PhpStorm\ArrayShape;
use ptlis\ShellCommand\CommandBuilder;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class AnalysisService
{
    #[ArrayShape(['overall' => "int|null", 'authenticity' => "int|null", 'tonality' => "int|null", 'article' => "array", 'pdf_report' => "string", 'original_source' => "\App\DTO\ArticleSourceDTO|array|null"])]
    public function analyze(ArticleAnalysisDTO $dto): array
    {
        $authenticity = $this->predictReliability($dto->uuid, $dto->text);
        $tonality = $this->predictTonality($dto->uuid, $dto->text);

        try {
            $source = $this->predictSimilarity($dto->uuid, $dto->text);
        } catch (UnknownProperties) {
            $source = null;
        }

        if (!is_null($source)) {
            $sourceModel = Article::query()
                ->where('source', $source->source)
                ->where('date', $source->date)
                ->where('title', $source->title)
                ->first();

            if (!is_null($sourceModel)) {
                $source = [
                    'title' => $sourceModel->title,
                    'link' => $sourceModel->link,
                    'similarity' => $source->similarity,
                ];
            } else {
                $source = null;
            }
        }

        return [
            'overall' => $authenticity,
            'authenticity' => $authenticity,
            'tonality' => $tonality,
            'article' => $dto->only('title', 'text')->toArray(),
            'pdf_report' => 'https://ya.ru/',
            'original_source' => $source,
        ];
    }

    protected function predictReliability(string $uuid, string $text): ?int
    {
        $predictionInputData = [
            [
                'text',
            ],
            [
                $text,
            ],
        ];

        $inputFileName = sprintf(
            '%s%s_in.csv',
            storage_path('ml/reliability/data/'),
            $uuid
        );

        $outputFileName = sprintf(
            '%s%s_out.csv',
            storage_path('ml/reliability/data/'),
            $uuid
        );

        $handle = fopen($inputFileName, 'wb');

        foreach ($predictionInputData as $line) {
            fputcsv($handle, $line);
        }

        fclose($handle);

        (new CommandBuilder())
            ->setCommand('python3')
            ->addArguments([
                storage_path('ml/reliability/main.py'),
                $inputFileName,
                $outputFileName,
            ])
            ->buildCommand()
            ->runSynchronous();

        $data = [];
        $file = fopen($outputFileName, 'rb');

        while (($line = fgetcsv($file)) !== FALSE) {
            $data[] = $line;
        }

        fclose($file);

        if (count($data) === 2) {
            $reliability = $data[1][1] ?? null;

            if (!is_null($reliability)) {
                return (int) round((float) $reliability);
            }
        }

        return null;
    }

    /**
     * @throws UnknownProperties
     */
    protected function predictSimilarity(string $uuid, string $text): ?ArticleSourceDTO
    {
        $predictionInputData = [
            [
                'text',
            ],
            [
                $text,
            ],
        ];

        $inputFileName = sprintf(
            '%s%s_in.csv',
            storage_path('ml/similarity/data/'),
            $uuid
        );

        $outputFileName = sprintf(
            '%s%s_out.csv',
            storage_path('ml/similarity/data/'),
            $uuid
        );

        $handle = fopen($inputFileName, 'wb');

        foreach ($predictionInputData as $line) {
            fputcsv($handle, $line);
        }

        fclose($handle);

        (new CommandBuilder())
            ->setCommand('python3')
            ->addArguments([
                storage_path('ml/similarity/main.py'),
                $inputFileName,
                $outputFileName,
            ])
            ->buildCommand()
            ->runSynchronous();

        $data = [];
        $file = fopen($outputFileName, 'rb');

        while (($line = fgetcsv($file)) !== FALSE) {
            $data[] = $line;
        }

        fclose($file);

        if (count($data) === 2) {
            $source = $data[1] ?? null;

            if (!is_null($source)) {
                return new ArticleSourceDTO(
                    title: $source[0],
                    date: $source[1],
                    source: 'https://mos.ru',
                    similarity: (int) round(((float) $source) * 100)
                );
            }
        }

        return null;
    }

    protected function predictTonality(string $uuid, string $text): ?int
    {
        $predictionInputData = [
            [
                'text',
            ],
            [
                $text,
            ],
        ];

        $inputFileName = sprintf(
            '%s%s_in.csv',
            storage_path('ml/tonality/data/'),
            $uuid
        );

        $outputFileName = sprintf(
            '%s%s_out.csv',
            storage_path('ml/tonality/data/'),
            $uuid
        );

        $handle = fopen($inputFileName, 'wb');

        foreach ($predictionInputData as $line) {
            fputcsv($handle, $line);
        }

        fclose($handle);

        (new CommandBuilder())
            ->setCommand('python3')
            ->addArguments([
                storage_path('ml/tonality/main.py'),
                $inputFileName,
                $outputFileName,
            ])
            ->buildCommand()
            ->runSynchronous();

        $data = [];
        $file = fopen($outputFileName, 'rb');

        while (($line = fgetcsv($file)) !== FALSE) {
            $data[] = $line;
        }

        fclose($file);

        if (count($data) === 2) {
            $tonality = $data[1][1] ?? null;

            if (!is_null($tonality)) {
                return (int) round(((float) $tonality) * 100);
            }
        }

        return null;
    }
}
