<?php

namespace App\Http\Livewire\Order;

use Carbon\Carbon;
use App\Models\Order;
use Livewire\Component;
use App\Models\DailySlot;

class Appointment extends Component
{
    public $timeSlot = []; //UNTUK MENYIMPAN DATA KATEGORI SLOT YANG TERSEDIA BERDASARKAN PILIHAN HARI/TANGGAL

    public $day;
    public $slot;
    public $name;
    public $age;
    public $phone_number;
    public $note;
    public $note_additional;

    //RULES VALIDASI
    protected $rules = [
        'day' => 'required|string',
        'slot' => 'required|exists:daily_slots,id',
        'name' => 'required|string|max:100',
        'age' => 'required|numeric|digits:2',
        'phone_number' => 'required|numeric|digits:12',
        'note' => 'required|string',
        'note_additional' => 'nullable|string|max:200'
    ];

    public function store()
    {
        //MENJALANKAN VALIDASI
        $this->validate();

        try {
            //MEMBUAT QUERY BERDASARKAN WAKTU KEDATANGAN YANG DIPLIH BESERTA TOTAL PENDAFTAR PADA HARI YANG TELAH DIPILIH
            $dailySlot = DailySlot::withCount(['orders' => function ($query) {
                $query->where('day', $this->day);
            }])
                ->where('id', $this->slot)
                ->first();

            //JIKA PENDAFTAR TELAH MELEBIHI ATAU SAMA DENGAN QUOTA YANG TELAH DITETAPKAN
            if ($dailySlot->orders_count >= $dailySlot->quota) {
                //MAKA KOSONGKAN 3 PROPERTY DI BAWAH INI
                $this->timeSlot = [];
                $this->day = '';
                $this->slot = '';

                //LALU BERIKAN NOTIFIKASI KEPADA PASIEN
                return session()->flash('error', 'Kuota pasien telah mencapai batas maksimum');
            };

            //JIKA QUOTA MASIH TERSEDIA, MAKA SIMPAN KE DALAM DATABASE
            $order = Order::create([
                'daily_slot_id' => $this->slot,
                'day' => $this->day,
                'name' => $this->name,
                'age' => $this->age,
                'phone_number' => $this->phone_number,
                'note' => $this->note . ' ' . $this->note_additional,
                'status' => 0
            ]);

            //LALU KOSONGKAN SEMUA PROPERTY
            $this->timeSlot = [];
            $this->day = '';
            $this->slot = '';
            $this->name = '';
            $this->age = '';
            $this->phone_number = '';
            $this->note = '';
            $this->note_additional = '';

            //BERIKAN NOTIFIKASI BAHWA PASIEN TELAH MENDAPATKAN NOMOR ANTRIAN
            return session()->flash('success', 'Nomor Antrian Anda Adalah: ' . $order->order_id);
        } catch (\Exception $e) {
            //JIKA ERROR, TAMPILKAN NOTIFIKASI ERROR
            return session()->flash('error', $e->getMessage());
        }
    }

    public function getTimeSlot($value)
    {
        //QUERY UNTUK MENGAMBIL WAKTU LAYANAN YANG TERSEDIA
        //WITHCOUNT UNTUK MENGAMBIL TOTAL PASIEN YANG SUDAH MENDAFTAR
        $getTimeSlot = DailySlot::withCount(['orders' => function ($query) use ($value) {
            //DENGAN FILTER HARI YANG DIPILIH PASIEN
            $query->where('day', $value);
        }])->where('is_active', 1)
            ->orderBy('created_at', 'DESC')
            ->get();

        //HASIL QUERY DI ATAS AKAN DISIMPAN KEDALAM PROPERTY timeSlot YANG TELAH KITA LOOPING PADA FORM Waktu Kedatangan
        $this->timeSlot = $getTimeSlot;
    }

    public function render()
    {
        $days = [
            [
                'day' => Carbon::now()->addDays(1)->format('Y-m-d'),
                'label' => Carbon::now()->addDays(1)->format('l, d F Y')
            ],
            [
                'day' => Carbon::now()->addDays(2)->format('Y-m-d'),
                'label' => Carbon::now()->addDays(2)->format('l, d F Y')
            ]
        ];
        return view('livewire.order.appointment', compact('days'));
    }

    public function hydrate()
    {
        //JIKA PROPERTY timeSlot ADALAH SEBUAH COLLECTION
        if (is_a($this->timeSlot, 'Illuminate\Database\Eloquent\Collection')) {
            //MAKA KITA GUNAKAN FUNGSI loadCount UNTUK MENGAMBIL ULANG DATA ORDERS
            $this->timeSlot->loadCount(['orders' => function ($query) {
                $query->where('day', $this->day);
            }]);
        }
    }
}
