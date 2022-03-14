<?php

namespace App\Http\Controllers;

use App\Jobs\StoreDataExportJob;
use App\Models\Journal;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class StoreDataExportController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request, Store $store)
    {
        $request->validate([
            'email'           => 'required|email',
            'interval' => [
                'required', 'string',
                Rule::in(Journal::intervals()->keys())
            ],
        ]);

        StoreDataExportJob::dispatch($store, $request->email, $request->interval);

        return response([
            'message' => "Your Export is on it's way."
        ]);
    }
}
