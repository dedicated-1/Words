<script setup lang="ts">
import { Head, Link, usePage } from '@inertiajs/vue3';
import { Word, Sentence, Category, Panel }                   from '@/types/myTypes'

const props = defineProps<{
    text: String,
}>()

// const languages:any = usePage().props.languages

/**
 * Ordering of panel languages: how?
 */

console.log(props.text)
</script>

<template>
   
    


</template>