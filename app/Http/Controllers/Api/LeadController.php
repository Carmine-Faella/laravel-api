<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NewContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\Lead;

class LeadController extends Controller
{
    public function store(Request $request){

        $data = $request->all();

        $validator = Validator::make($data,
        [
            'name'=>'required',
            'email'=>'required|email',
            'message'=>'required'
        ]);

        if($validator->fails()){
            return response()->json(
                [
                    'success'=>false,
                    'errors'=>$validator->errors()
                ]
                );
        }

        $newlead = new Lead();
        $newlead->fill();
        $newlead->save();

        Mail::to('info@carminefaella.it')->send(new NewContact($newlead));

        return response()->json(
            [
                'success' => true
            ]
            );
    }
}
