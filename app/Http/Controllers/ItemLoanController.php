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
            'user_id' => 'required',
            'item_id' => 'required',
            'qty' => 'required|numeric|min:0',
            'loan_date' => 'required'
        ]);

        // DB::beginTransaction();

        try {
            ItemLoan::create($validated);
            // DB::commit();

            return redirect()->back()->with('success', 'Berhasil menambahkan peminjaman');
        } catch (\Exception $e) {
            // DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan peminjaman: ' . $e->getMessage());
        }
    }

    public function edit(ItemLoan $itemLoan)
    {
        return view('item-loans.edit', compact('itemLoan'));
    }

    public function update(Request $request, ItemLoan $itemLoan)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'qty' => 'required|numeric|min:0',
            'status' => 'required|in:available,unavailable'
        ]);

        DB::beginTransaction();

        try {
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
