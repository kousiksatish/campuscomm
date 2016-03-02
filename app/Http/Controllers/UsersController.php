<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Users as Users;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
        $username = $request->username;
        $password = $request->password;
        $GCM_Id = $request->gcmid;
        $AD_Id = $request->ad_id;
        $shellcmd = "python2 nitt_imap_login.py ".$username." ".$password;
        $imap = shell_exec($shellcmd);
        if($imap == 1)
        {   
            /*(1) Same Username, GCMId, AdId */
            $user_exists = Users::where('Username', $username)
                                ->where('GCM_ID', $GCM_Id)
                                ->where('Ad_ID', $AD_Id)
                                ->first();
            if ($user_exists)
                return response()->json(['status' => '200', 'data' => ['description' => 'Successfully authenticated!']]);
            /*(1) Ends withiout adding anything in DB*/

            /*(2) Same AdId or Same Device*/
            $user_device_exists = Users::where('Ad_ID', $AD_Id)->first();
            if($user_device_exists)
            {
                $user_device_exists->GCM_Id = $GCM_Id;
                $user_device_exists->Username = $username;
                $user_device_exists->save();
                return response()->json(['status' => '200', 'data' => ['description' => 'Successfully authenticated!']]);
            }
            /*(2) Ends modifying GCM_Id and Username for the devide */
            
            $user = new Users();
            $user->Username = $username;
            $user->GCM_ID = $GCM_Id;
            $user->AD_ID = $AD_Id;
            $user->path = "btech/cse/14";
            $user->save();

            return response()->json(['status' => '200', 'data' => ['description' => 'Successfully authenticated!']]);
        }
        else
        {
            return response()->json(['status' => '101', 'data' => ['description' => 'Invalid username or password!']]);
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
