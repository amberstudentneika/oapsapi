<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\relation;

class RelationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $type = [
            [
                'type'=>'Mother',
            ],
            [
                'type'=>'Father',
            ],
            [
                'type'=>'Guardian',
            ],
            ];


            foreach ($type as $key => $value) {
                # code...

                relation::create($value);
            }
    }
}
