<?php

namespace App\Livewire\Admin;

use App\Models\Brand;
use App\Models\Car;
use App\Models\User;
use Livewire\Component;
class Dashboard extends Component
{
    public $filter = '7days';
    public $startDate;
    public $endDate;

    public function mount()
    {
        $this->startDate = now()->subDays(7)->format('Y-m-d');
        $this->endDate = now()->format('Y-m-d');
    }

    public function updatedFilter($value)
    {
        if ($value === '7days') {
            $this->startDate = now()->subDays(7)->format('Y-m-d');
            $this->endDate = now()->format('Y-m-d');
        } elseif ($value === 'monthly') {
            $this->startDate = now()->startOfMonth()->format('Y-m-d');
            $this->endDate = now()->endOfMonth()->format('Y-m-d');
        } elseif ($value === 'yearly') {
            $this->startDate = now()->startOfYear()->format('Y-m-d');
            $this->endDate = now()->endOfYear()->format('Y-m-d');
        }

        $this->dispatchChartUpdate();
    }

    public function updatedStartDate()
    {
        $this->dispatchChartUpdate();
    }
    public function updatedEndDate()
    {
        $this->dispatchChartUpdate();
    }

    protected function dispatchChartUpdate()
    {
        // Re-calculate chart data for the event
        $chartData = $this->getChartData();
        $this->dispatch('chartUpdated', labels: $chartData['labels'], values: $chartData['values']);
    }

    protected function getChartData()
    {
        $start = \Carbon\Carbon::parse($this->startDate);
        $end = \Carbon\Carbon::parse($this->endDate);
        $labels = [];
        $values = [];
        $current = clone $start;

        while ($current->lte($end)) {
            if ($this->filter === 'yearly') {
                $labels[] = $current->format('M');
                $val = Car::where('status', 'sold')
                    ->whereYear('sold_at', $current->year)
                    ->whereMonth('sold_at', $current->month)
                    ->sum(\Illuminate\Support\Facades\DB::raw('COALESCE(sold_price, selling_price)'));
                $values[] = $val;
                $current->addMonth()->startOfMonth();
            } else {
                $labels[] = $current->format('M j');
                $val = Car::where('status', 'sold')
                    ->whereDate('sold_at', $current->format('Y-m-d'))
                    ->sum(\Illuminate\Support\Facades\DB::raw('COALESCE(sold_price, selling_price)'));
                $values[] = $val;
                $current->addDay();
            }
            if (count($labels) > 31 && $this->filter !== 'yearly')
                break;
        }

        return ['labels' => $labels, 'values' => $values];
    }

    public function render()
    {
        $carsQuery = Car::query();
        $salesQuery = Car::where('status', 'sold');

        if ($this->filter === 'custom') {
            if ($this->startDate) {
                $carsQuery->whereDate('created_at', '>=', $this->startDate);
                $salesQuery->whereDate('sold_at', '>=', $this->startDate);
            }
            if ($this->endDate) {
                $carsQuery->whereDate('created_at', '<=', $this->endDate);
                $salesQuery->whereDate('sold_at', '<=', $this->endDate);
            }
        } else {
            $carsQuery->whereDate('created_at', '>=', $this->startDate)
                ->whereDate('created_at', '<=', $this->endDate);
            $salesQuery->whereDate('sold_at', '>=', $this->startDate)
                ->whereDate('sold_at', '<=', $this->endDate);
        }

        // Trend calculation
        $start = \Carbon\Carbon::parse($this->startDate);
        $end = \Carbon\Carbon::parse($this->endDate);
        $days = $start->diffInDays($end) + 1;
        $previousStart = (clone $start)->subDays($days);
        $previousEnd = (clone $end)->subDays($days);

        $currentSales = (clone $salesQuery)->sum(\Illuminate\Support\Facades\DB::raw('COALESCE(sold_price, selling_price)'));
        $previousSales = Car::where('status', 'sold')
            ->whereBetween('sold_at', [$previousStart->format('Y-m-d'), $previousEnd->format('Y-m-d')])
            ->sum(\Illuminate\Support\Facades\DB::raw('COALESCE(sold_price, selling_price)'));

        $salesTrend = $previousSales == 0 ? ($currentSales > 0 ? 100 : 0) : round((($currentSales - $previousSales) / $previousSales) * 100, 1);

        // Chart data helper
        $chartData = $this->getChartData();

        return view('livewire.admin.dashboard', [
            'totalCars' => $carsQuery->count(),
            'availableCars' => (clone $carsQuery)->where('status', 'available')->count(),
            'soldCars' => $salesQuery->count(),
            'totalSales' => $currentSales,
            'salesTrend' => $salesTrend,
            'chartLabels' => $chartData['labels'],
            'chartValues' => $chartData['values'],
            'totalBrands' => Brand::count(),
            'totalUsers' => User::count(),
            'recentCars' => Car::with('brand', 'model')->latest()->take(5)->get(),
        ])->layout('layouts.admin');
    }
}
