<?php
// app/Models/ProjectOverview.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectOverview extends Model
{
    use HasFactory;

    protected $primaryKey = 'projectOverviewID';

    protected $fillable = [
        'problemGoalID',
        'overviewText',
    ];

    public function problemsAndGoals()
    {
        return $this->belongsTo(ProblemsAndGoals::class, 'problemGoalID', 'problemGoalID');
    }
}
