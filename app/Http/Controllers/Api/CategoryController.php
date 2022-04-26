<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
             //Carreguem tots els productes
             $category = Category::all();
             if($category != null && $category != '[]'){
                 return response()->json([
                     'message' => $category,
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
        return Category::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //creamos una nueva categoria
         $category = new Category();
         //asignamos los valores del request a la nueva categoria
         $category->id = $request->id;
         $category->name = $request->name;
         $category->description = $request->description;

         //save into database
         $category->save();

         //este return solamente es para las pruebas del postman, store no
         //debería devolver esto
         return $category;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
           //conseguimos todos los datos de la cateogria referenciada
           $category = Category::where('id', $id)->get();
           //comprobamos que no esté vacio y solo nos devuelva unas llaves sin contenido
           if($category != '[]'){
               return response()->json("{
                   'message' => $category,
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
        $old = Category::where('id', $id)->get();
        if(Category::where('id', $id)->update($request->all())){
            $new = Category::where('id', $id)->get();
            return response()->json("{
                'oldcategory' => $old,
                'newcategory' => $new,
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
          //busca la categoria
          $category = Category::find($id);
          //si la categoria existe ejecta un delete y retorna un código de estado
          if($category != null){
              try{
              $category->delete();
              return response()->json("{
                  'status' => true,
                  'code' => 200
              }");
            }catch(Exception $ex){
                return response()->json("{
                    'status' => false,
                    'message' => ".$ex->getMessage().",
                    'code' => 400
                  }");
            }
          }else{
            //en el caso de que no se haya podido borrar o no se haya encontrado
            return response()->json("{
              'status' => false,
              'code' => 400
            }");
            }

    }
}
