<template>
    <div class="full-screen">
        <h1>{{ message }}</h1>
    </div>
</template>

<script>
export default {
    name: "Empty",
    props: {
        message: {
            type: String,
            required: false,
            default: 'No employees exist.'
        }
    }
}
</script>

<style scoped>
.full-screen{
    width: 100vw;
    height: 100vh;
    display:flex;
    justify-content:center;
    align-items: center
}
</style>
