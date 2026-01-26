<script setup>
import { ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';

// Estado para el Switch (true = Tickets, false = Membresías)
const isTicketsView = ref(true);

// Datos de Tickets (Entradas Únicas)
const tickets = [
    {
        name: 'SALTO 90 MIN',
        price: '$500',
        sub: 'Pago Único',
        duration: '1 Hora y Media',
        description: 'La opción perfecta para descargar energía una tarde cualquiera.',
        features: [
            'Acceso a todas las zonas',
            'Cancha Principal',
            'Piscina de Espuma',
            'Dodgeball y Basket',
            'Waiver requerido'
        ],
        highlight: false,
    },
    {
        name: 'SALTO 2 HORAS',
        price: '$700',
        sub: 'Pago Único',
        duration: '2 Horas Completas',
        description: 'Doble diversión para los saltadores más exigentes.',
        features: [
            'Acceso TOTAL al parque',
            'Tiempo extendido',
            'Ideal para expertos',
            'Acceso a Pista Ninja',
            'Waiver requerido'
        ],
        highlight: true, // Destacado
    },
    {
        name: 'GRUPOS (+15)',
        price: '$460',
        sub: 'Por persona',
        duration: '90 Minutos',
        description: 'Tarifa especial para escuelas y grandes grupos.',
        features: [
            'Mínimo 15 personas',
            'Lunes a Viernes (14-18hs)',
            'Coordinación previa',
            'Un solo pago',
            'No aplica feriados'
        ],
        highlight: false,
    },
];

// Datos de Membresías (Mensuales)
const memberships = [
    {
        name: 'MEMBRESÍA INDIVIDUAL',
        price: '$300',
        sub: 'Al mes',
        duration: 'Suscripción Mensual',
        description: 'Salta todos los días por menos del precio de una entrada.',
        features: [
            'Acceso diario (Lun-Vie)',
            'Costo activación única: $300',
            'Cobro automático mensual',
            'Tarjeta de crédito requerida',
            'Ideal para entrenamiento'
        ],
        highlight: true,
    },
    {
        name: 'PLAN FAMILIAR',
        price: '$550',
        sub: 'Para 2 personas',
        duration: 'Ahorro en Grupo',
        description: '¡Cuantos más saltan, menos pagan! Precios por grupo total.',
        features: [
            '2 Personas: $550/mes',
            '3 Personas: $825/mes',
            '4 Personas: $1,100/mes',
            '5 Personas: $1,375/mes',
            '6 Personas: $1,650/mes'
        ],
        highlight: false,
    },
    {
        name: 'BENEFICIOS SOCIO',
        price: 'VIP',
        sub: 'Exclusivo',
        duration: 'Ventajas Extra',
        description: 'Ser socio tiene sus privilegios. Accede a descuentos especiales.',
        features: [
            'Pase Amigo (2hs): $380',
            'Hora Extra: $300',
            'Acceso prioritario',
            'Eventos exclusivos',
            'Descuentos en calcetines'
        ],
        highlight: false,
    },
];
</script>

<template>
    <MainLayout>
        <Head title="Precios y Membresías" />

        <div class="bg-gray-900 min-h-screen">
            
            <section class="relative pt-24 pb-48 md:pb-56 overflow-visible">
                <div class="absolute inset-0 bg-gradient-to-b from-gray-800 to-gray-900 z-0"></div>
                <div class="absolute top-[-50%] left-1/2 -translate-x-1/2 w-[800px] h-[800px] bg-orange-500/10 rounded-full blur-[120px] pointer-events-none z-0"></div>

                <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
                    <h1 class="text-5xl md:text-7xl font-black text-white uppercase tracking-tighter mb-6 drop-shadow-xl">
                        PRECIOS Y <span class="text-orange-500">MEMBRESÍAS</span>
                    </h1>
                    <p class="text-gray-400 text-xl max-w-2xl mx-auto mb-10 relative z-20">
                        Elige cómo quieres saltar: visita por un día o únete al club para saltar todo el mes.
                    </p>

                    <div class="relative z-20 inline-flex bg-gray-800 p-1 rounded-full border border-gray-700">
                        <div 
                            class="absolute top-1 bottom-1 w-[calc(50%-4px)] bg-orange-500 rounded-full transition-all duration-300 ease-in-out shadow-lg"
                            :class="isTicketsView ? 'left-1' : 'left-[calc(50%+4px)]'"
                        ></div>
                        
                        <button 
                            @click="isTicketsView = true"
                            class="relative z-10 px-8 py-3 rounded-full text-sm font-black uppercase tracking-widest transition-colors duration-300 w-32 md:w-40"
                            :class="isTicketsView ? 'text-white' : 'text-gray-400 hover:text-white'"
                        >
                            Tickets
                        </button>

                        <button 
                            @click="isTicketsView = false"
                            class="relative z-10 px-8 py-3 rounded-full text-sm font-black uppercase tracking-widest transition-colors duration-300 w-32 md:w-40"
                            :class="!isTicketsView ? 'text-white' : 'text-gray-400 hover:text-white'"
                        >
                            Membresías
                        </button>
                    </div>
                </div>

                <div class="absolute bottom-0 right-[5%] lg:right-[15%] transform translate-y-1/4 z-30 pointer-events-none hidden md:block">
                    <img 
                        src="/images/R.png" 
                        alt="Mascota Summit" 
                        class="w-64 lg:w-80 drop-shadow-2xl animate-in slide-in-from-top-32 fade-in duration-1000 rotate-12"
                    />
                </div>
            </section>

            <section class="pb-24 relative z-20">
                <div class="max-w-7xl mx-auto px-6">
                    
                    <transition 
                        mode="out-in"
                        enter-active-class="transition duration-300 ease-out"
                        enter-from-class="transform opacity-0 scale-95"
                        enter-to-class="transform opacity-100 scale-100"
                        leave-active-class="transition duration-200 ease-in"
                        leave-from-class="transform opacity-100 scale-100"
                        leave-to-class="transform opacity-0 scale-95"
                    >
                        <div :key="isTicketsView ? 'tickets' : 'memberships'" class="grid md:grid-cols-3 gap-8 items-start">
                            
                            <div v-for="(plan, index) in (isTicketsView ? tickets : memberships)" :key="index" 
                                :class="[
                                    'relative rounded-3xl p-8 border transition-all duration-300 hover:-translate-y-2 h-full flex flex-col',
                                    plan.highlight 
                                        ? 'bg-gray-800 border-orange-500 shadow-[0_0_40px_rgba(249,115,22,0.15)] transform md:scale-105 z-10' 
                                        : 'bg-gray-900/50 border-gray-800 hover:border-gray-700'
                                ]"
                            >
                                <div v-if="plan.highlight" class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-orange-500 text-white px-4 py-1 rounded-full text-xs font-black uppercase tracking-widest shadow-lg whitespace-nowrap">
                                    {{ isTicketsView ? 'Más Popular' : 'Mejor Valor' }}
                                </div>

                                <h3 class="text-gray-400 font-bold uppercase tracking-wider text-sm mb-4">{{ plan.name }}</h3>
                                
                                <div class="flex items-baseline gap-1 mb-1">
                                    <span :class="['text-5xl font-black', plan.highlight ? 'text-white' : 'text-white']">{{ plan.price }}</span>
                                </div>
                                <p class="text-gray-500 text-xs uppercase font-bold mb-4">{{ plan.sub }}</p>
                                
                                <p class="text-orange-500 font-bold text-sm mb-6">{{ plan.duration }}</p>

                                <p class="text-gray-400 text-sm mb-8 leading-relaxed border-b border-gray-800 pb-8 min-h-[60px]">
                                    {{ plan.description }}
                                </p>

                                <ul class="space-y-4 mb-8 flex-grow">
                                    <li v-for="feature in plan.features" :key="feature" class="flex items-start gap-3 text-sm text-gray-300">
                                        <svg class="w-5 h-5 text-orange-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        <span>{{ feature }}</span>
                                    </li>
                                </ul>

                                <Link :href="route('contact')" 
                                    :class="[
                                        'block w-full py-4 rounded-full text-center font-black uppercase tracking-widest text-xs transition-all duration-300',
                                        plan.highlight 
                                            ? 'bg-orange-500 text-white hover:bg-orange-600 shadow-lg hover:shadow-orange-500/25' 
                                            : 'bg-white text-gray-900 hover:bg-gray-100'
                                    ]"
                                >
                                    {{ isTicketsView ? 'Reservar Turno' : 'Solicitar Membresía' }}
                                </Link>
                            </div>

                        </div>
                    </transition>

                    <div v-if="!isTicketsView" class="mt-8 text-center bg-gray-800/50 p-4 rounded-xl border border-gray-700/50 animate-in fade-in slide-in-from-bottom-4">
                        <p class="text-gray-400 text-sm">
                            <span class="text-orange-500 font-bold">*</span> Las membresías requieren tarjeta de crédito y tienen un costo de activación único de $300.
                        </p>
                    </div>

                    <div class="mt-16 bg-gray-800 rounded-3xl p-8 md:p-12 border border-gray-700 flex flex-col md:flex-row items-center justify-between gap-8 relative z-20">
                        <div>
                            <h3 class="text-2xl font-black text-white uppercase mb-2">
                                <span class="text-orange-500">IMPORTANTE:</span> Medias Summit
                            </h3>
                            <p class="text-gray-400 max-w-xl">
                                Para garantizar tu seguridad e higiene, es obligatorio el uso de nuestras medias antideslizantes. 
                                <span class="text-white font-bold">Son tuyas para siempre</span>, lávalas y tráelas en tu próxima visita.
                            </p>
                        </div>
                        <div class="flex flex-col items-end gap-2">
                            <span class="text-4xl font-black text-white">$250</span>
                            <span class="text-gray-500 text-sm uppercase font-bold">Por par (Cortas o Largas)</span>
                        </div>
                    </div>

                </div>
            </section>

        </div>
    </MainLayout>
</template>