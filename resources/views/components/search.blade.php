<form method="GET" action="{{route('job.search')}}" class="block mx-5 space-y-2 md:mx-auto md:space-x-2">
    <input
        type="text"
        name="keywords"
        placeholder="Keywords"
        class="w-full md:w-72 px-4 py-3 focus:outline-none bg-amber-50 rounded"
        value="{{request('keywords')}}"
    />
    <input
        type="text"
        name="location"
        placeholder="Location"
        class="w-full md:w-72 px-4 py-3 focus:outline-none bg-amber-50 rounded"
        value="{{request('location')}}"
    />
    <button
        class="w-full md:w-auto bg-white/20 hover:bg-white/25 text-white px-4 py-3 focus:outline-none rounded-lg"
    >
        <i class="fa fa-search mr-1"></i> Search
    </button>
</form>
