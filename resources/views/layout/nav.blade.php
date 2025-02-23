<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Navbar</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/html5-qrcode/html5-qrcode.min.js"></script>
</head>

<body>

  <nav class="relative">
    <div class="flex justify-center items-center w-full h-full">
      <img class="w-40" src="{{ asset('images/LOVKlogo.jpg') }}" alt="Logo">
    </div>
    <div class="flex flex-wrap items-center justify-between mx-auto pb-4">

      <!-- Mobile Navbar Toggle -->
      <button
        id="navbar-toggle"
        type="button"
        class="absolute top-4 left-0 items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
        aria-controls="mobile-navbar"
        aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-6 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
        </svg>
      </button>

      <!-- Desktop Navbar -->
      <div class="hidden lg:block w-full md:w-auto">
        <ul class="flex flex-row font-medium space-x-8 text-black">
          <li>
            <a href="{{ route('kinderen.index') }}" class="block py-2 text-gray-900 hover:text-blue-700">Kinderen</a>
          </li>
          <li>
            <a href="{{ route('mentoren.index') }}" class="block py-2 text-gray-900 hover:text-blue-700">Mentor</a>
          </li>
          <li>
            <a href="{{ route('voorwerpen.index') }}" class="block py-2 text-gray-900 hover:text-blue-700">Voorwerpen</a>
          </li>
          @auth
          <li>
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="block py-2 text-gray-900 hover:text-blue-700">Logout</button>
            </form>
          </li>
          @else
          <li>
            <a href="{{ route('login') }}" class="block py-2 text-gray-900 hover:text-blue-700">Login</a>
          </li>
          @endauth
          @if(session('mentor_name'))
          <li>
            <a href="{{ route('mentoren.profile')}}" class="block py-2 text-gray-900 hover:text-blue-700">{{ session('mentor_name') }}</a>
          </li>
          @endif
        </ul>
      </div>

      <!-- Mobile Navbar -->
      <div id="mobile-navbar" class="hidden lg:hidden w-full bg-gray-50 absolute z-20 top-16 left-0 mt-4">
        <ul class="flex flex-col font-medium p-4 space-y-2 text-black">
          @if(session('mentor_name'))
          <li>
            <a href="{{ route('mentoren.profile')}}" class="block py-2 pl-2 text-gray-900 hover:bg-gray-200 rounded">{{ session('mentor_name') }}</a>
          </li>
          @endif
          <li>
            <a href="{{ route('kinderen.index') }}" class="block py-2 pl-2 text-gray-900 hover:bg-gray-200 rounded">Kinderen</a>
          </li>
          <li>
            <a href="{{ route('mentoren.index') }}" class="block py-2 pl-2 text-gray-900 hover:bg-gray-200 rounded">Mentor</a>
          </li>
          <li>
            <a href="{{ route('voorwerpen.index') }}" class="block py-2 pl-2 text-gray-900 hover:bg-gray-200 rounded">Voorwerpen</a>
          </li>
          @auth
          <li>
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="block py-2 pl-2 text-gray-900 hover:bg-gray-200 rounded w-full text-left">Logout</button>
            </form>
          </li>
          @else
          <li>
            <a href="{{ route('login') }}" class="block py-2 text-gray-900 hover:bg-gray-200 rounded">Login</a>
          </li>
          @endauth
        </ul>
      </div>
    </div>
  </nav>

</body>
</html>
<script>
  const toggleButton = document.getElementById("navbar-toggle");
  const mobileNavbar = document.getElementById("mobile-navbar");

  toggleButton.addEventListener("click", () => {
    const isExpanded = toggleButton.getAttribute("aria-expanded") === "true";
    toggleButton.setAttribute("aria-expanded", !isExpanded);
    mobileNavbar.classList.toggle("hidden");
  });
</script>