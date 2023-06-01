<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index(){
        $projects = Project::with(['type','tecnologies'])->paginate(3);

        return response()->json([
            'succes'=>true,
            'results'=> $projects
        ]);
    }

    public function show($slug){
        $projects = Project::where('slug',$slug)->with(['type','tecnologies'])->first();

        if($projects){
            return response()->json([
                'success'=>true,
                'results'=> $projects
            ]);
        }else{
            return response()->json([
                'success'=>false,
                'error'=> 'Non trovato'
            ]);
        }
        
    }
}
