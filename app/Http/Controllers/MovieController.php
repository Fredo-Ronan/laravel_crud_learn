<?php

namespace App\Http\Controllers;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie; 

class MovieController extends Controller
{
    /**
    * index
    *
    * @return void
    */
    public function index() {
        $movie = Movie::latest()->paginate(5);
        return view('movie.index', compact('movie'));
    }

    /**
    * create
    * 
    * @return void
    */
    public function create() {
        return view('movie.create');
    }

    /**
     * store
     * 
     * @param Request $request
     * @return void
     */
    public function store(Request $request) {
        // Validasi Formulir
        $this->validate($request, [
            'title' => 'required',
            'director' => 'required',
            'duration' => 'required',
            'image' => 'required'
        ]);

        if($request->hasFile('image')) {
            $uploadedImage = $request->file('image');
            $namaFile = time() . '_' . $uploadedImage->getClientOriginalName();
            $uploadPath = '../public/public/images/';
            $uploadedImage->move($uploadPath, $namaFile);

            $uploadedPath = '/public/images/' . $namaFile;
        }

        //Fungsi Simpan Data ke dalam Database
        Movie::create([
            'title' => $request->title,
            'director' => $request->director,
            'duration' => $request->duration,
            'image'=> $uploadedPath
        ]);

        try {
            return redirect()->route('movie.index');
        } catch(Exception $e) {
            return redirect()->route('movie.index');
        }
    }

    /**
     * edit
     * 
     * @param mixed $request
     * @return void
     */
    public function edit($id){
        $movie = Movie::find($id);
        return view('movie.edit', compact('movie'));
    }

    /**
     * update
     * 
     * @param mixed $request
     * @param int $id
     * @return void
     */
    public function update(Request $request, $id){
        $movie = Movie::find($id);

        //validate form
        $this->validate($request, [
            'title'=> 'required',
            'director'=> 'required',
            'duration'=> 'required',
        ]);

        $uploadedPath = $movie->image == '' ? '' : $movie->image;

        if($request->hasFile('image')) {
            $uploadedImage = $request->file('image');
            $namaFile = time() . '_'. $uploadedImage->getClientOriginalName();
            $uploadPath = '../public/public/images/';
            $uploadedImage->move($uploadPath, $namaFile);
            $uploadedPath = '/public/images/'. $namaFile;
        }

        $movie->update([
            'title'=> $request->title,
            'director'=> $request->director,
            'duration'=> $request->duration,
            'image'=> $uploadedPath
        ]);

        return redirect()->route('movie.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     * 
     * @param int $id
     * @return void
     */
    public function destroy($id) {
        $movie = Movie::find($id);
        $movie->delete();
        return redirect()->route('movie.index')->with(['success'=> 'Data Berhasil Dihapus!']);
    }
}
