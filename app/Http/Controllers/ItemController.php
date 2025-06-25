<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function index()
    {
        try {
            $items = Item::latest()->get();
            return view('items.index', compact('items'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data barang: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'qty' => 'required|numeric|min:0',
            'status' => 'required|in:available,unavailable'
        ]);

        DB::beginTransaction();

        try {
            Item::create($validated);

            DB::commit();

            return redirect()->back()->with('success', 'Berhasil menambahkan barang');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan barang: ' . $e->getMessage());
        }
    }

    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'qty' => 'required|numeric|min:0',
            'status' => 'required|in:available,unavailable'
        ]);

        DB::beginTransaction();

        try {
            $item->update($validated);

            DB::commit();

            return redirect()->route('items.index')
                ->with('success', 'Berhasil memperbarui barang');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui barang: ' . $e->getMessage());
        }
    }

    public function destroy(Item $item)
    {
        DB::beginTransaction();

        try {
            $item->delete();

            DB::commit();

            return redirect()->route('items.index')->with('success', 'Berhasil menghapus barang');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Gagal menghapus barang: ' . $e->getMessage());
        }
    }
}
