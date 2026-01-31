<script setup>
import { Head, Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';

const props = defineProps({
    attractions: {
        type: Array,
        default: () => []
    }
});

// --- DATOS DE ACTIVIDADES (FALLBACK) ---
const fallbackActivities = [
    { title: 'Cancha Principal', description: 'Rompé las leyes de la física y desafiá la gravedad en nuestra enorme cancha de trampolines interconectados.', image: '/images/Web-Maincourt2.jpg' },
    { title: 'Barra de Batallas', description: '¡Poné a prueba tu equilibrio y luchá estilo gladiador! El ganador es el último en caer a la piscina de espuma.', image: '/images/Web-BattleBeam.jpg' },
    { title: 'Baloncesto', description: '¿Soñaste con hacer una clavada tipo NBA? Con nuestros trampolines ahora podés saltar y anotar sin límites.', image: '/images/Web-Basketball-1.jpg' },
    { title: 'Piscina de Cubos', description: 'Practica tus acrobacias más locas y aterriza suavemente en nuestra gigantesca piscina de cubos de espuma.', image: '/images/Web-FoamPit.jpg' },
    { title: 'Trampolín Olímpico', description: 'Para expertos. Alcanzá el cielo y volá más alto que nunca. (Exclusivo mayores de 18 o gimnastas).', image: '/images/Web-Performance.jpg' },
    { title: 'Pared de Escalar', description: 'Sube hasta la cima usando tu fuerza y destreza, y si caes, la espuma te atrapará.', image: '/images/Uruguay-WallClimbing.jpg' },
    { title: 'Bumper Balls', description: 'Métete en una burbuja gigante y choca con tus amigos sin parar de reír. ¡Fútbol extremo!', image: '/images/Uruguay-BubbleWrap.jpg' },
    { title: 'Tobogán Gigante', description: 'La bajada más rápida y divertida del parque. ¡Siente la velocidad en nuestro Tube Slide!', image: '/images/Uruguay-Slide2.jpg' },
];

const displayActivities = props.attractions.length > 0 ? props.attractions : fallbackActivities;

const getImageUrl = (activity) => {
    return activity.image_path ? `/storage/${activity.image_path}` : activity.image;
};

// --- DATOS DE CUMPLEAÑOS ---
const birthdayPackages = [
    {
        pax: '10',
        price: '$16.570',
        details: [
            '10 niños + 1 cumpleañero',
            '2 horas de salto',
            '30 min servicio (comer-cantar)',
            '1 botella agua (625ml) p/p',
            '5 cajas de pizzas (8 porciones c/u)',
            '1 torta de 1½ kilos + vela',
            '1 mesa reservada + globos',
            'Descartables incluidos',
            'Entradas 2×1 (validez 3 meses)',
            'Invitación Digital'
        ]
    },
    {
        pax: '20',
        price: '$25.353',
        details: [
            '20 niños + 1 cumpleañero',
            '2 horas de salto',
            '30 min servicio (comer-cantar)',
            '1 botella agua (625ml) p/p',
            '7 cajas de pizzas (8 porciones c/u)',
            '1 torta de 2 kilos + vela',
            '2 mesas reservadas + globos',
            'Descartables incluidos',
            'Entradas 2×1 (validez 3 meses)',
            'Invitación Digital'
        ]
    },
    {
        pax: '30',
        price: '$36.721',
        details: [
            '30 niños + 1 cumpleañero',
            '2 horas de salto',
            '30 min servicio (comer-cantar)',
            '1 botella agua (625ml) p/p',
            '9 cajas de pizzas (8 porciones c/u)',
            '1 torta de 3 kilos + vela',
            '3 mesas reservadas + globos',
            'Descartables incluidos',
            'Entradas 2×1 (validez 3 meses)',
            'Invitación Digital'
        ]
    },
    {
        pax: '40',
        price: '$43.945',
        details: [
            '40 niños + 1 cumpleañero',
            '2 horas de salto',
            '30 min servicio (comer-cantar)',
            '1 botella agua (625ml) p/p',
            '12 cajas de pizzas (8 porciones c/u)',
            '1 torta de 3½ kilos + vela',
            '4 mesas reservadas + globos',
            'Descartables incluidos',
            'Entradas 2×1 (validez 3 meses)',
            'Invitación Digital'
        ]
    }
];

const perks = [
    '1 entrada de 2 horas para próxima visita',
    'Calcetines Summit de regalo',
    'Obsequio Summit',
    '10% descuento próxima celebración'
];

const addons = [
    'Caja de Pizza', 'Bandeja 50 Saladitos', 'Saladitos Vegetarianos', 
    'Hamburguesa + Fritas', 'Pancho + Fritas', 'Bandeja 11 Donas', 
    'Bandeja 25 Dulces', 'Bebidas 1.5L', 'Decoración', 'Transporte', 
    'Anfitrión Exclusivo', 'Pinta Caritas', 'Mesa Extra', 'Torta Celíaca', 
    'Torta Personalizada', 'Lámina Comestible'
];
</script>

<template>
    <MainLayout>
        <Head title="Actividades y Cumpleaños" />

        <div class="bg-gray-900 min-h-screen font-sans text-gray-100 selection:bg-orange-500 selection:text-white overflow-x-hidden">
            
            <section class="relative pt-24 pb-20 md:pt-32 md:pb-32 overflow-visible">
                <div class="absolute inset-0 bg-gradient-to-b from-gray-800 to-gray-900 z-0"></div>
                <div class="absolute top-[-20%] left-1/2 -translate-x-1/2 w-[300px] h-[300px] md:w-[800px] md:h-[800px] bg-orange-500/15 rounded-full blur-[80px] md:blur-[120px] pointer-events-none z-0 animate-pulse"></div>

                <div class="max-w-7xl mx-auto px-4 sm:px-6 relative z-10 text-center">
                    <h1 class="text-4xl sm:text-5xl md:text-8xl font-black text-white uppercase tracking-tighter mb-4 md:mb-6 drop-shadow-2xl relative z-20 italic leading-tight">
                        UN SOLO PASE.<br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-red-500 to-orange-500 animate-gradient">ACCESO TOTAL</span>
                    </h1>
                    
                    <p class="text-gray-300 text-base md:text-xl max-w-2xl mx-auto leading-relaxed relative z-20 mb-8 md:mb-10 font-medium">
                        No elijas solo una. Con tu entrada por tiempo tienes <strong>acceso liberado</strong> a todas estas atracciones increíbles.
                    </p>

                    <Link :href="route('rules')" 
                        class="relative z-20 inline-flex items-center px-8 py-4 md:px-10 md:py-5 bg-white text-gray-900 text-lg md:text-xl font-black uppercase tracking-widest rounded-full hover:bg-orange-500 hover:text-white hover:scale-105 transition-all duration-300 shadow-lg group w-full sm:w-auto justify-center">
                        <span>Reservar Salto</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6 ml-2 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </Link>
                </div>

                <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 translate-y-1/4 z-30 pointer-events-none">
                    <img src="/images/kangaroo-poses-complete_AI-diving.png" alt="Mascota Summit Cayendo" class="w-48 md:w-64 lg:w-80 drop-shadow-2xl animate-in slide-in-from-top-32 fade-in duration-1000 hover:scale-110 transition-transform cursor-pointer pointer-events-auto" />
                </div>
            </section>

            <section class="pb-16 md:pb-24 relative z-20 px-4">
                <div class="max-w-7xl mx-auto">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                        <div v-for="(activity, index) in displayActivities" :key="index" class="group relative rounded-[2rem] overflow-hidden shadow-2xl transition-all duration-500 hover:-translate-y-2 h-[400px] md:h-[500px] border border-gray-800 hover:border-orange-500/50 bg-gray-800 touch-manipulation">
                            
                            <div class="absolute inset-0 overflow-hidden">
                                <img :src="getImageUrl(activity)" :alt="activity.title" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 grayscale md:grayscale-0 md:group-hover:grayscale-0 opacity-80 group-hover:opacity-100" />
                                <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/60 to-transparent opacity-90 group-hover:opacity-70 transition-opacity duration-300"></div>
                            </div>

                            <div class="absolute inset-0 flex flex-col justify-end p-6 md:p-8">
                                <div class="transform md:translate-y-4 md:group-hover:translate-y-0 transition-transform duration-300">
                                    <h3 class="text-2xl md:text-3xl font-black text-white uppercase mb-2 md:mb-3 leading-none drop-shadow-lg">{{ activity.title }}</h3>
                                    <div class="w-12 md:w-16 h-1.5 bg-orange-500 rounded-full mb-3 md:mb-4 md:group-hover:w-24 transition-all duration-300"></div>
                                    
                                    <div class="grid grid-rows-[1fr] md:grid-rows-[0fr] md:group-hover:grid-rows-[1fr] transition-all duration-500 ease-out">
                                        <div class="overflow-hidden">
                                            <p class="text-gray-300 text-sm leading-relaxed font-medium pb-2 line-clamp-3 md:line-clamp-none">{{ activity.description }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="cumpleanos" class="relative py-16 md:py-24 bg-gray-900 overflow-hidden border-t border-gray-800">
                <div class="absolute inset-0 opacity-5 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
                
                <div class="max-w-7xl mx-auto px-4 sm:px-6 relative z-10">
                    
                    <div class="text-center mb-10 md:mb-16">
                        <span class="inline-block py-1 px-3 rounded-full bg-purple-500/10 border border-purple-500/20 text-purple-400 text-xs font-black uppercase tracking-widest mb-4">
                            Celebraciones Épicas
                        </span>
                        <h2 class="text-3xl md:text-6xl font-black text-white uppercase tracking-tighter mb-4 md:mb-6 leading-tight">
                            Paquetes de <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-500 to-pink-500">Cumpleaños</span>
                        </h2>
                        <p class="text-gray-400 text-sm max-w-2xl mx-auto border border-gray-700 rounded-lg p-3 bg-gray-800/50">
                            <span class="text-orange-500 font-bold">NOTA:</span> Incluyen <strong>2 cupos de adultos acompañantes</strong> (sin servicio).
                            <br>
                            <strong>Adicional:</strong> Niños $600 | Adultos $450
                        </p>
                    </div>

                    <div class="flex overflow-x-auto pb-8 gap-4 md:gap-6 snap-x snap-mandatory md:grid md:grid-cols-2 xl:grid-cols-4 md:overflow-visible mb-12 md:mb-16">
                        <div v-for="(pkg, index) in birthdayPackages" :key="index" 
                            class="min-w-[280px] sm:min-w-[350px] md:min-w-0 snap-center relative flex flex-col bg-gray-800 rounded-[2rem] border border-gray-700 hover:border-purple-500 transition-all shadow-xl overflow-hidden group">
                            
                            <div class="p-5 md:p-6 bg-gray-800 border-b border-gray-700 text-center group-hover:bg-gray-750 transition relative">
                                <div class="absolute top-0 left-1/2 -translate-x-1/2 w-16 md:w-20 h-1 bg-purple-500 rounded-b-full"></div>
                                <h3 class="text-sm font-bold text-purple-400 uppercase tracking-widest mb-1">{{ pkg.pax }} Participantes</h3>
                                <div class="text-2xl md:text-3xl font-black text-white tracking-tight">{{ pkg.price }}</div>
                            </div>

                            <div class="p-5 md:p-6 flex-grow text-sm">
                                <ul class="space-y-2 md:space-y-3 mb-6">
                                    <li v-for="(detail, i) in pkg.details" :key="i" class="flex items-start gap-2 text-gray-300">
                                        <svg class="w-4 h-4 text-green-400 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        <span class="leading-tight">{{ detail }}</span>
                                    </li>
                                </ul>

                                <div class="bg-purple-500/10 rounded-xl p-3 md:p-4 border border-purple-500/20">
                                    <p class="text-[10px] font-black text-purple-400 uppercase mb-2 flex items-center gap-1">
                                        🎁 Para el Cumpleañero:
                                    </p>
                                    <ul class="space-y-1.5">
                                        <li v-for="(perk, j) in perks" :key="j" class="text-xs text-gray-300 flex items-center gap-2">
                                            <span class="w-1 h-1 bg-purple-500 rounded-full"></span> {{ perk }}
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="p-4 bg-gray-900/50 mt-auto">
                                <Link :href="route('contact')" 
                                    class="block w-full py-3 rounded-xl bg-gray-700 hover:bg-purple-600 text-white text-center font-black uppercase text-xs tracking-widest transition-colors">
                                    Reservar (Contacto)
                                </Link>
                            </div>
                        </div>
                    </div>

                    <div class="mb-12 md:mb-16">
                        <h3 class="text-center text-sm font-black text-white uppercase mb-6 md:mb-8 flex items-center justify-center gap-3 opacity-60">
                            <span class="h-px w-8 md:w-12 bg-gray-700"></span>
                            Precios Adicionales
                            <span class="h-px w-8 md:w-12 bg-gray-700"></span>
                        </h3>
                        <div class="flex flex-wrap justify-center gap-2 md:gap-3">
                            <span v-for="addon in addons" :key="addon" 
                                class="px-3 py-1.5 rounded-lg bg-gray-800 border border-gray-700 text-[10px] font-bold text-gray-400 uppercase hover:text-white hover:border-orange-500 transition cursor-default">
                                {{ addon }}
                            </span>
                        </div>
                    </div>

                    <div class="bg-gray-800/50 rounded-3xl p-6 md:p-8 border border-gray-700/50 text-xs text-gray-400 leading-relaxed">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <h4 class="text-white font-bold uppercase mb-3 text-sm flex items-center gap-2">
                                    <span class="text-orange-500">⚠</span> Información de Pagos
                                </h4>
                                <ul class="list-disc pl-4 space-y-2 marker:text-orange-500">
                                    <li><strong>Seña:</strong> $6.000 para reservar. <span class="text-red-400 font-bold">NO REEMBOLSABLE.</span></li>
                                    <li><strong>Pagos:</strong> El resto se abona al finalizar.</li>
                                    <li><strong>Métodos:</strong> Efectivo, Débito, Crédito (Visa, Master, Maestro, Oca).</li>
                                    <li><strong>Cuotas OCA:</strong> 2 cuotas (> $10.000 sin descuentos).</li>
                                    <li><strong>Comisión:</strong> RedPagos/Abitab recargo $275.</li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="text-white font-bold uppercase mb-3 text-sm flex items-center gap-2">
                                    <span class="text-blue-500">ℹ</span> Notas Generales
                                </h4>
                                <ul class="list-disc pl-4 space-y-2 marker:text-blue-500">
                                    <li>Descuentos aplican al saldo final, NO a la seña.</li>
                                    <li>Precios sujetos a ajuste anual (Enero).</li>
                                    <li>Extras incluyen botella de agua y salto.</li>
                                    <li>Contrato requerido por cada cumpleañero.</li>
                                    <li><strong>Pagos Remotos:</strong> Vía WhatsApp (QR).</li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="mt-8 text-center pt-8 border-t border-gray-700">
                            <p class="mb-4 font-bold text-white text-sm">¿Dudas o quieres pagar la seña?</p>
                            <a href="https://wa.me/59899123456" target="_blank" 
                                class="inline-flex items-center gap-2 px-6 py-3 bg-green-600 text-white font-black uppercase rounded-xl hover:bg-green-500 transition shadow-lg text-xs tracking-wider w-full sm:w-auto justify-center">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                Contactar por WhatsApp
                            </a>
                        </div>
                    </div>

                </div>
            </section>

        </div>
    </MainLayout>
</template>

<style scoped>
@keyframes gradient {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}
.animate-gradient {
    background-size: 200% auto;
    animation: gradient 3s linear infinite;
}
</style>