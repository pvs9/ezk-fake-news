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
    public function up(): void
    {
        Schema::create('articles', static function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('external_id');
            $table->string('title');
            $table->longText('text');
            $table->string('author')->nullable();
            $table->string('source')->index();
            $table->timestamp('date');
            $table->unsignedInteger('comments_count')->default(0);
            $table->boolean('is_reliable')->default(true);
            $table->timestamps();

            $table->unique(['external_id', 'source']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
