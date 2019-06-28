<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsers extends FormRequest
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
        // 验证 用户 信息
        return [
            'uname' => 'required|unique:users|regex:/^[a-zA-Z]{1}[\w]{5,17}$/',            
            'phone' => 'required|regex:/^1{1}[3-8]{1}[\d]{9}$/',
            // 'profile' => 'required',
            // 'email' => 'required|email',
            
        ];
    }

   /**
    *  自定义 错误 消息
    */
     public function messages()
     {
        // 返回 自定义 错误 消息
        return [
            'uname.required'=>'用户名必填',
             'uname.regex'=>'用户名格式错误',             
             'uname.unique'=>'用户名已存在',             
             'phone.required'=>'手机号码必填',
             'phone.regex'=>'手机号码格式错误',
              // 'email.required'=>'邮箱必填',
              // 'email.email'=>'邮箱格式错误',            
             // 'profile.required'=>'头像必填',
         ];
     }
}
