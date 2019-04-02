<?php

use App\MaintenanceRequest;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaintenanceRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenance_requests', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->bigInteger('user_id');
			$table->string('title');
			$table->enum('type', MaintenanceRequest::TYPES);
			$table->longText('description');
			$table->enum('status', MaintenanceRequest::STATUSES)->default('new');
			$table->integer('quote')->nullable();
			$table->integer('invoice')->nullable();
			$table->bigInteger('assigned')->nullable();
			$table->longText('contractors')->nullable();
			$table->string('comments')->nullable();
			$table->string('attachment')->nullable();
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
        Schema::dropIfExists('maintenance_requests');
    }
}
