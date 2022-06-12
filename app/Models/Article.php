<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Article
 *
 * @property int $id
 * @property int $external_id
 * @property string $title
 * @property string $text
 * @property string|null $author
 * @property string $source
 * @property Carbon $date
 * @property int $comments_count
 * @property int $is_reliable
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Article newModelQuery()
 * @method static Builder|Article newQuery()
 * @method static Builder|Article query()
 * @method static Builder|Article whereAuthor($value)
 * @method static Builder|Article whereCommentsCount($value)
 * @method static Builder|Article whereCreatedAt($value)
 * @method static Builder|Article whereDate($value)
 * @method static Builder|Article whereId($value)
 * @method static Builder|Article whereIsFake($value)
 * @method static Builder|Article whereSource($value)
 * @method static Builder|Article whereText($value)
 * @method static Builder|Article whereTitle($value)
 * @method static Builder|Article whereUpdatedAt($value)
 *
 * @property-read string|null $link
 */
class Article extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'external_id',
        'title',
        'text',
        'author',
        'source',
        'date',
        'comments_count',
        'is_reliable',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'datetime',
        'is_reliable' => 'boolean'
    ];

    public function getLinkAttribute(): ?string
    {
        return match ($this->source) {
            'https://mos.ru' => sprintf('https://mos.ru/news/item/%s/', $this->external_id),
            default => null,
        };
    }
}
