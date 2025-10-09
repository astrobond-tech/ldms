<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentIssue extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_id',
        'essential_id',
        'user_id',
        'issued_by',
        'issue_date',
        'due_date',
        'return_date',
        'status',
        'returned_to_location',
        'return_notes',
        'is_damaged',
        'fine_amount',
    ];

    protected $casts = [
        'is_damaged' => 'boolean',
        'fine_amount' => 'decimal:2',
    ];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function essential()
    {
        return $this->belongsTo(DocumentEssential::class, 'essential_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function issuer()
    {
        return $this->belongsTo(User::class, 'issued_by');
    }
}
