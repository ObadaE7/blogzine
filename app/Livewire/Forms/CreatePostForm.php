<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class CreatePostForm extends Form
{
    public $categories = [];
    public  $tags = [];
    public  $statuses = [];

    #[Validate('required|string|min:5|max:100')]
    public $title;

    #[Validate('required|string|min:5|max:150')]
    public $subtitle;

    #[Validate('required|string|alpha_dash|min:5|max:120|unique:posts,slug')]
    public $slug;

    #[Validate('required|string|min:10|max:10000')]
    public $content;

    #[Validate('required|file|image|max:1024|mimes:jpeg,png,jpg')]
    public $image;
    public $existingImage;

    #[Validate('required|integer|exists:categories,id')]
    public $category_id;

    #[Validate('required|array|exists:tags,id')]
    public $tag_ids = [];

    #[Validate('required|string|in:draft,published')]
    public $status;

    protected $messages = [
        'title.required' => 'The title is required.',
        'title.string' => 'The title must be a string.',
        'title.max' => 'The title may not be greater than 100 characters.',
        'subtitle.required' => 'The subtitle is required.',
        'subtitle.string' => 'The subtitle must be a string.',
        'subtitle.max' => 'The subtitle may not be greater than 150 characters.',
        'slug.required' => 'The slug is required.',
        'slug.string' => 'The slug must be a string.',
        'slug.alpha_dash' => 'The slug may only contain letters, numbers, dashes, and underscores.',
        'slug.max' => 'The slug may not be greater than 120 characters.',
        'slug.unique' => 'The slug has already been taken.',
        'content.required' => 'The content is required.',
        'content.string' => 'The content must be a string.',
        'content.min' => 'The content must be at least 10 characters.',
        'content.max' => 'The content may not be greater than 10000 characters.',
        'image.required' => 'An image is required.',
        'image.image' => 'The file must be an image.',
        'image.mimes' => 'The image must be a file of type: jpg, jpeg, png.',
        'image.max' => 'The image may not be greater than 1024 kilobytes.',
        'category_id.required' => 'The category is required.',
        'category_id.integer' => 'The category ID must be an integer.',
        'category_id.exists' => 'The selected category is invalid.',
        'tag_ids.required' => 'At least one tag is required.',
        'tag_ids.array' => 'The tag ID must be an array.',
        'tag_ids.exists' => 'Each selected tag is invalid.',
        'status.required' => 'The status is required.',
        'status.string' => 'The status must be an string.',
        'status.in' => 'The selected status is invalid.',
    ];
}
