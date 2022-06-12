<?php

namespace App\Services;

use App\DTO\ArticleAnalysisDTO;
use JetBrains\PhpStorm\ArrayShape;
use ptlis\ShellCommand\CommandBuilder;

class AnalysisService
{
    #[ArrayShape(['overall' => "int|null", 'authenticity' => "int|null", 'tonality' => "int", 'source_reliability' => "int", 'article' => "array", 'pdf_report' => "string", 'original_source' => "null"])]
    public function analyze(ArticleAnalysisDTO $dto): array
    {
        $authenticity = $this->predictReliability($dto->uuid, $dto->text);
        $tonality = $this->predictTonality($dto->uuid, $dto->text);

        return [
            'overall' => $authenticity,
            'authenticity' => $authenticity,
            'tonality' => $tonality,
            'source_reliability' => 0,
            'article' => $dto->only('title', 'text')->toArray(),
            'pdf_report' => 'https://ya.ru/',
            'original_source' => null,
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
            ->setCommand(
                sprintf('python3 %s', storage_path('ml/reliability/main.py'))
            )
            ->addArguments([
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

    protected function predictTonality(string $uuid, string $text): ?float
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
            ->setCommand(
                sprintf('python3 %s', storage_path('ml/tonality/main.py'))
            )
            ->addArguments([
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
                return (float) $reliability;
            }
        }

        return null;
    }
}
