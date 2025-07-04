<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->integer('quantity');
            $table->boolean('is_expire')->default(false);
            $table->date('expire_at')->nullable();
            $table->boolean('is_shippable')->default(false);
            $table->double('weight')->nullable()->comment('Weight in kg if shippable');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
