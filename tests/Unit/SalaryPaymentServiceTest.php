<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\SalaryPaymentService;
use App\Contracts\PaymentStrategyInterface;
use Mockery;

class SalaryPaymentServiceTest extends TestCase
{
    /** @test */
    public function it_calculates_payment_dates()
    {
        // Arrange: Mock the payment strategy
        $paymentStrategyMock = Mockery::mock(PaymentStrategyInterface::class);
        $paymentStrategyMock->shouldReceive('calculateSalaryDate')
                            ->andReturn('2024-01-31', '2024-02-28');
        $paymentStrategyMock->shouldReceive('calculateBonusDate')
                            ->andReturn('2024-01-15', '2024-02-15');

        $service = new SalaryPaymentService($paymentStrategyMock);

        // Act: Calculate payment dates
        $result = $service->calculatePaymentDates(2024);

        // Assert: Check the output
        $this->assertCount(12, $result);
        $this->assertEquals('2024-01-31', $result[0]['salary_date']);
        $this->assertEquals('2024-01-15', $result[0]['bonus_date']);
    }
}
