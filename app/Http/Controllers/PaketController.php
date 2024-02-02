<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outlet = Outlet::all();
        return view('master.index')->with([
            'outlet' => $outlet,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
                'jenis' => 'required',
                'nama_paket' => 'required',
                'harga' => 'required',
            ],
            [
                'id_outlet.required' => 'Jurusan tidak boleh kosong',
                'jenis.required' => 'Jurusan tidak boleh kosong',
                'nama_paket.required' => 'Jurusan tidak boleh kosong',
                'harga.required' => 'Jurusan tidak boleh kosong',
            ],
        );

        $outlet = [
            'id_outlet' => $request->input('id_outlet'),
            'jenis' => $request->input('jenis'),
            'nama_paket' => $request->input('nama_paket'),
            'harga' => $request->input('harga'),
        ];

        Paket::create($outlet);

        return redirect()
            ->route('paket.index')
            ->with('message', 'Data Jurusan Sudah ditambahkan');
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
        $request->validate(
            [
                'id_outlet' => 'required',
                'jenis' => 'required',
                'nama_paket' => 'required',
                'harga' => 'required',
            ],
            [
                'id_outlet.required' => 'Jurusan tidak boleh kosong',
                'jenis.required' => 'Jurusan tidak boleh kosong',
                'nama_paket.required' => 'Jurusan tidak boleh kosong',
                'harga.required' => 'Jurusan tidak boleh kosong',
            ],
        );

        $data = [
            'id_outlet' => $request->input('id_outlet'),
            'jenis' => $request->input('jenis'),
            'nama_paket' => $request->input('nama_paket'),
            'harga' => $request->input('harga'),
        ];

        $paket = Paket::findOrFail($id);

        if ($paket) {
            $paket->update($data);
            return back()->with('message_delete','Data Paket Sudah dihapus');
        } else {
            return back()->with('message_delete','Data Paket Sudah dihapus');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paket = Paket::findOrFail($id);
        $paket->delete();
        return back()->with('message_delete','Data Paket Sudah dihapus');
    }
}
