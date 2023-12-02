<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function viewHome(Request $request)
    {

        $user = session('user');
        return view('admin.home', ['user' => $user]);
    }

    public function viewIndex()
    {
        $user = session('user');
        $datas = DB::select("
            SELECT g.id_g AS id, g.nama_g AS name, g.harga AS price, e.jenis_genre AS genre
            FROM game g LEFT JOIN genre e
            ON g.id_gen = e.id_gen WHERE g.status = :status;", [ 'status' => 'av']);
        return view('admin.index',['user' => $user])->with('datas', $datas);
    }



    public function viewAdd($status)
    {
        $user = session('user');
        return view('admin.add', ['user' => $user])->with('status', $status);
    }

    public function insert(Request $request, $status){
        $user = session('user');
        $request->validate([
            'id_g' => 'required',
            'nama_g' => 'required',
            'jenis_genre' => 'required',
            'harga' => 'required',
        ]);

        $datas = DB::select('SELECT id_g FROM game WHERE id_g = :id;', ['id'=>$request->id_g]);
        if($datas != null){
            return view('admin.add')->with(['error_D'=> '[Ganti ID game] > Terdapat game dengan ID yang sama', 'status' => $status]);
        }

        DB::insert(
            'INSERT INTO game(id_g,nama_g, harga, id_gen, status)
                    VALUES (:id_g, :nama_g, :harga, :jenis_genre, :status);',
            [
                'id_g' => $request->id_g,
                'nama_g' => $request->nama_g,
                'harga' => $request->harga,
                'jenis_genre' => $request->jenis_genre,
                'status' => $status
            ]
        );

        $data = DB::table('game')->where('id_g', $request->id_g)->first();
        $status = $data->status;
        if ($status == 'av'){ $rt = 'admin.index';}
        else {$rt = 'admin.bin';}

        return redirect()->route($rt)->with('success', 'Added new game add to database is success');
    }

    public function edit($id)
    {
    $user = session('user');
    $data = DB::table('game')->where('id_g', $id)->first();
    $unitGenre = DB::table('genre')->where('id_gen', $data->id_gen)->first();
    return view('admin.edit', ['user' => $user])->with(['data' => $data, 'unitGenre' => $unitGenre]);
    }

    public function update($id, Request $request)
    {
        $user = session('user');
        $request->validate([
//            'id_g' => 'required',
            'nama_g' => 'required',
            'jenis_genre' => 'required',
            'harga' => 'required',
        ]);

        DB::update(
            'UPDATE game SET
                     nama_g = :nama_g,
                     id_gen = :jenis_genre,
                     harga = :harga
                 WHERE id_g = :id',
            [
                'id' => $id,
                'nama_g' => $request->nama_g,
                'jenis_genre' => $request->jenis_genre,
                'harga' => $request->harga,
            ]
        );

        $data = DB::table('game')->where('id_g', $id)->first();
        $status = $data->status;
        if ($status == 'av'){ $rt = 'admin.index';}
        else {$rt = 'admin.bin';}

        return redirect()->route($rt)->with('success', 'Data of game changed is success');
    }

    public function search(Request $request, $status)
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
                'status' => $status
            ]
        );
    
        if ($status == 'av'){ $rt = 'admin.index';}
        else {$rt = 'admin.bin';}
    
        return view($rt, ['user' => $user])->with('datas', $datas);
    }
    

    public function softDelete($id)
    {
        $user = session('user');
        $data = DB::table('game')->where('id_g', $id)->first();
        $save_data = $data->nama_g;
        DB::update(
            'UPDATE game SET status = :status WHERE id_g = :id',
            [
                'id' => $id,
                'status' => 'nav'
            ]
        );
        // DB::delete('DELETE FROM game WHERE id_ic = :id_v', ['id_v' => $id]);
        return redirect()->route('admin.index')->with('success', 'Unit '. $save_data .' has moved to recycle bin');
    }

    public function viewAccount()
    {
        $user = session('user');
        $datas = DB::select("SELECT * FROM customer WHERE status = :status;", [ 'status' => 'av']);
        $datas1 = DB::select("SELECT * FROM customer WHERE status = :status;", [ 'status' => 'nav']);
        return view('admin.customerAccount',['user' => $user])->with(['datas'=> $datas, 'datas1' => $datas1]);
    }

    public function accountDeactivate($id)
    {
        $datas = DB::select("SELECT * from customer WHERE id_c = :id",['id' =>$id]);
        $data = $datas[0];
        $save_data = $data->username;
        DB::update('UPDATE customer SET status = :status WHERE id_c = :id',
            [
                'id' => $id,
                'status' => 'nav'
            ]
        );
        return redirect()->route('admin.customerAccount')->with('warning', 'Account '. $save_data .' has been DEACTIVATED');
    }

    public function accountActivate($id)
    {
        $datas = DB::select("SELECT * from customer WHERE id_c = :id",['id' =>$id]);
        $data = $datas[0];
        $save_data = $data->username;
        DB::update('UPDATE customer SET status = :status WHERE id_c = :id',
            [
                'id' => $id,
                'status' => 'av'
            ]
        );
        return redirect()->route('admin.customerAccount')->with('success', 'Account '. $save_data .' has been ACTIVATED');
    }

    public function accountDelete($id)
    {
        $datas = DB::select("SELECT * from customer WHERE id_c = :id",['id' =>$id]);

        $data = $datas[0];
        $save_data = $data->username;
    //        dd($data);
        DB::delete('DELETE FROM customer WHERE id_c = :id',
            [
                'id' => $id
            ]
        );
        return redirect()->route('admin.customerAccount')->with('danger', 'Account '. $save_data .' has been DELETED');
    }

    public function viewEditAccount($id)
    {
        $user = session('user');

        $datas = DB::select("SELECT * from customer WHERE id_c = :id",['id' =>$id]);
        $data = $datas[0];

        return view('admin.editAccount', ['user' => $user])->with(['data' => $data]);
    }

    public function updateAccount($id, Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'address' => 'required',
            'contact' => 'required',
        ]);

        DB::update(
            'UPDATE customer SET
                     username = :username,
                     password = :password,
                     address = :address,
                     contact = :contact
                 WHERE id_c = :id',
            [
                'id' => $id,
                'username' => $request->username,
                'password' => $request->password,
                'address' => $request->address,
                'contact' => $request->contact
            ]
        );

        return redirect()->route('admin.accountEdit', ['id'=>$id])->with('success', 'Data of your account changed is success');
    }

}
