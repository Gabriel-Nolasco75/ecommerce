<?php

namespace App\Livewire\Admin\Products;

use App\Models\Family;
use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;

class ProductEdit extends Component
{
    use WithFileUploads;
    
    public $product;
    public $productEdit;

    public $families;
    public $family_id = '';
    public $category_id = '';

    public $image;

    public function mount($product)
    {
        $this->productEdit = $product->only('sku', 'name', 'description', 'image_path', 'price', 'stock', 'subcategory_id');

        $this->families = Family::all();

        $this->category_id = $product->subcategory->category->id;
        $this->family_id = $product->subcategory->category->family_id;
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
        $this->productEdit['subcategory_id'] = '';    
    }

    public function updatedCategoryID($value)
    {
        $this->productEdit['subcategory_id'] = '';    
    }

    #[On('variant-generate')]
    public function updateProduct()
    {
        $this->product = $this->product->fresh();
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
            'image' => 'nullable|image|max:1024',
            'productEdit.sku' => 'required|unique:products,sku,' . $this->product->id,
            'productEdit.name' => 'required|max:255',
            'productEdit.description' => 'nullable',
            'productEdit.price' => 'required|numeric|min:0',
            'productEdit.stock' => 'required|numeric|min:0',
            'productEdit.subcategory_id' => 'required|exists:subcategories,id',
        ], [
            // Mensajes personalizados
            'productEdit.sku.required' => 'El campo código es obligatorio.',
            'productEdit.sku.unique' => 'El código ya está en uso, por favor elija otro.',
            'productEdit.name.required' => 'El campo nombre es obligatorio.',
            'productEdit.name.max' => 'El nombre no puede exceder 255 caracteres.',
            'image.required' => 'La imagen es obligatoria.',
            'image.image' => 'El archivo debe ser una imagen.',
            'image.max' => 'La imagen no puede ser mayor de 1024 kilobytes.',
            'productEdit.price.required' => 'El campo precio es obligatorio.',
            'productEdit.price.numeric' => 'El precio debe ser un número.',
            'productEdit.price.min' => 'El precio debe ser al menos 0.',
            'productEdit.stock.required' => 'El campo stock es obligatorio.',
            'productEdit.stock.numeric' => 'El stock debe ser un número.',
            'productEdit.stock.min' => 'El stock debe ser al menos 0.',
            'productEdit.subcategory_id.required' => 'El campo subcategoría es obligatorio.',
            'productEdit.subcategory_id.exists' => 'La subcategoría seleccionada no es válida.',
        ]);

        if ($this->image){
            Storage::delete($this->productEdit['image_path']);
            $this->productEdit['image_path'] = $this->image->store('products');
        }

        $this->product->update($this->productEdit);

        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => '¡Producto actualizado!',
            'text' => 'El producto se actualizó correctamente.'
        ]);

        return redirect()->route('admin.products.edit', $this->product);
    }

    public function render()
    {
        return view('livewire.admin.products.product-edit');
    }
}
