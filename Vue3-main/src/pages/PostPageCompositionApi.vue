<template>
  <div>
    <h1>Страница с постами</h1>
    <my-input
      v-model="searchQuery"
      placeholder="Поиск...."
      v-focus
    />
    <div class="app_btns">
      <my-button
      >
        Создать пользователя
      </my-button>
      <my-select
        v-model="selectedSort"
        :options="sortOptions"
      />
    </div>
    <my-dialog v-model:show="dialogVisible">
      <post-form
      />
    </my-dialog>
    <post-list
      :posts="sortedAndSearchedPosts"
      v-if="!isPostsLoading"
    />
    <div v-else>Идет загрузка...</div>
  </div>
</template>

<script>
import PostForm from '@/components/PostForm';
import PostList from '@/components/PostList';
import axios from 'axios';
import { ref } from 'vue';
import { usePosts } from "@/hooks/usePosts";
import useSortedPosts from "@/hooks/useSortedPosts";
import useSortedAndSearchedPosts from "@/hooks/useSortedAndSearchedPosts";

export default {
    components: {
        PostForm, PostList
    },
    data() {
        return {
            dialogVisible: false,
            sortOptions: [
                {value: 'title', name: 'По названию'},
                {value: 'body', name: 'По содержанию'},
            ],
        }
    },
    setup(props) {
        const {posts, totalPages, isPostsLoading} = usePosts(10);
        const {sortedPosts, selectedSort} = useSortedPosts(posts);
        const {searchQuery, sortedAndSearchedPosts} = useSortedAndSearchedPosts(sortedPosts);
    
        return {
            posts,
            totalPages,
            isPostsLoading,
            sortedPosts,
            selectedSort,
            searchQuery,
            sortedAndSearchedPosts,
        }
    }
}
</script>

<style scoped>
.app_btns {
    display: flex;
    justify-content: space-between;
    margin: 15px 0;
}
.page_wrapper {
    display: flex;
    margin-top: 15px;
}
.page {
    border: 1px solid teal;
    padding: 10px;
    cursor: pointer;
}
.page:hover {
    background-color: rgb(180, 227, 227);
}
.current-page {
    background-color: teal;
    color: white;
}
.observer {
    height: 30px;
    background: green;
}
</style>