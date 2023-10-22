<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head,router,useForm,Link,usePage } from '@inertiajs/vue3';
import { reactive,ref,onMounted }           from 'vue'
import SecondaryButton                      from '@/Components/SecondaryButton.vue';
import Search                               from '@/MyComponents/Search.vue';
import { Category } from '@/types/myTypes'
import Pagination from '@/MyComponents/Stuff/Pagination.vue'
import DndList from '@/MyComponents/DragDrop/DndList.vue'

import SortableCategory from './SortableCategory.vue';
const props = defineProps<{ 
    cats: Category[],
}>()

let message = ref('')
const del = (id:number) => {
    useForm({})
        .delete(route('category.destroy', id.toString()), {
            preserveScroll:true,
            onSuccess: (response:any) => {
                message.value = response.props.flash.message
                setTimeout(() => message.value='', 2000)
                //sentences.value = response.props.paginator.data
        }
    })
}
const form = useForm({
    name: "",
})
const sub = () => {
    form.post(route('category.store'), {
        //preserveScroll: true,
        onSuccess: (response:any) => {
            form.reset()
            message.value = response.props.flash.message
            setTimeout(() => message.value='',2000)
            
        }
    })
}

const sorted = ref<Category[] | null>(props.cats)

const listData = ref<string[]>([])

const onUpdateListData = (value?: string[]) => {
    if (!value) return
    listData.value = value
}

</script>



<template>
    <Head title="Categories" />
    <AuthenticatedLayout>
        <template #header>
                <span class="text-sky-400"> {{ message }}</span>
        </template>



        <div class="flex">




            <div class="mt-8 w-1/2">

                <!-- <DndList 

                    :cats="sorted"

                    :input="listData" 

                    @update:list="onUpdateListData" />-->


                <SortableCategory :cats="cats"/> 




                <!-- <Pagination :paginator="paginator" /> -->
                
            </div>



            <div class="w-1/2 text-right bg-slate-800 h-fit p-4 ml-8 pl-8 rounded-lg mt-8">

                create new category<br>
                <input type="text" class="bg-slate-900 rounded-sm p-1 mb-2"><br>
                <SecondaryButton :disabled="form.processing">submit</SecondaryButton>
            </div>

        </div>







    </AuthenticatedLayout>
</template>

<style scoped>
tr,td {
    border:0;
}
.paginator-link {
    padding:5px 15px;
    /* border:1px solid #404040; */
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