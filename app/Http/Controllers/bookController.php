<?php

namespace App\Http\Controllers;

use App\Models\book;
use Illuminate\Http\Request;

class bookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::orderBy('created_at', 'desc')->get();;

        return view('books/index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $validatedData = $request->validate([
                'judul' => 'required',
                'penulis' => 'required',
                'kategori' => 'required',
                'tahun_terbit' => 'required|date',
                'jumlah_stok' => 'required|integer',
                'deskripsi' => 'required',
                'status' => 'required|boolean',
            ]);
        
            Book::create($validatedData);
        
            return redirect()->route('books.index')->with('alert', ['type' => 'create', 'message' => 'Buku berhasil ditambahkan!']);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Book::findOrFail($id);

        // Kirimkan data ke view
        return view('books.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'kategori' => 'required',
            'tahun_terbit' => 'required|date',
            'jumlah_stok' => 'required|integer',
            'deskripsi' => 'required',
            'status' => 'required|boolean',
        ]);
    
        // Mencari data buku berdasarkan ID
        $data = Book::findOrFail($id);
    
        // Update detail buku
        $data->judul = $request->judul;
        $data->penulis = $request->penulis; 
        $data->kategori = $request->kategori; 
        $data->tahun_terbit = $request->tahun_terbit; 
        $data->jumlah_stok = $request->jumlah_stok; 
        $data->deskripsi = $request->deskripsi; 
        $data->status = $request->status; 
    
        // Simpan perubahan data
        $data->save();
    
        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('books.index')->with('alert', ['type' => 'edit', 'message' => 'Buku berhasil diperbarui!']);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
    $book->delete();

    return redirect()->route('books.index')->with('alert', ['type' => 'delete', 'message' => 'Buku berhasil dihapus!']);
    }

    
}
