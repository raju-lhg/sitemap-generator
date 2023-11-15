<?php
// app/Models/ProjectProposal.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectProposal extends Model
{
    use HasFactory;

    protected $primaryKey = 'projectProposalID';

    protected $fillable = [
        'projectOverviewID',
        'scopeOfWorkID',
        'proposalText',
    ];

    public function projectOverview()
    {
        return $this->belongsTo(ProjectOverview::class, 'projectOverviewID', 'projectOverviewID');
    }

    public function scopeOfWork()
    {
        return $this->belongsTo(ScopeOfWork::class, 'scopeOfWorkID', 'scopeOfWorkID');
    }
}
