<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['order_id', 'status_label'];

    //ACCESSOR UNTUK FORMAT ORDER_ID
    public function getOrderIdAttribute()
    {
        return substr($this->phone_number, -4) . '-' . strtoupper($this->name[0] . $this->name[1]);
    }

    //MUTATORS UNTUK MENGUBAH FORMAT NOMOR TELP
    public function setPhoneNumberAttribute($value)
    {
        //JIKA KARAKTER PERTAMA ADALAH 0 MAKA AKAN DIREPLACE DENGA 62
        $value = $value[0] == 0 ? '62' . substr($value, 1) : $value;
        $this->attributes['phone_number'] = $value;
    }

    public function getStatusLabelAttribute()
    {
        if ($this->status == 0) {
            return '<span class="text-secondary"><small>Dalam Antrian</small></span>';
        } elseif ($this->status == 1) {
            return '<span class="text-primary"><small>Sedang Dilayani</small></span>';
        } elseif ($this->status == 2) {
            return '<span class="text-success"><small>Selesai</small></span>';
        }
        return '<span class="text-danger"><small>Ditangguhkan</small></span>';
    }

    public function daily_slot()
    {
        return $this->belongsTo(DailySlot::class);
    }
}
