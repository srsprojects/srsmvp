<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRecyclablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::table('recyclables', function(Blueprint $table){
            $table->dropConstrainedForeignId('user_id');
            $table->after('id', function (Blueprint $table){
                $table->foreignIdFor(User::class, 'depositor_id')->constrained('users');
                $table->foreignIdFor(User::class, 'collector_id')->constrained('users');    
            });
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recyclables', function(Blueprint $table){
            $table->dropConstrainedForeignId('depositor_id');
            $table->dropConstrainedForeignId('collector_id');
        });
    }
}
