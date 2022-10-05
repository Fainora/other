<template>
    <form @submit.prevent>
        <my-input
            v-focus
            v-model="post.title"
            type="text" 
            placeholder="Название" />
        <my-input 
            v-model="post.body"
            type="text" 
            placeholder="Описание" />
        <my-button @click="createPost" class="create">Создать</my-button>
    </form>
</template>

<script>
export default {
    data() {
        return {
            post: {
                title: '',
                body: ''
            }
        }
    },
    methods: {
        createPost() {
            this.post.id = Date.now();
            this.$emit('create', this.post);
            this.post = {
                title: '',
                body: ''
            }
        },
    },
    /*
    watch: {
        post: {
            handler(newValue) {
                console.log(newValue)
            },
            deep: true
        }
    }
    */
}
</script>

<style scoped>
form {
    display: flex;
    flex-direction: column;
    width: 100%;
}
</style>