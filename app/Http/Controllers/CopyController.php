<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CopyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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

    public function bookCopyCount($title){
        $copies = DB::table('copies as c')	//egy tábla lehet csak
	  //->select('mezo_neve')		//itt nem szükséges
        ->join('books as b' ,'c.book_id','=','b.book_id') //kapcsolat leírása, akár több join is lehet
        ->where('b.title','=', $title) 	//esetleges szűrés
        ->count();				//esetleges aggregálás; ha select, akkor get() a vége
        return $copies;
    }

}
