<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PeriodCut\FilterCutRequest;
use App\Models\Agreement;
use App\Models\Headquarter;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\PaymentMade;
use App\Models\PaymentReceived;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PeriodCutController extends Controller
{
    public function index(FilterCutRequest $request)
    {
        $data = [];
        $agreements = Agreement::all()->pluck('name', 'id');
        $headquarters = Headquarter::all()->pluck('name', 'id');

        $summary = [
            'payments' => Payment::query(),
            'invoices' => Invoice::query(),
            'payments_made' => PaymentMade::query(),
            'payments_received' => PaymentReceived::query()
        ];


        foreach ($summary as $key => $entity) {
            if($request->filled('filters')){
                $filters = $request->filters;

                if (isset($filters['start_date'])) {
                    $entity->where('created_at', '>=', $filters['start_date']);
                }

                if (isset($filters['end_date'])) {
                    $entity->where('created_at', '<=', $filters['end_date']);
                }

                if (isset($filters['headquarter_id'])) {
                    $entity->where('headquarter_id', $filters['headquarter_id']);
                }

                if (isset($filters['agreement_id'])) {
                    $entity->where('agreement_id', $filters['agreement_id']);
                }
            }


            $summary[$key] =  $entity->get();
        }




        foreach ($summary as $key => $item) {
            foreach ($item as $entity) {
                $keyTemp = $entity->agreement_id . '_' . $entity->headquarter_id;

                if (!isset($data[$keyTemp])) {
                    $keysMap = array_map(fn($item) => $item = 0, $summary);
                    $data[$keyTemp] = array_merge([
                        'agreement' => $agreements[$entity->agreement_id],
                        'headquarter' => $headquarters[$entity->headquarter_id],
                    ], $keysMap);
                }

                $data[$keyTemp][$key] += $entity->value;
            }
        }

        return DataTables::of(collect($data))->make(true);
    }
}
