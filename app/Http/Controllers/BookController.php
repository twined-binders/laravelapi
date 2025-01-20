<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;

class BookController extends Controller
{
    public function index() {
        $books = Books::all();
        return response()->json($books);
    }

    public function store(Request $request) {
        $book = new Books;
        $book->nama = $request->nama;
        $book->penulis = $request->penulis;
        $book->terbit = $request->terbit;
        $book->save();
        return response()->json([
            "pesan" => "buku ditambahkan"
        ], 201);
    }

    public function show($id) {
        $book = Books::find($id);
        if(!empty($book)){
            return response()->json($book);
        } else {
            return response()->json([
                "pesan" => "buku tidak ditemukan"
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        // Find the book or return a 404 response
        $book = Books::find($id);
    
        if (!$book) {
            return response()->json([
                "pesan" => "buku tidak ditemukan"
            ], 404);
        }
    
        // Update fields if they exist in the request
        $book->nama = $request->input('nama', $book->nama); // Use default value if not provided
        $book->penulis = $request->input('penulis', $book->penulis);
        $book->terbit = $request->input('terbit', $book->terbit);
        $book->save();
    
        return response()->json([
            "pesan" => "buku diupdate",
            $request->input('nama')
        ], 200); // Use 200 for success
    }
    

    public function destroy($id) {
        if (Books::where('id', $id)->exists()) {
                $book = Books::find($id);
                $book->delete();
                return response()->json([
                    "pesan" => "buku dihapus"
                ], 202);
            } else {
                return response()->json([
                    "pesan" => "buku tidak ditemukan"
                ], 404);
            }
        }

}
