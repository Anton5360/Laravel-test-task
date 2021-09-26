<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')
                    ->constrained('departments')
                    ->onUpdate('CASCADE')
                    ->onDelete('CASCADE');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name');
            $table->date('birthdate');
            $table->string('position');
            $table->enum('salary_type', ['hourly', 'monthly']);
            $table->unsignedDecimal('salary');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
