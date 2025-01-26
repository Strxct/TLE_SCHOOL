<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Navbar</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<nav class="relative h-[150px] lg:h-[300px] md:h-[200px]">
  <img class="w-full absolute top-0 left-0 z-10" src="{{ asset('assets/header.png') }}" alt="Logo">
  <div class="flex flex-wrap items-center justify-between mx-auto p-4 relative z-40">

    <!-- Mobile Navbar Toggle -->
    <button 
      id="navbar-toggle" 
      type="button" 
      class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" 
      aria-controls="mobile-navbar" 
      aria-expanded="false"
    >
      <span class="sr-only">Open main menu</span>
      <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
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
          <a href="{{ route('voorwerpen.index') }}" class="block py-2 text-gray-900 hover:text-blue-700">Items</a>
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
      </ul>
    </div>

    <!-- Mobile Navbar -->
    <div id="mobile-navbar" class="hidden md:hidden w-full bg-gray-50 absolute top-16 left-0">
      <ul class="flex flex-col font-medium p-4 space-y-2 text-black">
        <li>
          <a href="{{ route('kinderen.index') }}" class="block py-2 text-gray-900 hover:bg-gray-200 rounded">Kinderen</a>
        </li>
        <li>
          <a href="{{ route('mentoren.index') }}" class="block py-2 text-gray-900 hover:bg-gray-200 rounded">Mentor</a>
        </li>
        <li>
          <a href="{{ route('voorwerpen.index') }}" class="block py-2 text-gray-900 hover:bg-gray-200 rounded">Items</a>
        </li>
        @auth
        <li>
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="block py-2 text-gray-900 hover:bg-gray-200 rounded">Logout</button>
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

<script>
  const toggleButton = document.getElementById("navbar-toggle");
  const mobileNavbar = document.getElementById("mobile-navbar");

  toggleButton.addEventListener("click", () => {
    const isExpanded = toggleButton.getAttribute("aria-expanded") === "true";
    toggleButton.setAttribute("aria-expanded", !isExpanded);
    mobileNavbar.classList.toggle("hidden");
  });
</script>

</body>
</html>
