<?php

namespace App\Interfaces\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
        /*
         * Определяем правила валидации для новостей
         */
        $rules = [
            'title' => 'required|string|unique:news,title',
            'text' => 'required',
            'short_text' => 'required|string|max:255',
            'date_publish' => 'required|date',
            'status' => 'required|in:1,0',
            'image_file_name' => 'required|string|unique:news,title'
        ];

        /*
         * Исходя от запроса правила валидации для новостей могут немного отличаться
         */
        switch ($this->getMethod())
        {
            case 'POST':
                return $rules;
            case 'PUT':
                return $rules;
            case 'PATCH':
                return $rules;
            case 'DELETE':
                return [
                    'id' => 'required|integer|exists:news,id'
                ];
        }
        return $rules;
    }

    /*
     * Переопределяем сообщения с ошибками валидации
     */
    public function messages()
    {
        return [
            'date.required' => 'Данные обязательны',
            'date.unique'  => 'Это поле должно быть уникально',
        ];
    }
}
