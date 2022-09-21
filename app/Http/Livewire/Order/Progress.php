<?php

namespace App\Http\Livewire\Order;

use Carbon\Carbon;
use App\Models\Order;
use Livewire\Component;

class Progress extends Component
{
    public function render()
    {
        //QUERY UNTUK MENGAMBIL DATA APPOINTMENT HARI INI DENGAN STATUS SEDANG DILAYANI (1), DATANYA DI LIMIT 2 DATA
        $onProgress = Order::where('status', 1)->where('day', Carbon::now()->format('Y-m-d'))->take(2)->get();
        //MEMBUAT QUERY DATA APPOINTMENT HARI INI YANG DIURUTKAN BERDASARKAN DAILY SLOT PAGI, SORE, MALAM DAN DIURUTKAN LAGI BERDASRKAN PASIEN YANG MENDAFTARKAN LEBIH DULU
        //DATA DILIMIT 3 ITEM
        $next = Order::where('status', 0)
            ->where('day', Carbon::now()->format('Y-m-d'))
            ->orderBy('daily_slot_id', 'ASC')
            ->orderBy('created_at', 'ASC')
            ->take(3)->get();
        return view('livewire.order.progress', compact('onProgress', 'next'));
    }
}
