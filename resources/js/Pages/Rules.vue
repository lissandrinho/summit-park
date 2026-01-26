<script setup>
import { Head, Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';
</script>

<template>
    <MainLayout>
        <Head title="Reglas del Parque" />

        <div class="bg-gray-900 min-h-screen relative overflow-hidden pb-20">
            
            <div class="absolute top-0 left-0 w-full h-[500px] bg-gradient-to-b from-gray-800 to-gray-900 z-0"></div>
            <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-orange-500/10 rounded-full blur-[120px] pointer-events-none z-0 translate-x-1/3 -translate-y-1/4"></div>
            <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-blue-600/10 rounded-full blur-[100px] pointer-events-none z-0 -translate-x-1/4 translate-y-1/4"></div>

            <div class="max-w-7xl mx-auto px-6 relative z-10 pt-24">
                
                <div class="text-center mb-20">
                    <div class="inline-block bg-orange-500/10 border border-orange-500/20 rounded-full px-4 py-1.5 mb-6 backdrop-blur-sm">
                        <span class="text-orange-500 font-bold text-xs uppercase tracking-widest">Seguridad Primero</span>
                    </div>
                    <h1 class="text-5xl md:text-7xl font-black text-white uppercase tracking-tighter mb-6 drop-shadow-2xl">
                        Reglas del <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-red-500">Parque</span>
                    </h1>
                    <p class="text-gray-400 text-lg md:text-xl max-w-2xl mx-auto leading-relaxed">
                        Para garantizar una experiencia segura y divertida para todos, es obligatorio cumplir con las siguientes normas.
                    </p>
                </div>

                <div class="grid lg:grid-cols-2 gap-10 mb-20">

                    <div class="bg-gray-800/50 backdrop-blur-md rounded-[2.5rem] border border-gray-700/50 overflow-hidden shadow-2xl hover:shadow-orange-500/10 transition duration-500 group">
                        <div class="bg-gray-800/80 p-8 border-b border-gray-700 flex items-center gap-5">
                            <div class="w-16 h-16 rounded-2xl bg-orange-500 text-white flex items-center justify-center shadow-lg shadow-orange-500/30 group-hover:scale-110 transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" /></svg>
                            </div>
                            <div>
                                <h2 class="text-2xl font-black text-white uppercase italic">Para Entrar</h2>
                                <p class="text-orange-400 text-xs font-bold uppercase tracking-wider">Requisitos de Ingreso</p>
                            </div>
                        </div>

                        <div class="p-8 md:p-10 space-y-6">
                            <ul class="space-y-4">
                                <li class="flex items-start gap-4 text-gray-300">
                                    <span class="shrink-0 w-6 h-6 rounded-full bg-green-500/20 text-green-500 flex items-center justify-center mt-0.5">✓</span>
                                    <span><strong>Waiver Obligatorio:</strong> Exención de responsabilidad llena en su totalidad y registrada en el sistema.</span>
                                </li>
                                <li class="flex items-start gap-4 text-gray-300">
                                    <span class="shrink-0 w-6 h-6 rounded-full bg-green-500/20 text-green-500 flex items-center justify-center mt-0.5">✓</span>
                                    <span>Uso obligatorio del <strong>brazalete de color</strong> provisto por SUMMIT.</span>
                                </li>
                                <li class="flex items-start gap-4 text-gray-300">
                                    <span class="shrink-0 w-6 h-6 rounded-full bg-orange-500/20 text-orange-500 flex items-center justify-center mt-0.5">!</span>
                                    <span><strong>Medias:</strong> No se permite entrar con zapatos o descalzo. Uso obligatorio de medias (preferiblemente antideslizantes).</span>
                                </li>
                                <li class="flex items-start gap-4 text-gray-300">
                                    <span class="shrink-0 w-6 h-6 rounded-full bg-red-500/20 text-red-500 flex items-center justify-center mt-0.5">✕</span>
                                    <span><strong>Prohibido ingresar:</strong> Comidas, bebidas, chicles, correas, llaveros, teléfonos, cámaras y objetos punzantes.</span>
                                </li>
                                <li class="flex items-start gap-4 text-gray-300">
                                    <span class="shrink-0 w-6 h-6 rounded-full bg-red-500/20 text-red-500 flex items-center justify-center mt-0.5">✕</span>
                                    <span>No se permiten botellas con líquidos (Solo se permite el mate en áreas designadas).</span>
                                </li>
                                <li class="flex items-start gap-4 text-gray-300">
                                    <span class="shrink-0 w-6 h-6 rounded-full bg-blue-500/20 text-blue-500 flex items-center justify-center mt-0.5">i</span>
                                    <span class="text-sm text-gray-400">Nos reservamos el derecho de admisión. Prohibido faltar el respeto al Staff. Bolsos sujetos a registro.</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="bg-gray-800/50 backdrop-blur-md rounded-[2.5rem] border border-gray-700/50 overflow-hidden shadow-2xl hover:shadow-blue-500/10 transition duration-500 group">
                        <div class="bg-gray-800/80 p-8 border-b border-gray-700 flex items-center gap-5">
                            <div class="w-16 h-16 rounded-2xl bg-blue-600 text-white flex items-center justify-center shadow-lg shadow-blue-600/30 group-hover:scale-110 transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                            </div>
                            <div>
                                <h2 class="text-2xl font-black text-white uppercase italic">Antes de Saltar</h2>
                                <p class="text-blue-400 text-xs font-bold uppercase tracking-wider">Seguridad en Pista</p>
                            </div>
                        </div>

                        <div class="p-8 md:p-10 space-y-6">
                            <ul class="space-y-4">
                                <li class="flex items-start gap-4 text-gray-300">
                                    <span class="shrink-0 w-6 h-6 rounded-full bg-blue-500/20 text-blue-500 flex items-center justify-center mt-0.5">1</span>
                                    <span><strong>Bolsillos Vacíos:</strong> Quitarse zapatos y vaciar bolsillos completamente.</span>
                                </li>
                                <li class="flex items-start gap-4 text-gray-300">
                                    <span class="shrink-0 w-6 h-6 rounded-full bg-blue-500/20 text-blue-500 flex items-center justify-center mt-0.5">2</span>
                                    <span><strong>Solo trucos sencillos:</strong> No se recomiendan volteretas dobles o arriesgadas. Salta según tu habilidad.</span>
                                </li>
                                <li class="flex items-start gap-4 text-gray-300">
                                    <span class="shrink-0 w-6 h-6 rounded-full bg-red-500/20 text-red-500 flex items-center justify-center mt-0.5">✕</span>
                                    <span><strong>Prohibido:</strong> Juegos de lucha, empujar, correr, escalar mallas o tocar los colchones de seguridad.</span>
                                </li>
                                <li class="flex items-start gap-4 text-gray-300">
                                    <span class="shrink-0 w-6 h-6 rounded-full bg-red-500/20 text-red-500 flex items-center justify-center mt-0.5">✕</span>
                                    <span><strong>No sentarse</strong> ni acostarse en los trampolines. Si estás cansado, sal de la pista.</span>
                                </li>
                                <li class="flex items-start gap-4 text-gray-300">
                                    <span class="shrink-0 w-6 h-6 rounded-full bg-orange-500/20 text-orange-500 flex items-center justify-center mt-0.5">!</span>
                                    <span><strong>Restricciones Médicas:</strong> No recomendado para embarazadas o personas con problemas de columna/salud.</span>
                                </li>
                                <li class="flex items-start gap-4 text-gray-300">
                                    <span class="shrink-0 w-6 h-6 rounded-full bg-green-500/20 text-green-500 flex items-center justify-center mt-0.5">✓</span>
                                    <span>Seguir instrucciones del personal en todo momento. Diviértete y salta con seguridad.</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>

                <div class="text-center">
                    <p class="text-gray-400 mb-6 uppercase tracking-wide text-sm font-bold">¿Listo para la acción?</p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <Link :href="route('home')" class="px-8 py-4 rounded-full border border-gray-600 text-white font-bold hover:bg-gray-800 transition">
                            Volver al Inicio
                        </Link>
                        <Link :href="route('waiver.create')" class="px-10 py-4 rounded-full bg-gradient-to-r from-orange-500 to-red-600 text-white font-black uppercase tracking-widest hover:scale-105 hover:shadow-lg hover:shadow-orange-500/30 transition duration-300">
                            Firmar Waiver
                        </Link>
                    </div>
                </div>

            </div>
        </div>
    </MainLayout>
</template>