<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with the name of the currently logged-in user, greeting, total users count, and visitor count.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $title = 'Dashboard | ngodingsantuy.site';

        // Get the currently authenticated user
        $user = Auth::user();
        $userName = $user->name;

        // Get the appropriate greeting based on the time of the day
        $greeting = $this->getGreeting();

        // Get the total number of users
        $totalUsers = User::count();

        // Get the current date
        $currentDate = Carbon::now('Asia/Jakarta')->format('Y-m-d');

        // Fetch all users
        $users = User::all();
        $users = User::paginate(5);

        return view('dashboard', compact('title', 'userName', 'greeting', 'totalUsers', 'currentDate', 'users'));
    }

    /**
     * Get the appropriate greeting based on the time of the day.
     *
     * @return string
     */
    private function getGreeting()
    {
        // Set the timezone to 'Asia/Jakarta'
        $now = Carbon::now('Asia/Jakarta');

        // Get the hour of the current time
        $hour = $now->hour;

        // Get the appropriate greeting based on the hour of the day
        if ($hour >= 5 && $hour < 12) {
            return 'Good morning';
        } elseif ($hour >= 12 && $hour < 17) {
            return 'Good afternoon';
        } else {
            return 'Good evening';
        }
    }

    /**
     * Get the internet speed from the server.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInternetSpeed()
    {
        // Replace this with your code to fetch the actual internet speed from the server
        // For demonstration purposes, we use random data
        $internetSpeed = rand(5, 100); // Random number between 5 and 100 (Mbps)

        return response()->json(['internet_speed' => $internetSpeed]);
    }

    /**
     * Delete a user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Perform any additional checks here if needed, e.g., admin validation

        $user = User::find($id);
        if (!$user) {
            return redirect()->route('dashboard')->with('error', 'User not found.');
        }
    }
}
