<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Support\Facades\Request;
use Spatie\SimpleExcel\SimpleExcelWriter;

class ExportCustomerController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        return response()->download(
            SimpleExcelWriter::streamDownload('customers-export.csv')
            ->addRows(
                Customer::query()
                ->filter(Request::get('search'))
                ->get()
                ->toArray()
            )
            ->toBrowser()
        );
    }
}
