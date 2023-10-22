<script setup lang="ts">
import { ref, h, computed, onMounted } from 'vue'
import { Word, Sentence }              from '@/types/myTypes'
import { computePosition }             from '@floating-ui/dom';


const props = defineProps<{ 
    word:Word,
    modelValue:string,
}>()
const emit = defineEmits(['update:modelValue'])
let active = computed({
    get(){
        return props.modelValue
    },
    set(active){
        emit('update:modelValue', active )
    }
})


onMounted(() => {


})
</script>


<template>


        <div class="tooltip"      
        
                :id="`${word.pivot.sentence_id}${word.pivot.word_id}_tooltip`"
                v-show="     active == `${word.pivot.sentence_id}${word.pivot.word_id}`"
                @mouseover=" active =  `${word.pivot.sentence_id}${word.pivot.word_id}`"
                @mouseout="  active =  '0'"
        >

                <!-- <div class="arrow" :id="`${word.pivot.sentence_id}${word.pivot.word_id}_arrow`"></div> -->

                <div class="py-4">
                    <div class="word_inside_tooltip word_inside_tooltip_main"> {{ word.word }}</div>
                    <div v-if="word.english"  class="word_inside_tooltip">{{ word.english }}</div>
                    <div v-if="word.hebrew"   class="word_inside_tooltip">{{ word.hebrew }}</div>
                    <div v-if="word.spanish"  class="word_inside_tooltip">{{ word.spanish }}</div>
                    <div v-if="word.japanese" class="word_inside_tooltip">{{ word.japanese }}</div>
                </div>
            
        </div>
    

</template>



<style scoped>
.word_inside_tooltip_main {
    font-size:70px;
    font-family:Yid;
    color:red;
}
.word_inside_tooltip {
    border-bottom:1px solid rgb(85, 80, 80);
    padding: 10px 20px;
    color:rgb(9, 224, 224);
    max-width:500px;
}
.word_inside_tooltip:last-of-type {
    border-bottom:0;
    padding: 10px 20px 0 20px;
}
.word_inside_tooltip:first-of-type {
    padding: 0px 20px 10px 20px;
}
.tooltip {

  border: 1px solid rgb(45, 48, 53);
  background-color:rgb(31, 31, 31);
  border-radius: 25px;

  z-index:9999;

  padding:0px 0;
  font-size:30px;
  text-align:left;

  top: 0;
  left: 0;

  width: max-content;
  position: absolute;

/* 
  box-shadow: 0 0 0 2em #F4AAB9,
              0 0 0 4em #66CCFF; */



              
  /* margin-top:-10px; */



}

.arrow {
  position: absolute;
  background: #222;
  width: 35px;
  height: 35px;
  transform: rotate(45deg);
}

</style>