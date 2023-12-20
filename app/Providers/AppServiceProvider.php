<?php

namespace App\Providers;

use App\Models\Condition;
use App\Models\FrameSize;
use App\Models\FrameType;
use App\Models\Gender;
use App\Models\Manufacturer;
use App\Models\WheelSize;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $filters = new Collection();

        $filters->conditions = Condition::ordered()->whereHas('bikes')->get();
        $filters->frameSizes = FrameSize::ordered()->whereHas('bikes')->get();
        $filters->frameTypes = FrameType::ordered()->whereHas('bikes')->get();
        $filters->genders = Gender::ordered()->whereHas('bikes')->get();
        $filters->manufacturers = Manufacturer::ordered()->whereHas('bikes')->get();
        $filters->wheelSizes = WheelSize::ordered()->whereHas('bikes')->get();

        View::share('filters', $filters);
    }
}
