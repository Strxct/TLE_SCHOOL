<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserveringen extends Model
{
    use HasFactory;

    // Define the table name explicitly (optional if the table name follows conventions)
    protected $table = 'reserveringen';

    // Primary key field (optional if it's 'id')
    protected $primaryKey = 'UUID';

    // Disable timestamps (because there are no `created_at` and `updated_at` columns)
    public $timestamps = false;

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

    // Define fillable fields to protect against mass-assignment vulnerabilities
    protected $fillable = [
        'UUID',
        'MentorUUID',
        'VoorwerpUUID',
        'Aanmaakdatum',
    ];

    // Define the relationship with the Mentor model
    public function mentor()
    {
        return $this->belongsTo(Mentoren::class, 'MentorUUID', 'UUID');
    }

    // Define the relationship with the Voorwerp model
    public function voorwerp()
    {
        return $this->belongsTo(Voorwerpen::class, 'VoorwerpUUID', 'UUID');
    }
}
