<?php

// app/Models/ProblemsAndGoals.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProblemsAndGoals extends Model
{
    use HasFactory;

    protected $primaryKey = 'problemGoalID';

    protected $fillable = [
        'meetingID',
        'problemGoalText',
    ];

    public function meetingTranscript()
    {
        return $this->belongsTo(MeetingTranscript::class, 'meetingID', 'meetingID');
    }

    public function projectOverview()
    {
        return $this->hasOne(ProjectOverview::class, 'problemGoalID', 'problemGoalID');
    }

    public function scopeOfWork()
    {
        return $this->hasOne(ScopeOfWork::class, 'problemGoalID', 'problemGoalID');
    }
}
