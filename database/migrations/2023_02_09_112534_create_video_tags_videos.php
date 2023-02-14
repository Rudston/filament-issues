<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_tags_videos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBiginteger('video_id')->unsigned();
            $table->unsignedBiginteger('video_tag_id')->unsigned();

            $table->foreign('video_id')->references('id')
                ->on('videos')->onDelete('cascade');
            $table->foreign('video_tag_id')->references('id')
                ->on('video_tags')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video_tags_videos');
    }
};
