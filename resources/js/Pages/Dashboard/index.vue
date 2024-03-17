<template>
    <div>
        
        <AppLayout>
            <template #header>
                <div class="mt-20">
                    <h1 class="text-4xl font-semibold leading-tight text-center text-gray-800">
                    Dashboard
                    </h1>
                    <p class="mt-5 text-lg text-center">
                        Welcome to my task eb crud!
                    </p>
                </div>
                
            </template>
        </AppLayout>
        

    </div>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
export default {    
    components: {
        AppLayout
    },      

}
</script>

<style lang="scss" scoped>

</style>