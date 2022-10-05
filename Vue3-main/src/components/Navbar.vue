<template>
    <div class="navbar">
        <div @click="$router.push('/')">Vue 3</div>
        <div class="navbar_btns">
            <my-button @click="$router.push('/posts')">Посты</my-button>
            <my-button @click="$router.push('/about')">О сайте</my-button>
            <my-button @click="$router.push('/store')">Store</my-button>
            <my-button @click="$router.push('/composition')">CompositionAPI</my-button>
        </div>
    </div>
</template>

<script>
    export default {
        
    }
</script>

<style scoped>
.navbar {
    height: 50px;
    background-color: lightgray;
    box-shadow: 2px 2px 4px gray;
    display: flex;
    align-items: center;
    padding: 0 15px;
}
.navbar_btns {
    margin-left: auto;
}
.btn {
    margin-left: 20px;
}
</style>