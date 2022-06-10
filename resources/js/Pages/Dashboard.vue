<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeInput from '@/Components/Input.vue';
import Button from '@/Components/Button.vue';
import { Head } from '@inertiajs/inertia-vue3';
import {ref, onMounted } from 'vue'

const count2 = ref(0)
const resaltar = ref(false)

function increment2() {
    count2.value++
}

onMounted(() => {
    console.log(`The initial count is ${count2.value} y resalta = ${resaltar.value}`)
})
</script>
<script>
export default {
    
    data() {
        return {
            count: 0,
            resaltado: 'resaltar',
            texto: '',
            asombroso: true,
            listPokemons: null,
        }
    },

    methods: {
        increment() {
            this.count++
        },

        decrement() {
            this.count > 0 && this.count--            
        },

        onInput(e) {
            
            this.texto = e.target.value
        },
        
        toggle() {
            
            this.asombroso = !this.asombroso
        },
        
        async getPokemons() {
            this.listPokemons = null
            const res = await fetch(
                `https://pokeapi.co/api/v2/pokemon?limit=151&offset=0`
            )

            this.listPokemons = await res.json()
        },
    },


    mounted(){
        console.log(`The initial count is ${this.count}`)
        this.getPokemons()
    }

    
}
</script>
<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard - vue
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        You're logged in!
                        <Button class="btn btn-success" @click="decrement">Down count</Button>
                        {{ count }}
                        <Button class="btn btn-success" @click="increment">Up count</Button>
                    </div>
                    <div class="p-6 bg-white border-b border-gray-200">
                        <Button class="btn btn-success" @click="increment2">Up count</Button>
                        {{ count2 }}
                    </div>
                    <div class="p-6 bg-white border-b border-gray-200">
                        <Button :class="resaltar && resaltado" @click="resaltar = !resaltar">Up count</Button>
                        {{ resaltar }}
                    </div>
                    <div class="p-6 bg-white border-b border-gray-200">
                        
                        <BreezeInput id="text" type="text" class="mt-1 block w-full" v-model="texto" required autofocus autocomplete="text" />
                        {{ texto }}
                        <BreezeInput id="text2" type="text" class="mt-1 block w-full" :value="texto" @input="onInput" autocomplete="text" />
                    </div>
                    <div class="p-6 bg-white border-b border-gray-200">
                        <Button @click="toggle">
                         {{ asombroso ? "Desasombrar" :  "Asombrar" }}
                        </Button>
                        <h1 v-if="asombroso">Asombroso</h1>
                        <h1 v-else>Oh no 😢</h1>
                    </div>
                    
                    <div class="p-6 bg-white border-b border-gray-200">
                        <p v-if="!listPokemons">...cargando</p>
                        <pre v-else>{{ listPokemons }}</pre>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<style scoped>

.resaltar {
    color: red;
}
</style>
