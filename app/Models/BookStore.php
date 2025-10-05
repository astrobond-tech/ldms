<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookStore extends Model
{
    use HasFactory;

    // Table name (optional if following Laravel convention)
    protected $table = 'book_store';

    // Fillable fields for mass assignment
    protected $fillable = [
        'book_name',
        'parent_id',
        'book_file',
        'room_no',
        'rack_no',
        'shelf_no',
        'box_no',
        'created_by',
        'user_id',
    ];

    // Casts (optional)
    protected $casts = [
        'created_at' => 'datetime',
    ];

    // Relationships
    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Optional: Accessor for full file path
    public function getBookFileUrlAttribute()
    {
        return $this->book_file ? asset('uploads/books/' . $this->book_file) : null;
    }
}
