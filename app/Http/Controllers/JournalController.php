<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use App\Models\Store;
use Illuminate\Http\Request;

class JournalController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Journal::class, 'journal');
    }

    public function index(Request $request, Store $store)
    {
        $this->authorize('view', $store);

        return $store->journal()->paginate();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Journal $journal)
    {
        return $journal;
    }

    public function edit(Journal $journal)
    {
        //
    }

    public function update(Request $request, Journal $journal)
    {
        //
    }

    public function destroy(Journal $journal)
    {
        //
    }
}
