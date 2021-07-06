<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Isbn;
use App\Jenis;
use App\Identity;
use Validator;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\File;

class BookProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    protected function savePhoto(UploadedFile $photo)
    {
        $fileName = str_random(40) . '.' . $photo->guessClientExtension();
        $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';
        $photo->move($destinationPath, $fileName);
        
        return $fileName;
    }

    public function deletePhoto($filename)
    {
        $path = public_path() . DIRECTORY_SEPARATOR . 'img'. DIRECTORY_SEPARATOR . $filename;
        
        return File::delete($path);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {  
        $q = $request->get('q');
        $book = Book::where('title', 'LIKE', '%'.$q.'%')->paginate(5);
        
        return view('product.index', compact('book', 'q'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataJenisBuku = Jenis::all();
        $list_identity = Identity::all();

        return view('product.create', compact('dataJenisBuku', 'list_identity'));
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
            'title' => 'required|string|max:255',
            'id_jenis' => 'required',
            'identity' => 'required',
            'writer' => 'required|string|max:255',
            'summary' => 'required|string',
            'price' => 'sometimes|numeric',
            'no_isbn' => 'required|string|max:255',
            'photo' => 'mimes:jpeg,png|max:10240'
        ]);

        $data = $request->only('title', 'writer', 'summary', 'price', 'no_isbn', 'id_jenis', 'identity');
        if ($request->hasFile('photo'))
        {
            $data['photo'] = $this->savePhoto($request->file('photo'));
        }

        $post = Book::create($data);
        
        $isbn = new Isbn;
        $isbn->no_isbn = $request->input('no_isbn');
        $post->isbn()->save($isbn);
        $post->identity()->attach($request->input('identity'));

        return redirect()->route('book.index')->with('success', 'Berhasil menyimpan judul buku: '.$request->get('title').'');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);
        
        return view('product.detail', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        $book->no_isbn = $book->isbn->no_isbn;

        $dataJenisBuku = Jenis::all();
        $list_identity = Identity::all();

        return view('product.edit', compact('book', 'dataJenisBuku', 'list_identity'));
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
        $book = Book::findOrFail($id);
        $this->validate($request, [
            'title' => 'required|string|max:255,' . $book->id,
            'id_jenis' => 'required',
            'identity' => 'required',
            'writer' => 'required|string|max:255,' . $book->id,
            'summary' => 'required|string|max:255,' . $book->id,
            'no_isbn' => 'required|string|max:255,' . $book->id,
            'photo' => 'mimes:jpeg,png|max:10240',
        ]);

        $data = $request->only('title', 'writer', 'summary', 'price', 'id_jenis', 'identity');

        if($request->hasFile('photo')){
            $data['photo'] = $this->savePhoto($request->file('photo'));
            if ($book->photo !== '') $this->deletePhoto($book->photo);
        }

        $book->update($data);
        $isbn = $book->isbn;
        $isbn->no_isbn = $request->input('no_isbn');
        $book->isbn()->save($isbn);
        $book->identity()->sync($request->input('identity'));

        return redirect()->route('book.index')->with('success','Berhasil Update Judul Buku : '.$request->get('title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id)->delete();
        
        if ($book->photo !== '') $this->deletePhoto($book->photo);
        
        $book->delete();

        return redirect()->route('book.index')->with('error',
        'Berhasil Hapus Buku !!');
    }
}
