<script setup lang="ts">
import AuthenticatedLayout                  from '@/Layouts/AuthenticatedLayout.vue';import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head,router,useForm,Link,usePage } from '@inertiajs/vue3';
import { reactive,ref,onMounted }           from 'vue'
import { Word, Sentence }                   from '@/types/myTypes'
import SecondaryButton                      from '@/Components/SecondaryButton.vue';
import Search                               from '@/MyComponents/Search.vue';
//let csrf = usePage().props.csrf as string


/**
 * 
 * 1. get csrf in better way
 * 2. word to paginator TS object
 * 
 */
const props = defineProps<{ 
   paginator:any,
}>()
let sentences = ref<Sentence[] | null>(props.paginator.data)
//let words = ref<Word[] | null>(props.word_paginator.data)
let message = ref('')
let pagination_location = {
    pagination_location: window.location.href
}
const del = (id:number) => {
    useForm(pagination_location)
        .delete(route('sentences.destroy', id.toString()), {
            preserveScroll:true,
            onSuccess: (response:any) => {
                message.value = response.props.flash.message
                setTimeout(() => message.value='', 2000)
                sentences.value = response.props.paginator.data
        }
    })
}
//const ids = ref([])
let addWords = useForm({
    words:[],        //ids
    sentence:0,
    pagination_location: window.location.href //ids
})
const setSentence = (id:number) => {
    if (!addWords.sentence) addWords.sentence = id
    else addWords.sentence = 0
}
const addWordsToSentence = () => {
    if (!addWords.sentence)     return
    if (!addWords.words.length) return
    addWords.post(route('add-words-to-sentence', addWords.sentence) , {
        preserveScroll:true,
        onSuccess: (response:any) => {
            message.value = response.props.flash.message
            setTimeout(() => message.value='', 2000)
            //console.log(response)
            sentences.value = response.props.paginator.data
        }
    })
}
const deleteWordFromSentence = (word:number,sentence:number) => {
    useForm(pagination_location)
        .delete(route('delete-word-from-sentence', [word,sentence]), {
            preserveScroll:true,
            onSuccess: (response:any) => {
                message.value = response.props.flash.message
                setTimeout(() => message.value='', 2000)
                //console.log(response)
                sentences.value = response.props.paginator.data
        }
    })
}
</script>

<template>
    <Head title="Words Index" />
    <AuthenticatedLayout>
        <template #header>
            <span class="font-semibold text-xl text-gray-900 dark:text-gray-500">
                try with inertia, see how it goes</span>
                <span class="text-sky-400"> {{ message }}</span>
        </template>

        <!-- {{ addWords.words }}<br>
        {{ addWords.sentence }}<br> -->
        <div class="grid grid-cols-3 gap-4">
            <!-- dark:bg-gray-800 -->

            <div class="col-span-2  rounded-md">
                <div class="ml-2 mb-8 flex justify-between">
                    <Link :href="route('sentences.create')"><SecondaryButton>ADD SENTENCE</SecondaryButton></Link>
                    <SecondaryButton @click="addWordsToSentence" :disabled="addWords.processing">ADD WORDS TO SENTENCE</SecondaryButton>
                </div>

                <table class="">
                    <tbody>
                        <tr v-for="sentence in sentences" :key="sentence.id" class="flex w-100 pt-2 pb-2 justify-between">
                            <td class=" w-1/2">
                                    
                                <div class="flex">
                                        <input  type="checkbox" 
                                                @change="setSentence(sentence.id)" 
                                                :value="sentence.id"
                                                class="mr-4 bg-slate-600 rounded-sm p-4" />

                                        <div>
                                            <Link   :href="route('sentences.edit', sentence.id.toString())" class="mr-4"
                                                    :data="pagination_location"
                                                    :id="sentence.id">
                                                    <span class=" text-4xl mt-1">{{sentence.sentence}}</span>
                                            </Link>
    
                                            <template v-if="sentence.words.length">
                                                <ul class="flex gap-4 pt-4">
                                                    <li v-for="word in sentence.words" :key="word.id" class="flex">
                                                        <button class="bg-blue-800 text-teal-500 px-2 py-0 rounded-sm leading-5 pb-1 border border-slate-600 text-2xl"
                                                            @click="deleteWordFromSentence(word.id,sentence.id)">
                                                            {{word.word}}
                                                        </button>
                                                    </li>
                                                </ul>
                                            </template>
                                        </div>
                                    </div>
                                    <!--
                                        put sentences.word under here
                                    -->


                            </td>
                            <td class="opacity-25">
                                <button  @click="del(sentence.id)"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 32 32" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg></button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div v-if="paginator.links.length > 2">
                    <div class="flex flex-wrap -mb-1 mt-4">
                        <template v-for="(link, key) in paginator.links">
                            <div v-if="link.url === null" 
                                :key="key" class="paginator-link" v-html="link.label" />
                                <Link v-else 
                                    :key="`link-${key}`"        
                                    class="paginator-link" 
                                    :class="{ 'bg-lime-800': link.active }" 
                                    :href="link.url" 
                                    v-html="link.label" preserve-scroll/>
                        </template>
                    </div>
                </div>
            </div>

            <div class="grid-cols-1 pl-12 mt-[-20px]">
                <Search v-model="addWords.words"/>
                
            </div>

        </div>






    </AuthenticatedLayout>
</template>

<style scoped>
.paginator-link {
    padding:5px 15px;
    border:1px solid #404040;
    margin: 0 5px;
    border-radius: 5px;
}
table {
    width:100%;
}
tr {
    width:100%;
    border-bottom:1px solid #404040;
}
td {
    
    padding:10px;
}
</style>

//const axios = require('axios').default;
//:class="{ 'bg-white': link.active }"

/**
async function addInflections(){
    let response = await fetch(route('add-inflections'), {
        method: "POST", 
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrf
        },
        body: JSON.stringify({ids:ids.value,action:action.value}),
    })
    let json = await response.json()
    /**
     * you can change this to use let json = respnonse.json().data
     * no need for slow-ass reload (sentence/edit)
     */
    router.visit(window.location.href, { preserveScroll: true })
}


*/