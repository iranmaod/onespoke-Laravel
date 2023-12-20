<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SuppliersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\Supplier::create([
            'paypal_active' =>'1',
            'paypal_client_id'=>'AW566iAHIpcxChbDaw3AzXwszF-t98TIVifZM8eSdukYgwAJdmEvbCqZ6OjEkCvfKh0CZKeb1W_RnF4F',
            'paypal_client_secret'=>'EKRBXVC3SqJhTtpK-HLJY0NUJk0OqY9JzVKshvvMMWTJO9WQBxmK55xivCc1-oaOB623oAcKJlnRIiqx',
            'stripe_active'=>'1',
            'stripe_publishable_key'=>'pk_test_51KDWRyJgMXX31ceYFbxhjt2jLfSOQq4gkw9RzMZzVLjqydFiVbW97LzYJ4cdp2ngjac7JsdrCaw6YgWgrhKZy1Qc00LYt2ogMf',
            'stripe_secret_key'=>'sk_test_51KDWRyJgMXX31ceY3muyddTLmHQ5tsVJATfYnbSrnpSP4Aa41smDAQb65dLc5vU0NLFz82L8HkIu5CLP01LCbNjx00Y1mBIjZJ',
            'voguepay_active'=>'1',
            'voguepay_merchant_id'=>'demo',
          ]);
    }
}
