<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kinderen extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kinderen';

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
        'MentorUUID',
        'Voornaam',
        'Achternaam',
        'Geboortedatum',
        'Contact',
        'Aanmaakdatum',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Define the relationship with the Mentor (Mentoren table).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mentor()
    {
        return $this->belongsTo(Mentoren::class, 'MentorUUID', 'UUID');
    }

    /**
     * Define the relationship with the Uitleengeschiedenis table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function uitleengeschiedenis()
    {
        return $this->hasMany(Uitleengeschiedenis::class, 'KindUUID', 'UUID');
    }
}
