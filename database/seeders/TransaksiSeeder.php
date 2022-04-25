<?php

namespace Database\Seeders;

use App\Models\Transaksi;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transaksi = new Transaksi;
        $transaksi->account_id = 1;
        $transaksi->transaction_date = "2022-01-01";
        $transaksi->description = "Setor Tunai";
        $transaksi->status = "C";
        $transaksi->amount = 200000;
        $transaksi->save();

        $transaksi2 = new Transaksi;
        $transaksi2->account_id = 1;
        $transaksi2->transaction_date = "2022-01-01";
        $transaksi2->description = "Beli Pulsa";
        $transaksi2->status = "D";
        $transaksi2->amount = 10000;
        $transaksi2->save();

        $transaksi3 = new Transaksi;
        $transaksi3->account_id = 1;
        $transaksi3->transaction_date = "2022-01-02";
        $transaksi3->description = "Bayar Listrik";
        $transaksi3->status = "D";
        $transaksi3->amount = 70000;
        $transaksi3->save();

        $transaksi4 = new Transaksi;
        $transaksi4->account_id = 1;
        $transaksi4->transaction_date = "2022-01-02";
        $transaksi4->description = "Tarik Tunai";
        $transaksi4->status = "D";
        $transaksi4->amount = 100000;
        $transaksi4->save();

        $transaksi5 = new Transaksi;
        $transaksi5->account_id = 1;
        $transaksi5->transaction_date = "2022-01-03";
        $transaksi5->description = "Setor Tunai";
        $transaksi5->status = "C";
        $transaksi5->amount = 300000;
        $transaksi5->save();

        $transaksi6 = new Transaksi;
        $transaksi6->account_id = 1;
        $transaksi6->transaction_date = "2022-01-03";
        $transaksi6->description = "Bayar Listrik";
        $transaksi6->status = "D";
        $transaksi6->amount = 50000;
        $transaksi6->save();

        $transaksi7 = new Transaksi;
        $transaksi7->account_id = 1;
        $transaksi7->transaction_date = "2022-01-04";
        $transaksi7->description = "Tarik Tunai";
        $transaksi7->status = "D";
        $transaksi7->amount = 50000;
        $transaksi7->save();

        $transaksi8 = new Transaksi;
        $transaksi8->account_id = 1;
        $transaksi8->transaction_date = "2022-01-04";
        $transaksi8->description = "Beli Pulsa";
        $transaksi8->status = "D";
        $transaksi8->amount = 40000;
        $transaksi8->save();

        $transaksi9 = new Transaksi;
        $transaksi9->account_id = 1;
        $transaksi9->transaction_date = "2022-01-05";
        $transaksi9->description = "Tarik Tunai";
        $transaksi9->status = "D";
        $transaksi9->amount = 50000;
        $transaksi9->save();

        $transaksi10 = new Transaksi;
        $transaksi10->account_id = 1;
        $transaksi10->transaction_date = "2022-01-05";
        $transaksi10->description = "Setor Tunai";
        $transaksi10->status = "C";
        $transaksi10->amount = 50000;
        $transaksi10->save();

        $transaksi11 = new Transaksi;
        $transaksi11->account_id = 1;
        $transaksi11->transaction_date = "2022-01-05";
        $transaksi11->description = "Bayar Listrik";
        $transaksi11->status = "D";
        $transaksi11->amount = 125000;
        $transaksi11->save();

        $transaksi12 = new Transaksi;
        $transaksi12->account_id = 1;
        $transaksi12->transaction_date = "2022-01-05";
        $transaksi12->description = "Beli Pulsa";
        $transaksi12->status = "D";
        $transaksi12->amount = 20000;
        $transaksi12->save();
    }
}
