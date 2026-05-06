<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'image',
        'caption',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'sort_order' => 'integer',
    ];

    // ── Scopes ──────────────────────────────────────────────────────────────

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    public function scopeByCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    // ── Accessors ────────────────────────────────────────────────────────────

    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return 'https://picsum.photos/seed/' . $this->id . '/800/600';
    }

    // ── Static helpers ────────────────────────────────────────────────────────

    public static function getCategories(): array
    {
        return static::where('is_active', true)
            ->select('category')
            ->distinct()
            ->pluck('category')
            ->toArray();
    }
}
