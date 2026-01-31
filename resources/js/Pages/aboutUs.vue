<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';

// Formulario simple para la sección de la mascota
const form = useForm({
    email: '',
});

const submit = () => {
    // Aquí iría la lógica de suscripción
    form.reset();
    alert('¡Gracias por unirte a la familia Summit!');
};
</script>

<template>
    <MainLayout>
        <Head title="Sobre Nosotros" />

        <div class="bg-gray-900 min-h-screen font-sans text-gray-100">
            
            <section class="relative pt-32 pb-24 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-b from-gray-800 to-gray-900 z-0"></div>
                <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[1000px] h-[600px] bg-orange-500/10 rounded-[100%] blur-[100px] pointer-events-none z-0 -translate-y-1/2 animate-pulse"></div>

                <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
                    <span class="inline-block py-1 px-3 rounded-full bg-orange-500/10 border border-orange-500/20 text-orange-400 text-xs font-black uppercase tracking-widest mb-4">
                        Nuestra Historia
                    </span>
                    <h1 class="text-5xl md:text-7xl font-black text-white uppercase tracking-tighter mb-6 drop-shadow-xl">
                        SOMOS <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-500">SUMMIT</span>
                    </h1>
                    <p class="text-gray-300 text-xl max-w-3xl mx-auto leading-relaxed">
                        Summit es una compañía de trampolines de rápido crecimiento enfocada en Latinoamérica. Con sede en EE.UU., somos las principales instalaciones de salto del mundo.
                    </p>
                </div>
            </section>

            <section class="pb-24 relative z-10">
                <div class="max-w-6xl mx-auto px-6">
                    
                    <div class="grid md:grid-cols-2 gap-16 items-center mb-32">
                        <div class="relative group">
                            <div class="absolute -inset-4 bg-gradient-to-r from-orange-500 to-red-600 rounded-[2.5rem] opacity-30 blur-lg group-hover:opacity-50 transition duration-700"></div>
                            <div class="relative h-[500px] rounded-[2rem] overflow-hidden shadow-2xl border border-gray-700">
                                <img src="/images/Web-Maincourt2.jpg" alt="Summit Park Team" class="absolute inset-0 w-full h-full object-cover grayscale group-hover:grayscale-0 transition duration-700 transform group-hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 to-transparent"></div>
                                <div class="absolute bottom-8 left-8">
                                    <p class="text-white font-black text-2xl uppercase">Diversión sin límites</p>
                                    <p class="text-orange-400 text-sm font-bold">Desde 2018 en Uruguay</p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-8">
                            <div>
                                <h2 class="text-3xl font-black text-white uppercase mb-4 flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                                    Nuestra Misión
                                </h2>
                                <p class="text-gray-400 leading-relaxed text-lg">
                                    Nuestro objetivo es proporcionar un ambiente seguro y emocionante donde personas de todas las edades puedan desafiar sus límites físicos. Les resultará difícil encontrar una experiencia en cualquier otro lugar como la que ofrece SUMMIT.
                                </p>
                            </div>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-4">
                                <div class="bg-gray-800 p-6 rounded-2xl border border-gray-700 hover:border-orange-500/50 transition">
                                    <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center mb-4 text-blue-400 text-2xl">🛡️</div>
                                    <h3 class="font-bold text-white uppercase mb-2">Seguridad</h3>
                                    <p class="text-sm text-gray-400">Protocolos estrictos y limpieza exhaustiva instruida por el Ministerio de Salud.</p>
                                </div>
                                <div class="bg-gray-800 p-6 rounded-2xl border border-gray-700 hover:border-orange-500/50 transition">
                                    <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center mb-4 text-green-400 text-2xl">😊</div>
                                    <h3 class="font-bold text-white uppercase mb-2">Comunidad</h3>
                                    <p class="text-sm text-gray-400">Un espacio inclusivo para familias, amigos y eventos corporativos.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-800 rounded-3xl p-12 border border-gray-700 shadow-2xl relative overflow-hidden">
                        <div class="absolute top-0 right-0 p-12 opacity-5 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-64 w-64 text-white" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" /></svg>
                        </div>
                        
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 relative z-10">
                            <div class="text-center group">
                                <p class="text-4xl md:text-6xl font-black text-transparent bg-clip-text bg-gradient-to-b from-orange-400 to-orange-600 mb-2 group-hover:scale-110 transition-transform">3000+</p>
                                <p class="text-gray-400 text-xs uppercase tracking-widest font-bold">Metros Cuadrados</p>
                            </div>
                            <div class="text-center group">
                                <p class="text-4xl md:text-6xl font-black text-white mb-2 group-hover:scale-110 transition-transform">50+</p>
                                <p class="text-gray-400 text-xs uppercase tracking-widest font-bold">Camas Elásticas</p>
                            </div>
                            <div class="text-center group">
                                <p class="text-4xl md:text-6xl font-black text-transparent bg-clip-text bg-gradient-to-b from-blue-400 to-blue-600 mb-2 group-hover:scale-110 transition-transform">100%</p>
                                <p class="text-gray-400 text-xs uppercase tracking-widest font-bold">Adrenalina</p>
                            </div>
                            <div class="text-center group">
                                <p class="text-4xl md:text-6xl font-black text-white mb-2 group-hover:scale-110 transition-transform">7</p>
                                <p class="text-gray-400 text-xs uppercase tracking-widest font-bold">Días a la Semana</p>
                            </div>
                        </div>
                    </div>

                </div>
            </section>

            <section class="py-24 relative overflow-hidden">
                <div class="max-w-5xl mx-auto px-6">
                    <div class="bg-gradient-to-r from-orange-600 to-red-600 rounded-[3rem] p-8 md:p-16 flex flex-col md:flex-row items-center justify-between shadow-[0_0_50px_rgba(234,88,12,0.3)] relative">
                        
                        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')]"></div>

                        <div class="md:w-1/2 relative z-10 text-center md:text-left mb-10 md:mb-0">
                            <h2 class="text-3xl md:text-4xl font-black text-white uppercase mb-4 leading-none">
                                ¿Listo para <br>Saltar?
                            </h2>
                            <p class="text-white/80 mb-8 font-medium">
                                Déjanos tu correo y recibe descuentos exclusivos de nuestra mascota. ¡No te pierdas ninguna novedad!
                            </p>
                            
                            <form @submit.prevent="submit" class="flex flex-col gap-3">
                                <input 
                                    v-model="form.email"
                                    type="email" 
                                    placeholder="tu@email.com" 
                                    class="w-full px-6 py-4 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/60 focus:outline-none focus:bg-white/20 focus:border-white transition backdrop-blur-sm"
                                    required
                                >
                                <button type="submit" class="px-8 py-4 bg-white text-orange-600 font-black uppercase rounded-xl hover:bg-gray-100 hover:scale-[1.02] transition-all shadow-xl">
                                    Suscribirme
                                </button>
                            </form>
                        </div>

                        <div class="md:w-5/12 relative z-10 flex justify-center">
                            <img 
                                src="/images/kangaroo-poses-complete_AI-diving.png" 
                                alt="Mascota Summit" 
                                class="w-64 md:w-80 drop-shadow-2xl transform rotate-3 hover:rotate-6 transition duration-500 hover:scale-110"
                            >
                        </div>

                    </div>
                </div>
            </section>

        </div>
    </MainLayout>
</template>