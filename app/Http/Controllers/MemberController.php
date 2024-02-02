<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('master.index')->with([
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
                'jenis_kelamin' => 'required',
                'telp' => 'required',
            ],
            [
                'nama.required' => 'Jurusan tidak boleh kosong',
                'alamat.required' => 'Jurusan tidak boleh kosong',
                'jenis_kelamin.required' => 'Jurusan tidak boleh kosong',
                'telp.required' => 'Jurusan tidak boleh kosong',
            ],
        );

        $member = [
            'nama' => $request->input('nama'),
            'alamat' => $request->input('alamat'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'telp' => $request->input('telp'),
        ];

        Member::create($member);

        return redirect()
            ->route('member.index')
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
                'jenis_kelamin' => 'required',
                'telp' => 'required',
            ],
            [
                'nama.required' => 'Jurusan tidak boleh kosong',
                'alamat.required' => 'Jurusan tidak boleh kosong',
                'jenis_kelamin.required' => 'Jurusan tidak boleh kosong',
                'telp.required' => 'Jurusan tidak boleh kosong',
            ],
        );

        $data = [
            'nama' => $request->input('nama'),
            'alamat' => $request->input('alamat'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'telp' => $request->input('telp'),
        ];

        $member = Member::findOrFail($id);

        if ($member) {
            $member->update($data);
            return back()->with('message_delete','Data Jurusan Sudah dihapus');
        } else {
            return back()->with('message_delete','Data Jurusan Sudah dihapus');
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
        $member = Member::findOrFail($id);
        $member->delete();
        return back()->with('message_delete','Data Member Sudah dihapus');
    }
}
