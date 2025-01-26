<?php
namespace App\Http\Controllers;

use App\Models\Mentoren;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MentorenController extends Controller
{
    public function showLoginForm()
    {
        return view('login.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['Email' => $credentials['email'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            return redirect()->intended('/voorwerpen'); // Change this to your intended route
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
        // return view('login.login');
    }

    // Existing methods for managing mentoren
    public function index()
    {
        $Mentoren = Mentoren::latest()->paginate(5);
        return view('mentoren.index', compact('Mentoren'));
    }

    public function create()
    {
        return view('mentoren.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Voornaam' => 'required|string|max:255',
            'Achternaam' => 'required|string|max:255',
            'Email' => 'required|string|email|max:255|unique:mentoren',
            'Wachtwoord' => 'required|string|min:8',
            'Admin' => 'required|boolean',
        ]);

        $validated['Wachtwoord'] = Hash::make($validated['Wachtwoord']);
        $validated['UUID'] = Str::uuid()->toString();
        Mentoren::create($validated);

        return redirect()->route('mentoren.index')->with('success', 'Mentor created successfully.');
    }

    public function edit($id)
    {
        $Mentoren = Mentoren::findOrFail($id);
        return view('mentoren.edit', compact('Mentoren'));
    }

    public function update(Request $request, $id)
    {
        $mentor = Mentoren::findOrFail($id);

        $validated = $request->validate([
            'Voornaam' => 'required|string|max:255',
            'Achternaam' => 'required|string|max:255',
            'Email' => 'required|string|email|max:255|unique:mentoren,Email,' . $mentor->id,
            'Wachtwoord' => 'nullable|string|min:8|confirmed',
        ]);

        if ($request->filled('Wachtwoord')) {
            $validated['Wachtwoord'] = Hash::make($validated['Wachtwoord']);
        } else {
            unset($validated['Wachtwoord']);
        }

        $mentor->update($validated);

        return redirect()->route('mentoren.index')->with('success', 'Mentor updated successfully.');
    }

    public function destroy($id)
    {
        $mentor = Mentoren::findOrFail($id);
        $mentor->delete();

        return redirect()->route('mentoren.index')->with('success', 'Mentor deleted successfully.');
    }
}