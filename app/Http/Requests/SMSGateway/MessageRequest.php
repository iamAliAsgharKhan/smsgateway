<?php

namespace App\Http\Requests\SMSGateway;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'messageId' => 'sometimes|required|integer|exists:messages,id',
            'sender' => 'sometimes|required|max:20',
            'receipent' => 'required|max:20',
            'content' => 'required|max:1000'
        ];
    }
}
