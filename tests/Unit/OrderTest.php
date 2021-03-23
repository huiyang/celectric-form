<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Orders;
use App\Models\Items;

class OrderTest extends TestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    protected $seed = true;
    protected $seeder = \Database\Seeders\Currency::class;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->seed(\Database\Seeders\Currency::class);

        currency()->setUserCurrency('MYR');

        $order = Orders::factory()
            // ->hasItems(3)
            ->has(Items::factory()->count(1)->state([
                'currency_cost' => 'USD',
                'currency_price' => 'MYR',
                'sell_price' => 50,
                'total_price' => 50,
                'cost' => 4,
                'total_cost' => 4,
            ]), 'items')
            ->has(Items::factory()->count(2)->state([
                'currency_cost' => 'MYR',
                'currency_price' => 'MYR',
                'sell_price' => 10,
                'total_price' => 10,
                'cost' => 5,
                'total_cost' => 5,
            ]), 'items')
            ->create(['currency' => 'MYR']);

        $order->refresh();

        $order->recalculateTotal()->save();

        // $this->assertDatabaseCount('currencies', 2);

        $this->assertEquals(16, $order->items[0]->convertedTotalCost);
        $this->assertEquals(50, $order->items[0]->convertedTotalPrice);

        $this->assertEquals(5, $order->items[1]->convertedTotalCost);
        $this->assertEquals(10, $order->items[1]->convertedTotalPrice);

        $this->assertEquals('MYR', $order->currency);
        $this->assertEquals(26, $order->grand_total_cost);
        $this->assertEquals(70, $order->grand_total_price);

        // dd($order->grand_total_price, $order->grand_total_cost);
        // dd($order->displayTotalPrice, $order->displayTotalCost);
        // dd(Items::get());
        // dd($order->items->map(function($item) {
        //     return $item->convertedTotalPrice;
        // }));
    }
}
