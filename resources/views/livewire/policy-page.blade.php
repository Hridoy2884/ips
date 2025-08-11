<div class="bg-gray-50 py-16">
  <div class="max-w-3xl mx-auto px-6 sm:px-8 lg:px-12">
    <h1 class="text-4xl font-extrabold text-green-700 mb-8 tracking-tight drop-shadow-md">
      {{ $policy->title }}
    </h1>

    <div class="prose prose-lg max-w-none text-gray-800 dark:text-gray-200 leading-relaxed md:prose-xl">
      {!! $policy->content !!}
    </div>
  </div>
</div>
