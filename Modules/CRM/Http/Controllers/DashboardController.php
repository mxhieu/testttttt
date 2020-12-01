<?php

namespace Modules\CRM\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Modules\Config\Helpers\Business;
use Modules\CRM\Entities\Config\CrmConfigChannel;
use Modules\CRM\Entities\Config\CrmConfigCustomerKind;
use Modules\CRM\Entities\Config\CrmConfigSaleKind;
use Modules\CRM\Entities\CrmActivity;
use Modules\CRM\Entities\CrmCustomer;
use Modules\CRM\Entities\CrmSale;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $thisMonth = now()->startOfMonth();

        $customers = CrmCustomer::get(['name', 'kind_id', 'channel_id']);
        $totalCustomer = $customers->count();

        $channels = CrmConfigChannel::all(['name', 'id', 'color']);
        $channelLabels = $channels->pluck('name')->toArray();
        $channelColors = $channels->pluck('color')->toArray();
        $channelCustomer = $this->getCountCustomer($channels, $customers);

        $kinds = CrmConfigCustomerKind::all(['name', 'id', 'color']);
        $kindLabels = $kinds->pluck('name')->toArray();
        $kindColors = $kinds->pluck('color')->toArray();
        $kindCustomer = $this->getKindCustomerData($kinds, $customers, 'kind_id');

        $customerInMonth = $this->getCustomerInMonth($thisMonth);
        $activityInMonth = $this->getActivityInMonth($thisMonth);

        $revenues = collect($this->revenueAmount());
        $revenuesMonth = $revenues->pluck('month')->toArray();
        $revenuesAmount = $revenues->pluck('amount')->toArray();

        $debts = collect($this->debtAmount());
        $debtsMonth = $debts->pluck('month')->toArray();
        $debtsAmount = $debts->pluck('amount')->toArray();

        $sales = CrmSale::with('customer')->get(['name', 'customer_id', 'kind_id']);
        $totalSale = $sales->count();
        $kindSales = CrmConfigSaleKind::all(['name', 'id', 'color']);
        $kindSaleLabels = $kindSales->pluck('name')->toArray();
        $kindSaleColors = $kindSales->pluck('color')->toArray();
        $kindSaleTotal = $this->getCountSale($kindSales, $sales);
        $kindSaleData = $this->getSaleData($kindSales, $sales);

        return view('crm::dashboard', compact('totalCustomer', 'channelLabels', 'channelCustomer', 'channelColors', 'kindLabels', 'kindColors', 'kindCustomer', 'customerInMonth', 'activityInMonth', 'revenues', 'revenuesAmount', 'revenuesMonth', 'debtsMonth', 'debtsAmount', 'totalSale', 'kindSaleLabels', 'kindSaleColors', 'kindSaleTotal', 'kindSaleData'));
    }

    /**
     * @param $configs
     * @param Collection $customers
     * @param string $key
     * @return array
     */
    private function getCountCustomer(
        $configs,
        Collection $customers,
        $key = 'channel_id'
    )
    {
        $result = [];
        foreach ($configs as $item) {
            $total = $customers->where($key, $item->id)->count();
            $result[] = $total;
        }
        return $result;
    }

    /**
     * @param $configs
     * @param Collection $sales
     * @param string $key
     * @return array
     */
    private function getCountSale(
        $configs,
        Collection $sales,
        $key = 'kind_id'
    )
    {
        $result = [];
        foreach ($configs as $item) {
            $total = $sales->where($key, $item->id)->count();
            $result[] = $total;
        }
        return $result;
    }

    /**
     * @param $configs
     * @param Collection $sales
     * @param string $key
     * @return array
     */
    private function getSaleData(
        $configs,
        Collection $sales,
        $key = 'kind_id'
    )
    {
        $result = [];
        foreach ($configs as $item) {
            $total = $sales->where($key, $item->id)->count();
            $result[] = ['value' => $total, 'name' => $item->name];
        }
        return $result;
    }

    /**
     * @param $configs
     * @param Collection $customers
     * @param string $key
     * @return array
     */
    private function getKindCustomerData(
        $configs,
        Collection $customers,
        $key = 'kind_id'
    )
    {
        $result = [];
        foreach ($configs as $item) {
            $total = $customers->where($key, $item->id)->count();
            $result[] = ['value' => $total, 'name' => $item->name];
        }
        return $result;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    private function getCustomerInMonth($thisMonth)
    {
        return CrmCustomer::with('kind', 'channel', 'type', 'group')
            ->whereDate('find_at', '>=', $thisMonth)
            ->get();
    }

    /**
     * @param $thisMonth
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    private function getActivityInMonth($thisMonth)
    {
        $startMonth = now()->startOfMonth();
        $endMonth = now()->endOfMonth();
        return CrmActivity::with('kind', 'status', 'type', 'group', 'customer')
            ->where(function($q) use ($startMonth, $endMonth) {
                $q->whereBetween('start_at',[$startMonth, $endMonth])
                    ->whereBetween('end_at', [$startMonth, $endMonth]);
            })
            ->get();
    }

    /**
     * @return array
     */
    private function revenueAmount()
    {
        $lastSixMonthNumber = now()->subMonths(6)->format('Y-m');
        $nextMonthNumber = now()->addMonth()->format('Y-m');

        $sql = "
            SELECT
            SUM( money ) as amount,
            DATE_FORMAT( date, '%Y-%m' ) AS dateUnit 
        FROM
            crm_payments 
        WHERE
            status_id = ? 
            AND DATE_FORMAT( date, '%Y-%m' ) >= ?
            AND DATE_FORMAT( date, '%Y-%m' ) < ?
        GROUP BY
            DATE_FORMAT( date, '%Y-%m' )
        ";
        $result = DB::select($sql, [Business::STATUS_SUCCESS_ID, $lastSixMonthNumber, $nextMonthNumber]);

        $revenues = [];
        foreach ($result as $k => $item) {
            $revenues[] = [
                'color' => $this->getDefaultColor($k),
                'amount' => $item->amount,
                'month' => $item->dateUnit
            ];
        }
        return $revenues;
    }

    /**
     * @return array
     */
    private function debtAmount()
    {
        $lastSixMonthNumber = now()->subMonths(6)->format('Y-m');
        $nextMonthNumber = now()->addMonth()->format('Y-m');

        $sql = "
            SELECT
            SUM( money ) as amount,
            DATE_FORMAT( date, '%Y-%m' ) AS dateUnit 
        FROM
            crm_payments 
        WHERE
            status_id <> ? 
            AND DATE_FORMAT( date, '%Y-%m' ) >= ?
            AND DATE_FORMAT( date, '%Y-%m' ) < ?
        GROUP BY
            DATE_FORMAT( date, '%Y-%m' )
        ";
        $result = DB::select($sql, [Business::STATUS_SUCCESS_ID, $lastSixMonthNumber, $nextMonthNumber]);

        $debts = [];
        foreach ($result as $k => $item) {
            $debts[] = [
                'color' => $this->getDefaultColor($k),
                'amount' => $item->amount,
                'month' => $item->dateUnit
            ];
        }
        return $debts;
    }

    /**
     * @param $stt
     * @return string
     */
    private function getDefaultColor($stt)
    {
        switch ($stt) {
            case 1:
                return '#12f1f0';
            case 2:
                return '#eb0105';
            case 3:
                return '#80a708';
            case 4:
                return '#15f4f0';
            case 5:
                return '#eb0505';
            case 0:
                return '#10f708';
        }
    }
}
