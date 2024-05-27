<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
{
    Schema::create('players', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('avatar')->nullable();
        $table->date('birthday')->nullable();  
        $table->enum('gender', ['male', 'female', 'other'])->nullable();  
        $table->string('email')->unique()->nullable();  
        $table->string('phone')->nullable();  
        $table->decimal('performance_score', 5, 2)->nullable();
        $table->decimal('overall_score', 5, 2)->nullable();    
        $table->foreignId('team_id')->references('id')->on('teams')->nullable()->constrained();
        $table->timestamps();
    });
}
    
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
