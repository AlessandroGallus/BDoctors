<template>
  <div class="jumbotron-container container">
    <div class="left-jumbo">
      <div class="title">
          <h3>
              Solo su bDoctors puoi consultare oltre 109.000 recensioni di pazienti verificati
          </h3>
          <p>
              13 anni di storia, 717.000 pazienti soddisfatti. Le nostre recensioni sono totalmente affidabili, come testimoniato da
          </p>
          <span>
             <img src="https://ciaologo.com/timthumb.php?src=upload/247/1496/0_orig_20150617110608_3ef7b796e3.png&h=250&w=400&zc=2&b=15" alt="">
          </span>
          <p>
              I giudizi che puoi leggere sono rilasciati esclusivamente dai pazienti che hanno prenotato attraverso iDoctors ed hanno realmente effettuato una prestazione medica.
          </p>

      </div>
    </div>
    <div class="right-jumbo">
        <div class="container-img">
            <img class="img-fluid" src="https://www.idoctors.it/images/frontend/recensioni-dei-pazienti.svg" alt="">
        </div>
      <div class="sign-in">
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
    height: 500px;
    .left-jumbo{
      width: 56%;
      .title{
          width: 90%;
          margin: 0 auto;
          margin-top: 30px;
          h3{
              margin: 40px 0;
              font-family: 'Ubuntu',sans-serif;
              font-size: 40px;
              color: #333;
          }
          span{
              display: flex;
              justify-content: center;
              align-items: center;
             img{
                 width: 160px;
              }
          }

      }
    }

    .left-jumbo, .right-jumbo{
        float: left;
        height: 100%;
    }
    .right-jumbo{
        width: 42%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .container-img{
        position: relative;
        width: 100%;
        height: 80%;
        background-size: cover;
        img{
            height: 100%;
            background-size: contain;
        }
      }
      .sign-in{
          position: absolute;
          background-color: rgba(6, 6, 6, 0.4);
          padding: 20px;
          border-radius: 10px;
      }
  }
button{
    border: none;
    background-image: linear-gradient( 135deg , #1e6650 45%, #63987a);
    &:hover{
        background: linear-gradient(135deg, #63987a 45%, #1e6650);
        transition: 0.3s;
        box-shadow: 3px 7px 5px #888888;
    }
}
</style>
