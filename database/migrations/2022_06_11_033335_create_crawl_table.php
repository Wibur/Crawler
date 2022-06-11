<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrawlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crawl', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('screenshot')->nullable()->default('NULL');
            $table->string('title')->nullable()->default('NULL');
            $table->string('link', 50)->notnull();
            $table->string('description')->nullable()->default('NULL');
            $table->text('body')->nullable();
            $table->dateTime('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crawl');
    }
}
