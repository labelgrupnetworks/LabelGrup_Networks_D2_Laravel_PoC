<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments("id_product")->unique();
            $table->unsignedInteger("id_user");
            $table->string('sku')->unique();
            $table->string("name");
            $table->string("description");
            $table->unsignedInteger("id_category");
            $table->text("secondary_categories")->default('[]');
            $table->integer("price");
            $table->integer("stock");
            $table->timestamps();
            $table->foreign('id_category')->references('id_category')->on('categories');
            $table->foreign('id_user')->references('id_user')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
