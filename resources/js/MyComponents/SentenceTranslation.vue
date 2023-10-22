<script setup lang="ts">
import { Word, Sentence }              from '@/types/myTypes'

const props = defineProps<{ 
    sentence: Sentence
}>()

</script>

<template>
    <ul class="translation_block">
        <li class="">
            
            
            <span class="jp_translation_text">
                {{ sentence.japanese }}
            </span>
        </li>
        <li>
            
            {{ sentence.english }}
        </li>
        <li>
            {{ sentence.spanish }}
        </li>
    </ul>
</template>

<style>
.jp_translation_text {
    padding-top:5px;
    line-height:40px;
    font-size:36px;
}

.sentence_block{
    margin-bottom:120px;
    display:block;
    border-radius:5px;
    display:flex;

}
.translation_block {
    color:darkolivegreen;
    font-size:26px;
    list-style-type: none;
    list-style-position: outside;
    height:fit-content;
    width:fit-content;
    padding-bottom:0px;
    

}
.translation_block li {
    display:block;

    color:slategray;
    margin-right:20px;
    padding:10px 0px;
    border-bottom:1px solid #404040;
    width:100%;
}
.translation_block li:last-of-type {
    padding-bottom:20px;
    border-bottom:0;
}
.translation_title {
    font-size:18px;
    letter-spacing:2px;
    color:rgb(3, 154, 48);
    padding-right:20px;
    display:none;
 
}
</style>