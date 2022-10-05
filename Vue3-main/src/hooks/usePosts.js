import axios from "axios";
import { onMounted, ref } from "vue";

export function usePosts(limit) {
    const posts = ref([]);
    const isPostsLoading = ref(true);
    const totalPages = ref(0);
    const fetching = async () => {
        try {
            const response = await axios.get('https://jsonplaceholder.typicode.com/posts', {
                params: {
                    _page: 1,
                    _limit: limit
                }
            });
            totalPages.value = Math.ceil(response.headers['x-total-count'] / limit.value);
            posts.value = response.data;
        } catch (e) {
            alert('Ошибка');
        } finally {
            isPostsLoading.value = false;
        }
    }
    onMounted(fetching);
    return {
        posts, isPostsLoading, totalPages
    }
}