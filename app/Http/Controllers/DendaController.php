<?php

namespace App\Http\Controllers;

use App\Models\Denda;
use Illuminate\Http\Request;

class DendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dendas = Denda::latest()->paginate(100);

        return view('dendas.index',compact('dendas'));

        //->with('i',(request()->input('page',1)-1)*5);//
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dendas = Denda::all();
        return view('dendas.create',compact('dendas',$dendas));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nilai'=>'required',
            'is_enable'=>'required'
        ]);

        Denda::create($request->all());
        return redirect()->route('dendas.index');
                        //->with('success','Jumlah Denda Sudah Ada !');//
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Denda  $denda
     * @return \Illuminate\Http\Response
     */
    public function show(Denda $denda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Denda  $denda
     * @return \Illuminate\Http\Response
     */
    public function edit(Denda $denda)
    {
        $dendas = Denda::all();
        return view('dendas.edit', compact('denda', 'dendas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Denda  $denda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Denda $denda)
    {
        $request->validate([
            'nilai'=>'required',
            'is_enable'=>'required'
        ]);

        $denda->update($request->all());
        return redirect()->route('dendas.index');
                        //->with('success','Berhasil di Edit !');//
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Denda  $denda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Denda $denda)
    {
        $denda->delete();

        return redirect()->route('dendas.index');
                        //->with('success','Berhasil Hapus !');//
    }
}
