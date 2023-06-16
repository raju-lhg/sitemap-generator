<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteMap extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'note', 'created_by', 'xml_path'];

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
