<template>
  <div class="jumbotron-container">
    <div class="left-jumbo d-flex justify-content-center align-items-center">
      <div>Descrizione jumbotron</div>
    </div>
    <div class="right-jumbo d-flex justify-content-center align-items-center">
      <div class="sign-in">
        <h3>Sei un dottore?</h3>
        <a href="/register"><button class="btn btn-primary">REGISTRATI</button></a>
        <a href="/login"><button class="btn btn-primary">LOGIN</button></a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name:'Jumbotron'
}
</script>

<style lang='scss' scoped>
  .jumbotron-container{
    width: 100%;
    margin-bottom: 25px;
    height: 500px;
    background-color: green;
    .left-jumbo{
      background-color: red;
      float: left;
      width: 50%;
      height: 100%;
    }
    .right-jumbo{
      float: left;
      background-color: yellow;
      width: 50%;
      height: 100%;
      }
      .sign-in{
        background-color: white;
        padding: 20px;
        border-radius: 10px;
      }
  }

</style>