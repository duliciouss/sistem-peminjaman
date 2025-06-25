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

    public function edit($id)
    {
        $item = Item::find($id);
        return view('items.edit', compact('item'));
    }

    public function destroy($id)
    {
        $item = Item::find($id);
        $item->delete();
        return redirect()->back();
    }
}
