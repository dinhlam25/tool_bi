<?php

namespace App\Providers;

use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class DataBaseQueryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        if (config('logging.enable_sql_log') === true) {
            DB::listen(function ($query) {
                $sql = $this->bindingSql($query);
                Log::info('SQL', ['time' => "$query->time ms", 'sql' => $sql]);
            });
        }
    }

    private function bindingSql($query): string
    {
        $sql = $query->sql;
        try {
            foreach ($query->bindings as $binding) {
                if (is_string($binding)) {
                    $binding = "'{$binding}'";
                } elseif ($binding === null) {
                    $binding = 'NULL';
                } elseif ($binding instanceof Carbon) {
                    $binding = "'{$binding->toDateTimeString()}'";
                } elseif ($binding instanceof DateTime) {
                    $binding = "'{$binding->format('Y-m-d H:i:s')}'";
                }

                $sql = preg_replace("/\?/", $binding, $sql, 1);
            }
        } catch (\Exception $e) {
            Log::error("ERROR bindingSql: " . $e->getMessage());
        }
        return $sql;
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
