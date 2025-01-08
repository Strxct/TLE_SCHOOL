<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentoren extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mentoren';

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
        'Voornaam',
        'Achternaam',
        'Email',
        'Wachtwoord',
        'Admin',
        'Aanmaakdatum',
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kinderen()
    {
        return $this->hasMany(Kinderen::class, 'MentorUUID', 'UUID');
    }

    /**
     * Define the relationship with the Reserveringen table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reserveringen()
    {
        return $this->hasMany(Reserveringen::class, 'MentorUUID', 'UUID');
    }
}
