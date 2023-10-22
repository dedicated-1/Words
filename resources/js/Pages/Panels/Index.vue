<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Pagination from '@/MyComponents/Stuff/Pagination.vue';
import { Head,router,useForm,Link,usePage } from '@inertiajs/vue3';
import { reactive,ref,onMounted } from 'vue'
import { Word } from '@/types/myTypes'

//let csrf = usePage().props.csrf as string

const props = defineProps<{ 
   panels:any,
}>()
// let panels = ref(props.paginator.data)

console.log('panels is: ', props.panels)
const ids = ref([])
let message = ref('')
let pagination_location = {
    pagination_location: window.location.href
}
const del = (id:number) => {
    useForm(pagination_location).delete(route('panels.destroy', id.toString()), {
        preserveScroll:true,
        onSuccess: (response:any) => {
            message.value = response.props.flash.message
            setTimeout(() => message.value='',2000)
            //words.value = props.paginator.data
        }
    })
}


</script>

<template>
    <Head title="Words Index" />
    <AuthenticatedLayout>
        
        <template #header>
            <span class="font-semibold text-xl text-gray-900 dark:text-gray-500">
                should put breadcrumbs here</span>
                <span class="text-sky-400"> {{ message }}</span>
        </template>

        <div class="flex justify-between">
            <Link :href="route('panels.create')">
                <SecondaryButton>
                    ADD PANEL
                </SecondaryButton>
            </Link>
        </div>

        


        <div class="mt-8">
            <table class="w-100">
                <tbody>
                    <tr v-for="panel in panels" :key="panel.id" class="flex w-100 pt-2 pb-2 justify-between">

                    
                        <td class=" w-1/2">
    

                                <Link   :href="route('panels.edit', panel.id.toString())" class="mr-4"
                                        :data="pagination_location"
                                        :id="panel.id">
                                        <span class=" text-4xl mt-1" v-html="panel.greek"></span>


                                        <!-- NEED A WAY TO SHOW 'MAIN' language-->
                                </Link>
                        </td>
                        <td class="opacity-25">

                            <button  @click="del(panel.id)">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 32 32" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                            </button>



                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- <Pagination :paginator="panels" /> -->

        

    </AuthenticatedLayout>
</template>

<style>
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