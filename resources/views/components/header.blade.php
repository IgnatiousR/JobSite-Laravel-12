<header class="bg-black text-white p-4" x-data="{open: false}">
    <div class="container mx-auto flex justify-between items-center border-b border-white/20">
        <h1 class="text-3xl font-semibold">
            <a href="{{url('/')}}">JobSite</a>
        </h1>
        <nav class="hidden md:flex items-center space-x-4 ">
            <x-nav-link url="/" :active="request()->is('/')">Home</x-nav-link>
            <x-nav-link url="/jobs" :active="request()->is('jobs')">All Jobs</x-nav-link>
            @auth
            <x-nav-link url="/bookmarks" :active="request()->is('bookmarks')">Saved Jobs</x-nav-link>
            <x-logout-button/>
            <x-button-link url="/jobs/create" icon="edit" bgClass="bg-yellow-500" hoverClass="hover:bg-yellow-600">Create Job</x-button-link>
            <div class="flex items-center space-x-3">
                <a href="{{route('dashboard')}}">
                    @if(Auth::user()->avatar)
                    <img src="{{asset('storage/' . Auth::user()->avatar)}}" alt="{{Auth::user()->name}}"
                        class="w-10 h-10 rounded-full">
                    @else
                    <img src="{{asset('storage/avatars/default-profile-pic.jpg')}}" alt="{{Auth::user()->name}}"
                        class="w-10 h-10 rounded-full">
                    @endif
                </a>
            </div>
            @else
            <x-nav-link url="/login" :active="request()->is('login')" icon="user">Login</x-nav-link>
            <x-nav-link url="/register" :active="request()->is('register')">Register</x-nav-link>
            @endauth
        </nav>
        <button @click="open = !open" id="hamburger" class="text-white md:hidden flex items-center cursor-pointer">
            <i class="fa fa-bars text-2xl"></i>
        </button>
    </div>
    <!-- Mobile Menu -->
    <nav x-show="open" @click.away="open = false"
        id="mobile-menu"
        class="md:hidden bg-stone-700 text-white mt-5 pb-4 space-y-2">
        <x-nav-link url="/jobs" :mobile="true" :active="request()->is('jobs')">All Jobs</x-nav-link>
        @auth
        <x-nav-link url="/bookmarks" :mobile="true" :active="request()->is('bookmarks')">Saved Jobs</x-nav-link>
        <x-nav-link url="/Dashboard" :mobile="true" :active="request()->is('dashboard')" icon="gauge">Dashboard</x-nav-link>
        <x-logout-button class="pt-2"/>
        <x-button-link url='/jobs/create' :block="true" :active="request()->is('jobs/create')" icon='edit'
            bgClass="bg-yellow-500" hoverClass="hover:bg-yellow-600">Create Job</x-button-link>
        @else
        <x-nav-link url="/login" :mobile="true" :active="request()->is('login')">Login</x-nav-link>
        <x-nav-link url="/register" :mobile="true" :active="request()->is('register')">Register</x-nav-link>
        @endauth
    </nav>
</header>
