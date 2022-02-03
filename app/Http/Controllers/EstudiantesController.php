<?php

namespace App\Http\Controllers;

use App\Models\estudiantes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstudiantesController extends Controller
{
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\estudiantes  $estudiantes
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        try {
            $sql='SELECT * FROM estudiantes';
            $result = DB::select(DB::raw($sql));
            
            if($result){
                return response()->json([
                    'data' => $result
                ],200);
            }else{
                return response()->json([
                    'error' => 'No se encontraron registros en la base de datos.'
                ],204);
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'trace' => $e->getTrace()
            ],400);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\estudiantes  $estudiantes
     * @return \Illuminate\Http\Response
     */
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

   
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\estudiantes  $estudiantes
     * @return \Illuminate\Http\Response
     */
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
}
