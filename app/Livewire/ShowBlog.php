<?php

namespace App\Livewire;

use App\Models\Blog;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ShowBlog extends Component
{
    use WithFileUploads;

    public Blog  $blog;



    #[Rule('required|min:5')]
    public $title = '';

    private $imageName = null;


    #[Rule("required|min:30")]
    public $description = '';


    #[Rule('nullable|sometimes|image|max:7168')]
    public $image;



    public $editMode = false;


    public function toggle()
    {
        $this->editMode = !$this->editMode;
    }

    public function delete()
    {
        $this->blog->delete();
        session()->flash('success', 'Blog deleted successfully.');

        return redirect()->route("blog", true);
    }


    public function mount($id)
    {
        $this->blog = Blog::findOrFail($id);

        $this->title = $this->blog->title;
        $this->description = $this->blog->description;

        // if(!empty($this->blog->image)){
        //     $this->image = $this->blog->image;
        // }
    }



    public function save()
    {
        $this->validate();


        if (isset($this->image)) {
            $this->imageName = uniqid() . '.' . $this->image->extension();
            $this->image->storeAs('blogPictures', $this->imageName, 'public');
            $this->imageName = 'blogPictures/' . $this->imageName;
        } else {
            $this->imageName = $this->blog->image;
        }

        $this->blog->update([
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->imageName,
        ]);

        session()->flash('success', 'Blog updated successfully.');
        return redirect()->route("blog", true);
    }

    public function render()
    {
        return view(
            'livewire.show-blog',
        );
    }
}
