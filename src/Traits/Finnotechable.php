<?php

namespace Tedon\LaravelFinnotech\Traits;

use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Collection;
use Tedon\LaravelFinnotech\Models\Transaction;

/**
 * @property Collection<Transaction> $ibanInquiries
 * @property Collection<Transaction> $shahkarVerifies
 */
trait Finnotechable
{
    public function finnotechable(): MorphToMany
    {
        return $this->morphToMany(Transaction::class, 'finnotechable');
    }

    public function ibanInquiries(): MorphToMany
    {
        return $this->finnotechable()
            ->where('type', 'iban_inquiry')
            ->latest();
    }

    public function shahkarVerifies(): MorphToMany
    {
        return $this->finnotechable()
            ->where('type', 'shahkar_verify')
            ->latest();
    }
}
