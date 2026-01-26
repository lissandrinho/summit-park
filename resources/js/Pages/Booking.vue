<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';
import { ref, computed } from 'vue';

// Precios
const PRICES = { 60: 400, 90: 550, 120: 700 };

const form = useForm({
    date: '',
    jumpers: 1,
    duration: 60,
    time_slot: '',
    email_contact: '', // <--- NUEVO: Email obligatorio
    total_price: 400,  // Inicializamos con precio base
});

// Fechas disponibles (Próximos 7 días)
const availableDates = computed(() => {
    const dates = [];
    const today = new Date();
    for (let i = 0; i < 7; i++) {
        const d = new Date(today);
        d.setDate(today.getDate() + i);
        dates.push({
            value: d.toISOString().split('T')[0],
            label: d.toLocaleDateString('es-UY', { weekday: 'short', day: 'numeric' }),
        });
    }
    return dates;
});

const timeSlots = ['14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30', '19:00', '19:30', '20:00'];

// Cálculos
const updateTotal = () => {
    form.total_price = form.jumpers * PRICES[form.duration];
};

const selectDate = (dateValue) => form.date = dateValue;
const selectSlot = (time) => form.time_slot = time;
const selectDuration = (minutes) => {
    form.duration = minutes;
    updateTotal();
};
const updateJumpers = (val) => {
    if (val < 1 || val > 20) return;
    form.jumpers = val;
    updateTotal();
};

const submitBooking = () => {
    if (!form.date || !form.time_slot || !form.email_contact) {
        alert("Por favor completa fecha, hora y correo de contacto.");
        return;
    }
    
    // --- ENVÍO REAL AL BACKEND ---
    form.post(route('booking.store'), {
        onSuccess: () => {
            alert("¡Reserva Guardada con Éxito!"); // Opcional
        },
        onError: (errors) => {
            console.error(errors);
            alert("Error al reservar. Revisa los datos.");
        }
    });
};
</script>

<template>
    <MainLayout>
        <Head title="Reservar Turno" />

        <div class="bg-gray-900 min-h-screen pt-24 pb-32 relative">
            <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-blue-600/10 rounded-full blur-[100px] pointer-events-none"></div>

            <div class="max-w-6xl mx-auto px-6 relative z-10">
                <div class="text-center mb-12">
                    <h1 class="text-4xl md:text-5xl font-black text-white uppercase mb-4">Configura tu <span class="text-orange-500">Salto</span></h1>
                </div>

                <div class="grid lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2 space-y-8">
                        
                        <section class="bg-gray-800 p-6 rounded-3xl border border-gray-700">
                            <h3 class="text-white font-bold uppercase mb-4">1. Elige el Día</h3>
                            <div class="flex gap-3 overflow-x-auto pb-2 custom-scrollbar">
                                <button v-for="date in availableDates" :key="date.value" @click="selectDate(date.value)" 
                                    class="min-w-[80px] p-3 rounded-2xl border transition-all text-center"
                                    :class="form.date === date.value ? 'bg-orange-500 border-orange-500 text-white' : 'bg-gray-900 border-gray-700 text-gray-400 hover:border-gray-500'">
                                    <span class="text-xs uppercase font-bold block">{{ date.label }}</span>
                                </button>
                            </div>
                        </section>

                        <section class="bg-gray-800 p-6 rounded-3xl border border-gray-700">
                            <h3 class="text-white font-bold uppercase mb-4">2. Tiempo y Personas</h3>
                            <div class="grid md:grid-cols-2 gap-8">
                                <div>
                                    <label class="text-xs text-gray-500 font-bold uppercase mb-3 block">Tiempo</label>
                                    <div class="space-y-3">
                                        <button v-for="(price, min) in PRICES" :key="min" @click="selectDuration(Number(min))" 
                                            class="w-full flex justify-between p-4 rounded-xl border transition-all"
                                            :class="form.duration === Number(min) ? 'bg-blue-600/20 border-blue-500 text-white' : 'bg-gray-900 border-gray-700 text-gray-400'">
                                            <span class="font-bold">{{ min }} Min</span><span class="text-blue-400">${{ price }}</span>
                                        </button>
                                    </div>
                                </div>
                                <div>
                                    <label class="text-xs text-gray-500 font-bold uppercase mb-3 block">Saltadores</label>
                                    <div class="flex items-center bg-gray-900 rounded-xl p-2 border border-gray-700 justify-between">
                                        <button @click="updateJumpers(form.jumpers - 1)" class="w-10 h-10 bg-gray-800 text-white font-bold rounded-lg">-</button>
                                        <span class="text-3xl font-black text-white">{{ form.jumpers }}</span>
                                        <button @click="updateJumpers(form.jumpers + 1)" class="w-10 h-10 bg-orange-500 text-white font-bold rounded-lg">+</button>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="bg-gray-800 p-6 rounded-3xl border border-gray-700">
                            <h3 class="text-white font-bold uppercase mb-4">3. Horario</h3>
                            <div v-if="!form.date" class="text-center py-4 text-gray-500">Selecciona un día primero 👆</div>
                            <div v-else class="grid grid-cols-4 gap-3">
                                <button v-for="time in timeSlots" :key="time" @click="selectSlot(time)" 
                                    class="py-2 px-3 rounded-lg border text-sm font-bold transition-all"
                                    :class="form.time_slot === time ? 'bg-white text-gray-900 scale-105' : 'bg-gray-900 text-gray-300 border-gray-700'">
                                    {{ time }}
                                </button>
                            </div>
                        </section>
                    </div>

                    <div class="lg:col-span-1">
                        <div class="bg-gray-800 rounded-3xl p-6 border border-gray-700 sticky top-6">
                            <h3 class="text-xl font-black text-white uppercase mb-6 border-b border-gray-700 pb-4">Resumen</h3>
                            
                            <div class="mb-6">
                                <label class="text-xs text-gray-500 font-bold uppercase mb-2 block">Email de Contacto</label>
                                <input v-model="form.email_contact" type="email" placeholder="Para enviarte la confirmación" 
                                    class="w-full bg-gray-900 border border-gray-600 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-orange-500 outline-none">
                            </div>

                            <div class="space-y-2 mb-6 text-sm text-gray-400">
                                <div class="flex justify-between"><span>Fecha:</span> <span class="text-white">{{ form.date || '--' }}</span></div>
                                <div class="flex justify-between"><span>Hora:</span> <span class="text-white">{{ form.time_slot || '--' }}</span></div>
                                <div class="flex justify-between"><span>Total:</span> <span class="text-2xl text-orange-500 font-black">${{ form.total_price }}</span></div>
                            </div>

                            <button @click="submitBooking" :disabled="form.processing" 
                                class="w-full py-4 rounded-full bg-gradient-to-r from-orange-500 to-red-500 text-white font-black uppercase tracking-widest hover:scale-105 transition-all disabled:opacity-50">
                                {{ form.processing ? 'Procesando...' : 'Confirmar Reserva' }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<style scoped>
.custom-scrollbar::-webkit-scrollbar { height: 6px; }
.custom-scrollbar::-webkit-scrollbar-thumb { background: #4b5563; border-radius: 10px; }
</style>