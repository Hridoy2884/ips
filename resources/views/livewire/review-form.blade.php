<section class="bg-gray-50 py-16 px-6 sm:px-12">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-4xl font-bold text-center text-green-700 mb-10">Customer Reviews</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-10">
            {{-- Review Form --}}
            <div class="bg-white p-6 rounded-lg shadow">
                <form wire:submit.prevent="submit" class="space-y-4">
                    @if (session()->has('success'))
                        <div class="bg-green-100 text-green-800 p-3 rounded">{{ session('success') }}</div>
                    @endif

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" wire:model="name" class="w-full mt-1 border p-2 rounded">
                        @error('name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email (optional)</label>
                        <input type="email" wire:model="email" class="w-full mt-1 border p-2 rounded">
                        @error('email') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Comment</label>
                        <textarea wire:model="comment" rows="3" class="w-full mt-1 border p-2 rounded"></textarea>
                        @error('comment') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Rating</label>
                        <select wire:model="rating" class="w-full mt-1 border p-2 rounded">
                            <option value="">Choose rating</option>
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                            @endfor
                        </select>
                        @error('rating') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded w-full">
                        Submit Review
                    </button>
                </form>
            </div>

            {{-- Show Reviews --}}
            <div class="space-y-6">
                @if($reviews->count())
                    <h3 class="text-xl font-semibold text-green-800">What others say:</h3>
                    @foreach($reviews as $review)
                        <div class="p-4 border rounded-lg bg-white shadow-sm">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-bold text-green-700">{{ $review->name }}</span>
                                <div class="flex text-yellow-400">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="w-5 h-5 {{ $i <= $review->rating ? 'fill-current' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 15l-5.878 3.09L5.954 12 1.73 7.91l6.09-.88L10 2l2.18 5.03 6.09.88L14.046 12l1.832 6.09z"/>
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                            <p class="text-gray-700">{{ $review->comment }}</p>
                        </div>
                    @endforeach
                @else
                    <p class="text-gray-500">No reviews yet. Be the first to leave one!</p>
                @endif
            </div>
        </div>
    </div>
</section>
