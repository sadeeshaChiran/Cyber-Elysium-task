<template>
    <div>
        <NavBar />
        <slot name="header"/>
    </div>
</template>

<script>
    import NavBar from '@/Components/main/navBar.vue';

    export default {
        components: {
            NavBar
        }
    }


</script>

<style lang="scss" scoped>

</style>