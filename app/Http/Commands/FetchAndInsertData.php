<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class FetchAndInsertData extends Command
{
    protected $signature = 'data:fetch';
    protected $description = 'Fetch data from remote server and insert into local database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Fetch data from remote server
        $response = Http::get('https://remote-server-url/home/salessummary');
        $data = $response->json();

        if ($data['status'] == 'OK') {
            // Clear existing data
            DB::table('sales')->truncate();

            // Insert new data
            foreach ($data['items'] as $item) {
                DB::table('sales')->insert([
                    'item' => $item['item'],
                    'revenue' => $item['revenue'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $this->info('Data successfully fetched and inserted into local database.');
        } else {
            $this->error('Failed to fetch data.');
        }
    }
}
