<header class="banner fixed z-50 w-full">
  <div class="container-fluid px-4">
    <div class='flex justify-between'>
      <a class="brand font-bold text-2xl uppercase border-none" href="{{ home_url('/') }}">{{ get_bloginfo('name', 'display') }}</a>
      <button id='menuToggle' type='button' class='rounded-full bg-primary w-12 h-12 bg-primary shadow-lg mt-5 relative collapse mr-10'>
        <span class='sr-only'></span>
        <span class='menu-bar'></span>
      </button>
    </div>
  </div>
</header>
