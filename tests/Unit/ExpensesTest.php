<?php

namespace Tests\Unit;

use App\Http\Providers\ExpensesProvider;
use App\Http\Providers\UserProvider;
use App\Http\RequestProcessors\ExpensesRequestProcessor;
use App\Http\Services\ProfileService;
use App\Models\Profile;
use Illuminate\Http\Request;
use Tests\TestCase;

class ExpensesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetAllExpenses()
    {
        $provider = new ExpensesProvider();
        $this->assertNotEmpty($provider->getAll(1));
    }

    public function testUpdateBalance()
    {
        $service = new ProfileService();
        $profile = new Profile();
        $profile->balance = 100;
        $profile->user_id = 100;

        $request = new Request();
        $request->setMethod('POST');
        $request->request->add(['direction' => 'expense']);
        $request->request->add(['amount' => '12']);

        $this->assertTrue($service->updateBalance($request, $profile));
    }

    public function testCreateExpense()
    {
        $provider = new UserProvider();
        $user = $provider->getOneById(2);
        $processor = new ExpensesRequestProcessor();
        $request = new Request();
        $request->setMethod('POST');
        $request->request->add(['title' => 'example']);
        $request->request->add(['date' => new \DateTime()]);
        $request->request->add(['category' => 'other']);
        $request->request->add(['recipient' => 'other']);
        $request->request->add(['amount' => 12.5]);
        $request->request->add(['direction' => 'expense']);

        $this->assertTrue($processor->store($request, $user));
    }
}
