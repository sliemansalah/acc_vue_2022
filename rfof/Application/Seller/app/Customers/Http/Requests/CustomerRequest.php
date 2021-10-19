<?php


namespace Rfof\Seller\Customers\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class CustomerRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'email' => ['required', Rule::unique('customers')],
            'mobile' => ['required', Rule::unique('customers')],
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'هذا الحقل مطلوب',
            'last_name.required' => 'هذا الحقل مطلوب',
            'email.required' => 'هذا الحقل مطلوب',
            'mobile.required' => 'هذا الحقل مطلوب',
            'email.unique' => 'البريدالالكتروني موجود مسبقا',
            'mobile.unique' => 'رقم الهاتف موجود مسبقا',
            'password' => 'هذا الحقل مطلوب',
        ];
    }

    public function rulesUpdate()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'mobile' => ['nullable', 'unique:customers,mobile,'. request()->route('id')],
            'email' => ['nullable', 'unique:customers,email,'. request()->route('id')],
        ];
    }
}
