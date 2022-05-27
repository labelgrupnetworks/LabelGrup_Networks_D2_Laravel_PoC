<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageablesTable extends Migration
{
    public function up()
    {
        Schema::create('imageables', function (Blueprint $table) {
            $table->primary(['imageable_id', 'imageable_type', 'image_id']);
            $table->morphs('imageable');
            $table->foreignId('image_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('imageables');
    }
}
