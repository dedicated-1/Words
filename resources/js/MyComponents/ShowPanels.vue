<script setup lang="ts">
import { Head, Link, usePage } from '@inertiajs/vue3';
import { Word, Sentence, Category, Panel }                   from '@/types/myTypes'
import ShowPanelsWithReading from '@/MyComponents/ShowPanelsWithReading.vue'
const props = defineProps<{
    panels: Panel[],
}>()

const languages:any = usePage().props.languages

/**
 * Ordering of panel languages: how?
 */

</script>

<template>
   
    <template v-for="panel,i in panels" :key="i">
        

        <div class="focus">
            <div v-html="panel.greek" />
        </div>

        <!-- <div class="tabs">
            <div class="spanel  p-4 hebrew" v-html="panel.hebrew" />
            <div class="spanel  p-4 hebrew" v-html="panel.japanese" />
            <div class="spanel w-fit p-4 hebrew" v-html="panel.german" />
            <div class="spanel w-fit p-4 hebrew" v-html="panel.spanish" />
            <div class="spanel w-fit p-4 hebrew" v-html="panel.english" />
        </div> -->
    </template>


</template>

<style>
.focus {
    margin-top:150px;
    text-align:center;
    font-size:50px;
    padding:0 140px;
}
.focus p {
    display: inline;
}













.hebrew {
    
}
.spanel {
    border-top:1px solid gray;
}
.spanel p {
    margin-bottom:10px;
    /* background-color:rgb(23, 30, 30);
    border:1px solid rgb(141, 156, 143); */
}
.panel p span {
    display:block;
    font-size:14px;
    height:fit-content;
    height:10px;
    align-items: center;
    line-height:10px;
    padding-bottom:5px;
    margin-bottom:10px;
    background-color: transparent !important;
    font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif

}

</style>