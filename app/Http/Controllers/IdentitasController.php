<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Identity;

class IdentitasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->input('q');
        $identitas = Identity::where('nama_identity', 'LIKE', '%'.$q.'%')->paginate(5);

        return view('identitas.index', compact('identitas', 'q'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('identitas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_identity' => 'required|string|max:255',
        ]);

        Identity::create($request->all());

        return redirect()->route('identitas.index')->with('success', 'Berhasil menyimpan identitas buku: '.$request->get('nama_identity').'');
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
        $identitas = Identity::find($id);

        return view('identitas.edit', compact('identitas'));
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
        $identitas = Identity::findOrFail($id);

        $this->validate($request, [
            'nama_identity' => 'required|string|max:255, '.$identitas->id,
        ]);

        $identitas->update($request->all());

        return redirect()->route('identitas.index')->with('success', 'Berhasil mengubah identitas buku: '.$request->get('nama_identity').'');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Identity::destroy($id);

        return redirect()->route('identitas.index')->with('error', 'Berhasil Hapus identitas !!');
    }
}
