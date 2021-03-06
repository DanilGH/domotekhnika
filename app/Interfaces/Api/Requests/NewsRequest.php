<?php

namespace App\Interfaces\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NewsRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
    /**
     * Определяем правила валидации для новостей
     */
        $rules = [
            'title' => 'required|string|unique:news,title',
            'text' => 'required',
            'short_text' => 'required|string|max:255',
            'date_publish' => 'required|date',
            'status' => 'required|in:1,0',
            'image_file_name' => 'required|string'
        ];

    /**
     * Исходя от запроса правила валидации для новостей могут немного отличаться
     */
        switch ($this->getMethod())
        {
            case 'POST':
                return $rules;
            case 'PUT':
                return [
                    'id' => 'required|integer|exists:news,id',
                    'title' => [
                        'required',
                        Rule::unique('news')->ignore($this->title, 'title')
                    ]
                ] + $rules;
            case 'PATCH':
                return $rules;
            case 'DELETE':
                return [
                    'id' => 'required|integer|exists:news,id'
                ];
        }
        return $rules;
    }

    /**
     * Переопределяем сообщения с ошибками валидации
     */
    public function messages()
    {
        return [
            'title.unique' => 'Такое поле title уже существует',
            'status.in'  => 'Это поле может содержать только 1 или 0',
        ];
    }

    public function all($keys = null)
    {
        $data = parent::all($keys);
        switch ($this->getMethod())
        {
            case 'DELETE':
                $data['id'] = $this->route('news');
                break;
        }
        return $data;
    }

}
