<?php

namespace App\Models;

use App\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleTransactionDetail extends Model
{
    use HasFactory, UseUuid, SoftDeletes;

    public function saleTransactionHeader(): BelongsTo
    {
        return $this->belongsTo(SaleTransactionHeader::class);
    }
}
