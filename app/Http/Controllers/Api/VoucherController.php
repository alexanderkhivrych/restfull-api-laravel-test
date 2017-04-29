<?php

namespace App\Http\Controllers\Api;

use App\Voucher;
use \Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VoucherController extends ApiController
{
    /**
     * Create voucher
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $voucher = $request->all();

        $validator = Validator::make($voucher, [
            'discount_id' => 'numeric|required|exists:discounts,id',
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date|after:start_date',
        ]);

        if ($validator->fails()) {
            return $this->error(
                Response::HTTP_BAD_REQUEST,
                $validator->messages()
            );
        }

        try {
            $result = Voucher::create([
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

        return $this->success(Response::HTTP_CREATED, $result);
    }

    /**
     * Update voucher
     *
     ** @param integer $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Delete voucher
     *
     * @param integer $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
