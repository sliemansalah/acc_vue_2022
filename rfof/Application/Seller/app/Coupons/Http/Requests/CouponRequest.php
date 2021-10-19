<?php


namespace Rfof\Seller\Coupons\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CouponRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'code' => 'required',
            'is_percent' => 'required|boolean',
            'value' => 'nullable|numeric|min:0|max:99999999999999',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'status' => 'required|boolean',
            'usage_limit_per_coupon' => 'nullable|numeric|min:0|max:4294967295',
            'usage_limit_per_customer' => 'nullable|numeric|min:0|max:4294967295',
        ];
    }
}
