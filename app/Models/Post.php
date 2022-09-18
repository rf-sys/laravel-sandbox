<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $with = ['category', 'author'];

    /**
     * @param Builder $query
     * @param array<string, string> $filters
     * @return void
     */
    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when(
            $filters['search'] ?? false,
            fn (Builder $query, $search) => $query
                ->where(
                    fn (Builder $query) => $query
                        ->where('title', 'like', '%' . $search . '%')
                        ->orWhere('body', 'like', '%' . $search . '%')
                )
        );

        $query->when(
            $filters['category'] ?? false,
            fn (Builder $query, $category) => $query->whereHas(
                'category',
                fn (Builder $query) => $query->where('slug', $category)
            )
        );

        $query->when(
            $filters['author'] ?? false,
            fn (Builder $query, $username) => $query->whereHas(
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
