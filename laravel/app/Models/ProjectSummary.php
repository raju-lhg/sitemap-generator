<?php
// app/Models/ProjectSummary.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectSummary extends Model
{
    use HasFactory;

    protected $primaryKey = 'summaryID';

    protected $fillable = [
        'meetingID',
        'summaryText',
    ];

    public function meetingTranscript()
    {
        return $this->belongsTo(MeetingTranscript::class, 'meetingID', 'meetingID');
    }
}
