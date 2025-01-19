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

    public function update(Request $request, $id) {
        if (Books::where('id', $id)->exists()) {
            $book = Books::find($id);
            $book->nama = is_null($request->nama) ? $book->nama : $request->nama;
            $book->penulis = is_null($request->penulis) ? $book->penulis : $request->penulis;
            $book->terbit = is_null($request->terbit) ? $book->terbit : $request->terbit;
            $book->save();


            return response()->json([
                "pesan" => "buku diupdate"
            ], 404);
        } else {
            return response()->json([
                "pesan" => "buku tidak ditemukan"
            ], 404);
        }
    }

    public function destroy($id) {
        if (Books::where('id', $id)->exists()) {
                $book = Books::find($id);
                $book = delete();
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
