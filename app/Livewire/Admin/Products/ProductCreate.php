<?php

namespace App\Livewire\Admin\Products;

use App\Models\Category;
use App\Models\Family;
use App\Models\Product;
use App\Models\Subcategory;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\WithFileUploads;

class ProductCreate extends Component
{
    use WithFileUploads;

    public $families;
    public $family_id = '';
    public $category_id = '';

    public $image;

    public $product = [
        'sku' => '',
        'name' => '',
        'description' => '',
        'image_path' => '',
        'price' => '',
        'subcategory_id' => '',
    ];

    public function mount()
    {
        $this->families = Family::all();
    }

    public function boot()
    {
        $this->withValidator(function ($validator) {
            
            if ($validator->fails()) {
                $this->dispatch('swal', [
                    'icon' => 'error',
                    'title' => '¡Error!',
                    'text' => 'El formulario contiene errores.'
                ]);
            }

        });
    }

    public function updatedFamilyId($value)
    {
        $this->category_id = '';
        $this->product['subcategory_id'] = '';    
    }

    public function updatedCategoryID($value)
    {
        $this->product['subcategory_id'] = '';    
    }

    #[Computed()]
    public function categories()
    {
        return Category::where('family_id', $this->family_id)->get();
    }

    #[computed()]
    public function subcategories()
    {
        return Subcategory::where('category_id', $this->category_id)->get();
    }
    

    public function store()
    {
        // Validación con mensajes personalizados
        $this->validate([
            'image' => 'required|image|max:1024',
            'product.sku' => 'required|unique:products,sku',
            'product.name' => 'required|max:255',
            'product.description' => 'nullable',
            'product.price' => 'required|numeric|min:0',
            'product.subcategory_id' => 'required|exists:subcategories,id',
        ], [
            // Mensajes personalizados
            'product.sku.required' => 'El campo código es obligatorio.',
            'product.sku.unique' => 'El código ya está en uso, por favor elija otro.',
            'product.name.required' => 'El campo nombre es obligatorio.',
            'product.name.max' => 'El nombre no puede exceder 255 caracteres.',
            'image.required' => 'La imagen es obligatoria.',
            'image.image' => 'El archivo debe ser una imagen.',
            'image.max' => 'La imagen no puede ser mayor de 1024 kilobytes.',
            'product.price.required' => 'El campo precio es obligatorio.',
            'product.price.numeric' => 'El precio debe ser un número.',
            'product.price.min' => 'El precio debe ser al menos 0.',
            'product.subcategory_id.required' => 'El campo subcategoría es obligatorio.',
            'product.subcategory_id.exists' => 'La subcategoría seleccionada no es válida.',
        ]);

        $this->product['image_path'] = $this->image->store('products');

        $product = Product::create($this->product);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Producto creado correctamente.'
        ]);

        return redirect()->route('admin.products.edit', $product);
    }

    public function render()
    {
        return view('livewire.admin.products.product-create');
    }
}
