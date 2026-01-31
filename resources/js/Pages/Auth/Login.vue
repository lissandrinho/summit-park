<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Ingresar" />

        <div class="fixed inset-0 bg-gray-900 flex flex-col justify-center items-center p-4 font-sans selection:bg-orange-500 selection:text-white">
            
            <div class="absolute top-6 left-6 z-50 animate-in fade-in slide-in-from-top-4 duration-700">
                <Link 
                    :href="route('home')" 
                    class="group flex items-center gap-3 px-5 py-3 rounded-full bg-gray-800/50 backdrop-blur-md border border-gray-700 hover:border-orange-500/50 text-gray-400 hover:text-white transition-all duration-300 shadow-lg hover:shadow-orange-500/10"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span class="text-xs font-black uppercase tracking-widest">Volver al Inicio</span>
                </Link>
            </div>

            <div class="absolute top-0 left-0 w-[600px] h-[600px] bg-orange-500/10 rounded-full blur-[120px] pointer-events-none -translate-x-1/3 -translate-y-1/3 animate-pulse"></div>
            <div class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-blue-600/10 rounded-full blur-[120px] pointer-events-none translate-x-1/3 translate-y-1/3"></div>

            <div v-if="status" class="mb-4 font-medium text-sm text-green-400 z-20 bg-green-900/50 px-4 py-2 rounded-lg border border-green-500/30">
                {{ status }}
            </div>

            <div class="w-full max-w-4xl bg-gray-800 rounded-[2.5rem] shadow-2xl overflow-hidden grid md:grid-cols-2 relative z-10 border border-gray-700">
                
                <div class="hidden md:block relative h-full min-h-[600px] group overflow-hidden">
                    <img 
                        src="/images/R.png" 
                        alt="Summit Park" 
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105" 
                    />
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent mix-blend-multiply"></div>
                    
                    <div class="absolute bottom-10 left-10 text-white z-10">
                        <div class="h-1 w-12 bg-orange-500 mb-4 rounded-full"></div>
                        <p class="font-black text-2xl uppercase tracking-tighter text-white drop-shadow-lg">Summit Park</p>
                        <p class="text-gray-300 text-sm font-medium opacity-90">Acceso exclusivo para miembros y staff.</p>
                    </div>
                </div>

                <div class="p-8 md:p-12 flex flex-col justify-center bg-gray-800 relative">
                    
                    <div class="flex justify-center mb-8">
                        <img src="/images/Summit-Logo-full-white.png" alt="Logo Summit" class="h-16 w-auto object-contain drop-shadow-2xl hover:scale-105 transition-transform duration-500" />
                    </div>

                    <div class="text-center mb-8">
                        <h2 class="text-2xl font-black text-white uppercase tracking-tighter">Bienvenido</h2>
                        <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mt-1">Ingresa tus credenciales</p>
                    </div>

                    <form @submit.prevent="submit" class="space-y-5">
                        <div class="group">
                            <InputLabel for="email" value="Correo Electrónico" class="text-gray-400 uppercase text-[10px] font-black tracking-widest ml-1 mb-2 group-focus-within:text-orange-500 transition-colors" />
                            <TextInput
                                id="email"
                                type="email"
                                class="mt-1 block w-full bg-gray-900/50 border-gray-700 text-white focus:border-orange-500 focus:ring-1 focus:ring-orange-500 rounded-xl py-3 pl-4 transition-all"
                                v-model="form.email"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="tu@email.com"
                            />
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div class="group">
                            <InputLabel for="password" value="Contraseña" class="text-gray-400 uppercase text-[10px] font-black tracking-widest ml-1 mb-2 group-focus-within:text-orange-500 transition-colors" />
                            <TextInput
                                id="password"
                                type="password"
                                class="mt-1 block w-full bg-gray-900/50 border-gray-700 text-white focus:border-orange-500 focus:ring-1 focus:ring-orange-500 rounded-xl py-3 pl-4 transition-all"
                                v-model="form.password"
                                required
                                autocomplete="current-password"
                                placeholder="••••••••"
                            />
                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>

                        <div class="flex items-center justify-between mt-2">
                            <label class="flex items-center cursor-pointer group">
                                <Checkbox name="remember" v-model:checked="form.remember" class="text-orange-500 focus:ring-orange-500 bg-gray-700 border-gray-600 rounded w-4 h-4" />
                                <span class="ms-2 text-xs font-bold text-gray-500 group-hover:text-gray-300 transition-colors">Recordarme</span>
                            </label>
                            
                            <Link
                                v-if="canResetPassword"
                                :href="route('password.request')"
                                class="text-xs text-orange-500 hover:text-orange-400 font-bold uppercase tracking-wide transition underline decoration-transparent hover:decoration-orange-400"
                            >
                                ¿Olvidaste la clave?
                            </Link>
                        </div>

                        <div class="pt-2">
                            <PrimaryButton
                                class="w-full justify-center py-4 bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-500 hover:to-red-500 border-none rounded-xl text-white font-black uppercase tracking-widest shadow-lg shadow-orange-500/20 transition-all transform hover:scale-[1.02] active:scale-95"
                                :class="{ 'opacity-50 cursor-not-allowed': form.processing }"
                                :disabled="form.processing"
                            >
                                <span v-if="form.processing">Ingresando...</span>
                                <span v-else>Iniciar Sesión</span>
                            </PrimaryButton>
                        </div>
                    </form>

                    <div class="mt-8 pt-6 border-t border-gray-700 text-center">
                        <p class="text-gray-500 text-xs mb-2">¿Eres nuevo en Summit Park?</p>
                        <Link :href="route('register')" class="text-white hover:text-orange-400 font-bold text-sm uppercase tracking-wide transition">
                            Crear una Cuenta
                        </Link>
                    </div>

                </div>

            </div>
            
            <p class="text-gray-600 text-[10px] mt-6 z-10 font-mono tracking-wider">© 2026 Summit Trampoline Park. Sistema Seguro.</p>
        </div>
    </GuestLayout>
</template>