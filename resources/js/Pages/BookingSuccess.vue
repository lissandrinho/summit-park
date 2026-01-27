<script setup>
import { Head, Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';
import { computed } from 'vue';

const props = defineProps({
    booking: Object
});

// Extraemos los nombres del waiver si existen
const jumpersList = computed(() => {
    // Intentamos obtener el waiver vinculado a la reserva
    const waiver = props.booking.waiver;
    if (!waiver) return [];

    // El titular siempre está
    const list = [waiver.full_name];

    // Si hay menores, los parseamos (pueden venir como string JSON o array)
    let minors = [];
    try {
        minors = typeof waiver.minors === 'string' ? JSON.parse(waiver.minors) : waiver.minors;
    } catch (e) {
        console.error("Error parseando menores", e);
    }

    if (Array.isArray(minors)) {
        minors.forEach(m => list.push(m.name));
    }

    return list;
});
</script>

<template>
    <MainLayout>
        <Head title="Reserva Confirmada" />

        <div class="bg-gray-900 min-h-screen flex items-center justify-center p-4 font-sans">
            
            <div class="bg-white text-gray-900 w-full max-w-md rounded-[2.5rem] shadow-2xl overflow-hidden relative border-4 border-gray-800">
                
                <div class="bg-gradient-to-r from-orange-500 to-red-500 p-8 text-center relative overflow-hidden">
                    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-white to-transparent"></div>
                    
                    <div class="relative z-10 mb-4">
                        <img src="\images\R.png" alt="Mascota Canguro Summit Park" class="w-32 h-auto mx-auto drop-shadow-lg">
                    </div>
                    
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg relative z-10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-500" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                    </div>
                    
                    <h1 class="text-3xl font-black text-white uppercase tracking-tighter relative z-10 leading-none">¡Reserva Lista!</h1>
                    <p class="text-white/90 text-xs font-bold mt-2 uppercase tracking-widest relative z-10">Te esperamos en Summit Park</p>
                </div>

                <div class="p-8 space-y-6">
                    
                    <div class="text-center bg-gray-50 p-4 rounded-xl border border-gray-200 border-dashed">
                        <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest mb-1">Tu Código de Acceso</p>
                        <div class="text-5xl font-black text-gray-800 tracking-widest font-mono">#{{ booking.id }}</div>
                    </div>

                    <div class="space-y-4 text-sm">
                        <div class="flex justify-between border-b border-gray-100 pb-2">
                            <span class="text-gray-400 font-bold text-xs uppercase">Fecha</span>
                            <span class="font-black text-gray-800">{{ booking.date }}</span>
                        </div>
                        <div class="flex justify-between border-b border-gray-100 pb-2">
                            <span class="text-gray-400 font-bold text-xs uppercase">Hora</span>
                            <span class="font-black text-gray-800">{{ booking.time_slot }}</span>
                        </div>
                        
                        <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-gray-400 font-bold text-xs uppercase">Saltadores ({{ booking.jumpers }})</span>
                            </div>
                            <ul v-if="jumpersList.length > 0" class="space-y-1">
                                <li v-for="(name, index) in jumpersList" :key="index" class="text-xs font-bold text-gray-700 flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> {{ name }}
                                </li>
                            </ul>
                            <div v-else class="text-xs text-gray-500 italic">
                                {{ booking.jumpers }} personas registradas
                            </div>
                        </div>

                        <div class="flex justify-between items-center bg-gray-900 p-4 rounded-xl mt-4 shadow-lg">
                            <div class="flex flex-col">
                                <span class="text-gray-400 text-[10px] font-bold uppercase">Monto a Pagar en Caja</span>
                                <span class="text-green-400 text-[10px] font-bold">Incluye IVA</span>
                            </div>
                            <span class="text-3xl font-black text-white tracking-tighter">${{ booking.total_price }}</span>
                        </div>
                    </div>

                    <div class="bg-blue-50 border border-blue-100 rounded-xl p-3 flex gap-3 items-center">
                        <span class="text-xl">🕒</span>
                        <p class="text-[10px] text-blue-800 font-bold leading-tight">
                            Llega <span class="underline">20 minutos antes</span> de tu turno para validar tu waiver, pagar y recibir tus calcetines antideslizantes.
                        </p>
                    </div>

                    <Link :href="route('home')" class="block w-full py-4 bg-gray-900 text-white text-center font-black uppercase tracking-widest rounded-xl hover:scale-[1.02] active:scale-95 transition-all shadow-xl">
                        Volver al Inicio
                    </Link>
                </div>

                <div class="absolute top-[250px] -left-3 w-6 h-6 bg-gray-900 rounded-full"></div>
                <div class="absolute top-[250px] -right-3 w-6 h-6 bg-gray-900 rounded-full"></div>
                <div class="absolute top-[261px] left-4 right-4 border-t-2 border-dashed border-gray-300"></div>

            </div>
        </div>
    </MainLayout>
</template>