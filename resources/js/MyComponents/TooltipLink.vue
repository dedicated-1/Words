<script setup lang="ts">
import { onMounted,ref,watch } from 'vue';
import { Sentence, Word } from '@/types/myTypes'
import { computed } from 'vue';
import { onBeforeMount } from 'vue';
import { onUpdated } from 'vue';
import BlockForTooltip from '@/MyComponents/BlockForTooltip.vue';
//@update:content="update($event)"
const props = defineProps<{
    sentence: Sentence,
    display: String,
}>()
// const emit = defineEmits(['update:modelValue'])
// let active = computed({
//     get(){ return props.modelValue },
//     set(active){ emit('update:modelValue', active ) }
// })
// onBeforeMount(() => console.log('onBeforeMount'))
// onUpdated(() => console.log('onUpdated'))
let active = ref(false)

// let tooltip = ref(null)
// watch(active, ()=>{
//     if (active.value == true){

//         document.getElementsByTagName('main')[0].style.opacity = '.2';
//     }
// })
// watch(active, ()=>{
//     if (active.value == false){

//         document.getElementsByTagName('main')[0].style.opacity = '1';
//         //if (tooltip.value) tooltip.value.style.opacity = '1'
//     }
// })

// console.log('sentence is:', props.sentence[props.display])
const getDisplay = () => {

    // let s = props.sentence[]
}








</script>

<template>


    <!-- {{ modelValue }} -->
    <div @mouseover="active=!active"
         @mouseout ="active=!active" 
         class="inline-block pr-4 mt-0 shadow-2xl">

                        <!-- (Link Button) to be clicked-->
                        <div class="text-2xl 
                        w-fit 
                        py-2 px-4 mb-3 
                        rounded-md cursor-pointer 
                        border
                        border-gray-800
                        bg-slate-900" 
                            :class="{ 'tooltip-button-hover':active }" 
                            v-html="sentence[display]" />



                        <!-- The Tooltip that appears when Link Button is hovered border border-gray-400 rounded-tr-lg rounded-tr-md-->
                        <div v-show="active" ref="tooltip" class="
                            w-fit absolute z-100 
                            pb-4
                            shadow-2xl 
                            rounded-md 
                            p-1 
                            border-4
                            border-gray-800
                            bg-slate-900
                            text-white">

                                            <div class=" 
                                                px-4 py-4 
                                                
                                                rounded-sm 
                                                pr-16 mb-2
                                                text-teal-400  
                                                text-4xl 
                                                z-100
                                                border-b border-zinc-800"
                                                v-html="sentence.hebrew" 
                                            />
                                        
                                            <BlockForTooltip :text="sentence.japanese"  lang="ja" />
                                            <BlockForTooltip :text="sentence.hebrew"    lang="he" />
                                            <BlockForTooltip :text="sentence.german"    lang="de" />
                                            <BlockForTooltip :text="sentence.spanish"   lang="es" />
                                            <BlockForTooltip :text="sentence.greek"     lang="gr" />
                                            <BlockForTooltip :text="sentence.english"   lang="en" />

                            

                        </div>

    </div>
</template>

<style scoped>



.tooltip-button-hover {
    border-radius: 5px;
    /* box-shadow: 3px -12px 10px 0px rgb(114 79 122 / 20%); */
    /* border-bottom:0; */
    /* margin-bottom:20px; */
}











</style>