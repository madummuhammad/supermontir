<?php

namespace App\Http\Controllers;

use App\Models\Kupon;
use App\Models\UserKupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class KuponController extends Controller
{
    public function index()
    {
        return Inertia::render('Kupon/Index');
    }

    public function list(Request $request)
    {
        $status = $request->status;

        $kupon = UserKupon::where('status', $status)->where('user_id', auth()->user()->id)->with('kupon')->get();

        foreach ($kupon as $key => $value) {
            if ($value->kupon->expired_at && Carbon::now()->gt($value->kupon->expired_at)) {
                // return $value;
                if ($value->status == 'unused') {
                    $value->update(['status' => 'expired']);
                }
            }
        }

        return response()->json(['status' => 'success', 'data' => $kupon]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
        ]);

        $now = Carbon::now();

        $kupon = Kupon::where('code', $request->code)
            ->where('expired_at', '>', $now)
            ->first();

        if ($kupon === null) {
            $validator->errors()->add(
                'code',
                'Kupon tidak ditemukan atau sudah kedaluwarsa!'
            );
            throw new ValidationException($validator);
        }

        $kuponCheck = UserKupon::where('user_id', auth()->user()->id)->where('kupon_id', $kupon->id)->first();
        if ($kuponCheck !== null) {
            $validator->errors()->add(
                'code',
                'Kupon sudah anda masukan!'
            );
            throw new ValidationException($validator);

        }

        UserKupon::create([
            'kupon_id' => $kupon->id,
            'user_id' => auth()->user()->id,
            'status' => 'unused',
        ]);

        return back();
    }

}
