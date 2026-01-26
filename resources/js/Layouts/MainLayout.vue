<script setup>
import { ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
const showReservationModal = ref(false);
const page = usePage();

const navLinks = [
    { name: 'Inicio', route: 'home' },
    { name: 'Nosotros', route: 'about' },
    { name: 'Actividades', route: 'activities' },
    { name: 'Precios', route: 'prices' },
];
</script>

<template>
    <div class="min-h-screen bg-gray-900 text-white font-sans selection:bg-orange-500 selection:text-white relative">
        
        <nav class="fixed w-full z-40 transition-all duration-300 bg-gray-900/90 backdrop-blur-md border-b border-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-24 items-center">
                    
                    <div class="flex-shrink-0 flex items-center">
                        <Link :href="route('home')" class="group">
                            <img src="/images/Summit-Logo-full-white.png" alt="Summit Trampoline Park" class="h-12 md:h-16 w-auto hover:scale-105 transition-transform duration-300" />
                        </Link>
                    </div>

                    <div class="hidden lg:flex space-x-6 xl:space-x-8">
                        <Link 
                            v-for="link in navLinks" 
                            :key="link.name" 
                            :href="route(link.route)"
                            :class="[
                                'text-sm font-bold uppercase tracking-widest hover:text-orange-500 transition-colors duration-300 relative py-2',
                                route().current(link.route) ? 'text-orange-500' : 'text-gray-300'
                            ]"
                        >
                            {{ link.name }}
                            <span v-if="route().current(link.route)" class="absolute bottom-0 left-0 w-full h-0.5 bg-orange-500 shadow-[0_0_10px_rgba(249,115,22,0.8)]"></span>
                        </Link>
                    </div>

                    <div class="hidden lg:flex items-center gap-6">
                        <div v-if="page.props.auth.user" class="flex items-center gap-4">
                            <Link :href="route('dashboard')" class="text-gray-300 hover:text-white font-bold text-sm uppercase tracking-wider transition flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                Mi Cuenta
                            </Link>
                        </div>
                        <div v-else class="flex items-center gap-4 border-r border-gray-700 pr-6">
                            <Link :href="route('login')" class="text-gray-300 hover:text-white font-bold text-xs uppercase tracking-wider transition">Ingresar</Link>
                            <Link :href="route('register')" class="text-gray-300 hover:text-white font-bold text-xs uppercase tracking-wider transition">Registrarse</Link>
                        </div>

                        <Link :href="route('waiver')" class="bg-white text-gray-900 px-4 py-2.5 rounded-full text-xs font-black uppercase tracking-widest hover:bg-gray-200 transition shadow-[0_0_15px_rgba(255,255,255,0.3)] flex items-center gap-2 transform hover:-translate-y-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                            <span class="hidden xl:inline">Firmar</span> Waiver
                        </Link>
                    </div>

                    <div class="-mr-2 flex items-center lg:hidden">
                        <button @click="showingNavigationDropdown = !showingNavigationDropdown" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-800 focus:outline-none transition">
                            <svg class="h-8 w-8" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': !showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': !showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div :class="{'block': showingNavigationDropdown, 'hidden': !showingNavigationDropdown}" class="lg:hidden bg-gray-900 border-b border-gray-800 max-h-screen overflow-y-auto">
                <div class="pt-2 pb-3 space-y-1 px-4">
                    <Link v-for="link in navLinks" :key="link.name" :href="route(link.route)" class="block px-3 py-4 rounded-xl text-base font-bold uppercase tracking-wider text-gray-300 hover:text-white hover:bg-gray-800 transition" :class="{ 'text-orange-500 bg-gray-800': route().current(link.route) }">
                        {{ link.name }}
                    </Link>
                    <div class="border-t border-gray-800 my-2 pt-2">
                        <template v-if="page.props.auth.user">
                            <Link :href="route('dashboard')" class="block px-3 py-4 text-base font-bold uppercase tracking-wider text-orange-400 hover:text-white">Mi Cuenta</Link>
                        </template>
                        <template v-else>
                            <Link :href="route('login')" class="block px-3 py-3 text-sm font-bold uppercase tracking-wider text-gray-400 hover:text-white">Ingresar</Link>
                            <Link :href="route('register')" class="block px-3 py-3 text-sm font-bold uppercase tracking-wider text-gray-400 hover:text-white">Registrarse</Link>
                        </template>
                    </div>
                    <div class="mt-4 pt-4 pb-6 border-t border-gray-800">
                        <Link :href="route('waiver')" class="flex justify-center items-center gap-2 bg-white text-gray-900 py-3 rounded-lg font-black uppercase text-xs tracking-widest">Waiver</Link>
                    </div>
                </div>
            </div>
        </nav>

        <main class="pt-24">
            <slot />
        </main>

        <button 
            @click="showReservationModal = true"
            class="fixed bottom-8 right-8 md:bottom-14 md:right-14 z-[90] group shadow-[0_0_25px_rgba(249,115,22,0.4)] rounded-full transition-all duration-300 hover:scale-110 active:scale-95"
        >
            <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-orange-600 rounded-full flex items-center justify-center text-white border-2 border-white/20">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="group-hover:rotate-12 transition-transform duration-300">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
            </div>
            
            <span class="absolute right-full mr-4 top-1/2 -translate-y-1/2 bg-white text-gray-900 text-xs font-bold uppercase px-3 py-1.5 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap shadow-lg">
                Reservar Ahora
            </span>
        </button>

        <div v-if="showReservationModal" class="fixed inset-0 z-[100] flex items-center justify-center px-4">
            <div class="absolute inset-0 bg-black/80 backdrop-blur-sm" @click="showReservationModal = false"></div>
            
            <div class="relative bg-gray-800 border border-gray-700 rounded-3xl p-8 max-w-md w-full shadow-2xl transform transition-all animate-in fade-in zoom-in duration-300">
                
                <button @click="showReservationModal = false" class="absolute top-4 right-4 text-gray-400 hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>

                <div class="text-center mb-8">
                    <h3 class="text-2xl font-black text-white uppercase tracking-tighter mb-2">Reserva tu Salto</h3>
                    <p class="text-gray-400 text-sm">Elige la opción que prefieras para coordinar tu visita.</p>
                </div>

                <div class="space-y-4">
                    <a href="https://wa.me/59897104037?text=Hola%20Summit!%20Quisiera%20reservar%20turnos%20para%20saltar%20%F0%9F%A6%98" target="_blank" class="flex items-center gap-4 bg-[#25D366] hover:bg-[#20bd5a] text-white p-4 rounded-2xl transition-all duration-300 group shadow-lg">
                        <div class="bg-white/20 p-2 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                        </div>
                        <div class="text-left">
                            <p class="font-black uppercase text-sm">Reserva Rápida</p>
                            <p class="text-xs text-white/90">Vía WhatsApp (Respuesta inmediata)</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-auto w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                    </a>

                    <Link :href="route('contact')" @click="showReservationModal = false" class="flex items-center gap-4 bg-gray-700 hover:bg-gray-600 border border-gray-600 hover:border-gray-500 text-white p-4 rounded-2xl transition-all duration-300 group">
                        <div class="bg-white/10 p-2 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        </div>
                        <div class="text-left">
                            <p class="font-black uppercase text-sm">Cumpleaños y Eventos</p>
                            <p class="text-xs text-gray-400">Solicitar presupuesto detallado</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-auto w-5 h-5 text-gray-400 group-hover:text-white group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                    </Link>
                </div>
                
                <div class="mt-6 text-center">
                    <p class="text-xs text-gray-500">O visita nuestra sección de <Link :href="route('prices')" class="text-orange-500 hover:underline">Precios</Link> para más info.</p>
                </div>
            </div>
        </div>

        <footer class="bg-gray-950 border-t border-gray-800 pt-20 pb-8 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-orange-500 via-purple-500 to-blue-500"></div>
            <div class="max-w-7xl mx-auto px-6 relative z-10">
                <div class="flex justify-center mb-16">
                    <Link :href="route('home')" class="hover:scale-105 transition-transform duration-500">
                        <img src="/images/Summit-Logo-full-white.png" alt="Summit Park Footer Logo" class="h-32 md:h-40 w-auto opacity-80 hover:opacity-100 transition-opacity" />
                    </Link>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16 text-center md:text-left">
                    <div class="space-y-6">
                        <h3 class="text-white font-black uppercase tracking-widest mb-4 text-sm">Sobre Summit</h3>
                        <p class="text-gray-400 text-sm leading-relaxed">El parque de trampolines más extremo de Uruguay. Desafía la gravedad, supera tus límites y diviértete como nunca.</p>
                        <div class="flex justify-center md:justify-start gap-3">
                            <a href="https://instagram.com/summituruguay" target="_blank" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-gradient-to-tr hover:from-purple-500 hover:to-orange-500 hover:text-white transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                            </a>
                            <a href="https://facebook.com/summituruguay" target="_blank" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-blue-600 hover:text-white transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                            </a>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-white font-black uppercase tracking-widest mb-6 text-sm">El Parque</h3>
                        <ul class="space-y-4 text-sm text-gray-400">
                            <li><Link :href="route('home')" class="hover:text-orange-500 transition">Inicio</Link></li>
                            <li><Link :href="route('about')" class="hover:text-orange-500 transition">Nosotros</Link></li>
                            <li><Link :href="route('activities')" class="hover:text-orange-500 transition">Actividades</Link></li>
                            <li><Link :href="route('prices')" class="hover:text-orange-500 transition">Precios y Membresías</Link></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-white font-black uppercase tracking-widest mb-6 text-sm">Seguridad</h3>
                        <ul class="space-y-4 text-sm text-gray-400">
                            <li><Link :href="route('waiver')" class="hover:text-orange-500 transition">Firmar Waiver</Link></li>
                            <li><Link :href="route('rules')" class="hover:text-orange-500 transition">Reglas del Parque</Link></li>
                            <li><Link :href="route('faqs')" class="hover:text-orange-500 transition">Preguntas Frecuentes</Link></li>
                            <li><Link :href="route('contact')" class="hover:text-orange-500 transition">Contacto</Link></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-white font-black uppercase tracking-widest mb-6 text-sm">Encuéntranos</h3>
                        <ul class="space-y-4 text-sm text-gray-400 flex flex-col items-center md:items-start">
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-orange-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span>Dr. Martín Aguirre 4148<br>Villa Española, Montevideo</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                <span>+598 9710 4037</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-gray-800 pt-8 text-center">
                    <p class="text-gray-600 text-xs uppercase tracking-widest">&copy; {{ new Date().getFullYear() }} Summit Trampoline Park Uruguay. Todos los derechos reservados.</p>
                </div>
            </div>
        </footer>
    </div>
</template>