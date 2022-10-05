<template>
    <button class="btn">
        <slot></slot>
    </button>
</template>

<script>
export default {
    name: 'my-button',
}
</script>

<style scoped>
.btn {
    padding: 10px 15px;
    color: teal;
    background: none;
    border: 1px solid teal;
}
.create {
    margin-top: 15px;
    align-self: flex-end;
}
</style>