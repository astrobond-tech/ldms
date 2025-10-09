<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentEssential extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_id',
        'document_type',
        'copies_total',
        'copies_available',
        'rack',
        'shelf',
        'room',
        'cabinet',
        'author',
        'publisher',
        'isbn',
        'language',
        'published_year',
        'newspaper_name',
        'clipping_date',
        'headline',
        'section',
        'forwarded_to',
        'doc_category',
        'ref_number',
        'file_number',
        'latest_version_history_id',
    ];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function latestVersionHistory()
    {
        return $this->belongsTo(VersionHistory::class, 'latest_version_history_id');
    }


}
