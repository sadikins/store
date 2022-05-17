<?php

namespace App\Http\Controllers\Apps;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Profit;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function index()
    {
        $day = Carbon::now();
        // Sales Report
        $sales_report = Transaction::with('cashier', 'customer')
        ->where('created_at', '<', Carbon::now())
        ->latest()
        ->limit(10)
        ->get();

        
       


        return Inertia::render('Apps/Report/Sales',[
            'sales_report' => $sales_report,
        ]);


    }
    
    /**
     * filter
     *
     * @param  mixed $request
     * @return void
     */
    public function filter(Request $request)
    {
        $this->validate($request, [
            'start_date'  => 'required',
            'end_date'    => 'required',
        ]);

        //get data sales by range date
        $sales = Transaction::with('cashier', 'customer')
            ->whereDate('created_at', '>=', $request->start_date)
            ->whereDate('created_at', '<=', $request->end_date)
            ->get();

        //get total sales by range date    
        $total = Transaction::whereDate('created_at', '>=', $request->start_date)
            ->whereDate('created_at', '<=', $request->end_date)
            ->sum('grand_total');
        
        return Inertia::render('Apps/Report/Sales', [
            'sales'    => $sales,
            'total'    => (int) $total
        ]);
    }


    public function profit()
    {


       $profits_report = Profit::with('transaction')
            ->where('created_at', '<', Carbon::now())
            ->latest()
            ->limit(10)
            ->get();

        return Inertia::render('Apps/Report/Profits',[

            'profits_report' => $profits_report,
        ]);
    }
    
    /**
     * filter
     *
     * @param  mixed $request
     * @return void
     */
    public function profit_filter(Request $request)
    {
        $this->validate($request, [
            'start_date'  => 'required',
            'end_date'    => 'required',
        ]);

        //get data profits by range date
        $profits = Profit::with('transaction')->whereDate('created_at', '>=', $request->start_date)->whereDate('created_at', '<=', $request->end_date)->get();

        //get total profit by range date    
        $total = Profit::whereDate('created_at', '>=', $request->start_date)->whereDate('created_at', '<=', $request->end_date)->sum('total');
        
        return Inertia::render('Apps/Report/Profits', [
            'profits'   => $profits,
            'total'     => (int) $total
        ]);
    }
}
