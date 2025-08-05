<div class="bg-white py-16 px-6 sm:px-12">
    <h2 class="text-4xl font-bold text-center text-green-700 mb-10">Recently Completed Projects</h2>

    <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 max-w-7xl mx-auto">
        @foreach ($projects as $project)
            @php
                $caption = "
                <div class='text-center space-y-4'>
                    <h2 class='text-xl font-bold text-green-700'>" . htmlspecialchars($project->title, ENT_QUOTES) . "</h2>
                    <p class='text-sm text-gray-700'>" . htmlspecialchars($project->description, ENT_QUOTES) . "</p>
                    <div class='flex justify-center gap-3 mt-4'>
                        <a href='https://www.facebook.com/sharer/sharer.php?u=" . urlencode(asset('storage/' . $project->image)) . "' target='_blank' class='bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-full text-sm'>Facebook</a>
                        <a href='https://twitter.com/intent/tweet?url=" . urlencode(asset('storage/' . $project->image)) . "&text=" . urlencode($project->title) . "' target='_blank' class='bg-blue-400 hover:bg-blue-500 text-white px-3 py-1 rounded-full text-sm'>Twitter</a>
                        <a href='https://www.linkedin.com/sharing/share-offsite/?url=" . urlencode(asset('storage/' . $project->image)) . "' target='_blank' class='bg-blue-700 hover:bg-blue-800 text-white px-3 py-1 rounded-full text-sm'>LinkedIn</a>
                    </div>
                </div>";
            @endphp

            <div class="bg-white border border-green-100 rounded-xl overflow-hidden shadow hover:shadow-lg transition transform hover:scale-[1.02]">
                <a data-fancybox="gallery" data-caption="{!! $caption !!}" href="{{ asset('storage/' . $project->image) }}">
                    <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-full h-48 object-cover" />
                </a>

                <div class="p-4">
                    <h3 class="text-lg font-semibold text-green-700">{{ $project->title }}</h3>
                    <p class="text-sm text-gray-600 mt-1">{{ \Illuminate\Support\Str::limit($project->description, 80) }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
