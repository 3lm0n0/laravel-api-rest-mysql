<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\CardService;
use App\Repositories\CardRepository;
use Mockery;

class CardServiceTest extends TestCase
{
    /**
     * @var CardRepository
     */
    private $cardRepository;

    /**
     * @var CardService
     */
    private $cardService;

    public function setUp(): void
    {
        $this->cardRepository = Mockery::mock(CardRepository::class);
        $this->cardService = Mockery::mock(CardService::class);
    }

    /**
     * @test
     */
    public function it_updates_a_card_successfully()
    {
        // Test data
        $cardId = 1;
        $updatedData = [
            'name' => 'Updated Name',
            'hp' => 120
        ];

        // Mock service methods
        $this->mockCardServiceUpdate($cardId, $updatedData);

        // Mock repository methods
        $this->mockFindCard($cardId);
        $this->mockUpdateCard($cardId, $updatedData, true);

        // Act
        $result = $this->cardService->update($cardId, $updatedData);

        // Assert
        $this->assertTrue($result);
    }

    private function mockCardServiceUpdate($cardId, $updatedData)
    {
        $this->cardService->shouldReceive('update')
            ->with($cardId, $updatedData)
            ->andReturn(true); 
    }

    private function mockFindCard($cardId)
    {
        $this->cardRepository->shouldReceive('find')
            ->with($cardId)
            ->andReturn(new \App\Models\Card(['id' => $cardId])); 
    }

    private function mockUpdateCard($cardId, $data, $success)
    {
        $this->cardRepository->shouldReceive('update')
            ->with($cardId, $data)
            ->andReturn($success);
    }

}