<script setup>
import { Head } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    lastname: '',
    email: '',
    message: '',
});

const submit = () => {
    alert('¡Gracias! Hemos recibido tu mensaje.');
    form.reset();
};
</script>

<template>
    <MainLayout>
        <Head title="Contacto" />

        <div class="bg-gray-900 min-h-screen relative overflow-hidden">
            
            <div class="absolute inset-0 bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900 z-0"></div>

            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[1200px] h-[800px] bg-orange-500/10 rounded-full blur-[120px] pointer-events-none z-0"></div>
            
            <section class="relative pt-24 pb-16 z-10">
                <div class="max-w-7xl mx-auto px-6 text-center">
                    <h1 class="text-5xl md:text-7xl font-black text-orange-500 uppercase tracking-tighter mb-4 drop-shadow-xl">
                        CONTÁCTANOS
                    </h1>
                    <p class="text-gray-400 text-xl max-w-2xl mx-auto">
                        Estamos listos para recibirte. Revisa nuestra ubicación o déjanos un mensaje.
                    </p>
                </div>
            </section>

            <section class="pb-16 relative z-10">
                <div class="max-w-7xl mx-auto px-6">
                    <div class="grid lg:grid-cols-2 gap-12 items-center">
                        
                        <div class="space-y-10">
                            
                            <div class="space-y-8 pl-4 border-l-4 border-gray-700">
                                <div class="space-y-1">
                                    <p class="text-xs font-black text-orange-500 uppercase tracking-widest">Dirección</p>
                                    <p class="text-white text-xl font-bold">Dr. Martín Aguirre 4148</p>
                                    <p class="text-gray-400">Esq. Habana (Funsa), Villa Española</p>
                                </div>
                                
                                <div class="space-y-1">
                                    <p class="text-xs font-black text-green-500 uppercase tracking-widest">Contacto Directo</p>
                                    <p class="text-white text-xl font-bold">+598 9710 4037</p>
                                    <p class="text-gray-400">info@summittrampolineparkuruguay.com</p>
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row gap-4">
                                <a href="https://instagram.com/summittrampolineparkuruguay" target="_blank" class="flex-1 min-w-[140px] flex items-center justify-center gap-3 px-6 py-4 rounded-full bg-gray-800 border border-gray-700 text-white font-bold transition-all duration-300 hover:bg-gradient-to-r hover:from-purple-600 hover:via-pink-500 hover:to-orange-500 hover:border-transparent hover:scale-105 shadow-lg group">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="group-hover:rotate-12 transition-transform"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                                    Instagram
                                </a>

                                <a href="https://facebook.com/summittrampolineparkuruguay" target="_blank" class="flex-1 min-w-[140px] flex items-center justify-center gap-3 px-6 py-4 rounded-full bg-gray-800 border border-gray-700 text-white font-bold transition-all duration-300 hover:bg-[#1877F2] hover:border-transparent hover:scale-105 shadow-lg group">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="group-hover:rotate-12 transition-transform"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                                    Facebook
                                </a>

                                <a href="https://wa.me/59897104037" target="_blank" class="flex-1 min-w-[140px] flex items-center justify-center gap-3 px-6 py-4 rounded-full bg-gray-800 border border-gray-700 text-white font-bold transition-all duration-300 hover:bg-[#25D366] hover:border-transparent hover:scale-105 shadow-lg group">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="group-hover:rotate-12 transition-transform"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                                    WhatsApp
                                </a>
                            </div>
                        </div>

                        <div class="h-[450px] w-full">
                            <div class="h-full rounded-[2.5rem] overflow-hidden border-4 border-gray-800 shadow-2xl relative group hover:border-orange-500/30 transition-colors duration-500">
                                <iframe 
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3272.955376510839!2d-56.13880892424687!3d-34.88256247285641!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x959f810165445209%3A0x6730388d7f261352!2sDr.%20Mart%C3%ADn%20Aguirre%204148%2C%2012000%20Montevideo%2C%20Departamento%20de%20Montevideo!5e0!3m2!1ses-419!2suy!4v1700000000000!5m2!1ses-419!2suy"
                                    width="100%" 
                                    height="100%" 
                                    style="border:0;" 
                                    allowfullscreen="" 
                                    loading="lazy" 
                                    class="grayscale group-hover:grayscale-0 transition duration-700 w-full h-full"
                                ></iframe>
                                <div class="absolute bottom-6 left-6 bg-white text-gray-900 px-6 py-3 rounded-full shadow-lg transform transition hover:-translate-y-1">
                                    <p class="font-bold text-xs uppercase tracking-wider flex items-center gap-2">
                                        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                                        Villa Española
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <section class="pb-24 mt-10 mb-10 relative z-10">
                <div class="max-w-6xl mx-auto px-6">
                    
                    <div class="grid lg:grid-cols-12 gap-8 items-center">
                        
                        <div class="lg:col-span-4 hidden lg:flex justify-center lg:justify-end relative">
                            <div class="relative z-20 transform translate-x-8 hover:-translate-y-2 transition-transform duration-500">
                                <img 
                                    src="/images/R.png" 
                                    alt="Mascota Summit" 
                                    class="w-full max-w-xs drop-shadow-2xl filter brightness-110"
                                />
                                <div class="absolute -top-10 -right-10 bg-white text-gray-900 px-6 py-3 rounded-tr-3xl rounded-tl-3xl rounded-bl-3xl shadow-lg animate-bounce">
                                    <p class="font-black text-sm uppercase">¡Escríbenos!</p>
                                </div>
                            </div>
                        </div>

                        <div class="lg:col-span-8 bg-gray-800 p-8 md:p-12 rounded-[2.5rem] shadow-2xl border border-gray-700 relative z-10">
                            
                            <div class="mb-10 border-b border-gray-700 pb-6">
                                <h3 class="text-3xl font-black text-white uppercase mb-2">Formulario de Contacto</h3>
                                <p class="text-gray-400">Completa tus datos y te responderemos a la brevedad.</p>
                            </div>

                            <form @submit.prevent="submit" class="space-y-6">
                                <div class="grid md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-gray-500 text-xs font-bold uppercase tracking-wider mb-2 ml-4">Nombre</label>
                                        <input v-model="form.name" type="text" class="w-full bg-gray-900/50 border border-gray-600 rounded-full px-6 py-4 text-white focus:ring-2 focus:ring-orange-500 transition outline-none placeholder-gray-600" placeholder="Tu nombre" required />
                                    </div>
                                    <div>
                                        <label class="block text-gray-500 text-xs font-bold uppercase tracking-wider mb-2 ml-4">Apellido</label>
                                        <input v-model="form.lastname" type="text" class="w-full bg-gray-900/50 border border-gray-600 rounded-full px-6 py-4 text-white focus:ring-2 focus:ring-orange-500 transition outline-none placeholder-gray-600" placeholder="Tu apellido" required />
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-gray-500 text-xs font-bold uppercase tracking-wider mb-2 ml-4">Correo Electrónico</label>
                                    <input v-model="form.email" type="email" class="w-full bg-gray-900/50 border border-gray-600 rounded-full px-6 py-4 text-white focus:ring-2 focus:ring-orange-500 transition outline-none placeholder-gray-600" placeholder="tucorreo@ejemplo.com" required />
                                </div>

                                <div>
                                    <label class="block text-gray-500 text-xs font-bold uppercase tracking-wider mb-2 ml-4">Mensaje</label>
                                    <textarea v-model="form.message" rows="4" class="w-full bg-gray-900/50 border border-gray-600 rounded-[2rem] px-6 py-4 text-white focus:ring-2 focus:ring-orange-500 transition outline-none resize-none placeholder-gray-600" placeholder="¿En qué podemos ayudarte?" required></textarea>
                                </div>

                                <button type="submit" class="w-full bg-orange-500 text-white font-black uppercase tracking-widest py-4 rounded-full hover:bg-orange-600 transition shadow-[0_10px_30px_rgba(249,115,22,0.4)] transform hover:-translate-y-1 mt-6 text-sm md:text-base">
                                    Enviar Mensaje
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </section>

        </div>
    </MainLayout>
</template>