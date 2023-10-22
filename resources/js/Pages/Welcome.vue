<script setup lang="ts">
import { Head, Link, usePage } from '@inertiajs/vue3';
import { reactive,ref, onMounted, onBeforeMount, onUpdated }           from 'vue'
import { Word, Sentence, Category, Panel }                   from '@/types/myTypes'
import SecondaryButton                      from '@/Components/SecondaryButton.vue'
import Checkbox                             from '@/Components/Checkbox.vue'
import SentenceWithTooltips from '@/MyComponents/SentenceWithTooltips.vue'
import SentenceTranslation from '@/MyComponents/SentenceTranslation.vue'
import RoundedDropdown from '@/MyComponents/RoundedDropdown.vue'
import HeaderSearchBar from '@/MyComponents/HeaderSearchBar.vue'
import TooltipLink from '@/MyComponents/TooltipLink.vue'
import ShowPanels from '@/MyComponents/ShowPanels.vue';
const languages:any = usePage().props.languages

const props = defineProps<{ 
   paginator:any,
//    words:Word[],
   category1: Category[],
   panels: Panel[],
}>()

let sentences = ref<Sentence[] | null>(props.paginator.data)

// console.log(props.category1)
onMounted(() => { 
    //tooltip underline
    // let elements:any = document.getElementsByClassName('sentence_word_with_tooltip')
    // for (const element of elements){
    //     if (element) {
    //         //element.style.backgroundImage = "url('../../path.png')";
    //         element.style.backgroundRepeat = "no-repeat";
    //         element.style.backgroundPositionX = "0px";
    //         element.style.backgroundPositionY = "60px";
    //         element.style.backgroundBlendMode = "hard-light";
    //         element.style.color="white";
    //     }
    // }
})
onBeforeMount(() => {
    console.log('Welcome - onBeforeMount')
})
onUpdated(() => {
    console.log('Welcome - onUpdated')
})

let interfaceLanguage = ref('english')
let displayLanguage = ref('greek')

// console.log(props.category1)

</script>

<template>
    <Head title="Welcome"/>
    <header style="padding:0px 5%;" class="flex justify-between items-center">

        <div style="width:500px">
            <h1 style="font-size:50px;font-family: j18;">語力勉強会</h1>
        </div>
        <div class="flex gap-4">
            <!-- <HeaderSearchBar /> -->
            <!-- <RoundedDropdown text="Color Scheme">
                this is the color scheme 
            </RoundedDropdown>-->
            <RoundedDropdown text="Display Language" class="">
                        <button v-for="lang in languages" :key="lang.code"
                            @click="displayLanguage=lang.value.toLowerCase()" 
                            class="header-buttons"
                            style="">
                                {{ lang.value }}
                        </button>
            </RoundedDropdown>


            <RoundedDropdown  text="Interface">
                        <button v-for="lang in languages" :key="lang.code"
                            @click="interfaceLanguage=lang.value" 
                            class="header-buttons"
                            style="">
                                {{ lang.value }}
                        </button>
            </RoundedDropdown>
        </div>

    </header>

    <main class="overflow-hidden greek" style="padding:0 0%; margin:0 5%;">
                                                                    
            <div v-for="cat in category1" :key="cat.id" class="mt-28">
                <h1 class="welcome-titles"><span class="text-red-900">#</span> {{cat.name}}</h1>
                <TooltipLink :sentence="sentence" v-for="sentence in cat.sentences" :key="sentence.id" 
                :display="displayLanguage" /> 
            </div>


    </main>

















<!--<h2>days, weeks, months</h2>-->
<!--HOUSE ICON FOR HOME
<svg id="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
    <path d="M28.76,11.35A1,1,0,0,0,28,11H22V7a3,3,0,0,0-3-3H13a3,3,0,0,0-3,3v4H4a1,1,0,0,0-1,1.15L4.88,24.3a2,2,0,0,0,2,1.7H25.14a2,2,0,0,0,2-1.7L29,12.15A1,1,0,0,0,28.76,11.35ZM12,7a1,1,0,0,1,1-1h6a1,1,0,0,1,1,1v4H12ZM25.14,24H6.86L5.17,13H26.83Z"/><rect id="_Transparent_Rectangle_" data-name="&lt;Transparent Rectangle&gt;" class="cls-1" width="32" height="32"/>
</svg>-->
<div>
</div>
</template>

<style>























h1 {
    margin-left:1%;
}
.welcome-titles {
    font-family:Vet900;
    padding-left:0;
    font-size:40px;
    color:white;
}

/* .Hebrew-font-for-tooltip   { font-family: TaameyMedium; }
.hebrew-font-for-tooltip   { font-family: TaameyMedium; }
.English-font-for-tooltip  { }
.Japanese-font-for-tooltip { }
.Greek-font-for-tooltip    { }
.German-font-for-tooltip   { }
.Spanish-font-for-tooltip  { } */


header {
    height:100px;
    /* border-bottom:1px solid #202020; */
    margin-bottom:20px;
    width:100%;
}
























.yid {
    font-family:Yid;
    font-size:270px;
    line-height:50px;
    position: absolute;
    left:50px;
    top:100px;
    color:rgb(16, 17, 17);
    z-index:-9999;
}



body {
    background-color: black;
    color:aqua;

}

body {
    /* background-image: url("../../beam3.jpg"); */
    /* background-repeat: no-repeat; */
 
}

/* @media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
} */
</style>

