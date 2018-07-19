<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Monster;
use App\Evolution;

class MonstersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $monsters = Monster::all();
        
        return view('monsters.index')->with('monsters',$monsters);
    }


    public function show($id)
    {
        $monster = Monster::find($id)
        ->leftJoin('habitat', 'monsters.habitat', '=', 'habitat.id')
        ->leftJoin('generation', 'monsters.generation', '=', 'generation.id')
        ->leftJoin('abilities as a1', 'monsters.abilityID1', '=', 'a1.id')
        ->leftJoin('abilities as a2', 'monsters.abilityID2', '=', 'a2.id')
        ->leftJoin('abilities as a3', 'monsters.abilityID3', '=', 'a3.id')
        ->where('monsters.id', '=', $id)
        ->select('monsters.id as id', 'monsters.*','habitat.id as habitatid','habitat.name as habitatname','generation.generation as generation_symbol','a1.name as a1name', 'a1.effect as a1effect','a2.name as a2name', 'a2.effect as a2effect','a3.name as a3name', 'a3.effect as a3effect')
        ->first();
        
        $previous = Monster::where('id', '<', $monster->id)->max('id');
        $next = Monster::where('id', '>', $monster->id)->min('id');

        $evolutions = Evolution::find($id)
        ->leftJoin('monsters', 'evolutions.targetMonsterId', '=', 'monsters.id')
        ->where('evolutions.sourceMonsterId', '=', $id)
        ->select('evolutions.*','monsters.*')
        ->get();
        
      


        return view('monsters.show')->with('monster',$monster)->with('previous', $previous)->with('next', $next)->with('evolutions', $evolutions);
    }

    public function evolutions()
    {
        return $this->hasMany('App\Evolution');
    }

   
}
