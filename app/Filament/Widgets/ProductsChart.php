<?php

namespace App\Filament\Widgets;

use App\Models\Product\Product;
use Carbon\Carbon;
use Filament\Widgets\BarChartWidget;

class ProductsChart extends BarChartWidget
{
    protected function getHeading(): string
    {
        return trans('dashboard.products.products');
    }


    protected function getData(): array {
        $products = Product::select('created_at')->get()->groupBy(function($products) {
            return Carbon::parse($products->created_at)->format('F');
        });
        $quantities = [];
        foreach ($products as $product => $value) {
            array_push($quantities, $value->count());
        }
        return [
            'datasets' => [
                [
                    'label' =>trans('dashboard.products.products'),
                    'data' => $quantities,
                    'backgroundColor' => [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)'
                    ],
                    'borderColor' => [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                    ],
                    'borderWidth' => 1
                ],
            ],
            'labels' => $products->keys(),
        ];
    }
    public static function canView(): bool
    {
        return !auth()->user()->hasRole('seller');
    }
}
