<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voorwerpen extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'voorwerpen';

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
        'CategorieUUID',
        'Naam',
        'Beschrijving',
        'Notities',
        'QR',
        'Foto',
        'Actief',
        'Aanmaakdatum',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Define the relationship with the Uitleengeschiedenis table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function uitleengeschiedenis()
    {
        return $this->hasMany(Uitleengeschiedenis::class, 'VoorwerpUUID', 'UUID');
    }

    /**
     * Define the relationship with the Categories table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categorie()
    {
        return $this->belongsTo(Categories::class, 'CategorieUUID', 'UUID');
    }
}
