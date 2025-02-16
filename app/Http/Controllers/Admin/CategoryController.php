<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Inertia\Response;
use App\Traits\HasFile;
use App\Models\Category;
use App\Enums\MessageType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Resources\Admin\CategoryResource;

class CategoryController extends Controller
{

    use HasFile;

    public function index()
    {
        $categories = Category::query()
        ->select(['id', 'name', 'slug', 'cover', 'created_at'])
        ->get();
        
        return Inertia::render('Admin/Categories/Index', [
            'categories' => CategoryResource::collection($categories),
            'page_settings' => [
                'title' => 'Kategori',
                'subtitle' => 'Menampilkan semua data kategori yang tersedia pada platform ini'
            ]
        ]);
    }

    public function create(): Response
    {
        return inertia('Admin/Categories/Create', [
            'page_settings' => [
                'title' => 'Tambah Kategori',
                'subtitle' => 'Buat kategori baru di sini. Klik simpan setelah selesai',
                'method' => 'POST',
                'action' => route('admin.category.store'),
            ],
        ]);
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        try{
            Category::create([
                'name' => $name = $request->name,
                'slug' => str()->lower(str()->slug($name).str()->random(4)),
                'description' => $request->description,
                'cover' => $this->upload_file($request, 'cover', 'categories'),
            ]);

            flashMessage(MessageType::CREATED->message('Kategori'));

            return to_route('admin.category.index');


        } catch (Throwable $e){
            flashMessage(MessageType::ERROR->message(entity: '', error: $e->getMessage()), 'error');
            return to_route('admin.category.index');

        }
    }

    public function edit(Category $category): Response
    {
        return inertia('Admin/Categories/Edit', [
            'page_settings' => [
                'title' => 'Edit Kategori',
                'subtitle' => 'Edit kategori di sini. Klik simpan setelah selesai',
                'method' => 'PUT',
                'action' => route('admin.category.edit', $category)
            ],
            'category' => $category,
        ]);
    }

    public function update(Category $category, CategoryRequest $request): RedirectResponse
    {
        try{
            $category->update([
                'name' => $name = $request->name,
                'slug' => $name != $category->name ? str()->lower(str()->slug($name).str()->random(4)) : $category->slug,
                'description' => $request->description,
                'cover' => $this->update_file($request, $category, 'cover', 'categories'),
            ]);

            flashMessage(MessageType::CREATED->message('Kategori'));

            return to_route('admin.category.index');


        } catch (Throwable $e){
            flashMessage(MessageType::ERROR->message(entity: '', error: $e->getMessage()), 'error');
            return to_route('admin.category.index');

        }
    }



    public function destroy(Category $category): RedirectResponse
    {
        try{
            $this->delete_file($category, 'cover');
            $category->delete();

            flashMessage(MessageType::CREATED->message('Kategori'));

            return to_route('admin.category.index');


        } catch (Throwable $e){
            flashMessage(MessageType::ERROR->message(entity: '', error: $e->getMessage()), 'error');
            return to_route('admin.category.index');

        }
    }


}
