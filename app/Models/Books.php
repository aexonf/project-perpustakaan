<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Books extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function logBookLoan(): BelongsTo
    {
        return $this->belongsTo(LogBookLoan::class);
    }
}
