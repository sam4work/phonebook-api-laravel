<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('phone_numbers', function (Blueprint $table) {
			$table->uuid('id')->primary()->default(DB::raw('(UUID())'));
			$table->foreignUuid('contact_id')->constrained()->onDelete('CASCADE');
			$table->string('type');
			$table->string('sim_number')->unique()->index();
			$table->boolean('registered')->default(false);
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('phone_numbers');
	}
};
