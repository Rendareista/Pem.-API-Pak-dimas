<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user(); //mendapatkan user login
        // Filter data berdasarkan tanggal (jika ada)
        $mulai = $request->input('mulai_tanggal');
        $sampai = $request->input('sampai_tanggal');
        $pengeluarans = Pengeluaran::where('user_id', $user->id)
                        ->when($mulai, function ($query) use ($mulai) {
                            return $query->whereDate('tanggal_pengeluaran', '>=', $mulai);
                        })
                        ->when($sampai, function ($query) use ($sampai) {
                            return $query->whereDate('tanggal_pengeluaran', '<=', $sampai);
                        })
                        ->get();
        // $pemasukkans = Pemasukkan::where('user_id',$user->id)->get();
        // $totalIncome = Pemasukkan::where('user_id', $user->id)->sum('jumlah');
        $totaloutcome = $pengeluarans->sum('jumlah');
        return view('dashboard.pengeluaran.index', compact('pengeluarans', 'totaloutcome'));
    }

    // public function filter(Request $request)
    // {
    //     $mulai = $request->input('mulai_tanggal');
    //     $sampai = $request->input('sampai_tanggal');
    //     $totalPengeluaran = Pengeluaran::getTotalPengeluaranByDateRange($mulai, $sampai);

    //     $pengeluaran = Pengeluaran::whereBetween('tanggal_pengeluaran', [$mulai, $sampai])->get();
    //     return view('dashboard.pengeluaran.index', compact('pengeluaran'), compact('totalPengeluaran'));
    // }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pengeluaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'judul' => 'required|max:255',
            'deskripsi' => 'nullable',
            'jumlah' => 'required|numeric',
            'tanggal_pengeluaran' => 'required|date'
        ]);

        // Pengeluaran::create($validateData);
        $user = Auth::user();
        // Buat pemasukkan baru dengan data dari request
        $validateData = new Pengeluaran();
        $validateData->user_id = $user->id;
        $validateData->judul = $request->judul;
        $validateData->deskripsi = $request->deskripsi;
        $validateData->jumlah = $request->jumlah;
        $validateData->tanggal_pengeluaran = $request->tanggal_pengeluaran;

        $validateData->save();
        return redirect('/dashboard/pengeluaran')->with('success', 'Add New Note Successfull!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengeluaran $pengeluaran)
    {
        return view('dashboard.pengeluaran.show',[
            'pengeluaran' => $pengeluaran
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengeluaran $pengeluaran)
    {
        return view('dashboard.pengeluaran.edit', [
            'pengeluaran' => $pengeluaran
         ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        $validateStore = $request->validate([
            'judul' => 'required|max:255',
            'deskripsi' => 'nullable',
            'jumlah' => 'required|numeric',
            'tanggal_pengeluaran' => 'required|date'
        ]);

        Pengeluaran::where('id', $pengeluaran->id)
                ->update($validateStore);
        return redirect('/dashboard/pengeluaran')->with('success', 'Note Updated Successfull!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengeluaran $pengeluaran)
    {
        $destroy = Pengeluaran::findOrFail($pengeluaran->id);
        $destroy->delete();
        return redirect('/dashboard/pengeluaran')->with('success', 'Note Deleted Successfull!');
    }
}
