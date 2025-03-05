<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Inertia\Response;
use App\Traits\HasFile;
use App\Models\Book;
use App\Enums\MessageType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\BookRequest;
use App\Http\Resources\Admin\BookResource;

class BookController extends Controller
{
    use HasFile;
    
    public function index()
    {
        $books = Book::query()
        ->select(['id', 'book_code', 'title', 'slug', 'author', 'publication_year', 'isbn', 'language', 'number_of_page', 'status', 'price', 'category_id', 'publisher_id', 'created_at'])
        ->filter(request()->only(['search']))
        ->sorting(request()->only(['field', 'direction']))
        ->with(['category', 'stock', 'publisher'])
        ->latest('created_at')
        ->paginate(request()->load ?? 10)
        ->withQueryString();
        
        return Inertia::render('Admin/Books/Index', [
            'books' => BookResource::collection($books)->additional([
                'meta' => [
                    'has_pages' => $books->hasPages(),
                ],
            ]),
            'page_settings' => [
                'title' => 'buku',
                'subtitle' => 'Menampilkan semua data buku yang tersedia pada platform ini'
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
        return inertia('Admin/Books/Create', [
            'page_settings' => [
                'title' => 'Tambah Buku',
                'subtitle' => 'Buat buku baru di sini. Klik simpan setelah selesai',
                'method' => 'POST',
                'action' => route('admin.book.store'),
            ],
        ]);
    }


    public function store(BookRequest $request): RedirectResponse
    {
        try{
            Book::create([
                'name' => $name = $request->name,
                'slug' => str()->lower(str()->slug($name).str()->random(4)),
                'address' => $request->address,
                'email' => $request->email,
                'phone' => $request->phone,
                'logo' => $this->upload_file($request, 'logo', 'books'),
            ]);

            flashMessage(MessageType::CREATED->message('Buku'));

            return to_route('admin.book.index');


        } catch (Throwable $e){
            flashMessage(MessageType::ERROR->message(entity: '', error: $e->getMessage()), 'error');
            return to_route('admin.book.index');

        }
    }

    public function edit(Book $book): Response
    {
        return inertia('Admin/Books/Edit', [
            'page_settings' => [
                'title' => 'Edit Buku',
                'subtitle' => 'Edit buku di sini. Klik simpan setelah selesai',
                'method' => 'PUT',
                'action' => route('admin.book.update', $book)
            ],
            'book' => $book,
        ]);
    }

    public function update(Book $book, BookRequest $request): RedirectResponse
    {
        try{
            $book->update([
                'name' => $name = $request->name,
                'slug' => $name != $book->name ? str()->lower(str()->slug($name).str()->random(4)) : $book->slug,
                'address' => $request->address,
                'email' => $request->email,
                'phone' => $request->phone,
                'logo' => $this->update_file($request, $book, 'logo', 'books'),
            ]);

            flashMessage(MessageType::UPDATED->message('book'));

            return to_route('admin.book.index');


        } catch (Throwable $e){
            flashMessage(MessageType::ERROR->message(entity: '', error: $e->getMessage()), 'error');
            return to_route('admin.book.index');

        }
    }



    public function destroy(Book $book): RedirectResponse
    {
        try{
            $this->delete_file($book, 'logo');
            $book->delete();

            flashMessage(MessageType::CREATED->message('buku'));

            return to_route('admin.book.index');


        } catch (Throwable $e){
            flashMessage(MessageType::ERROR->message(entity: '', error: $e->getMessage()), 'error');
            return to_route('admin.book.index');

        }
    }



}
