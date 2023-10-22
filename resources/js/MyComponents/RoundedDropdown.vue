<script setup lang="ts">
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue'
import { onMounted } from 'vue';

defineProps<{
    text: String,
    // headingText:String,
}>();


let active = ref(false)
   
let button = ref<HTMLElement>()
let dropdown = ref<HTMLElement>()
      
onMounted(()=>{  
    //console.log(button.value?.offsetWidth)
    //let width = button.value?.offsetWidth || '200px'
})
</script>

<template>

    <!-- FLEX and INLINE-BLOCK affect the width, position and MORE of the tooltip
        
         RELATIVE is essential, it seems

         relative, inline-block and margin-bottom - have made this work....
    -->
    <div @mouseover="active=!active"
         @mouseout ="active=!active"

         style="" class="relative inline-block text-left">
        
                <!-- 

                <HeaderButton />

                <HeaderDropdown /> 

                -->

                <div class="header-button-two
                            mt-[20px] 
                            mb-[20px] 
                            cursor-pointer 
                            flex
                            text-slate-100 
                            w-full" 
                            :class="{ 'header-button-hover':active }"
                >
                    <div>
                        {{ text }}
                    </div> 
                    <div style="font-size:20px; margin-left:16px;"> &curarr;</div>
                </div>



                <div
                    v-show="active"
                    class="header-dropdown"
                    style=""
                    >
                        <slot />

                </div>

    </div>


</template>

<style>

.header-button-two {
    --color: rgb(58, 58, 58);
    /* --color: rgb(130, 130, 130);
    background-color:rgb(86, 78, 55); */
    color:whitesmoke;
    box-shadow: 
    0.5px 1px 0 0 var(--color),
    1.5px 2px 0 0 var(--color),
    2.5px 3px 0 0 var(--color),
    3.5px 4px 0 0 var(--color),
    4.5px 5px 0 0 var(--color),
    5.5px 6px 0 0 var(--color);
    transform: rotateX(0) rotateY(0) rotateZ(0);
    outline: 2px dashed transparent;
    border-radius:3px;
    border:1px solid #404040;
    font-size:20px;
    padding:10px 30px;
    
}
.header-button {
    width:100%;
    border:1px solid #404040;
    border-radius:5px;
    padding:10px 20px 5px 20px;
    background-color:#202020;
}
.header-button-hover {
    /* border-radius: 25px 25px 0 0; */
    
    
}
/* .header-dropdown-hover {} */

.header-dropdown {

    position: absolute;
    z-index: 9999;
    margin-top: 0px;
    margin-left: 0px;
    border: 1px solid #404040;
    /* border-top: 0; */
    border-radius: 20px;
    padding: 15px 0px;
    background-color: #202020;
    color: whitesmoke;
    text-align: left;
    width: 100%;
    font-family: Figtree, ui-sans-serif, system-ui !important;
    box-shadow: 5px 5px darkblue darkmagenta;
    
}

.header-dropdown button {
    text-align: left;
    width: 100%;
    border-bottom: 1px solid #303030;
    padding: 5px;
    font-size: 20px;
    padding-left: 20px;
}

</style>