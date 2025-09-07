<?php

namespace App\Models;

use App\Enums\PropertyPurpose;
use App\Enums\PropertyStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'company_id','owner_id','property_type_id',
        'title','slug','purpose','status',
        'price','rent_price','currency',
        'country','city','address','lat','lng',
        // 'location', // if using spatial
        'bedrooms','bathrooms','area_sq_m','furnished','attributes',
    ];

    protected $casts = [
        'attributes' => 'array',
        'furnished'  => 'boolean',
        // cast strings into enums in your app layer (Filament forms can enforce options)
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(PropertyType::class, 'property_type_id');
    }

    public function amenities(): BelongsToMany
    {
        return $this->belongsToMany(Amenity::class);
    }

    public function media(): HasMany
    {
        return $this->hasMany(PropertyMedia::class);
    }

    // Helpers to work with enums while storing strings
    public function purposeEnum(): Attribute
    {
        return Attribute::get(fn () => PropertyPurpose::from($this->purpose));
    }

    public function statusEnum(): Attribute
    {
        return Attribute::get(fn () => PropertyStatus::from($this->status));
    }
}
