<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PropertyType extends Model
{
    use SoftDeletes;

    protected $fillable = ['name','slug','parent_id','sort_order','meta'];

    protected $casts = [
        'meta' => 'array',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(PropertyType::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(PropertyType::class, 'parent_id');
    }

    public function scopeRoots(Builder $q): Builder
    {
        return $q->whereNull('parent_id')->orderBy('sort_order');
    }
}
