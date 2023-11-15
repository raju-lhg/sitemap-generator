<?php
// database/migrations/xxxx_xx_xx_create_meeting_transcripts_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingTranscriptsTable extends Migration
{
    public function up()
    {
        Schema::create('meeting_transcripts', function (Blueprint $table) {
            $table->id('meetingID');
            $table->integer('segmentID');
            $table->text('transcriptText');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('meeting_transcripts');
    }
}
