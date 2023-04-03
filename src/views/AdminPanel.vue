<template>
  <div class="container">
    <div class="container__admin__panel">
      <div class="container__add__item">
        <h1>Добавление товара</h1>

        <input type="text" class="input__name__item" placeholder="Название товара"/>
        <input type="text" class="input__name__category" placeholder="Путь категории"/>
        <input type="text" class="input__price" placeholder="Цена"/>
        <input type="text" class="input__count" placeholder="Количество"/>
        <input type="text" class="input__size" placeholder="Размер"/>
        <p>Выберите главное фото</p>
        <button class="btn__main__photo">Выбрать</button>
        <p>Выберите первое дополнительное фото</p>
        <button class="btn__first__photo">Выбрать</button>
        <p>Выберите второе дополнительное фото</p>
        <button class="btn__second__photo">Выбрать</button>

        <div class="buttons">
          <div class="button__add__item">
            <button>Добавить</button>
          </div>
        </div>
        <hr>
      </div>
      <div class="container__new__category">
        <h1>Добавление новой категории</h1>
        <input type="text" class="input__path__category" placeholder="Введите путь категории"/>
        <div class="buttons">
          <div class="button__add__category">
            <button>Добавить</button>
          </div>
        </div>
      </div>
      <div class="container__delete__category">
        <h1>Удаление категории</h1>
        <input type="text" class="input__path__delete__category" placeholder="Введите путь категории"/>
        <div class="buttons">
          <div class="button__delete__category">
            <button>Удалить</button>
          </div>
        </div>
      </div>
      <div class="container__orders">
        <h1>Заказы</h1>
        <div class="div__orders">
          <div class="div__order">
            <h2>Имя</h2>
            <p>Даниил</p>
            <h2>Фамилия</h2>
            <p>Даниил</p>
            <h2>Email</h2>
            <p>Даниил</p>
            <h2>Название товара</h2>
            <p>Даниил</p>
            <h2>Цена</h2>
            <p>Даниил</p>
            <h2>Размер</h2>
            <p>Даниил</p>
            <h2>Количество</h2>
            <p>Даниил</p>
          </div>
        </div>
      </div>
      <div class="container__messages">
        <h1>Сообщения</h1>
        <div class="div__messages">
          <div class="div__message">
            <h2>Имя</h2>
            <p>Даниил</p>
            <h2>Фамилия</h2>
            <p>Даниил</p>
            <h2>Email</h2>
            <p>dan.danya20@mail.ru</p>

            <div class="div__theme__message">asd</div>
            <div class="div__message__text">asd</div>

            <div class="buttons">
              <div class="button__delete__message">
                <button>Удалить</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer>
    <v-footer/>
  </footer>
</template>

<script>
import VFooter from "@/components/v-footer";
export default {
  name: "AdminPanelView",
  components: {
    VFooter,
  }
}
</script>

<style scoped>
.container {
  margin: 20px 50px 100px 50px;
}

.container__admin__panel {
  width: 70%;
  margin: 0 auto 50px auto;
}

.container__add__item, .container__new__category, .container__delete__category, .container__orders, .container__messages {
  width: 40%;
  display: flex;
  flex-direction: column;
}

.container__add__item h1, .container__new__category h1, .container__delete__category h1, .container__orders h1,
.container__messages h1{
  font-family: "DIN PRO Medium";
  font-size: 30px;
}

.input__name__item, .input__name__category, .input__price, .input__count, .input__size,
.input__path__category, .input__path__delete__category {
  border: 2px solid black;
  height: 35px;
  margin-bottom: 15px;
  padding-left: 20px;
  color: black;
  font-family: "DIN PRO Regular";
  font-size: 15px;
}

.div__orders, .div__messages {
  overflow-y:scroll;
  height: 400px;
}

.div__order, .div__message {
  margin-bottom: 50px;
}

.div__order h2, .div__message h2 {
  font-family: "DIN PRO Regular";
  line-height: 1;
  font-size: 18px;
}

.container__add__item p, .container__new__category p, .container__orders p, .container__messages p {
  font-family: "DIN PRO Regular";
  font-size: 18px;
}

.btn__main__photo, .btn__first__photo, .btn__second__photo {
  background-color: white;
  border: 2px solid black;
  font-family: "DIN PRO Medium";
  width: 100px;
  cursor: pointer;
  transition: .2s;
}
.btn__main__photo:hover, .btn__first__photo:hover, .btn__second__photo:hover {
  background-color: #913259;
  border: 2px solid white;
  color: white;
}

hr {
  border-top: 1px solid black;
}

.div__theme__message {
  margin-bottom: 15px;
  padding-left: 20px;
  color: black;
  font-family: "DIN PRO Regular";
  font-size: 15px;
  border: 2px solid black;
  width: 80%;
  height: 35px;
  display: flex;
  align-items: center;
}

.div__message__text {
  margin-bottom: 15px;
  padding-left: 20px;
  padding-top: 10px;
  color: black;
  font-family: "DIN PRO Regular";
  font-size: 15px;
  border: 2px solid black;
  width: 80%;
  height: 100px;
}

.buttons {
  display: flex;
  margin-top: 20px;
}

.button__add__item button, .button__add__category button, .button__delete__category button {
  padding: 12px 50px;
  color: black;
  transition: .5s;
  background-color: white;
  font-family: "DIN PRO Medium";
  font-size: 14px;
  margin-right: 20px;
  border: 2px solid black;
  cursor: pointer;
}

.button__add__item button:hover, .button__add__category button:hover, .button__delete__category button:hover {
  background: #913259;
  color: #ffffff;
  border: 2px solid #913259;
}

.button__delete__message button {
  padding: 12px 50px;
  color: white;
  text-decoration: none;
  overflow: hidden;
  transition: .5s;
  background: black;
  font-family: "DIN PRO Medium";
  font-size: 14px;
  margin: 0 auto;
  border: 2px solid black;
  cursor: pointer;
}

.button__delete__message button:hover {
  background: #913259;
  color: #ffffff;
  border: 2px solid #913259;
}

</style>