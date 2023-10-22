<script setup lang="ts">
import { Word, Sentence }                   from '@/types/myTypes'
const props = defineProps<{ 
   word:Word
}>()
</script>



<template>
    <span>{{ word.word }}</span>
    

</template>