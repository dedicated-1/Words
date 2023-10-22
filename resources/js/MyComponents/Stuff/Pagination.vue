<script setup lang="ts">
import { Head,router,useForm,Link,usePage } from '@inertiajs/vue3';

const props = defineProps<{
    paginator:any,
}>()

console.log('in paginator')
console.log(props.paginator.links.length)
</script>

<template>
    <div v-if="paginator.meta.links.length > 2">
        
        <div class="flex flex-wrap mb-1 mt-4">

        <template v-for="(link, key) in paginator.meta.links">

            <div v-if="link.url === null" 
                :key="key" class="paginator-link" v-html="link.label" 
            />
            
                
            <Link v-else 
                :key="`link-${key}`"        
                 class="paginator-link" 
                :class="{ 'bg-lime-800': link.active }" 
                :href="link.url" 
                v-html="link.label" preserve-scroll
            />
        </template>

        
        </div>
    </div>
</template>


<style scoped>
.paginator-link {
    padding:5px 15px;
    border:1px solid #404040;
    margin: 0 5px;
    border-radius: 5px;
}
table {
    width:100%;
}
tr {
    width:100%;
    border-bottom:1px solid #404040;
}
td {
    
    padding:10px;
}
</style>