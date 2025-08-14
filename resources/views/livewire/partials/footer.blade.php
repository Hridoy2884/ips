<footer class="bg-white w-full">
    <div class="w-full max-w-7xl py-10 px-4 sm:px-6 lg:px-8 mx-auto">
        <!-- Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8">

            <!-- Brand -->
            <div class="col-span-full lg:col-span-2">
                <a href="#" aria-label="Brand" class="text-2xl font-bold text-green-700 block mb-2">Jui Power Digital
                    IPS</a>
                <p class="text-sm text-gray-600">Powering homes with reliable, efficient, and affordable IPS solutions
                    across Bangladesh.</p>
            </div>

            <!-- About -->
            <div class="col-span-1">
                <h4 class="font-semibold text-green-700 mb-3">About Us</h4>
                <p class="text-sm text-gray-600">
                    At <strong>Jui Power Digital IPS</strong>, we specialize in delivering top-tier power backup systems
                    that meet modern-day demands. From product design to user experience, every detail reflects quality
                    and innovation.
                </p>
            </div>

            <!-- Policies -->
            <div class="col-span-1">
                <h4 class="font-semibold text-green-700 mb-3">Policies</h4>
                <ul>
                    @foreach (\App\Models\Policy::all() as $policy)
                        <li>
                            <a href="{{ route('policy.show', $policy->slug) }}" class="hover:underline">
                                {{ $policy->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>

            </div>

            <!-- Contact -->
            <div class="col-span-2">
                <h4 class="font-semibold text-green-700 mb-3">Contact Us</h4>
                <div class="text-sm text-gray-600 space-y-2">
                    <p><strong>Phone:</strong> <a href="tel:01713540038"
                            class="hover:text-green-600 font-medium">01713-540038</a></p>
                    <p><strong>Email:</strong> <a href="mailto:support@juipower.com"
                            class="hover:text-green-600 font-medium">support@juipower.com</a></p>
                    <p><strong>Address:</strong> Gazipur National University, Bangladesh</p>
                    <a href="https://maps.app.goo.gl/WvQGCh7RL7FqLnLF6?g_st=aw" target="_blank"
                        class="inline-block mt-3 bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition-all">
                        📍 Get Directions
                    </a>
                </div>
            </div>

        </div>
        <!-- End Grid -->

        <div class="mt-10 border-t pt-6 flex flex-col md:flex-row justify-between items-center">
            <p class="text-sm text-gray-500 mb-4 md:mb-0">© 2025 Jui Power Digital IPS. All rights reserved.</p>

            <!-- Social Icons -->
            <div class="flex gap-3">
                <a href="https://www.facebook.com/jpdisp" target="_blank" aria-label="Facebook"
                    class="w-10 h-10 flex items-center justify-center rounded-full text-green-600 border border-green-100 hover:bg-green-100 transition">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://www.youtube.com/@juipowerdigitalips" target="_blank" aria-label="YouTube"
                    class="w-10 h-10 flex items-center justify-center rounded-full text-green-600 border border-green-100 hover:bg-green-100 transition">
                    <i class="fab fa-youtube"></i>
                </a>
                <a href="https://wa.me/01713540038" target="_blank" aria-label="WhatsApp"
                    class="w-10 h-10 flex items-center justify-center rounded-full text-green-600 border border-green-100 hover:bg-green-100 transition">
                    <i class="fab fa-whatsapp"></i>
                </a>
            </div>
        </div>
    </div>
</footer>
