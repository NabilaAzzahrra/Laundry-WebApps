<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use Illuminate\Http\Request;

class OutletController extends Controller
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
                'nama' => 'required',
                'alamat' => 'required',
                'telp' => 'required',
            ],
            [
                'nama.required' => 'Jurusan tidak boleh kosong',
                'alamat.required' => 'Jurusan tidak boleh kosong',
                'telp.required' => 'Jurusan tidak boleh kosong',
            ],
        );

        $outlet = [
            'nama' => $request->input('nama'),
            'alamat' => $request->input('alamat'),
            'tlp' => $request->input('telp'),
        ];

        Outlet::create($outlet);

        return redirect()
            ->route('outlet.index')
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
                'nama' => 'required',
                'alamat' => 'required',
                'telp' => 'required',
            ],
            [
                'nama.required' => 'Jurusan tidak boleh kosong',
                'alamat.required' => 'Jurusan tidak boleh kosong',
                'telp.required' => 'Jurusan tidak boleh kosong',
            ],
        );

        $data = [
            'nama' => $request->input('nama'),
            'alamat' => $request->input('alamat'),
            'tlp' => $request->input('telp'),
        ];

        $outlet = Outlet::findOrFail($id);

        if ($outlet) {
            $outlet->update($data);
            return back()->with('message_delete','Data Outlet Sudah dihapus');
        } else {
            return back()->with('message_delete','Data Outlet Sudah dihapus');
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
        $outlet = Outlet::findOrFail($id);
        $outlet->delete();
        return back()->with('message_delete','Data Outlet Sudah dihapus');
    }
}
