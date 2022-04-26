<?php

namespace App\Http\Controllers\Api;

use App\Company;
use App\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Company::all();
        if($company != null && $company != '[]'){
            return response()->json([
                'message' => $company,
                'status' => true,
                'code' => 200
            ]);
        }else{
            return response()->json("{
                'message' => 'error not found',
                'status' => false,
                'code' => 404
            }");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Company::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //creamos una nueva compañía
         $reqCompany = new Company();
         //asignamos los valores del request a la compañia
         $reqCompany->id = $request->id;
         $reqCompany->name = $request->name;
         $reqCompany->address = $request->address;
         $reqCompany->desc = $request->desc;

         //save into database
         $reqCompany->save();

         //este return solamente es para las pruebas del postman, store no
         //debería devolver esto
         return $reqCompany;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //conseguimos todos los datos de la compañía referenciada
        $company = Company::where('id', $id)->get();
        //comprovamos que no esté vacio y solo nos devuelva unas llaves sin contenido
        if($company != '[]'){
            return response()->json("{
                'message' => $company,
                'status' => true,
                'code' => 200
            }");
        }else{
            //no cuadra
            return response()->json("{
                'message' => '".$id." was not found',
                'status' => false,
                'code' => 404
            }");
        }
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
        $old = Company::where('id', $id)->get();
        if(Company::where('id', $id)->update($request->all())){
            $new = Company::where('id', $id)->get();
            return response()->json("{
                'oldproduct' => $old,
                'newproduct' => $new,
                'status' => true,
                'code' => 200
            }");
        }else{
            return response()->json("{
                'message' => '".$id." was not found',
                'status' => false
            }");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            //busca de la compañía
            $company = Company::find($id);
            //si el producto existe ejecta un delete y retorna un código de estado
            if($company){
                $product = Product::where('company_id', 'like', $company->id)->get();


                    //recorremos el array de productos y los eliminamos
                    foreach($product as $p){
                        $p->delete();
                    }
                    //eliminamos la comañía posteriormente
                    $company->delete();
                    $company->delete();
                    return response()->json("{
                        'status' => true,
                        'code' => 200
                    }");
            }
            //en el caso de que no se haya podido borrar o no se haya encontrado
            return response()->json("{
                'status' => false,
                'code' => 400
            }");

    }
}
