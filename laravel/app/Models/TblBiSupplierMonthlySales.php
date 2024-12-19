<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TblBiSupplierMonthlySales extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'tbl_bi_supplier_monthly_sales';
    public $timestamps = false;

    protected $fillable = [
        'siire_code',
        'bunrui_code',
        'brand_code',
        'year_month',
        'sales_amount',
        'sales_quantity',
        'created_at',
        'created_user_id',
        'updated_at',
        'updated_user_id',
    ];

    /**
     * Insert or Update monthly order data for each supplier.
     */
    public static function aggregateMonthlySupplier($startDate, $endDate, $limit = 0, $offset = 0): int
    {
        $sql = "INSERT INTO tbl_bi_supplier_monthly_sales (siire_code, bunrui_code, brand_code, `year_month`, sales_amount,
                                             sales_quantity, created_at, created_user_id, updated_at, updated_user_id)
                SELECT siire_code          AS siire_code,
                       bunrui_code         AS bunrui_code,
                       0                   AS brand_code,
                       a.year_month        AS `year_month`,
                       SUM(sales_amount)   AS sales_amount,
                       SUM(sales_quantity) AS sales_quantity,
                       NOW()               AS created_at,
                       'admin'             AS created_user_id,
                       NOW()               AS updated_at,
                       'admin'             AS updated_user_id
                FROM (SELECT DISTINCT meisai.meisai_scm_code,
                                      COALESCE(link.bi_siire_code, zaiko_syouhin.syouhin_siire_code, meisai.siire_code) AS siire_code,
                                      syouhin.bunrui_code,
                                      syouhin.brand_code,
                                      DATE_FORMAT(tyumon.nouhin_date_value, '%Y%m')                                     AS `year_month`,
                                      meisai.hanbai_price                                                               AS sales_amount,
                                      meisai.hanbai_number                                                              AS sales_quantity
                      FROM qlk_tyumon AS tyumon
                               JOIN qlk_meisai AS meisai ON tyumon.tyumon_code = meisai.tyumon_code
                               JOIN qlk_syouhin AS syouhin ON meisai.syouhin_sys_code = syouhin.syouhin_sys_code
                               LEFT JOIN rc_bi.tbl_zaiko zaiko ON meisai.meisai_scm_code = zaiko.hikiate_scm_code
                               LEFT JOIN rc_bi.mst_zaiko_syouhin zaiko_syouhin ON zaiko.hatyuu_scm_code = zaiko_syouhin.hatyuu_scm_code
                               LEFT JOIN tbl_siire_linking AS link
                                   ON link.siire_code = COALESCE(zaiko_syouhin.syouhin_siire_code, meisai.siire_code)
                               JOIN mst_bi_siireuser AS siire
                                   ON siire.siire_code = COALESCE(link.bi_siire_code, zaiko_syouhin.syouhin_siire_code, meisai.siire_code)
                      WHERE tyumon.nouhin_date_value BETWEEN ? AND ?
                        AND tyumon.tyumon_status_code NOT IN ('61', '62', '63', '70', '80', '81', '90')
                        AND tyumon.kessai_code NOT IN ('60', '41')) AS a
                GROUP BY siire_code, bunrui_code, `year_month` ";
        $bindParams = [$startDate, $endDate];
        if ($limit > 0) {
            $sql .= "
                    LIMIT ? OFFSET ? ";
            $bindParams[] = $limit;
            $bindParams[] = $offset;
        }
        $sql .= "
                ON DUPLICATE KEY UPDATE
                    sales_amount = VALUES(sales_amount),
                    sales_quantity = VALUES(sales_quantity),
                    updated_at = NOW(),
                    updated_user_id = 'admin'";
        return DB::affectingStatement($sql, $bindParams);
    }

    /**
     * Insert or Update monthly order data for Webike.
     */
    public static function aggregateMonthlyWebike($startDate, $endDate, $limit = 0, $offset = 0): int
    {
        $sql = "INSERT INTO tbl_bi_supplier_monthly_sales (siire_code, bunrui_code, brand_code, `year_month`, sales_amount,
                                             sales_quantity, created_at, created_user_id, updated_at, updated_user_id)
                SELECT 'all'                                         AS siire_code,
                       syouhin.bunrui_code                           AS bunrui_code,
                       0                                             AS brand_code,
                       DATE_FORMAT(tyumon.nouhin_date_value, '%Y%m') AS `year_month`,
                       SUM(meisai.hanbai_price)                      AS sales_amount,
                       SUM(meisai.hanbai_number)                     AS sales_quantity,
                       NOW()                                         AS created_at,
                       'admin'                                       AS created_user_id,
                       NOW()                                         AS updated_at,
                       'admin'                                       AS updated_user_id
                FROM qlk_tyumon AS tyumon
                         JOIN qlk_meisai AS meisai ON tyumon.tyumon_code = meisai.tyumon_code
                         JOIN qlk_syouhin AS syouhin ON meisai.syouhin_sys_code = syouhin.syouhin_sys_code
                WHERE tyumon.nouhin_date_value BETWEEN ? AND ?
                  AND tyumon.tyumon_status_code NOT IN ('61', '62', '63', '70', '80', '81', '90')
                  AND tyumon.kessai_code NOT IN ('60', '41')
                GROUP BY syouhin.bunrui_code, DATE_FORMAT(tyumon.nouhin_date_value, '%Y%m')";
        $bindParams = [$startDate, $endDate];
        if ($limit > 0) {
            $sql .= "
                    LIMIT ? OFFSET ? ";
            $bindParams[] = $limit;
            $bindParams[] = $offset;
        }
        $sql .= "
                ON DUPLICATE KEY UPDATE
                    sales_amount = VALUES(sales_amount),
                    sales_quantity = VALUES(sales_quantity),
                    updated_at = NOW(),
                    updated_user_id = 'admin'";
        return DB::affectingStatement($sql, $bindParams);
    }

    public static function aggregateOyaBunrui($oyaBunruiCol, $startMonth, $endMonth, $limit = 0, $offset = 0): int
    {
        $kaisouBunruiCols = ['code1', 'code2', 'code3', 'code4', 'code5'];
        if (!in_array($oyaBunruiCol, $kaisouBunruiCols)) {
            return 0;
        }
        $sql = "INSERT INTO tbl_bi_supplier_monthly_sales (siire_code, bunrui_code, brand_code, `year_month`, sales_amount,
                                             sales_quantity, created_at, created_user_id, updated_at, updated_user_id)
                SELECT c.siire_code          AS siire_code,
                       c.oya_bunrui          AS bunrui_code,
                       0                     AS brand_code,
                       c.year_month          AS `year_month`,
                       SUM(c.sales_amount)   AS sales_amount,
                       SUM(c.sales_quantity) AS sales_quantity,
                       NOW()                 AS created_at,
                       'admin'               AS created_user_id,
                       NOW()                 AS updated_at,
                       'admin'               AS updated_user_id
                FROM (SELECT a.siire_code,
                             a.bunrui_code,
                             b.$oyaBunruiCol AS oya_bunrui,
                             a.year_month,
                             a.sales_amount,
                             a.sales_quantity
                      FROM tbl_bi_supplier_monthly_sales AS a
                               JOIN mst_bunrui_search AS b ON a.bunrui_code = b.last_kaisou_bunrui_code
                                                          AND $oyaBunruiCol != a.bunrui_code AND $oyaBunruiCol != ''
                      WHERE a.year_month BETWEEN ? AND ?
                      GROUP BY a.siire_code, a.bunrui_code, b.$oyaBunruiCol, a.year_month, a.sales_amount, a.sales_quantity) AS c
                GROUP BY c.siire_code, c.oya_bunrui, c.year_month ";
        $bindParams = [$startMonth, $endMonth];
        if ($limit > 0) {
            $sql .= "
                    LIMIT ? OFFSET ? ";
            $bindParams[] = $limit;
            $bindParams[] = $offset;
        }
        $sql .= "
                ON DUPLICATE KEY UPDATE
                    sales_amount = VALUES(sales_amount),
                    sales_quantity = VALUES(sales_quantity),
                    updated_at = NOW(),
                    updated_user_id = 'admin'";
        return DB::affectingStatement($sql, $bindParams);
    }
}
