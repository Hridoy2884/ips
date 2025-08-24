<footer class="bg-green-100 text-gray-800 w-full">

  <!-- Features Section -->
  <section class="bg-green-50 border-t border-b border-green-200 py-8 mb-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">

        <!-- Best Quality -->
        <div class="flex flex-col items-center p-4 rounded-lg hover:shadow-lg transition" 
             data-aos="fade-up" data-aos-delay="100">
          <i class="fas fa-award text-green-700 text-4xl mb-3"></i>
          <h4 class="font-semibold text-green-800">BEST QUALITY</h4>
          <p class="text-sm text-gray-600">Many years on the market</p>
        </div>

        <!-- 24/7 Support -->
        <div class="flex flex-col items-center p-4 rounded-lg hover:shadow-lg transition" 
             data-aos="fade-up" data-aos-delay="200">
          <i class="fas fa-headset text-green-700 text-4xl mb-3"></i>
          <h4 class="font-semibold text-green-800">24/7 SUPPORT</h4>
          <p class="text-sm text-gray-600">If you have any questions</p>
        </div>

        <!-- Secure Payment -->
        <div class="flex flex-col items-center p-4 rounded-lg hover:shadow-lg transition" 
             data-aos="fade-up" data-aos-delay="300">
          <i class="fas fa-lock text-green-700 text-4xl mb-3"></i>
          <h4 class="font-semibold text-green-800">SECURE PAYMENT</h4>
          <p class="text-sm text-gray-600">100% secure payment</p>
        </div>

        <!-- Fast Delivery -->
        <div class="flex flex-col items-center p-4 rounded-lg hover:shadow-lg transition" 
             data-aos="fade-up" data-aos-delay="400">
          <i class="fas fa-shipping-fast text-green-700 text-4xl mb-3"></i>
          <h4 class="font-semibold text-green-800">FAST DELIVERY</h4>
          <p class="text-sm text-gray-600">Fast and reliable delivery</p>
        </div>

      </div>
    </div>
  </section>

  <!-- Brand Section -->
  <div class="w-full max-w-7xl py-12 px-4 sm:px-6 lg:px-8 mx-auto">

    <div class="text-center lg:text-left mb-10">
      <a href="#" class="flex items-center justify-center lg:justify-start gap-3 mb-4">
        <img src="/storage/logo/logo.png" alt="Jui Power Logo" class="h-12 w-auto">
        <span class="text-2xl font-bold tracking-wide text-green-900">Jui Power Digital IPS</span>
      </a>
      <p class="text-sm text-green-700 max-w-lg mx-auto lg:mx-0 leading-relaxed">
        Powering homes with reliable, efficient, and affordable IPS solutions across Bangladesh.
      </p>
    </div>

    <!-- Links Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

      <!-- About Us -->
      <div class="text-center sm:text-left">
        <h4 class="font-semibold text-green-900 mb-3 text-lg">About Us</h4>
        <p class="text-sm text-green-700">
          At <strong>Jui Power Digital IPS</strong>, we deliver top-tier power backup systems for
          modern-day needs. Every detail reflects quality and innovation.
        </p>
      </div>

      <!-- Policies -->
      <div class="text-center sm:text-left">
        <h4 class="font-semibold text-green-900 mb-3 text-lg">Policies</h4>
        <ul class="space-y-2">
          @foreach (\App\Models\Policy::all() as $policy)
            <li>
              <a href="{{ route('policy.show', $policy->slug) }}"
                 class="text-green-700 hover:text-green-900 transition">
                 {{ $policy->title }}
              </a>
            </li>
          @endforeach
        </ul>
      </div>

      <!-- Contact -->
      <div class="text-center sm:text-left">
        <h4 class="font-semibold text-green-900 mb-3 text-lg">Contact Us</h4>
        <ul class="text-sm text-green-700 space-y-2">
          <li><strong>Phone:</strong> <a href="tel:01713540038" class="hover:text-green-900 font-medium">01713-540038</a></li>
          <li><strong>Email:</strong> <a href="mailto:info.juipowerbd@gmail.com" class="hover:text-green-900 font-medium">info.juipowerbd@gmail.com</a></li>
          <li><strong>Address:</strong> Gazipur National University, Bangladesh</li>
        </ul>
        <a href="https://maps.app.goo.gl/WvQGCh7RL7FqLnLF6?g_st=aw" target="_blank"
           class="inline-block mt-4 bg-green-700 text-white hover:bg-green-800 font-semibold py-2 px-4 rounded-lg transition">
          📍 Get Directions
        </a>
      </div>

    </div>

    <!-- Bottom Bar -->
    <div class="mt-10 border-t border-green-300 pt-6 flex flex-col md:flex-row justify-between items-center gap-4">
      <p class="text-sm text-green-800 text-center md:text-left">
        © 2025 Jui Power Digital IPS. All rights reserved.
      </p>

      <!-- Social Icons -->
      <div class="flex justify-center gap-3">
        <a href="https://www.facebook.com/jpdisp" target="_blank" aria-label="Facebook"
           class="w-10 h-10 flex items-center justify-center rounded-full bg-green-700 text-white hover:bg-green-800 transition">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="https://www.youtube.com/@juipowerdigitalips" target="_blank" aria-label="YouTube"
           class="w-10 h-10 flex items-center justify-center rounded-full bg-green-700 text-white hover:bg-green-800 transition">
          <i class="fab fa-youtube"></i>
        </a>
        <a href="https://wa.me/8801713540038" target="_blank" aria-label="WhatsApp"
           class="w-10 h-10 flex items-center justify-center rounded-full bg-green-700 text-white hover:bg-green-800 transition">
          <i class="fab fa-whatsapp"></i>
        </a>
      </div>
    </div>

  </div>
</footer>


{{-- feature animation script --}}
<script>
  AOS.init({
    duration: 1200, // scroll animation duration
    once: true,     // animate only once
    mirror: false   // animations won't repeat on scroll back
  });
</script>
