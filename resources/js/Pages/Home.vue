<script setup>
import { Head, Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';
import { ref } from 'vue';
import BookingRulesModal from '@/Components/BookingRulesModal.vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});

// --- Estado ---
const showRulesModal = ref(false);
const showBookingOption = ref(false);

const handleWebBooking = () => {
    showBookingOption.value = false;
    showRulesModal.value = true;
};

// --- DATOS ---
const mainFeatures = [
    {
        title: 'SEGURIDAD TOTAL',
        desc: 'Tu tranquilidad es primero. Monitores certificados en cada zona.',
        color: 'blue',
        icon: 'M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z'
    },
    {
        title: 'FIESTAS ÉPICAS',
        desc: 'La mejor fiesta del año. Comida, bebida y diversión ilimitada.',
        color: 'purple',
        icon: 'M12 8.25v-1.5m0 1.5c-1.355 0-2.697.056-4.024.166C6.845 8.51 6 9.473 6 10.608v2.513m6-4.871c1.355 0 2.697.056 4.024.166C17.155 8.51 18 9.473 18 10.608v2.513M15 8.25v-1.5m-6 1.5v-1.5m12 9.75-1.5.75a3.354 3.354 0 0 1-3 0 3.354 3.354 0 0 0-3 0 3.354 3.354 0 0 0-3 0 3.354 3.354 0 0 1-3 0 1.5 1.5 0 0 1-1.5-1.5v3.75C3 19.332 5.617 21 8.85 21H15.15c3.233 0 5.85-1.668 5.85-3.75V17.25a1.5 1.5 0 0 1-1.5 1.5m-4.5 0-1.5-.75'
    },
    {
        title: 'ZONA DE PADRES',
        desc: 'Mientras ellos saltan, tú descansas. Cafetería con WiFi.',
        color: 'orange',
        icon: 'M9.75 9.75c1.892 0 3.75.253 5.25.75v1.5c-1.5.5-3.358.75-5.25.75s-3.75-.25-5.25-.75v-1.5c1.5-.5 3.358-.75 5.25-.75Z M12.75 3v2.25m-3-2.25v2.25m-3-2.25v2.25m9 2.25v2.25m-3-2.25v2.25m-3-2.25v2.25M19.5 9.75a3 3 0 0 1 3 3v2.25c0 1.05-.28 2.031-.772 2.872a3 3 0 0 1-.58 3.528A2.25 2.25 0 0 1 19.5 22.5H4.5a2.25 2.25 0 0 1-1.648-3.6 3 3 0 0 1-.58-3.528A3 3 0 0 1 1.5 12.75V12.75a3 3 0 0 1 3-3h15Z'
    },
];

const cafeFeatures = [
    { name: 'Vista a Pistas', icon: 'M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z' },
    { name: 'WiFi Rápido', icon: 'M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.008v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.008v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 17.25h.008v.008H3.75V17.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z' },
    { name: 'Café & Snacks', icon: 'M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3' },
];

const testimonials = [
    { name: 'María Fernández', initial: 'M', color: 'purple', stars: 5, text: '¡Increíble experiencia! Celebré el cumple de mi hijo aquí y fue todo perfecto.' },
    { name: 'Juan Pablo Silva', initial: 'J', color: 'blue', stars: 5, text: 'La Pista Ninja es lo mejor. El lugar es enorme y tiene aire acondicionado.', highlighted: true },
    { name: 'Lucía Méndez', initial: 'L', color: 'green', stars: 5, text: 'Muy buena atención del personal. Sin duda volveremos el próximo fin de semana.' },
];

const socialLinks = [
    { name: 'Instagram', url: 'https://instagram.com/summituruguay', hoverClass: 'hover:bg-gradient-to-r hover:from-purple-600 hover:via-pink-500 hover:to-orange-500 hover:text-white', icon: '<rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>' },
    { name: 'Facebook', url: 'https://facebook.com/summituruguay', hoverClass: 'hover:bg-[#1877F2] hover:text-white', icon: '<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>' },
    { name: 'WhatsApp', url: 'https://wa.me/59897104037', hoverClass: 'hover:bg-[#25D366] hover:text-white', icon: '<path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>' },
    { name: 'Email', url: 'mailto:info@summittrampolineparkuruguay.com', hoverClass: 'hover:bg-orange-500 hover:text-white', icon: '<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline>' },
];

const bookingOptions = [
    { type: 'link', url: 'https://wa.me/59897104037', title: 'WhatsApp', desc: 'Atención personalizada', color: '[#25D366]', icon: '<path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>' },
    { type: 'button', action: handleWebBooking, title: 'Desde la Web', desc: 'Rápido y automático', color: 'orange-500', icon: '<circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>' }
];
</script>

<template>
    <MainLayout>
        <Head title="Inicio" />

        <div class="relative bg-summit-pattern min-h-screen text-gray-100 font-sans">

            <header class="relative flex items-center h-[90vh] md:h-screen overflow-hidden bg-[#0a0f1d] z-10 border-b border-white/5">
    
    <div class="absolute inset-0 bg-[#0a0f1d]"></div>

    <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_-20%,_#1e293b_0%,_transparent_50%)]"></div>

    <div class="absolute inset-0 pointer-events-none opacity-20">
        <div class="absolute top-[10%] left-[10%] w-64 h-64 border border-indigo-500/30 rounded-full scale-150 animate-pulse"></div>
        <div class="absolute bottom-[20%] right-[15%] w-96 h-96 border border-orange-500/20 rounded-full"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-[radial-gradient(circle,_#6366f10a_1px,_transparent_1px)] [background-size:32px_32px]"></div>
    </div>

    <div class="absolute top-1/4 -left-20 w-[40%] h-[40%] bg-indigo-600/10 rounded-full blur-[120px]"></div>
    <div class="absolute bottom-1/4 -right-20 w-[40%] h-[40%] bg-orange-600/10 rounded-full blur-[120px]"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10 w-full">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            
            <div class="text-center md:text-left order-2 md:order-1">
                <div class="inline-flex items-center gap-2 bg-indigo-500/10 border border-indigo-500/20 px-3 py-1 rounded-full mb-6">
                    <span class="w-1.5 h-1.5 bg-indigo-400 rounded-full animate-ping"></span>
                    <span class="text-[10px] font-black text-indigo-300 uppercase tracking-[0.2em]">Summit Uruguay Experience</span>
                </div>

                <h1 class="text-5xl md:text-7xl lg:text-8xl font-black tracking-tight mb-6 leading-none text-white">
                    <span class="block text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-yellow-400 pb-2">SALTA</span>
                    SIN LÍMITES
                </h1>
                
                <p class="text-lg md:text-2xl text-gray-300 mb-10 max-w-lg mx-auto md:mx-0 leading-relaxed font-medium">
                    El parque de trampolines más extremo de Uruguay. <span class="text-orange-400 font-bold">Pista Ninja</span>, <span class="text-purple-400 font-bold">Dodgeball</span> y mucho más.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                    <button @click="showBookingOption = true" class="bg-orange-500 text-white px-8 py-4 rounded-2xl font-black text-lg hover:bg-orange-600 transition shadow-lg shadow-orange-500/20 active:scale-95">
                        RESERVAR AHORA
                    </button>
                    <Link :href="route('activities')" class="bg-white/5 border border-white/10 text-white px-8 py-4 rounded-2xl font-bold text-lg hover:bg-white/10 transition inline-block text-center backdrop-blur-sm">
                        VER ATRACCIONES
                    </Link>
                </div>
            </div>
            
            <div class="order-1 md:order-2 flex justify-center md:justify-end relative">
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-indigo-500/20 rounded-full blur-[80px]"></div>
                
                <img src="/images/R.png" alt="Mascota Summit Canguro" class="w-3/4 md:w-full max-w-md lg:max-w-lg object-contain drop-shadow-2xl hover:scale-105 transition-transform duration-500 relative z-10" />
                
                <div class="absolute top-10 right-10 bg-gray-900/80 backdrop-blur-md text-white border border-white/10 font-black px-6 py-3 rounded-tr-3xl rounded-bl-3xl rounded-tl-xl shadow-lg transform rotate-6 hidden md:block z-20">
                    ¡HOLA AMIGOS! 👋
                </div>
            </div>

        </div>
    </div>
</header>

            <section class="py-32">
                <div class="max-w-7xl mx-auto px-6">
                    <div class="text-center mb-16">
                        <h2 class="text-3xl md:text-5xl font-black text-white uppercase tracking-tighter">EXPERIENCIA <span class="text-orange-500">SUMMIT</span></h2>
                    </div>
                    <div class="grid md:grid-cols-3 gap-8">
                        <div v-for="(feature, index) in mainFeatures" :key="index" 
                             class="bg-gray-800 p-10 rounded-3xl transition-all duration-300 hover:-translate-y-2 group text-center shadow-lg hover:shadow-xl border border-gray-700">
                            <div class="w-16 h-16 mx-auto bg-gray-900 rounded-2xl flex items-center justify-center mb-6 transition-colors duration-300"
                                 :class="`text-${feature.color}-400 group-hover:text-${feature.color}-300`">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                                    <path stroke-linecap="round" stroke-linejoin="round" :d="feature.icon" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-black text-white uppercase mb-3 tracking-wide">{{ feature.title }}</h3>
                            <p class="text-gray-400 text-sm leading-relaxed">{{ feature.desc }}</p>
                        </div>
                    </div>
                    <div class="mt-16 text-center">
                        <Link :href="route('activities')" class="inline-flex items-center gap-2 text-orange-500 font-bold hover:text-orange-400 transition pb-1 border-b-2 border-transparent hover:border-orange-500">
                            VER MÁS DETALLES
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                        </Link>
                    </div>
                </div>
            </section>

            <section class="py-24">
                <div class="max-w-7xl mx-auto px-6">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl md:text-6xl font-black text-white uppercase tracking-tighter mb-4">
                            ZONAS DE <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-500">JUEGO</span>
                        </h2>
                        <p class="text-gray-400 max-w-2xl mx-auto text-lg">
                            Diseñamos cada zona para desafiar tus límites. ¡Descubre tus favoritas!
                        </p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:h-[550px]">
                        <div class="md:col-span-2 relative rounded-[2.5rem] overflow-hidden cursor-pointer group h-80 md:h-full bg-gray-800 border border-gray-700">
                            <img src="/images/Web-BattleBeam.jpg" alt="Barra de Batalla" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 opacity-80 group-hover:opacity-100" />
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-transparent opacity-90"></div>
                            <div class="absolute top-6 left-6">
                                <span class="bg-red-600 text-white text-xs font-black px-4 py-1.5 rounded-full uppercase tracking-widest shadow-lg">El Favorito</span>
                            </div>
                            <div class="absolute bottom-0 left-0 p-8 md:p-12 w-full">
                                <h3 class="text-3xl md:text-5xl font-black text-white italic uppercase mb-2">Barra de Batalla</h3>
                                <p class="text-gray-200 text-sm md:text-lg max-w-md opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-4 group-hover:translate-y-0">
                                    Desafía a tus amigos a un duelo de equilibrio estilo gladiador.
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-col gap-6 h-full">
                            <div class="flex-1 relative rounded-[2.5rem] overflow-hidden cursor-pointer group min-h-[250px] bg-gray-800 border border-gray-700">
                                <img src="/images/Web-FoamPit.jpg" alt="Piscina de Cubos" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 opacity-80 group-hover:opacity-100" />
                                <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-transparent opacity-90"></div>
                                <div class="absolute bottom-0 left-0 p-6 w-full">
                                    <h3 class="text-xl font-black text-white uppercase mb-1">Piscina de Cubos</h3>
                                    <p class="text-orange-400 text-xs font-bold uppercase tracking-wider">Aterrizaje Suave</p>
                                </div>
                            </div>

                            <div class="flex-1 relative rounded-[2.5rem] overflow-hidden cursor-pointer group min-h-[250px] bg-gray-800 border border-gray-700">
                                <img src="/images/Uruguay-WallClimbing.jpg" alt="Pared de Escalar" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 opacity-80 group-hover:opacity-100" />
                                <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-transparent opacity-90"></div>
                                <div class="absolute bottom-0 left-0 p-6 w-full">
                                    <h3 class="text-xl font-black text-white uppercase mb-1">Pared de Escalar</h3>
                                    <p class="text-blue-400 text-xs font-bold uppercase tracking-wider">Llega a la Cima</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-12 text-center">
                        <Link :href="route('activities')" class="inline-flex items-center gap-2 text-white font-bold hover:text-orange-500 transition group">
                            EXPLORAR TODAS LAS ATRACCIONES <span class="group-hover:translate-x-1 transition-transform">→</span>
                        </Link>
                    </div>
                </div>
            </section>

            <section id="summit-cafe" class="py-16">
                 <div class="max-w-7xl mx-auto px-6">
                    <div class="bg-gray-800 rounded-[3rem] p-8 md:p-16 border border-orange-500/20 shadow-2xl relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-64 h-64 bg-orange-500/10 rounded-full blur-3xl -mr-16 -mt-16 pointer-events-none"></div>

                        <div class="grid md:grid-cols-2 gap-16 items-center relative z-10">
                            <div class="order-2 md:order-1">
                                <div class="inline-block mb-4">
                                    <span class="text-orange-500 font-bold uppercase tracking-widest text-sm border-b-2 border-orange-500 pb-1">Zona de Recarga</span>
                                </div>
                                <h2 class="text-4xl md:text-5xl font-black text-white mb-6 leading-tight tracking-tight">
                                    ELLOS SALTAN, <br>
                                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-amber-300">TÚ TE RELAJAS</span>.
                                </h2>
                                <p class="text-gray-300 text-lg mb-8 leading-relaxed">
                                    Sabemos que esperar puede ser agotador. Por eso creamos el <strong class="text-white">Summit Café</strong>. Un espacio cómodo con vista panorámica a las pistas.
                                </p>

                                <div class="grid grid-cols-3 gap-6 mb-10 pt-4">
                                    <div v-for="(feature, index) in cafeFeatures" :key="index" class="text-center group">
                                        <div class="w-12 h-12 mx-auto bg-gray-900 rounded-xl flex items-center justify-center text-orange-500 mb-3 group-hover:bg-orange-500 group-hover:text-white transition-all shadow-lg border border-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" :d="feature.icon" />
                                            </svg>
                                        </div>
                                        <h3 class="text-white font-bold text-sm uppercase">{{ feature.name }}</h3>
                                    </div>
                                </div>

                                <button class="bg-white text-gray-900 px-8 py-4 rounded-full font-black text-lg hover:bg-orange-500 hover:text-white transition-all shadow-xl flex items-center gap-3 group">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 group-hover:rotate-12 transition-transform">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
                                    </svg>
                                    VER MENÚ DIGITAL
                                </button>
                            </div>

                            <div class="order-1 md:order-2 relative">
                                <div class="rounded-[2.5rem] overflow-hidden shadow-2xl transform rotate-3 hover:rotate-0 transition-all duration-500 group/image bg-gray-900 border-4 border-gray-700">
                                    <img src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=800&auto=format&fit=crop" alt="Summit Café Ambiente" class="w-full h-[450px] object-cover filter grayscale-[30%] group-hover/image:grayscale-0 transition-all duration-500" />
                                    <div class="absolute bottom-0 left-0 w-full p-6 bg-gradient-to-t from-gray-900 via-gray-900/80 to-transparent">
                                        <p class="text-orange-400 font-bold text-sm uppercase mb-1 tracking-wider">Ubicación</p>
                                        <p class="text-white font-black text-2xl">Mezzanine Panorámico</p>
                                    </div>
                                </div>
                                <div class="absolute -bottom-8 -right-8 w-32 h-32 z-20 hidden md:block animate-bounce-slow">
                                     <div class="relative w-full h-full rounded-full border-4 border-gray-900 bg-orange-500 overflow-hidden shadow-lg transform -rotate-12 hover:rotate-0 transition">
                                        <img src="/images/R.png" alt="Canguro con hambre" class="w-full h-full object-cover object-top scale-125 translate-y-2">
                                    </div>
                                    <div class="absolute -top-6 -left-12 bg-white text-gray-900 text-xs font-black px-3 py-1.5 rounded-full shadow-md whitespace-nowrap">
                                        ¡Las donas son top! 🍩
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-16">
                <div class="max-w-7xl mx-auto px-6 relative">
                    <div class="bg-indigo-900 rounded-[3rem] p-8 md:p-16 border border-indigo-800 shadow-2xl relative overflow-hidden">
                        <div class="absolute bottom-0 left-0 w-64 h-64 bg-purple-500/10 rounded-full blur-3xl -ml-16 -mb-16 pointer-events-none"></div>

                        <div class="flex flex-col lg:flex-row items-center gap-16 relative z-10">
                            <div class="lg:w-1/2 text-center lg:text-left">
                                <div class="inline-block bg-white/10 text-white px-4 py-1 rounded-full font-bold text-sm mb-6 tracking-wide uppercase border border-white/20">¡Celebrá Saltando!</div>
                                <h2 class="text-4xl md:text-6xl font-black text-white leading-tight mb-6">EL MEJOR <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-yellow-500">CUMPLEAÑOS</span> <br>DE TU VIDA</h2>
                                <p class="text-indigo-200 text-lg mb-8 leading-relaxed">Olvídate del estrés. Nosotros nos encargamos de todo. <br><br><strong class="text-white">Incluye:</strong> Sala privada, anfitrión, calcetines y acceso al parque.</p>
                                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                                    <Link :href="route('contact')" class="bg-white text-indigo-900 px-8 py-4 rounded-full font-black text-lg hover:bg-gray-100 transition shadow-xl hover:shadow-white/20 hover:-translate-y-1">VER PAQUETES DE FIESTA</Link>
                                </div>
                            </div>
                            <div class="lg:w-1/2 relative">
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="space-y-4 mt-8">
                                        <div class="rounded-3xl overflow-hidden shadow-2xl h-64 w-full transform hover:scale-105 transition duration-500 bg-gray-900 border-2 border-indigo-900">
                                            <img src="/images/BANNER-GENTE-SUMMIT.jpg" alt="Niños felices" class="w-full h-full object-cover" />
                                        </div>
                                        <div class="bg-indigo-950 p-6 rounded-3xl shadow-xl text-center flex flex-col justify-center h-40 transform -rotate-2 hover:rotate-0 transition duration-300 border border-indigo-700">
                                            <span class="text-4xl font-black text-orange-500">100%</span>
                                            <span class="font-bold text-lg text-white">DIVERSIÓN</span>
                                        </div>
                                    </div>
                                    <div class="space-y-4">
                                        <div class="bg-orange-500 p-4 rounded-3xl shadow-lg text-white font-bold text-center uppercase tracking-widest text-sm transform rotate-3">¡Reserva Hoy!</div>
                                        <div class="rounded-3xl overflow-hidden shadow-2xl h-80 w-full transform hover:scale-105 transition duration-500 bg-gray-900 border-2 border-indigo-900">
                                            <img src="/images/BANNER-CELEBRA-CON-NOSOTROS-SUMMIT-779x1024.jpg" alt="Fiesta" class="w-full h-full object-cover" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-32">
                <div class="max-w-7xl mx-auto px-6">
                    <div class="text-center mb-16">
                        <div class="inline-flex items-center gap-2 bg-gray-800 px-4 py-1.5 rounded-full mb-6 border border-gray-700">
                            <span class="text-xs font-bold text-white uppercase tracking-wider">Rating 4.9/5.0</span>
                        </div>
                        <h2 class="text-3xl md:text-5xl font-black text-white uppercase tracking-tighter">LO QUE DICEN <span class="text-orange-500">NUESTROS SALTADORES</span></h2>
                    </div>
                    
                    <div class="grid md:grid-cols-3 gap-6">
                        <div v-for="(testimonial, index) in testimonials" :key="index" 
                             class="bg-gray-800 p-8 rounded-[2rem] transition duration-300 hover:bg-gray-750 relative group shadow-lg border border-gray-700"
                             :class="{ 'transform md:-translate-y-4 shadow-xl shadow-orange-500/5': testimonial.highlighted }">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-sm" :class="`bg-${testimonial.color}-500`">
                                    {{ testimonial.initial }}
                                </div>
                                <div>
                                    <h4 class="text-white font-bold text-sm">{{ testimonial.name }}</h4>
                                    <div class="flex text-orange-500 text-xs">★★★★★</div>
                                </div>
                            </div>
                            <p class="text-gray-400 text-sm leading-relaxed">"{{ testimonial.text }}"</p>
                        </div>
                    </div>
                    
                    <div class="text-center mt-12">
                        <a href="https://www.google.com/maps/place/Summit+Trampoline+Park+Uruguay" target="_blank" class="inline-flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-orange-500 transition-colors">Ver todas las reseñas en Google Maps <span>→</span></a>
                    </div>
                </div>
            </section>

            <section class="py-24">
                <div class="max-w-7xl mx-auto px-6">
                    <div class="grid lg:grid-cols-2 gap-16 items-start">
                        <div class="space-y-10">
                            <div>
                                <h2 class="text-4xl md:text-5xl font-black text-white uppercase tracking-tighter mb-2">VISÍTANOS</h2>
                                <div class="w-24 h-1.5 bg-orange-500 rounded-full"></div>
                            </div>
                            <div class="grid sm:grid-cols-2 gap-6">
                                <div class="bg-gray-800 p-6 rounded-2xl transition duration-300 hover:bg-gray-750 group border border-gray-700">
                                    <div class="w-10 h-10 bg-gray-900 rounded-full flex items-center justify-center text-orange-500 mb-4 group-hover:bg-orange-500 group-hover:text-white transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                        </svg>
                                    </div>
                                    <h4 class="text-white font-bold uppercase mb-2">Dirección</h4>
                                    <p class="text-gray-400 text-sm leading-relaxed">Dr. Martín Aguirre 4148<br> Esq. Habana (Funsa)<br> Villa Española, Montevideo</p>
                                </div>
                                <div class="bg-gray-800 p-6 rounded-2xl transition duration-300 hover:bg-gray-750 group border border-gray-700">
                                    <div class="w-10 h-10 bg-gray-900 rounded-full flex items-center justify-center text-blue-500 mb-4 group-hover:bg-blue-500 group-hover:text-white transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
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
                                    <a v-for="(social, index) in socialLinks" :key="index" 
                                    :href="social.url" 
                                    target="_blank" 
                                    class="w-full sm:w-auto flex items-center justify-center gap-2 px-6 py-3 rounded-full border border-gray-700 text-gray-400 font-bold transition-all duration-300 hover:text-white hover:border-gray-500 hover:bg-gray-800"
                                    :class="social.hoverClass">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" v-html="social.icon"></svg>
                                        {{ social.name }}
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
        </div>

        <div v-if="showBookingOption" class="fixed inset-0 z-[60] overflow-y-auto" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen px-4 text-center">
                <div class="fixed inset-0 bg-gray-900/95 backdrop-blur-md transition-opacity" @click="showBookingOption = false"></div>
                <div class="relative bg-gray-800 rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:max-w-md w-full p-8 border border-gray-700">
                    <button @click="showBookingOption = false" class="absolute top-4 right-4 text-gray-400 hover:text-white transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                    <div class="text-center mb-8">
                        <h3 class="text-2xl font-black text-white uppercase mb-2">¿Cómo deseas reservar?</h3>
                        <p class="text-gray-400 text-sm">Elige la opción que prefieras para coordinar tu salto.</p>
                    </div>
                    <div class="grid gap-4">
                        <component 
                            v-for="(option, index) in bookingOptions" 
                            :key="index"
                            :is="option.type === 'link' ? 'a' : 'button'"
                            :href="option.type === 'link' ? option.url : null"
                            :target="option.type === 'link' ? '_blank' : null"
                            @click="option.type === 'button' ? option.action() : null"
                            class="group flex items-center justify-between p-4 rounded-2xl transition-all duration-300 border border-gray-700 hover:border-gray-600 bg-gray-900/50 hover:bg-gray-700"
                        >
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full flex items-center justify-center transition-colors" 
                                     :class="`bg-${option.color} group-hover:bg-white text-white group-hover:text-${option.color}`">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" v-html="option.icon"></svg>
                                </div>
                                <div class="text-left">
                                    <span class="block text-white font-black uppercase text-lg group-hover:text-white">{{ option.title }}</span>
                                    <span class="block text-gray-400 text-xs group-hover:text-white/80">{{ option.desc }}</span>
                                </div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 group-hover:text-white text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                        </component>
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

<style>
/* Patrón de malla para toda la página */
.bg-summit-pattern {
    background-color: #111827;
    background-image: radial-gradient(rgba(255, 255, 255, 0.1) 1.5px, transparent 1.5px);
    background-size: 30px 30px;
}

@keyframes bounce-slow {
  0%, 100% { transform: translateY(0) rotate(-12deg); }
  50% { transform: translateY(-10px) rotate(-12deg); }
}
.animate-bounce-slow {
  animation: bounce-slow 3s infinite ease-in-out;
}
</style>