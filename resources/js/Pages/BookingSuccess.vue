<script setup>
import { Head, Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';

defineProps({
    booking: Object
});
</script>

<template>
    <MainLayout>
        <Head title="Reserva Exitosa" />

        <div class="bg-gray-900 min-h-screen flex items-center justify-center p-4">
            
            <div class="bg-white text-gray-900 w-full max-w-md rounded-3xl shadow-2xl overflow-hidden relative">
                
                <div class="bg-orange-500 p-6 text-center relative overflow-hidden">
                    <div class="absolute inset-0 bg-black/10 pattern-dots"></div> <h1 class="text-3xl font-black text-white uppercase tracking-tighter relative z-10">¡Reserva Lista!</h1>
                    <p class="text-white/90 text-sm font-bold mt-1 relative z-10">Te esperamos en Summit Park</p>
                </div>

                <div class="p-8 space-y-6">
                    
                    <div class="text-center">
                        <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mb-2">Código de Reserva</p>
                        <div class="text-5xl font-black text-gray-800 tracking-widest">#{{ booking.id }}</div>
                    </div>

                    <div class="border-t border-dashed border-gray-300 my-6"></div>

                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500 font-bold">Fecha:</span>
                            <span class="font-black">{{ booking.date }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500 font-bold">Hora:</span>
                            <span class="font-black">{{ booking.time_slot }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500 font-bold">Personas:</span>
                            <span class="font-black">{{ booking.jumpers }} Saltadores</span>
                        </div>
                        <div class="flex justify-between items-center bg-gray-100 p-3 rounded-lg mt-2">
                            <span class="text-gray-600 font-bold">Total a Pagar:</span>
                            <span class="text-2xl font-black text-green-600">${{ booking.total_price }}</span>
                        </div>
                    </div>

                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 flex gap-3 items-start">
                        <span class="text-2xl">ℹ️</span>
                        <p class="text-xs text-blue-800 leading-relaxed font-medium">
                            Presenta este código en la caja <strong>20 minutos antes</strong> de tu turno para realizar el pago y recibir tus calcetines.
                        </p>
                    </div>

                    <Link :href="route('home')" class="block w-full py-4 bg-gray-900 text-white text-center font-bold uppercase rounded-xl hover:bg-gray-800 transition">
                        Volver al Inicio
                    </Link>
                </div>

                <div class="absolute top-[95px] -left-3 w-6 h-6 bg-gray-900 rounded-full"></div>
                <div class="absolute top-[95px] -right-3 w-6 h-6 bg-gray-900 rounded-full"></div>

            </div>
        </div>
    </MainLayout>
</template>