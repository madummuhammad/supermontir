<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Inertia\Inertia;

class NotificationController extends Controller
{
    public function index()
    {
        return Inertia::render('Notification/Index');
    }

    public function list()
    {
        $notification = Notification::where('user_id', auth()->user()->id)->get();
        return response()->json(['status' => 'success', 'data' => $notification]);
    }

    public function read($id)
    {
        Notification::where('id', $id)->update([
            'is_read' => 1,
        ]);
        return response()->json(['status' => 'success', 'message' => 'Notifikasi berhasil dibaca']);
    }
    public function destroy($id)
    {
        Notification::where('id', $id)->delete();
        return response()->json(['status' => 'success', 'message' => 'Notifikasi berhasil dihapus']);
    }
}
