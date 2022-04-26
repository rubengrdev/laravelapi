<?php

namespace App\Http\Controllers\Api;
use App\Product;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Carreguem tots els productes
        $products = Product::all();
        if($products != null && $products != '[]'){
            return response()->json([
                'message' => $products,
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


        //print(Product::where('title', "Crist-Waters")->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //creamos un nuevo producto
        $reqProduct = new Product();
        //asignamos los valores del request al producto
        $reqProduct->id = $request->id;
        $reqProduct->title = $request->title;
        $reqProduct->description = $request->description;
        $reqProduct->price = $request->price;
        $reqProduct->company_id = $request->company_id;

        //save into database
        $reqProduct->save();

        //este return solamente es para las pruebas del postman, store no
        //debería devolver esto
        return $reqProduct;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //conseguimos todos los datos de el producto referenciado
        $product = Product::where('id', $id)->get();
        //comprovamos que no esté vacio y solo nos devuelva unas llaves sin contenido
        if($product != '[]'){
            return response()->json("{
                'message' => $product,
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
    public function edit(Product $product)
    {
        //return view('produts.edit',['product'=>$product]);
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
        $old = Product::where('id', $id)->get();
        if(Product::where('id', $id)->update($request->all())){
            $new = Product::where('id', $id)->get();
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
    public function destroy(String $id)
    {
        //busca el producto
        $product = Product::find($id);
        //si el producto existe ejecta un delete y retorna un código de estado
        if($product){
            $product->delete();
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


