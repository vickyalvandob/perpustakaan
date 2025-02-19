<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Inertia\Response;
use App\Traits\HasFile;
use App\Models\Publisher;
use App\Enums\MessageType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\PublisherRequest;
use App\Http\Resources\Admin\PublisherResource;

class PublisherController extends Controller
{
    use HasFile;
    
    public function index()
    {
        $publishers = Publisher::query()
        ->select(['id', 'name', 'slug', 'address', 'email', 'phone', 'created_at'])
        ->filter(request()->only(['search']))
        ->sorting(request()->only(['field', 'direction']))
        ->latest('created_at')
        ->paginate(request()->load ?? 10)
        ->withQueryString();
        
        return Inertia::render('Admin/Publishers/Index', [
            'publishers' => PublisherResource::collection($publishers)->additional([
                'meta' => [
                    'has_pages' => $publishers->hasPages(),
                ],
            ]),
            'page_settings' => [
                'title' => 'Penerbit',
                'subtitle' => 'Menampilkan semua data penerbit yang tersedia pada platform ini'
            ],
            'state' => [
                'page' => request()->page ?? 1,
                'search' => request()->search ?? '',
                'load' => 10,
            ],
        ]);
    }

    public function create(): Response
    {
        return inertia('Admin/Publishers/Create', [
            'page_settings' => [
                'title' => 'Tambah Penerbit',
                'subtitle' => 'Buat penerbit baru di sini. Klik simpan setelah selesai',
                'method' => 'POST',
                'action' => route('admin.publisher.store'),
            ],
        ]);
    }


    public function store(PublisherRequest $request): RedirectResponse
    {
        try{
            Publisher::create([
                'name' => $name = $request->name,
                'slug' => str()->lower(str()->slug($name).str()->random(4)),
                'address' => $request->address,
                'email' => $request->email,
                'phone' => $request->phone,
                'logo' => $this->upload_file($request, 'logo', 'publishers'),
            ]);

            flashMessage(MessageType::CREATED->message('Kategori'));

            return to_route('admin.publisher.index');


        } catch (Throwable $e){
            flashMessage(MessageType::ERROR->message(entity: '', error: $e->getMessage()), 'error');
            return to_route('admin.publisher.index');

        }
    }

    public function edit(Publisher $publisher): Response
    {
        return inertia('Admin/Publishers/Edit', [
            'page_settings' => [
                'title' => 'Edit Kategori',
                'subtitle' => 'Edit penerbit di sini. Klik simpan setelah selesai',
                'method' => 'PUT',
                'action' => route('admin.publisher.update', $publisher)
            ],
            'publisher' => $publisher,
        ]);
    }

    public function update(Publisher $publisher, PublisherRequest $request): RedirectResponse
    {
        try{
            $publisher->update([
                'name' => $name = $request->name,
                'slug' => $name != $publisher->name ? str()->lower(str()->slug($name).str()->random(4)) : $publisher->slug,
                'address' => $request->address,
                'email' => $request->email,
                'phone' => $request->phone,
                'logo' => $this->update_file($request, $publisher, 'logo', 'publishers'),
            ]);

            flashMessage(MessageType::CREATED->message('Publisher'));

            return to_route('admin.publisher.index');


        } catch (Throwable $e){
            flashMessage(MessageType::ERROR->message(entity: '', error: $e->getMessage()), 'error');
            return to_route('admin.publisher.index');

        }
    }



    public function destroy(Publisher $publisher): RedirectResponse
    {
        try{
            $this->delete_file($publisher, 'logo');
            $publisher->delete();

            flashMessage(MessageType::CREATED->message('Kategori'));

            return to_route('admin.publisher.index');


        } catch (Throwable $e){
            flashMessage(MessageType::ERROR->message(entity: '', error: $e->getMessage()), 'error');
            return to_route('admin.publisher.index');

        }
    }



}
