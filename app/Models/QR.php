<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QR extends Model
{
    use HasFactory;

    protected $table = 'qrs';

    protected $fillable = [
        'UUID',
        'qr',
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    public function voorwerpen()
    {
        return $this->hasMany(Voorwerpen::class, 'QRUUID', 'UUID');
    }
}