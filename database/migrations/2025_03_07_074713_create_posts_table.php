<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // Clé primaire auto-incrémentée
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Lien avec la table users
            $table->foreignId('sport_id')->constrained()->onDelete('cascade'); // Lien avec la table sports
            $table->string('content'); // Contenu du post
            $table->string('image_path')->nullable(); // Chemin de l'image (optionnel)
            $table->timestamps(); // created_at et updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
