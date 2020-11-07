<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;

class CartController extends Controller
{
    private $cart;

    /**
    * Create a new cart instance.
    *
    * @return void
    */
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'cart.id_user' => 'required',
            'cart.id_product' => 'required',
        ]);

        $data = $request->all();

        try {

            $cart = $this->cart->create($data['cart']);

            return response()->json(
                Msg::getSucess("Produto inserido no carrinho com sucesso!"),
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                Msg::getError("Ocorreu um erro ao inserir produto no carrinho, contate o administrador"),
                500
            );
        }

    }

    public function show($id_user)
    {
        try {

            $product = Products::where('id_user',$id_user);

            if ($product) {
                return response(new ProductResource($product));
            }

            return response()->json(
                Msg::getError("Não há produtos no carrinho"),
                404
            );
        } catch (\Exception $e) {
            return response()->json(
                Msg::getError("Ocorreu um erro na busca, contate o administrador"),
                500
            );
        }

    }

    public function destroy($id)
    {
        $cart = $this->cart->find($id);

        $cart->delete();

        return response()->json(
            Msg::getSucess("Produto foi removido do carrinho com sucesso!"),
            200
        );

    }

    public function destroyAll($id_user)
    {
        $cart = $this->cart->where('id_user',$id_user);

        $cart->delete();

        return response()->json(
            Msg::getSucess("O carrinho foi esvaziado com sucesso!"),
            200
        );

    }

}
