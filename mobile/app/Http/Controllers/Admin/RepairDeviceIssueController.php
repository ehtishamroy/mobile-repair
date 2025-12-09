<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RepairService;
use App\Models\RepairDeviceType;
use App\Models\RepairIssue;
use App\Models\RepairDeviceIssueAvailability;
use Illuminate\Http\Request;

class RepairDeviceIssueController extends Controller
{
    /**
     * Display the device-issue availability matrix
     */
    public function index(Request $request)
    {
        $serviceId = $request->get('service_id');

        // Get all services for the dropdown
        $services = RepairService::where('is_active', true)->orderBy('name')->get();

        // Default to first service if none selected
        if (!$serviceId && $services->count() > 0) {
            $serviceId = $services->first()->id;
        }

        $devices = [];
        $issues = [];
        $availabilityMatrix = [];

        if ($serviceId) {
            // Get devices and issues for the selected service
            $devices = RepairDeviceType::where('repair_service_id', $serviceId)
                ->where('is_active', true)
                ->orderBy('name')
                ->get();

            $issues = RepairIssue::where('repair_service_id', $serviceId)
                ->where('is_active', true)
                ->orderBy('order')
                ->get();

            // Get all availability records for this service
            $deviceIds = $devices->pluck('id');
            $issueIds = $issues->pluck('id');

            $availabilities = RepairDeviceIssueAvailability::whereIn('repair_device_type_id', $deviceIds)
                ->whereIn('repair_issue_id', $issueIds)
                ->get()
                ->keyBy(function ($item) {
                    return $item->repair_device_type_id . '_' . $item->repair_issue_id;
                });

            // Build the matrix
            foreach ($devices as $device) {
                foreach ($issues as $issue) {
                    $key = $device->id . '_' . $issue->id;
                    $availabilityMatrix[$key] = $availabilities->get($key);
                }
            }
        }

        return view('admin.repair-device-issues.index', compact(
            'services',
            'serviceId',
            'devices',
            'issues',
            'availabilityMatrix'
        ));
    }

    /**
     * Get settings for a specific device-issue combination
     */
    public function getSettings(Request $request)
    {
        $deviceTypeId = $request->get('device_type_id');
        $issueId = $request->get('issue_id');

        $availability = RepairDeviceIssueAvailability::where('repair_device_type_id', $deviceTypeId)
            ->where('repair_issue_id', $issueId)
            ->first();

        // Get existing pricing from repair_pricings table as default
        $existingPricing = \App\Models\RepairPricing::where('repair_issue_id', $issueId)
            ->where(function ($q) use ($deviceTypeId) {
                $q->where('repair_device_type_id', $deviceTypeId)
                    ->orWhereNull('repair_device_type_id');
            })
            ->where('is_active', true)
            ->first();

        $suggestedBasePrice = $existingPricing ? $existingPricing->price : null;

        if (!$availability) {
            // Return defaults with suggested price from existing pricing
            return response()->json([
                'exists' => false,
                'is_available' => true,
                'requires_quality_tier' => false,
                'base_price' => $suggestedBasePrice,
            ]);
        }

        return response()->json([
            'exists' => true,
            'is_available' => $availability->is_available,
            'requires_quality_tier' => $availability->requires_quality_tier,
            'base_price' => $availability->base_price ?? $suggestedBasePrice,
        ]);
    }

    /**
     * Update settings for a specific device-issue combination
     */
    public function updateSettings(Request $request)
    {
        $request->validate([
            'device_type_id' => 'required|exists:repair_device_types,id',
            'issue_id' => 'required|exists:repair_issues,id',
            'is_available' => 'required|boolean',
            'requires_quality_tier' => 'required|boolean',
            'base_price' => 'nullable|numeric|min:0', // Optional - will use repair_pricings if not provided
        ]);

        $deviceTypeId = $request->device_type_id;
        $issueId = $request->issue_id;
        $isAvailable = $request->is_available;
        $requiresQualityTier = $request->requires_quality_tier;
        $basePrice = $request->base_price;

        // Base price validation removed - it will be fetched from repair_pricings automatically

        // Clear base_price if requires_quality_tier is true
        if ($requiresQualityTier) {
            $basePrice = null;
        }

        // Update or create the record
        $availability = RepairDeviceIssueAvailability::updateOrCreate(
            [
                'repair_device_type_id' => $deviceTypeId,
                'repair_issue_id' => $issueId,
            ],
            [
                'is_available' => $isAvailable,
                'requires_quality_tier' => $requiresQualityTier,
                'base_price' => $basePrice,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Settings updated successfully.',
            'data' => [
                'is_available' => $availability->is_available,
                'requires_quality_tier' => $availability->requires_quality_tier,
                'base_price' => $availability->base_price,
            ],
        ]);
    }
}
