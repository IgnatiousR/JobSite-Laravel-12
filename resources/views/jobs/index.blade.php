<x-layout>
    <div class="bg-slate-900 h-24 px-4 mb-2 flex justify-center items-center rounded">
        <x-search/>
    </div>
    {{-- Back Button --}}
    @if (request()->has('keywords') || request()->has('location'))
    <a href="{{route('jobs.index')}}" class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded mb-4 inline-block">
        <i class="fa fa-arrow-left mr-1"></i> Back
    </a>
    @endif

    <h1 class=" text-2xl pb-4">Available Jobs</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        @forelse($jobs as $job)
        <x-job-card :job="$job"/>
            {{-- <div><a href="{{route('jobs.show', $job->id)}}">{{$job->title}}</a></div> --}}
        @empty
            <p>There are no jobs!</p>
        @endforelse
    </div>

    {{-- Pagination links --}}
    {{$jobs->links()}}
</x-layout>
