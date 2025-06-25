<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('items.index', compact('items'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'qty' => 'required|numeric',
            'status' => 'required'

        ]);
        Item::create([
            'name' => $request->name,
            'qty' => $request->qty,
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Berhasil create barang');
    }

    public function edit($id)
    {
        $item = Item::find($id);
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'qty' => 'required|numeric',
            'status' => 'required'
        ]);

        $item = Item::find($id);

        $item->update([
            'name' => $request->name,
            'qty' => $request->qty,
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Berhasil update barang');
    }

    public function destroy($id)
    {
        $item = Item::find($id);
        $item->delete();
        return redirect()->back();
    }
}
