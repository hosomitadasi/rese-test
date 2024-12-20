<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191'],
            'password' => ['required', 'confirmed', 'min:8', 'max:191', Rules\Password::defaults()],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'ユーザー名は必須です',
            'name.string' => 'ユーザー名は文字列の必要があります',
            'name.max' => 'ユーザー名は191字が上限です',
            'email.required' => 'メールアドレスは必須です',
            'email.email' => 'メールアドレスの形式ではございません',
            'email.string' => 'メールアドレスは文字列の必要があります',
            'email.max' => 'メールアドレスは191字が上限です',
            'password.required' => 'パスワードは必須です',
            'password.confirmed' => '確認用と一致しません',
            'password.min' => 'パスワードは最低8文字です',
            'password.max' => 'パスワードは最大191文字です',
        ];
    }
}
