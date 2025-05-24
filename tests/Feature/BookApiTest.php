<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookApiTest extends TestCase
{
    use RefreshDatabase;
    /**
     * API for book created successfully
     * This test send POST request to /api/books
     * If response status is 201 means book created successfully
     */
    public function test_can_create_book()
    {
        $data = ['title' => 'This is test book', 'author' => 'Sandip', 'publication_year' => 2025];

        $response = $this->postJson('/api/books', $data);
        $response->assertStatus(201)->assertJsonFragment($data);
        $this->assertDatabaseHas('books', $data);
    }

    public function test_can_create_book_validation_error()
    {
        $response = $this->postJson('/api/books', []);
        $response->assertStatus(422)->assertJsonValidationErrors(['title', 'author', 'publication_year']);
    }

    public function test_can_list_books()
    {
        Book::factory()->count(3)->create();
        $response = $this->getJson('/api/books');
        $response->assertStatus(200)->assertJsonCount(3);
    }

    public function test_can_show_book()
    {
        $book = Book::factory()->create();
        $response = $this->getJson("/api/books/{$book->id}");

        $response->assertStatus(200)->assertJsonFragment(['title' => $book->title]);
    }

    public function test_can_update_book()
    {
        $book = Book::factory()->create();
        $data = ['title' => 'Updated Title', 'author' => 'update author', 'publication_year' => 2022];
        $response = $this->putJson("/api/books/{$book->id}", $data);
        $response->assertStatus(200)->assertJsonFragment($data);
    }

    public function test_can_delete_book()
    {
        $book = Book::factory()->create();
        $response = $this->deleteJson("/api/books/{$book->id}");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }
}
