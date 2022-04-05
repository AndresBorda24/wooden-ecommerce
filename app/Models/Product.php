<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'price',
        'stock',
        'wood_type_id',
        'category_id',
    ];

    // --- Relationships --- //

    /**
     * Obtiene el _wooden_type_ al que pertenece
     */
    public function woodenType()
    {
        return $this->belongsTo(woodenType::class);
    }

    /**
     * Obtiene la categoria a la que pertenece
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Obtiene los rates que posee
     */
    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    /**
     * Obtiene las preguntas realizadas al producto 
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    /**
     * Obtiene las ordenes en las que está el producto
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class)->using(OrderProduct::class)->withPivot('price', 'quantity');
    }
}
