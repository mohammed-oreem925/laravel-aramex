<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AramexCredential;
use App\Models\User;
use Illuminate\Http\Request;

class AramexCredentialController extends Controller
{

    public function createCredential($id)
    {
        $user = User::select(['id', 'name'])->find($id);
        if (!$user) {
            return back()->with('message', 'User Not Found!');
        }
        $aramexCredential = AramexCredential::where('user_id', $id)->first();
        if ($aramexCredential) {
            return back()->with('message', 'This user already has a credential');
        }
        return view('aramex_credentials/create', compact('user'));
    }

    public function storeCredential(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'country_code' => 'required|string|size:2',
            'entity' => 'required|string|size:3',
            'testNumber' => 'nullable|required_without:liveNumber|required_with:testPin|string',
            'liveNumber' => 'nullable|required_without:testNumber|required_with:livePin|string',
            'testPin' => 'nullable|required_without:livePin|required_with:testNumber|string',
            'livePin' => 'nullable|required_without:testPin|required_with:liveNumber|string',
            'user_id' => 'required|string',
        ]);
        // check if there is any crednetial with this user_id if so return back with a message
        $aramexCredential = AramexCredential::where('user_id', $request->input('user_id'))->first();
        if ($aramexCredential) {
            return back()->with('message', 'You already have a credential');
        }
        // check if there is any crednetial with this username if so return back with a message
        $aramexCredential = AramexCredential::where('username', $request->input('username'))->first();
        if ($aramexCredential) {
            return back()->with('message', 'This username is already taken');
        }

        $aramexCredential = AramexCredential::create($request->all());
        return redirect('/aramex/credentials/' . $aramexCredential->id);
    }

    public function credentialIndex($id)
    {
        $credential = AramexCredential::with('user:id,name')->find($id);
        if (!$credential) {
            return back()->with('message', 'Credential Not Found!');
        }
        return view('aramex_credentials/index', compact('credential'));
    }

    public function credentialEdit($id)
    {
        $credential = AramexCredential::find($id);
        if (!$credential) {
            return back()->with('message', 'Credential Not Found!');
        }
        return view('aramex_credentials/edit', compact('credential'));
    }

    public function credentialUpdate(Request $request)
    {
        $request->validate([
            'id' => 'required|string',
            'username' => 'required|string',
            'password' => 'required|string',
            'country_code' => 'required|string|size:2',
            'entity' => 'required|string|size:3',
            'testNumber' => 'required_without:liveNumber|required_with:testPin|string',
            'liveNumber' => 'required_without:testNumber|required_with:livePin|string',
            'testPin' => 'required_without:livePin|required_with:testNumber|string',
            'livePin' => 'required_without:testPin|required_with:liveNumber|string',
        ]);
        $credential = AramexCredential::find($request->id);
        if (!$credential) {
            return back()->with('message', 'Credential Not Found!');
        }
        $credential->update([
            'username' => $request->username,
            'password' => $request->password,
            'country_code' => $request->country_code,
            'entity' => $request->entity,
            'testNumber' => $request->testNumber,
            'liveNumber' => $request->liveNumber,
            'testPin' => $request->testPin,
            'livePin' => $request->livePin,
            'isTest' => $request->input('isTest') ? true : false,
            'active' => $request->input('active') ? true : false,
        ]);
        return redirect('/users');
    }
}
