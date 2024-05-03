<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pemasukkan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemasukkanController extends Controller
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
        $pemasukkans = Pemasukkan::where('user_id', $user->id)
                        ->when($mulai, function ($query) use ($mulai) {
                            return $query->whereDate('tanggal_pemasukkan', '>=', $mulai);
                        })
                        ->when($sampai, function ($query) use ($sampai) {
                            return $query->whereDate('tanggal_pemasukkan', '<=', $sampai);
                        })
                        ->get();
        // $pemasukkans = Pemasukkan::where('user_id',$user->id)->get();
        // $totalIncome = Pemasukkan::where('user_id', $user->id)->sum('jumlah');
        $totalIncome = $pemasukkans->sum('jumlah');
        return view('dashboard.pemasukkan.index', compact('pemasukkans', 'totalIncome'));
    }

    // public function filter(Request $request)
    // {
    //     $user = Auth::user();
    //     $mulai = $request->input('mulai_tanggal');
    //     $sampai = $request->input('sampai_tanggal');
    //     // $pemasukkan = $user->pemasukkan()::whereBetween('tanggal_pemasukkan', [$mulai, $sampai])->get();
    //     $pemasukkan = Pemasukkan::whereBetween('tanggal_pemasukkan', [$mulai, $sampai])->get();
    //     return view('dashboard.pemasukkan.index', compact('user', 'pemasukkans', 'pemasukkan', 'totalIncome'));
    // }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pemasukkan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'sumber_pemasukkan' => 'required|max:255',
            'deskripsi' => 'nullable',
            'jumlah' => 'required|numeric',
            'tanggal_pemasukkan' => 'required|date'
        ]);

        // Pemasukkan::create($validateData);
        $user = Auth::user();
        // Buat pemasukkan baru dengan data dari request
        $validateData = new Pemasukkan();
        $validateData->user_id = $user->id;
        $validateData->sumber_pemasukkan = $request->sumber_pemasukkan;
        $validateData->deskripsi = $request->deskripsi;
        $validateData->jumlah = $request->jumlah;
        $validateData->tanggal_pemasukkan = $request->tanggal_pemasukkan;

        $validateData->save();
        return redirect('/dashboard/pemasukkan')->with('success', 'Add New Note Successfull!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemasukkan $pemasukkan)
    {
        return view('dashboard.pemasukkan.show',[
            'pemasukkan' => $pemasukkan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemasukkan $pemasukkan)
    {
        return view('dashboard.pemasukkan.edit', [
            'pemasukkan' => $pemasukkan
         ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemasukkan $pemasukkan)
    {
        $validateStore = $request->validate([
            'sumber_pemasukkan' => 'required|max:255',
            'deskripsi' => 'nullable',
            'jumlah' => 'required|numeric',
            'tanggal_pemasukkan' => 'required|date'
        ]);

        Pemasukkan::where('id', $pemasukkan->id)
                ->update($validateStore);
        return redirect('/dashboard/pemasukkan')->with('success', 'Note Updated Successfull!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemasukkan $pemasukkan)
    {
        $destroy = Pemasukkan::findOrFail($pemasukkan->id);
        $destroy->delete();
        return redirect('/dashboard/pemasukkan')->with('success', 'Note Deleted Successfull!');
    }
}
