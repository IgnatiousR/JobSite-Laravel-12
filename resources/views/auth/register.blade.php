<x-layout>
    <div class="bg-white/5 rounded-lg shadow-md w-full md:max-w-xl mx-auto mt-12 p-8 py-12 text-white">
        <h2 class="text-4xl text-center font-bold mb-4">Register</h2>
        <form method="POST" action={{route('register.store')}}>
            @csrf
            <x-inputs.text id="name" name="name" placeholder="Full name" label="Full Name"/>
            <x-inputs.text id="email" name="email" placeholder="Email" type="email" label="Email"/>
            <x-inputs.text id="password" name="password" placeholder="Password" type="password" label="Password"/>
            <x-inputs.text id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" type="password" label="Confirm Password"/>
            <x-inputs.file id="avatar" name="avatar" label="Profile Picture (Optional)" />

            <button type="submit"
            class="w-full bg-slate-500 hover:bg-slate-600 text-white px-4 py-2 my-2 rounded-lg focus:outline-none cursor-pointer">Register</button>

            <p class=" text-white/10">Already have an account?
                <a href="{{route('login')}}" class="text-white hover:underline py-1">Login</a>
            </p>
        </form>
    </div>
</x-layout>
