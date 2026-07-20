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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_number')->unique();
            $table->string('last_name');
            $table->string('middle_name')->nullable();
            $table->string('first_name');
            $table->enum('gender', ['male', 'female']);
            $table->date('birth_date');

            $table->enum('status', [
                'active',
                'retired',
                'suspended',
            ])->default('active');

            $table->string('position')->nullable();
            $table->string('grade')->nullable();

//
//            $table->foreignId('department_id')
//                ->nullable()
//                ->constrained()
//                ->nullOnDelete();
            $table->string('department')->nullable();


            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();

            $table->date('hire_date')->nullable();
            $table->date('retirement_date')->nullable();

            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
