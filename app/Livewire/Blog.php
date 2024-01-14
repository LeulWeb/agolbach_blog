<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Blog as ModelBlog;
use Livewire\WithPagination;

class Blog extends Component
{
    use WithPagination;

    public $search;



    public function delete(ModelBlog $blog){
        $blog->delete();
    }

    public function render()
    {
        return view('livewire.blog', [
            'blogList'=>ModelBlog::search($this->search)->latest()->paginate(5),
        ]);
    }
}
