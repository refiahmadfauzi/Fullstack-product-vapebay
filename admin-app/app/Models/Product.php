<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     */
    protected $table = 'product';

    // ADD THIS: Beri tahu Eloquent bahwa Primary Key adalah string (bukan integer)
    protected $keyType = 'string';

    // ADD THIS: Beri tahu Eloquent bahwa Primary Key tidak auto-increment
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'description',
        'price',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'price' => 'decimal:2',
    ];
}
