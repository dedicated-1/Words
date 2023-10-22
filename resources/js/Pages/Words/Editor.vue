
<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from       '@/Components/PrimaryButton.vue';
import TextInput from           '@/Components/TextInput.vue';
import { Head,router,useForm,usePage } from '@inertiajs/vue3';
import { onMounted,ref } from 'vue';
import { Word } from '@/types/myTypes'

const props = defineProps<{
    task: String,
    word?: Word,
    message?: String,
}>()


/**
 * TO DO: type this in myTypes
 */
const languages:any = usePage().props.languages

const form = useForm({
  id:              props.word?.id              || null,

  word:            props.word?.word            || '',
  searchterm:      props.word?.searchterm      || '',
  pronounciation:  props.word?.pronounciation  || '',

  language:        props.word?.language        || 'Greek',

  english:         props.word?.english         || '',
  hebrew:          props.word?.hebrew          || '',
  japanese:        props.word?.japanese        || '',
  german:          props.word?.german          || '',
  greek:           props.word?.greek           || '',
  spanish:         props.word?.spanish         || '',

  type:            props.word?.type            || '',
  extra:           props.word?.extra           || '', 

})


let message = ref('')
const sub = () => {

    if (props.task === 'create') {
        form.post(route('words.store'), {
            //preserveScroll: true,
            onSuccess: (response:any) => {
                form.reset()
                message.value = response.props.flash.message
                setTimeout(() => message.value='',2000)
                
            }
        })
    } else if (props.task === 'edit') 
        form.put(route('words.update', form.id?.toString()))
    
}


//@update:content="update($event)"
</script>

<template>
    <Head title="Words Create" />

    <AuthenticatedLayout>
        <template #header>
            <span class="font-semibold text-xl text-gray-900 dark:text-gray-500">
                seems we will do everything with inertia? </span>
                <span class="text-sky-400"> {{ message }}</span>
        </template>

        <form @submit.prevent="sub"  class="bg-gray-800 p-4 rounded-md ml-[-20px]">
            <TextInput v-model="form.word"                class="p-4 mb-4 text-5xl min-w-full" placeholder="word"/><br>
            <TextInput v-model="form.searchterm"          class="p-4 mb-4 text-5xl min-w-full"     placeholder="search-term"/><br>
            <TextInput v-model="form.pronounciation"      class="p-4 mb-4 text-5xl min-w-full" placeholder="pronounciation"/><br>
            <br><br>

            <select v-model="form.language" class="focus:outline-none p-4 mb-4 text-5xl min-w-full bg-black text-gray-700 border-0">
                <option v-for="lang in languages" :key="lang" :value="lang.value">{{ lang.value }}</option>
            </select>
            
            <TextInput v-model="form.english"  placeholder="english"    class="p-4 mb-4 text-5xl min-w-full bg-black" spellcheck="false" />
            <TextInput v-model="form.hebrew"   placeholder="hebrew"     class="p-4 mb-4 text-5xl min-w-full bg-black" spellcheck="false" />
            <TextInput v-model="form.japanese" placeholder="japanese"   class="p-4 mb-4 text-5xl min-w-full bg-black" spellcheck="false" />
            <TextInput v-model="form.spanish"  placeholder="spanish"    class="p-4 mb-4 text-5xl min-w-full bg-black" spellcheck="false" />
            <TextInput v-model="form.greek"    placeholder="greek"      class="p-4 mb-4 text-5xl min-w-full bg-black" spellcheck="false" />
            <TextInput v-model="form.german"   placeholder="german"     class="p-4 mb-4 text-5xl min-w-full bg-black" spellcheck="false" />


            <PrimaryButton :disabled="form.processing">submit</PrimaryButton>
        </form>
        
    </AuthenticatedLayout>
</template>



<style>

</style>



<!--
<select v-model="form.type" class=" text-zinc-600 border-none w-1/2 p-4 mb-4 text-5xl bg-black">
    <option value="noun">noun</option>
    <option value="verb">verb</option>
    <option value="adjective">adjective</option>
</select>
-->