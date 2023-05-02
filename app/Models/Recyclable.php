<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recyclable extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'recyclable_type_id',
        'qty',
        'earnings',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'recyclable_type_id' => 'integer',
        'qty' => 'decimal:3',
        'earnings' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recyclableType()
    {
        return $this->belongsTo(RecyclableType::class);
    }
}
