{{ posts.map(post => post.name).join(', ') }}
 const currentDate = ref(new Date());
    const maxDate = computed(() => {
      const date = currentDate.value;
      const year = date.getFullYear();
      const month = ('0' + (date.getMonth() + 1)).slice(-2);
      const day = ('0' + date.getDate()).slice(-2);
      return `${year}-${month}-${day}`;
    });
