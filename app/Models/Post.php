<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property int $user_id
 * @property int $category_id
 * @property string $slug
 * @property string $title
 * @property string $excerpt
 * @property string $body
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $published_at
 * @property-read \App\Models\User|null $author
 * @property-read \App\Models\Category|null $category
 * @method static \Database\Factories\PostFactory factory(...$parameters)
 * @method static Builder|Post filter(array $filters)
 * @method static Builder|Post newModelQuery()
 * @method static Builder|Post newQuery()
 * @method static Builder|Post query()
 * @method static Builder|Post whereBody($value)
 * @method static Builder|Post whereCategoryId($value)
 * @method static Builder|Post whereCreatedAt($value)
 * @method static Builder|Post whereExcerpt($value)
 * @method static Builder|Post whereId($value)
 * @method static Builder|Post wherePublishedAt($value)
 * @method static Builder|Post whereSlug($value)
 * @method static Builder|Post whereTitle($value)
 * @method static Builder|Post whereUpdatedAt($value)
 * @method static Builder|Post whereUserId($value)
 * @mixin \Eloquent
 */
class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['category', 'author'];

    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when(
            $filters['search'] ?? false,
            fn (Builder $query, string $search) => $query
                ->where(
                    fn (Builder $query) => $query
                    ->where('title', 'like', '%' . $search . '%')
                    ->orWhere('body', 'like', '%' . $search . '%')
                )
        );

        $query->when(
            $filters['category'] ?? false,
            fn (Builder $query, string $category) => $query->whereHas(
                'category',
                fn (Builder $query) => $query->where('slug', $category)
            )
        );

        $query->when(
            $filters['author'] ?? false,
            fn (Builder $query, string $username) => $query->whereHas(
                'author',
                fn (Builder $query) => $query->where('username', $username)
            )
        );
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
