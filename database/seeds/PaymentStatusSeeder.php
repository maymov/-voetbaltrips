<?php

use Illuminate\Database\Seeder;
use App\PaymentStatus;
class PaymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_status')->truncate();
        PaymentStatus::create(["name"=>"Paid", "desc"=> "Someone requested money from you and you sent them a payment. "]);
        PaymentStatus::create(["name"=>"Failed", "desc"=> "Your payment didn't go through. We recommend that you try your payment again."]);
        PaymentStatus::create(["name"=>"Cancelled", "desc"=> "You canceled your payment, and the money was credited back to your account."]);
        PaymentStatus::create(["name"=>"Processing", "desc"=> "We're processing your payment and the transaction should be completed shortly."]);
        PaymentStatus::create(["name"=>"Refunded", "desc"=> "The recipient returned your payment. If you used a credit card to make your payment, the money will be returned to your credit card. It can take up to 30 days for the refund to appear on your statement."]);
        PaymentStatus::create(["name"=>"Refused", "desc"=> "The recipient didn't receive your payment. If you still want to make your payment, we recommend that you try again."]);
        PaymentStatus::create(["name" => "Pending", "desc" => "The payment is pending. See pending_reason for more information."]);
        PaymentStatus::create(["name"=>"Denied", "desc" => "You denied the payment. This happens only if the payment was previously pending because of possible reasons described for the pending_reason variable or the Fraud_Management_Filters_x variable."]);
        PaymentStatus::create(["name"=>"Did not Started", "desc" => "Just Placed the order. Did not start the payment."]);
        $this->command->info('Payment status seeder completed');
    }
}
