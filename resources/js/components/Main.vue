<template>
  <main>
    <div class="row">
      <div class="col-12" v-for="post in posts" :key="post.id">
        <ul>
          <li>{{ post.title }}</li>
        </ul>
      </div>
    </div>
  </main>
</template>

<script>
export default {
  name: "Main",
  data() {
    return {
      url: "http://127.0.0.1:8000/api/posts",
      posts: [],
      api_token:
        "bbzRf42NwlCuPIdwL7AiHgXskzLa69GB61Tn8QA7VZ1woSustPL1NfelqeHpfolpwhwX6lR1OolmJf3k",
    };
  },
  created() {
    this.getPosts();
  },
  methods: {
    getPosts() {
      console.log("Chiamata API");

      const bodyParameters = {
        key: "value",
      };

      const config = {
        headers: { Authorization: `Bearer ${this.api_token}` },
      };
      console.log(config);
      axios
        .post(this.url, bodyParameters, config)
        .then((response) => {
          this.posts = response.data.results;
        })
        .catch();
    },
  },
};
</script>