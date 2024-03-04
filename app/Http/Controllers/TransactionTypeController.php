<?php

namespace App\Http\Controllers;

use App\Models\TransactionType;
use Illuminate\Http\Request;

class TransactionTypeController extends Controller
{
    public function index()
    {
        $transactionType = TransactionType::all();
        return view('TransactionType.index', compact('transactionType'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('TransactionType.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        $transactionType = TransactionType::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);
        return redirect()->route('transactiontype.index')->with('success', 'Transaction type created successfully.');
    }

    public function show(TransactionType $transactionType)
    {
        //
    }

    public function edit(TransactionType $transactionType, $id)
    {
        $transactionType = TransactionType::findOrFail($id);
        return view('TransactionType.edit', compact('transactionType'));
    }

    public function update(Request $request, TransactionType $transactionType, $id)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric',
        ]);

        $transactionType = TransactionType::findOrFail($id);

        $transactionType->name = $request->name ?? $transactionType->name;
        $transactionType->price = $request->price ?? $transactionType->price;
        $transactionType->save();
        return redirect()->route('transactiontype.index')->with('success', 'Transaction type updated successfully.');
    }

    public function destroy(TransactionType $transactionType, $id)
    {
        $transactionType = TransactionType::findOrFail($id);
        $transactionType->delete();
        return redirect()->route('transactiontype.index')->with('success', 'Transaction type deleted successfully.');
    }
}
