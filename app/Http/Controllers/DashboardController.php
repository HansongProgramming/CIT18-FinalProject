// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\Asset;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch assets for the dashboard
        $assets = Asset::with('user')->latest()->get();

        // Pass assets to the dashboard view
        return view('dashboard', compact('assets'));
    }
}
