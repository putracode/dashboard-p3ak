<?php

namespace App\Http\Controllers\Admin;

use App\Models\Aplikasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AplikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.aplikasi.index',['aplikasi' => aplikasi::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.aplikasi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = $this->validate($request,[
            'title' => ['required'],
            'url' => ['required'],
            // 'icon' => ['required'],
        ]);

        // if($request->file('icon')){
        //     $validasi['icon'] = $request->file('icon')->store('icon','public');
        // }

        Aplikasi::create($validasi);
        return redirect('/admin/aplikasi')->with('success','Data added succesfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Aplikasi  $aplikasi
     * @return \Illuminate\Http\Response
     */
    public function show(Aplikasi $aplikasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Aplikasi  $aplikasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Aplikasi $aplikasi)
    {
        return view('admin.aplikasi.edit',['aplikasi' => $aplikasi]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Aplikasi  $aplikasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aplikasi $aplikasi)
    {
        $validasi = $this->validate($request,[
            'title' => ['required'],
            'url' => ['required'],
            // 'icon' => ['image']
        ]);

        // if($request->file('icon')){
        //     if($request->lama){
        //         Storage::disk('public')->delete($aplikasi->icon);
        //     }
        //     $validasi['icon'] = $request->file('icon')->store('icon','public');
        // }

        Aplikasi::where('id',$aplikasi->id)->update($validasi);
        return redirect('/admin/aplikasi')->with('success','Data update succesfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aplikasi  $aplikasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aplikasi $aplikasi)
    {   
        
        if($aplikasi->icon){
            // Storage::delete($aplikasi->icon);
            Storage::disk('public')->delete($aplikasi->icon);
        }

        Aplikasi::destroy($aplikasi->id);
        return redirect('/admin/aplikasi')->with('success','Data deleted succesfully!');
    }
}
