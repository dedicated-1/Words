
<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from       '@/Components/PrimaryButton.vue';
import TextInput from           '@/Components/TextInput.vue';
import { Head,router,useForm,usePage } from '@inertiajs/vue3';
import { onMounted,ref } from 'vue';
import { Word, Category } from '@/types/myTypes'
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

const props = defineProps<{
    panel: any,
    task: String,
    category: Category[],
}>()


/**
 * TO DO: type this in myTypes
 */
const languages:any = usePage().props.languages

const form = useForm({
  id:              props.panel?.id              || null,
  main:            props.panel?.main            || 'Greek',
  english:         props.panel?.english         || '',
  hebrew:          props.panel?.hebrew          || '',
  japanese:        props.panel?.japanese        || '',
  german:          props.panel?.german          || '',
  greek:           props.panel?.greek           || '',
  spanish:         props.panel?.spanish         || '',

  category:                                        '',
  new_category:                                    '',
//   type:            props.word?.type            || '',
//   extra:           props.word?.extra           || '', 

})


let message = ref('')
const sub = () => {

    if (props.task === 'create') {
        form.post(route('panels.store'), {
            //preserveScroll: true,
            onSuccess: (response:any) => {
                form.reset()
                message.value = response.props.flash.message
                setTimeout(() => message.value='',2000)
                
            }
        })
    } else if (props.task === 'edit') 
        form.put(route('panels.update', form.id?.toString()))
    
}

//@update:content="update($event)"
</script>

<template>
    <Head title="Panel Create" />

    <AuthenticatedLayout>
        <template #header>
                <span class="text-sky-400"> {{ message }}</span>
        </template>

        <form @submit.prevent="sub"  class="bg-gray-800 p-4 rounded-md ml-[-20px]">


            <select v-model="form.main" class="focus:outline-none p-4 mb-4 text-5xl min-w-full bg-black text-gray-700 border-0">
                <option v-for="lang in languages" :key="lang" :value="lang.value">{{ lang.value }}</option>
            </select>
            

            <QuillEditor theme="snow" toolbar="full" contentType="html" v-model:content="form.greek"    placeholder="greek"      class="p-4 mb-4 text-5xl min-w-full bg-black" spellcheck="false" />
            <QuillEditor theme="snow" contentType="html" v-model:content="form.hebrew"   placeholder="hebrew"     class="p-4 mb-4 text-5xl min-w-full bg-black" spellcheck="false" />
            <QuillEditor theme="snow" contentType="html" v-model:content="form.german"   placeholder="german"     class="p-4 mb-4 text-5xl min-w-full bg-black" spellcheck="false" />
            <QuillEditor theme="snow" contentType="html" v-model:content="form.japanese" placeholder="japanese"   class="p-4 mb-4 text-5xl min-w-full bg-black" spellcheck="false" />
            <QuillEditor theme="snow" contentType="html" v-model:content="form.spanish"  placeholder="spanish"    class="p-4 mb-4 text-5xl min-w-full bg-black" spellcheck="false" />
            <QuillEditor theme="snow" toolbar="full" contentType="html" v-model:content="form.english"  placeholder="english"    class="p-4 mb-4 text-5xl min-w-full bg-black" spellcheck="false" />


            <select v-model="form.category" class="focus:outline-none p-4 mb-4 text-5xl min-w-full bg-black text-gray-700 border-0">
                <option v-for="cat in category" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
            </select>

            <input placeholder="new category" v-model="form.new_category" class="focus:outline-none p-4 mb-4 text-5xl min-w-full bg-black text-gray-700 border-0"/>

            <PrimaryButton :disabled="form.processing">submit</PrimaryButton>
        </form>
        
    </AuthenticatedLayout>
</template>



<style>

</style>


<style>
.ql-toolbar.ql-snow + .ql-container.ql-snow {
    border-top-color: initial;
    zoom: 2 !important;
    margin-bottom: 10px !important;
    background-color: #101010 !important;
}
</style>