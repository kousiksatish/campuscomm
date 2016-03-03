<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Messages as Messages;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetchNew(Request $request)
    {
        //
        $latest_msg_id = $request->latest_msg_id;

        if(!$latest_msg_id)
            return response()->json(['status' => 102, 'data' => ['description' => 'Invalid parameters!']]);

        $messages = Messages::where('id', '>', $latest_msg_id)
                            ->where('spam',0)
                            ->get(['id','Message','Sender','tags','view_count', 'created_at']);

        if(sizeof($messages)==0)
            return response()->json(['status' => 101, 'data' => ['description' => 'No more new messages!']]);
        return response()->json(['status' => 200, 'data' => ['description' => 'Successfully fetched new messages!', 'no_of_messages' => sizeof($messages), 'messages' => $messages]]);


    }
    public function fetchOld(Request $request)
    {
        //
        $oldest_msg_id = $request->oldest_msg_id;
        $no_of_messages = $request->no_of_messages;

        if(!$oldest_msg_id || !$no_of_messages)
            return response()->json(['status' => 102, 'data' => ['description' => 'Invalid parameters!']]);

        $messages = Messages::where('id', '<', $oldest_msg_id)
                            ->where('spam',0)
                            ->orderBy('created_at', 'desc')
                            ->take($no_of_messages)
                            ->get(['id','Message','Sender','tags','view_count', 'created_at']);

        if(sizeof($messages)==0)
            return response()->json(['status' => 101, 'data' => ['description' => 'No more messages!']]);
        return response()->json(['status' => 200, 'data' => ['description' => 'Successfully fetched old messages!', 'no_of_messages' => sizeof($messages), 'messages' => $messages]]);

    }

    public function latestID(Request $request)
    {

        $latestid = Messages::orderBy('id', 'desc')
                            ->first();
        if(sizeof($latestid)==0)
            return response()->json(['status' => 101, 'data' => ['description' => 'No messages in database!']]);
        return response()->json(['status' => 200, 'data' => ['description' => 'Successful!', 'latest_msg_id' => $latestid->id]]);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request)
    {
        //
        
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
        //
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
    }
}
