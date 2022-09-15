<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['order_id'];

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
}
