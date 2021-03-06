<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Game;
use App\Account;
use App\Socmed;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::with(['account'])->orderBy('name', 'asc')->get();

        return $games;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'password' => 'required'
        ]);

        $account = Account::create([
            'user_id' => 1,
            'game_id' => $request->game_id,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'description' => $request->description
        ]);

        return $account;
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $account = Account::findOrFail($id);

        $account->update([
            'game_id' => $request->game_id,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'description' => $request->description,
        ]);

        return $account;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $account  = Account::findOrFail($id);

        $account->delete();

        return [
            'msg' => 'deleted'
        ];
    }
}
