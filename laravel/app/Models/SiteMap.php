<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteMap extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'note', 'created_by', 'xml_path', 'dns_data', 'who_is_data', 'public_id'];

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
