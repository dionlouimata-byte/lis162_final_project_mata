<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Effect;
use App\Models\CardCategory;


class Card extends Model
{
    protected $table = 'cards';
    protected $primaryKey = 'card_id';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'card_name',
        'card_category_id',
        'handtrap',
        'CATEGORY_category_id',
    ];

    protected $casts = [
        'handtrap' => 'boolean',
    ];

    // Relationships


    // A card belongs to exactly one category

    public function category()
    {
        return $this->belongsTo(
            CardCategory::class,
            'CATEGORY_category_id',
            'card_category_id'
        );
    }

    // A card can have multiple effects.

    public function effects()
    {
        return $this->hasMany(
            Effect::class,
            'CARDS_card_id',
            'card_id'
        );
    }

    // Query Scopes:

    // Scope for handtrap cards only.

    public function scopeHandtraps($query)
    {
        return $query->where('handtrap', true);
    }

    // Helper Logic

    // Determine if this card is a handtrap.
    
    public function isHandtrap(): bool
    {
        return (bool) $this->handtrap;
    }
}
