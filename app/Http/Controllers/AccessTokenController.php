<?php

namespace App\Http\Controllers;

use App\AccessToken;
use Illuminate\Http\Request;

class AccessTokenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $tkn = new AccessToken();
        $tkn->token = $request->token;
        $tkn->save();
        $tkn1 = AccessToken::where('token', '=', $tkn->token);
        return response()->json([
            'status' => 'seccess',
            'data' => $tkn1->id,
        ]);
    }
    public function token(Request $request) {
        $tkn = AccessToken::find($request->tkn);
        return response()->json([
            'status' => 'seccess',
            'data' => $tkn,
        ]);
    }
}
