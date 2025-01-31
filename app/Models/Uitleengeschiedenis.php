<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uitleengeschiedenis extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'uitleengeschiedenis';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'UUID';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'UUID',
        'VoorwerpUUID',
        'KindUUID',
        'Uitleendatum',
        'Aanmaakdatum',
        'Uitgeleend'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Define the relationship with the Kinderen table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kind()
    {
        return $this->belongsTo(Kinderen::class, 'KindUUID', 'UUID');
    }

    /**
     * Define the relationship with the Voorwerpen table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function voorwerp()
    {
        return $this->belongsTo(Voorwerpen::class, 'VoorwerpUUID', 'UUID');
    }
}
