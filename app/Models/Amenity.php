<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Amenity extends Model
{
    use SoftDeletes;

    protected $fillable = ['name','slug'];

    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(Property::class);
    }
}
