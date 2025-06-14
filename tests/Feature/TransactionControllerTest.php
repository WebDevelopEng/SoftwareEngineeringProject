<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Donation;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class TransactionControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Session::start();
    }

    /** @test */
    public function user_can_add_transaction_item()
    {
        $user = User::factory()->create();
        $donation = Donation::factory()->create(['count' => 10, 'price' => 5]);

        Session::put('user', $user);

        $response = $this->post(route('addtransaction', $donation->id), [
            'quantity' => 2
        ]);

        $response->assertRedirect(route('donate'));
        $this->assertDatabaseHas('transaction_items', [
            'donation_id' => $donation->id,
            'quantity' => 2
        ]);
    }

    /** @test */
    public function user_can_view_active_transaction()
    {
        $user = User::factory()->create();
        Session::put('user', $user);
        $donation = Donation::factory()->create(['count' => 10, 'price' => 5]);
        $transaction = Transaction::factory()->create(['user_id' => $user->id, 'status' => 'pending']);
        TransactionItem::factory()->create([
            'transaction_id' => $transaction->id,
            'donation_id' => $donation->id,
            'quantity' => 2
        ]);

        

        $response = $this->get(route('viewtransaction'));
        $response->assertStatus(200);
        $response->assertViewHas('transaction');
        $response->assertViewHas('totalcost', 10);
    }

    /** @test */
    public function user_can_delete_transaction_item()
    {
        $user = User::factory()->create();
        $transaction = Transaction::factory()->create(['user_id' => $user->id]);
        $item = TransactionItem::factory()->create(['transaction_id' => $transaction->id]);

        Session::put('user', $user);

        $response = $this->post(route('deletetransactionitem'), [
            'transactionitemid' => $item->id
        ]);

        $response->assertRedirect(route('viewtransaction'));
        $this->assertDatabaseMissing('transaction_items', ['id' => $item->id]);
    }

    /** @test */
    public function user_can_edit_transaction_item()
    {
        $user = User::factory()->create();
        $transaction = Transaction::factory()->create(['user_id' => $user->id]);
        $item = TransactionItem::factory()->create(['transaction_id' => $transaction->id, 'quantity' => 1]);

        Session::put('user', $user);

        $response = $this->post(route('edittransactionitem'), [
            'transactionitemid' => $item->id,
            'quantity' => 3
        ]);

        $response->assertRedirect(route('viewtransaction'));
        $this->assertDatabaseHas('transaction_items', ['id' => $item->id, 'quantity' => 3]);
    }

    /** @test */
    public function user_can_confirm_transaction_if_stock_is_available()
    {
        $user = User::factory()->create(['balance' => 100]);
        $donation = Donation::factory()->create(['count' => 10, 'price' => 5]);
        $transaction = Transaction::factory()->create(['user_id' => $user->id, 'status' => 'pending']);
        TransactionItem::factory()->create([
            'transaction_id' => $transaction->id,
            'donation_id' => $donation->id,
            'quantity' => 2
        ]);

        Session::put('user', $user);

        $response = $this->post(route('confirmtransaction'), [
            'transactionid' => $transaction->id,
            'totalcost' => 10
        ]);

        $response->assertRedirect(route('profile'));
        $this->assertDatabaseHas('transactions', ['id' => $transaction->id, 'status' => 'completed']);
    }

    /** @test */
    public function user_cannot_confirm_transaction_if_stock_is_insufficient()
    {
        $user = User::factory()->create(['balance' => 100]);
        $donation = Donation::factory()->create(['count' => 1, 'price' => 5]);
        $transaction = Transaction::factory()->create(['user_id' => $user->id, 'status' => 'pending']);
        TransactionItem::factory()->create([
            'transaction_id' => $transaction->id,
            'donation_id' => $donation->id,
            'quantity' => 2
        ]);

        Session::put('user', $user);

        $response = $this->post(route('confirmtransaction'), [
            'transactionid' => $transaction->id,
            'totalcost' => 10
        ]);

        $response->assertRedirect(route('viewtransaction'));
        $response->assertSessionHasErrors();
    }
}
