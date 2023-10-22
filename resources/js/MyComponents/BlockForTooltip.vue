<script setup lang="ts">
import { onBeforeMount } from 'vue';
import { onUpdated } from 'vue';
import { computed } from 'vue';

// const emit = defineEmits(['update:checked']);

const props = defineProps<{
    text: String;
    lang: String;
}>();

// const proxyChecked = computed({
//     get() {
//         return props.checked;
//     },

//     set(val) {
//         emit('update:checked', val);
//     },
// });

let maintext = props.text
let sidetext = ""
// console.log(props.text)
onBeforeMount(()=>{

    if (props.text && props.text.includes('|')){
        let a = props.text.split('|')
        maintext = a[0]
        if (a[1]) sidetext = a[1]
        // console.log(a)
}
})
</script>

<template>

        <!-- &#10002;  -->
        <div class="
        
                        pt-4 pl-4
                        border-b border-zinc-700
                        pb-4" 
        
        v-show="text !== null">


            <div class="text-3xl text-white" v-html="maintext" />
            <div class="sidetext text-slate-800" v-show="sidetext"> {{ sidetext }}</div>
        </div>
        
    <!-- </div> -->

</template>

<style scoped>


</style>