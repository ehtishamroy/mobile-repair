<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RepairService;
use App\Models\RepairDeviceType;
use App\Models\RepairIssue;
use App\Models\RepairPricing;
use Illuminate\Support\Str;

class RepairServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Smartphone Repair',
                'slug' => 'smartphone-repair',
                'order' => 1,
                'device_types' => [
                    ['name' => 'iPhone 15 Pro', 'brand' => 'Apple', 'order' => 1],
                    ['name' => 'iPhone 14', 'brand' => 'Apple', 'order' => 2],
                    ['name' => 'Samsung Galaxy S24', 'brand' => 'Samsung', 'order' => 3],
                    ['name' => 'Samsung Galaxy S23', 'brand' => 'Samsung', 'order' => 4],
                ],
                'issues' => [
                    ['name' => 'Front Screen', 'order' => 1],
                    ['name' => 'Back Cover', 'order' => 2],
                    ['name' => 'Battery & Charging', 'order' => 3],
                    ['name' => 'Camera Issues', 'order' => 4],
                    ['name' => 'Water Damage', 'order' => 5],
                ],
            ],
            [
                'name' => 'Laptop Repair',
                'slug' => 'laptop-repair',
                'order' => 2,
                'device_types' => [
                    ['name' => 'MacBook Pro', 'brand' => 'Apple', 'order' => 1],
                    ['name' => 'MacBook Air', 'brand' => 'Apple', 'order' => 2],
                    ['name' => 'Dell XPS', 'brand' => 'Dell', 'order' => 3],
                    ['name' => 'HP Pavilion', 'brand' => 'HP', 'order' => 4],
                ],
                'issues' => [
                    ['name' => 'Screen Replacement', 'order' => 1],
                    ['name' => 'Keyboard Repair', 'order' => 2],
                    ['name' => 'Battery Replacement', 'order' => 3],
                    ['name' => 'Motherboard Repair', 'order' => 4],
                    ['name' => 'Hard Drive Upgrade', 'order' => 5],
                ],
            ],
            [
                'name' => 'Tablet Repair',
                'slug' => 'tablet-repair',
                'order' => 3,
                'device_types' => [
                    ['name' => 'iPad Pro', 'brand' => 'Apple', 'order' => 1],
                    ['name' => 'iPad Air', 'brand' => 'Apple', 'order' => 2],
                    ['name' => 'Samsung Galaxy Tab', 'brand' => 'Samsung', 'order' => 3],
                ],
                'issues' => [
                    ['name' => 'Screen Repair', 'order' => 1],
                    ['name' => 'Battery Replacement', 'order' => 2],
                    ['name' => 'Charging Port', 'order' => 3],
                    ['name' => 'Camera Issues', 'order' => 4],
                ],
            ],
            [
                'name' => 'Console Repair',
                'slug' => 'console-repair',
                'order' => 4,
                'device_types' => [
                    ['name' => 'PlayStation 5', 'brand' => 'Sony', 'order' => 1],
                    ['name' => 'Xbox Series X', 'brand' => 'Microsoft', 'order' => 2],
                    ['name' => 'Nintendo Switch', 'brand' => 'Nintendo', 'order' => 3],
                ],
                'issues' => [
                    ['name' => 'HDMI Port Repair', 'order' => 1],
                    ['name' => 'Power Supply', 'order' => 2],
                    ['name' => 'Disc Drive', 'order' => 3],
                    ['name' => 'Controller Repair', 'order' => 4],
                ],
            ],
            [
                'name' => 'Gaming PC Repair',
                'slug' => 'gaming-pc-repair',
                'order' => 5,
                'device_types' => [
                    ['name' => 'Custom Build', 'brand' => null, 'order' => 1],
                    ['name' => 'Pre-built System', 'brand' => null, 'order' => 2],
                ],
                'issues' => [
                    ['name' => 'Graphics Card', 'order' => 1],
                    ['name' => 'CPU Issues', 'order' => 2],
                    ['name' => 'RAM Upgrade', 'order' => 3],
                    ['name' => 'Cooling System', 'order' => 4],
                ],
            ],
            [
                'name' => 'Software Optimization',
                'slug' => 'software-optimization',
                'order' => 6,
                'device_types' => [
                    ['name' => 'All Devices', 'brand' => null, 'order' => 1],
                ],
                'issues' => [
                    ['name' => 'OS Installation', 'order' => 1],
                    ['name' => 'Virus Removal', 'order' => 2],
                    ['name' => 'Performance Tuning', 'order' => 3],
                    ['name' => 'Data Recovery', 'order' => 4],
                ],
            ],
        ];

        foreach ($services as $serviceData) {
            $service = RepairService::create([
                'name' => $serviceData['name'],
                'slug' => $serviceData['slug'],
                'order' => $serviceData['order'],
                'is_active' => true,
            ]);

            // Create device types
            foreach ($serviceData['device_types'] as $deviceTypeData) {
                RepairDeviceType::create([
                    'repair_service_id' => $service->id,
                    'name' => $deviceTypeData['name'],
                    'brand' => $deviceTypeData['brand'],
                    'order' => $deviceTypeData['order'],
                    'is_active' => true,
                ]);
            }

            // Create issues
            foreach ($serviceData['issues'] as $issueData) {
                RepairIssue::create([
                    'repair_service_id' => $service->id,
                    'name' => $issueData['name'],
                    'order' => $issueData['order'],
                    'is_active' => true,
                ]);
            }

            // Create sample pricing (generic pricing for each issue)
            $issues = $service->issues;
            $deviceTypes = $service->deviceTypes;
            
            foreach ($issues as $issue) {
                // Create pricing for each device type
                foreach ($deviceTypes as $deviceType) {
                    RepairPricing::create([
                        'repair_service_id' => $service->id,
                        'repair_device_type_id' => $deviceType->id,
                        'repair_issue_id' => $issue->id,
                        'price' => rand(50, 300), // Random price between 50-300
                        'is_inspection_fee' => false,
                        'is_active' => true,
                    ]);
                }
                
                // Create generic pricing (no specific device type)
                RepairPricing::create([
                    'repair_service_id' => $service->id,
                    'repair_device_type_id' => null,
                    'repair_issue_id' => $issue->id,
                    'price' => rand(50, 300),
                    'is_inspection_fee' => false,
                    'is_active' => true,
                ]);
            }

            // Create inspection fee pricing
            RepairPricing::create([
                'repair_service_id' => $service->id,
                'repair_device_type_id' => null,
                'repair_issue_id' => null,
                'price' => 25.00, // Inspection fee
                'is_inspection_fee' => true,
                'is_active' => true,
            ]);
        }
    }
}
