<script setup lang="ts">
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

// defineProps<{
//    // text: String;
// }>();

//border border-gray-300 
</script>

<template>

<form>   
    <!-- <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label> -->
    <div class="relative" style="margin-top:20px;">
        <!-- mt-20px is to even up with other buttons, mb-20 was needed for dropdown to work-->

        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
        </div>

        <input type="search" id="default-search" 
        class="block w-full pl-10 text-sm text-gray-900 
        
        rounded-full focus:ring-blue-500 focus:border-blue-500 
         dark:text-white dark:focus:ring-blue-500
         dark:focus:border-blue-500" placeholder="Search" 

         style="background-color:#202020; 
         border:0;
         height:45px;" 
         
         required>
        <!-- <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button> -->
    </div>
</form>


</template>