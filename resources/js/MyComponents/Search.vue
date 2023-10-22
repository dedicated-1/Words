<script setup lang="ts">
import { onMounted, ref, computed } from 'vue';
import TextInput                    from '@/Components/TextInput.vue';
import SecondaryButton              from '@/Components/SecondaryButton.vue';
import { router, usePage }          from '@inertiajs/vue3';
import { Word, Sentence }           from '@/types/myTypes'
import { fetchHeaders }             from '@/MyComposables/fetchHeaders'

import axios from 'axios';
//defineExpose({ focus: () => input.value.focus() });
//this is for the checked=ref([]) outside of this component
let csrf:any = usePage().props.csrf
let results = ref([])
let emit = defineEmits(['update:modelValue'])
let props = defineProps<{
    modelValue:Number[],
    //type:string,
}>()
let searchterm = ref('')
let checked = computed({
    get() {
        return props.modelValue
    },
    set(value) {
      emit('update:modelValue', value)
    }
})

// let words = ref<Word[] | null>(props.words)

let paginator:any = ref(null)
let words = ref<Word[] | null>(null)

const search = () => {
    axios.get(route(''))
}

const paginate = async (direction?: String) => {

    let theroute = route('paginated-words-for-search')
    if (direction=='next') theroute = paginator.value.next_page_url
    if (direction=='back') theroute = paginator.value.prev_page_url
    let response = await fetch(theroute, fetchHeaders(csrf))
    //body: JSON.stringify({search:e.target.value }),
    paginator.value = await response.json()
    words.value = paginator.value?.data
    //console.log(paginator.value)
}

paginate()

</script>

<template>
    <div>
        <TextInput 
            v-model="searchterm"
            @change="search" 
                class="p-4 text-2xl mr-4 mb-4 w-full" 
                placeholder="Search"/>
        
    </div>  

    <table class="block mt-2" v-if="words">
        <tbody>

            <tr v-for="word in words"                                                   :key="word.id" class="drag pt-2 text-2xl" >
                <td><input type="checkbox" 
                    :value="word.id" class="mr-2 mb-2 bg-slate-800 rounded-sm p-4"
                    v-model="checked" />  
                    {{ word.word }}
                </td>
            </tr>
        </tbody>
    </table>
    
    <template v-if="paginator">
        <SecondaryButton 
            v-if="paginator.current_page > 1"
            @click="paginate('back')" class="mr-1">BACK</SecondaryButton>
        
        <SecondaryButton 
            v-if="paginator.current_page !== paginator.last_page"
            @click="paginate('next')">NEXT</SecondaryButton>
    </template>

</template>



<style scoped>
.pagination-link {
    padding:5px;
    border-radius: 5px;
}
tr {
    margin-bottom:2px;
    border-bottom:0;
}

</style>
