<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('certification_id');
            $table->foreign('certification_id')->on('certifications')->references('id')->ondelete('cascade');
            $table->unsignedBigInteger('font_id')->nullable();
            $table->foreign('font_id')->on('fonts')->references('id')->ondelete('set null');
            $table->integer('max_words')->nullable();
            $table->integer('min_words')->nullable();
            $table->integer('max_characters')->nullable();
            $table->integer('min_characters')->nullable();
            $table->string('color_text')->nullable();
            $table->string('field_name')->default('Field');
            $table->string('font_type')->nullable();
            $table->string('font_size_text')->nullable();
            $table->string('direction_text')->nullable();
            $table->text('text_for_test')->nullable();
            $table->double('width_box')->nullable();
            $table->double('height_box')->nullable();
            $table->double('transformX')->nullable();
            $table->double('transformY')->nullable();
            $table->string('target')->nullable();
            $table->string('image_width')->nullable();
            $table->string('image_height')->nullable();
            $table->string('image_asBackground')->nullable();
            $table->integer('date_year')->default(1);
            $table->integer('date_month')->default(1);
            $table->integer('date_day')->default(1);
            $table->integer('type_input')->comment('0 => input , 1 => textarea')->default(0);
            $table->string('formate_date')->nullable();
            $table->double('recX')->nullable();
            $table->double('recY')->nullable();
            $table->double('recHeight')->nullable();
            $table->double('recWidth')->nullable();
            $table->double('recTop')->nullable();
            $table->double('recBottom')->nullable();
            $table->double('recLeft')->nullable();
            $table->double('recRight')->nullable();
            $table->date('max_date')->nullable();
            $table->date('min_date')->nullable();
            $table->string('text_before_date')->nullable();
            $table->string('text_after_date')->nullable();
            $table->integer('type_field')->comment('1 => text , 2 => image or logo , 3 => date or time')->default(0);
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
        Schema::dropIfExists('options');
    }
}
