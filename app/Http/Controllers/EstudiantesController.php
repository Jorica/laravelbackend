<?php

namespace App\Http\Controllers;

use App\Models\estudiantes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstudiantesController extends Controller
{
    
    public function create(Request $request)
    {
        try {
            $req = $request->all();

            $result = DB::table('estudiantes')->insertGetId([
                'nombre' => $req['nombre'],
                'nota_parcial_1' => $req['nota_parcial_1'],
                'nota_parcial_2' => $req['nota_parcial_2'],
                'nota_parcial_3' => $req['nota_parcial_3'],
                'nota_final' => $req['nota_final']
            ], 'id');


            if($result){
                return response()->json([
                    'mensaje' => 'Se registro con éxito.',
                    'data' => $result
                ],200);
            }else{
                return response()->json([
                    'error' => 'No se encontró el estudiante.'
                ],204);
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'trace' => $e->getTrace()
            ],400);
        }
    }


    public function show()
    {
        try {

            $result = DB::table('estudiantes')->get();

            if($result){
                return response()->json( $result ,200);
            }else{
                return response()->json('',204);
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'trace' => $e->getTrace()
            ],400);
        }
        
    }


    public function edit(Request $request)
    {
        try {
            $req = $request->all();

            $result = DB::table('estudiantes')->where('id', $req['id'])->update([
                'nombre' => $req['nombre'],
                'nota_parcial_1' => $req['nota_parcial_1'],
                'nota_parcial_2' => $req['nota_parcial_2'],
                'nota_parcial_3' => $req['nota_parcial_3'],
                'nota_final' => $req['nota_final']
            ]);

            if($result){
                return response()->json([
                    'mensaje' => 'Se actualizo con éxito.'
                ],200);
            }else{
                return response()->json([
                    'error' => 'No se encontró el estudiante.'
                ],204);
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'trace' => $e->getTrace()
            ],400);
        }
    }

   
    public function destroy(Request $request)
    {
        try {
            $req = $request->all();

            $result = DB::table('estudiantes')->where('id', $req['id'])->delete();

            if($result){
                return response()->json([
                    'mensaje' => 'Se elimino con éxito.'
                ],200);
            }else{
                return response()->json([
                    'error' => 'No se encontró el estudiante.'
                ],204);
            }

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'trace' => $e->getTrace()
            ],400);
        }
    }

    public function getEstudiante (Request $request)
    {
        try {
            $req = $request->all();

            $result = DB::table('estudiantes')->where('id', $req['id'])->first();

            if($result){
                return response()->json([
                    'data' => $result
                ],200);
            }else{
                return response()->json([
                    'error' => 'No se encontró el estudiante.'
                ],204);
            }
            
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'trace' => $e->getTrace()
            ],400);
        }
    }
}
