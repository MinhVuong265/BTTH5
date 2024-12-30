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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title')->nullable(); // Chức danh
            $table->string('academic_rank')->nullable(); // Học hàm
            $table->string('degree')->nullable(); // Học vị
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->unsignedBigInteger('department_id'); // Khóa ngoại liên kết với bảng departments
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->timestamps();
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
