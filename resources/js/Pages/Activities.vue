<script setup>
import { Head, Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';

// Tus datos originales mantenidos intactos
const activities = [
    {
        title: 'Cancha Principal',
        description: 'Rompé las leyes de la física y desafiá la gravedad en nuestra enorme cancha de trampolines interconectados.',
        image: '/images/Web-Maincourt2.jpg',
    },
    {
        title: 'Barra de Batallas',
        description: '¡Poné a prueba tu equilibrio y luchá estilo gladiador! El ganador es el último en caer a la piscina de espuma.',
        image: '/images/Web-BattleBeam.jpg',
    },
    {
        title: 'Baloncesto',
        description: '¿Soñaste con hacer una clavada tipo NBA? Con nuestros trampolines ahora podés saltar y anotar sin límites.',
        image: '/images/Web-Basketball-1.jpg',
    },
    {
        title: 'Piscina de Cubos',
        description: 'Practica tus acrobacias más locas y aterriza suavemente en nuestra gigantesca piscina de cubos de espuma.',
        image: '/images/Web-FoamPit.jpg',
    },
    {
        title: 'Trampolín Olímpico',
        description: 'Para expertos. Alcanzá el cielo y volá más alto que nunca. (Exclusivo mayores de 18 o gimnastas).',
        image: '/images/Web-Performance.jpg',
    },
    {
        title: 'Pared de Escalar',
        description: 'Sube hasta la cima usando tu fuerza y destreza, y si caes, la espuma te atrapará.',
        image: '/images/Uruguay-WallClimbing.jpg',
    },
    {
        title: 'Bumper Balls',
        description: 'Métete en una burbuja gigante y choca con tus amigos sin parar de reír. ¡Fútbol extremo!',
        image: '/images/Uruguay-BubbleWrap.jpg',
    },
    {
        title: 'Tobogán Gigante',
        description: 'La bajada más rápida y divertida del parque. ¡Siente la velocidad en nuestro Tube Slide!',
        image: '/images/Uruguay-Slide2.jpg',
    },
];
</script>

<template>
    <MainLayout>
        <Head title="Actividades" />

        <div class="bg-gray-900 min-h-screen">
            
            <section class="relative pt-24 pb-48 overflow-visible">
                <div class="absolute inset-0 bg-gradient-to-b from-gray-800 to-gray-900 z-0"></div>
                
                <div class="absolute top-[-50%] left-1/2 -translate-x-1/2 w-[800px] h-[800px] bg-orange-500/15 rounded-full blur-[120px] pointer-events-none z-0"></div>

                <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
                    
                    <h1 class="text-5xl md:text-8xl font-black text-white uppercase tracking-tighter mb-6 drop-shadow-xl relative z-20 italic">
                        UN PASE.<br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-500">ACCESO TOTAL</span>
                    </h1>
                    
                    <p class="text-gray-300 text-xl max-w-2xl mx-auto leading-relaxed relative z-20 mb-10">
                        No elijas solo una. Con tu reserva por tiempo tienes <strong>acceso liberado</strong> a todas estas atracciones.
                    </p>

                    <Link :href="route('rules')" 
                        class="relative z-20 inline-flex items-center px-10 py-5 bg-white text-gray-900 text-xl font-black uppercase tracking-widest rounded-full hover:bg-orange-500 hover:text-white hover:scale-105 transition-all duration-300 shadow-[0_0_20px_rgba(255,255,255,0.2)] hover:shadow-[0_0_40px_rgba(249,115,22,0.6)]">
                        <span>Reservar Mi Turno</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </Link>
                </div>

                <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 translate-y-1/4 z-30 pointer-events-none hidden md:block">
                    <img 
                        src="/images/kangaroo-poses-complete_AI-diving.png" 
                        alt="Mascota Summit Cayendo" 
                        class="w-64 lg:w-80 drop-shadow-2xl animate-in slide-in-from-top-32 fade-in duration-1000"
                    />
                </div>
            </section>

            <section class="pb-24 relative z-20">
                <div class="max-w-7xl mx-auto px-6">

                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                        
                        <div v-for="(activity, index) in activities" :key="index" class="group relative rounded-[2rem] overflow-hidden shadow-2xl transition-all duration-300 hover:-translate-y-2 h-[500px] border border-gray-800 hover:border-orange-500/30">
                            
                            <div class="absolute inset-0">
                                <img 
                                    :src="activity.image" 
                                    :alt="activity.title" 
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 grayscale group-hover:grayscale-0" 
                                />
                                <div class="absolute inset-0 bg-black/50 group-hover:bg-black/30 transition-colors duration-300"></div>
                            </div>

                            <div class="absolute inset-0 flex flex-col justify-end p-8">
                                <div class="bg-gray-900/90 backdrop-blur-md p-6 rounded-3xl shadow-lg border border-gray-700 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                    <h3 class="text-2xl font-black text-white uppercase mb-2 leading-none">
                                        {{ activity.title }}
                                    </h3>
                                    <div class="w-12 h-1 bg-orange-500 rounded-full mb-3"></div>
                                    
                                    <p class="text-gray-300 text-sm leading-relaxed opacity-0 group-hover:opacity-100 h-0 group-hover:h-auto transition-all duration-300 overflow-hidden">
                                        {{ activity.description }}
                                    </p>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </section>

        </div>
    </MainLayout>
</template>