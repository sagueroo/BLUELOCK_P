<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('posts')) {
            Schema::create('posts', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('sport_id')->nullable();
                $table->text('content')->nullable();
                $table->string('image_path')->nullable();
                $table->timestamps();

                // Clés étrangères
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('sport_id')->references('id')->on('sports')->onDelete('set null');
            });
        } else {
            // La table posts existe déjà : on ajoute seulement sport_id s'il n'existe pas
            if (!Schema::hasColumn('posts', 'sport_id')) {
                Schema::table('posts', function (Blueprint $table) {
                    $table->unsignedBigInteger('sport_id')->nullable()->after('user_id');

                    $table->foreign('sport_id')->references('id')->on('sports')->onDelete('set null');
                });
            }
        }
    }}

