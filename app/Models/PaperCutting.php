<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaperCutting extends Model
{
    use HasFactory;

    protected $table = 'paper_cuttings';

    protected $fillable = [
        'paper_name',
        'parent_id',
        'papercutting_file',
        'heading',
        'room_no',
        'rack_no',
        'shelf_no',
        'box_no',
        'created_by',
		'created_at',
        'user_id',
    ];

    // Relation to creator
    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relation to assigned user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
