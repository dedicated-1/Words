<script setup lang="ts">
import { ref, h, computed, onMounted } from 'vue'
import { Word, Sentence }              from '@/types/myTypes'
import Tooltip                         from '@/MyComponents/Tooltip.vue'

import { computePosition,flip,shift,arrow }             from '@floating-ui/dom';



const props = defineProps<{ 
    sentence: Sentence,
}>()

let active = ref('0')

//raw words of sentence
const words = computed(()=>props.sentence.sentence.split(' ')) //contain words only

//the target string to apply a tooltip
const tooltips = new Map
    props.sentence.words.forEach(
        word => tooltips.set(word.pivot.tooltip, word.id))

const pivots = computed(()=>props.sentence.words.map(word=>word.pivot))


let word_ref = ref()

const showTooltip = (e:any, activate:string) => {

    const button = e.target
    const tooltip:any = document.getElementById(`${e.target.id}_tooltip`);
    const arrowElement:any = document.getElementById(`${e.target.id}_arrow`)
    computePosition(button, tooltip, {
        placement: 'bottom',
        middleware: [flip(),arrow({element: arrowElement}),],//shift()
        }).then(({x, y, placement, middlewareData}) => {
            Object.assign(tooltip.style, {
                left: `${x}px`,
                top: `${y}px`,
            })
        })
    active.value = activate

}


const render = (word:any) => {

    if (tooltips.has(word.word)){

            let activate = props.sentence.id.toString() + tooltips.get(word.word)
            let clip = pivots.value.find(pivot=>pivot.tooltip==word.word)?.clip
            
            if (clip){
                let left = word.word.split('')
                let right = left.splice(0,clip)

                return [ h('span',  { class:'normal_word'}, right.join('')),
                
                         h('span', 
                                    { 
                                        /**
                                         * if the same word appears twice..the id...
                                         */
                                        onmouseenter:(e:any)=> showTooltip(e, activate), 
                                        onmouseout:  ()=> active.value = '0',
                                        id:`${props.sentence.id}${tooltips.get(word.word)}`,
                                        class: 'sentence_word_with_tooltip',
                                        style: { cursor: 'pointer' },
                                    }, 

                                    left.join(''))   
                        ]
            } else {

                /**
                 * The entire word is underlined
                 */
                return h('span', 
                                { 
                                    onmouseenter:(e:any)=> showTooltip(e, activate), 
                                    onmouseout:  ()=> active.value = '0',
                                    id:`${props.sentence.id}${tooltips.get(word.word)}`,
                                    class: 'sentence_word_with_tooltip',
                                    style: { cursor: 'pointer' },
                                },   
                                word.word)


            }
            


    } else {
        return h('span', { class:'normal_word'}, word.word)
    }
    
}

</script>







<template>

    <!--&alefsym;-->
    <div class="sentence_border">

            <!-- {{ sentence.id }} -->
            <div class="sentence_box">
                <template v-for="word in words" :key="word">
                    <render :word="word"/>{{' '}}
                </template>
            </div>

            <template v-for="word in sentence.words" :key="word.id">
                <Tooltip :word="word" v-model="active" />
            </template>
           

    </div>

</template>

<style>
.sentence_border {}

/**

    Hebrew fonts here

*/
.sentence_box {
    text-align:right;
    font-family: TaameyMedium;
    letter-spacing:2px;
    font-size:100px;
    /* font-family: TaameyMedium;
    letter-spacing:-2px;
    font-size:80px; */
    color:rgb(227, 228, 228);
    /* border-bottom: 0 !important;
    border-color:black; */

    letter-spacing:-3px;
    line-height:100px;

    /* border-bottom:1px solid darkslategray; */
    padding: 0 100px 0 0;
    
}

.sentence_word_with_tooltip {
     text-decoration:underline;
    text-decoration-line: underline;
    text-decoration-thickness: 4px;
    text-decoration-color: darkgreen; 

    /* color:lightseagreen */
    color:white;
    stroke: rgb(22, 108, 184);

    


}
.normal_word {
  
}





/* .normal_word, .tooltip_word {
 
} */



</style>


