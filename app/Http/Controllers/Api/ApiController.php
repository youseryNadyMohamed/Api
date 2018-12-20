<?php

namespace App\Http\Controllers\Api;

use App\Movie;
use App\Rules\RateValidate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Validator;
class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Movie::all();
        return response()->json(['data'=>$data,'status'=>true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function create(Request $request)
//    {
//
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'Rating' => [new RateValidate(),'numeric','required'],
            'ImageURL' => ['image','required'],
            'Title' => ['required'],
            'Description' => ['required'],
            'Genre' => ['required'],
            'ReleaseYear' => ['required'],
            'GrossProfit' => ['required'],
            'Director' => ['required'],
            'MainActorsList' => ['required'],
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors(),'status'=>false]);
        }
        $data=$request->all();
        $data['ImageURL']=$request->file('ImageURL')->store('image');
        $data['Genre']=implode(',',$data['Genre']);
        $datainsert=Movie::create($data);
        return response()->json(['data'=>$datainsert,'status'=>true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $movie=Movie::find($id);
        return response()->json(['data'=>$movie,'status'=>true]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function edit($id)
//    {
//        //
//    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'Rating' => [new RateValidate(),'numeric','required'],
            'ImageURL' => ['image','required'],
            'Title' => ['required'],
            'Description' => ['required'],
            'Genre' => ['required'],
            'ReleaseYear' => ['required'],
            'GrossProfit' => ['required'],
            'Director' => ['required'],
            'MainActorsList' => ['required'],
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors(),'status'=>false]);
        }
        $data=$request->all();
        $data['ImageURL']=$request->file('ImageURL')->store('image');
        $data['Genre']=implode(',',$data['Genre']);

       $dataupdated=Movie::find($id)->update($data);
        return response()->json(['data'=>$dataupdated,'status'=>true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie=Movie::find($id)->delete();
        return response()->json(['data'=>$movie,'status'=>true]);

    }



    public function showmoviewithnum(Request $request)
    {
        if($request->pagen){

            $data=Movie::paginate($request->pagen);
        }
        else{
            $data=Movie::paginate(5);

        }
        return response()->json(['data'=>$data,'status'=>true]);
    }
    public function showmoviewithcriteria(Request $request)
    {
        if($request->pagen){

            $data=Movie::orderBy($request->criteria)->paginate($request->pagen);

        }
        else{
            $data=Movie::orderBy($request->criteria)->paginate(5);

        }
        return response()->json(['data'=>$data,'status'=>true]);
    }
    public function filter(Request $request)
    {
       $data= Movie::where('Genre','like', '%' . $request->filter . '%')->get();
        return response()->json(['data'=>$data,'status'=>true]);
    }
}
