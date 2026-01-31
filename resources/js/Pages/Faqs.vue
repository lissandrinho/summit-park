<script setup>
import { Head, Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';
import { ref } from 'vue';

// Estado para controlar qué pregunta está abierta
const openIndex = ref(null);

const toggle = (index) => {
    openIndex.value = openIndex.value === index ? null : index;
};

// Datos de las Preguntas (Basado en parques de trampolines reales)
const faqs = [
    {
        question: "¿Es necesario reservar antes de ir?",
        answer: "Sí, recomendamos encarecidamente reservar en línea para garantizar tu lugar, especialmente los fines de semana y feriados cuando solemos agotar cupos. Además, reservar en la web es más rápido y asegura tu ingreso."
    },
    {
        question: "¿Qué ropa debo usar?",
        answer: "Recomendamos ropa deportiva cómoda (shorts, calzas, camisetas). No se permite ropa con hebillas, cinturones con tachas o joyas que puedan dañar las camas elásticas o lastimarte."
    },
    {
        question: "¿Son obligatorios los calcetines Summit?",
        answer: "¡Sí! Por razones de seguridad e higiene, todos los saltadores deben usar los calcetines antideslizantes oficiales de Summit. Si ya tienes un par de una visita anterior, ¡tráelos! Si no, puedes comprarlos en taquilla o al reservar online."
    },
    {
        question: "¿Hay límite de edad?",
        answer: "¡Summit es para todas las edades! Sin embargo, para la seguridad de los más pequeños, tenemos áreas designadas y horarios especiales. Los niños menores de 5 años deben estar supervisados por un adulto en todo momento."
    },
    {
        question: "¿Qué es el Waiver y por qué debo firmarlo?",
        answer: "El Waiver es un documento legal de exención de responsabilidad obligatorio para todos los participantes. Si eres menor de 18 años, debe firmarlo un padre o tutor legal. Puedes firmarlo en línea antes de llegar para ahorrar tiempo."
    },
    {
        question: "¿Puedo llevar mi propia comida?",
        answer: "No se permite el ingreso de alimentos o bebidas externas al parque. Contamos con una cantina completa con snacks, bebidas y opciones deliciosas para recargar energías."
    },
    {
        question: "¿A qué hora debo llegar?",
        answer: "Te recomendamos llegar 15 o 20 minutos antes de tu turno reservado. Esto te dará tiempo suficiente para hacer el check-in, ponerte los calcetines, guardar tus cosas y escuchar las reglas de seguridad sin perder tiempo de salto."
    },
    {
        question: "¿Tienen estacionamiento?",
        answer: "Sí, contamos con estacionamiento gratuito para nuestros clientes, sujeto a disponibilidad."
    }
];
</script>

<template>
    <MainLayout>
        <Head title="Preguntas Frecuentes" />

        <div class="bg-gray-900 min-h-screen font-sans text-gray-100 selection:bg-orange-500 selection:text-white relative overflow-hidden">
            
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
                <div class="absolute top-[-10%] right-[-10%] w-[600px] h-[600px] bg-orange-600/10 rounded-full blur-[120px]"></div>
                <div class="absolute bottom-[-10%] left-[-10%] w-[600px] h-[600px] bg-blue-600/10 rounded-full blur-[120px]"></div>
            </div>

            <section class="relative pt-32 pb-20 text-center px-6">
                <span class="inline-block py-1 px-3 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs font-black uppercase tracking-widest mb-4">
                    Ayuda & Soporte
                </span>
                <h1 class="text-4xl md:text-6xl font-black text-white uppercase tracking-tighter mb-6 drop-shadow-xl">
                    Preguntas <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-500">Frecuentes</span>
                </h1>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                    Resolvemos tus dudas para que solo te preocupes por saltar lo más alto posible.
                </p>
            </section>

            <section class="max-w-4xl mx-auto px-6 pb-32 relative z-10">
                <div class="space-y-4">
                    
                    <div 
                        v-for="(item, index) in faqs" 
                        :key="index"
                        class="bg-gray-800 rounded-2xl border transition-all duration-300 overflow-hidden"
                        :class="openIndex === index ? 'border-orange-500 shadow-[0_0_20px_rgba(249,115,22,0.15)]' : 'border-gray-700 hover:border-gray-600'"
                    >
                        <button 
                            @click="toggle(index)"
                            class="w-full flex justify-between items-center p-6 text-left focus:outline-none group"
                        >
                            <span 
                                class="text-lg font-bold transition-colors duration-300"
                                :class="openIndex === index ? 'text-white' : 'text-gray-300 group-hover:text-white'"
                            >
                                {{ item.question }}
                            </span>
                            
                            <div 
                                class="relative w-8 h-8 rounded-full flex items-center justify-center transition-all duration-300"
                                :class="openIndex === index ? 'bg-orange-500 rotate-180' : 'bg-gray-700 group-hover:bg-gray-600'"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </button>

                        <div 
                            class="grid transition-all duration-300 ease-in-out"
                            :class="openIndex === index ? 'grid-rows-[1fr] opacity-100' : 'grid-rows-[0fr] opacity-0'"
                        >
                            <div class="overflow-hidden">
                                <div class="px-6 pb-6 text-gray-400 leading-relaxed border-t border-gray-700/50 pt-4 text-sm md:text-base">
                                    {{ item.answer }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="mt-16 text-center bg-gray-800/50 border border-gray-700 p-8 rounded-3xl backdrop-blur-sm">
                    <h3 class="text-xl font-bold text-white mb-2">¿No encuentras lo que buscas?</h3>
                    <p class="text-gray-400 mb-6 text-sm">Nuestro equipo está listo para ayudarte con cualquier otra consulta.</p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <Link :href="route('contact')" class="inline-flex items-center justify-center px-6 py-3 bg-white text-gray-900 font-black uppercase rounded-xl hover:bg-gray-200 transition shadow-lg text-xs tracking-widest">
                            Ir a Contacto
                        </Link>
                        <a href="https://wa.me/59897104037" target="_blank" class="inline-flex items-center justify-center px-6 py-3 bg-green-600 text-white font-black uppercase rounded-xl hover:bg-green-500 transition shadow-lg text-xs tracking-widest gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                            WhatsApp
                        </a>
                    </div>
                </div>

            </section>

        </div>
    </MainLayout>
</template>