<?php

namespace App\Http\Livewire\Admin\Order;

use App\Models\DailySlot;
use App\Models\Order;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class OrderIndex extends Component
{
    use WithPagination;

    public $dailySlot = [];

    public $filterStatus;
    public $filterSlot;

    public function mount()
    {
        $this->dailySlot = DailySlot::orderBy('id', 'ASC')->get();
    }

    public function render()
    {
        // untuk memfilter
        $orders = Order::with(['daily_slot'])
            ->when($this->filterStatus != '', function ($query) {
                $query->where('status', $this->filterStatus);
            })
            ->when($this->filterSlot != '', function ($query) {
                $query->where('daily_slot_id', $this->filterSlot);
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        // query untuk mengambil total data
        $totalOrder = Order::where('day', Carbon::now()->format('Y-m-d'))->whereIn('status', [0, 1, 2, 3])->count();
        $onProgress = Order::where('day', Carbon::now()->format('Y-m-d'))->whereIn('status', [0, 1])->count();
        $complete = Order::where('day', Carbon::now()->format('Y-m-d'))->whereIn('status', [2])->count();

        return view('livewire.admin.order.order-index', compact('orders', 'totalOrder', 'onProgress', 'complete'))->layout('layouts.app');
    }
}
