<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adsenses', function (Blueprint $table) {
            $table->id();
            $table->string('page_name')->nullable();
            $table->integer('position')->comment('1 => top , 2 => bottom , 3 => right , 4 => left, 5 => after title page')->default(1);
            $table->string('code_adsense')->required();
            $table->integer('active')->default(1);
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
        Schema::dropIfExists('adsenses');
    }
}
