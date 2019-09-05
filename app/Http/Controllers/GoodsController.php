<?php

namespace App\Http\Controllers;

use App\Good;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goods = Good::latest()->paginate(5);

        return view('goods.index', compact('goods'))
        ->with('i', (request()->input('page', 1) - 1) * 5);   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('goods.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('file');
        $nama_file = time().".jpg";
        //dd($nama_file);
        $tujuan_upload = "image";
        $file->move($tujuan_upload,$nama_file);
  
        Good::create([
            "name" => $request->name,
            "harga" => $request->harga,
            "kategori" => $request->kategori,
            "stok" => $request->stok,
            "gambar" => $nama_file,
        ]);
   
        return redirect()->route('goods.index')
                        ->with('success','Goods created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Good  $good
     * @return \Illuminate\Http\Response
     */
    public function show(Good $good)
    {
        return view('goods.show',compact('good'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Good  $good
     * @return \Illuminate\Http\Response
     */
    public function edit(Good $good)
    {
        // $file = $good->file('file');
        // $nama_file = time().".jpg";
        // //dd($nama_file);
        // $tujuan_upload = "image";
        // $file->move($tujuan_upload,$nama_file);

        // Good::create([
        //     "name" => $good->name,
        //     "harga" => $good->harga,
        //     "kategori" => $good->kategori,
        //     "stok" => $good->stok,
        //     "gambar" => $nama_file,
        // ]);
   
        return view('goods.edit',compact('good'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Good  $good
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Good $good)
    {
        $request->validate([
            'name' => 'required',
            'harga' => 'required',
            'kategori' => 'required',
            'stok' => 'required',
           
        ]);
            
            // $good = Good::find($good);
            $good->name = $request->name;
            $good->harga = $request->harga;
            $good->kategori = $request->kategori;
            $good->stok = $request->stok;

            if($request->file('file')){
                $file = $request->file('file');
                $nama_file = time().".jpg";
                $tujuan_upload = "image";
                $file->move($tujuan_upload,$nama_file);
                $good->gambar = $nama_file;
            }else{
                $good->gambar =  $request->file;
            }

            $good->save();
            
  
        return redirect()->route('goods.index')
                        ->with('success','good updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Good  $good
     * @return \Illuminate\Http\Response
     */
    public function destroy(Good $good)
    {
        $good->delete();
  
        return redirect()->route('goods.index')
                        ->with('success','good deleted successfully');
    }
}
