<script>
  export default {
    name: 'Loader',
    props: ['isLoading'],
  };
</script>

<template>
    <div class="text-center" v-if="isLoading">
        <h3>Loading...</h3>
        <span class="glyphicon glyphicon-refresh rotating" style="font-size:70px;"></span>
    </div>
</template>

<style scoped>
    .rotating {
        animation: rotation 1.3s infinite linear;
    }
    @keyframes rotation {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(359deg);
        }
    }
</style>