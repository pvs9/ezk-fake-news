<?php

namespace App\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class ArticleSourceDTO extends DataTransferObject
{
    public string $title;
    public string $date;
    public string $source;
    public int $similarity;
}
