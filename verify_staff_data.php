<?php

use App\Models\Service;
use App\Models\User;

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$services = Service::all();

echo "Total Services: " . $services->count() . "\n";

foreach ($services as $service) {
    // using the exact same query as BookingController
    $staffQuery = User::where('role', 'staff')
        ->whereHas('staffServices', function ($query) use ($service) {
            $query->where('service_id', $service->id);
        });
    
    $count = $staffQuery->count();
    
    // Check using the alternative 'services' relationship
    $altCount = User::where('role', 'staff')
        ->whereHas('services', function ($query) use ($service) {
            $query->where('services.id', $service->id);
        })->count();

    echo "Service: " . $service->name . " (ID: " . $service->id . ")\n";
    echo "  - Staff Count (via staffServices): " . $count . "\n";
    echo "  - Staff Count (via services): " . $altCount . "\n";
}
