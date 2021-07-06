<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jenis;

class JenisController extends Controller
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
        $jenis = Jenis::where('jenis_buku', 'LIKE', '%'.$q.'%')->paginate(5);

        return view('jenis.index', compact('jenis', 'q'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jenis.create');
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
            'jenis_buku' => 'required|string|max:255',
        ]);

        Jenis::create($request->all());

        return redirect()->route('jenis.index')->with('success', 'Berhasil menyimpan jenis buku: '.$request->get('jenis_buku').'');
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
        $jenis = Jenis::find($id);

        return view('jenis.edit', compact('jenis'));
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
        $jenis = Jenis::findOrFail($id);

        $this->validate($request, [
            'jenis_buku' => 'required|string|max:255, '.$jenis->id,
        ]);

        $jenis->update($request->all());

        return redirect()->route('jenis.index')->with('success', 'Berhasil mengubah jenis buku: '.$request->get('jenis_buku').'');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Jenis::destroy($id);

        return redirect()->route('jenis.index')->with('error', 'Berhasil Hapus Jenis !!');
    }
}
