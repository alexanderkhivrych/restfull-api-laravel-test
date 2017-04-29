<?php

namespace App\Http\Controllers\Api;

use App\Product;
use \Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ProductController extends ApiController
{
    /**
     * Get product list
     *
     * @return Response
     */
    public function index()
    {
        $data = Product::all();
        return $this->success(Response::HTTP_OK, $data);
    }

    /**
     * Create product
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $product = $request->all();
        $validator = Validator::make($product, [
            'name' => 'string|max:255|required',
            'price' => 'numeric|required',
        ]);

        if ($validator->fails()) {
            return $this->error(
                Response::HTTP_BAD_REQUEST,
                $validator->messages()
            );
        }

        try {
            $result = Product::create($product);
        } catch (\Exception $exception) {
            return $this->error(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                $exception->getMessage()
            );
        }

        return $this->success(Response::HTTP_CREATED, $result);
    }

    /**
     * Unbind voucher
     *
     * @param integer $productId
     * @param integer $voucherId
     * @return Response
     */
    public function unbindVoucher(int $productId, int $voucherId) {
        $validator = Validator::make([
            'productId'=> $productId,
            'voucherId' => $voucherId
        ], [
            'voucherId' => 'numeric|required|exists:product_voucher,voucher_id',
            'productId' => 'numeric|required|exists:product_voucher,product_id',
        ]);

        if ($validator->fails()) {
            return $this->error(
                Response::HTTP_BAD_REQUEST,
                $validator->messages()
            );
        }

        try {
            $product = Product::find($productId);
            $product->vouchers()->detach($voucherId);
        } catch (\Exception $exception) {
            return $this->error(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                $exception->getMessage()
            );
        }

        return $this->success(Response::HTTP_OK);

    }

    /**
     * Bind voucher
     *
     * @param integer $productId
     * @param integer $voucherId
     * @return Response
     */
    public function bindVoucher(int $productId, int $voucherId) {
        $validator = Validator::make([
            'productId'=> $productId,
            'voucherId' => $voucherId
        ],[
            'voucherId' => 'numeric|required',
            'productId' => 'numeric|required',
        ]);

        if ($validator->fails()) {
            return $this->error(
                Response::HTTP_BAD_REQUEST,
                $validator->messages()
            );
        }

        try {
            $product = Product::find($productId);
            $product->vouchers()->attach($voucherId);
        } catch (\Exception $exception) {
            return $this->error(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                $exception->getMessage()
            );
        }

        return $this->success(Response::HTTP_OK);

    }

    /**
     * Delete product
     *
     * @param integer $id
     * @return Response
     */
    public function destroy(int $id)
    {
        $validator = Validator::make([
            'id'=> $id,
        ], [
            'id' => 'numeric|required|exists:products',
        ]);

        if ($validator->fails()) {
            return $this->error(
                Response::HTTP_BAD_REQUEST,
                $validator->messages()
            );
        }
        try {
            Product::destroy($id);
        }
        catch (\Exception $exception) {
            return $this->error(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                $exception->getMessage()
            );
        }
        return $this->success(Response::HTTP_OK, $id);
    }

}
