<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';

const form = useForm({
    name: '',
    email: '',
    phone: '', // ¡Nuevo campo agregado!
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <MainLayout>
        <Head title="Crear Cuenta" />

        <div class="bg-gray-900 min-h-screen flex items-center justify-center p-4 relative overflow-hidden font-sans">
            
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
                <div class="absolute top-[-20%] left-[-10%] w-[600px] h-[600px] bg-orange-600/20 rounded-full blur-[120px] animate-pulse"></div>
                <div class="absolute bottom-[-20%] right-[-10%] w-[600px] h-[600px] bg-blue-600/10 rounded-full blur-[120px]"></div>
            </div>

            <div class="w-full max-w-5xl grid md:grid-cols-2 bg-gray-800 rounded-[2.5rem] shadow-2xl overflow-hidden border border-gray-700 relative z-10">
                
                <div class="relative bg-gray-700 hidden md:flex flex-col items-center justify-center p-12 text-center overflow-hidden group">
                    <div class="absolute inset-0 bg-[url('/images/Web-Maincourt2.jpg')] bg-cover bg-center opacity-40 grayscale group-hover:grayscale-0 transition duration-1000 transform group-hover:scale-110"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/60 to-transparent"></div>
                    
                    <div class="relative z-10">
                        <img 
                            src="/images/kangaroo-poses-complete_AI-diving.png" 
                            alt="Summit Mascot" 
                            class="w-64 drop-shadow-2xl mb-6 animate-in slide-in-from-bottom-10 duration-1000 hover:scale-110 transition-transform cursor-pointer"
                        >
                        <h2 class="text-3xl font-black text-white uppercase tracking-tighter mb-2 drop-shadow-lg">
                            ¡Únete al <span class="text-orange-500">Equipo!</span>
                        </h2>
                        <p class="text-gray-300 text-sm font-medium max-w-xs mx-auto">
                            Regístrate para agilizar tus reservas, firmar waivers digitales y recibir ofertas exclusivas.
                        </p>
                    </div>
                </div>

                <div class="p-8 md:p-12 flex flex-col justify-center bg-gray-800">
                    
                    <div class="text-center mb-8 md:text-left">
                        <h1 class="text-2xl font-black text-white uppercase tracking-wide flex items-center gap-2 justify-center md:justify-start">
                            <span class="w-1.5 h-8 bg-orange-500 rounded-full"></span>
                            Crear Cuenta
                        </h1>
                        <p class="text-gray-400 text-sm mt-2 ml-4">Completa tus datos para comenzar a saltar.</p>
                    </div>

                    <form @submit.prevent="submit" class="space-y-4">
                        
                        <div>
                            <label class="text-[10px] text-gray-500 font-bold uppercase block mb-1 ml-1">Nombre Completo</label>
                            <input 
                                v-model="form.name"
                                type="text" 
                                class="w-full bg-gray-900 border border-gray-600 rounded-xl px-4 py-3 text-white focus:border-orange-500 focus:ring-1 focus:ring-orange-500 outline-none transition placeholder-gray-600"
                                placeholder="Ej: Juan Pérez"
                                required
                                autofocus
                                autocomplete="name"
                            >
                            <p v-if="form.errors.name" class="text-red-500 text-xs mt-1 font-bold">{{ form.errors.name }}</p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="text-[10px] text-gray-500 font-bold uppercase block mb-1 ml-1">Correo Electrónico</label>
                                <input 
                                    v-model="form.email"
                                    type="email" 
                                    class="w-full bg-gray-900 border border-gray-600 rounded-xl px-4 py-3 text-white focus:border-orange-500 outline-none transition placeholder-gray-600"
                                    placeholder="tu@email.com"
                                    required
                                    autocomplete="username"
                                >
                                <p v-if="form.errors.email" class="text-red-500 text-xs mt-1 font-bold">{{ form.errors.email }}</p>
                            </div>

                            <div>
                                <label class="text-[10px] text-gray-500 font-bold uppercase block mb-1 ml-1">Teléfono</label>
                                <input 
                                    v-model="form.phone"
                                    type="text" 
                                    class="w-full bg-gray-900 border border-gray-600 rounded-xl px-4 py-3 text-white focus:border-orange-500 outline-none transition placeholder-gray-600"
                                    placeholder="099 123 456"
                                >
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="text-[10px] text-gray-500 font-bold uppercase block mb-1 ml-1">Contraseña</label>
                                <input 
                                    v-model="form.password"
                                    type="password" 
                                    class="w-full bg-gray-900 border border-gray-600 rounded-xl px-4 py-3 text-white focus:border-orange-500 outline-none transition placeholder-gray-600"
                                    placeholder="••••••••"
                                    required
                                    autocomplete="new-password"
                                >
                            </div>
                            <div>
                                <label class="text-[10px] text-gray-500 font-bold uppercase block mb-1 ml-1">Confirmar</label>
                                <input 
                                    v-model="form.password_confirmation"
                                    type="password" 
                                    class="w-full bg-gray-900 border border-gray-600 rounded-xl px-4 py-3 text-white focus:border-orange-500 outline-none transition placeholder-gray-600"
                                    placeholder="••••••••"
                                    required
                                    autocomplete="new-password"
                                >
                            </div>
                        </div>
                        <p v-if="form.errors.password" class="text-red-500 text-xs mt-1 font-bold">{{ form.errors.password }}</p>

                        <button 
                            type="submit" 
                            :disabled="form.processing"
                            class="w-full mt-4 bg-gradient-to-r from-orange-600 to-red-600 text-white font-black uppercase tracking-widest py-4 rounded-xl shadow-lg hover:scale-[1.02] active:scale-95 transition-all disabled:opacity-50 border border-orange-500/20"
                        >
                            <span v-if="form.processing">Procesando...</span>
                            <span v-else>Registrarme</span>
                        </button>

                        <div class="text-center mt-6 pt-4 border-t border-gray-700">
                            <p class="text-gray-500 text-sm mb-1">¿Ya eres parte de la familia?</p>
                            <Link :href="route('login')" class="text-orange-500 font-bold hover:text-orange-400 transition uppercase text-xs tracking-wide">
                                Iniciar Sesión Aquí
                            </Link>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </MainLayout>
</template>