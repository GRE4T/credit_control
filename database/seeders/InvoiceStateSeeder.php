<?php

namespace Database\Seeders;

use App\Models\InvoiceState;
use Illuminate\Database\Seeder;

class InvoiceStateSeeder extends Seeder
{
    const states = [
        [
            'key' => 'PENDING',
            'name' => 'Pendiente',
        ],
        [
            'key' => 'PAID',
            'name' => 'Pagado',
        ],
        [
            'key' => 'CANCELLED',
            'name' => 'Anulado',
        ],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::states as $state ){
            InvoiceState::updateOrCreate(
                [ 'key'=> $state['key']],
                $state
            );
        }
    }
}
