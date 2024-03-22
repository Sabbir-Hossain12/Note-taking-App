<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data= Note::where('user_id', Auth::id())->with('user')->get();

        foreach ($data as $single) {


            $formattedCreationDate = Carbon::parse($single->posted_at)->format('d M Y');
            $formattedModifiedDate = Carbon::parse($single->deadline)->format('d M Y');
            // Add the formatted created_at date to the data
            $single->formatted_created_at = $formattedCreationDate;
            $single->formatted_modified_at = $formattedModifiedDate;

        }
        if (!$data) {
            return response()->json(['message' => 'No data found'], 404);
        }
        return response()->json(['data' => $data], 200);
    }
    public function noteCount()
    {

        $data= Note::where('user_id', Auth::id())->count();
        return response()->json(['data' => $data], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string',
            'content' => 'required',

        ]);

        try {
            Note::create([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'user_id' => Auth::user()->id,


            ]);

            return response()->json(['message' => 'success'], 201);

        } catch (Exception $exception)
        {
            return response()->json(['message' => 'Something went wrong'], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data= Note::find($id);

        if (!$data) {
            return response()->json(['message' => 'No data found'], 404);
        }
        return response()->json(['data' => $data,'message' => 'success'], 200);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        try {
            Note::where('id',$id)->update([
                'title' => $request->input('title'),
                'content' => $request->input('content')
            ]);

            return response()->json(['message' => 'success'], 200);
        }
        catch (Exception $exception)
        {
            return response()->json(['message' => 'Something went wrong'], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try {
            Note::where('id',$id)->delete();
            return response()->json(['message' => 'success'], 200);
        }
        catch (Exception $exception)
        {
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }

    public function search(Request $request)
    {

        $data= Note::where('title','like','%'.$request->content.'%')->whereOr('content','like','%'.$request->content.'%')->get();
        if (!$data) {
            return response()->json(['message' => 'No data found'], 404);
        }
        return response()->json(['data' => $data], 200);
    }


}
