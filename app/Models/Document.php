<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    /** @use HasFactory<\Database\Factories\DocumentFactory> */
    use HasFactory;

    protected $fillable = [
        'folder_id',
        'title',
        'document_type',
        'file_name',
        'file_path',
        'file_type',
        'file_size',
    ];


    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }
}
