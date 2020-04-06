<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailcoachPlaceholder extends Migration
{
    public function up()
    {

        Schema::create('mailcoach_email_list_placeholders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('email_list_id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->longText('replace_value')->nullable();
            $table->timestamps();

            $table
                ->foreign('email_list_id', 'email_list_placeholders_email_list_id_index')
                ->references('id')->on('mailcoach_email_lists')
                ->onDelete('cascade');

        });
    }
}
