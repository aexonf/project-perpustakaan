<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogBookLoan extends Model
{
    use HasFactory;

    protected $table = "log_book_loan";

    protected $guarded = [];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Books::class, 'book_id');
    }
    public function librarian(): BelongsTo
    {
        return $this->belongsTo(Librarian::class, 'librarian_id');
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Students::class);
    }
}
