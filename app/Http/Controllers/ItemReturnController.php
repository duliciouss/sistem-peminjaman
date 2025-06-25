<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemLoan;
use App\Models\ItemReturn;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ItemReturnController extends Controller
{
    public function index()
    {
        try {
            $itemLoans = ItemLoan::latest()->get();
            return view('item-returns.index', compact('itemLoans'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data pengembalian: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $itemLoan = ItemLoan::findOrFail($request->id);
            ItemReturn::create([
                'loan_id' => $itemLoan->id,
                'qty' => $itemLoan->qty,
                'return_date' => now()
            ]);

            $item = Item::findOrFail($itemLoan->item_id);
            $item->increment('qty', $itemLoan->qty);

            DB::commit();

            return redirect()->back()->with('success', 'Berhasil mengembalikan barang');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal mengembalikan barang: ' . $e->getMessage());
        }
    }

    public function destroy(ItemReturn $itemReturn)
    {
        DB::beginTransaction();

        try {
            $item = Item::findOrFail($itemReturn->loan->item_id);
            $item->decrement('qty', $itemReturn->qty);

            $itemReturn->delete();

            DB::commit();

            return redirect()->route('item-returns.index')->with('success', 'Berhasil menghapus pengembalian');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus pengembalian: ' . $e->getMessage());
        }
    }
}
