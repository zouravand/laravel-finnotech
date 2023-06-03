<?php

namespace Tedon\LaravelFinnotech\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property array $result
 * @property string $type
 */
class Transaction extends Model
{
    protected $table = 'finnotech_transactions';

    protected $fillable = [
        'type',
        'track_id',
        'status',
        'result',
        'error',
        'inputs',
    ];

    protected $casts = [
        'result' => 'json',
        'error'  => 'json',
        'inputs' => 'json',
    ];

    public function finnotechable(): MorphTo
    {
        return $this->morphTo('finnotechable', ownerKey: 'transaction_id');
    }
}
