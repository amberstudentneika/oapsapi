<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\eVoucher;

class eVoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $details = [
            [
                'fixedPrice'=>'200.00',
                'AdministratorID'=>1,
            ]
            ];

            foreach ($details as $key => $value) {
                # code...
                eVoucher::create($value);
            }
    }
}
