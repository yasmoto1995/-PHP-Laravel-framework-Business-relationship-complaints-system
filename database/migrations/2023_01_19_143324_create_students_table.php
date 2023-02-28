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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50);
            $table->text('message');
            $table->enum('type',["Complaint","Suggestion"]);
            $table->string('student_university_id',15);
            $table->string('student_name',50);
            $table->string('email',50);
            $table->string('image')->nullable();
            $table->boolean('urgent')->default(false);
            $table->timestamp('closed_date')->nullable();
            $table->text('response')->nullable();
            $table->enum('status',["Open","Closed"])->default('Open');
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
        Schema::dropIfExists('students');
    }
};
