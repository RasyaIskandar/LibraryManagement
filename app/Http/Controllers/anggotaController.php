<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\pinjambukus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class anggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = book::all();
        return view('anggota.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $loans = pinjambukus::all();
        return view('anggota.create', compact('loans'));
    }

    public function perpanjangTanggal(Request $request, pinjambukus $pinjam)
    {
        $request->validate([
            'tanggal_kembali' => 'required|date|after:'.$pinjam->tanggal_kembali,
        ]);

        $pinjam->update([
            'tanggal_kembali' => $request->input('tanggal_kembali'),
        ]);

        return redirect()->back()->with('success', 'Tanggal pengembalian berhasil diperpanjang.');
    }


    public function kembalikanPaksa($id)
    {
        $pinjam = pinjambukus::findOrFail($id);
    
        // Cek apakah status peminjaman sudah 'returned'
        if ($pinjam->status == 'returned') {
            return redirect()->back()->with('error', 'Buku sudah dikembalikan.');
        }
    
        // Proses pengembalian paksa
        DB::beginTransaction();
    
        try {
            // Update status peminjaman menjadi 'returned' dan tanggal pengembalian
            $pinjam->status = 'returned';
            $pinjam->tanggal_kembali = now();
            $pinjam->save();
    
            // Ambil buku yang dipinjam
            $book = book::findOrFail($pinjam->book_id);
    
            // Tambah stok buku
            $book->jumlah_stok += 1;
            $book->status = true; // Set status buku menjadi tersedia lagi
            $book->loan_status = 'available'; // Buku kembali tersedia untuk dipinjam
            $book->save();
    
            DB::commit();
    
            return redirect()->back()->with('success', 'Buku berhasil dikembalikan secara paksa.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengembalikan buku.');
        }
    }
    
    
    


    public function loanHistory()
    {
        // Mengambil riwayat pinjaman, baik yang sudah kembali maupun belum
        $pinjamBukus = pinjambukus::with('book')->get();
        return view('admin.loanHistory', compact('pinjamBukus'));
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'tanggal_kembali' => 'required|date|after_or_equal::tanggal_pinjam',
            
        ]);

        $book = book::find($request->input('book_id'));
        //mencari id buku

            if ($book->jumlah_stok <= 0 || $book->status === false) { 
                return back()->with('error', 'Buku tidak tersedia untuk dipinjam.');
                    

            }
            //jika buku tersedia maka akan menjalankan perintah berikut

            $book->decrement('jumlah_stok');
            //ngurangin stok 

            

            pinjambukus::create([
                'user_id' => Auth::id(),
                'book_id' => $request->input('book_id'),
                'tanggal_pinjam' => now(),
                'tanggal_kembali' => $request->tanggal_kembali,
                'status' => 'borrowed',
            ]);

        

       // Update status buku hanya kalo stok habis
       if ($book->jumlah_stok <= 0) {
        $book->update([
            'status' => false,
            'loan_status' => 'borrowed',
        ]);
    } else {
        $book->update([
            'loan_status' => 'borrowed', // Buku bisa dipinjam tapi statusnya tidak berubah jadi tidak tersedia
        ]);
    }




        return redirect()->back()->with('success', 'Buku berhasil dipinjam.');
        
    }

    
    
    

    public function kembalikanBuku(pinjambukus $pinjam)
    {
        DB::beginTransaction();
        
        try {
            // Update status peminjaman menjadi 'returned' dan tanggal pengembalian
            $pinjam->status = 'returned';
            $pinjam->tanggal_kembali = now();
            $pinjam->save();
    
            // Tambah stok buku
            $book = book::findOrFail($pinjam->book_id);
            $book->jumlah_stok += 1;
            $book->status = true; // Set status buku menjadi tersedia lagi
            $book->loan_status = 'available'; // Buku kembali tersedia untuk dipinjam
            $book->save();
    
            DB::commit();
    
            return redirect()->back()->with('success', 'Buku berhasil dikembalikan.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengembalikan buku');
        }
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}