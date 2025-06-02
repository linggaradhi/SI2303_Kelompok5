<div id="imgZoomModal"
    class="fixed z-[100] inset-0 bg-black/60 flex items-center justify-center hidden transition-all duration-300">
    <div class="relative group animate-none opacity-0 scale-95 transition-all duration-300" id="imgZoomBox">
        <img id="zoomedImg" src="" alt="Sepatu"
            class="max-h-[80vh] max-w-[90vw] rounded-2xl shadow-2xl border-4 border-white select-none transition-all duration-300">
        <button id="closeImgZoom"
            class="absolute -top-3 -right-3 bg-white text-gray-600 hover:text-red-500 rounded-full shadow px-2 py-1 text-lg">&times;</button>
        <button id="prevImgZoom"
            class="absolute left-0 top-1/2 -translate-y-1/2 bg-white/60 hover:bg-white text-gray-600 hover:text-blue-500 rounded-full shadow px-2 py-1 text-2xl font-bold z-10 hidden">&#8592;</button>
        <button id="nextImgZoom"
            class="absolute right-0 top-1/2 -translate-y-1/2 bg-white/60 hover:bg-white text-gray-600 hover:text-blue-500 rounded-full shadow px-2 py-1 text-2xl font-bold z-10 hidden">&#8594;</button>
    </div>
</div>
