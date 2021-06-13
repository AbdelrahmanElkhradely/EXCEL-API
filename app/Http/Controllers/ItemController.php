<?php

namespace App\Http\Controllers;

use App\Exports\ItemsExport;
use Illuminate\Http\Request;
use App\Models\Items;
use App\Imports\ItemsImport;
use Maatwebsite\Excel\Facades\Excel;
class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $excel;
    public function __construct(\Maatwebsite\Excel\Excel $excel)
    {
        $this->excel=$excel;
    }

    public function index()
    {
        return Items::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $item=  Items::create($request->all());
      return $item;
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
        return Items::find($id);
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
        //
        $item=Items::find($id);
        $item->update($request->all());
        return $item;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        return Items::destroy($id);
    }


    public function export(){
        return $this->excel->download(new ItemsExport('cat') , 'items.xlsx');
    }


}
