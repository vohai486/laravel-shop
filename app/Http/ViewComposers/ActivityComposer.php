<?php

namespace App\Http\ViewComposers;

use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;

class ActivityComposer
{
    public function compose(View $view)
    {
        $latestProducts = Cache::remember('latestProducts', 60, function () {
            return Product::where([
                'show_at_home' => 1,
                'status' => 1,
            ])
                ->latest()
                ->take(6)
                ->get();
        });

        $ratedProducts = Cache::remember('ratedProducts', 60, function () {
            return Product::withAvg('reviews', 'rating')
                ->orderByDesc('reviews_avg_rating')
                ->take(6)
                ->get();
        });

        $ratedReviewsProducts = Cache::remember('ratedReviewsProducts', 60, function () {
            return Product::withCount('reviews')
                ->orderByDesc('reviews_count')
                ->limit(6)
                ->get();
        });

        $view->with('latestProducts', $latestProducts);
        $view->with('ratedProducts', $ratedProducts);
        $view->with('ratedReviewsProducts', $ratedReviewsProducts);
    }
}