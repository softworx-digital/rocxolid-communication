<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommunicationTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this
            ->emailNotification()
            ->smsNotification()
            ->pushNotification()
            ->communicationLog();
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::dropIfExists('email_notifications');
        Schema::dropIfExists('sms_notifications');
        Schema::dropIfExists('push_notifications');
        Schema::dropIfExists('communication_logs');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    protected function emailNotification()
    {
        Schema::create('email_notifications', function (Blueprint $table) {
            $table->increments('id')->unique()->index();
            $table->unsignedInteger('web_id')->nullable();
            $table->unsignedInteger('language_id')->nullable();
            $table->string('config')->default('default');
            $table->boolean('is_enabled')->default(0);
            $table->boolean('is_can_be_turned_off')->default(1);
            $table->string('event_type');
            $table->string('sender_email');
            $table->string('sender_name');
            $table->string('recipient_email')->nullable();
            $table->string('cc_recipient_email')->nullable();
            $table->string('bcc_recipient_email')->nullable();
            $table->unsignedTinyInteger('priority')->default(3);
            $table->string('subject');
            $table->text('content')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->unsignedInteger('deleted_by')->nullable();

            $table->foreign('web_id')
                ->references('id')
                ->on('webs')
                ->onDelete('cascade');
        });

        return $this;
    }

    protected function smsNotification()
    {
        Schema::create('sms_notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('web_id')->nullable();
            $table->unsignedInteger('language_id')->nullable();
            $table->string('config')->default('default');
            $table->boolean('is_enabled')->default(0);
            $table->string('event_type');
            $table->string('sender');
            $table->string('recipient_phone_number')->nullable();
            $table->text('content')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();

            $table->foreign('web_id')
                ->references('id')
                ->on('webs')
                ->onDelete('cascade');
        });

        return $this;
    }

    protected function pushNotification()
    {
        Schema::create('push_notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('web_id')->nullable();
            $table->unsignedInteger('language_id')->nullable();
            $table->string('config')->default('default');
            $table->boolean('is_enabled')->default(0);
            $table->string('event_type');
            $table->string('recipient_user_id')->nullable();
            $table->string('heading');
            $table->string('subtitle')->nullable();
            $table->string('url')->nullable();
            $table->text('content')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();

            $table->foreign('web_id')
                ->references('id')
                ->on('webs')
                ->onDelete('cascade');
        });

        return $this;
    }

    protected function communicationLog()
    {
        Schema::create('communication_logs', function (Blueprint $table) {
            $table->increments('id');
            //$table->morphs('model')->nullable(); // Call to a member function nullable() on null
            $table->string('model_type')->nullable();
            $table->unsignedInteger('model_id')->nullable();
            $table->morphs('sendable');
            $table->string('event');
            $table->string('sender');
            $table->string('recipient');
            $table->string('subject')->nullable();
            $table->text('content');
            $table->json('data');
            $table->boolean('is_success');
            $table->boolean('is_read')->default(0);
            $table->text('error_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->unsignedInteger('deleted_by')->nullable();
        });

        return $this;
    }

    private function importDump($table)
    {
        $file = sprintf('%s/%s.sql', \Softworx\RocXolid\Communication\ServiceProvider::dumpsPublishPath(), $table);

        try {
            DB::unprepared(file_get_contents($file));
        } catch (\ErrorException $e) {
            dd(__METHOD__, $file, $e);
        }

        return $this;
    }
}