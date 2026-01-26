<script setup>
import { Head, Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';
</script>

<template>
    <MainLayout>
        <Head title="Sobre Nosotros" />

        <div class="bg-gray-900 min-h-screen">
            
            <section class="relative pt-24 pb-16 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-b from-gray-800 to-gray-900 z-0"></div>
                <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[1000px] h-[600px] bg-orange-500/10 rounded-[100%] blur-[100px] pointer-events-none z-0 -translate-y-1/2"></div>

                <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
                    <h1 class="text-5xl md:text-7xl font-black text-white uppercase tracking-tighter mb-4 drop-shadow-xl">
                        SOMOS <span class="text-orange-500">SUMMIT</span>
                    </h1>
                    <p class="text-gray-400 text-xl max-w-2xl mx-auto">
                        Más que un parque de trampolines, somos el lugar donde la gravedad se toma un descanso.
                    </p>
                </div>
            </section>

            <section class="pb-24 relative z-10">
                <div class="max-w-5xl mx-auto px-6">
                    
                    <div class="grid md:grid-cols-2 gap-12 items-center mb-24">
                        <div class="space-y-6">
                            <h2 class="text-3xl font-black text-white uppercase">Nuestra Misión</h2>
                            <p class="text-gray-400 leading-relaxed">
                                En Summit Park Uruguay, nuestro objetivo es proporcionar un ambiente seguro y emocionante donde personas de todas las edades puedan desafiar sus límites físicos y divertirse al máximo. 
                            </p>
                            <p class="text-gray-400 leading-relaxed">
                                Desde nuestras canchas de Dodgeball hasta la piscina de espuma, cada rincón está diseñado para la adrenalina.
                            </p>
                        </div>
                        <div class="relative h-[400px] rounded-[2.5rem] overflow-hidden shadow-2xl">
                            <img src="/images/Web-Maincourt2.jpg" alt="Summit Park Team" class="absolute inset-0 w-full h-full object-cover grayscale hover:grayscale-0 transition duration-700">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                        <div class="text-center">
                            <p class="text-4xl md:text-5xl font-black text-orange-500 mb-2">3000+</p>
                            <p class="text-gray-400 text-xs uppercase tracking-widest font-bold">Metros Cuadrados</p>
                        </div>
                        <div class="text-center">
                            <p class="text-4xl md:text-5xl font-black text-white mb-2">50+</p>
                            <p class="text-gray-400 text-xs uppercase tracking-widest font-bold">Camas Elásticas</p>
                        </div>
                        <div class="text-center">
                            <p class="text-4xl md:text-5xl font-black text-orange-500 mb-2">100%</p>
                            <p class="text-gray-400 text-xs uppercase tracking-widest font-bold">Diversión</p>
                        </div>
                        <div class="text-center">
                            <p class="text-4xl md:text-5xl font-black text-white mb-2">7</p>
                            <p class="text-gray-400 text-xs uppercase tracking-widest font-bold">Días a la Semana</p>
                        </div>
                    </div>

                </div>
            </section>

        </div>
    </MainLayout>
</template>