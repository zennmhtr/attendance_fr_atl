<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 

 class NotificationController extends Controller
{

    public function index()
    {
        $filter = request()->input('filter','');
        $title = 'Notifikasi';

        $inboxs = auth()->user()->notifications()
                        ->when($filter == 'read', fn($query)=>$query->whereNotNull('read_at'))
                        ->when($filter == 'unread', fn($query)=>$query->whereNull('read_at'))
                        ->paginate(10)
                        ->withQueryString();

        if (auth()->user()->is_admin == 'admin') {
            return view('notifications.indexAdmin', compact(
                'inboxs',
                'title'
            ));
        } else {
            return view('notifications.index', compact(
                'inboxs',
                'title'
            ));
        }
    }

    public function read()
    {
        $filter = request()->input('filter','');
        $title = 'Notifications';

        $inboxs = auth()->user()->notifications()
                        ->whereNotNull('read_at')
                        ->paginate(10)
                        ->withQueryString();

        return view('notifications.indexAdmin', compact(
            'inboxs',
            'title'
        ));
    }

    public function unread()
    {
        $filter = request()->input('filter','');
        $title = 'Notifications';

        $inboxs = auth()->user()->notifications()
                        ->whereNull('read_at')
                        ->paginate(10)
                        ->withQueryString();

        return view('notifications.indexAdmin', compact(
            'inboxs',
            'title'
        ));
    }

    public function readMessage($id)
    {
        $notifikasi = auth()->user()->notifications()
                        ->where('id', $id)
                        ->whereNull('read_at')
                        ->first();

    if ($notifikasi) {
        $notifikasi->markAsRead();
        return redirect($notifikasi->data["action"]);
    }

    return redirect()->back()->with('error', 'Notifikasi tidak ditemukan atau sudah dibaca.');

    }
}