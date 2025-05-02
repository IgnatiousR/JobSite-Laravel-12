<x-layout>
    <div class="bg-white/5 rounded-lg shadow-md w-full md:max-w-xl mx-auto mt-12 p-8 py-12 text-white">
        <h2 class="text-4xl text-center font-bold mb-4">Login</h2>
        <form method="POST" action={{route('login.authenicate')}}>
            @csrf
            <x-inputs.text id="email" name="email" placeholder="Email" type="email" label="Email"/>
            <x-inputs.text id="password" name="password" placeholder="Password" type="password" label="Password"/>

            <button type="submit"
            class="w-full bg-white/10 hover:bg-white/25 text-white px-4 py-2 my-3 rounded-lg focus:outline-none cursor-pointer"
            >Login</button>

            <p class="mt-4 text-white/10">Don't have an account?
                <a href="{{route('register')}}" class="text-white hover:underline py-2">Register</a>
            </p>
        </form>
    </div>
</x-layout>
