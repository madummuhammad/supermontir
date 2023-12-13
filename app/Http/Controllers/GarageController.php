<?php

namespace App\Http\Controllers;

use App\Models\Garage;
use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GarageController extends Controller
{
    public function index()
    {
        return Inertia::render('Garage/Index');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'merk' => 'required',
            'type' => 'required',
            'plat' => 'required',
            'year' => 'required',
            'km' => 'required',
            'vehicle_type' => 'required',
        ]);

        $validatedData['user_id'] = auth()->user()->id;

        Garage::create($validatedData);

        return back()->with('message', ['status' => 'success', 'message' => 'Success! Data berhasil di tambah']);

    }
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'merk' => 'required',
            'type' => 'required',
            'plat' => 'required',
            'year' => 'required',
            'km' => 'required',
            'vehicle_type' => 'required',
        ]);

        $validatedData['user_id'] = auth()->user()->id;

        Garage::where('id', $request->id)->update($validatedData);

        return back()->with('message', ['status' => 'success', 'message' => 'Success! Data berhasil di ubah']);

    }

    public function show($id)
    {
        $garage = Garage::where('id', $id)->first();
        return Inertia::render('Garage/Show', [
            'id' => $id,
            'garage' => $garage,
        ]);
    }

    public function detail(Request $request, $id)
    {
        $status = $request->status;

        $order = Order::where('status', $status)->where('garage_id', $id)->with('item_order.product', 'garage')->get();

        return response()->json(['status' => 'success', 'data' => $order]);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        Garage::where('id', $id)->delete();
        return back()->with('message', ['status' => 'success', 'message' => 'Success! Data berhasil di hapus']);
    }

    public function get()
    {
        $garage = Garage::where('user_id', auth()->user()->id)->get();
        return response()->json(['status' => 'success', 'data' => $garage]);
    }
}
