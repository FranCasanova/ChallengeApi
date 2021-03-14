<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInitialSatelliteData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('satellites')->insert([
            [
                'name' => 'kenobi',
                'position_x' => -500,
                'position_y' => -200
            ],
            [
                'name' => 'skywalker',
                'position_x' => 100,
                'position_y' => -100
            ],
            [
                'name' => 'sato',
                'position_x' => 500,
                'position_y' => 100
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
