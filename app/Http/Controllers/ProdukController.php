<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = DB::table('produk')->get();
        return view('produk.index',compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        // $surat = DB::table('surat_jalan')->get();
        $q = DB::table('produk')->select(DB::raw('MAX(RIGHT(kode,4)) as kode'));
        $kd="";
        if($q->count()>0){
            foreach($q->get() as $k){
                $tmp = ((int)$k->kode)+1;
                $kd = sprintf("%04s",$tmp);
            }
        }
        else{
            $kd = "0001";
        }
        return view('produk.create',compact('kd'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'kode' => 'required',
            'nama' => 'required',
            'harga' => 'required|numeric'
        ]);
        try{
            DB::transaction(function () use ($request){
                DB::table('produk')->insert([
                    'kode' => $request->kode,
                    'nama' => $request->nama,
                    'harga' => $request->harga
                ]);
            });
            return redirect('/produk')->with(['success' => 'Data Berhasil Disimpan']);
        }catch(Exception $e){
            return redirect('/produk')->with('Error','Data Berhasil Disimpan');
        }
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
        $produk = DB::table('produk')->where('id',$id)->get();
        return view('produk.edit',compact('produk'));
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
        $this->validate($request,[
            'kode' => 'required',
            'nama' => 'required',
            'harga' => 'required|numeric'
        ]);
        try{
            DB::transaction(function () use ($request,$id){
                DB::table('produk')->where('id',$id)->update([
                    'kode' => $request->kode,
                    'nama' => $request->nama,
                    'harga' => $request->harga
                ]);
            });
            return redirect('/produk')->with(['success' => 'Data Berhasil Ubah']);
        }catch(Exception $e){
            return redirect('/produk')->with('Error','Data Gagal Diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            DB::transaction(function () use($id){
                DB::table('produk')->where('id',$id)->delete();
            });
            return redirect()->back()->with(['success' => 'Data Berhasil Dihapus']);
        }catch(Exception $e){

        }
    }
}
