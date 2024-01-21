<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AramexCredential;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAramexCredentialRequest;
use App\Http\Requests\UpdateAramexCredentialRequest;

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

    public function storeCredential(StoreAramexCredentialRequest $request)
    {
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

    public function credentialUpdate(UpdateAramexCredentialRequest $request)
    {
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
