<?php

namespace App\Http\Livewire;

use App\Models\SubAlbum;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddAlbumToAlbum extends Component
{
    use WithFileUploads;

    public $title;
    public $details;
    public $image;
    public $content;

    public $album_id;


    public function mount($id)
    {
        $this->album_id = $id;
    }

    public function updated($field)
    {
        $this->validateOnly($field, [
            'title'   => 'required|max:255',
            'details' => 'required|max:1000',
            'content' => 'required|max:1000',
            'image'   => 'required|file|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }

    public function save()
    {
        $this->validate([
            'title'   => 'required|max:255',
            'details' => 'required|max:1000',
            'content' => 'required|max:1000',
            'image'   => 'required|file|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //Store the image and return the name
        $image = $this->storeFile($this->image);

       $album =  SubAlbum::create([
            'album_id' => $this->album_id,
            'title'    => $this->title,
            'content'  => $this->content,
            'details'  => $this->details,
            'image'    => $image
        ]);

        session()->flash('message', 'Album created.');
        redirect()->route('sub-album.edit', $album->id);
//        $this->clear(); //clear user inputs
//        return $this->emit('alert', ['type' => 'success', 'message' => 'Album created!']);
    }

    public function storeFile($file)
    {
        $img = ImageManagerStatic::make($file)->encode('jpg', 2);
        $original_filename = $file->getClientOriginalName();
        $name = time() .Str::random(50).'_'.$original_filename;
        Storage::disk('public')->put($name, $img);
        return $name;
    }

    public function clear()
    {
        $this->title    = '';
        $this->details  = '';
        $this->image    = '';
        $this->content  = '';
    }

    public function render()
    {
        return view('livewire.admin.components.add-album-to-album');
    }
}
