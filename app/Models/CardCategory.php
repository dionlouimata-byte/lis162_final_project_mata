<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Card;

class CardCategory extends Model
{
    protected $table = 'card_categories';
    protected $primaryKey = 'card_category_id';
    public $timestamps = false;

    protected $fillable = [
        'category_name',
    ];

    // One category has many cards
    public function cards()
    {
        return $this->hasMany(
            Card::class,
            'CATEGORY_card_category_id',
            'card_category_id'
        );
    }
}
