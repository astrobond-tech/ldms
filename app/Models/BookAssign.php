<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookAssign extends Model
{
    use HasFactory;
protected $table = 'book_assigns';
    protected $fillable = [
        'assign_to',
        'name',
        'room_no',
        'rack_no',
        'shelf_no',
        'box_no',
        'document',
        'description',
        'archive',
        'stage_id',
        'created_by',
        'parent_id',
    ];

    // ----------------- Relationships -----------------

    public function createdBy()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function assignTo()
    {
        return $this->hasOne(User::class, 'id', 'assign_to');
    }

    public function stageData()
    {
        return $this->hasOne(Stage::class, 'id', 'stage_id');
    }

    public function lastVersion()
    {
        return $this->hasOne(VersionHistory::class, 'book_assign_id', 'id')
            ->where('current_version', '=', 1);
    }
}
