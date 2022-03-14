<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JournalController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Journal::class, 'journal');
    }

    public function index(Request $request, Store $store)
    {
        $request->validate([
            'interval' => [
                Rule::in(Journal::intervals()->keys())
            ]
        ]);

        $this->authorize('view', $store);

        $query = $store->journal();

        if ($request->has('interval')) {
            $query->since($request->query('interval'));
        }

        return $query->paginate();
    }

//    public function create()
//    {
//        //
//    }
//
//    public function store(Request $request)
//    {
//        //
//    }

    public function show(Journal $journal)
    {
        return $journal;
    }

//    public function edit(Journal $journal)
//    {

//    }

//    public function update(Request $request, Journal $journal)
//    {

//    }

//    public function destroy(Journal $journal)
//    {
//        //
//    }
}
