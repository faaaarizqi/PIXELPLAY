<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function viewHomec(Request $request)
    {
        $user = session('user');
        $datas = DB::select("
            SELECT g.id_g AS id, g.nama_g AS name, g.harga AS price, e.jenis_genre AS genre
            FROM game g LEFT JOIN genre e
            ON g.id_gen = e.id_gen WHERE g.status = :status;", [ 'status' => 'av']);
        return view('customer.home', ['user' => $user])->with('datas', $datas);
    }

    public function viewHistoryc(Request $request)
    {

        $user = session('user');
        $datas = DB::select("
                    SELECT c.username AS customer, g.nama_g AS game, e.jenis_genre AS genre, t.jumlah AS quantity, (t.jumlah*g.harga) AS price, t.dibuat AS time
                    FROM transaksi t
                    LEFT JOIN customer c ON t.id_c = c.id_c
                    LEFT JOIN game g ON t.id_g = g.id_g
                    LEFT JOIN genre e ON g.id_gen = e.id_gen
                    WHERE t.id_c = :idc;",
            [ 'idc' => $user->id_c]);
        return view('customer.history',['user' => $user])->with('datas', $datas);
    }

    public function buy(Request $request, $product, $user){

        $request->validate([
            'jumlah' => 'required',

        ]);

        if($request->jumlah == null || $request->jumlah == 0){
            return redirect()->route('customer.home')->with('success', 'you cant buy item with 0 quantity');
        }

        DB::insert(
            'INSERT INTO transaksi (id_c, id_g, jumlah)
                    VALUES (:id_c, :id_g, :jumlah);',
            [
                'id_c' => $user,
                'id_g' => $product,
                'jumlah' => $request->jumlah,
            ]
        );

        return redirect()->route('customer.home')->with('success', 'success buy');
    }

    public function searchc(Request $request)
    {
        $user = session('user');
        $kw = $request->input('key');
        $skw = '%'.(string)$kw.'%';
        $datas = DB::select(
            "
            SELECT g.id_g AS id, g.nama_g AS name, g.harga AS price, e.jenis_genre AS genre
            FROM game g LEFT JOIN genre e
            ON g.id_gen = e.id_gen
            WHERE g.status = :status AND g.nama_g LIKE :keyword ;",
            [
                'keyword' => $skw,
                'status' => 'av'
            ]
        );

        return view('customer.home', ['user' => $user])->with('datas', $datas);
    }


}
