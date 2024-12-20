<?php

namespace App\Console\Commands;

use App\Models\TblBiSupplierMonthlyOrders;
use App\Models\TblBiSupplierMonthlySales;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class AggregateMonthlyOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:aggregate-monthly-orders {pastMonths?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Aggregate information about supplier orders/sales on a monthly basis.';

    const BATCH_SIZE = 10000;
    const KAISOU_BUNRUI_COLS = ['code1', 'code2', 'code3', 'code4', 'code5'];

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Log::info("BEGIN - Aggregate Monthly Orders/Sales");
        $this->info("BEGIN - Aggregate Monthly Orders/Sales");

        $subMonths = 2; // default to aggregate the last 2 months

        $subMonthsParam = $this->argument('pastMonths');
        if (isset($subMonthsParam) && is_numeric($subMonthsParam) && $subMonthsParam > 0) {
            $subMonths = $subMonthsParam;
        }
        $yesterday = now()->subDays(1);
        $aggregateMonth = $yesterday->copy();
        $startDate = $yesterday->copy();
        // Aggregate Child Bunrui data
        for ($i = 0; $i <= $subMonths; $i++) {
            $aggregateMonth = $aggregateMonth->subMonths(1);
            $startDate = $aggregateMonth->copy()->startOfMonth();
            $endDate = $aggregateMonth->copy()->endOfMonth();
            $endDate = min($endDate, $yesterday);

            $strStart = $startDate->format('Y-m-d');
            $strEnd = $endDate->format('Y-m-d');
            Log::debug("Aggregate child bunrui monthly orders data: $strStart - $strEnd");
            $this->aggregateOrdersChildBunrui($strStart, $strEnd);
            Log::debug("Aggregate child bunrui monthly sales data: $strStart - $strEnd");
            $this->aggregateSalesChildBunrui($strStart, $strEnd);

            // Aggregate Webike data
            Log::debug("Aggregate Webike monthly orders data: $strStart - $strEnd");
            $this->aggregateOrdersWebike($strStart, $strEnd);
            Log::debug("Aggregate Webike monthly sales data: $strStart - $strEnd");
            $this->aggregateSalesWebike($strStart, $strEnd);
        }
        $startMonth = $startDate->format('Ym');
        $endMonth = $yesterday->format('Ym');

        // Aggregate oya bunrui data
        Log::debug("Aggregate oya bunrui monthly orders data: $startMonth - $endMonth");
        $this->aggregateOrdersKaisouBunruis($startMonth, $endMonth);
        Log::debug("Aggregate oya bunrui monthly sales data: $startMonth - $endMonth");
        $this->aggregateSalesKaisouBunruis($startMonth, $endMonth);

        Log::info("END   - Aggregate Monthly Orders/Sales");
        $this->info("END   - Aggregate Monthly Orders/Sales");
    }

    private function aggregateOrdersChildBunrui($startDate, $endDate): void
    {
        $batchSize = self::BATCH_SIZE;
        $offset = 0;
        do {
            $affectedRows = TblBiSupplierMonthlyOrders::aggregateMonthlySupplier($startDate, $endDate, $batchSize, $offset);
            $offset += $batchSize;
        } while ($affectedRows > 0);
    }

    private function aggregateSalesChildBunrui($startDate, $endDate): void
    {
        $batchSize = self::BATCH_SIZE;
        $offset = 0;
        do {
            $affectedRows = TblBiSupplierMonthlySales::aggregateMonthlySupplier($startDate, $endDate, $batchSize, $offset);
            $offset += $batchSize;
        } while ($affectedRows > 0);
    }

    private function aggregateOrdersWebike($startDate, $endDate): void
    {
        $batchSize = self::BATCH_SIZE;
        $offset = 0;
        do {
            $affectedRows = TblBiSupplierMonthlyOrders::aggregateMonthlyWebike($startDate, $endDate, $batchSize, $offset);
            $offset += $batchSize;
        } while ($affectedRows > 0);
    }

    private function aggregateSalesWebike($startDate, $endDate): void
    {
        $batchSize = self::BATCH_SIZE;
        $offset = 0;
        do {
            $affectedRows = TblBiSupplierMonthlySales::aggregateMonthlyWebike($startDate, $endDate, $batchSize, $offset);
            $offset += $batchSize;
        } while ($affectedRows > 0);
    }

    private function aggregateOrdersKaisouBunruis($startMonth, $endMonth): void
    {

        foreach (self::KAISOU_BUNRUI_COLS as $oyaBunruiCol) {
            $this->aggregateOrdersEachKaisouBunrui($oyaBunruiCol, $startMonth, $endMonth);
        }
    }

    private function aggregateOrdersEachKaisouBunrui($kaisouBunruiCol, $startMonth, $endMonth): void
    {
        $batchSize = self::BATCH_SIZE;
        $offset = 0;
        do {
            $affectedRows = TblBiSupplierMonthlyOrders::aggregateOyaBunrui($kaisouBunruiCol, $startMonth, $endMonth, $batchSize, $offset);
            $offset += $batchSize;
        } while ($affectedRows > 0);
    }

    private function aggregateSalesKaisouBunruis($startMonth, $endMonth): void
    {
        foreach (self::KAISOU_BUNRUI_COLS as $oyaBunruiCol) {
            $this->aggregateSalesEachKaisouBunrui($oyaBunruiCol, $startMonth, $endMonth);
        }
    }

    private function aggregateSalesEachKaisouBunrui($oyaBunruiCol, $startMonth, $endMonth): void
    {
        $batchSize = self::BATCH_SIZE;
        $offset = 0;
        do {
            $affectedRows = TblBiSupplierMonthlySales::aggregateOyaBunrui($oyaBunruiCol, $startMonth, $endMonth, $batchSize, $offset);
            $offset += $batchSize;
        } while ($affectedRows > 0);
    }
}
