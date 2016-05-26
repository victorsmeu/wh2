<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function( Blueprint $table) {
            $table->increments('id');
            $table->string('name', 40);
            $table->string('description', 255);
            $table->timestamps();
        });
        
        Schema::create('specialties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('term');
            $table->timestamps();
        });

        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('specialty_id')->unsigned();
            $table->foreign('specialty_id')->references('id')->on('specialties')->onDelete('cascade');
            $table->string('filename');
            $table->string('document_name');
            $table->string('target_ehr_category');
            $table->timestamps();
        });

        Schema::create('history', function (Blueprint $table) {
            $table->increments('id');
            $table->string('action');
            $table->text('data');
            $table->timestamps();
            $table->index('action');
        });

        Schema::create('medic_specialties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('specialty_id')->unsigned();
            $table->foreign('specialty_id')->references('id')->on('specialties')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender');
            $table->smallInteger('year_of_birth');
            $table->timestamps();
        });

        Schema::create('patient_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id')->unsigned();
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->text('info');
            $table->timestamps();
        });

        Schema::create('studies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('study_id_dicom');
            $table->string('study_name');
            $table->integer('specialty_id')->unsigned();
            $table->string('upload_code');
            $table->string('upload_status');
            $table->string('patient_id')->unsigned();
            $table->string('institution');
            $table->string('modality');
            $table->string('bodyPart');
            $table->string('creationDate');
            $table->string('description');
            $table->string('sex');
            $table->integer('age');
            $table->timestamps();
        });

        Schema::create('studies_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('study_id')->unsigned();
            $table->foreign('study_id')->references('id')->on('studies')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('study_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('study_id')->unsigned();
            $table->foreign('study_id')->references('id')->on('studies')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('comment');
            $table->timestamps();
        });

        Schema::create('study_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('study_id')->unsigned();
            $table->foreign('study_id')->references('id')->on('studies')->onDelete('cascade');
            $table->string('study_code');
            $table->string('name');
            $table->string('mrn');
            $table->date('date');
            $table->string('age');
            $table->string('gender');
            $table->string('center');
            $table->string('owner');
            $table->string('pni');
            $table->timestamps();
        });

        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('study_id')->unsigned();
            $table->foreign('study_id')->references('id')->on('studies')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('viewers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('link');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('documents');
        Schema::drop('history');
        Schema::drop('medic_specialties');
        Schema::drop('patient_data');
        Schema::drop('patients');
        Schema::drop('reports');
        Schema::drop('specialties');
        Schema::drop('studies_users');
        Schema::drop('study_comments');
        Schema::drop('study_details');
        Schema::drop('studies');
        Schema::drop('viewers');
        Schema::drop('roles');
        Schema::drop('users');
    }
}
