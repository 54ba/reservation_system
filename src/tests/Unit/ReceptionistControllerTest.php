<?php

namespace Tests\Unit;

use App\Http\Controllers\ReceptionistController;
use App\Models\Movie;
use App\Models\Hall;
use App\Models\Showtime;
use App\Models\Seat;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\JsonResponse;
use Mockery;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReceptionistControllerTest extends TestCase
{
    use DatabaseTransactions;
    use RefreshDatabase;

    protected function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }


    public function testGetMoviesReturnsJsonResponseWithMoviesData()
    {

        $movie1 = Movie::factory()->create(['title' => 'Movie 1']);
        $movie2 = Movie::factory()->create(['title' => 'Movie 2']);

        $hall1 = Hall::factory()->create(['movie_id' => $movie1->id]);
        $hall2 = Hall::factory()->create(['movie_id' => $movie2->id]);

        $showtime1 = Showtime::factory()->create(['movie_id' => $movie1->id, 'hall_id' => $hall1->id]);
        $showtime2 = Showtime::factory()->create(['movie_id' => $movie2->id, 'hall_id' => $hall2->id]);

        $seat1 = Seat::factory()->create(['movie_id' => $movie1->id, 'hall_id' => $hall1->id, 'showtime_id' => $showtime1->id]);
        $seat2 = Seat::factory()->create(['movie_id' => $movie2->id, 'hall_id' => $hall2->id, 'showtime_id' => $showtime2->id]);

        $movieMock = Mockery::mock(Movie::class);
        $movieMock->shouldReceive('with')->once()->with(['showtimes', 'halls', 'seats'])->andReturnSelf();
        $movieMock->shouldReceive('get')->once()->andReturn(collect([$movie1, $movie2]));


        // Act
        $response = $this->get('/movies');

        // Assert


        $controller = new ReceptionistController($movieMock);

        // Call the getMovies method and check the response
        $response = $controller->getMovies();
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());

        $mockMovies = [
        'movies' => [
            [
                'id' => $movie1->id,
                'title' => $movie1->title,
                'description' => $movie1->description,
                'release_year' => $movie1->release_year,
                'director' => $movie1->director,
                'casting' => $movie1->casting,
                'showtimes' => [
                    [
                        'id' => $showtime1->id,
                        'start_time' => $showtime1->start_time,
                        'end_time' => $showtime1->end_time,
                        'hall' => [
                            'id' => $hall1->id,
                            'name' => $hall1->name,
                        ],
                        'seats' => [
                            [
                                'id' => $seat1->id,
                                'number' => $seat1->number,
                                'status' => $seat1->status,
                            ],
                        ],
                    ],
                ],
            ],
            [
                'id' => $movie2->id,
                'title' => $movie2->title,
                'description' => $movie2->description,
                'release_year' => $movie2->release_year,
                'director' => $movie2->director,
                'casting' => $movie2->casting,
                'showtimes' => [
                    [
                        'id' => $showtime2->id,
                        'start_time' => $showtime2->start_time,
                        'end_time' => $showtime2->end_time,
                        'hall' => [
                            'id' => $hall2->id,
                            'name' => $hall2->name,
                        ],
                        'seats' => [
                            [
                                'id' => $seat2->id,
                                'number' => $seat2->number,
                                'status' => $seat2->status,
                            ],
                        ],
                    ],
                ],
            ]
        ]
                    ];

        $this->assertEquals([
            'movies' => $mockMovies,
        ], $response->getData(true));
    }


    public function testCreateShowtimeReturnsJsonResponseWithNewShowtimeData()
{
    // Create a movie and a hall
    $movie = Movie::factory()->create();
    $hall = Hall::factory()->create();

    // Mock the Movie model to return the movie created above when the findOrFail method is called
    $movieMock = Mockery::mock(Movie::class);
    $movieMock->shouldReceive('findOrFail')->once()->with($movie->id)->andReturn($movie);

    // Mock the Showtime model to create a new showtime when the create method is called
    $showtimeData = [
        'movie_id' => $movie->id,
        'hall_id' => $hall->id,
        'start_time' => '2023-03-01 09:00:00',
        'end_time' => '2023-03-01 11:00:00',
    ];
    $showtimeMock = Mockery::mock(Showtime::class);
    $showtimeMock->shouldReceive('create')->once()->with($showtimeData)->andReturn(new Showtime($showtimeData));

    // Instantiate the controller with the mocked models
    $controller = new ReceptionistController($movieMock, $showtimeMock);

    // Call the createShowtime method with the data above and check the response
    $response = $controller->createShowtime($movie->id, $hall->id, $showtimeData['start_time'], $showtimeData['end_time']);

    $this->assertInstanceOf(JsonResponse::class, $response);
    $this->assertEquals(201, $response->getStatusCode());

    $showtime = $response->getData();

    $this->assertEquals($movie->id, $showtime->movie_id);
    $this->assertEquals($hall->id, $showtime->hall_id);
    $this->assertEquals($showtimeData['start_time'], $showtime->start_time);
    $this->assertEquals($showtimeData['end_time'], $showtime->end_time);
}

public function testGetShowtimesReturnsJsonResponseWithShowtimesData()
{
    // Arrange
    $movie = Movie::factory()->create(['title' => 'Movie 1']);
    $hall = Hall::factory()->create(['movie_id' => $movie->id]);
    $showtime1 = Showtime::factory()->create(['movie_id' => $movie->id, 'hall_id' => $hall->id]);
    $showtime2 = Showtime::factory()->create(['movie_id' => $movie->id, 'hall_id' => $hall->id]);
    $seat1 = Seat::factory()->create(['movie_id' => $movie->id, 'hall_id' => $hall->id, 'showtime_id' => $showtime1->id]);
    $seat2 = Seat::factory()->create(['movie_id' => $movie->id, 'hall_id' => $hall->id, 'showtime_id' => $showtime2->id]);

    $movieMock = Mockery::mock(Movie::class);
    $movieMock->shouldReceive('find')->once()->with($movie->id)->andReturn($movie);

    $controller = new ReceptionistController($movieMock);

    // Act
    $response = $controller->getShowtimes($movie->id,$hall->id);

    // Assert
    $this->assertInstanceOf(JsonResponse::class, $response);
    $this->assertEquals(200, $response->getStatusCode());

    $mockShowtimes = [
        [
            'id' => $showtime1->id,
            'start_time' => $showtime1->start_time,
            'end_time' => $showtime1->end_time,
            'hall' => [
                'id' => $hall->id,
                'name' => $hall->name,
            ],
            'seats' => [
                [
                    'id' => $seat1->id,
                    'number' => $seat1->number,
                    'status' => $seat1->status,
                ],
            ],
        ],
        [
            'id' => $showtime2->id,
            'start_time' => $showtime2->start_time,
            'end_time' => $showtime2->end_time,
            'hall' => [
                'id' => $hall->id,
                'name' => $hall->name,
            ],
            'seats' => [
                [
                    'id' => $seat2->id,
                    'number' => $seat2->number,
                    'status' => $seat2->status,
                ],
            ],
        ],
    ];

    $this->assertEquals([
        'showtimes' => $mockShowtimes,
    ], $response->getData(true));
}


}
