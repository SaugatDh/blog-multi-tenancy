<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // $postId part makes it ignore the current post's own slug on update
        $postId = $this->route('post')?->id;
        return [
            'title'     => 'required|string|max:255',
            'body'      => 'required|string',
            'published' => 'sometimes|boolean',
            'excerpt' => 'nullable|string|max:500',
            // 'unique:posts,slug,' . $postId becomes → 'unique:posts,slug,1'
            // SELECT COUNT(*) FROM posts WHERE slug = 'hello-world' AND id != 1
            'slug' => 'nullable|string|unique:posts,slug,' . $postId,
        ];
    }
}
