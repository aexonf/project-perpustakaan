<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Librarian extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = "librarian";

    public function logBookLoan(): BelongsTo
    {
        return $this->belongsTo(LogBookLoan::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
