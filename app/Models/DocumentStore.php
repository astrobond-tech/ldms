<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentStore extends Model
{
    use HasFactory;

    protected $table = 'document_store';

    protected $fillable = [
        'document_name',
        'document_file',
        'availability_type',
        'parent_id',
        'description',
        'room_no',
        'rack_no',
        'shelf_no',
        'box_no',
        'created_by',
        'user_id',
    ];

    // Relationships
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getFileUrlAttribute()
    {
        return $this->document_file ? asset('storage/' . $this->document_file) : null;
    }
}
