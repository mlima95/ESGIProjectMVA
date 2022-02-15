<template>
  <div class="vue-template">
    <!-- Navigation -->
<!--    <nav class="navbar shadow bg-white rounded justify-content-between flex-nowrap flex-row fixed-top">-->
<!--      <div class="container">-->
<!--        <a class="navbar-brand float-left" href="/">-->
<!--          LazyTube-->
<!--        </a>-->
<!--      </div>-->
<!--    </nav>-->
    <Navbar />
    <!-- Main -->
    <div class="App">
<!--      <div class="vertical-center">-->
<!--        <div class="inner-block">-->
          <router-view />
<!--        </div>-->
<!--      </div>-->
    </div>
  </div>
</template>

<script>
import Navbar from './components/navbar/Navbar.vue';
export default {
  name: 'app',
  components: {
    Navbar
  },
  data () {
    return {
    }
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}

h1, h2 {
  font-weight: normal;
}

ul {
  list-style-type: none;
  padding: 0;
}

li {
  display: inline-block;
  margin: 0 10px;
}

a {
  color: #42b983;
}
</style>
