<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Outlet;
use App\Models\Paket;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksi = Transaksi::all();
        $paket = Paket::all();
        return view('transaksi.index')->with([
            'transaksi' => $transaksi,
            'paket' => $paket,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $outlet = Outlet::all();
        $member = Member::all();
        $paket = Paket::all();
        return view('transaksi.add')->with([
            'outlet' => $outlet,
            'member' => $member,
            'paket' => $paket,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'id_outlet' => 'required',
                'id_member' => 'required',
                'tanggal' => 'required',
                'batas_waktu' => 'required',
                'tgl_bayar' => 'required',
            ],
            [
                'id_outlet.required' => 'Jurusan tidak boleh kosong',
                'id_member.required' => 'Jurusan tidak boleh kosong',
                'tanggal.required' => 'Jurusan tidak boleh kosong',
                'batas_waktu.required' => 'Jurusan tidak boleh kosong',
                'tgl_bayar.required' => 'Jurusan tidak boleh kosong',
            ],
        );

        $outlet = [
            'kode_invoice' => date('YmdHis'),
            'id_outlet' => $request->input('id_outlet'),
            'id_member' => $request->input('id_member'),
            'tgl' => $request->input('tanggal'),
            'batas_waktu' => $request->input('batas_waktu'),
            'tgl_bayar' => $request->input('tgl_bayar'),
            'biaya_tambahan' => $request->input('biaya_tambahan'),
            'diskon' => $request->input('diskon'),
            'pajak' => $request->input('pajak'),
            'id_user' => Auth::user()->id,
        ];

        Transaksi::create($outlet);

        return redirect()
            ->route('transaksi.index')
            ->with('message', 'Data Transaksi Sudah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getpaket($id)
    {
        $paket = Paket::where('id', $id)->first();

        return response()->json(['paket' => $paket]);
    }
}
