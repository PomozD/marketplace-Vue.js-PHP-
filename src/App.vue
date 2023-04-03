<template>
  <header>
    <v-menu @search="searchItems"/>
  </header>
  <router-view :searchText="searchText"/>
</template>

<script>
import vMenu from './components/v-menu';

export default {
  name: 'app',

  data() {
    return {
      searchText: '',
    }
  },

  methods: {
    searchItems(data){
      if(data.searchText !== ''){
        this.searchText = data.searchText;
      }

      //console.log(this.searchText);
    }
  },

  components: {
    vMenu
  }
}
</script>

<style>
  body {
    margin: 0;
  }
</style>