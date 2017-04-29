<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Product;

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
        $this->success(Response::HTTP_OK, $data);
    }


    /**
     * Create product
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $voucher = $request->all();

        $validator = Validator::make($voucher, [
            'name' => 'required',
            'price' => 'required:decimal',
        ]);

        if ($validator->fails()) {
            return $this->error(
                Response::HTTP_BAD_REQUEST,
                $validator->messages()
            );
        }

        try {
            Product::create([
                'discount_id' => $voucher['discount_id'],
                'start_date' => $voucher['start_date'],
                'end_date' => $voucher['end_date'],
            ]);
        } catch (\Exception $exception) {
            return $this->error(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                $exception->getMessage()
            );
        }
        return response()->json(Response::HTTP_OK);
    }


    /**
     * Update product
     *
     * @param integer $id
     *
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Delete product
     *
     * @param integer $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
