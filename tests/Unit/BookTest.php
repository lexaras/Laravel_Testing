<?php

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class BookTest extends TestCase {
    use RefreshDatabase;
    /**
     * A basic unit test example.
     * @return void
     */
    public function test_book_can_be_created_with_isbn_and_title_only() {
        // given
        $bookData = ['isbn' => 9780840700551, 'title' => 'Holy Bible' ];
        // when
        Book::firstOrCreate($bookData);
        // then
        $books = Book::all();
        $this->assertEquals(1, $books->count());
        $this->assertInstanceOf('\Illuminate\Database\Eloquent\Collection', $books);
        
    }
    // /** @test */
    // public function title_is_required_to_create_book() {
    //     // given
    //     $this->withoutExceptionHandling();
    //     $bookData = ['isbn' => 9780840700551, 'title' => '' ];
    //     // when
    //     $response = $this->post('/books', $bookData);
    //     // then
    //     $response->assertStatus(200);
    //     $this->assertCount(1, Book::all());
    // }
}
