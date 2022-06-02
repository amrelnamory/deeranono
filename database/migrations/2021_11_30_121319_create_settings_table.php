<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_title_ar')->nullable();
            $table->string('site_title_en')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('welcome_message_ar')->nullable();
            $table->string('welcome_message_en')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('pinterest')->nullable();
            $table->string('youtube')->nullable();
            $table->string('address_ar')->nullable();
            $table->string('address_en')->nullable();
            $table->text('about_ar')->nullable();
            $table->text('about_en')->nullable();
            $table->string('collection_image')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('banner_title_ar')->nullable();
            $table->string('banner_title_en')->nullable();
            $table->string('banner_description_ar')->nullable();
            $table->string('banner_description_en')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
