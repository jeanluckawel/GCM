<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    /** @use HasFactory<\Database\Factories\FolderFactory> */
    use HasFactory;

    protected $fillable = [
        'employee_id', 'is_complete', 'remarks',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }


    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
