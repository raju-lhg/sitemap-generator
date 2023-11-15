<?php
// app/Models/MeetingTranscript.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingTranscript extends Model
{
    use HasFactory;

    protected $primaryKey = 'meetingID';
    public $incrementing = false;

    protected $fillable = [
        'segmentID',
        'transcriptText',
    ];

    public function projectSummary()
    {
        return $this->hasOne(ProjectSummary::class, 'meetingID', 'meetingID');
    }

    public function problemsAndGoals()
    {
        return $this->hasOne(ProblemsAndGoals::class, 'meetingID', 'meetingID');
    }

    public function projectProposal()
    {
        return $this->hasOne(ProjectProposal::class, 'meetingID', 'meetingID');
    }
}
