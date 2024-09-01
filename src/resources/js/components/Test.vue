<template>
    <div>
        <h1>Real-Time {{ notifications }}</h1>

    </div>
</template>

<script>
export default {
    data() {
        return {
            notifications: []
        };
    },
    created() {

    }
};
</script>

<style scoped>
h1 {
    font-size: 24px;
}
</style>
