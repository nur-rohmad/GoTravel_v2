<?php

namespace Database\Seeders;

use App\Models\ChanelPembayaran;
use Illuminate\Database\Seeder;

class ChanelPembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ChanelPembayaran::create([
            'payment_type' => 'bank_transfer',
            'name' => 'Bank BRI',
            'payment_code' => 'bri',
            'image' => 'afjsdfsgfd',
            'status' => 'active'
        ]);
        ChanelPembayaran::create([
            'payment_type' => 'bank_transfer',
            'name' => 'Bank BNI',
            'payment_code' => 'bni',
            'image' => 'afjsdfsgfd',
            'status' => 'active'
        ]);
        ChanelPembayaran::create([
            'payment_type' => 'bank_transfer',
            'name' => 'Bank BCA',
            'payment_code' => 'bca',
            'image' => 'afjsdfsgfd',
            'status' => 'active'
        ]);
        ChanelPembayaran::create([
            'payment_type' => 'gopay',
            'name' => 'QRIS GOPAY',
            'payment_code' => 'gopay',
            'image' => 'afjsdfsgfd',
            'status' => 'active'
        ]);
        ChanelPembayaran::create([
            'payment_type' => 'cstore',
            'name' => 'INDOMARET',
            'payment_code' => 'indomaret',
            'image' => 'afjsdfsgfd',
            'status' => 'active'
        ]);
        ChanelPembayaran::create([
            'payment_type' => 'cstore',
            'name' => 'ALAMART',
            'payment_code' => 'alfamart',
            'image' => 'afjsdfsgfd',
            'status' => 'active'
        ]);
    }
}
