<?php

namespace App\Livewire\Admin\Brand;
use App\Models\Brand;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Index extends Component
{
    public $name;
    public  $slug ;
    public $status;
    public function rules () {
        return [
            'name' => 'required',
            'slug' => 'required',
            'status' => 'nullable',
        ];
    }
    public function storeBrand() {
        $validated = $this->validate();
        $validated['status'] = $validated['status'] == 'published' ? '1' : '0';
        Brand::create($validated);

       
        return   redirect('admin/brand');
    }
    public function render()
    {
        $brands = Brand::all();
        return view('livewire.admin.brand.index', compact('brands'))->extends('layout.admin')->section('content');
    }
}

