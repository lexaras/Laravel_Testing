<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookManagementTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     * @return void
     */
    public function book_can_be_added()
    {
        // given
        $this->withoutExceptionHandling();
        $bookData= ['isbn' => 9780840700551, 'title' => 'Holy Bible' ];
        // when
        $response = $this->post('/books', $bookData);
        // then
        $response->assertStatus(302);
        $this->assertCount(1, Book::all());
        $response->assertRedirect('/books/' . $bookData['isbn']);
    }
    /**
     * @test
     * @return void
     */
    public function book_can_be_updated() {
        $this->withoutExceptionHandling();
        $bookData = ['isbn' => 9780840700551, 'title' => 'Holy Bible' ];
        $this->post('/books', $bookData);
        $updatedBookData = ['isbn' => 9780840700551, 'title' => 'Anything' ]; 
        $response = $this->put('/books/' . $bookData['isbn'], $updatedBookData);
        $response->assertStatus(302);
        $this->assertCount(1, Book::all());
        $this->assertEquals($updatedBookData['isbn'], Book::first()->isbn);
        $this->assertEquals($updatedBookData['title'], Book::first()->title);
        $response->assertRedirect('/books/' . $bookData['isbn']);
    }
      /**
     * @test
     * @return void
     */
      public function book_can_be_deleted() {
        $this->withoutExceptionHandling();
        $bookData = ['isbn' => 9780840700551, 'title' => 'Holy Bible' ];
        $this->post('/books', $bookData);
        $this->assertCount(1, Book::all()); //Checkas ar tikrai susikure knyga 
        $response = $this->delete('/books/' . $bookData['isbn']); 
        $response->assertStatus(302);
        $this->assertCount(0, Book::all());
        $response->assertRedirect('/books/');
    }
    /**
     * @test
     * @return void
     */
       public function title_is_required_to_create_book() {
        $bookData = ['isbn' => 9780840700551, 'title' => '' ];
        $response = $this->post('/books', $bookData); 
        $response->assertStatus(302);
        $response->assertSessionHasErrors('title');
        //patikrina ar tikrai neissaugojo nevalidziu duomenu!
        $this->assertCount(0, Book::all());
    }
    /**
     * @test
     * @return void
     */
        public function isbn_is_required_to_create_book() {
        $bookData = ['isbn' => '', 'title' => 'To Kill a Mockingbird' ];
        $response = $this->post('/books', $bookData);
        $response->assertStatus(302);
        $response->assertSessionHasErrors('isbn');
        $this->assertCount(0, Book::all());   
        }
}
