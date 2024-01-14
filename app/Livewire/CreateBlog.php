<?php

namespace App\Livewire;

use App\Models\Blog;
use Illuminate\Validation\Rules\Unique;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CreateBlog extends Component
{

    use WithFileUploads;

    #[Rule('required|min:5')]
    public $title = '';

    private $imageName=null;


    #[Rule("required|min:30")]
    public $description = '';


    #[Rule('nullable|sometimes|image|max:7168')]
    public $image;


    protected $rules = [
        'title' => 'required|min:5',
        'description' => 'required|min:30',
    ];





    public function save()
    {
     $this->validate();


     if (isset($this->image)) {
            $this->imageName = uniqid().'.'.$this->image->extension();
            $this->image->storeAs('blogPictures', $this->imageName, 'public');
        }

        Blog::create([
            'title' => $this->title,
            'description' => $this->description,
            'image' => 'blogPictures/'.$this->imageName,
        ]);


        $this->reset();

        session()->flash('success','New blog created');
        return redirect()->route('blog');
    }


    public function render()
    {
        return view('livewire.create-blog');
    }
}
