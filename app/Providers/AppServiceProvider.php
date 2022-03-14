<?php

namespace App\Providers;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
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
        Builder::macro('toCsv', function() {
            $data = $this->get();

            $header = collect($data->first())->keys()->join(',');
            $values = $data->mapInto(Collection::class)->map->values()->map->join(",")->join("\n");

            return "$header\n$values";
        });
    }
}
