<script setup lang="ts">
import { Category } from '@/types/myTypes'
import draggable from 'vuedraggable'
import { computed } from 'vue';
import { onMounted, ref } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps<{
    cats: Category[]
}>()


let sortedCats = computed(()=>{
    return props.cats.sort((a:Category,b:Category)=>a.order-b.order)
})

// onMounted(()=>{
//     console.log(sortedCats.value)
// })

let ordered = ref(props.cats.map(a=>a)) //create copy
let enabled = ref(true)
let dragging = ref(false)

let catForm = useForm({
    cats: [],
})

let save = () => {
    catForm.transform((data)=>({
        cats: ordered.value.map(cat=>cat.id),
    }))
    .post(route("category.order"))
}

</script>


<template>

    <draggable 
        :list="ordered"
        item-key="id"
        class="list-group"
        ghost-class="ghost"
        @start="dragging = true"
        @end="dragging = false"

        >

        <template #item="{ element }">
          <div class="list-group-item" :class="{ 'not-draggable': !enabled }">
            -{{ element.name }}
          </div>
        </template>

    </draggable>
    <PrimaryButton class="mt-4" @click="save">save</PrimaryButton>


 


</template>

<style scoped>
.list-group-item {
    cursor: pointer;
    font-size:20px;
}
.list-group-item:hover {
    color:blanchedalmond;
}

</style>

<!--


                <table class="w-100">
                <tbody>
                    <tr v-for="cat in sortedCats" :key="cat.id" class="flex w-100 justify-between">
                        <td class=" w-1/2 text-base">
                            {{cat.name}}
                        </td>

                        <td class="opacity-25">
                            <button @click=""><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 32 32" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg></button>
                        </td>
                    </tr>
                </tbody>
                </table>

-->