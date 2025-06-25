<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemLoan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ItemLoanController extends Controller
{
    public function index()
    {
        try {
            $itemLoans = ItemLoan::latest()->get();
            return view('item-loans.index', compact('itemLoans'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data peminjaman: ' . $e->getMessage());
        }
    }

    public function create()
    {
        $items = Item::where('status', 'available')->oldest('name')->get();
        $users = User::oldest('name')->get();
        return view('item-loans.create', compact('items', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'item_id' => 'required|exists:items,id',
            'qty' => 'required|integer|min:1',
            'loan_date' => 'required|date'
        ]);

        DB::beginTransaction();

        try {
            $item = Item::findOrFail($request->item_id);

            if ($validated['qty'] > $item->qty) {
                throw new \Exception("Stok tidak mencukupi. Stok tersedia: {$item->qty}");
            }

            if ($item->status != 'available') {
                throw new \Exception("Barang tidak tersedia untuk dipinjam (Status: {$item->status})");
            }

            ItemLoan::create($validated);

            $item->decrement('qty', $validated['qty']);

            DB::commit();

            return redirect()->back()->with('success', 'Berhasil menambahkan peminjaman');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan peminjaman: ' . $e->getMessage());
        }
    }

    public function edit(ItemLoan $itemLoan)
    {
        $items = Item::where('status', 'available')->oldest('name')->get();
        $users = User::oldest('name')->get();
        return view('item-loans.edit', compact('itemLoan', 'items', 'users'));
    }

    public function update(Request $request, ItemLoan $itemLoan)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'item_id' => 'required',
            'qty' => 'required|numeric|min:0',
            'loan_date' => 'required'
        ]);

        DB::beginTransaction();

        try {
            $item = Item::where('id', $validated['item_id'])->firstOrFail();
            $item->increment('qty', $itemLoan->qty);

            if ($validated['qty'] > $item->qty) {
                throw new \Exception(
                    "Stok tidak mencukupi. " .
                        "Memerlukan: {$validated['qty']}, Stok tersedia: {$item->qty}"
                );
            }

            $item->decrement('qty', $validated['qty']);

            $itemLoan->update($validated);

            DB::commit();

            return redirect()->route('item-loans.index')
                ->with('success', 'Berhasil memperbarui peminjaman');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui peminjaman: ' . $e->getMessage());
        }
    }

    public function destroy(ItemLoan $itemLoan)
    {
        DB::beginTransaction();

        try {
            $item = Item::findOrFail($itemLoan->item_id);
            $item->increment('qty', $itemLoan->qty);

            $itemLoan->delete();

            DB::commit();

            return redirect()->route('item-loans.index')->with('success', 'Berhasil menghapus peminjaman');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus peminjaman: ' . $e->getMessage());
        }
    }
}
