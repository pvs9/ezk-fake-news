<?php

namespace App\DTO;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

final class ArticleAnalysisDTO extends DataTransferObject
{
    public string $title;
    public string $text;
    public string $uuid;

    /**
     * @throws UnknownProperties
     */
    public static function fromRequest(Request $request): ArticleAnalysisDTO
    {
        return new self(
            title: $request->input('title'),
            text: $request->input('text'),
            uuid: Str::uuid()
        );
    }
}
