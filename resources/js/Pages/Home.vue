<script setup>
import { Head, Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';
import { ref } from 'vue';
import BookingRulesModal from '@/Components/BookingRulesModal.vue';

// Estado para el Modal de Reglas (Paso 2 de la reserva web)
const showRulesModal = ref(false);

// Estado para el Menú de Elección (Paso 1: ¿WhatsApp o Web?)
const showBookingOption = ref(false);

const handleWebBooking = () => {
    // Cerramos la elección y abrimos las reglas
    showBookingOption.value = false;
    showRulesModal.value = true;
};

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});
</script>

<template>
    <MainLayout>
        <Head title="Inicio" />

        <header class="relative flex items-center min-h-[85vh] overflow-hidden pt-10 pb-20 md:pt-0 md:pb-0">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-900 via-purple-900 to-gray-900 opacity-80 z-0"></div>
            <div class="absolute right-0 top-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-orange-500/20 rounded-full blur-[120px] pointer-events-none"></div>

            <div class="max-w-7xl mx-auto px-6 relative z-10 w-full">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div class="text-center md:text-left order-2 md:order-1">
                        <h1 class="text-5xl md:text-7xl lg:text-8xl font-black tracking-tight mb-6 drop-shadow-2xl leading-none">
                            <span class="block text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-yellow-400">SALTA</span>
                            SIN LÍMITES
                        </h1>
                        <p class="text-lg md:text-2xl text-gray-200 mb-10 max-w-lg mx-auto md:mx-0 leading-relaxed">
                            El parque de trampolines más extremo de Uruguay. <span class="text-orange-400 font-bold">Pista Ninja</span>, <span class="text-purple-400 font-bold">Dodgeball</span> y mucho más.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                            <button 
                                @click="showBookingOption = true"
                                class="bg-orange-500 text-white px-8 py-4 rounded-full font-black text-lg hover:scale-105 transition shadow-[0_0_30px_rgba(249,115,22,0.6)] hover:bg-orange-600 border-2 border-orange-500 cursor-pointer"
                            >
                                RESERVAR AHORA
                            </button>
                            
                            <Link :href="route('activities')" class="border-2 border-white text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-white hover:text-gray-900 transition inline-block text-center">
                                VER ATRACCIONES
                            </Link>
                        </div>
                    </div>
                    <div class="order-1 md:order-2 flex justify-center md:justify-end relative">
                        <img src="/images/R.png" alt="Mascota Summit Canguro" class="w-3/4 md:w-full max-w-md lg:max-w-lg object-contain drop-shadow-2xl hover:scale-105 transition-transform duration-500 animate-in fade-in zoom-in duration-1000" />
                        <div class="absolute top-10 right-10 bg-white text-gray-900 font-black px-6 py-3 rounded-tr-3xl rounded-bl-3xl rounded-tl-xl shadow-xl transform rotate-6 animate-bounce hidden md:block">¡HOLA AMIGOS! 👋</div>
                    </div>
                </div>
            </div>
        </header>

        <section class="py-24 mt-8 bg-gray-900">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-5xl font-black text-white uppercase tracking-tighter">EXPERIENCIA <span class="text-orange-500">SUMMIT</span></h2>
                </div>
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="bg-gray-800 p-10 rounded-3xl shadow-lg hover:shadow-blue-900/20 hover:-translate-y-3 transition-all duration-300 group text-center">
                        <div class="w-16 h-16 mx-auto bg-gray-900 rounded-2xl flex items-center justify-center mb-6 text-blue-500 group-hover:bg-blue-500 group-hover:text-white transition-colors duration-300 shadow-inner">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" /></svg>
                        </div>
                        <h3 class="text-2xl font-black text-white uppercase mb-3 tracking-wide">SEGURIDAD TOTAL</h3>
                        <p class="text-gray-400 text-sm leading-relaxed">Tu tranquilidad es primero. Monitores certificados en cada zona.</p>
                    </div>
                    <div class="bg-gray-800 p-10 rounded-3xl shadow-lg hover:shadow-purple-900/20 hover:-translate-y-3 transition-all duration-300 group text-center">
                        <div class="w-16 h-16 mx-auto bg-gray-900 rounded-2xl flex items-center justify-center mb-6 text-purple-500 group-hover:bg-purple-500 group-hover:text-white transition-colors duration-300 shadow-inner">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8.25v-1.5m0 1.5c-1.355 0-2.697.056-4.024.166C6.845 8.51 6 9.473 6 10.608v2.513m6-4.871c1.355 0 2.697.056 4.024.166C17.155 8.51 18 9.473 18 10.608v2.513M15 8.25v-1.5m-6 1.5v-1.5m12 9.75-1.5.75a3.354 3.354 0 0 1-3 0 3.354 3.354 0 0 0-3 0 3.354 3.354 0 0 0-3 0 3.354 3.354 0 0 1-3 0 1.5 1.5 0 0 1-1.5-1.5v3.75C3 19.332 5.617 21 8.85 21H15.15c3.233 0 5.85-1.668 5.85-3.75V17.25a1.5 1.5 0 0 1-1.5 1.5m-4.5 0-1.5-.75" /></svg>
                        </div>
                        <h3 class="text-2xl font-black text-white uppercase mb-3 tracking-wide">FIESTAS ÉPICAS</h3>
                        <p class="text-gray-400 text-sm leading-relaxed">La mejor fiesta del año. Comida, bebida y diversión ilimitada.</p>
                    </div>
                    <div class="bg-gray-800 p-10 rounded-3xl shadow-lg hover:shadow-orange-900/20 hover:-translate-y-3 transition-all duration-300 group text-center">
                        <div class="w-16 h-16 mx-auto bg-gray-900 rounded-2xl flex items-center justify-center mb-6 text-orange-500 group-hover:bg-orange-500 group-hover:text-white transition-colors duration-300 shadow-inner">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75c1.892 0 3.75.253 5.25.75v1.5c-1.5.5-3.358.75-5.25.75s-3.75-.25-5.25-.75v-1.5c1.5-.5 3.358-.75 5.25-.75Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M12.75 3v2.25m-3-2.25v2.25m-3-2.25v2.25m9 2.25v2.25m-3-2.25v2.25m-3-2.25v2.25M19.5 9.75a3 3 0 0 1 3 3v2.25c0 1.05-.28 2.031-.772 2.872a3 3 0 0 1-.58 3.528A2.25 2.25 0 0 1 19.5 22.5H4.5a2.25 2.25 0 0 1-1.648-3.6 3 3 0 0 1-.58-3.528A3 3 0 0 1 1.5 12.75V12.75a3 3 0 0 1 3-3h15Z" /></svg>
                        </div>
                        <h3 class="text-2xl font-black text-white uppercase mb-3 tracking-wide">ZONA DE PADRES</h3>
                        <p class="text-gray-400 text-sm leading-relaxed">Mientras ellos saltan, tú descansas. Cafetería con WiFi.</p>
                    </div>
                </div>
                <div class="mt-16 text-center">
                    <Link :href="route('activities')" class="inline-flex items-center gap-2 bg-orange-500 text-white px-8 py-4 rounded-full font-black text-lg hover:bg-orange-600 transition shadow-xl hover:shadow-orange-500/40 transform hover:-translate-y-1">
                        VER MÁS DETALLES
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                    </Link>
                </div>
            </div>
        </section>

        <section class="py-24 bg-gray-800 relative">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-5xl font-black text-white uppercase tracking-tighter mb-4">DIVERSIÓN <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-yellow-400">EXTREMA</span></h2>
                    <p class="text-gray-400 max-w-2xl mx-auto text-lg">Descubre nuestras zonas más populares. Desde saltos libres hasta desafíos de altura.</p>
                </div>
                <div class="grid md:grid-cols-3 gap-6 mb-12">
                    <div class="group relative h-[450px] rounded-3xl overflow-hidden cursor-pointer shadow-2xl">
                        <img src="/images/Web-BattleBeam.jpg" alt="Barra de Batalla" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent opacity-80 group-hover:opacity-60 transition-opacity duration-300"></div>
                        <div class="absolute bottom-0 left-0 p-8 w-full">
                            <h3 class="text-3xl font-black text-white italic uppercase mb-2 translate-y-2 group-hover:translate-y-0 transition-transform duration-300">Barra de Batalla</h3>
                            <p class="text-gray-300 text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform translate-y-2 group-hover:translate-y-0">Desafía a tus amigos a un duelo de equilibrio estilo gladiador.</p>
                        </div>
                    </div>
                    <div class="group relative h-[450px] rounded-3xl overflow-hidden cursor-pointer shadow-2xl border-4 border-transparent hover:border-orange-500 transition-all duration-300">
                        <img src="/images/Web-FoamPit.jpg" alt="Piscina de Cubos" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent opacity-80 group-hover:opacity-60 transition-opacity duration-300"></div>
                        <div class="absolute bottom-0 left-0 p-8 w-full">
                            <h3 class="text-3xl font-black text-white italic uppercase mb-2 translate-y-2 group-hover:translate-y-0 transition-transform duration-300">Piscina de Cubos</h3>
                            <p class="text-gray-300 text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform translate-y-2 group-hover:translate-y-0">Lánzate sin miedo y aterriza suavemente en espuma.</p>
                        </div>
                    </div>
                    <div class="group relative h-[450px] rounded-3xl overflow-hidden cursor-pointer shadow-2xl">
                        <img src="/images/Uruguay-WallClimbing.jpg" alt="Pared de Escalar" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent opacity-80 group-hover:opacity-60 transition-opacity duration-300"></div>
                        <div class="absolute bottom-0 left-0 p-8 w-full">
                            <h3 class="text-3xl font-black text-white italic uppercase mb-2 translate-y-2 group-hover:translate-y-0 transition-transform duration-300">Pared de Escalar</h3>
                            <p class="text-gray-300 text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform translate-y-2 group-hover:translate-y-0">Alcanza la cima y suéltate con confianza.</p>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <Link :href="route('activities')" class="inline-flex items-center gap-3 bg-transparent border-2 border-orange-500 text-orange-500 hover:bg-orange-500 hover:text-white px-10 py-4 rounded-full font-black text-lg uppercase tracking-widest transition-all duration-300 hover:shadow-[0_0_30px_rgba(249,115,22,0.4)]">
                        Ver todas las Actividades
                        <span aria-hidden="true" class="text-xl">→</span>
                    </Link>
                </div>
            </div>
        </section>

        <section class="py-24 bg-gray-900 overflow-hidden relative">
            <div class="absolute top-0 left-0 w-[600px] h-[600px] bg-orange-500/10 rounded-full blur-[120px] -translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>
            <div class="max-w-7xl mx-auto px-6 relative z-10">
                <div class="flex flex-col lg:flex-row items-center gap-16">
                    <div class="lg:w-1/2 text-center lg:text-left">
                        <div class="inline-block bg-orange-500/10 text-orange-500 border border-orange-500/20 px-4 py-1 rounded-full font-bold text-sm mb-6 tracking-wide uppercase">¡Celebrá Saltando!</div>
                        <h2 class="text-4xl md:text-6xl font-black text-white leading-tight mb-6">EL MEJOR <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-yellow-500">CUMPLEAÑOS</span> <br>DE TU VIDA</h2>
                        <p class="text-gray-400 text-lg mb-8 leading-relaxed">Olvídate del estrés. Nosotros nos encargamos de todo. <br><br><strong class="text-white">Incluye:</strong> Sala privada, anfitrión, calcetines y acceso al parque.</p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                            <Link :href="route('contact')" class="bg-orange-500 text-white px-8 py-4 rounded-full font-black text-lg hover:bg-orange-600 transition shadow-xl hover:shadow-orange-500/40 transform hover:-translate-y-1">VER PAQUETES DE FIESTA</Link>
                        </div>
                    </div>
                    <div class="lg:w-1/2 relative">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-4 mt-8">
                                <div class="rounded-3xl overflow-hidden shadow-2xl h-64 w-full transform hover:scale-105 transition duration-500 border-4 border-gray-800">
                                    <img src="/images/BANNER-GENTE-SUMMIT.jpg" alt="Niños felices" class="w-full h-full object-cover" />
                                </div>
                                <div class="bg-gray-800 p-6 rounded-3xl shadow-xl text-center flex flex-col justify-center h-40 transform -rotate-2 hover:rotate-0 transition duration-300 border border-gray-700">
                                    <span class="text-4xl font-black text-orange-500">100%</span>
                                    <span class="font-bold text-lg text-white">DIVERSIÓN</span>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="bg-orange-500 p-4 rounded-3xl shadow-lg text-white font-bold text-center uppercase tracking-widest text-sm transform rotate-3">¡Reserva Hoy!</div>
                                <div class="rounded-3xl overflow-hidden shadow-2xl h-80 w-full transform hover:scale-105 transition duration-500 border-4 border-gray-800">
                                    <img src="/images/BANNER-CELEBRA-CON-NOSOTROS-SUMMIT-779x1024.jpg" alt="Fiesta" class="w-full h-full object-cover" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-24 bg-gray-800 relative">
            <div class="max-w-7xl mx-auto px-6">
                <div class="grid lg:grid-cols-2 gap-16 items-start">
                    <div class="space-y-10">
                        <div>
                            <h2 class="text-4xl md:text-5xl font-black text-white uppercase tracking-tighter mb-2">
                                VISÍTANOS
                            </h2>
                            <div class="w-24 h-1.5 bg-orange-500 rounded-full"></div>
                        </div>
                        <div class="grid sm:grid-cols-2 gap-6">
                            <div class="bg-gray-800/50 p-6 rounded-2xl border border-gray-700 hover:border-orange-500/50 transition duration-300 group">
                                <div class="w-10 h-10 bg-orange-500/20 rounded-full flex items-center justify-center text-orange-500 mb-4 group-hover:bg-orange-500 group-hover:text-white transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>
                                </div>
                                <h4 class="text-white font-bold uppercase mb-2">Dirección</h4>
                                <p class="text-gray-400 text-sm leading-relaxed">
                                    Dr. Martín Aguirre 4148<br>
                                    Esq. Habana (Funsa)<br>
                                    Villa Española, Montevideo
                                </p>
                            </div>
                            <div class="bg-gray-800/50 p-6 rounded-2xl border border-gray-700 hover:border-blue-500/50 transition duration-300 group">
                                <div class="w-10 h-10 bg-blue-500/20 rounded-full flex items-center justify-center text-blue-500 mb-4 group-hover:bg-blue-500 group-hover:text-white transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </div>
                                <h4 class="text-white font-bold uppercase mb-2">Horarios</h4>
                                <ul class="text-gray-400 text-sm space-y-1">
                                    <li class="flex justify-between"><span>Lunes - Viernes:</span> <span class="text-white">14 - 21 hs</span></li>
                                    <li class="flex justify-between"><span>Sábados:</span> <span class="text-white">10 - 21 hs</span></li>
                                    <li class="flex justify-between"><span>Domingos:</span> <span class="text-white">11 - 21 hs</span></li>
                                </ul>
                            </div>
                        </div>
                        <div>
                            <h4 class="text-gray-500 font-bold uppercase text-xs tracking-widest mb-4">Síguenos en Redes</h4>
                            <div class="flex flex-wrap gap-4">
                                <a href="https://instagram.com/summituruguay" target="_blank" class="w-full sm:w-auto flex items-center justify-center gap-2 px-6 py-3 rounded-full border border-gray-600 text-gray-400 font-bold transition-all duration-300 hover:text-white hover:scale-105 hover:border-transparent hover:bg-gradient-to-r hover:from-purple-600 hover:via-pink-500 hover:to-orange-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                                    Instagram
                                </a>
                                <a href="https://facebook.com/summituruguay" target="_blank" class="w-full sm:w-auto flex items-center justify-center gap-2 px-6 py-3 rounded-full border border-gray-600 text-gray-400 font-bold transition-all duration-300 hover:text-white hover:scale-105 hover:bg-[#1877F2] hover:border-[#1877F2]">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                                    Facebook
                                </a>
                                <a href="https://wa.me/59897104037" target="_blank" class="w-full sm:w-auto flex items-center justify-center gap-2 px-6 py-3 rounded-full border border-gray-600 text-gray-400 font-bold transition-all duration-300 hover:text-white hover:scale-105 hover:bg-[#25D366] hover:border-[#25D366]">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                                    WhatsApp
                                </a>
                                <a href="mailto:info@summittrampolineparkuruguay.com" class="w-full sm:w-auto flex items-center justify-center gap-2 px-6 py-3 rounded-full border border-gray-600 text-gray-400 font-bold transition-all duration-300 hover:text-white hover:scale-105 hover:bg-orange-500 hover:border-orange-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                    Email
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="h-full min-h-[400px] rounded-3xl overflow-hidden shadow-2xl border-4 border-gray-800 relative group">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3272.955376510839!2d-56.13880892424687!3d-34.88256247285641!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x959f810165445209%3A0x6730388d7f261352!2sDr.%20Mart%C3%ADn%20Aguirre%204148%2C%2012000%20Montevideo%2C%20Departamento%20de%20Montevideo!5e0!3m2!1ses-419!2suy!4v1700000000000!5m2!1ses-419!2suy" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="grayscale group-hover:grayscale-0 transition-all duration-700 w-full h-full"></iframe>
                        <div class="absolute bottom-6 left-6 bg-white text-gray-900 p-4 rounded-xl shadow-xl max-w-xs hidden sm:block transform translate-y-2 opacity-90 hover:opacity-100 transition">
                            <p class="font-black text-xs uppercase tracking-wider text-orange-600 mb-1">Punto de Encuentro</p>
                            <p class="font-bold text-sm">Summit Trampoline Park</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-24 bg-gray-900 relative overflow-hidden border-t border-gray-800">
            <div class="max-w-7xl mx-auto px-6 relative z-10">
                <div class="text-center mb-16">
                    <div class="inline-flex items-center gap-2 bg-white/10 px-4 py-1.5 rounded-full mb-6 border border-white/10 backdrop-blur-sm">
                        <span class="text-xs font-bold text-white uppercase tracking-wider">Rating 4.9/5.0</span>
                    </div>
                    <h2 class="text-3xl md:text-5xl font-black text-white uppercase tracking-tighter">LO QUE DICEN <span class="text-orange-500">NUESTROS SALTADORES</span></h2>
                </div>
                <div class="grid md:grid-cols-3 gap-6">
                    <div class="bg-gray-800 p-8 rounded-3xl border border-gray-700 hover:border-orange-500/50 transition duration-300">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-10 h-10 rounded-full bg-purple-500 flex items-center justify-center text-white font-bold text-lg">M</div>
                            <div><h4 class="text-white font-bold text-sm">María Fernández</h4><div class="flex text-orange-500 text-xs">★★★★★</div></div>
                        </div>
                        <p class="text-gray-400 text-sm leading-relaxed">"¡Increíble experiencia! Celebré el cumple de mi hijo aquí y fue todo perfecto."</p>
                    </div>
                    <div class="bg-gray-800 p-8 rounded-3xl border border-gray-700 hover:border-orange-500/50 transition duration-300 transform md:-translate-y-4 shadow-xl shadow-orange-500/10">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold text-lg">J</div>
                            <div><h4 class="text-white font-bold text-sm">Juan Pablo Silva</h4><div class="flex text-orange-500 text-xs">★★★★★</div></div>
                        </div>
                        <p class="text-gray-400 text-sm leading-relaxed">"La Pista Ninja es lo mejor. El lugar es enorme y tiene aire acondicionado."</p>
                    </div>
                    <div class="bg-gray-800 p-8 rounded-3xl border border-gray-700 hover:border-orange-500/50 transition duration-300">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-10 h-10 rounded-full bg-green-500 flex items-center justify-center text-white font-bold text-lg">L</div>
                            <div><h4 class="text-white font-bold text-sm">Lucía Méndez</h4><div class="flex text-orange-500 text-xs">★★★★★</div></div>
                        </div>
                        <p class="text-gray-400 text-sm leading-relaxed">"Muy buena atención del personal. Sin duda volveremos el próximo fin de semana."</p>
                    </div>
                </div>
                <div class="text-center mt-12">
                    <a href="https://www.google.com/maps/place/Summit+Trampoline+Park+Uruguay" target="_blank" class="inline-flex items-center gap-2 text-sm font-bold text-gray-400 hover:text-orange-500 transition border-b border-transparent hover:border-orange-500 pb-0.5">Ver todas las reseñas en Google Maps <span>→</span></a>
                </div>
            </div>
        </section>

        <div v-if="showBookingOption" class="fixed inset-0 z-[60] overflow-y-auto" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen px-4 text-center">
                
                <div class="fixed inset-0 bg-gray-900/95 backdrop-blur-md transition-opacity" @click="showBookingOption = false"></div>

                <div class="relative bg-gray-800 rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:max-w-md w-full border border-gray-700 p-8">
                    
                    <button @click="showBookingOption = false" class="absolute top-4 right-4 text-gray-400 hover:text-white transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>

                    <div class="text-center mb-8">
                        <h3 class="text-2xl font-black text-white uppercase mb-2">¿Cómo deseas reservar?</h3>
                        <p class="text-gray-400 text-sm">Elige la opción que prefieras para coordinar tu salto.</p>
                    </div>

                    <div class="grid gap-4">
                        <a href="https://wa.me/59897104037" target="_blank" class="group flex items-center justify-between p-4 bg-[#25D366]/10 hover:bg-[#25D366] border border-[#25D366]/30 hover:border-[#25D366] rounded-2xl transition-all duration-300">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-[#25D366] group-hover:bg-white text-white group-hover:text-[#25D366] rounded-full flex items-center justify-center transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                                </div>
                                <div class="text-left">
                                    <span class="block text-white font-black uppercase text-lg group-hover:text-white">WhatsApp</span>
                                    <span class="block text-gray-400 text-xs group-hover:text-white/80">Atención personalizada</span>
                                </div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#25D366] group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                        </a>

                        <button @click="handleWebBooking" class="group flex items-center justify-between p-4 bg-orange-500/10 hover:bg-orange-500 border border-orange-500/30 hover:border-orange-500 rounded-2xl transition-all duration-300">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-orange-500 group-hover:bg-white text-white group-hover:text-orange-500 rounded-full flex items-center justify-center transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                                </div>
                                <div class="text-left">
                                    <span class="block text-white font-black uppercase text-lg group-hover:text-white">Desde la Web</span>
                                    <span class="block text-gray-400 text-xs group-hover:text-white/80">Rápido y automático</span>
                                </div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-orange-500 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <BookingRulesModal 
            :show="showRulesModal" 
            @close="showRulesModal = false" 
        />

    </MainLayout>
</template>