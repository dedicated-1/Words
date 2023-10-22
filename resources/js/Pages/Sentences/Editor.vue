<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from       '@/Components/PrimaryButton.vue';
import SecondaryButton from     '@/Components/SecondaryButton.vue';
import TextInput from           '@/Components/TextInput.vue';
import { Head,router,useForm,usePage } from '@inertiajs/vue3';
import { onMounted,ref } from 'vue';
import { Sentence, Word, Category } from '@/types/myTypes'
import { computed } from 'vue';
//@update:content="update($event)"
const props = defineProps<{
    task: String,
    sentence?: Sentence,
    words?: Word[],
    category?: Category[],
}>()



const form = useForm({
    id:              props.sentence?.id || null,

    sentence:        props.sentence?.sentence || '',
    pronounciation:  props.sentence?.pronounciation || '',
    language:        props.sentence?.language || 'Hebrew', //default: 'hebrew'
    
    //definitions?
    hebrew:          props.sentence?.hebrew || '',
    english:         props.sentence?.english || '',
    japanese:        props.sentence?.japanese || '',
    german:          props.sentence?.german          || '',
    greek:           props.sentence?.greek           || '',
    spanish:         props.sentence?.spanish || '',

    type:            props.sentence?.type || '',
    extra:           props.sentence?.extra || '',

    category:        props.sentence?.category || 0,

})
let message = ref('')
const sub = () => {
    if (props.task === 'create') {
        form.post(route('sentences.store'), {
            //preserveScroll: true,
            onSuccess: (response:any) => {
                form.reset()
                message.value = response.props.flash.message
                setTimeout(() => message.value='',2000)
                
            }
        })
    } else if (props.task === 'edit') 
        form.put(route('sentences.update', form.id?.toString()))
    
}


const deleteTooltip = (id:string) => {

}




//let active_words = ref<Word[] | null>(props.words || null)

//active_words.word.pivot.tooltip
let active_words = props.words || []
let tooltips = ref(new Map)
let clips = ref(new Map)

//add-tooltips-to-sentence
let tooltip_form = useForm({
    sentence: props.sentence?.id || 0,
    map: "",
    clips: ""

})

//load up the maps on startup
active_words.forEach(word => tooltips.value.set(word.id,word.pivot.tooltip))
active_words.forEach(word => clips.value.set(word.id,word.pivot.clip))

const addTooltips = () => {
    tooltip_form.map = Array.from(tooltips.value.entries()).toString()
    tooltip_form.clips = Array.from(clips.value.entries()).toString()
    tooltip_form.post(route('add-tooltips-to-sentence', tooltip_form.sentence), {
        onSuccess: (response:any) => {
            //tooltip_form.reset()
            message.value = 'tooltip added' //response.props.flash.message
            setTimeout(() => message.value='',2000)
            console.log(response)
        }
    })

}
const addTooltipToMap = (e:any) => {
    //update active_words because :value="" is doing two-way data binding
    active_words.filter(word=>word.id==e.target.id)[0].pivot.tooltip = e.target.value
    tooltips.value.set(e.target.id, e.target.value)
}

const addClipToMap = (e:any) => {
    active_words.filter(word=>word.id==e.target.id)[0].pivot.clip = e.target.value
    clips.value.set(e.target.id, e.target.value)
}
//(e:any)=>tooltips.set(word.id.toString(), e.target.value)
const languages:any = usePage().props.languages
// const category:any = usePage().props.category
</script>

<template>
    <Head title="Words Create" />

    <AuthenticatedLayout>
        <template #header>
            <span class="font-semibold text-xl text-gray-900 dark:text-gray-500">
                Home / Sentences / editng {id} </span>
                <span class="text-sky-400"> {{ message }}</span>
        </template>

        <form @submit.prevent="sub" class="bg-gray-800 p-4 rounded-md ml-[-20px]">
            <textarea v-model="form.sentence"            class="p-4 mb-4 text-5xl min-w-full bg-black border-0" placeholder="sentence"></textarea><br>
                
                <!--
                    <AddTooltips /> 
                -->

                <div v-if="words?.length"  class="">
                    <!-- {{ tooltips }}{{ clips }} -->
                    <ul>
                        <li v-for="word in active_words" :key="word.id">
                            
                            <input class="bg-black p-2 focus:outline-none tooltipinput" 
                            :id="word.id.toString()" 
                            :value="word.pivot.clip" 
                            @input="addClipToMap"
                            >

                            <input class="bg-black p-2 focus:outline-none tooltipinput" 
                            :id="word.id.toString()" 
                            :value="word.pivot.tooltip" 
                            @input="addTooltipToMap"
                            >

                            <!-- add a check to this -->
                            <button @click="deleteTooltip(word.id.toString())" class="ml-4 text-4xl" >{{ word.word }}</button>
            
                        </li>
                    </ul>
                    <SecondaryButton @click="addTooltips" class="mt-4">ADD TOOLTIPS</SecondaryButton><br><br>
                </div>
        

            <TextInput v-model="form.pronounciation"      class=" focus:outline-none  p-4 mb-4 text-5xl min-w-full" placeholder="pronounciation"/><br>
            
            <select v-model="form.language" class="focus:outline-none p-4 mb-4 text-5xl min-w-full bg-black text-gray-700 border-0">
                <option v-for="lang in languages" :key="lang" :value="lang.value">{{ lang.value }}</option>
            
            </select>
            <TextInput v-model="form.hebrew"   placeholder="hebrew"     class="focus:outline-none p-4 mb-4 text-5xl min-w-full bg-black" />
            <TextInput v-model="form.english"  placeholder="english"    class="focus:outline-none p-4 mb-4 text-5xl min-w-full bg-black" />
            <TextInput v-model="form.japanese" placeholder="japanese"   class="focus:outline-none p-4 mb-4 text-5xl min-w-full bg-black" />
            <TextInput v-model="form.greek"    placeholder="greek"      class="p-4 mb-4 text-5xl min-w-full bg-black" spellcheck="false" />
            <TextInput v-model="form.german"   placeholder="german"     class="p-4 mb-4 text-5xl min-w-full bg-black" spellcheck="false" />
            <TextInput v-model="form.spanish"  placeholder="spanish"    class="focus:outline-none p-4 mb-4 text-5xl min-w-full bg-black" />
            
            <select v-model="form.category" class="focus:outline-none p-4 mb-4 text-5xl min-w-full bg-black text-gray-700 border-0">
                <option v-for="cat in category" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
            </select>

            <PrimaryButton :disabled="form.processing">submit</PrimaryButton>
        </form>


        
    </AuthenticatedLayout>
</template>



<style>
.tooltipinput {
    width:130px;
    height:35px;
    padding:0 10px;
    background-color:rgb(43, 52, 226);
    margin-right:15px;
}
</style>



<!--
<select v-model="form.type" class=" text-zinc-600 border-none w-1/2 p-4 mb-4 text-5xl bg-black">
    <option value="noun">noun</option>
    <option value="verb">verb</option>
    <option value="adjective">adjective</option>
</select>
-->